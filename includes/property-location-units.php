<?php
  function get_property_location_units() {?>
    <style>
      .ere-heading {
        margin-top: -100px !important;
      }
      .property-content {
        margin-top: -40px !important;
      }
      div .block-center::before {
        position: absolute;
        top: 0;
        width: 0px !important;
        height: 0px !important;
        background-color: #e2e2e2;
        content: "";
      }
      #main-content .container:before{
      	width: 0px !important;
      }
    </style>

    <div style="padding-bottom: 5%">
      <?php
      global $post;

      $post_slug=$post->post_name;
      // Post we are on's ID
      $post_id = get_the_id();
      // Array of all categories the post is associated with
      $categories = get_the_category();

      $post_cats = wp_get_post_categories($post_id);
      // How hamy categories there are in total in relation to the post
      $size_of_cats = count(wp_get_post_categories( $post_id, $args = array() ));
      //Loop through each category for the Location post
      for($i=0; $i < $size_of_cats; $i++){
        // Category Information
        $cat_id = $categories[$i]->term_id;
        $cat_name = $categories[$i]->name;
        $cat_slug = $categories[$i]->slug;
        $cat_parent = $categories[$i]->parent;
        $cat_parent_name = get_the_category_by_ID($cat_parent);
        ?>

        <div ><?php
         if(in_array($cat_id, $post_cats)){

         }
          if($cat_parent_name === 'Property'){ ?>
             <h2 style="font-size: 3.5em; font-family: Rubik; text-align: center"><strong><?= $cat_name . ' Units'; ?> </strong></h2><hr style="background-color: #FFAA07; height:10px"><?php
             $child_categories = get_categories( array(
                 'parent'  => $cat_id
               ) );
             $size_of_childs = count($child_categories);

               ?><pre><?php //print_r($child_categories); ?></pre><?php

               for($x=0; $x < $size_of_childs; $x++){
                 $current_cat_id = $child_categories[$x]->term_id;
                 if(in_array($current_cat_id, $post_cats)){ ?>
                   <h3 style="text-align: center; font-size: 3em; font-family: Rubik;"><strong><?= $child_categories[$x]->name ?></strong></h3><?php
                   echo do_shortcode('[ere_property show_paging="false" include_heading="false" property_featured="false" layout_style="property-list" property_type="' . $child_categories[$x]->name . '" property_status="" property_feature="" property_city="" property_state="" property_neighborhood="" property_label="' .$post_slug . '" item_amount="5" view_all_link="" el_class=""]');
                 }
               }?>
               <?php
          }?>
        </div>
        <?php
        //what to do for each category
      }
      ?>
    </div><?php
  }

  add_shortcode( 'get_units', 'get_property_location_units' );
