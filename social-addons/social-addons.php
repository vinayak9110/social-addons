<?php

/*
Plugin Name: Social Addon
Plugin URI: https://github.com/vinayak9110/social-addons
Description: Displays Social Share icons below every post.
Version: 1.0
Author: Vinayak Thorat
*/

function social_share_menu_item()
{
  add_submenu_page("options-general.php", "Social Share", "Social Share", "manage_options", "social-share", "social_share_page"); 
}

add_action("admin_menu", "social_share_menu_item");
function social_share_page()
{
   ?>
      <div class="wrap">
         <h1>Social Sharing Options</h1>
 
         <form method="post" action="options.php">
            <?php
               settings_fields("social_share_config_section");
 
               do_settings_sections("social-share");
                
               submit_button(); 
            ?>
         </form>
      </div>
   <?php
}
function social_share_settings()
{
    add_settings_section("social_share_config_section", "", null, "social-share");
 
    add_settings_field("social-share-facebook", "Do you want to display Facebook share button?", "social_share_facebook_checkbox", "social-share", "social_share_config_section");
    add_settings_field("social-share-twitter", "Do you want to display Twitter share button?", "social_share_twitter_checkbox", "social-share", "social_share_config_section");
    add_settings_field("social-share-linkedin", "Do you want to display LinkedIn share button?", "social_share_linkedin_checkbox", "social-share", "social_share_config_section");
    add_settings_field("social-share-google", "Do you want to display Google+ share button?", "social_share_google_checkbox", "social-share", "social_share_config_section");
	add_settings_field("social-share-pinterest", "Do you want to display Pinterest share button?", "social_share_pinterest_checkbox", "social-share", "social_share_config_section");
	add_settings_field("social-share-youtube", "Do you want to display Youtube share button?", "social_share_youtube_checkbox", "social-share", "social_share_config_section");
	add_settings_field("social-share-instagram", "Do you want to display Instagram share button?", "social_share_instagram_checkbox", "social-share", "social_share_config_section");
 
    register_setting("social_share_config_section", "social-share-facebook");
    register_setting("social_share_config_section", "social-share-twitter");
    register_setting("social_share_config_section", "social-share-linkedin");
    register_setting("social_share_config_section", "social-share-google");
	register_setting("social_share_config_section", "social-share-pinterest");
	register_setting("social_share_config_section", "social-share-youtube");
	register_setting("social_share_config_section", "social-share-instagram");
}
 
function social_share_facebook_checkbox()
{  
   ?>
        <input type="checkbox" name="social-share-facebook" value="1" <?php checked(1, get_option('social-share-facebook'), true); ?> /> Check for Yes
   <?php
}

function social_share_twitter_checkbox()
{  
   ?>
        <input type="checkbox" name="social-share-twitter" value="1" <?php checked(1, get_option('social-share-twitter'), true); ?> /> Check for Yes
   <?php
}

function social_share_linkedin_checkbox()
{  
   ?>
        <input type="checkbox" name="social-share-linkedin" value="1" <?php checked(1, get_option('social-share-linkedin'), true); ?> /> Check for Yes
   <?php
}



function social_share_google_checkbox()
{  
   ?>
        <input type="checkbox" name="social-share-google" value="1" <?php checked(1, get_option('social-share-google'), true); ?> /> Check for Yes
   <?php
}

 function social_share_pinterest_checkbox()
{  
   ?>
        <input type="checkbox" name="social-share-pinterest" value="1" <?php checked(1, get_option('social-share-pinterest'), true); ?> /> Check for Yes
   <?php
}
function social_share_youtube_checkbox()
{  
   ?>
        <input type="checkbox" name="social-share-youtube" value="1" <?php checked(1, get_option('social-share-youtube'), true); ?> /> Check for Yes
   <?php
}

function social_share_instagram_checkbox()
{  
   ?>
        <input type="checkbox" name="social-share-instagram" value="1" <?php checked(1, get_option('social-share-instagram'), true); ?> /> Check for Yes
   <?php
}

add_action("admin_init", "social_share_settings");
add_filter("the_content", "add_social_share_icons");
function add_social_share_icons($content)
{
    $html = "<div class='social-share-wrapper'><div class='share-on'>Share on: </div>";

    global $post;

    $url = get_permalink($post->ID);
    $url = esc_url($url);
	$custom_items = get_option( 'option_name' );

    $content .= wpautop( $custom_items );

    if(get_option("social-share-facebook") == 1)
    {
        $html = $html . "<div class='facebook'><a target='_blank' href='http://www.facebook.com/sharer.php?u=" . $url . "'><i class='fa fa-facebook-official'></i></a></div>";
    }

    if(get_option("social-share-twitter") == 1)
    {
        $html = $html . "<div class='twitter'><a target='_blank' href='https://twitter.com/share?url=" . $url . "'><i class='fa fa-twitter'></i></a></div>";
    }

    if(get_option("social-share-linkedin") == 1)
    {
        $html = $html . "<div class='linkedin'><a target='_blank' href='http://www.linkedin.com/shareArticle?url=" . $url . "'><i class='fa fa-linkedin-square'></i></a></div>";
    }

    
	
	 if(get_option("social-share-google") == 1)
    {
        $html = $html . "<div class='google'><a target='_blank' href='http://plus.google.com/share?=" . $url . "'><i class='fa fa-google-plus'></i></a></div>";
    }
	
	 if(get_option("social-share-pinterest") == 1)
    {
        $html = $html . "<div class='pinterest'><a target='_blank' href='http://pinterest.com/pin/create/link/?=" . $url . "'><i class='fa fa-pinterest'></i></a></div>";
    }

	
	 if(get_option("social-share-youtube") == 1)
    {
        $html = $html . "<div class='youtube'><a target='_blank' href='http://www.youtube.com/watch?=" . $url . "'><i class='fa fa-youtube-square'></i></a></div>";
    }
	
	 if(get_option("social-share-instagram") == 1)
    {
        $html = $html . "<div class='instagram'><a target='_blank' href='http://www.instagram.com/#?=" . $url . "'><i class='fa fa-instagram'></i></a></div>";
    }
    $html = $html . "<div class='clear'></div></div>";

    return $content = $content . $html;
}
	add_action('wp_footer', 'your_function');
	function your_function() {
		$custom_items = get_option( 'option_name' );
		echo $custom_items;
	}


function social_share_style() 
{
	wp_enqueue_style( 'my-fonts', '//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css' );
    wp_register_style("social-share-style-file", plugin_dir_url(__FILE__) . "style.css");
    wp_enqueue_style("social-share-style-file");
}

add_action("wp_enqueue_scripts", "social_share_style");
?>