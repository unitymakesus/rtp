@php
/** no direct access **/
defined('MECEXEC') or die();

/**
 * The Template for displaying all single events
 *
 * @author Webnus <info@webnus.biz>
 * @package MEC/Templates
 * @version 1.0.0
 */
@endphp

@extends('layouts.app')

@section('content')
  @php
    $feat_img = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full' );
    $terms = wp_get_post_terms($post->ID, 'mec_category');
    $term_img = get_wp_term_image($terms[0]->term_id);
  @endphp

  <header class="page-header">
    <div class="texture">
      <?php if (!empty($term_img)) { ?>
        <img src="{{$term_img}}" alt=""/>
      <?php } ?>
    </div>
    <div class="container">
      <div class="entry-title-container">
        <h1 class="entry-title">{!! App::title() !!}</h1>
      </div>
    </div>
  </header>

  @php do_action('mec_before_main_content'); @endphp

    <section id="<?php echo apply_filters('mec_single_page_html_id', 'main-content'); ?>" class="<?php echo apply_filters('mec_single_page_html_class', 'container'); ?>">
      @while(have_posts())

        @php
          the_post();
          $MEC = MEC::instance();
          echo $MEC->single();
        @endphp

      @endwhile
    </section>

  @php do_action('mec_after_main_content'); @endphp
@endsection
