@php
/** no direct access **/
defined('MECEXEC') or die();

/**
 * The Template for displaying mec-category taxonomy events
 *
 * @author Webnus <info@webnus.biz>
 * @package MEC/Templates
 * @version 1.0.0
 */
 @endphp

 @extends('layouts.app')

 @section('content')
   @php
     $term_img = get_wp_term_image(get_queried_object()->term_id);
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

    <section id="<?php echo apply_filters('mec_category_page_html_id', 'main-content'); ?>" class="<?php echo apply_filters('mec_category_page_html_class', 'container'); ?>">
      @if(have_posts())

	     @php
        $MEC = MEC::instance();
        echo $MEC->category();
      @endphp

     @endif
    </section>

  @php do_action('mec_after_main_content'); @endphp
@endsection
