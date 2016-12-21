/* Created By: Anup Patel
 * A web based app that will accept a value from the user and check for all prime numbers below it.
 */

//if the form was submitted, take the value from the box there
$( "#inputCheck" ).submit( function( e ){
    var value = parseInt( $( "#inputMaxValue").val() );
    if( Number.isInteger( value ) ) {
        makeAPICall( value );
    } else {
        alert( 'Please check input.' );
    }
    //make sure form does not submit and reload page.
    e.preventDefault();
    return false;
});

//if the users pressed the 1000 button as default, auto-set the value to 1000
$( "#use1000Button" ).click( function( e ){
    //set the value in the form to 1000 if the button is clicked.
    $( "#inputMaxValue").val( 1000 );
    makeAPICall( 1000 );
    return false;
});

//makes an api call to PHP API page on the server and gets back data
function makeAPICall( value ) {
    $( "#results" ).html( "<p>Loading</p>" );
    $( ".output").show();
    $.ajax({
        url: "http://anup-patel.com/phpapi/api.php",
        data: { "type": "getPrimeNumbers", "value": value },
        error: function() {
            $( "#results" ).html( "<p>An error has occurred</p>" );
        },
        dataType: 'json',
        success: function( results ) {
            $( "#results").html( results.join( ", " ) );
        },
        failure: function( data ) {
            $( "#results" ).html( "<p>An error has occurred</p>" );
        },
        type: 'POST'
    });
}
