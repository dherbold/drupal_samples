<?php

/**
 * @file
 * Default simple view template to display a list of rows.
 *
 * - $title : The title of this group of rows.  May be empty.
 * - $options['type'] will either be ul or ol.
 * @ingroup views_templates
 */
?>

<style>
 li {list-style-type: none; overflow: visible;}
</style>
<div class="row" style="margin-bottom: 30px; margin-top: 28px; padding-bottom: 20px; border-bottom: 2px solid #8C1D40;">
  <div class="col-sm-4" style="padding-left: 0; padding-right: 0;"> 

    <?php 
    
    if (isset($fields['field_isearch_photo_url']))  { 
      print $fields['field_isearch_photo_url']->content;
    
    } else { ?>
      <div class="field-content leadership-profile-image">
        <img class="medium" style="max-width: 220px; max-height: 220px;" src="https://education.asu.edu/sites/default/files/styles/panopoly_image_original/public/no-profile-photo.png" alt="No profile image available. This is a placeholder.">
      </div>
    <?php } ?>
  </div>   
  <div class="col-sm-8" style="padding-left: 0; padding-right: 0;"> 
     <h3 style="margin-top: 0; margin-bottom: 0">
       <?php print $fields['title']->content; ?>
     </h3>
     <p style="margin-top: .4em;">
       <strong>
         <?php print $fields['field_isearch_affil_title']->content; ?>
       </strong>
     </p>
     <p>
       <?php print "<a href=\"mailto:" . $fields['field_isearch_email']->content . "\"><i class=\"fa fa-envelope\"></i> " .  $fields['field_isearch_email']->content . "</a>" ?>
     </p>
     <?php
     $phone = '';
     $strpphone = '';
     
      if (isset($fields['field_assistant_phone'])) { 
        $phone = $fields['field_assistant_phone']->content;
      }
      
      $strpphone = preg_replace("/[^0-9]/", "", $phone); 
        
      if (isset($fields['field_assistant'])) {
        
       print "<hr>" . "<small><strong>Administrative contact:</strong><br />" . $fields['field_assistant']->content;
       
     } elseif (isset($fields['field_admini_assist_nonasurite'])) {
         
         print "<hr>" . "<small><strong>Administrative contact:</strong><br />" . $fields['field_admini_assist_nonasurite']->content . "<br />";
       
       } 
       
      if (isset($fields['field_assistant_title'])) { 
       
        print ", " . $fields['field_assistant_title']->content . "<br />";
      
      }
      
      if (isset($fields['field_assistant_email'])) {
      
        print "<a href=\"mailto:" . $fields['field_assistant_email']->content . "\"><i class=\"fa fa-envelope\"></i> " .  $fields['field_assistant_email']->content . "</a>";
      
      } 
      
      if ($phone != '') {
      
        print " | <a href=\"tel:" . $strpphone . "\"><i class=\"fa fa-phone\"></i> " . $phone . "</a>";
      
      }
      print "</small>";
     ?>
   </div>
 </div> 

