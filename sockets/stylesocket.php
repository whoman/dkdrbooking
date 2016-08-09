<?php

function dkdrbooking_style_socket() {
           
            
                wp_enqueue_script('dkdr_get_info_page',
                    plugins_url('../js/dkdrbookingGetInformation.js', __FILE__),
                    array(), '1.0', true);
            
      
                wp_enqueue_script('dkdr_import_jquery',
                    plugins_url('../js/datetimepicker/jquery-2.1.4.min.js', __FILE__),
                    array('jquery'), false);
          
            
                wp_enqueue_script('dkdr_jalaali_convertor',
                    plugins_url('../js/datetimepicker/jalaali.js', __FILE__),
                    array(), '1.0', false);
          
                wp_enqueue_script('dkdr_jalaali_pagination_crud',
                    plugins_url('../js/dkdrbookingAjaxPagination.js', __FILE__),
                    array(), '1.0', true);
           
                wp_enqueue_script('dkdr_js_bootstrap',
                    plugins_url('../js/datetimepicker/bootstrap.min.js', __FILE__),
                    array('jquery'), false);
           
                wp_enqueue_script('dkdr_persian_btstrap_date_picker',
                    plugins_url('../js/datetimepicker/jquery.Bootstrap-PersianDateTimePicker.js', __FILE__),
                    array('jquery'), true);
          
                wp_enqueue_style('dkdrbooking_bootstrap',
                    plugins_url('../css/datetimepicker/bootstrap.min.css', __FILE__),
                    array(), '1.0', false);

           
          
                wp_enqueue_style('dkdrbooking_bootstrap_theme',
                    plugins_url('../css/datetimepicker/bootstrap-theme.min.css', __FILE__),
                    array(), '1.0', false);

            

                wp_enqueue_style('dkdrbooking_bootstrap_date_picker',
                    plugins_url('../css/datetimepicker/jquery.Bootstrap-PersianDateTimePicker.min.css', __FILE__),
                    array(), '1.0', false);

          
                wp_enqueue_script('dkdr_call_ajax_pagination',
                    plugins_url('../js/dkdrbookingPaginationCall.js', __FILE__),
                    array(), '1.0', true);
           
                wp_enqueue_script('dkdrbooking_javascript', plugins_url('../js/dkdrbooking.js', __FILE__), array(), '1.0', true);
    
}

add_action( 'admin_enqueue_scripts', 'dkdrbooking_style_socket' );
add_action( 'wp_enqueue_scripts', 'dkdrbooking_style_socket' );