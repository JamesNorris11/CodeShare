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

            // this is extra to update repeat password message when password field is changed
            changeTipMessage(
                $(
                    'input[name=repeatPassword]')
                , repeatPasswordCorrect()
                , "RepeatPassword"
                , "Your passwords do not match!"
            );

            changeTipMessage($(this), passwordCorrect(), "Password", fieldMessage);
        }
        else if ($(this).attr('name') == "repeatPassword") {
            fieldMessage = "Your passwords do not match!";

            changeTipMessage($(this), repeatPasswordCorrect(), "RepeatPassword", fieldMessage);
        }

    });

    // Depending on which part of the process the user is on,
    // either submitting email or entering new password,
    // these events check the validity of user input when the submit button is pressed
    $('#submitPassword').click(function(e) {
        if ((!passwordCorrect()) || (!repeatPasswordCorrect())) {
            e.preventDefault()
        }
    });

    $('#submitEmail').click(function(e) {
        if (!emailCorrect()) {
            e.preventDefault()
        }
    });
});
