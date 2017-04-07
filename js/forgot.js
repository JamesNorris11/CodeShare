$(document).ready(function(){

    var correctSyntax;
    var fieldName;
    var fieldMessage;

    $('#helpMessage').hide();

    $('input').on("change keyup blur input", function() {

        $('#helpMessage').hide();

        if ($(this).attr('name') == "email") {
            fieldName = "Email";
            fieldMessage = "Please enter a valid email address"

            correctSyntax = emailCorrect();

            changeTipMessage($(this), correctSyntax, fieldName, fieldMessage);
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

            changeTipMessage($(this), correctSyntax, fieldName, fieldMessage);
        }
        else if ($(this).attr('name') == "repeatPassword") {

            fieldName = "RepeatPassword";
            fieldMessage = "Your passwords do not match!"

            correctSyntax = repeatPasswordCorrect();

            changeTipMessage($(this), correctSyntax, fieldName, fieldMessage);
        }

    });

    function changeTipMessage(thisObj, correctSyntax, fieldName, fieldMessage) {
        if (fieldName) {
            console.log(fieldName);
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
    }

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

    // @return true or false
    function emailCorrect()
    {
        var len = $('input[name=email]').val().length;
        if (len <= 100) {
            var email = $('input[name=email]').val();
            var re = /^\S+@\S+\.\S+$/;

            return re.test(email);
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