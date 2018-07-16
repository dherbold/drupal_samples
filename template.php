<?php
/**
 * @file
 * Primary pre/preprocess functions and alterations.
 */

function innovationchild_preprocess_page(&$variables) {
  if (isset($variables['node']->type)) {
    // If the content type's machine name is "my_machine_name" the file
    // name will be "page--my-machine-name.tpl.php".
    $variables['theme_hook_suggestions'][] = 'page__' . $variables['node']->type;
  }
  $authenticatedNids = array(7815,7816,7817,7818,8125,8126);
  if (isset($variables['node'])&& is_numeric(arg(1))) {
      foreach ($authenticatedNids as $nid) {
        if ($variables['node']->nid == $nid ) {
          if (!user_is_logged_in()) {
            $dest = drupal_get_destination();
            drupal_goto('user/login', array('query' => $dest));
          }
        }
      }
  }
}

function innovationchild_preprocess_html(&$vars) {
  $viewport = array(
   '#tag' => 'meta',
   '#attributes' => array(
     'name' => 'viewport',
     'content' => 'width=device-width, initial-scale=1, maximum-scale=1',
   ),
  );
  drupal_add_html_head($viewport, 'viewport');
}

/* function innovationchild_preprocess_panels_pane(&$variables) {
  //dpm('type: ' . $variables['pane']->type);
  if ($variables['pane']->type == 'fieldable_panels_pane') {
   dpm('subtype: ' . $variables['pane']->subtype);
    }
}*/