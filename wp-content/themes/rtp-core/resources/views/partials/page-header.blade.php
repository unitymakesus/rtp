<?php $feat_img = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full' ); ?>

<header class="page-header" style="background-image: url('<?php echo $feat_img[0]; ?>')">
  <div class="container-wide">
    <h1>{!! App::title() !!}</h1>
  </div>
</header>
