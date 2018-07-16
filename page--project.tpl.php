<?php

/**
 * @file
 * Bartik's theme implementation to display a single Drupal page.
 *
 * The doctype, html, head, and body tags are not in this template. Instead
 * they can be found in the html.tpl.php template normally located in the
 * core/modules/system directory.
 *
 * Available variables:
 *
 * General utility variables:
 * - $base_path: The base URL path of the Drupal installation. At the very
 *   least, this will always default to /.
 * - $directory: The directory the template is located in, e.g. modules/system
 *   or themes/bartik.
 * - $is_front: TRUE if the current page is the front page.
 * - $logged_in: TRUE if the user is registered and signed in.
 * - $is_admin: TRUE if the user has permission to access administration pages.
 * - $
 *
 * Site identity:
 * - $front_page: The URL of the front page. Use this instead of $base_path,
 *   when linking to the front page. This includes the language domain or
 *   prefix.
 * - $logo: The path to the logo image, as defined in theme configuration.
 * - $site_name: The name of the site, empty when display has been disabled
 *   in theme settings.
 * - $site_slogan: The slogan of the site, empty when display has been disabled
 *   in theme settings.
 * - $hide_site_name: TRUE if the site name has been toggled off on the theme
 *   settings page. If hidden, the "element-invisible" class is added to make
 *   the site name visually hidden, but still accessible.
 * - $hide_site_slogan: TRUE if the site slogan has been toggled off on the
 *   theme settings page. If hidden, the "element-invisible" class is added to
 *   make the site slogan visually hidden, but still accessible.
 *
 * Navigation:
 * - $main_menu (array): An array containing the Main menu links for the
 *   site, if they have been configured.
 * - $main_menu_expanded (array): An array containing 2 depths of the Main menu links
 *   for the site, if they have been configured.
 * - $secondary_menu (array): An array containing the Secondary menu links for
 *   the site, if they have been configured.
 * - $breadcrumb: The breadcrumb trail for the current page.
 *
 * Page content (in order of occurrence in the default page.tpl.php):
 * - $title_prefix (array): An array containing additional output populated by
 *   modules, intended to be displayed in front of the main title tag that
 *   appears in the template.
 * - $title: The page title, for use in the actual HTML content.
 * - $title_suffix (array): An array containing additional output populated by
 *   modules, intended to be displayed after the main title tag that appears in
 *   the template.
 * - $messages: HTML for status and error messages. Should be displayed
 *   prominently.
 * - $tabs (array): Tabs linking to any sub-pages beneath the current page
 *   (e.g., the view and edit tabs when displaying a node).
 * - $action_links (array): Actions local to the page, such as 'Add menu' on
 *   the menu administration interface.
 * - $feed_icons: A string of all feed icons for the current page.
 * - $node: The node entity, if there is an automatically-loaded node
 *   associated with the page, and the node ID is the second argument
 *   in the page's path (e.g. node/12345 and node/12345/revisions, but not
 *   comment/reply/12345).
 *
 * Regions:
 * - $page['content']: The main content of the current page.
 *
 * @see template_preprocess()
 * @see template_preprocess_page()
 * @see template_process()
 * @see bartik_process_page()
 * @see html.tpl.php
 *
 * @ingroup themeable
 */

// Set node array in one place:
if (is_numeric(arg(1))) {
    $node_info = $variables['page']['content']['system_main']['nodes'][arg(1)];
} else {
    $node_info = array();
}

// Add subsection of $page['content'] for metatags
if (module_exists('metatag')) {
    print render($page['content']['metatags']);
}

 $text_class = 'fp-headline-white';
 if (isset($node->field_project_headline_black[LANGUAGE_NONE][0]['value']) && $node->field_project_headline_black[LANGUAGE_NONE][0]['value'] == 1 ) :
        $text_class = 'fp-headline-black';
 endif;

//Processing image so it's associated with a style and doesn't load the entire uploaded image.

$image_uri      = $node->field_hero_image_proj['und'][0]['uri']; // or any public://my_image
$style          = 'webspark_hero';
$derivative_uri = image_style_path($style, $image_uri);
$success        = file_exists($derivative_uri) || image_style_create_derivative(image_style_load($style), $image_uri, $derivative_uri);
$new_image_url  = file_create_url($derivative_uri);

//Gigya variables for social sharing icons

$project_description  = $node_info['field_featured_teaser_text']['#items'][0]['value'];
$thumbUrl             = isset($node->field_hero_image_proj[LANGUAGE_NONE][0]['uri']) ? image_style_url('asunews_thumbnail', $node->field_hero_image_proj[LANGUAGE_NONE][0]['uri']) : '';
$project_url          = $GLOBALS['base_url'] . '/' . drupal_get_path_alias('node/' . $node->nid);
$project_title        = $title;
$nid                  = $node->nid;


$short_url = shorten_url($original = $project_url, $service = 'goo.gl');

$project_right_html = views_embed_view('projects_and_impact', 'block_1');
$project_left_html = views_embed_view('projects_and_impact', 'block_2');

?>

<script type="text/javascript">ASUFaceBookShare();</script>

<div id="page-wrapper">
  <div id="page">

  <!-- Page Header -->
  <header id="header">
  	<div class="container">
  		<div class="row">
  			<div class="column col-md-12">
					<?php print render($page['header']); ?>
					<?php if ($site_name): ?>
                      <div class="header__sitename<?php if ($hide_site_name) { print ' element-invisible'; } ?>"><span><?php print $site_name; ?></span>
                      </div>
					<?php endif; ?>
				</div>
			</div>
		</div>
  </header><!-- /.header -->


	<!-- Nav Bar -->
	<div id="ASUNavMenu" class="navmenu">
		<div class="container">
      <!--Commented to work with mega menu-->
                     <nav class="navbar-collapse collapse">
					<?php print render($page['menu']); ?>
			</nav><!-- /#navbar -->
		</div><!-- /.container -->
	</div><!-- /.navmenu -->

    <!-- Page Main -->
  <div id="main-wrapper" class="clearfix">
    <div id="main" class="clearfix">
      <a id="main-content"></a>
      <div class="project-banner"
                         style="background-image:url(<?php echo $new_image_url; ?>)">
                           
                         
        <div class="col-md-12">
          <div class="container">
            <div class="row">
                <h1 id="page-title" class="title">
                            <?php if (isset($node_info['field_project_headline']['#items'][0]['value'])): ?>
                              <span class="<?php print $text_class?>"><?php print render($node_info['field_project_headline']['#items'][0]['value']); ?></span>
                              <?php endif; ?>
                            </h1>
                          </div>      
                        </div>  
                      </div>
                    </div>
    <div id="top-content" class="column container">


      <?php if ($messages): ?>
        <div id="messages">
          <?php print $messages; ?>
        </div>
      <?php endif; ?>

      <?php if ($tabs): ?>
        <div id="tabs">
          <?php print render($tabs); ?>
        </div>
      <?php endif; ?>

      <?php if ($action_links): ?>
        <div id="action-links">
          <?php print render($action_links); ?>
        </div>
      <?php endif; ?>
    </div> 
    <!-- /#top-content -->

    <!--Start project content-->
  <div class="container">
    <?php print theme('breadcrumb', array('breadcrumb' => drupal_get_breadcrumb())); ?>
			<div class="row">
				            <div class="col-md-8">
                      <div id="proj-crumb">
                        <?php print theme('breadcrumb', array('breadcrumb' => drupal_get_breadcrumb())); ?>
                        <?php $block = block_load('easy_breadcrumb','easy_breadcrumb'); $render_block = _block_get_renderable_array(_block_render_blocks(array($block)));$output = drupal_render($render_block); print $output; ?>
                      </div>
                    </div>
                      <div class="col-md-4">
                        <div class="share-links solutions">                           
                            <a onclick="ga('send', 'social', 'Twitter', 'tweet', '<?php echo $project_url?>');" href="#" title="Twitter" aria-label="Twitter" class="js-twittershare" data-ua-image="<?php print $thumbUrl?>"
                               data-ua-description="<?php print $project_description?>" data-ua-linkback="<?php print $short_url?>"
                               data-ua-title="<?php print $project_title?>"><i class="fa fa-twitter"></i></a>                           
                            <a onclick="ga('send', 'social', 'Facebook', 'share', '<?php echo $project_url?>');" class="js-fbshare" href="#" title="Facebook" aria-label="Facebook"
                                 data-ua-image="<?php print $thumbUrl?>"
                               data-ua-description="<?php print $project_description?>" data-ua-linkback="<?php print $project_url?>"
                               data-ua-title="<?php print $project_title?>"><i class="fa fa-facebook"></i></a>                                                           
                             <a onclick="ga('send', 'social', 'Email', 'Sent Email', '<?php echo $project_url?>');" href="mailto:?subject=<?php print $project_title?>&amp;body=Here is a link to <?php print $project_title?>: <?php print $project_url?>" title="Email" aria-label="Email"><i class="fa fa-envelope"></i></a>                          
                        </div>
                      </div>
			</div>
      <div class="row">
                    <div class="col-md-4">
                      <?php print $project_left_html; ?>                     
                    </div>
                    <div class="col-md-8">
                      <?php print $project_right_html; ?>
                    </div>
      </div>
      <!-- /#page-content -->
		</div>
    <!-- /#content -->

    </div>
  </div> <!-- /#main, /#main-wrapper -->

  <!-- Page Footer -->
  <footer id="page-footer">
    <div class="container">
      <div class="row row-full">
      	<?php print render($page['footer']); ?>
      </div>
    </div>
  </footer><!-- /#footer -->

  <?php print render($page['closure']); ?>

  </div>
</div>
<script type="text/javascript">



</script>
<!-- /#page, /#page-wrapper -->