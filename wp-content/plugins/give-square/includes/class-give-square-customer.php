<?php
/**
 * Give Square Customer
 *
 * @package   Give-Square
 * @copyright Copyright (c) 2018, GiveWP
 * @license   https://opensource.org/licenses/gpl-license GNU Public License
 * @since     1.0.0
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Class Give_Square_Customer
 *
 * @since 1.0.0
 */
class Give_Square_Customer {

	/**
	 * Customer API.
	 *
	 * @since 1.0.0
	 * @var array
	 */
	public $customer_api = array();

	/**
	 * Give_Square_Customer constructor.
	 *
	 * @since 1.0.0
	 */
	public function __construct() {

		// Set the Access Token prior to any API calls.
		\SquareConnect\Configuration::getDefaultConfiguration()->setAccessToken( give_square_get_access_token() );

		$this->customer_api = new SquareConnect\Api\CustomersApi();
	}

	/**
	 * This function will be used to create customer in Square.
	 *
	 * @param array $donation_data Donation data.
	 *
	 * @since 1.0.0
	 *
	 * @return bool|string
	 */
	public function create( $donation_data ) {

		$donor_id             = give_get_payment_donor_id( $donation_data['donation_id'] );
		$existing_customer_id = give_get_meta( $donor_id, '_give_square_donor_customer_id', true );

		if ( ! $this->retrieve( $existing_customer_id ) ) {

			$first_name = ! empty( $donation_data['user_info']['first_name'] ) ? $donation_data['user_info']['first_name'] : '';
			$last_name  = ! empty( $donation_data['user_info']['last_name'] ) ? $donation_data['user_info']['last_name'] : '';

			// Set values in your customer object.
			$customer = new \SquareConnect\Model\CreateCustomerRequest();
			$customer->setGivenName( $first_name );
			$customer->setFamilyName( $last_name );
			$customer->setEmailAddress( $donation_data['user_info']['email'] );

			// Put billing address information in an Address model.
			$billing_address = new SquareConnect\Model\Address();
			$billing_address->setAddressLine1( $donation_data['user_info']['address']['line1'] );

			// Set Address line 2, if it is not empty.
			if ( ! empty( $donation_data['user_info']['address']['line2'] ) ) {
				$billing_address->setAddressLine2( $donation_data['user_info']['address']['line2'] );
			}

			$billing_address->setLocality( $donation_data['user_info']['address']['city'] );
			$billing_address->setAdministrativeDistrictLevel1( $donation_data['user_info']['address']['state'] );
			$billing_address->setCountry( $donation_data['user_info']['address']['country'] );

			// Set Postal Code, if it is not empty.
			if ( ! empty( $donation_data['user_info']['address']['zip'] ) ) {
				$billing_address->setPostalCode( $donation_data['user_info']['address']['zip'] );
			}

			$billing_address->setFirstName( $first_name );
			$billing_address->setLastName( $last_name );

			// Set address model to customer.
			$customer->setAddress( $billing_address );

			try {
				$result      = $this->customer_api->createCustomer( $customer );
				$customer_id = $result->getCustomer()->getId();

				// Update customer id to donor.
				give_update_meta( $donor_id, '_give_square_donor_customer_id', $customer_id );

				return $customer_id;

			} catch ( Exception $e ) {
				give_record_gateway_error(
					__( 'Square Customer Creation Error', 'give-square' ),
					sprintf(
						/* translators: 1. Intro Text, 2. Exception error message. */
						'%1$s %2$s',
						__( 'Unable to create customer at Square. Details:', 'give-square' ),
						$e->getMessage()
					)
				);

				return false;
			}
		} else {
			return $this->retrieve( $existing_customer_id )->getId();
		} // End if().

	}

	/**
	 * This function is used to retrieve customer object from Square.
	 *
	 * @param string $customer_id Customer ID.
	 *
	 * @since 1.0.0
	 *
	 * @return bool|\SquareConnect\Model\Customer
	 */
	public function retrieve( $customer_id ) {

		try {

			$result = $this->customer_api->retrieveCustomer( $customer_id );
			return $result->getCustomer();

		} catch ( Exception $e ) {
			give_record_gateway_error(
				__( 'Square Customer Retrieval Error', 'give-square' ),
				sprintf(
					/* translators: 1. Intro Text, 2. Exception error message. */
					'%1$s %2$s',
					__( 'Unable to retrive customer details from Square. Details:', 'give-square' ),
					$e->getMessage()
				)
			);
			return false;
		}

	}

}
