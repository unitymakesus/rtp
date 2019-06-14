[wpbb-if post:featured_image]
<div class="uabb-post-thumbnail uabb-blog-post-section">
	[wpbb post:featured_image size="large" display="tag" linked="yes"]
</div>
[/wpbb-if]

<h3 class="uabb-post-heading uabb-blog-post-section">[wpbb post:link text="title"]</h3>

	<h5 class="uabb-post-meta uabb-blog-post-section">
		By<span class="uabb-posted-by"> [wpbb post:author_name link="yes"] </span> | <span class="uabb-meta-date"> [wpbb post:date format="F j, Y"] </span>
	</h5>

	<div class="uabb-blog-posts-description uabb-blog-post-section uabb-text-editor">
		[wpbb post:excerpt length="55" more="..."]
	</div>

	<p class="uabb-read-more-text">
		[wpbb post:link text="custom" custom_text="Read More »"]
	</p>
