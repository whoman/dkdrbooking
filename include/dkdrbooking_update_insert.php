<?php
/* validation update insert to db and mapping page*/

require_once('../../../../wp-config.php');
require_once('../sockets/functions.php');
global $wpdb;
$table_name_for_select = $wpdb->prefix . 'dkdrbookingdatabase';
session_start();

if (isset($_POST['name']) &&
    isset($_POST['family']) &&
    isset($_POST['mobile']) &&
    isset($_POST['tell']) &&
    isset($_POST['come']) &&
    isset($_POST['timecome']) &&
    isset($_POST['selector']) &&
    isset($_POST['datetime']) &&
    isset($_POST['pdate']) &&
    isset($_POST['giveMyId'])
) {

    $_SESSION['dkdrname'] = $dkdrbooking_name = ($_POST['name']);
    $_SESSION['dkdrfamily'] = $dkdrbooking_family = ($_POST['family']);
    $_SESSION['dkdrMobile'] = $dkdrbooking_mobile = $_POST['mobile'];
    $_SESSION['dktell'] = $dkdrbooking_tell = $_POST['tell'];
    $_SESSION['dkdrWherecome'] = $dkdrbooking_comeFrom = $_POST['come'];
    $_SESSION['dkdrwhenCome'] = $dkdrbooking_comePart = $_POST['timecome'];
    $_SESSION['dkdrSelector'] = $dkdrbooking_reason = $_POST['selector'];
    $_SESSION['dkdrDate'] = $_POST['pdate'];
    $dkdrbooking_pDate = $_POST['datetime'];
    $dkdrBookint_myId = $_POST['giveMyId'];
    $dkdrbooking_turn = 0;
    $dkdrbooking_trackingCode = makeRandom();
    $dkdrLimit = 5;

    if (!isset($dkdrbooking_name) || $dkdrbooking_name == "" || is_numeric($dkdrbooking_name) ||
        !isset($dkdrbooking_family) || $dkdrbooking_family == "" || is_numeric($dkdrbooking_family) ||
        !isset($dkdrbooking_mobile) || $dkdrbooking_mobile == "" || $dkdrbooking_mobile < 11 || is_nan($dkdrbooking_mobile) ||
        !isset($dkdrbooking_tell) || $dkdrbooking_tell == "" || is_nan($dkdrbooking_tell) || $dkdrbooking_tell < 5
    ) {
        $_SESSION['payam'] = '!iseet';
        header('location:' . plugins_url('../public/dkdrbooking_error.php', __FILE__));
        die();
    } else {
        //getCurrentDate
        $dkdrBookig_now_date = date("Y/m/d");
        //convertDateGetFromUser
        $dkdrbooking_my_time = forCompare($dkdrbooking_pDate);

        $dkdrbooking_for_compare = convertDate($dkdrbooking_my_time);

        //Get for set limit
        $countdkdr = $wpdb->get_var("SELECT COUNT(id) FROM " . $table_name_for_select . " WHERE drJlDate='" . $dkdrbooking_for_compare . "'");
        //get time that id have
        $previousDate = $wpdb->get_var("SELECT drJlDate FROM " . $table_name_for_select . " WHERE id= " . $dkdrBookint_myId);


        if ($dkdrbooking_my_time == $dkdrBookig_now_date || $dkdrbooking_my_time == forCompare($previousDate)) {

            //if update is done goto success file else error

            update_if_date_is_equal($table_name_for_select, $dkdrBookint_myId, $dkdrbooking_name,
                $dkdrbooking_family, $dkdrbooking_mobile,
                $dkdrbooking_tell, $dkdrbooking_comeFrom,
                $dkdrbooking_comePart, $dkdrbooking_reason);

        } else {

            if ($countdkdr <= 5) {

                //if the date come from user is < now date
                if ($dkdrbooking_my_time < $dkdrBookig_now_date) {
                    header('location:' . plugins_url('../public/dkdrbooking_error.php', __FILE__));
                    die();


                } elseif ($dkdrbooking_my_time > $dkdrBookig_now_date) {

                    $dkdrbooking_time = strtotime($dkdrbooking_my_time);
                    $dkdrbooking_for_compare = date('Y-m-d', $dkdrbooking_time);

                    $anyOne = $wpdb->get_row("SELECT drTurn FROM " . $table_name_for_select . " WHERE id = (SELECT MAX(id) as lastestid from " . $table_name_for_select . " WHERE drJlDate ='" . $dkdrbooking_for_compare . "')");
                    $any = $anyOne->drTurn;

                    //if no one register in this date
                    if ($any == 0) {
                        $dkdrbooking_turn = $any + 1;


                        insert_data_with_delete_update_page($table_name_for_select, $dkdrbooking_name, $dkdrbooking_family,
                            $dkdrbooking_mobile, $dkdrbooking_tell, $dkdrbooking_comeFrom,
                            $dkdrbooking_comePart, $dkdrbooking_reason, $dkdrbooking_pDate,
                            $dkdrbooking_trackingCode, $dkdrbooking_turn, $dkdrBookint_myId);


                    } else {
                        //some one in that date
                        $dkdrbooking_turn = $wpdb->get_var($wpdb->prepare("SELECT drTurn FROM " . $table_name_for_select . " WHERE id = (SELECT MAX(id) FROM " . $table_name_for_select . " )"), 0);
                        $dkdrbooking_turn++;


                        insert_data_with_delete_update_page($table_name_for_select, $dkdrbooking_name, $dkdrbooking_family,
                            $dkdrbooking_mobile, $dkdrbooking_tell, $dkdrbooking_comeFrom,
                            $dkdrbooking_comePart, $dkdrbooking_reason, $dkdrbooking_pDate,
                            $dkdrbooking_trackingCode, $dkdrbooking_turn, $dkdrBookint_myId);
                        

                    }
                } else {
                    header('location:' . plugins_url('../public/dkdrbooking_success.php', __FILE__));
                }
            } else {
                header('location:' . plugins_url('../public/dkdrbooking_error.php', __FILE__));
            }
        }

    }
} else {
    header('location:' . plugins_url('../public/dkdrbooking_error.php', __FILE__));
    die();
}
