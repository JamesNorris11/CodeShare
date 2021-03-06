$(document).ready(function(){

    var correctSyntax;
    var fieldName;
    var fieldMessage;

    // hide message element so it doesn't flash as page loads
    $('#helpMessage').hide();

    // event triggers on input to fields, also triggers if browser auto-fill feature is used
    $('input').on("change keyup blur input", function() {

        $('#helpMessage').hide();

        if ($(this).attr('name') == "email") {
            fieldMessage = "Please enter a valid email address";

            changeTipMessage($(this), emailCorrect(), "Email", fieldMessage);
        }

        else if ($(this).attr('name') == "password") {
            fieldMessage = "Please enter a valid password";

            // set min password length to 1 as parameter, because no need to tell user how long password
            // should be, as they should already have login details
            changeTipMessage($(this), passwordCorrect(1), "Password", fieldMessage);
        }
    });

    $('.submit').click(function(e) {
        if ((!emailCorrect()) || (!passwordCorrect(1))) {
            e.preventDefault()
        }
    });
});
