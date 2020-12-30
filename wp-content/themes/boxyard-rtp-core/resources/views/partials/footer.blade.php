<footer class="content-info page-footer" role="contentinfo">
  <div class="footer-content row flex space-between align-center">
    <div class="footer-left col m4 s12">
      @php dynamic_sidebar('footer-left') @endphp
    </div>
    <div class="footer-center col m4 s12">
      @php dynamic_sidebar('footer-center') @endphp
    </div>
    <div class="footer-right col m4 s12">
      @php dynamic_sidebar('footer-right') @endphp
    </div>
  </div>

  <div class="footer-copyright row flex space-between">
    <div class="footer-left col m6 s12">
      @php dynamic_sidebar('footer-utility-left') @endphp
    </div>
    <div class="footer-right col m6 s12">
      @php dynamic_sidebar('footer-utility-right') @endphp
    </div>
  </div>

</footer>
