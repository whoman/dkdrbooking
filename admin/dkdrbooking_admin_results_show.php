<?php
if (!defined('ABSPATH')) exit;
function dkbrbooking_Show_Result_Admin_Page()
{

    add_menu_page('Dr Booking',
        'dkdrbooking',
        'manage_options',
        __FILE__,
        'dkdrbooking_create_table_result',
        'dashicons-book-alt'
        , 3);

}

function dkdrbooking_create_table_result()
{
    function refreshPage()
    {
        global $wpdb;
        $dkdrbo_table_name = $wpdb->prefix . 'dkdrbookingdatabase';
        $total = $wpdb->get_var("SELECT count(id) FROM " . $dkdrbo_table_name);
        $showPerPage = 10;
        $lastNumber = ceil($total / $showPerPage);

        if ($lastNumber < 1) {
            $lastNumber = 1;
        }
        return array($lastNumber, $showPerPage);
    }

    ?>
    <div class="wrap">
        <input type="Submit" name="update" value="update" id="dkUpdate" class="dkUpdateClass"
               onclick= "dkdrPagination.ajax_post('dkUp');">
        <input type="hidden"
               value="<?php echo esc_url(plugins_url('../include/dkdrbooking_update_data.php', __FILE__)); ?>"
               id="dkdrUpdate">
        <input type="Submit" name="delete" value="delete" id="dkDelete" class="dkDeleteClass"
               onclick="dkdrPagination.ajax_post('dkDel');">
        <input type="hidden"
               value="<?php echo esc_url(plugins_url('../include/dkdrbooking_delete_data.php', __FILE__)); ?>"
               id="dkdrDelet">
        <input type="text" name="getTrackId" id="getTrackId" class="getTrackIdClass">
        <input type="Submit" name="search" value="search" onclick="dkdrPagination.requestSearch();">
        <input type="hidden"
               value="<?php echo esc_url(plugins_url('../include/dkdrbooking_search_data.php', __FILE__)); ?>"
               id="dkdrSearch">
        <input type="hidden" id="dkdrPagination"
               value="<?php echo esc_url(plugins_url('../public/dkdrbooking_pagination_select_data.php', __FILE__)); ?>">
        <input type="hidden" id="dkdrLastNumber" value="<?php $rf = refreshPage();
        echo $rf[0]; ?>">
        <input type="hidden" id="dkdrShowPerPage" value="<?php $rf = refreshPage();
        echo $rf[1]; ?>">
        <input type="hidden" id="dkdrGotoUpInsert"
               value="<?php echo esc_url(plugins_url('../include/dkdrbooking_update_insert.php', __FILE__)); ?>">


        <div id="results_box"></div>

        <div id="pagination_controls"></div>

        <div id="status"></div>
        <div id="searchStatus" style="display: none;">

        </div>
        <div id="sf"></div>

        <div id="dkdrFields" style="display:none ">
            <p id="errorMessage"></p>


            <p>نام : <input type="text" class="registerForm" name="name" id="rflname" required></p>

            <p>نام خانوادگی: <input type="text" class="registerForm" id="rflfamily" name="family" required></p>

            <p> محل سکونت: <input type="radio" class="registerForm" id="mashhadradio" name="comefrom" checked
                                  value="مشهد">مشهد
                <input type="radio" class="registerForm" id="other" name="comefrom" value="دیگراستانها"> دیگر استان ها
            </p>

            <p>نوبت :
                <input type="radio" class="registerForm" id="dkdrmorning" name="morornon" checked value="صبح">صبح
                <input type="radio" class="registerForm" id="dkdrnon" name="morornon" value="عصر">عصر
            </p>

            <p>تلفن ثابت :<input type="text" class="registerForm" id="rfltell" name="tell" required></p>

            <p>شماره موبایل: <input type="text" class="registerForm" id="rflmobile" name="mobile" required></p>

            <p>علت مراجعه<select id="rflSelector" name="reason">
                    <optgroup label="سینه">
                        <option value="زیبایی سینه">زیبایی</option>
                        <option value="پروتز سینه">پروتز</option>
                    </optgroup>
                    <optgroup label="صورت">
                        <option value="بینی">بینی</option>
                        <option value="گونه">گونه</option>
                    </optgroup>
                </select></p>

            <div style="margin-top: 50px; clear: both;"></div>
            <div class="container" style="max-width: 200px;">
                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-addon" data-mddatetimepicker="true" data-trigger="click"
                             data-targetselector="#fromDate1" data-groupid="group1" data-fromdate="true"
                             data-enabletimepicker="false" data-placement="left">
                            <span class="glyphicon glyphicon-calendar"></span>
                        </div>
                        <input type="text" class="form-control" id="fromDate1" placeholder="از تاریخ"
                               data-mddatetimepicker="true" data-trigger="click" data-targetselector="#fromDate1"
                               data-groupid="group1" data-fromdate="true" data-enabletimepicker="false"
                               data-placement="right" name="pdate" required/>
                    </div>
                </div>
            </div>
            <p><input type="submit" value="ثبت" class="registerForm" id="adminSubmit" name="submit"
                      onclick="jsValidation.formAdminSubUpdate();"/>
            <p><input type="submit" value="انصراف" class="registerForm" id="cancelUpdate" name="submit"
                      onclick="dkdrPagination.cancelUpdate();"/>
            </p>
            <p id="status">توضیحات</p>
            <!-- </form>-->
            <div>
                <p id="fMassege"></p>
            </div>
            <div id="customerMessage"></div>
        </div>
    </div>
    <?php
}

add_action('admin_menu', 'dkbrbooking_Show_Result_Admin_Page'); ?>