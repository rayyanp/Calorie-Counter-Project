// function that connects to nationality api, using the uri library
function recipe($uri) {
    $.getJSON($uri)    
    .done(function(data){
        console.log("Call done ok");
        $("#name").html("<b>Name sent: </b>" +data.name);

        // return the first of 3 possible results from the api
        $("#country_id").html("<b>Likely country: </b>" +data.country[0].country_id);

        // converts the 'probability' into a percentage, and rounds the figure down to 3dp
        $("#probability").html("<b>Probability: </b>" +(data.country[0].probability * 100).toFixed(3) + "%");

    })

    // status code if api fails
    .fail(function(jqXHR) {
        console.log("Failure: " + jqXHR.status);
    })

    // confirms request is complete
    .always(function() {
        console.log("Request completed");
    });
}