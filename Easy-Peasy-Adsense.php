<?php

/*
Plugin Name: Easy Peasy Adsense
Version: v1.2.3
Plugin URI: http://www.martinglover.co.uk/?page_id=224
Author: Martin Glover
Author URI: http://www.martinglover.co.uk/
Plugin Description: An easy peasy way to insert Google Adsense ads into your Wordpress posts and pages.
*/

/*
    This program is free software; you can redistribute it
    under the terms of the GNU General Public License version 2,
    as published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.
*/

$easy_peasy_adsense = "1.2.3";


function show_campaign_1()
{
    $campaign_encoded_value_1 = get_option('wp_campaign_1_code');
    $campaign_decoded_value_1 = html_entity_decode($campaign_encoded_value_1, ENT_COMPAT);

    if(!empty($campaign_decoded_value_1))
    {
        $output .= " $campaign_decoded_value_1";
    }
    return $output;
}

function show_campaign_2()
{
    $campaign_encoded_value_2 = get_option('wp_campaign_2_code');
    $campaign_decoded_value_2 = html_entity_decode($campaign_encoded_value_2, ENT_COMPAT);

    if(!empty($campaign_decoded_value_2))
    {
        $output .= " $campaign_decoded_value_2";
    }
    return $output;
}

function show_campaign_3()
{
    $campaign_encoded_value_3 = get_option('wp_campaign_3_code');
    $campaign_decoded_value_3 = html_entity_decode($campaign_encoded_value_3, ENT_COMPAT);

    if(!empty($campaign_decoded_value_3))
    {
        $output .= " $campaign_decoded_value_3";
    }
    return $output;
}

function wp_campaign_process($content)
{
    if (strpos($content, "[wp_campaign_1]") !== FALSE)
    {
        $content = preg_replace('/<p>\s*<!--(.*)-->\s*<\/p>/i', "<!--$1-->", $content);
        $content = str_replace('[wp_campaign_1]', show_campaign_1(), $content);
    }
    if (strpos($content, "[wp_campaign_2]") !== FALSE)
    {
        $content = preg_replace('/<p>\s*<!--(.*)-->\s*<\/p>/i', "<!--$1-->", $content);
        $content = str_replace('[wp_campaign_2]', show_campaign_2(), $content);
    }
    if (strpos($content, "[wp_campaign_3]") !== FALSE)
    {
        $content = preg_replace('/<p>\s*<!--(.*)-->\s*<\/p>/i', "<!--$1-->", $content);
        $content = str_replace('[wp_campaign_3]', show_campaign_3(), $content);
    }
    return $content;
}

// Displays Simple Ad Campaign Options menu
function campaign_add_option_page() {
    if (function_exists('add_options_page')) {
        add_options_page('Easy Peasy Adsense', 'Easy Peasy Adsense', 8, __FILE__, 'ad_insertion_options_page');
    }
}

function ad_insertion_options_page() {

    global $easy_peasy_adsense;

    if (isset($_POST['info_update']))
    {
        echo '<div id="message" class="updated fade"><p><strong>';

        $tmpCode1 = htmlentities(stripslashes($_POST['wp_campaign_1_code']) , ENT_COMPAT);
        update_option('wp_campaign_1_code', $tmpCode1);

        $tmpCode2 = htmlentities(stripslashes($_POST['wp_campaign_2_code']) , ENT_COMPAT);
        update_option('wp_campaign_2_code', $tmpCode2);

        $tmpCode3 = htmlentities(stripslashes($_POST['wp_campaign_3_code']) , ENT_COMPAT);
        update_option('wp_campaign_3_code', $tmpCode3);

        echo 'Options Updated!';
        echo '</strong></p></div>';
    }

    ?>

    <div class=wrap>

    <h2>Easy Peasy Adsense Options v <?php echo $easy_peasy_adsense; ?></h2>

    <p>Information and Updates:<br />
    <a href="http://www.martinglover.co.uk">http://www.martinglover.co.uk/</a></p>

<div align="center">
  <p><a href="http://www.andthenhost.com" title="low cost affordable web hosting" target="_blank">Get low cost WordPress hosting from just 1.49 per month</a></p></div>

    <form method="post" action="<?php echo $_SERVER["REQUEST_URI"]; ?>">
    <input type="hidden" name="info_update" id="info_update" value="true" />

    <fieldset class="options">
    <legend><strong>Using Easy Peasy Adsense</strong></legend>
    <p>An easy peasy way to insert Google Adsense ads into your Wordpress posts and pages.</p>
    <p>There are two ways you can use this plugin:</p>
    <p>Add the trigger text <strong>[wp_campaign_1]</strong> for the first ad, in your page or post.<br />
    Use <strong>[wp_campaign_2]</strong> for the second ad and <strong>[wp_campaign_3]</strong> for the third.<br />
    </p>
    <p>Alternatively you can add the following to the relevant template files:</p>
    <p> <strong>&lt;?php echo show_campaign_1(); ?&gt;</strong> for the first ad<br />
    <strong>&lt;?php echo show_campaign_2(); ?&gt;</strong> for the second ad<br />
    <strong>&lt;?php echo show_campaign_3(); ?&gt;</strong> for the third ad</p>
    </fieldset>

    <fieldset class="options">
    <legend><strong>Options</strong></legend>

    <table width="100%" border="0" cellspacing="0" cellpadding="6">

    <tr valign="top"><td width="35%" align="left">
    <strong>Adsense Ad Campaign 1 Code:</strong>
    <br />
    Copy and paste the Google Adsense code here. To show this ad in your posts or pages use the code: <i><br />
        </i><strong>[wp_campaign_1]</strong><i><br />
    </i>
    </td>
    <td align="left">
      <textarea name="wp_campaign_1_code" rows="6" cols="35"><?php echo get_option('wp_campaign_1_code'); ?></textarea>
    </td></tr>

    <tr valign="top"><td width="35%" align="left">
    <strong>Adsense Ad Campaign 2 Code:</strong>
    <br />
    Copy and paste the Google Adsense code here. To show this ad in your posts or pages use the code <br />
    <strong>[wp_campaign_2]</strong><br /></td>
    <td align="left">
      <textarea name="wp_campaign_2_code" rows="6" cols="35"><?php echo get_option('wp_campaign_2_code'); ?></textarea>
    </td>
    </tr>

    <tr valign="top"><td width="35%" align="left">
    <strong>Adsense Ad Campaign 3 Code:</strong>
    <br />
    Copy and paste the Google Adsense code here. To show this ad in your posts or pages use the code <br />
     <strong>[wp_campaign_3]</strong>
    </td>
    <td align="left">
      <textarea name="wp_campaign_3_code" rows="6" cols="35"><?php echo get_option('wp_campaign_3_code'); ?></textarea>
    </td></tr>

    </table>
    </fieldset>

    <div class="submit">
        <input type="submit" name="info_update" value="<?php _e('Update options'); ?> &raquo;" />
    </div>

    </form>
    </div><?php
}

add_filter('the_content', 'wp_campaign_process');

// Insert the campaign_add_option_page in the 'admin_menu'
add_action('admin_menu', 'campaign_add_option_page');

?>
