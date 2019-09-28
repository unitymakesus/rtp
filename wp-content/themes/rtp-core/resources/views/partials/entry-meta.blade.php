@php
  $topic_list = wp_get_post_terms(get_the_id(), 'category', array('fields' => 'all'));
@endphp
<div class="meta">
  <span class="label">
    <svg role="img" aria-labelledby="svg-published" class="meta-icon" xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" viewBox="0 0 299.998 299.998" style="enable-background:new 0 0 299.998 299.998;" xml:space="preserve">
      <title id="svg-published">Published</title>
  		<path d="M149.997,0C67.157,0,0.001,67.158,0.001,149.995s67.156,150.003,149.995,150.003s150-67.163,150-150.003
  			S232.836,0,149.997,0z M160.355,168.337c-0.008,0.394-0.067,0.788-0.122,1.183c-0.039,0.296-0.057,0.599-0.124,0.89
  			c-0.067,0.303-0.182,0.602-0.28,0.905c-0.117,0.366-0.226,0.731-0.379,1.076c-0.029,0.06-0.039,0.124-0.065,0.184
  			c-0.226,0.482-0.488,0.934-0.775,1.362c-0.018,0.026-0.042,0.052-0.06,0.078c-0.327,0.48-0.7,0.916-1.092,1.325
  			c-0.109,0.112-0.22,0.213-0.335,0.319c-0.345,0.329-0.708,0.63-1.094,0.905c-0.119,0.086-0.233,0.176-0.358,0.259
  			c-0.495,0.324-1.014,0.609-1.554,0.843c-0.117,0.052-0.239,0.083-0.358,0.13c-0.456,0.176-0.918,0.322-1.395,0.433
  			c-0.171,0.041-0.34,0.078-0.514,0.109c-0.612,0.112-1.232,0.189-1.86,0.189c-0.127,0-0.257-0.039-0.384-0.044
  			c-0.602-0.023-1.198-0.07-1.771-0.192c-0.179-0.039-0.355-0.117-0.534-0.166c-0.534-0.145-1.056-0.306-1.554-0.529
  			c-0.057-0.029-0.117-0.034-0.174-0.06l-57.515-27.129c-5.182-2.443-7.402-8.626-4.959-13.808
  			c2.443-5.179,8.626-7.402,13.808-4.959l42.716,20.144V62.249c0-5.729,4.645-10.374,10.374-10.374s10.374,4.645,10.374,10.374
  			V168.15h0.002C160.373,168.212,160.355,168.274,160.355,168.337z"/>
    </svg>

    <time class="date updated published" datetime="{{ get_post_time('c', true) }}" itemprop="datePublished">{{ get_the_date('F j, Y') }}</time>
  </span>

  <span class="label">
    <svg role="img" aria-labelledby="svg-author" class="meta-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 300 300" style="enable-background:new 0 0 299.998 299.998;" xml:space="preserve">
      <title id="svg-author">Author</title>
      <path d="M149.996 0C67.157 0 .001 67.161.001 149.997S67.157 300 149.996 300s150.003-67.163 150.003-150.003S232.835 0 149.996 0zm71.306 107.945l-14.247 14.247-29.001-28.999-11.002 11.002 29.001 29.001-71.132 71.126-28.999-28.996-11.002 11.002 28.999 28.999-7.088 7.088-.135-.135a5.612 5.612 0 0 1-3.582 2.575l-27.043 6.03a5.61 5.61 0 0 1-5.197-1.512 5.613 5.613 0 0 1-1.512-5.203l6.027-27.035a5.631 5.631 0 0 1 2.578-3.582l-.137-.137L192.3 78.941a4.304 4.304 0 0 1 6.082.005l22.922 22.917a4.302 4.302 0 0 1-.002 6.082z"/>
    </svg>

    <span class="byline author vcard" rel="author">{{ get_the_author() }}</span>
  </span>

  @if (!empty($topic_list))
    @php
      foreach ($topic_list as &$topic) :
        $topic = '<span itemprop="about"><a href="' . get_term_link($topic->term_id) . '">' . $topic->name . '</a></span>';
      endforeach;
    @endphp
  <span class="label">
    <svg role="img" aria-labelledby="svg-category" class="meta-icon" xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" viewBox="0 0 60 60" style="enable-background:new 0 0 60 60;" xml:space="preserve">
      <title id="svg-category">Category</title>
      <g>
      	<path d="M14,23.5c-0.254,0-0.479,0.172-0.545,0.417L2,52.5v1c0,0.734-0.047,1,0.565,1h44.759c1.156,0,2.174-0.779,2.45-1.813
      		L60,24.5c0,0,0-0.625,0-1H14z"/>
      	<path d="M12.731,21.5H53h1v-6.268c0-1.507-1.226-2.732-2.732-2.732H26.515l-5-7H2.732C1.226,5.5,0,6.726,0,8.232v41.796
      		l10.282-26.717C10.557,22.279,11.575,21.5,12.731,21.5z"/>
      </g>
      <g>
    </svg>

    {!! implode(', ', $topic_list) !!}
  </span>
  @endif
</div>
