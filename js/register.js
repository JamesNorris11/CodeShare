$(document).ready(function(){

    var correctSyntax;
    var fieldName;
    var fieldMessage;

    $('#helpMessage').hide();

    // event triggers on input to fields, also triggers if browser auto-fill feature is used
    $('input').on("change keyup blur input", function() {

        $('#helpMessage').hide();

        if ($(this).attr('name') == "email") {
            fieldMessage = "Please enter a valid email address";

            changeTipMessage($(this), emailCorrect(), "Email", fieldMessage);
        }
        else if ($(this).attr('name') == "displayName") {
            fieldMessage = "Please enter a valid display name";

            changeTipMessage($(this), displayNameCorrect(), "DisplayName", fieldMessage);

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

    $('.hoverHelp').mouseover(function () {

        // This needs setting as initially set as display: none;
        $('#helpMessage').css("display", "inline-block");

        $('.tip').text("");
        $('#helpMessage').show();

        if ($(this).attr('id') == "helpEmail") {
            $('#helpMessage').text("This must be a valid email address. e.g. 123@abc.com");
        }
        else if ($(this).attr('id') == "helpDisplayName") {
            $('#helpMessage').text("Your display name can be up to 20 characters long. It can only contain letters, numbers, underscores and spaces.");
        }
        else if ($(this).attr('id') == "helpPassword") {
            $('#helpMessage').text("Set a secure password. It must be at least 6 characters long. Do not make it too simple!");
        }
        else if ($(this).attr('id') == "helpRepeatPassword") {
            $('#helpMessage').text("This must match the first password exactly. Make sure you type it carefully!");
        }
    });

    $('.hoverHelp').mouseleave(function () {
        $('#helpMessage').hide();
    });

    $('.submit').click(function(e) {
        if ((!emailCorrect()) || (!displayNameCorrect()) || (!passwordCorrect()) || (!repeatPasswordCorrect())) {
            e.preventDefault()
        }
    });
});
