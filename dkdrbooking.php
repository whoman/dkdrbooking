<?php
/*
Plugin Name: Darkoob web Dr Booking
Plugin URI:  http://darkoobweb.com
Description: A plugin for Dr booking , Create By Darkoobweb.com
Version:     1.0
Author:      Pouria Parhami{^},Hooman Moein
Author URI:  http://darkoobweb.com
*/

if (!defined('ABSPATH')) {
    exit;
}

define('RFL_PAINTBALL_RESERVATION_PLUGIN_URL', plugin_dir_url(__FILE__));
define('RFL_PAINTBALL_RESERVATION_PLUGIN_DIR', plugin_dir_path(__FILE__));


//Include the page need to use.
//Create table in db
require_once(RFL_PAINTBALL_RESERVATION_PLUGIN_DIR . '/database/dkdrbooking_create_db.php');
//When hook is activate do this function first.
register_activation_hook((__FILE__), array('dkdrbooking_create_db', 'dbCreator'));

if (is_admin()) {
    // We are in admin mode
    require_once(RFL_PAINTBALL_RESERVATION_PLUGIN_DIR . '/admin/dkdrbooking_admin_results_show.php');
}


//This function put the form any where u want if plugin is active.
function dkdrbooking_form()
{
    require_once(RFL_PAINTBALL_RESERVATION_PLUGIN_DIR . '/public/dkdrbooking_get_information.php');
}
//short code for add getInfromation form
add_shortcode('dkdrbooking', function (){
    dkdrbooking_form();
});


//Register and load style's and script's

include("sockets/stylesocket.php");