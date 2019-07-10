<?php
/** no direct access **/
defined('MECEXEC') or die();

/**
 * Webnus MEC organizers class.
 * @author Webnus <info@webnus.biz>
 */
class MEC_feature_organizers extends MEC_base
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
        $this->factory->action('init', array($this, 'register_taxonomy'), 25);
        $this->factory->action('mec_organizer_edit_form_fields', array($this, 'edit_form'));
        $this->factory->action('mec_organizer_add_form_fields', array($this, 'add_form'));
        $this->factory->action('edited_mec_organizer', array($this, 'save_metadata'));
        $this->factory->action('created_mec_organizer', array($this, 'save_metadata'));
        
        $this->factory->action('mec_metabox_details', array($this, 'meta_box_organizer'), 40);
        if(!isset($this->settings['fes_section_organizer']) or (isset($this->settings['fes_section_organizer']) and $this->settings['fes_section_organizer'])) $this->factory->action('mec_fes_metabox_details', array($this, 'meta_box_organizer'), 31);
        
        $this->factory->filter('manage_edit-mec_organizer_columns', array($this, 'filter_columns'));
        $this->factory->filter('manage_mec_organizer_custom_column', array($this, 'filter_columns_content'), 10, 3);
        
        $this->factory->action('save_post', array($this, 'save_event'), 2);
    }
    
    /**
     * Registers organizer taxonomy
     * @author Webnus <info@webnus.biz>
     */
    public function register_taxonomy()
    {
        $singular_label = $this->main->m('taxonomy_organizer', __('Organizer', 'mec'));
        $plural_label = $this->main->m('taxonomy_organizers', __('Organizers', 'mec'));

        register_taxonomy(
            'mec_organizer',
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
                'rewrite'=>array('slug'=>'events-organizer'),
                'public'=>false,
                'show_ui'=>true,
                'hierarchical'=>false,
            )
        );
        
        register_taxonomy_for_object_type('mec_organizer', $this->main->get_main_post_type());
    }
    
    /**
     * Show edit form of organizer taxonomy
     * @author Webnus <info@webnus.biz>
     * @param object $term
     */
    public function edit_form($term)
    {
        $tel = get_metadata('term', $term->term_id, 'tel', true);
        $email = get_metadata('term', $term->term_id, 'email', true);
        $url = get_metadata('term', $term->term_id, 'url', true);
        $thumbnail = get_metadata('term', $term->term_id, 'thumbnail', true);
    ?>
        <tr class="form-field">
            <th scope="row" valign="top">
                <label for="mec_tel"><?php _e('Tel', 'mec'); ?></label>
            </th>
            <td>
                <input type="text" placeholder="<?php esc_attr_e('Insert organizer phone number.', 'mec'); ?>" name="tel" id="mec_tel" value="<?php echo $tel; ?>" />
            </td>
        </tr>
        <tr class="form-field">
            <th scope="row" valign="top">
                <label for="mec_email"><?php _e('Email', 'mec'); ?></label>
            </th>
            <td>
                <input type="text"  placeholder="<?php esc_attr_e('Insert organizer email address.', 'mec'); ?>" name="email" id="mec_email" value="<?php echo $email; ?>" />
            </td>
        </tr>
        <tr class="form-field">
            <th scope="row" valign="top">
                <label for="mec_url"><?php _e('Link to organizer page', 'mec'); ?></label>
            </th>
            <td>
                <input type="text" placeholder="<?php esc_attr_e('Use this field to link organizer to other user profile pages', 'mec'); ?>" name="url" id="mec_url" value="<?php echo $url; ?>" />
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
     * Show add form of organizer taxonomy
     * @author Webnus <info@webnus.biz>
     */
    public function add_form()
    {
    ?>
        <div class="form-field">
            <label for="mec_tel"><?php _e('Tel', 'mec'); ?></label>
            <input type="text" name="tel" placeholder="<?php esc_attr_e('Insert organizer phone number.', 'mec'); ?>" id="mec_tel" value="" />
        </div>
        <div class="form-field">
            <label for="mec_email"><?php _e('Email', 'mec'); ?></label>
            <input type="text" name="email" placeholder="<?php esc_attr_e('Insert organizer email address.', 'mec'); ?>" id="mec_email" value="" />
        </div>
        <div class="form-field">
            <label for="mec_url"><?php _e('Link to organizer page', 'mec'); ?></label>
            <input type="text" name="url" placeholder="<?php esc_attr_e('Use this field to link organizer to other user profile pages', 'mec'); ?>" id="mec_url" value="" />
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
     * Save meta data of organizer taxonomy
     * @author Webnus <info@webnus.biz>
     * @param int $term_id
     */
    public function save_metadata($term_id)
    {
        $tel = isset($_POST['tel']) ? sanitize_text_field($_POST['tel']) : '';
        $email = isset($_POST['email']) ? sanitize_text_field($_POST['email']) : '';
        $url = (isset($_POST['url']) and trim($_POST['url'])) ? (strpos($_POST['url'], 'http') === false ? 'http://'.sanitize_text_field($_POST['url']) : sanitize_text_field($_POST['url'])) : '';
        $thumbnail = isset($_POST['thumbnail']) ? sanitize_text_field($_POST['thumbnail']) : '';
        
        update_term_meta($term_id, 'tel', $tel);
        update_term_meta($term_id, 'email', $email);
        update_term_meta($term_id, 'url', $url);
        update_term_meta($term_id, 'thumbnail', $thumbnail);
    }
    
    /**
     * Filter columns of organizer taxonomy
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
        $columns['name'] = $this->main->m('taxonomy_organizer', __('Organizer', 'mec'));
        $columns['contact'] = __('Contact info', 'mec');
        $columns['posts'] = __('Count', 'mec');
        $columns['slug'] = __('Slug', 'mec');

        return $columns;
    }
    
    /**
     * Filter content of organizer taxonomy columns
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

            case 'contact':
                
                $tel = get_metadata('term', $term_id, 'tel', true);
                $email = get_metadata('term', $term_id, 'email', true);
                
                $content = $email.(trim($tel) ? '<br />'.$tel : '');
                break;

            default:
                break;
        }

        return $content;
    }
    
    /**
     * Show organizer meta box
     * @author Webnus <info@webnus.biz>
     * @param object $post
     */
    public function meta_box_organizer($post)
    {
        $organizers = get_terms('mec_organizer', array('orderby'=>'name', 'hide_empty'=>'0'));
        $organizer_id = get_post_meta($post->ID, 'mec_organizer_id', true);

        $organizer_ids = get_post_meta($post->ID, 'mec_additional_organizer_ids', true);
        if(!is_array($organizer_ids)) $organizer_ids = array();

        $additional_organizers_status = (!isset($this->settings['additional_organizers']) or (isset($this->settings['additional_organizers']) and $this->settings['additional_organizers'])) ? true : false;
    ?>
        <div class="mec-meta-box-fields" id="mec-organizer">
            <h4><?php echo sprintf(__('Event Main %s', 'mec'), $this->main->m('taxonomy_organizer', __('Organizer', 'mec'))); ?></h4>
			<div class="mec-form-row">
				<select name="mec[organizer_id]" id="mec_organizer_id" title="<?php echo esc_attr__($this->main->m('taxonomy_organizer', __('Organizer', 'mec')), 'mec'); ?>">
                    <option value="1"><?php _e('Hide organizer', 'mec'); ?></option>
					<option value="0"><?php _e('Insert a new organizer', 'mec'); ?></option>
					<?php foreach($organizers as $organizer): ?>
					<option <?php if($organizer_id == $organizer->term_id) echo 'selected="selected"'; ?> value="<?php echo $organizer->term_id; ?>"><?php echo $organizer->name; ?></option>
					<?php endforeach; ?>
				</select>
                <span class="mec-tooltip">
                    <div class="box top">
                        <h5 class="title"><?php _e('Organizer', 'mec'); ?></h5>
                        <div class="content"><p><?php esc_attr_e('Choose one of saved organizers or insert new one below.', 'mec'); ?><a href="https://webnus.net/dox/modern-events-calendar/organizer-and-other-organizer/" target="_blank"><?php _e('Read More', 'mec'); ?></a></p></div>    
                    </div>
                    <i title="" class="dashicons-before dashicons-editor-help"></i>
                </span>	                 
			</div>
			<div id="mec_organizer_new_container">
				<div class="mec-form-row">
					<input type="text" name="mec[organizer][name]" id="mec_organizer_name" value="" placeholder="<?php _e('Name', 'mec'); ?>" />
					<p class="description"><?php _e('eg. John Smith', 'mec'); ?></p>
				</div>
                <div class="mec-form-row">
                    <input type="text" name="mec[organizer][tel]" id="mec_organizer_contact" value="" placeholder="<?php esc_attr_e('Phone number.', 'mec'); ?>" />
                    <p class="description"><?php _e('eg. +1 (234) 5678', 'mec'); ?></p>
                </div>
                <div class="mec-form-row">
                    <input type="text" name="mec[organizer][email]" id="mec_organizer_contact" value="" placeholder="<?php esc_attr_e('Email address.', 'mec'); ?>" />
                    <p class="description"><?php _e('eg. john@smith.com', 'mec'); ?></p>
                </div>
				<div class="mec-form-row">
					<input type="text" name="mec[organizer][url]" id="mec_organizer_url" value="" placeholder="<?php _e('Link to organizer page', 'mec'); ?>" />
					<p class="description"><?php _e('eg. https://webnus.net', 'mec'); ?></p>
				</div>
                <?php /* Don't show this section in FES */ if(is_admin()): ?>
				<div class="mec-form-row mec-thumbnail-row">
					<div id="mec_organizer_thumbnail_img"></div>
					<input type="hidden" name="mec[organizer][thumbnail]" id="mec_organizer_thumbnail" value="" />
                    <button type="button" class="mec_organizer_upload_image_button button" id="mec_organizer_thumbnail_button"><?php echo __('Choose image', 'mec'); ?></button>
					<button type="button" class="mec_organizer_remove_image_button button mec-util-hidden"><?php echo __('Remove image', 'mec'); ?></button>
				</div>
                <?php else: ?>
                <div class="mec-form-row mec-thumbnail-row">
                    <span id="mec_fes_organizer_thumbnail_img"></span>
					<input type="hidden" name="mec[organizer][thumbnail]" id="mec_fes_organizer_thumbnail" value="" />
					<input type="file" id="mec_fes_organizer_thumbnail_file" onchange="mec_fes_upload_organizer_thumbnail();" />
                    <span class="mec_fes_organizer_remove_image_button button mec-util-hidden" id="mec_fes_organizer_remove_image_button"><?php echo __('Remove image', 'mec'); ?></span>
				</div>
                <?php endif; ?>
			</div>
            <?php if($additional_organizers_status and count($organizers)): ?>
            <h4><?php echo $this->main->m('other_organizers', __('Other Organizers', 'mec')); ?></h4>
            <div class="mec-form-row">
                <p><?php _e('You can select extra organizers in addition to main organizer if you like.', 'mec'); ?></p>
                <div class="mec-additional-organizers">
                    <?php foreach($organizers as $organizer): ?>
                    <div>
                        <label for="additional_organizer_ids<?php echo $organizer->term_id; ?>">
                            <input type="checkbox" name="mec[additional_organizer_ids][]" id="additional_organizer_ids<?php echo $organizer->term_id; ?>" value="<?php echo $organizer->term_id; ?>" <?php if(in_array($organizer->term_id, $organizer_ids)) echo 'checked="checked"'; ?>>
                            <?php echo $organizer->name; ?>
                        </label>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <?php endif; ?>
		</div>
    <?php
    }
    
    /**
     * Save event organizer data
     * @author Webnus <info@webnus.biz>
     * @param int $post_id
     * @return boolean
     */
    public function save_event($post_id)
    {
        // Check if our nonce is set.
        if(!isset($_POST['mec_event_nonce'])) return false;

        // Verify that the nonce is valid.
        if(!wp_verify_nonce(sanitize_text_field($_POST['mec_event_nonce']), 'mec_event_data')) return false;

        // If this is an autosave, our form has not been submitted, so we don't want to do anything.
        if(defined('DOING_AUTOSAVE') and DOING_AUTOSAVE) return false;

        // Get Modern Events Calendar Data
        $_mec = isset($_POST['mec']) ? $_POST['mec'] : array();
        
        // Selected a saved organizer
        if(isset($_mec['organizer_id']) and $_mec['organizer_id'])
        {
            // Set term to the post
            wp_set_object_terms($post_id, (int) $_mec['organizer_id'], 'mec_organizer');
            
            return true;
        }
        
        $name = (isset($_mec['organizer']['name']) and trim($_mec['organizer']['name'])) ? sanitize_text_field($_mec['organizer']['name']) : 'Organizer Name';
        
        $term = get_term_by('name', $name, 'mec_organizer');
        
        // Term already exists
        if(is_object($term) and isset($term->term_id))
        {
            // Set term to the post
            wp_set_object_terms($post_id, (int) $term->term_id, 'mec_organizer');
            
            return true;
        }
        
        $term = wp_insert_term($name, 'mec_organizer');
        
        // An error ocurred
        if(is_wp_error($term))
        {
            #TODO show a message to user
            return false;
        }
        
        $organizer_id = $term['term_id'];
        
        if(!$organizer_id) return false;
        
        // Set Organizer ID to the parameters
        $_POST['mec']['organizer_id'] = $organizer_id;
        
        // Set term to the post
        wp_set_object_terms($post_id, (int) $organizer_id, 'mec_organizer');
            
        $tel = (isset($_mec['organizer']['tel']) and trim($_mec['organizer']['tel'])) ? sanitize_text_field($_mec['organizer']['tel']) : '';
        $email = (isset($_mec['organizer']['email']) and trim($_mec['organizer']['email'])) ? sanitize_text_field($_mec['organizer']['email']) : '';
        $url = (isset($_mec['organizer']['url']) and trim($_mec['organizer']['url'])) ? (strpos($_mec['organizer']['url'], 'http') === false ? 'http://'.sanitize_text_field($_mec['organizer']['url']) : sanitize_text_field($_mec['organizer']['url'])) : '';
        $thumbnail = (isset($_mec['organizer']['thumbnail']) and trim($_mec['organizer']['thumbnail'])) ? sanitize_text_field($_mec['organizer']['thumbnail']) : '';
        
        update_term_meta($organizer_id, 'tel', $tel);
        update_term_meta($organizer_id, 'email', $email);
        update_term_meta($organizer_id, 'url', $url);
        update_term_meta($organizer_id, 'thumbnail', $thumbnail);

        return true;
    }
}