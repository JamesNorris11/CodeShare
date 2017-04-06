$(document).ready(function(){

    var correctSyntax;
    var fieldName;
    var fieldMessage;

    $('#helpMessage').hide();

    $('input').keyup(function() {

        $('#helpMessage').hide();

        if ($(this).attr('name') == "email") {
            fieldName = "Email";
            fieldMessage = "Please enter a valid email address"

            correctSyntax = emailCorrect();
        }
        else if ($(this).attr('name') == "displayName") {
            fieldName = "DisplayName";
            fieldMessage = "Please enter a valid display name"

            correctSyntax = displayNameCorrect();

        }
        else if ($(this).attr('name') == "password") {

            fieldName = "Password";
            fieldMessage = "Please enter a valid password"

            correctSyntax = passwordCorrect();

            // this is extra to update repeat password message when password field is changed
            changeTipMessage(
                $(
                'input[name=repeatPassword]')
                , repeatPasswordCorrect()
                , "RepeatPassword"
                , "Your passwords do not match!"
            );

        }
        else if ($(this).attr('name') == "repeatPassword") {

            fieldName = "RepeatPassword";
            fieldMessage = "Your passwords do not match!"

            correctSyntax = repeatPasswordCorrect();
        }

        changeTipMessage($(this), correctSyntax, fieldName, fieldMessage);
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

    function changeTipMessage(thisObj, correctSyntax, fieldName, fieldMessage) {
        if (correctSyntax == true) {
            thisObj.css({"border": "1px solid #E25D33", "outline": "none"});
            $("#tip" + fieldName)
                .text("");
        }
        else {
            thisObj.css({"border": "2px solid red", "outline": "none"});
            $("#tip" + fieldName)
                .text(fieldMessage)
                .css("color", "red");
        }
    }

    // @return true or false
    function emailCorrect()
    {
        var len = $('input[name=email]').val().length;
        if (len <= 100) {
            var email = $('input[name=email]').val();
            var re = /\S+@\S+\.\S+/;

            return re.test(email);
        }
        else {
            return false;
        }
    }

    function displayNameCorrect()
    {
        var re = /^[a-zA-Z0-9 _]+$/;
        var displayName = $('input[name=displayName]').val();

        var len = $('input[name=displayName]').val().length;
        if ((len <= 20) && (re.test(displayName))) {
            return true;
        }
        else {
            return false;
        }
    }

    function passwordCorrect()
    {
        var len = $('input[name=password]').val().length;
        if ((len >= 6) && (len <= 100)) {
            return true;
        }
        else {
            return false;
        }
    }

    function repeatPasswordCorrect()
    {
        if ($('input[name=repeatPassword]').val() == $('input[name=password]').val()) {
            return true;
        }
        else {
            return false;
        }
    }
});
