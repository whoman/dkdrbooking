<?php
require_once('../../../../wp-config.php');
global $wpdb;
$my_data_table_dr = $wpdb->prefix . 'dkdrbookingdatabase';

// Make the script run only if there is a page number posted to this script
if (isset($_POST['pn'])) {
    $showPerPage = preg_replace('#[^0-9]#', '', $_POST['showPerPage']);
    $lastNumber = preg_replace('#[^0-9]#', '', $_POST['lastNumber']);
    $pn = preg_replace('#[^0-9]#', '', $_POST['pn']);
    // This makes sure the page number isn't below 1, or more than our $lastNumber page
    if ($pn < 1) {
        $pn = 1;
    } else if ($pn > $lastNumber) {
        $pn = $lastNumber;
    }

    $limit = 'LIMIT ' . ($pn - 1) * $showPerPage . ',' . $showPerPage;
    // This is your query again, it is for grabbing just one page worth of rows by applying $limit

    $results = $wpdb->get_results("SELECT * FROM " . $my_data_table_dr . " ORDER BY id DESC $limit");
    $dataString = '';

    foreach ($results as $result) {
        $id = $result->id;
        $name = $result->drName;
        $family = $result->drFamily;
        $mobile = $result->drMobile;
        $tell = $result->drTell;
        $comeFrom = $result->drComeFrom;
        $partComeFrom = $result->drPart;
        $drResult = $result->drReason;
        $jldate = $result->drJlDate;
        $trakcode = $result->drTrackCode;
        $trun = $result->drTurn;

        $dkdrbooking_time_from_user = strtotime($jldate);
        $dkdrbooking_my_time = date('Y/m/d', $dkdrbooking_time_from_user);
        
        
        $dataString .= "<td>" . "<input type='checkbox' id='myCheck' name='giveMeId'
                   value='$id'>" . '|' . "</td>" . '|' . "<td>" . $name . "</td>" . '|'
            . "<td>" . $family . "</td>" . '|' . "<td>" . $mobile . "</td>" . '|'
            . "<td>" . $tell . "</td>" . '|' . "<td>" . $comeFrom . "</td>" . '|'
            . "<td>" . $partComeFrom . "</td>" . '|'
            . "<td>" . $drResult . "</td>" . '|' . "<td>" . $dkdrbooking_my_time . "</td>" . '|'
            . "<td>" . $trakcode . "</td>" . '|' . "<td>" . $trun . "</td>" . '||';

    }

    echo $dataString;

} else {
    header('location:' . esc_url(plugins_url('../public/dkdrbooking_error.php', __FILE__)));
    die();
}

