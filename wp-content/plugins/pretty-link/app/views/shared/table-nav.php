<?php if(!defined('ABSPATH')) { die('You are not allowed to call this page directly.'); } ?>
<?php

  $curr_size = isset($_REQUEST['size']) ? (int) $_REQUEST['size'] : 10;
  $curr_url = sanitize_text_field($_REQUEST['page']) . $page_params;

  // Only show the pager bar if there is more than 1 page
  if($page_count > 1)
  {
      ?>
    <div class="tablenav"<?php echo (isset($navstyle)?' style="' . esc_html($navstyle) . '"':''); ?>>
      <div class="tablenav-pages">
        <span class="displaying-num">
          <?php echo esc_html(sprintf(__('Displaying %1$s&#8211;%2$s of %3$s', 'pretty-link'), $page_first_record, $page_last_record, $record_count)); ?>
        </span>

        <?php
        // Only show the prev page button if the current page is not the first page
        if($current_page > 1)
        {
          ?>
          <a class="prev page-numbers" href="<?php echo esc_url('?page=' . $curr_url . '&paged=' . ($current_page-1)); ?>">&laquo;</a>
          <?php
        }

        // First page is always displayed
        if($current_page==1)
        {
          ?>
          <a class="page-numbers disabled" href="#">1</a>
          <?php
        }
        else
        {
          ?>
          <a class="page-numbers" href="<?php echo esc_url('?page=' . $curr_url . '&paged=1'); ?>">1</a>
          <?php
        }

        // If the current page is more than 2 spaces away from the first page then we put some dots in here
        if($current_page >= 5)
        {
          ?>
          <span class="page-numbers dots">...</span>
          <?php
        }

        // display the current page icon and the 2 pages beneath and above it
        $low_page = (($current_page >= 5)?($current_page-2):2);
        $high_page = ((($current_page + 2) < ($page_count-1))?($current_page+2):($page_count-1));
        for($i = $low_page; $i <= $high_page; $i++)
        {
          if($current_page==$i)
          {
            ?>
            <a class="page-numbers disabled" href="#"><?php echo esc_html($i); ?></a>
            <?php
          }
          else
          {
            ?>
            <a class="page-numbers" href="<?php echo esc_url('?page=' . $curr_url . '&paged=' . $i); ?>"><?php echo esc_html($i); ?></a>
            <?php
          }
        }

        // If the current page is more than 2 away from the last page then show ellipsis
        if($current_page < ($page_count - 3))
        {
          ?>
          <span class="page-numbers dots">...</span>
          <?php
        }

        // Display the last page icon
        if($current_page == $page_count)
        {
          ?>
          <a class="page-numbers disabled" href="#"><?php echo esc_html($page_count); ?></a>
          <?php
        }
        else
        {
          ?>
          <a class="page-numbers" href="<?php echo esc_url('?page=' . $curr_url . '&paged=' . $page_count); ?>"><?php echo esc_html($page_count); ?></a>
          <?php
        }

        // Display the next page icon if there is a next page
        if($current_page < $page_count)
        {
          ?>
          <a class="next page-numbers" href="<?php echo esc_url('?page=' . $curr_url . '&paged=' . ($current_page + 1)); ?>">&raquo;</a>
          <?php
        }
        ?>
      </div>
    </div>
    <?php
  }
