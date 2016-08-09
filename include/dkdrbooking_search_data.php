<?php
require_once('../../../../wp-config.php');
global $wpdb;
$table_name_for_search = $wpdb->prefix . 'dkdrbookingdatabase';

if (isset($_POST["myTrackIdSearch"])) {
    $giveMeTrackCode = $_POST["myTrackIdSearch"];

    $giveMySearch = $wpdb->get_results($wpdb->prepare("SELECT * FROM " . $table_name_for_search . " WHERE drTrackCode = %s ", $giveMeTrackCode));

    $dataSearch = '';

    foreach ($giveMySearch as $giveMe) {
        $id = $giveMe->id;
        $name = $giveMe->drName;
        $family = $giveMe->drFamily;
        $mobile = $giveMe->drMobile;
        $tell = $giveMe->drTell;
        $comeFrom = $giveMe->drComeFrom;
        $partComeFrom = $giveMe->drPart;
        $drResult = $giveMe->drReason;
        $jldate = $giveMe->drJlDate;
        $trakcode = $giveMe->drTrackCode;
        $trun = $giveMe->drTurn;

        $dataSearch .= "<td>" . "<input type='checkbox' id='myCheck' name='giveMeId'
                   value='$id'>" . '|' . "</td>" . '|' . "<td>" . $name . "</td>" . '|'
            . "<td>" . $family . "</td>" . '|' . "<td>" . $mobile . "</td>" . '|'
            . "<td>" . $tell . "</td>" . '|' . "<td>" . $comeFrom . "</td>" . '|'
            . "<td>" . $partComeFrom . "</td>" . '|'
            . "<td>" . $drResult . "</td>" . '|' . "<td>" . $jldate . "</td>" . '|'
            . "<td>" . $trakcode . "</td>" . '|' . "<td>" . $trun . "</td>" . '||';
    }

    echo $dataSearch;


} else {

    header('location:' . plugins_url('../public/dkdrbooking_error.php', __FILE__));
}

