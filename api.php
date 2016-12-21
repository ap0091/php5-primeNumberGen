<?php
/* Created By: Anup Patel
 * A web based app that will accept a value from the user and check for all prime numbers below it.
 */

include 'functions.php';
$apiFunctions = new APIHelperFunctions();

//Since this PHP API can be used for multiple types of request, check to make sure we are using getPrimeNumbers
if( $_POST['type'] == 'getPrimeNumbers' ) {

    //if a post value is set use that, else use default of 1000 ( intval converts non integers to 0 so default used then )
    $maxValue = ( intval( $_POST['value'] ) ) ? intval( $_POST['value'] ) : 1000;

    //If this API is to be used anywhere else besides the form, validate integer higher than 2 here (future proof)
    if( $maxValue >= 2 ) {
        //call getPrimeNumbers method in object declared above.
        $result = $apiFunctions->getPrimeNumbers( $maxValue );

        //if we have a result, print that else something went wrong in the functions object
        if( $result ) {
            print json_encode( $result );
        } else {
            print json_encode( "API Error" );
        }
    } else {
        //The only time we should get to this is if the API is directly called outside the form.
        print json_encode( "Input must be an integer and above 2" );
    }
}

die();
