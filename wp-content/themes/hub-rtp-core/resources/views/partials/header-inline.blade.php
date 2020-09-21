<header class="banner header-inline" role="banner">
  <nav class="nav-primary">
    <div class="navbar container-wide flex flex-center space-between">
      <a class="logo" href="{{ home_url('/') }}" rel="home">
        @if (has_custom_logo())
          @php
            $custom_logo_id = get_theme_mod( 'custom_logo' );
            $logo = wp_get_attachment_image_src( $custom_logo_id , 'logo' );
            $logo_2x = wp_get_attachment_image_src( $custom_logo_id, 'logo-2x' );
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
          <button class="btn-menu-toggle" id="menu-trigger" aria-label="Show navigation menu" aria-expanded="false">
            <i class="material-icons" aria-hidden="true">menu</i>
          </button>
        </div>
        <div class="navbar-menu flex flex-center space-between" role="navigation">
          {!! wp_nav_menu([
            'theme_location' => 'primary_navigation',
            'container'      => FALSE,
            'menu_class'     => 'flex flex-center space-between',
            'depth'          => 2
          ]) !!}
        @endif
      </div>
    </div>
  </nav>
</header>
@if ( !is_front_page() && function_exists( 'breadcrumb_trail' ) )
  <div class="breadcrumbs">
    <div class="container">
      @php breadcrumb_trail() @endphp
    </div>
  </div>
@endif
