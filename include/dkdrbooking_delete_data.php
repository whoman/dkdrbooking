<?php
require_once('../../../../wp-config.php');
global $wpdb;
$table_name_for_delete = $wpdb->prefix . 'dkdrbookingdatabase';

if (isset($_POST["giveMyId"])) {
    $giveMeIdForDelete = $_POST['giveMyId'];

    $wpdb->query($wpdb->prepare("DELETE  FROM " . $table_name_for_delete . " WHERE id = %d", $giveMeIdForDelete));
    echo "رکورد مورد نظر حذف شد.";
    die();
} else {
    header('location:' .esc_url(plugins_url('../public/dkdrbooking_error.php', __FILE__)));
}