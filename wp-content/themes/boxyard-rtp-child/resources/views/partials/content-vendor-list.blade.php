@php

$categories = get_terms([
  'taxonomy'   => 'vendor_category',
  'hide_empty' => false,
]);

$prompts = get_terms([
  'taxonomy'   => 'vendor_prompt_question',
  'hide_empty' => false,
]);

@endphp

<section class="vendor-list">
  <div class="container-wide">
    @if ($intro = get_field('vendor_filter_intro'))
      <div class="row">
        <div class="col m8 vendor-list__intro">
          {!! $intro !!}
        </div>
      </div>
    @endif

    <div class="vendor-list-grid">
      <form class="vendor-list-filters">
        <fieldset>
          <legend class="label">{{ __('Filter By', 'sage') }}</legend>
          @if ($categories)
            <div class="vendor-list-filters__filter">
              <label for="js-filter-category" class="screen-reader-text">{{ __('Category') }}</label>
              <select name="vendor-categories" id="js-filter-category">
                <option value="">{{ __('Select a category', 'sage') }}</option>
                @foreach ($categories as $category)
                  <option value="{{ $category->slug }}">{{ $category->name }}</option>
                @endforeach
              </select>
            </div>
          @endif
          <div class="vendor-list-filters__filter">
            <label for="js-filter-prompt" class="screen-reader-text">{{ __('Life is like... (select an answer to this question)', 'sage') }}</label>
            <select name="vendor-prompts" id="js-filter-prompt">
              <option value="">{{ __('Life is like...', 'sage') }}</option>
                @foreach ($prompts as $prompt)
                  <option value="{{ $prompt->name }}">{{ $prompt->name }}</option>
                @endforeach
              <option value="surprises">{{ __('Surprises', 'sage') }}</option>
            </select>
          </div>
          <a role="button" href="#" class="vendor-list-filters__random text-white" id="js-filter-randomize">
            <img src="@asset('images/dice.svg')" alt="{{ __('Pair of dice.') }}" />
            {{ __('I’m feeling lucky! Please choose a random vendor for me.', 'sage') }}
          </a>
          <div class="margin-top">
            <a role="button" href="#" class="vendor-list-filters__reset btn-secondary" id="js-filter-reset">
              {{ __('Reset', 'sage') }}
            </a>
          </div>
        </fieldset>
      </form>
      @foreach ($vendors as $vendor)
        @php
          $category = App\get_vendor_term($vendor->ID, 'vendor_category');
          $prompts = get_the_term_list($vendor->ID, 'vendor_prompt_question', '', ', ');
        @endphp
        <div class="vendor-list__vendor-box" data-category="{{ $category }}" data-prompt="{{ strip_tags($prompts) }}">
          <div class="vendor-content">
            @if ($wayfinding_icon_url = get_field('vendor_wayfinding_icon', $vendor))
              <img class="vendor-icon" src="{{ $wayfinding_icon_url }}" alt="" />
            @endif
            <a href="{{ get_the_permalink($vendor) }}" class="a11y-link-wrap">
              <h3 class="h4">{{ $vendor->post_title }}</h3>
            </a>
            {!! get_field('vendor_short_description', $vendor) !!}
          </div>
          @if (has_post_thumbnail($vendor))
          <div class="vendor-img">
            <div class="vendor-img__default">
              {!! get_the_post_thumbnail($vendor, 'medium') !!}
            </div>
            @if ($underlay_image = get_field('vendor_featured_image_underlay', $vendor))
              <div class="vendor-img__interact">
                {!! wp_get_attachment_image($underlay_image, 'medium', false, ['alt' => '']) !!}
              </div>
            @endif
          </div>
          @endif
        </div>
      @endforeach
    </div>
  </div>
</section>
