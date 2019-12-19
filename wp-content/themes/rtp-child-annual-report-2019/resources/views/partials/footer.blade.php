@php
  $footer_color = get_theme_mod( 'footer_color' );
  $text_color = get_theme_mod( 'footer_text_color' );
@endphp
<footer class="page-footer" role="contentinfo">
  <div class="footer-social row">
    <div class="container-wide">
      <h2>Stay connected to Research Triangle Park</h2>

      <div class="borders flex flex-wrap align-center space-between">
        <div class="footer-social-left flex align-center col l6 m12">
          @php dynamic_sidebar('footer-social-left') @endphp
        </div>
        <div class="footer-social-right flex flex-end align-center col l6 m12">
          @php dynamic_sidebar('footer-social-right') @endphp
        </div>
      </div>
    </div>
  </div>

  <div class="footer-main row">
    <div class="container-wide flex space-between">
      <div class="footer-col footer-col-left col m3 s12">
        @php dynamic_sidebar('footer-left') @endphp
      </div>
      <div class="footer-col footer-col-center col m4 s12">
        @php dynamic_sidebar('footer-center') @endphp
      </div>
      <div class="footer-col footer-col-right col m4 offset-m1 s12">
        @php dynamic_sidebar('footer-right') @endphp
      </div>
    </div>
  </div>

  <div class="footer-utility row">
    <div class="container-wide flex align-center space-around">
      <div class="col m6 s12">
        @php dynamic_sidebar('footer-utility-left') @endphp
      </div>
      <div class="footer-utility-right col m12 s12 flex align-center flex-end">
        @php dynamic_sidebar('footer-utility-right') @endphp
        <p class="copyright">&copy; {!! current_time('Y') !!} RTP</p>
      </div>
    </div>
  </div>
</footer>
