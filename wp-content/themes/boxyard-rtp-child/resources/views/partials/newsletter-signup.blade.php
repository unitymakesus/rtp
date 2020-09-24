<section class="footer-signup mix-blend-mode">
  <div class="container-wide">
    <div class="row">
      <div class="col s12 m8">
        <h2>{{ __('mailBOX Sign-Up', 'sage') }}</h2>
        <p class="screen-reader-text">{{ __('Sign up for our Mailchimp newsletter.', 'sage') }}</p>
        <p>{{ __('For the trendsetters, the first-to-knows, and the go-to person in the friend group with a pocket-full of insiders.', 'sage') }}</p>
        {!! gravity_form(1, false, false, false, false, true) !!}
      </div>
    </div>
  </div>
</section>
