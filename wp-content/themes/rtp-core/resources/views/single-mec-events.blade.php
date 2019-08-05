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
    @include('partials.page-header')
    @php do_action('mec_before_main_content'); @endphp

      <section id="<?php echo apply_filters('mec_single_page_html_id', 'main-content'); ?>" class="<?php echo apply_filters('mec_single_page_html_class', 'mec-container'); ?>">
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
