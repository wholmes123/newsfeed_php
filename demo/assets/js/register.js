$(document).ready(function() {

    // on click signup, hide login and show registration form
    $("#signup").click(function() {
        $("#first").slideUp("slow", function(){
            $("#second").slideDown("slow");
        });
    });
    // On click signin, hide registration form and show loginin form
    $("#signin").click(function() {
        $("#second").slideUp("slow", function() {
            $("#first").slideDown("slow");
        });
    });

});
