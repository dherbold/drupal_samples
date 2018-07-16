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

?>

<div id="page-wrapper">
  <div id="page">

    <!-- Page Header -->
    <header id="header">
      <div class="container">
        <div class="row">
          <div class="column col-md-12">
            <?php print render($page['header']); ?>
            <?php if ($site_name): ?>
              <h1 class="header__sitename<?php if ($hide_site_name) {
    print ' element-invisible';
} ?>">
                <a href="<?php print $front_page; ?>" title="<?php print t('Home'); ?>" rel="home"><span><?php print $site_name; ?></span></a>
              </h1>
            <?php endif; ?>
          </div>
        </div>
      </div>
    </header>
    <!-- /.header -->


    <!-- Nav Bar -->
    <div id="ASUNavMenu" class="navmenu">
      <div class="container">
        <!--Commented to work with mega menu-->
        <nav class="navbar-collapse collapse">
          <?php print render($page['menu']); ?>
        </nav>
        <!-- /#navbar -->
      </div>
      <!-- /.container -->
    </div>
    <!-- /.navmenu -->


    <!-- PROGRAM DECIDER - UNDERGRADUATE or GRADUATE -->
    <?php if (isset($node_info['field_degree_type']['#items'][0]['value'])): ?>
       <?php $program_decider_value = ($node_info['field_degree_type']['#items'][0]['value']); ?>
        <?php if ($program_decider_value == 'Undergraduate'): ?>
            <!-- undergraduate formatting -->

            <!-- Page Main Undergraduate -->
            <div id="main-wrapper" class="clearfix">
              <div id="main" class="clearfix">
                <a id="main-content"></a>

                <div class="asu-degree-banner-image"
                     style="background-image:url(/sites/default/files/<?php echo $node_info['field_asu_banner_image']['#items'][0]['filename']; ?>)">
                  <div class="container">
                    <div class="row">
                      <div class="col-md-12">
                        <?php if (($no_panels || $always_show_page_title) && $title): ?>
                          <h1 id="page-title" class="title">
                            <?php print $title; ?>
                            <?php if (isset($node_info['field_asu_degree']['#items'][0]['value'])): ?>
                              (<?php print render($node_info['field_asu_degree']['#items'][0]['value']); ?>)
                            <?php endif; ?>
                            <!-- Displaying 'Accelerated Degree' field if true, displaying nothing if false -->
                            <?php if (isset($node_info['field_asu_degree_acc_program']['#items'][0]['value'])): ?>
                              <?php $accelerated_degree_value = ($node_info['field_asu_degree_acc_program']['#items'][0]['value']); ?>
                              <?php if ($accelerated_degree_value == '1'): ?>
                                <br>
                                <i class="fa fa-location-arrow"></i>
                                <span class="asu-degrees-program-flag">Accelerated Program</span>
                              <?php else: ?>
                                <!-- do nothing, it's not an accelerated degree -->
                              <?php endif; ?>
                            <?php endif; ?>
                            <!-- Displaying 'Concurrent Degree' field if true, displaying nothing if false -->
                            <?php if (isset($node_info['field_asu_degree_conc_program']['#items'][0]['value'])): ?>
                              <?php $concurrent_degree_value = ($node_info['field_asu_degree_conc_program']['#items'][0]['value']); ?>
                              <?php if ($concurrent_degree_value == '1'): ?>
                                <?php if ($accelerated_degree_value == '1'): ?>
                                  <i class="fa fa-star"></i>
                                  <span class="asu-degrees-program-flag">Concurrent Program</span>
                                <?php else: ?>
                                  <br>
                                  <i class="fa fa-star"></i>
                                  <span class="asu-degrees-program-flag">Concurrent Program</span>
                                <?php endif; ?>
                              <?php else: ?>
                                <!-- do nothing, it's not a concurrent degree -->
                              <?php endif; ?>
                            <?php endif; ?>
                            <!-- Displaying 'New Degree' field if true, displaying nothing if false -->
                            <?php if (isset($node_info['field_asu_degree_new_program']['#items'][0]['value'])): ?>
                              <?php $new_degree_value = ($node_info['field_asu_degree_new_program']['#items'][0]['value']); ?>
                              <?php if ($new_degree_value == '1'): ?>
                                <?php if (($accelerated_degree_value || $concurrent_degree_value) == '1'): ?>
                                  <i class="fa fa-retweet"></i>
                                  <span class="asu-degrees-program-flag">New Program</span>
                                <?php else: ?>
                                  <br>
                                  <i class="fa fa-retweet"></i>
                                  <span class="asu-degrees-program-flag">New Program</span>
                                <?php endif; ?>
                              <?php else: ?>
                                <!-- do nothing, it's not a new degree -->
                              <?php endif; ?>
                            <?php endif; ?>
                          </h1>
                        <?php endif; ?>
                      </div>
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

              <!--Start undergrad degree content-->
              <?php print theme('breadcrumb', array('breadcrumb' => drupal_get_breadcrumb())); ?>
               <div class="container">

                <!-- Start optional description video display -->
                <?php if (isset($node_info['field_asu_degree_grad_desc_video']['#items'][0]['safe_value'])): ?>

                  <!-- IF VIDEO IS PRESENT -->
                  <div class="row">
                      <div class="col-md-8">
                        <?php if (isset($node_info['field_asu_degree_short_desc']['#items'][0]['safe_value'])): ?>
                          <div class="asu-degree-short-description">
                            <?php print render($node_info['field_asu_degree_short_desc']['#items'][0]['safe_value']); ?>
                            <!--<div class="asu-degree-read-more">
                              <a href="#degree-collapse" data-toggle="collapse" aria-expanded="false">Read More</a>
                            </div>
                            <div id="degree-collapse" class="collapse">
                            </div>-->
                          </div>
                        <?php elseif (isset($node_info['body'])): ?>
                          <?php print render($node_info['body']); ?>
                        <?php endif; ?>
                      </div>
                      <div class="col-md-4">
                        <?php echo $node_info['field_asu_degree_grad_desc_video']['#items'][0]['safe_value']; ?>
                      </div>
                  </div>

                <?php else: ?>

                  <!-- IF VIDEO IS NOT PRESENT -->
                  <?php if (isset($node_info['field_asu_degree_short_desc']['#items'][0]['safe_value'])): ?>
                    <div class="asu-degree-short-description">
                      <?php print render($node_info['field_asu_degree_short_desc']['#items'][0]['safe_value']); ?>
                      <!--<div class="asu-degree-read-more">
                        <a href="#degree-collapse" data-toggle="collapse" aria-expanded="false">Read More</a>
                      </div>
                      <div id="degree-collapse" class="collapse">
                      </div>-->
                    </div>
                  <?php elseif (isset($node_info['body'])): ?>
                    <?php print render($node_info['body']); ?>
                  <?php endif; ?>

                <?php endif; ?>
                <!-- End optional description video display -->

                  <div class="row space-bot-lg">
                    <div class="col-sm-6 col-md-4 space-bot-md">
                      <?php if (isset($node_info['field_asu_degree_cta_information']['#items'][0]['url'])): ?>
                        <a href="#asu-rfi-form-data" id="take-me-to-rfi"
                           class="btn btn-gold btn-block btn-lg">Request Information</a>
                      <?php else: ?>
                      <!--// id="take-me-to-rfi"-->
                        <a href="#asu-rfi-form-data" id="take-me-to-rfi"
                           class="btn btn-gold btn-block btn-lg">Request Information</a>
                      <?php endif ?>
                    </div>
                    <div class="col-sm-6 col-md-4 space-bot-md">
                      <?php if (isset($node_info['field_asu_degree_cta_visit']['#items'][0]['url'])): ?>
                        <a href="<?php echo $node_info['field_asu_degree_cta_visit']['#items'][0]['url'] ?>"
                           class="btn btn-gold btn-block btn-lg">Visit ASU</a>
                      <?php else: ?>
                        <a href="https://visit.asu.edu/"
                           class="btn btn-gold btn-block btn-lg">Visit ASU</a>
                      <?php endif ?>
                    </div>
                    <div class="col-sm-6 col-md-4 space-bot-md">
                        
                      <?php if (isset($node_info['field_asu_degree_cta_apply']['#items'][0]['url'])): ?>
                        <a href="<?php echo $node_info['field_asu_degree_cta_apply']['#items'][0]['url'] ?>"
                           class="btn btn-gold btn-block btn-lg">Apply Now</a>
                      <?php else: ?>
                        <a href="https://webapp4.asu.edu/uga_admissionsapp/"
                           class="btn btn-gold btn-block btn-lg">Apply Now</a>
                      <?php endif ?>
                    </div>
                  </div>
              </div>
              <div class="asu-degree-grey-section">
                <div class="container">
                  <div class="row">
                    <div class="col-sm-6 col-md-4">
                      <h2>Degree Offered</h2>

                      <div class="asu-degree-page-degree-offered">
                        <p>
                          <?php if (isset($node_info['field_asu_degree_awarded']['#items'][0]['value'])): ?>
                            <?php print render($node_info['field_asu_degree_awarded']['#items'][0]['value']); ?>
                          <?php endif; ?>
                          <?php if (isset($node_info['field_asu_degree']['#items'][0]['value'])): ?>
                            (<?php print render($node_info['field_asu_degree']['#items'][0]['value']); ?>)
                          <?php endif; ?><br>

                          <!--<?php // if (isset($node_info['field_asu_college']['#items'][0]['value'])): ?>
                            <?php // print render($node_info['field_asu_college']['#items'][0]['value']); ?>
                          <?php // endif; ?>
                          undergrad 
                      -->
                        </p>
                      </div>
                      <p>
                        <strong>Location</strong><br>
                        <?php
                          if (isset($node_info['field_tc_degree_campus']['#items'][0]['value'])) {
                              $c = count($node_info['field_tc_degree_campus']['#items']) - 1;
                              $i = 0;
                              foreach ($node_info['field_tc_degree_campus']['#items'] as $campus) {
                                  $a = true;
                                  switch ($campus['value']) {
                                case 'Tempe':
                                  echo '<a href="//www.asu.edu/tour/tempe/index.html">'.$campus['value'].'</a>';
                                  break;
                                case 'Polytechnic':
                                  echo '<a href="//www.asu.edu/tour/polytechnic/index.html">'.$campus['value'].'</a>';
                                  break;
                                case 'Downtown':
                                  echo '<a href="//www.asu.edu/tour/downtown/index.html">'.$campus['value'].'</a>';
                                  break;
                                case 'West':
                                  echo '<a href="//www.asu.edu/tour/west/index.html">'.$campus['value'].'</a>';
                                  break;
                                case 'Lake Havasu':
                                  echo '<a href="//havasu.asu.edu/">'.$campus['value'].'</a>';
                                  break;
                                case 'Eastern Arizona College':
                                  echo '<a href="//transfer.asu.edu/eac">'.$campus['value'].'</a>';
                                  break;
                                case 'Online':
                                  echo '<a href="//asuonline.asu.edu/">'.$campus['value'].'</a>';
                                  break;
                                //education.asu.edu specific fields ---> Modify through admin/content, execute
                                case 'ASU@Gila Valley':
                                                  echo '<a href="//transfer.asu.edu/thegilavalley">'.$campus['value'].'</a>';
                                                  break;
                                case 'ASU@Yuma':
                                                  echo '<a href="//transfer.asu.edu/asuyuma">'.$campus['value'].'</a>';
                                                  break;
                                case 'Paradise Valley Unified School District':
                                                  echo $campus['value'];
                                                  break;
                                /*case 'Dysart Unified School District':
                                                  echo $campus['value'];
                                                  break;*/
                                case 'Gadsden Elementary School District':
                                                  echo $campus['value'];
                                                  break;
                                case 'Pendergast Elementary School District':
                                                  echo $campus['value'];
                                                  break;
                                case 'Osborn School District':
                                                echo $campus['value'];
                                                break;
                                case 'Tolleson Elementary School District':
                                echo $campus['value'];
                                break;
                                //Check ASU Feeds Parser.  The campus being used doesn't exist.
                                default:
                                  echo 'Campus Not Found';
                                  //$a = false;
                                  echo '<!--'.$campus['value'].'-->';
                                  break;
                              }
                                  if ($i < $c && $a) {
                                      echo ', ';
                                  }
                                  ++$i;
                              }
                          }
                        ?>
                      </p>

                      <h2>Major Map</h2>

                      <p>A major map outlines the degree’s requirements for graduation.</p>
                      <?php if (isset($node_info['field_asu_degree_major_map_url'])): ?>
                        <p><a
                            href="<?php echo $node_info['field_asu_degree_major_map_url']['#items'][0]['url']; ?>"
                            target="_blank">View Major Map</a></p>
                      <?php endif ?>

                      <div class="asu-degree-subplans">
                      <?php if (isset($node_info['field_asu_degree_subplan_url']['#items'])): ?>
                        <div class='asu-degree-sublplans'><p><strong>Subplans</strong><br/></div>
                          <?php foreach ($node_info['field_asu_degree_subplan_url']['#items'] as $sp) {
                              if ($sp['title'] != $sp['url']) {
                                  echo '<a href="'.$sp['url'].'">'.$sp['title'].'</a><br/>';
                              } else {
                                  echo '<a href="'.$sp['url'].'">Online</a><br/>';
                              }
                          }
                        echo '</p>';
                      endif ?>
                      </div>
                    </div>
                    <div class="col-sm-6 col-md-4">
                      <h2>Application Requirements</h2>

                        <?php if (isset($node_info['field_asu_degree_addl_req']['#items'][0]['safe_value'])): ?>
                          <p>
                            <?php print render($node_info['field_asu_degree_addl_req']['#items'][0]['safe_value']); ?>
                          </p>
                        <?php endif ?>

                        All students are required to meet general university admission
                        requirements.<br>
                        <a href="https://students.asu.edu/freshman/requirements">Freshman</a><br>
                        <a href="https://transfer.asu.edu/apply">Transfer</a><br>
                        <a
                          href="https://students.asu.edu/international/future/undergrad">International</a><br>
                        <a href="https://students.asu.edu/readmission">Readmission</a><br>
                      </p>
                    </div>
                    <div class="col-sm-6 col-md-4">
                      <h2>Paying for College</h2>
                      <p>
                          There are several ways to pay for your degree, and we can help you along the way
                           as you submit applications and decide which path is best for you.
                           Learn more about <a href="../admission/paying-for-college">paying for college</a>.
                      </p>
                <h3>Contact Us</h3>
            <p><i style="font-size:1.2em;" class="fa fa-phone"> </i> 480-965-5555</p>
            <p><i style="font-size:1.2em;" class="fa fa-envelope"> </i> <a href="mailto:ASUeducation@asu.edu">ASUeducation@asu.edu</a></p>

                    <!--  <p>
                        <?php // if (isset($node_info['field_scholarship_link']['#items'][0]['url'])): ?>
                          <a href="<?php // echo $node_info['field_scholarship_link']['#items'][0]['url'] ?>">Scholarships</a><br>
                        <?php // else: ?>
                          <a href="<?php // echo 'https://scholarships.asu.edu/colleges' ?>">Scholarships</a><br>
                        <?php // endif ?>
                        Find and apply for relevant scholarships.
                      </p>

                      <?php // if (isset($node_info['field_asu_degree_wue_available']['#items'][0]['value']) && $node_info['field_asu_degree_wue_available']['#items'][0]['value'] == 1): ?>
                        <p>
                            <a href="<?php //echo 'https://students.asu.edu/admission/wue' ?>">WUE eligible program</a><br>
                          Undergraduate students from western states who enroll in this
                          program are eligible for a discounted tuition rate.
                        </p>
                      <?php // endif ?>

                      <p>
                          <a href="<?php // echo 'https://students.asu.edu/financialaid' ?>">Financial Aid</a><br>
                        ASU has many financial aid options. Almost everyone, regardless
                        of income, can qualify for some form of financial aid. In fact,
                        more than 70 percent of all ASU students receive some form of
                        financial assistance every year.
                      </p>-->
                    </div>
                  </div>
                </div>
              </div>

              <div class="container">
                <?php print render($page['asu_degree_marketing']); ?>
              </div>

              <div class="container space-top-xl space-bot-xl">
                <div class="col-md-8">

                  <?php if (isset($node_info['field_asu_degree_grad_text_area']['#items'][0]['safe_value'])): ?>
                      <?php echo $node_info['field_asu_degree_grad_text_area']['#items'][0]['safe_value']; ?>
                  <?php endif ?>

                  <?php if (isset($node_info['field_asu_degree_career_opps'])): ?>
                    <h2>Career Outlook</h2>
                    <?php if (isset($node_info['field_asu_degree_career_outlook']['#items'][0]['safe_value'])): ?>
                        <?php print render($node_info['field_asu_degree_career_outlook']['#items'][0]['safe_value']); ?>
                    <?php elseif (isset($node_info['field_asu_degree_career_opps'])): ?>
                      <?php print render($node_info['field_asu_degree_career_opps']); ?>
                    <?php endif; ?>
                  <?php endif; ?>
                  <?php if (isset($node_info['field_asu_degree_example_careers'])): ?>
                    <?php if (isset($node_info['field_asu_degree_ex_car_tf']['#items'][0]['value']) && $node_info['field_asu_degree_ex_car_tf']['#items'][0]['value'] == 1): ?>
                      <h2>Example Careers</h2>
                      <?php print render($node_info['field_asu_degree_example_careers']); ?>
                    <?php endif; ?>
                  <?php endif; ?>
                </div>
                <?php if (isset($node_info['field_asu_degree_relatedprograms'])): ?>
                  <div class="col-md-4">
                    <div class="pane-menu-tree">
                      <h4>Related Programs</h4>
                      <?php for ($it = 0; $it < 1000; ++$it) {
    if (isset($node_info['field_asu_degree_relatedprograms'][$it]['#markup'])) {
        $rp_result = $node_info['field_asu_degree_relatedprograms'][$it]['#markup'];
    }
    if (!empty($rp_result)) {
        print $rp_result;
        unset($rp_result);
    } else {
        break 1;
    }
    ?>
                      <br>
                      <?php

} ?>
                    </div>
                  </div>
                <?php endif; ?>

                  <div class="col-md-4">
                    <?php print render($page['asu_degree_sidebar']); ?>
                  </div>
                </div>

                <div class="container">
                  <?php print render($page['prefooter']); ?>
                </div>

              </div>
            </div>
            <!-- /#main, /#main-wrapper -->
 <?php elseif ($program_decider_value == 'Undergraduate Minors and Certificates'): ?>
            <!-- undergraduate minors and certs formatting -->

            <!-- Page Main Undergraduate -->
            <div id="main-wrapper" class="clearfix">
              <div id="main" class="clearfix">
                <a id="main-content"></a>

                <div class="asu-degree-banner-image"
                     style="background-image:url(/sites/default/files/<?php echo $node_info['field_asu_banner_image']['#items'][0]['filename']; ?>)">
                  <div class="container">
                    <div class="row">
                      <div class="col-md-12">
                        <?php if (($no_panels || $always_show_page_title) && $title): ?>
                          <h1 id="page-title" class="title">
                            <?php print $title; ?>
                            <?php if (isset($node_info['field_asu_degree']['#items'][0]['value'])): ?>
                              (<?php print render($node_info['field_asu_degree']['#items'][0]['value']); ?>)
                            <?php endif; ?>
                            <!-- Displaying 'Accelerated Degree' field if true, displaying nothing if false -->
                            <?php if (isset($node_info['field_asu_degree_acc_program']['#items'][0]['value'])): ?>
                              <?php $accelerated_degree_value = ($node_info['field_asu_degree_acc_program']['#items'][0]['value']); ?>
                              <?php if ($accelerated_degree_value == '1'): ?>
                                <br>
                                <i class="fa fa-location-arrow"></i>
                                <span class="asu-degrees-program-flag">Accelerated Program</span>
                              <?php else: ?>
                                <!-- do nothing, it's not an accelerated degree -->
                              <?php endif; ?>
                            <?php endif; ?>
                            <!-- Displaying 'Concurrent Degree' field if true, displaying nothing if false -->
                            <?php if (isset($node_info['field_asu_degree_conc_program']['#items'][0]['value'])): ?>
                              <?php $concurrent_degree_value = ($node_info['field_asu_degree_conc_program']['#items'][0]['value']); ?>
                              <?php if ($concurrent_degree_value == '1'): ?>
                                <?php if ($accelerated_degree_value == '1'): ?>
                                  <i class="fa fa-star"></i>
                                  <span class="asu-degrees-program-flag">Concurrent Program</span>
                                <?php else: ?>
                                  <br>
                                  <i class="fa fa-star"></i>
                                  <span class="asu-degrees-program-flag">Concurrent Program</span>
                                <?php endif; ?>
                              <?php else: ?>
                                <!-- do nothing, it's not a concurrent degree -->
                              <?php endif; ?>
                            <?php endif; ?>
                            <!-- Displaying 'New Degree' field if true, displaying nothing if false -->
                            <?php if (isset($node_info['field_asu_degree_new_program']['#items'][0]['value'])): ?>
                              <?php $new_degree_value = ($node_info['field_asu_degree_new_program']['#items'][0]['value']); ?>
                              <?php if ($new_degree_value == '1'): ?>
                                <?php if (($accelerated_degree_value || $concurrent_degree_value) == '1'): ?>
                                  <i class="fa fa-retweet"></i>
                                  <span class="asu-degrees-program-flag">New Program</span>
                                <?php else: ?>
                                  <br>
                                  <i class="fa fa-retweet"></i>
                                  <span class="asu-degrees-program-flag">New Program</span>
                                <?php endif; ?>
                              <?php else: ?>
                                <!-- do nothing, it's not a new degree -->
                              <?php endif; ?>
                            <?php endif; ?>
                          </h1>
                        <?php endif; ?>
                      </div>
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

              <!--Start degree content-->
              <?php print theme('breadcrumb', array('breadcrumb' => drupal_get_breadcrumb())); ?>
               <div class="container">

                <!-- Start optional description video display -->
                <?php if (isset($node_info['field_asu_degree_grad_desc_video']['#items'][0]['safe_value'])): ?>

                  <!-- IF VIDEO IS PRESENT -->
                  <div class="row">
                      <div class="col-md-8">
                        <?php if (isset($node_info['field_asu_degree_short_desc']['#items'][0]['safe_value'])): ?>
                          <div class="asu-degree-short-description">
                            <?php print render($node_info['field_asu_degree_short_desc']['#items'][0]['safe_value']); ?>
                            <!--<div class="asu-degree-read-more">
                              <a href="#degree-collapse" data-toggle="collapse" aria-expanded="false">Read More</a>
                            </div>
                            <div id="degree-collapse" class="collapse">
                            </div>-->
                          </div>
                        <?php elseif (isset($node_info['body'])): ?>
                          <?php print render($node_info['body']); ?>
                        <?php endif; ?>
                      </div>
                      <div class="col-md-4">
                        <?php echo $node_info['field_asu_degree_grad_desc_video']['#items'][0]['safe_value']; ?>
                      </div>
                  </div>

                <?php else: ?>

                  <!-- IF VIDEO IS NOT PRESENT -->
                  <?php if (isset($node_info['field_asu_degree_short_desc']['#items'][0]['safe_value'])): ?>
                    <div class="asu-degree-short-description">
                      <?php print render($node_info['field_asu_degree_short_desc']['#items'][0]['safe_value']); ?>
                      <!--<div class="asu-degree-read-more">
                        <a href="#degree-collapse" data-toggle="collapse" aria-expanded="false">Read More</a>
                      </div>
                      <div id="degree-collapse" class="collapse">
                      </div>-->
                    </div>
                  <?php elseif (isset($node_info['body'])): ?>
                    <?php print render($node_info['body']); ?>
                  <?php endif; ?>

                <?php endif; ?>
                <!-- End optional description video display -->

              </div>
              <div class="asu-degree-grey-section">
                <div class="container">
                  <div class="row">
                    <div class="col-sm-6 col-md-4">
                      <h2>Program Offered</h2>

                      <div class="asu-degree-page-degree-offered">
                        <p>
                          <?php if (isset($node_info['field_asu_degree_awarded']['#items'][0]['value'])): ?>
                            <?php print render($node_info['field_asu_degree_awarded']['#items'][0]['value']); ?>
                          <?php endif; ?>
                          <?php if (isset($node_info['field_asu_degree']['#items'][0]['value'])): ?>
                            (<?php print render($node_info['field_asu_degree']['#items'][0]['value']); ?>)
                          <?php endif; ?><br>

                          <!--<?php // if (isset($node_info['field_asu_college']['#items'][0]['value'])): ?>
                            <?php // print render($node_info['field_asu_college']['#items'][0]['value']); ?>
                          <?php // endif; ?>-->
                        </p>
                      </div>
                      <p>
                        <strong>Location</strong><br>
                        <?php
                          if (isset($node_info['field_tc_degree_campus']['#items'][0]['value'])) {
                              $c = count($node_info['field_tc_degree_campus']['#items']) - 1;
                              $i = 0;
                              foreach ($node_info['field_tc_degree_campus']['#items'] as $campus) {
                                  $a = true;
                                  switch ($campus['value']) {
                                case 'Tempe':
                                  echo '<a href="//www.asu.edu/tour/tempe/index.html">'.$campus['value'].'</a>';
                                  break;
                                case 'Polytechnic':
                                  echo '<a href="//www.asu.edu/tour/polytechnic/index.html">'.$campus['value'].'</a>';
                                  break;
                                case 'Downtown':
                                  echo '<a href="//www.asu.edu/tour/downtown/index.html">'.$campus['value'].'</a>';
                                  break;
                                case 'West':
                                  echo '<a href="//www.asu.edu/tour/west/index.html">'.$campus['value'].'</a>';
                                  break;
                                case 'Lake Havasu':
                                  echo '<a href="//havasu.asu.edu/">'.$campus['value'].'</a>';
                                  break;
                                case 'Eastern Arizona College':
                                  echo '<a href="//transfer.asu.edu/eac">'.$campus['value'].'</a>';
                                  break;
                                case 'Online':
                                  echo '<a href="//asuonline.asu.edu/">'.$campus['value'].'</a>';
                                  break;
                                  //education.asu.edu specific fields ---> Modify through admin/content, execute
                                  case 'ASU@Gila Valley':
                                                    echo '<a href="//transfer.asu.edu/thegilavalley">'.$campus['value'].'</a>';
                                                    break;
                                  case 'ASU@Yuma':
                                                    echo '<a href="//transfer.asu.edu/asuyuma">'.$campus['value'].'</a>';
                                                    break;
                                  case 'Paradise Valley Unified School District':
                                                    echo $campus['value'];
                                                    break;
                                  case 'Dysart Unified School District':
                                                    echo $campus['value'];
                                                    break;
                                  case 'Gadsden Elementary School District':
                                                    echo $campus['value'];
                                                    break;
                                  case 'Pendergast Elementary School District':
                                  echo $campus['value'];
                                  break;
                                  case 'Osborn School District':
                                                  echo $campus['value'];
                                                  break;
                                  case 'Tolleson Elementary School District':
                                                  echo $campus['value'];
                                                  break;
                                //Check ASU Feeds Parser.  The campus being used doesn't exist.
                                default:
                                  echo 'Campus Not Found';
                                  //$a = false;
                                  echo '<!--'.$campus['value'].'-->';
                                  break;
                              }
                                  if ($i < $c && $a) {
                                      echo ', ';
                                  }
                                  ++$i;
                              }
                          }
                        ?>
                      </p>

                      <div class="asu-degree-subplans">
                      <?php if (isset($node_info['field_asu_degree_subplan_url']['#items'])): ?>
                        <div class='asu-degree-sublplans'><p><strong>Subplans</strong><br/></div>
                          <?php foreach ($node_info['field_asu_degree_subplan_url']['#items'] as $sp) {
    if ($sp['title'] != $sp['url']) {
        echo '<a href="'.$sp['url'].'">'.$sp['title'].'</a><br/>';
    } else {
        echo '<a href="'.$sp['url'].'">Online</a><br/>';
    }
}
                        echo '</p>';
                      endif ?>
                      </div>
                    </div>
                    <div class="col-sm-6 col-md-4">
                      <h2>Plan of Study</h2>
                       <p>The plan of study is the required curriculum to complete the program.</p>
                      <?php  if (isset($node_info['field_asu_degree_cta_visit']['#items'][0]['url'])): ?>
                        <a href="<?php  echo $node_info['field_asu_degree_cta_visit']['#items'][0]['url'] ?>"
              "</i> Plan of Study</a>
                      <?php else: ?>
              <!-- do nothing-->
                      <?php  endif ?>

                    </div>
                    <div class="col-sm-6 col-md-4">
                <h2>Contact Us</h2>
            <p><i style="font-size:1.2em;" class="fa fa-phone"> </i> 480-965-5555</p>
            <p><i style="font-size:1.2em;" class="fa fa-envelope"> </i> <a href="mailto:educationadvising@asu.edu">educationadvising@asu.edu</a></p>

                    <!--  <p>
                        <?php // if (isset($node_info['field_scholarship_link']['#items'][0]['url'])): ?>
                          <a href="<?php // echo $node_info['field_scholarship_link']['#items'][0]['url'] ?>">Scholarships</a><br>
                        <?php // else: ?>
                          <a href="<?php // echo 'https://scholarships.asu.edu/colleges' ?>">Scholarships</a><br>
                        <?php // endif ?>
                        Find and apply for relevant scholarships.
                      </p>

                      <?php // if (isset($node_info['field_asu_degree_wue_available']['#items'][0]['value']) && $node_info['field_asu_degree_wue_available']['#items'][0]['value'] == 1): ?>
                        <p>
                            <a href="<?php //echo 'https://students.asu.edu/admission/wue' ?>">WUE eligible program</a><br>
                          Undergraduate students from western states who enroll in this
                          program are eligible for a discounted tuition rate.
                        </p>
                      <?php // endif ?>

                      <p>
                          <a href="<?php // echo 'https://students.asu.edu/financialaid' ?>">Financial Aid</a><br>
                        ASU has many financial aid options. Almost everyone, regardless
                        of income, can qualify for some form of financial aid. In fact,
                        more than 70 percent of all ASU students receive some form of
                        financial assistance every year.
                      </p>-->
                    </div>
                  </div>
                </div>
              </div>

              <div class="container">
                <?php print render($page['asu_degree_marketing']); ?>
              </div>

              <div class="container space-top-xl space-bot-xl">
                <div class="col-md-8">

                  <?php if (isset($node_info['field_asu_degree_grad_text_area']['#items'][0]['safe_value'])): ?>
                      <?php echo $node_info['field_asu_degree_grad_text_area']['#items'][0]['safe_value']; ?>
                  <?php endif ?>

                  <?php if (isset($node_info['field_asu_degree_career_opps'])): ?>
                    <h2>Career Outlook</h2>
                    <?php if (isset($node_info['field_asu_degree_career_outlook']['#items'][0]['safe_value'])): ?>
                        <?php print render($node_info['field_asu_degree_career_outlook']['#items'][0]['safe_value']); ?>
                    <?php elseif (isset($node_info['field_asu_degree_career_opps'])): ?>
                      <?php print render($node_info['field_asu_degree_career_opps']); ?>
                    <?php endif; ?>
                  <?php endif; ?>
                  <?php if (isset($node_info['field_asu_degree_example_careers'])): ?>
                    <?php if (isset($node_info['field_asu_degree_ex_car_tf']['#items'][0]['value']) && $node_info['field_asu_degree_ex_car_tf']['#items'][0]['value'] == 1): ?>
                      <h2>Example Careers</h2>
                      <?php print render($node_info['field_asu_degree_example_careers']); ?>
                    <?php endif; ?>
                  <?php endif; ?>
                </div>
                <?php if (isset($node_info['field_asu_degree_relatedprograms'])): ?>
                  <div class="col-md-4">
                    <div class="pane-menu-tree">
                      <h4>Related Programs</h4>
                      <?php for ($it = 0; $it < 1000; ++$it) {
    if (isset($node_info['field_asu_degree_relatedprograms'][$it]['#markup'])) {
        $rp_result = $node_info['field_asu_degree_relatedprograms'][$it]['#markup'];
    }
    if (!empty($rp_result)) {
        print $rp_result;
        unset($rp_result);
    } else {
        break 1;
    }
    ?>
                      <br>
                      <?php

} ?>
                    </div>
                  </div>
                <?php endif; ?>

                  <div class="col-md-4">
                    <?php print render($page['asu_degree_sidebar']); ?>
                  </div>
                </div>

                <div class="container">
                  <?php print render($page['prefooter']); ?>
                </div>

              </div>
            </div>
            <!-- /#main, /#main-wrapper -->
        <?php elseif ($program_decider_value == 'masters'): ?>
            <!-- Master's formatting -->

            <!-- Page Main Master's -->
            <div id="main-wrapper" class="clearfix">
              <div id="main" class="clearfix">
                <a id="main-content"></a>

                <div class="asu-degree-banner-image"
                     style="background-image:url(/sites/default/files/<?php echo $node_info['field_asu_banner_image']['#items'][0]['filename']; ?>)">
                  <div class="container">
                    <div class="row">
                      <div class="col-md-12">
                        <?php if (($no_panels || $always_show_page_title) && $title): ?>
                          <h1 id="page-title" class="title">
                            <?php print $title; ?>
                            <!-- Displaying 'Accelerated Degree' field if true, displaying nothing if false -->
                            <?php if (isset($node_info['field_asu_degree_acc_program']['#items'][0]['value'])): ?>
                              <?php $accelerated_degree_value = ($node_info['field_asu_degree_acc_program']['#items'][0]['value']); ?>
                              <?php if ($accelerated_degree_value == '1'): ?>
                                <br>
                                <i class="fa fa-location-arrow"></i>
                                <span class="asu-degrees-program-flag">Accelerated Program</span>
                              <?php else: ?>
                                <!-- do nothing, it's not an accelerated degree -->
                              <?php endif; ?>
                            <?php endif; ?>
                            <!-- Displaying 'Concurrent Degree' field if true, displaying nothing if false -->
                            <?php if (isset($node_info['field_asu_degree_conc_program']['#items'][0]['value'])): ?>
                              <?php $concurrent_degree_value = ($node_info['field_asu_degree_conc_program']['#items'][0]['value']); ?>
                              <?php if ($concurrent_degree_value == '1'): ?>
                                <?php if ($accelerated_degree_value == '1'): ?>
                                  <i class="fa fa-star"></i>
                                  <span class="asu-degrees-program-flag">Concurrent Program</span>
                                <?php else: ?>
                                  <br>
                                  <i class="fa fa-star"></i>
                                  <span class="asu-degrees-program-flag">Concurrent Program</span>
                                <?php endif; ?>
                              <?php else: ?>
                                <!-- do nothing, it's not a concurrent degree -->
                              <?php endif; ?>
                            <?php endif; ?>
                            <!-- Displaying 'New Degree' field if true, displaying nothing if false -->
                            <?php if (isset($node_info['field_asu_degree_new_program']['#items'][0]['value'])): ?>
                              <?php $new_degree_value = ($node_info['field_asu_degree_new_program']['#items'][0]['value']); ?>
                              <?php if ($new_degree_value == '1'): ?>
                                <?php if (($accelerated_degree_value || $concurrent_degree_value) == '1'): ?>
                                  <i class="fa fa-retweet"></i>
                                  <span class="asu-degrees-program-flag">New Program</span>
                                <?php else: ?>
                                  <br>
                                  <i class="fa fa-retweet"></i>
                                  <span class="asu-degrees-program-flag">New Program</span>
                                <?php endif; ?>
                              <?php else: ?>
                                <!-- do nothing, it's not a new degree -->
                              <?php endif; ?>
                            <?php endif; ?>
                          </h1>
                        <?php endif; ?>
                      </div>
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

              <!--Start degree content-->
              <?php print theme('breadcrumb', array('breadcrumb' => drupal_get_breadcrumb())); ?>
              <div class="container">

                <!-- Start optional description video display -->
                <?php if (isset($node_info['field_asu_degree_grad_desc_video']['#items'][0]['safe_value'])): ?>

                  <!-- IF VIDEO IS PRESENT -->
                  <div class="row">
                      <div class="col-md-8">
                        <?php if (isset($node_info['field_asu_degree_short_desc']['#items'][0]['safe_value'])): ?>
                          <div class="asu-degree-short-description">
                            <?php print render($node_info['field_asu_degree_short_desc']['#items'][0]['safe_value']); ?>
                            <!--<div class="asu-degree-read-more">
                              <a href="#degree-collapse" data-toggle="collapse" aria-expanded="false">Read More</a>
                            </div>
                            <div id="degree-collapse" class="collapse">
                            </div>-->
                          </div>
                        <?php elseif (isset($node_info['body'])): ?>
                          <?php print render($node_info['body']); ?>
                        <?php endif; ?>
                      </div>
                      <div class="col-md-4">
                        <?php echo $node_info['field_asu_degree_grad_desc_video']['#items'][0]['safe_value']; ?>
                      </div>
                  </div>

                <?php else: ?>

                  <!-- IF VIDEO IS NOT PRESENT -->
                  <?php if (isset($node_info['field_asu_degree_short_desc']['#items'][0]['safe_value'])): ?>
                    <div class="asu-degree-short-description">
                      <?php print render($node_info['field_asu_degree_short_desc']['#items'][0]['safe_value']); ?>
                      <!--<div class="asu-degree-read-more">
                        <a href="#degree-collapse" data-toggle="collapse" aria-expanded="false">Read More</a>
                      </div>
                      <div id="degree-collapse" class="collapse">
                      </div>-->
                    </div>
                  <?php elseif (isset($node_info['body'])): ?>
                    <?php print render($node_info['body']); ?>
                  <?php endif; ?>

                <?php endif; ?>
                <!-- End optional description video display -->

                  <div class="row space-bot-lg">
                    <div class="col-sm-6 col-md-4 space-bot-md">
                    <?php  if (isset($node_info['field_cta_button_program_guide']['#items'][0]['filename'])): ?>
                        <a href="/sites/default/files/<?php echo $node_info['field_cta_button_program_guide']['#items'][0]['filename'] ?>"
                            target="_blank" class="btn btn-blue btn-block btn-lg"><i class="fa fa-file-pdf-o" aria-hidden="true"></i> Program Handbook</a>
                      <?php else: ?>
                        <!-- do nothing -->
                      <?php endif ?>
                    </div>
                    <div class="col-sm-6 col-md-4 space-bot-md">
          <?php if (isset($node_info['field_asu_degree_cta_information']['#items'][0]['url'])): ?>
                      <?php if ($node->nid == 724) : ?>
                        <a href="<?php echo $node_info['field_asu_degree_cta_information']['#items'][0]['url'] ?>" target="_blank"
                           class="btn btn-gold btn-block btn-lg">Request Information</a>
                      <?php else : ?>
                        <a href="#asu-rfi-form-data" id="take-me-to-rfi"
                           class="btn btn-gold btn-block btn-lg">Request Information</a>
                      <?php endif ?>
          <?php else : ?>
                  <?php if ($node->nid == 2756 || $node->nid == 724) : ?>
                        <a href="#asu-rfi-long-form-data"
                           class="btn btn-gold btn-block btn-lg">Request Information</a>
                      <?php else : ?>
                        <a href="#asu-rfi-form-data" id="take-me-to-rfi"
                           class="btn btn-gold btn-block btn-lg">Request Information</a>
                      <?php endif ?>
          <?php endif ?>
                   </div>
                    <div class="col-sm-6 col-md-4 space-bot-md">
                      <?php if ($node->nid == 716) : //this removed the apply now button for this degree program which is no longer active, however the page still attracts RFI's ?>
                      
                        <p>&nbsp;</p>
                        
                      <?php  elseif (isset($node_info['field_asu_degree_cta_apply']['#items'][0]['url'])): ?>
                        <a href="<?php  echo $node_info['field_asu_degree_cta_apply']['#items'][0]['url'] ?>"
                           class="btn btn-gold btn-block btn-lg">Apply Now</a>
                      <?php else: ?>
                        <a href="https://webapp4.asu.edu/dgsadmissions/"
                           class="btn btn-gold btn-block btn-lg">Apply Now</a>
                      <?php endif ?>
                    </div>
                  </div>
              </div>
              <div class="asu-degree-grey-section">
                <div class="container">
                  <div class="row">
                    <div class="col-sm-6 col-md-4">
                      <h2>Degree Offered</h2>

                      <div class="asu-degree-page-degree-offered">
                        <p>
                          <?php if (isset($node_info['field_asu_degree_awarded']['#items'][0]['value'])): ?>
                            <?php print render($node_info['field_asu_degree_awarded']['#items'][0]['value']); ?>
                          <?php endif; ?><br>

                          <?php if (isset($node_info['field_asu_college']['#items'][0]['value'])): ?>
                           <!-- //<?php print render($node_info['field_asu_college']['#items'][0]['value']); ?>//-->
                          <?php endif; ?>
                        </p>
                      </div>
                      <p>
                        <strong>Location</strong><br>
                        <?php
                          if (isset($node_info['field_tc_degree_campus']['#items'][0]['value'])) {
                              $c = count($node_info['field_tc_degree_campus']['#items']) - 1;
                              $i = 0;
                              foreach ($node_info['field_tc_degree_campus']['#items'] as $campus) {
                                  $a = true;
                                  switch ($campus['value']) {
                                case 'Tempe':
                                  echo '<a href="//www.asu.edu/tour/tempe/index.html">'.$campus['value'].'</a>';
                                  break;
                                case 'Polytechnic':
                                  echo '<a href="//www.asu.edu/tour/polytechnic/index.html">'.$campus['value'].'</a>';
                                  break;
                                case 'Downtown':
                                  echo '<a href="//www.asu.edu/tour/downtown/index.html">'.$campus['value'].'</a>';
                                  break;
                                case 'West':
                                  echo '<a href="//www.asu.edu/tour/west/index.html">'.$campus['value'].'</a>';
                                  break;
                                case 'Lake Havasu':
                                  echo '<a href="//havasu.asu.edu/">'.$campus['value'].'</a>';
                                  break;
                                case 'Eastern Arizona College':
                                  echo '<a href="//transfer.asu.edu/eac">'.$campus['value'].'</a>';
                                  break;
                                case 'Online':
                                  echo '<a href="//asuonline.asu.edu/">'.$campus['value'].'</a>';
                                  break;
                                //education.asu.edu specific fields ---> Modify through admin/content, execute
                                case 'ASU@Gila Valley':
                                                  echo '<a href="//transfer.asu.edu/thegilavalley">'.$campus['value'].'</a>';
                                                  break;
                                case 'ASU@Yuma':
                                                  echo '<a href="//transfer.asu.edu/asuyuma">'.$campus['value'].'</a>';
                                                  break;
                                case 'Paradise Valley Unified School District':
                                                  echo $campus['value'];
                                                  break;
                                case 'Dysart Unified School District':
                                                  echo $campus['value'];
                                                  break;
                                case 'Gadsden Elementary School District':
                                                  echo $campus['value'];
                                                  break;
                                case 'Pendergast Elementary School District':
                                  echo $campus['value'];
                                  break;
                                  case 'Osborn School District':
                                                  echo $campus['value'];
                                                  break;
                                  case 'Tolleson Elementary School District':
                                                  echo $campus['value'];
                                                  break;
                                //Check ASU Feeds Parser.  The campus being used doesn't exist.
                                default:
                                  echo 'Campus Not Found';
                                  //$a = false;
                                  echo '<!--'.$campus['value'].'-->';
                                  break;
                              }
                                  if ($i < $c && $a) {
                                      echo ', ';
                                  }
                                  ++$i;
                              }
                          }
                        ?>
                      </p>
                        </div>
                        <div class="col-sm-6 col-md-4">
            <?php if (isset($node_info['field_asu_degree_asuds_url'])): ?>
                      <h2>Plan of Study</h2>

                      <p>The Plan of Study is the required curriculum to complete the program.</p>

                        <p><a
                            href="<?php echo $node_info['field_asu_degree_asuds_url']['#items'][0]['url']; ?>"
                            target="_blank">View Plan of Study</a></p>
                      <?php endif ?>

                      <div class="asu-degree-subplans">
                      <?php if (isset($node_info['field_asu_degree_subplan_url']['#items'])): ?>
                        <div class='asu-degree-sublplans'><p><strong>Subplans</strong><br/></div>
                          <?php foreach ($node_info['field_asu_degree_subplan_url']['#items'] as $sp) {
    if ($sp['title'] != $sp['url']) {
        echo '<a href="'.$sp['url'].'">'.$sp['title'].'</a><br/>';
    } else {
        echo '<a href="'.$sp['url'].'">Online</a><br/>';
    }
}
                        echo '</p>';
                      endif ?>
                      </div>
                    </div>
                    <div class="col-sm-6 col-md-4">

                      <?php if (isset($node_info['field_asu_degree_grad_app']['#items'][0]['safe_value'])): ?>
                          <?php echo $node_info['field_asu_degree_grad_app']['#items'][0]['safe_value']; ?>
                      <?php endif ?>

                    </div>
                    <div class="col-sm-6 col-md-4">
            <h2>Paying for College</h2>
                      <p>
                          There are several ways to pay for your degree, and we can help you along the way
                           as you submit applications and decide which path is best for you.
                           Learn more about <a href="../admission/paying-for-college">paying for college</a>.
                      </p>
            <h2>Contact Us</h2>
            <?php if (isset($node_info['field_online_degree_category']['#items'][0]['value'])): ?>
              <?php $online_decider_value = ($node_info['field_online_degree_category']['#items'][0]['value']); ?>
                <?php if ($online_decider_value == 'online_only'): ?>
            <p><i style="font-size:1.2em;" class="fa fa-phone"> </i> 1-877-326-6744</p>
            <p><i style="font-size:1.2em;" class="fa fa-envelope"> </i> <a href="mailto:gradenrollment@asuonline.asu.edu">gradenrollment@asuonline.asu.edu</a></p>
                <?php elseif ($online_decider_value == 'f2f_only'): ?>
            <p><i style="font-size:1.2em;" class="fa fa-phone"> </i> 602-543-6358</p>
            <p><i style="font-size:1.2em;" class="fa fa-envelope"> </i> <a href="mailto:gradeducation@asu.edu">gradeducation@asu.edu</a></p>
                <?php elseif ($online_decider_value == 'hybrid'): ?>
            <h5 style="margin-bottom: 8px;">iLeadAZ Pathway </h5>
            <p style="margin: 5px;"><i style="font-size:1.2em;" class="fa fa-phone"> </i> 602-543-6358</p>
            <p style="margin: 5px;"><i style="font-size:1.2em;" class="fa fa-envelope"> </i> <a href="mailto:gradeducation@asu.edu">gradeducation@asu.edu</a></p>
            <h5 style="margin-bottom: 8px;">Online Pathway</h5>
            <p style="margin: 5px;"><i style="font-size:1.2em;" class="fa fa-phone"> </i> 1-877-326-6744</p>
            <p style="margin: 5px;"><i style="font-size:1.2em;" class="fa fa-envelope"> </i> <a href="mailto:gradenrollment@asuonline.asu.edu">gradenrollment@asuonline.asu.edu</a></p>
                <?php elseif ($online_decider_value == 'hybrid_2'): ?>
            <h5 style="margin-bottom: 8px;">Tempe Program </h5>
            <p style="margin: 5px;"><i style="font-size:1.2em;" class="fa fa-phone"> </i> 602-543-6358</p>
            <p style="margin: 5px;"><i style="font-size:1.2em;" class="fa fa-envelope"> </i> <a href="mailto:gradeducation@asu.edu">gradeducation@asu.edu</a></p>
            <h5 style="margin-bottom: 8px;">Online Program</h5>
            <p style="margin: 5px;"><i style="font-size:1.2em;" class="fa fa-phone"> </i> 1-877-326-6744</p>
            <p style="margin: 5px;"><i style="font-size:1.2em;" class="fa fa-envelope"> </i> <a href="mailto:gradenrollment@asuonline.asu.edu">gradenrollment@asuonline.asu.edu</a></p>
            <?php endif; ?>
          <?php endif; ?>
                        <!--<p>
                        <?php // if (isset($node_info['field_asu_degree_cta_visit']['#items'][0]['url'])): ?>
                          <a href="<?php // echo $node_info['field_asu_degree_cta_visit']['#items'][0]['url'] ?>"
                             class="btn btn-gold btn-block btn-lg">Schedule a visit</a>
                        <?php // else: ?>
                          <a href="https://visit.asu.edu/"
                             class="btn btn-gold btn-block btn-lg">Schedule a visit</a>
                        <?php // endif ?>
                    </p> -->
                        <!--<?php // if (isset($node_info['field_asu_degree_grad_financing']['#items'][0]['safe_value'])): ?>
                          <?php // echo $node_info['field_asu_degree_grad_financing']['#items'][0]['safe_value']; ?>
                      <?php // endif ?> -->

                    </div>
                  </div>
                </div>
              </div>

              <div class="container">
                <?php print render($page['asu_degree_marketing']); ?>
              </div>

              <div class="container space-top-xl space-bot-xl">
                <div class="col-md-8">

                  <?php if (isset($node_info['field_asu_degree_grad_text_area']['#items'][0]['safe_value'])): ?>
                      <?php echo $node_info['field_asu_degree_grad_text_area']['#items'][0]['safe_value']; ?>
                  <?php endif ?>

                </div>
                <?php if (isset($node_info['field_asu_degree_relatedprograms'])): ?>
                  <div class="col-md-4">
                    <div class="pane-menu-tree">
                      <h4>Related Programs</h4>
                      <?php for ($it = 0; $it < 1000; ++$it) {
    if (isset($node_info['field_asu_degree_relatedprograms'][$it]['#markup'])) {
        $rp_result = $node_info['field_asu_degree_relatedprograms'][$it]['#markup'];
    }
    if (!empty($rp_result)) {
        print $rp_result;
        unset($rp_result);
    } else {
        break 1;
    }
    ?>
                      <br>
                      <?php

} ?>
                    </div>
                  </div>
                <?php endif; ?>

                  <div class="col-md-4">
                    <?php print render($page['asu_degree_sidebar']); ?>
                  </div>
                </div>

                <div class="container">
                  <?php print render($page['prefooter']); ?>
                </div>

              </div>
            </div>
            <!-- /#main, /#main-wrapper -->

<!-- /#page, /#page-wrapper -->

<?php elseif ($program_decider_value == 'Doctorate'): ?>
            <!-- Doctorate's formatting -->

            <!-- Page Main Doctorate -->
            <div id="main-wrapper" class="clearfix">
              <div id="main" class="clearfix">
                <a id="main-content"></a>

                <div class="asu-degree-banner-image"
                     style="background-image:url(/sites/default/files/<?php echo $node_info['field_asu_banner_image']['#items'][0]['filename']; ?>)">

                  <div class="container">
                    <div class="row">
                      <div class="col-md-12">
                        <?php if (($no_panels || $always_show_page_title) && $title): ?>
                          <h1 id="page-title" class="title">
                            <?php print $title; ?>
                            <!-- Displaying 'Accelerated Degree' field if true, displaying nothing if false -->
                            <?php if (isset($node_info['field_asu_degree_acc_program']['#items'][0]['value'])): ?>
                              <?php $accelerated_degree_value = ($node_info['field_asu_degree_acc_program']['#items'][0]['value']); ?>
                              <?php if ($accelerated_degree_value == '1'): ?>
                                <br>
                                <i class="fa fa-location-arrow"></i>
                                <span class="asu-degrees-program-flag">Accelerated Program</span>
                              <?php else: ?>
                                <!-- do nothing, it's not an accelerated degree -->
                              <?php endif; ?>
                            <?php endif; ?>
                            <!-- Displaying 'Concurrent Degree' field if true, displaying nothing if false -->
                            <?php if (isset($node_info['field_asu_degree_conc_program']['#items'][0]['value'])): ?>
                              <?php $concurrent_degree_value = ($node_info['field_asu_degree_conc_program']['#items'][0]['value']); ?>
                              <?php if ($concurrent_degree_value == '1'): ?>
                                <?php if ($accelerated_degree_value == '1'): ?>
                                  <i class="fa fa-star"></i>
                                  <span class="asu-degrees-program-flag">Concurrent Program</span>
                                <?php else: ?>
                                  <br>
                                  <i class="fa fa-star"></i>
                                  <span class="asu-degrees-program-flag">Concurrent Program</span>
                                <?php endif; ?>
                              <?php else: ?>
                                <!-- do nothing, it's not a concurrent degree -->
                              <?php endif; ?>
                            <?php endif; ?>
                            <!-- Displaying 'New Degree' field if true, displaying nothing if false -->
                            <?php if (isset($node_info['field_asu_degree_new_program']['#items'][0]['value'])): ?>
                              <?php $new_degree_value = ($node_info['field_asu_degree_new_program']['#items'][0]['value']); ?>
                              <?php if ($new_degree_value == '1'): ?>
                                <?php if (($accelerated_degree_value || $concurrent_degree_value) == '1'): ?>
                                  <i class="fa fa-retweet"></i>
                                  <span class="asu-degrees-program-flag">New Program</span>
                                <?php else: ?>
                                  <br>
                                  <i class="fa fa-retweet"></i>
                                  <span class="asu-degrees-program-flag">New Program</span>
                                <?php endif; ?>
                              <?php else: ?>
                                <!-- do nothing, it's not a new degree -->
                              <?php endif; ?>
                            <?php endif; ?>
                          </h1>
                        <?php endif; ?>
                      </div>
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

              <!--Start degree content-->
              <?php print theme('breadcrumb', array('breadcrumb' => drupal_get_breadcrumb())); ?>
              <div class="container">
               <!-- Doctoral sidebar content -->
                        <div class="col-md-4 moscone-sidebar-area doc-sidebar">
                          <div class="panel-pane pane-menu-tree pane-main-menu">
                            <div id="doc-asu-degree">
                              <?php $block = block_load('menu', 'menu-faculty-and-research'); $render_block = _block_get_renderable_array(_block_render_blocks(array($block)));$output = drupal_render($render_block); print $output; ?>
                            </div>
                          </div>
                          <div class="doc-cta">
                           <div class="doc-prog-btn">
                    <?php  if (isset($node_info['field_cta_button_program_guide']['#items'][0]['filename'])): ?>
                        <a href="/sites/default/files/<?php echo $node_info['field_cta_button_program_guide']['#items'][0]['filename'] ?>"
                            target="_blank" class="btn btn-blue btn-block btn-lg"><i class="fa fa-file-pdf-o" aria-hidden="true"></i> Program Handbook</a>
                      <?php else: ?>
                      <!-- do nothing -->
                      <?php  endif ?>
                      <?php  if (isset($node_info['field_asu_degree_cta_information']['#items'][0]['url'])): ?>
                        <a href="#asu-rfi-form-data" id="take-me-to-rfi"
                           class="btn btn-gold btn-block btn-lg">Request Information</a>
                      <?php else: ?>
                        <a href="#asu-rfi-form-data" id="take-me-to-rfi"
                           class="btn btn-gold btn-block btn-lg">Request Information</a>
                      <?php  endif ?>
                       <?php if (isset($node_info['field_asu_degree_cta_apply']['#items'][0]['url'])): ?>
                        <a href="<?php echo $node_info['field_asu_degree_cta_apply']['#items'][0]['url'] ?>"
                           class="btn btn-gold btn-block btn-lg">Apply Now</a>
                        <?php else: ?>
                        <a href="https://webapp4.asu.edu/dgsadmissions/Index.jsp"
                            class="btn btn-gold btn-block btn-lg">Apply Now</a>
                      <?php endif ?>
                      </div>
                          </div>
                          <div class="plan-of-study">
                            <?php if (isset($node_info['field_asu_degree_asuds_url'])): ?>
                              <h2>Plan of Study</h2>

                              <p>The Plan of Study is the required curriculum to complete the program.</p>

                              <p><a
                                href="<?php echo $node_info['field_asu_degree_asuds_url']['#items'][0]['url']; ?>"
                                target="_blank">View Plan of Study</a></p>
                            <?php endif ?>

                      <div class="asu-degree-subplans">
                      <?php if (isset($node_info['field_asu_degree_subplan_url']['#items'])): ?>
                        <div class='asu-degree-sublplans'><p><strong>Subplans</strong><br/>
                        </div>
                          <?php foreach ($node_info['field_asu_degree_subplan_url']['#items'] as $sp) {
    if ($sp['title'] != $sp['url']) {
        echo '<a href="'.$sp['url'].'">'.$sp['title'].'</a><br/>';
    } else {
        echo '<a href="'.$sp['url'].'">Online</a><br/>';
    }
}
                        echo '</p>';
                      endif ?>
                          </div>
                          </div>
                          <div class="here-to-help">
                            <?php $block = block_load('block', 30); $render_block = _block_get_renderable_array(_block_render_blocks(array($block)));$output = drupal_render($render_block); print $output; ?>
                          </div>
                        </div>

                <!-- Start optional description video display -->
                <?php if (isset($node_info['field_asu_degree_grad_desc_video']['#items'][0]['safe_value'])): ?>

                  <!-- IF VIDEO IS PRESENT -->
                  <div class="row">
                      <div class="col-md-8 moscone-main-content">
                        <?php if (isset($node_info['field_asu_degree_short_desc']['#items'][0]['safe_value'])): ?>
                          <div class="asu-degree-short-description">
                            <?php print render($node_info['field_asu_degree_short_desc']['#items'][0]['safe_value']); ?>
                          </div>
                        <?php elseif (isset($node_info['body'])): ?>
                          <?php print render($node_info['body']); ?>
                        <?php endif; ?>
                      </div>
                      <div class="col-md-4">
                        <?php echo $node_info['field_asu_degree_grad_desc_video']['#items'][0]['safe_value']; ?>
                      </div>
                  </div>

                <?php else: ?>

                  <!-- IF VIDEO IS NOT PRESENT -->
                <div class="row">
                  <div class="col-md-8 moscone-main-content">
                  <?php if (isset($node_info['field_asu_degree_short_desc']['#items'][0]['safe_value'])): ?>
                    <div class="asu-degree-short-description">
                      <?php print render($node_info['field_asu_degree_short_desc']['#items'][0]['safe_value']); ?>
                          </div>
                    </div>
                </div>
                </div>
              </div>
                  <?php elseif (isset($node_info['body'])): ?>
                    <?php print render($node_info['body']); ?>
                  <?php endif; ?>

                <?php endif; ?>
                <!-- End optional description video display -->
              </div>

              <div class="container">
                <?php print render($page['asu_degree_marketing']); ?>
              </div>

              <div class="container space-top-xl space-bot-xl">
                <div class="col-md-8">

                  <?php if (isset($node_info['field_asu_degree_grad_text_area']['#items'][0]['safe_value'])): ?>
                      <?php echo $node_info['field_asu_degree_grad_text_area']['#items'][0]['safe_value']; ?>
                  <?php endif ?>

                </div>
                <?php if (isset($node_info['field_asu_degree_relatedprograms'])): ?>
                  <div class="col-md-4">
                    <div class="pane-menu-tree">
                      <h4>Related Programs</h4>
                      <?php for ($it = 0; $it < 1000; ++$it) {
    if (isset($node_info['field_asu_degree_relatedprograms'][$it]['#markup'])) {
        $rp_result = $node_info['field_asu_degree_relatedprograms'][$it]['#markup'];
    }
    if (!empty($rp_result)) {
        print $rp_result;
        unset($rp_result);
    } else {
        break 1;
    }
    ?>
                      <br>
                      <?php

} ?>
                    </div>
                  </div>
                <?php endif; ?>

                  <div class="col-md-4">
                    <?php print render($page['asu_degree_sidebar']); ?>
                  </div>
                </div>

                <div class="container">
                  <?php print render($page['prefooter']); ?>
                </div>

              </div>
            </div>
            <!-- /#main, /#main-wrapper -->

<!-- /#page, /#page-wrapper -->

       <?php elseif ($program_decider_value == 'Graduate Certificate'): ?>
            <!-- Graduate Certificate formatting -->

            <!-- Graduate Certificate -->
            <div id="main-wrapper" class="clearfix">
              <div id="main" class="clearfix">
                <a id="main-content"></a>

                <div class="asu-degree-banner-image"
                     style="background-image:url(/sites/default/files/<?php echo $node_info['field_asu_banner_image']['#items'][0]['filename']; ?>)">
                  <div class="container">
                    <div class="row">
                      <div class="col-md-12">
                        <?php if (($no_panels || $always_show_page_title) && $title): ?>
                          <h1 id="page-title" class="title">
                            <?php print $title; ?>
                            <!-- Displaying 'Accelerated Degree' field if true, displaying nothing if false -->
                            <?php if (isset($node_info['field_asu_degree_acc_program']['#items'][0]['value'])): ?>
                              <?php $accelerated_degree_value = ($node_info['field_asu_degree_acc_program']['#items'][0]['value']); ?>
                              <?php if ($accelerated_degree_value == '1'): ?>
                                <br>
                                <i class="fa fa-location-arrow"></i>
                                <span class="asu-degrees-program-flag">Accelerated Program</span>
                              <?php else: ?>
                                <!-- do nothing, it's not an accelerated degree -->
                              <?php endif; ?>
                            <?php endif; ?>
                            <!-- Displaying 'Concurrent Degree' field if true, displaying nothing if false -->
                            <?php if (isset($node_info['field_asu_degree_conc_program']['#items'][0]['value'])): ?>
                              <?php $concurrent_degree_value = ($node_info['field_asu_degree_conc_program']['#items'][0]['value']); ?>
                              <?php if ($concurrent_degree_value == '1'): ?>
                                <?php if ($accelerated_degree_value == '1'): ?>
                                  <i class="fa fa-star"></i>
                                  <span class="asu-degrees-program-flag">Concurrent Program</span>
                                <?php else: ?>
                                  <br>
                                  <i class="fa fa-star"></i>
                                  <span class="asu-degrees-program-flag">Concurrent Program</span>
                                <?php endif; ?>
                              <?php else: ?>
                                <!-- do nothing, it's not a concurrent degree -->
                              <?php endif; ?>
                            <?php endif; ?>
                            <!-- Displaying 'New Degree' field if true, displaying nothing if false -->
                            <?php if (isset($node_info['field_asu_degree_new_program']['#items'][0]['value'])): ?>
                              <?php $new_degree_value = ($node_info['field_asu_degree_new_program']['#items'][0]['value']); ?>
                              <?php if ($new_degree_value == '1'): ?>
                                <?php if (($accelerated_degree_value || $concurrent_degree_value) == '1'): ?>
                                  <i class="fa fa-retweet"></i>
                                  <span class="asu-degrees-program-flag">New Program</span>
                                <?php else: ?>
                                  <br>
                                  <i class="fa fa-retweet"></i>
                                  <span class="asu-degrees-program-flag">New Program</span>
                                <?php endif; ?>
                              <?php else: ?>
                                <!-- do nothing, it's not a new degree -->
                              <?php endif; ?>
                            <?php endif; ?>
                          </h1>
                        <?php endif; ?>
                      </div>
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

              <!--Start degree content-->
              <?php print theme('breadcrumb', array('breadcrumb' => drupal_get_breadcrumb())); ?>
              <div class="container">

                <!-- Start optional description video display -->
                <?php if (isset($node_info['field_asu_degree_grad_desc_video']['#items'][0]['safe_value'])): ?>

                  <!-- IF VIDEO IS PRESENT -->
                  <div class="row">
                      <div class="col-md-8">
                        <?php if (isset($node_info['field_asu_degree_short_desc']['#items'][0]['safe_value'])): ?>
                          <div class="asu-degree-short-description">
                            <?php print render($node_info['field_asu_degree_short_desc']['#items'][0]['safe_value']); ?>
                            <!--<div class="asu-degree-read-more">
                              <a href="#degree-collapse" data-toggle="collapse" aria-expanded="false">Read More</a>
                            </div>
                            <div id="degree-collapse" class="collapse">
                            </div>-->
                          </div>
                        <?php elseif (isset($node_info['body'])): ?>
                          <?php print render($node_info['body']); ?>
                        <?php endif; ?>
                      </div>
                      <div class="col-md-4">
                        <?php echo $node_info['field_asu_degree_grad_desc_video']['#items'][0]['safe_value']; ?>
                      </div>
                  </div>

                <?php else: ?>

                  <!-- IF VIDEO IS NOT PRESENT -->
                  <?php if (isset($node_info['field_asu_degree_short_desc']['#items'][0]['safe_value'])): ?>
                    <div class="asu-degree-short-description">
                      <?php print render($node_info['field_asu_degree_short_desc']['#items'][0]['safe_value']); ?>
                      <!--<div class="asu-degree-read-more">
                        <a href="#degree-collapse" data-toggle="collapse" aria-expanded="false">Read More</a>
                      </div>
                      <div id="degree-collapse" class="collapse">
                      </div>-->
                    </div>
                  <?php elseif (isset($node_info['body'])): ?>
                    <?php print render($node_info['body']); ?>
                  <?php endif; ?>

                <?php endif; ?>
                <!-- End optional description video display -->

                  <div class="row space-bot-lg">
                    <div class="col-sm-6 col-md-4 space-bot-md">
                    <?php  if (isset($node_info['field_cta_button_program_guide']['#items'][0]['filename'])): ?>
                        <a href="/sites/default/files/<?php echo $node_info['field_cta_button_program_guide']['#items'][0]['filename'] ?>"
                            target="_blank" class="btn btn-blue btn-block btn-lg"><i class="fa fa-file-pdf-o" aria-hidden="true"></i> Program Handbook</a>
                      <?php else: ?>
                          <!-- do nothing -->
                      <?php  endif ?>
                    </div>

                    <div class="col-sm-6 col-md-4 space-bot-md">
          <?php if (isset($node_info['field_asu_degree_cta_information']['#items'][0]['url'])): ?>
                        <a href="#asu-rfi-form-data" id="take-me-to-rfi"
                           class="btn btn-gold btn-block btn-lg">Request Information</a>
                      <?php elseif ($node->nid == 2756) : ?>
                        <a href="#asu-rfi-long-form-data"
                           class="btn btn-gold btn-block btn-lg">Request Information</a>
                      <?php else : ?>
                        <a href="#asu-rfi-form-data" id="take-me-to-rfi"
                           class="btn btn-gold btn-block btn-lg">Request Information</a>
            <?php endif ?>

                    </div>
                    <div class="col-sm-6 col-md-4 space-bot-md">
                    <?php  if (isset($node_info['field_asu_degree_cta_apply']['#items'][0]['url'])): ?>
                        <a href="<?php  echo $node_info['field_asu_degree_cta_apply']['#items'][0]['url'] ?>"
                           class="btn btn-gold btn-block btn-lg">Apply Now</a>
                      <?php  else: ?>
                        <a href="https://webapp4.asu.edu/dgsadmissions/"
                           class="btn btn-gold btn-block btn-lg">Apply Now</a>
                    <?php endif ?>
                    </div>
                  </div>
              </div>
              <div class="asu-degree-grey-section">
                <div class="container">
                  <div class="row">
                    <div class="col-sm-6 col-md-4">
                      <h2>Certificate Offered</h2>

                      <div class="asu-degree-page-degree-offered">
                        <p>
                          <?php if (isset($node_info['field_asu_degree_awarded']['#items'][0]['value'])): ?>
                            <?php print render($node_info['field_asu_degree_awarded']['#items'][0]['value']); ?>
                          <?php endif; ?><br>

                        </p>
                      </div>
                      <p>
                        <strong>Location</strong><br>
                        <?php
                          if (isset($node_info['field_tc_degree_campus']['#items'][0]['value'])) {
                              $c = count($node_info['field_tc_degree_campus']['#items']) - 1;
                              $i = 0;
                              foreach ($node_info['field_tc_degree_campus']['#items'] as $campus) {
                                  $a = true;
                                  switch ($campus['value']) {
                                case 'Tempe':
                                  echo '<a href="//www.asu.edu/tour/tempe/index.html">'.$campus['value'].'</a>';
                                  break;
                                case 'Polytechnic':
                                  echo '<a href="//www.asu.edu/tour/polytechnic/index.html">'.$campus['value'].'</a>';
                                  break;
                                case 'Downtown':
                                  echo '<a href="//www.asu.edu/tour/downtown/index.html">'.$campus['value'].'</a>';
                                  break;
                                case 'West':
                                  echo '<a href="//www.asu.edu/tour/west/index.html">'.$campus['value'].'</a>';
                                  break;
                                case 'Lake Havasu':
                                  echo '<a href="//havasu.asu.edu/">'.$campus['value'].'</a>';
                                  break;
                                case 'Eastern Arizona College':
                                  echo '<a href="//transfer.asu.edu/eac">'.$campus['value'].'</a>';
                                  break;
                                case 'Online':
                                  echo '<a href="//asuonline.asu.edu/">'.$campus['value'].'</a>';
                                  break;
                                  //education.asu.edu specific fields ---> Modify through admin/content, execute
                                  case 'ASU@Gila Valley':
                                                    echo '<a href="//transfer.asu.edu/thegilavalley">'.$campus['value'].'</a>';
                                                    break;
                                  case 'ASU@Yuma':
                                                    echo '<a href="//transfer.asu.edu/asuyuma">'.$campus['value'].'</a>';
                                                    break;
                                  case 'Paradise Valley Unified School District':
                                                    echo $campus['value'];
                                                    break;
                                  case 'Dysart Unified School District':
                                                    echo $campus['value'];
                                                    break;
                                  case 'Gadsden Elementary School District':
                                                    echo $campus['value'];
                                                    break;
                                  case 'Pendergast Elementary School District':
                                  echo $campus['value'];
                                  break;
                                  case 'Osborn School District':
                                                  echo $campus['value'];
                                                  break;
                                  case 'Tolleson Elementary School District':
                                                  echo $campus['value'];
                                                  break;
                                //Check ASU Feeds Parser.  The campus being used doesn't exist.
                                default:
                                  echo 'Campus Not Found';
                                  //$a = false;
                                  echo '<!--'.$campus['value'].'-->';
                                  break;
                              }
                                  if ($i < $c && $a) {
                                      echo ', ';
                                  }
                                  ++$i;
                              }
                          }
                        ?>
                      </p>
                        </div>
                        <div class="col-sm-6 col-md-4">
            <?php if (isset($node_info['field_asu_degree_asuds_url'])): ?>
                      <h2>Plan of Study</h2>

                      <p>The Plan of Study is the required curriculum to complete the program.</p>

                        <p><a
                            href="<?php echo $node_info['field_asu_degree_asuds_url']['#items'][0]['url']; ?>"
                            target="_blank">View Plan of Study</a></p>
                      <?php endif ?>

                      <div class="asu-degree-subplans">
                      <?php if (isset($node_info['field_asu_degree_subplan_url']['#items'])): ?>
                        <div class='asu-degree-sublplans'><p><strong>Subplans</strong><br/></div>
                          <?php foreach ($node_info['field_asu_degree_subplan_url']['#items'] as $sp) {
    if ($sp['title'] != $sp['url']) {
        echo '<a href="'.$sp['url'].'">'.$sp['title'].'</a><br/>';
    } else {
        echo '<a href="'.$sp['url'].'">Online</a><br/>';
    }
}
                        echo '</p>';
                      endif ?>
                      </div>
                    </div>
                    <div class="col-sm-6 col-md-4">

                      <?php if (isset($node_info['field_asu_degree_grad_app']['#items'][0]['safe_value'])): ?>
                          <?php echo $node_info['field_asu_degree_grad_app']['#items'][0]['safe_value']; ?>
                      <?php endif ?>

                    </div>
                    <div class="col-sm-6 col-md-4">
            <h2>Paying for College</h2>
                      <p>
                          There are several ways to pay for your degree, and we can help you along the way
                           as you submit applications and decide which path is best for you.
                           Learn more about <a href="../admission/paying-for-college">paying for college</a>.
                      </p>
            <h2>Contact Us</h2>
            <?php if (isset($node_info['field_online_degree_category']['#items'][0]['value'])): ?>
              <?php $online_decider_value = ($node_info['field_online_degree_category']['#items'][0]['value']); ?>
                <?php if ($online_decider_value == 'online_only'): ?>
            <p><i style="font-size:1.2em;" class="fa fa-phone"> </i> 1-877-326-6744</p>
            <p><i style="font-size:1.2em;" class="fa fa-envelope"> </i> <a href="mailto:gradenrollment@asuonline.asu.edu">gradenrollment@asuonline.asu.edu</a></p>
                <?php elseif ($online_decider_value == 'f2f_only'): ?>
            <p><i style="font-size:1.2em;" class="fa fa-phone"> </i> 602-543-6358</p>
            <p><i style="font-size:1.2em;" class="fa fa-envelope"> </i> <a href="mailto:gradeducation@asu.edu">gradeducation@asu.edu</a></p>
                <?php elseif ($online_decider_value == 'hybrid'): ?>
            <h5 style="margin-bottom: 8px;">iLeadAZ Pathway </h5>
            <p style="margin: 5px;"><i style="font-size:1.2em;" class="fa fa-phone"> </i> 602-543-6358</p>
            <p style="margin: 5px;"><i style="font-size:1.2em;" class="fa fa-envelope"> </i> <a href="mailto:gradeducation@asu.edu">gradeducation@asu.edu</a></p>
            <h5 style="margin-bottom: 8px;">Online Pathway</h5>
            <p style="margin: 5px;"><i style="font-size:1.2em;" class="fa fa-phone"> </i> 1-877-326-6744</p>
            <p style="margin: 5px;"><i style="font-size:1.2em;" class="fa fa-envelope"> </i> <a href="mailto:gradenrollment@asuonline.asu.edu">gradenrollment@asuonline.asu.edu</a></p>
                <?php elseif ($online_decider_value == 'hybrid_2'): ?>
            <h5 style="margin-bottom: 8px;">Tempe Program </h5>
            <p style="margin: 5px;"><i style="font-size:1.2em;" class="fa fa-phone"> </i> 602-543-6358</p>
            <p style="margin: 5px;"><i style="font-size:1.2em;" class="fa fa-envelope"> </i> <a href="mailto:gradeducation@asu.edu">gradeducation@asu.edu</a></p>
            <h5 style="margin-bottom: 8px;">Online Program</h5>
            <p style="margin: 5px;"><i style="font-size:1.2em;" class="fa fa-phone"> </i> 1-877-326-6744</p>
            <p style="margin: 5px;"><i style="font-size:1.2em;" class="fa fa-envelope"> </i> <a href="mailto:gradenrollment@asuonline.asu.edu">gradenrollment@asuonline.asu.edu</a></p>
            <?php endif; ?>
          <?php endif; ?>
                        <!--<p>
                        <?php // if (isset($node_info['field_asu_degree_cta_visit']['#items'][0]['url'])): ?>
                          <a href="<?php // echo $node_info['field_asu_degree_cta_visit']['#items'][0]['url'] ?>"
                             class="btn btn-gold btn-block btn-lg">Schedule a visit</a>
                        <?php // else: ?>
                          <a href="https://visit.asu.edu/"
                             class="btn btn-gold btn-block btn-lg">Schedule a visit</a>
                        <?php // endif ?>
                    </p> -->
                        <!--<?php // if (isset($node_info['field_asu_degree_grad_financing']['#items'][0]['safe_value'])): ?>
                          <?php // echo $node_info['field_asu_degree_grad_financing']['#items'][0]['safe_value']; ?>
                      <?php // endif ?> -->

                    </div>
                  </div>
                </div>
              </div>

              <div class="container">
                <?php print render($page['asu_degree_marketing']); ?>
              </div>

              <div class="container space-top-xl space-bot-xl">
                <div class="col-md-8">

                  <?php if (isset($node_info['field_asu_degree_grad_text_area']['#items'][0]['safe_value'])): ?>
                      <?php echo $node_info['field_asu_degree_grad_text_area']['#items'][0]['safe_value']; ?>
                  <?php endif ?>

                </div>
                <?php if (isset($node_info['field_asu_degree_relatedprograms'])): ?>
                  <div class="col-md-4">
                    <div class="pane-menu-tree">
                      <h4>Related Programs</h4>
                      <?php for ($it = 0; $it < 1000; ++$it) {
    if (isset($node_info['field_asu_degree_relatedprograms'][$it]['#markup'])) {
        $rp_result = $node_info['field_asu_degree_relatedprograms'][$it]['#markup'];
    }
    if (!empty($rp_result)) {
        print $rp_result;
        unset($rp_result);
    } else {
        break 1;
    }
    ?>
                      <br>
                      <?php

} ?>
                    </div>
                  </div>
                <?php endif; ?>

                  <div class="col-md-4">
                    <?php print render($page['asu_degree_sidebar']); ?>
                  </div>
                </div>

                <div class="container">
                  <?php print render($page['prefooter']); ?>
                </div>

              </div>
            </div>
            <!-- /#main, /#main-wrapper -->

        <?php else: ?>
            <!-- do nothing, it has no degree program assigned -->
        <?php endif; ?>
    <?php endif; ?>
    <!-- end of PROGRAM DECIDER  -->


    <!-- Page Footer -->
    <footer id="page-footer">
      <div class="container">
        <div class="row row-full">
          <?php print render($page['footer']); ?>
        </div>
      </div>
    </footer>
    <!-- /#footer -->

    <?php print render($page['closure']); ?>

  </div>
</div>
<!-- /#page, /#page-wrapper -->
