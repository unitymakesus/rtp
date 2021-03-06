<header class="banner header-inline" role="banner">
  @include ('partials.announcements.global-site-announcement')
  <section class="topbar-wrapper">
    <div class="topbar container-wide">
      @if (has_nav_menu('top_bar'))
        <div class="topbar-menu-wrapper flex flex-center space-between">
          <div class="topnav-wrapper flex flex-center space-between">
            <img class="rtp-logo" src="@asset('images/rtp-triangle.svg')" alt="Research Triangle Park" />
            <div class="menu-trigger-wrapper hide-on-large-only">
              <button class="btn-topnav-toggle" id="topbar-menu-trigger" aria-label="Show RTP subsite menu" aria-expanded="false" aria-controls="menu-global">
                <i class="material-icons" aria-hidden="true">add</i>
              </button>
            </div>
            <div class="topbar-menu flex flex-center space-between">
              {!! wp_nav_menu(['theme_location' => 'top_bar', 'container' => FALSE, 'menu_class' => 'flex flex-center space-around']) !!}
            </div>
          </div>
          @include('partials.searchform')
        </div>
      @endif
    </div>
  </section>

  <nav class="nav-primary" role="navigation">
    <div class="navbar flex flex-center space-between container-wide">
      <a class="logo" href="{{ home_url('/') }}" rel="home">
        @if (has_custom_logo())
          @php
            $custom_logo_id = get_theme_mod( 'custom_logo' );
            $logo = wp_get_attachment_image_src( $custom_logo_id , 'rtp-logo' );
            $logo_2x = wp_get_attachment_image_src( $custom_logo_id, 'rtp-logo-2x' );
          @endphp
          <img src="{{ $logo[0] }}"
               srcset="{{ $logo[0] }} 1x, {{ $logo_2x[0] }} 2x"
               alt="{{ get_bloginfo('name', 'display') }}"
               width="{{ $logo[1] }}" height="{{ $logo[2] }}" />
        @else
          {{ get_bloginfo('name', 'display') }}
        @endif
      </a>
      @if (has_nav_menu('primary_navigation'))
        <div class="menu-trigger-wrapper hide-on-large-only">
          <button class="btn-menu-toggle" id="menu-trigger" aria-label="Show navigation menu" aria-expanded="false" aria-controls="menu-main-menu">
            <i class="material-icons" aria-hidden="true">menu</i>
          </button>
        </div>
        <div class="navbar-menu flex flex-center space-between">
          {!! wp_nav_menu(['theme_location' => 'primary_navigation', 'container' => FALSE, 'menu_class' => 'flex flex-center space-between']) !!}
        </div>
      @endif
    </div>
  </nav>
  @include ('partials.announcements.local-site-announcement')
</header>
