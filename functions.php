<?php
/* Created By: Anup Patel
 * A web based app that will accept a value from the user and check for all prime numbers below it.
 */

class APIHelperFunctions {
    /*
     * getPrimeNumbers
     *
     * Accepts a value and checks for all prime numbers less then that value
     *
     * @param integer $maxValue - A integer value that will be the max value when checking for prime numbers less than it.
     * @return array $primeNumbers - contains all numbers that are prime under the given input value
     */
    function getPrimeNumbers( $maxValue = 1000 ){
        //Make sure the request input number is higher than 2 and an integer, since we cannot generate prime numbers less than that.
        if( ( 2 > $maxValue ) || !is_int( $maxValue ) ) {
            return "Input must be an integer and above 2";
        }

        //We declare arrays here to store results, for performance improvement we could directly print the values that are prime instead of storing in array
        $primeNumbers = array();
        $notPrimeNumbers = array();

        //starting at 2, iterate through all integers up to max value
        for( $x = 2; $x <= $maxValue; $x++ ) {
            //keeps a count of how many times number is divisible by a number less than it.
            $counter = 0;

            //iterate 1 through the current x value to determine divisible counts
            for ( $y = 1; $y <= $x; $y++ ) {
                //if we can evenly divide into the x value by the y value, increase counter
                if( 0 == $x % $y ) {
                    $counter++;
                }

                //no need to check the rest of y numbers for evenly divides if the counter is greater then 2 (not prime)
                //this was added as a performance optimization
                if( 2 < $counter ) {
                    break;
                }
            }
            //if we only have 2 for a counter then its a prime because its only divisible by 1 and itself.
            ( 2 == $counter ) ? array_push($primeNumbers, $x) : array_push($notPrimeNumbers, $x);
        }

        return $primeNumbers;
    }
}
