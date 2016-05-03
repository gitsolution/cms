<?php
return array(
    // set your paypal credential
    'client_id' => 'AYTY2aLDEJSpMLtBUUAAkIQRzQOK5w1v_r11T78JUMTkDeLXPP0EhT2Agkf48rUpV8Q22v-YSBxRnp5U',
    'secret' => 'EOyPh6yJVnBacOx1Tcs0aDM3rW65FMlVDB9ELYVkf-S_thEwbzRCrEuwPVIeJ8cLP07qo3NeaQNIEoyC',

    /*'secret' => 'DATO-DE-TU-APP-DE-PAYPAL',*/
 
    /**
     * SDK configuration 
     */
    'settings' => array(
        /**
         * Available option 'sandbox' or 'live'
         */
        'mode' => 'sandbox',
 
        /**
         * Specify the max request time in seconds
         */
        'http.ConnectionTimeOut' => 30,
 
        /**
         * Whether want to log to a file
         */
        'log.LogEnabled' => true,
 
        /**
         * Specify the file that want to write on
         */
        'log.FileName' => storage_path() . '/logs/paypal.log',
 
        /**
         * Available option 'FINE', 'INFO', 'WARN' or 'ERROR'
         *
         * Logging is most verbose in the 'FINE' level and decreases as you
         * proceed towards ERROR
         */
        'log.LogLevel' => 'FINE'
    ),
);