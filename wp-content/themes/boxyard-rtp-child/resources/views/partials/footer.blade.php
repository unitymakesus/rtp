<footer class="page-footer" role="contentinfo">
  <div class="footer-main">
    <div class="container-wide">
      <div class="row">
        <div class="footer-col footer-col-left col s12 m3 xl3">
          @php dynamic_sidebar('footer-left') @endphp
        </div>
        <div class="footer-col footer-col-center col s12 m9 xl4">
          @php dynamic_sidebar('footer-center') @endphp
        </div>
        <div class="footer-col footer-col-right col s12 m9 offset-m3 xl5">
          @php dynamic_sidebar('footer-right') @endphp
        </div>
      </div>
    </div>
  </div>
  <div class="footer-utility">
    <div class="container-wide">
      <div class="row flex align-center space-around no-margin-bottom">
        <div class="col m6 s12">
          @php dynamic_sidebar('footer-utility-left') @endphp
        </div>
        <div class="footer-utility-right col m12 s12 flex align-center flex-end">
          @php dynamic_sidebar('footer-utility-right') @endphp
          <p class="copyright">&copy; {!! current_time('Y') !!} RTP</p>
        </div>
      </div>
    </div>
  </div>
</footer>
