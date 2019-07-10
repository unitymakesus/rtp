<?php
/** no direct access **/
defined('MECEXEC') or die();

/**
 * Webnus MEC speakers class.
 * @author Webnus <info@webnus.biz>
 */
class MEC_feature_speakers extends MEC_base
{
    public $factory;
    public $main;
    public $settings;

    /**
     * Constructor method
     * @author Webnus <info@webnus.biz>
     */
    public function __construct()
    {
        // Import MEC Factory
        $this->factory = $this->getFactory();
        
        // Import MEC Main
        $this->main = $this->getMain();
        
        // MEC Settings
        $this->settings = $this->main->get_settings();
    }
    
    /**
     * Initialize organizers feature
     * @author Webnus <info@webnus.biz>
     */
    public function init()
    {
        // Speakers Feature is Disabled
        if(!isset($this->settings['speakers_status']) or (isset($this->settings['speakers_status']) and !$this->settings['speakers_status'])) return;

        $this->factory->action('init', array($this, 'register_taxonomy'), 25);
        $this->factory->action('mec_speaker_edit_form_fields', array($this, 'edit_form'));
        $this->factory->action('mec_speaker_add_form_fields', array($this, 'add_form'));
        $this->factory->action('edited_mec_speaker', array($this, 'save_metadata'));
        $this->factory->action('created_mec_speaker', array($this, 'save_metadata'));

        $this->factory->filter('manage_edit-mec_speaker_columns', array($this, 'filter_columns'));
        $this->factory->filter('manage_mec_speaker_custom_column', array($this, 'filter_columns_content'), 10, 3);
    }
    
    /**
     * Registers speaker taxonomy
     * @author Webnus <info@webnus.biz>
     */
    public function register_taxonomy()
    {
        $singular_label = $this->main->m('taxonomy_speaker', __('Speaker', 'mec'));
        $plural_label = $this->main->m('taxonomy_speakers', __('Speakers', 'mec'));

        register_taxonomy(
            'mec_speaker',
            $this->main->get_main_post_type(),
            array(
                'label'=>$plural_label,
                'labels'=>array(
                    'name'=>$plural_label,
                    'singular_name'=>$singular_label,
                    'all_items'=>sprintf(__('All %s', 'mec'), $plural_label),
                    'edit_item'=>sprintf(__('Edit %s', 'mec'), $singular_label),
                    'view_item'=>sprintf(__('View %s', 'mec'), $singular_label),
                    'update_item'=>sprintf(__('Update %s', 'mec'), $singular_label),
                    'add_new_item'=>sprintf(__('Add New %s', 'mec'), $singular_label),
                    'new_item_name'=>sprintf(__('New %s Name', 'mec'), $singular_label),
                    'popular_items'=>sprintf(__('Popular %s', 'mec'), $plural_label),
                    'search_items'=>sprintf(__('Search %s', 'mec'), $plural_label),
                ),
                'rewrite'=>array('slug'=>'events-speaker'),
                'public'=>false,
                'show_ui'=>true,
                'show_in_rest'=>true,
                'hierarchical'=>false,
            )
        );
        
        register_taxonomy_for_object_type('mec_speaker', $this->main->get_main_post_type());
    }
    
    /**
     * Show edit form of speaker taxonomy
     * @author Webnus <info@webnus.biz>
     * @param object $term
     */
    public function edit_form($term)
    {
        $job_title = get_metadata('term', $term->term_id, 'job_title', true);
        $tel = get_metadata('term', $term->term_id, 'tel', true);
        $email = get_metadata('term', $term->term_id, 'email', true);
        $facebook = get_metadata('term', $term->term_id, 'facebook', true);
        $instagram = get_metadata('term', $term->term_id, 'instagram', true);
        $twitter = get_metadata('term', $term->term_id, 'twitter', true);
        $thumbnail = get_metadata('term', $term->term_id, 'thumbnail', true);
    ?>
        <tr class="form-field">
            <th scope="row" valign="top">
                <label for="mec_job_title"><?php _e('Job Title', 'mec'); ?></label>
            </th>
            <td>
                <input type="text" placeholder="<?php esc_attr_e('Insert speaker job title.', 'mec'); ?>" name="job_title" id="mec_job_title" value="<?php echo $job_title; ?>" />
            </td>
        </tr>
        <tr class="form-field">
            <th scope="row" valign="top">
                <label for="mec_tel"><?php _e('Tel', 'mec'); ?></label>
            </th>
            <td>
                <input type="text" placeholder="<?php esc_attr_e('Insert speaker phone number.', 'mec'); ?>" name="tel" id="mec_tel" value="<?php echo $tel; ?>" />
            </td>
        </tr>
        <tr class="form-field">
            <th scope="row" valign="top">
                <label for="mec_email"><?php _e('Email', 'mec'); ?></label>
            </th>
            <td>
                <input type="text"  placeholder="<?php esc_attr_e('Insert speaker email address.', 'mec'); ?>" name="email" id="mec_email" value="<?php echo $email; ?>" />
            </td>
        </tr>
        <tr class="form-field">
            <th scope="row" valign="top">
                <label for="mec_facebook"><?php _e('Facebook Page', 'mec'); ?></label>
            </th>
            <td>
                <input type="text" placeholder="<?php esc_attr_e('Insert URL of Facebook Page', 'mec'); ?>" name="facebook" id="mec_facebook" value="<?php echo $facebook; ?>" />
            </td>
        </tr>
        <tr class="form-field">
            <th scope="row" valign="top">
                <label for="mec_instagram"><?php _e('Instagram', 'mec'); ?></label>
            </th>
            <td>
                <input type="text" placeholder="<?php esc_attr_e('Insert URL of Instagram', 'mec'); ?>" name="instagram" id="mec_instagram" value="<?php echo $instagram; ?>" />
            </td>
        </tr>
        <tr class="form-field">
            <th scope="row" valign="top">
                <label for="mec_twitter"><?php _e('Twitter Page', 'mec'); ?></label>
            </th>
            <td>
                <input type="text" placeholder="<?php esc_attr_e('Insert URL of Twitter Page', 'mec'); ?>" name="twitter" id="mec_twitter" value="<?php echo $twitter; ?>" />
            </td>
        </tr>
        <tr class="form-field">
            <th scope="row" valign="top">
                <label for="mec_thumbnail_button"><?php _e('Thumbnail', 'mec'); ?></label>
            </th>
            <td>
                <div id="mec_thumbnail_img"><?php if(trim($thumbnail) != '') echo '<img src="'.$thumbnail.'" />'; ?></div>
                <input type="hidden" name="thumbnail" id="mec_thumbnail" value="<?php echo $thumbnail; ?>" />
                <button type="button" class="mec_upload_image_button button" id="mec_thumbnail_button"><?php echo __('Upload/Add image', 'mec'); ?></button>
                <button type="button" class="mec_remove_image_button button <?php echo (!trim($thumbnail) ? 'mec-util-hidden' : ''); ?>"><?php echo __('Remove image', 'mec'); ?></button>
            </td>
        </tr>
    <?php
    }
    
    /**
     * Show add form of speaker taxonomy
     * @author Webnus <info@webnus.biz>
     */
    public function add_form()
    {
    ?>
        <div class="form-field">
            <label for="mec_job_title"><?php _e('Job Title', 'mec'); ?></label>
            <input type="text" name="job_title" placeholder="<?php esc_attr_e('Insert speaker job title.', 'mec'); ?>" id="mec_job_title" value="" />
        </div>
        <div class="form-field">
            <label for="mec_tel"><?php _e('Tel', 'mec'); ?></label>
            <input type="text" name="tel" placeholder="<?php esc_attr_e('Insert organizer phone number.', 'mec'); ?>" id="mec_tel" value="" />
        </div>
        <div class="form-field">
            <label for="mec_email"><?php _e('Email', 'mec'); ?></label>
            <input type="text" name="email" placeholder="<?php esc_attr_e('Insert organizer email address.', 'mec'); ?>" id="mec_email" value="" />
        </div>
        <div class="form-field">
            <label for="mec_facebook"><?php _e('Facebook Page', 'mec'); ?></label>
            <input type="text" name="facebook" placeholder="<?php esc_attr_e('Insert URL of Facebook Page', 'mec'); ?>" id="mec_facebook" value="" />
        </div>
        <div class="form-field">
            <label for="mec_instagram"><?php _e('Instagram', 'mec'); ?></label>
            <input type="text" name="instagram" placeholder="<?php esc_attr_e('Insert URL of Instagram', 'mec'); ?>" id="mec_instagram" value="" />
        </div>
        <div class="form-field">
            <label for="mec_twitter"><?php _e('Twitter Page', 'mec'); ?></label>
            <input type="text" name="twitter" placeholder="<?php esc_attr_e('Insert URL of Twitter Page', 'mec'); ?>" id="mec_twitter" value="" />
        </div>
        <div class="form-field">
            <label for="mec_thumbnail_button"><?php _e('Thumbnail', 'mec'); ?></label>
            <div id="mec_thumbnail_img"></div>
            <input type="hidden" name="thumbnail" id="mec_thumbnail" value="" />
            <button type="button" class="mec_upload_image_button button" id="mec_thumbnail_button"><?php echo __('Upload/Add image', 'mec'); ?></button>
            <button type="button" class="mec_remove_image_button button mec-util-hidden"><?php echo __('Remove image', 'mec'); ?></button>
        </div>
    <?php
    }
    
    /**
     * Save meta data of speaker taxonomy
     * @author Webnus <info@webnus.biz>
     * @param int $term_id
     */
    public function save_metadata($term_id)
    {
        $job_title = isset($_POST['job_title']) ? sanitize_text_field($_POST['job_title']) : '';
        $tel = isset($_POST['tel']) ? sanitize_text_field($_POST['tel']) : '';
        $email = isset($_POST['email']) ? sanitize_text_field($_POST['email']) : '';
        $facebook = (isset($_POST['facebook']) and trim($_POST['facebook'])) ? (strpos($_POST['facebook'], 'http') === false ? 'http://'.sanitize_text_field($_POST['facebook']) : sanitize_text_field($_POST['facebook'])) : '';
        $twitter = (isset($_POST['twitter']) and trim($_POST['twitter'])) ? (strpos($_POST['twitter'], 'http') === false ? 'http://'.sanitize_text_field($_POST['twitter']) : sanitize_text_field($_POST['twitter'])) : '';
        $instagram = (isset($_POST['instagram']) and trim($_POST['instagram'])) ? (strpos($_POST['instagram'], 'http') === false ? 'http://'.sanitize_text_field($_POST['instagram']) : sanitize_text_field($_POST['instagram'])) : '';
        $thumbnail = isset($_POST['thumbnail']) ? sanitize_text_field($_POST['thumbnail']) : '';
        
        update_term_meta($term_id, 'job_title', $job_title);
        update_term_meta($term_id, 'tel', $tel);
        update_term_meta($term_id, 'email', $email);
        update_term_meta($term_id, 'facebook', $facebook);
        update_term_meta($term_id, 'twitter', $twitter);
        update_term_meta($term_id, 'instagram', $instagram);
        update_term_meta($term_id, 'thumbnail', $thumbnail);
    }
    
    /**
     * Filter columns of speaker taxonomy
     * @author Webnus <info@webnus.biz>
     * @param array $columns
     * @return array
     */
    public function filter_columns($columns)
    {
        unset($columns['name']);
        unset($columns['slug']);
        unset($columns['description']);
        unset($columns['posts']);
        
        $columns['id'] = __('ID', 'mec');
        $columns['name'] = $this->main->m('taxonomy_speaker', __('Speaker', 'mec'));
        $columns['job_title'] = __('Job Title', 'mec');
        $columns['tel'] = __('Tel', 'mec');
        $columns['posts'] = __('Count', 'mec');

        return $columns;
    }
    
    /**
     * Filter content of speaker taxonomy columns
     * @author Webnus <info@webnus.biz>
     * @param string $content
     * @param string $column_name
     * @param int $term_id
     * @return string
     */
    public function filter_columns_content($content, $column_name, $term_id)
    {
        switch($column_name)
        {
            case 'id':
                
                $content = $term_id;
                break;

            case 'tel':

                $content = get_metadata('term', $term_id, 'tel', true);

                break;

            case 'job_title':

                $content = get_metadata('term', $term_id, 'job_title', true);

                break;

            default:
                break;
        }

        return $content;
    }
}