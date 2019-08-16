<?php
if (is_home() || is_archive()) {
  $post_id = get_option('page_for_posts');
} else {
  $post_id = $post->ID;
}

$feat_img = wp_get_attachment_image_src( get_post_thumbnail_id($post_id), 'full' );
?>

<header class="page-header" style="background-image: url('<?php echo $feat_img[0]; ?>')">
  <div class="container">
    <h1>{!! App::title() !!}</h1>
  </div>
</header>
