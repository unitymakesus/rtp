<?php if(!defined('ABSPATH')) { die('You are not allowed to call this page directly.'); } ?>

<div class="wrap">
  <?php echo PrliAppHelper::page_title(__('Import / Export Links', 'pretty-link')); ?>
  <table class="form-table">
    <tbody>
      <tr>
        <th scope="row">
          <?php _e('Export Pretty Links', 'pretty-link'); ?>
          <?php PrliAppHelper::info_tooltip(
                  'plp-export-links',
                  __('Export Pretty Links', 'pretty-link'),
                  __('Export Links to a CSV File', 'pretty-link')
                ); ?>
        </th>
        <td>
          <a href="<?php echo admin_url('admin-ajax.php?action=plp-export-links'); ?>" class="button button-primary"><?php _e('Export', 'pretty-link'); ?></a>
        </td>
      </tr>
      <tr>
        <th scope="row">
          <?php _e('Import Pretty Links', 'pretty-link'); ?>
          <?php PrliAppHelper::info_tooltip(
                  'plp-import-links',
                  __('Import Pretty Links', 'pretty-link'),
                  __('There are two ways to import a file.<br/><br/>1) Importing to update existing links and<br/><br/>2) Importing to generate new links. When Importing to generate new links, you must delete the "id" column from the CSV before importing. If the "id" column is present, Pretty Links Pro will attempt to update existing links.', 'pretty-link')
                ); ?>
        </th>
        <td>
          <form enctype="multipart/form-data" action="<?php echo str_replace( '%7E', '~', $_SERVER['REQUEST_URI']); ?>" method="POST">
            <?php wp_nonce_field('update-options'); ?>
            <input type="hidden" name="action" value="import">
            <input type="hidden" name="MAX_FILE_SIZE" value="1000000" />
            <input name="importedfile" type="file" />
            <br/>
            <input type="submit" class="button button-primary" value="<?php _e('Import', 'pretty-link'); ?>" />
            <?php PrliAppHelper::info_tooltip(
                    'plp-import-links-select-file',
                    __('Links Import File', 'pretty-link'),
                    __('Select a file that has been formatted as a Pretty Link CSV import file and click "Import"', 'pretty-link')
                  ); ?>
          </form>
        </td>
      </tr>
    </tbody>
  </table>

  <p><a href="https://prettylinks.com/plp/import-export/um/importing-and-exporting-your-links" class="button button-primary"><?php _e('Import/Export Help', 'pretty-link'); ?></a></p>
</div>
