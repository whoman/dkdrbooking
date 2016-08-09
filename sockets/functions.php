<?php

function makeRandom()
{
    return substr(hash("md5", uniqid()), 0, 16);
}

function convertDate($codes)
{

    $dkdrbooking_time = strtotime($codes);
    return date('Y-m-d', $dkdrbooking_time);

}

function forCompare($giveMeDate)
{

    $dkdrbooking_time_from_user = strtotime($giveMeDate);
    return date('Y/m/d', $dkdrbooking_time_from_user);
}


function update_if_date_is_equal($table_name_for_select, $dkdrBookint_myId,
                                 $dkdrbooking_name, $dkdrbooking_family,
                                 $dkdrbooking_mobile, $dkdrbooking_tell,
                                 $dkdrbooking_comeFrom, $dkdrbooking_comePart,
                                 $dkdrbooking_reason)
{

    global $wpdb;
    if ($wpdb->query(
        $wpdb->prepare("UPDATE {$table_name_for_select}
                                  SET  drName = %s, drFamily = %s, drMobile=%s, drTell=%s ,drComeFrom=%s,drPart=%s,drReason=%s
                                      WHERE id = " . $dkdrBookint_myId,
            $dkdrbooking_name, $dkdrbooking_family, $dkdrbooking_mobile, $dkdrbooking_tell,
            $dkdrbooking_comeFrom, $dkdrbooking_comePart, $dkdrbooking_reason))

    ) {
        $_SESSION['payam'] = 'ویرایش انجام شد';
        header('location:' . plugins_url('../public/dkdrbooking_success.php', __FILE__));
        die();
    } else {

        header('location:' . plugins_url('../public/dkdrbooking_error.php', __FILE__));
        die();
    }


}

function insert_if_date_equal($table_name_for_select, $dkdrbooking_name, $dkdrbooking_family
    , $dkdrbooking_mobile, $dkdrbooking_tell, $dkdrbooking_comeFrom,
                              $dkdrbooking_comePart, $dkdrbooking_reason, $dkdrbooking_pDate, $dkdrbooking_trackingCode, $dkdrbooking_turn)
{

    global $wpdb;
    if ($wpdb->query($wpdb->prepare("INSERT INTO " .
        $table_name_for_select . " (drName,drFamily,drMobile,drTell,drComeFrom,drPart,drReason,drJlDate,drTrackCode,drTurn)
                   VALUES(%s,%s,%s,%s,%s,%s,%s,%s,%s,%d)", array($dkdrbooking_name, $dkdrbooking_family, $dkdrbooking_mobile, $dkdrbooking_tell, $dkdrbooking_comeFrom,
        $dkdrbooking_comePart, $dkdrbooking_reason, $dkdrbooking_pDate, $dkdrbooking_trackingCode, $dkdrbooking_turn)))
    ) {

        $_SESSION['dkdrTurn'] = $dkdrbooking_turn;
        $_SESSION["yourTrackCode"] = $dkdrbooking_trackingCode;
        header('location:' . plugins_url('../public/dkdrbooking_success.php', __FILE__));
        die();
    } else {
        header('location:' . plugins_url('../public/dkdrbooking_error.php', __FILE__));
        die();
    }

}

function insert_data_with_delete_update_page($table_name_for_select,$dkdrbooking_name,$dkdrbooking_family,
                                             $dkdrbooking_mobile,$dkdrbooking_tell,$dkdrbooking_comeFrom,
                                             $dkdrbooking_comePart,$dkdrbooking_reason,$dkdrbooking_pDate,
                                             $dkdrbooking_trackingCode,$dkdrbooking_turn,$dkdrBookint_myId)
{
    global $wpdb;
    if ($wpdb->query($wpdb->prepare("INSERT INTO " .
        $table_name_for_select . " (drName,drFamily,drMobile,drTell,drComeFrom,drPart,drReason,drJlDate,drTrackCode,drTurn)
                     VALUES(%s,%s,%s,%s,%s,%s,%s,%s,%s,%d)", array($dkdrbooking_name, $dkdrbooking_family, $dkdrbooking_mobile, $dkdrbooking_tell, $dkdrbooking_comeFrom,
        $dkdrbooking_comePart, $dkdrbooking_reason, $dkdrbooking_pDate, $dkdrbooking_trackingCode, $dkdrbooking_turn)))
    ) {
        $wpdb->query($wpdb->prepare("DELETE  FROM " . $table_name_for_select . " WHERE id = %d", $dkdrBookint_myId));
        $_SESSION['dkdrTurn'] = $dkdrbooking_turn;
        $_SESSION["yourTrackCode"] = $dkdrbooking_trackingCode;
        header('location:' . plugins_url('../public/dkdrbooking_success.php', __FILE__));
        die();
    } else {

        header('location:' . plugins_url('../public/dkdrbooking_error.php', __FILE__));
        die();
    }
}