<?php

require_once('../../../../wp-config.php');
global $wpdb;
$table_name_for_update = $wpdb->prefix . 'dkdrbookingdatabase';

if (isset($_POST['giveMyId'])) {
    $giveMe = $_POST['giveMyId'];

    $myResults = $wpdb->get_results($wpdb->prepare("SELECT drName,drFamily,drMobile,drTell
                                   ,drComeFrom,drPart,drReason,drJlDate FROM " . $table_name_for_update . " 
                                    WHERE id = %d", $giveMe));

    $updateDateResult = '';
    foreach ($myResults as $myResult) {

        $name = $myResult->drName;
        $family = $myResult->drFamily;
        $mobile = $myResult->drMobile;
        $tell = $myResult->drTell;
        $comeFrom = $myResult->drComeFrom;
        $partComeFrom = $myResult->drPart;
        $drResult = $myResult->drReason;
        $jldate = $myResult->drJlDate;

        $updateDateResult .= $name . '|' . $family . '|' . $mobile . '|' . $tell . '|'
            . $comeFrom . '|' . $partComeFrom . '|' . $drResult . '|' . $jldate . '||';
    }
    echo $updateDateResult;
    die();
} else {
    header('location:' . plugins_url('../public/dkdrbooking_error.php', __FILE__));
}