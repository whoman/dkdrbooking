<?php

class dkdrbooking_create_db
{


    public static function dbCreator()
    {
        global $wpdb;
        // mysql_query("SET CHARACTER SET utf8");

        $my_db_name = $wpdb->prefix . 'dkdrbookingdatabase';
        if ($wpdb->get_var("show tables like '$my_db_name'") != $my_db_name) {
            $sql = "CREATE TABLE " . $my_db_name . " (
		`id` INT(20) NOT NULL AUTO_INCREMENT,
		`drName` VARCHAR(25) NOT NULL,
		`drFamily` VARCHAR(45) NOT NULL,
		`drMobile` VARCHAR(12) NOT NULL,
		`drTell` VARCHAR(12) NOT NULL,
		`drComeFrom` VARCHAR(20) NOT NULL,
		`drPart` VARCHAR(20) NOT NULL,
		`drReason` VARCHAR(20) NOT NULL,
		`drJlDate` DATE NOT NULL,
		`drTrackCode` VARCHAR(20) NOT NULL,
		`drTurn` VARCHAR(20) NOT NULL,
		UNIQUE KEY id (id)
		)DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;";

            require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
            dbDelta($sql);
        }

    }
}


