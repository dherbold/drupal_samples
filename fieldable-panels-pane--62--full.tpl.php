<div class="<?php print $classes; ?>"<?php print $attributes; ?>>
<style>
	.usnewscontainer {
		min-height: 200px;
	}
	.usnewscontainer h1 {
		display: inline-block;
    	padding: 15px 0 0 30px;
	}
	.usnewsbannerbadge {
		vertical-align: middle;
		display: inline;
		float: left;
	}

	@media (max-width: 650px) {
		.usnewscontainer h1 {
			display: inline;
			padding-left: 0;
			font-size: 42px;
			}
		.usnewscontainer {
			min-height: 120px;
			}
		.usnewsbannerbadge {margin-right: 20px;}
	}
</style>
<div class="usnewscontainer">
	<img class="usnewsbannerbadge" src="/<?php echo drupal_get_path('theme', 'innovationchild'); ?>/images/usnews-head-badge.png">
	<div class="usnewstitlecontainer">
		<?php print render($elements['title']); ?>
		<?php print render($title_suffix); ?>
		<?php print render($content); ?>
	</div>
</div>
</div>