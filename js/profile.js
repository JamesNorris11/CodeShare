$(document).ready(function(){

    var initialDisplayName = $('#dispNameColValue').html();
    var initialEmail = $('#emailColValue').html();
    var correctSyntax;
    var fieldName;


    $('#input').click(function(e) {

        $('#dispNameColValue').html(
            '<form action="changedetails.php" method="post" name="loginForm">' +

            '<input name="displayName" id="fieldDisplayName" type="text" class="input field" value="' + initialDisplayName + '">' +

            '<input type="submit" name="Submit" id="submitDisplayName" class="submit changeSubmit" value="Submit">' +
        '</form>'
            );

        $('#emailColValue').html(
            '<form action="changedetails.php" method="post" name="loginForm">' +

            '<input name="email" id="fieldEmail" type="text" class="input field" value="' + initialEmail + '">' +

            '<input type="submit" name="Submit" id="submitEmail" class="submit changeSubmit" value="Submit">' +
            '</form>'
        );

        $('#passwordColValue').html(
            '<form action="changedetails.php" method="post" name="loginForm">' +

            '<input name="password" id="fieldPassword" type="password" class="input field">' +

            '<input name="repeatPassword" id="fieldRepeatPassword" type="password" class="input field" placeholder="Repeat Password">' +

            '<input type="submit" name="Submit" id="submitPassword" class="submit changeSubmit" value="Submit">' +
            '</form>'
        );
    });

    // This is not:
    //     $('input').on("change keyup blur input", function() {
    // because the elements were created with jQuery and therefore need accessing through
    // an existing page element, e.g. body
    $('body').on('change keyup blur input', 'input', function() {

        $('#helpMessage').hide();

        if ($(this).attr('name') == "email") {
            fieldName = "Email";

            correctSyntax = emailCorrect();

            changeTipMessage($(this), correctSyntax, fieldName);
        }
        else if ($(this).attr('name') == "displayName") {
            fieldName = "DisplayName";

            correctSyntax = displayNameCorrect();

            changeTipMessage($(this), correctSyntax, fieldName);

        }
        else if ($(this).attr('name') == "password") {

            fieldName = "Password";

            correctSyntax = passwordCorrect();

            // this is extra to update repeat password message when password field is changed
            changeTipMessage(
                $(
                    'input[name=repeatPassword]')
                , repeatPasswordCorrect()
                , "RepeatPassword"
            );

            changeTipMessage($(this), correctSyntax, fieldName);

        }
        else if ($(this).attr('name') == "repeatPassword") {

            fieldName = "RepeatPassword";

            correctSyntax = repeatPasswordCorrect();

            changeTipMessage($(this), correctSyntax, fieldName);
        }

    });


    $('#dispNameColValue').on('click', '#submitDisplayName', function(e){
        if (!displayNameCorrect()) {
            e.preventDefault()
        }
    });

    $('body').on('click', 'input#submitEmail', function(e) {
        if (!emailCorrect()) {
            e.preventDefault()
        }
    });

    $('body').on('click', 'input#submitPassword', function(e) {
        if ((!passwordCorrect()) || (!repeatPasswordCorrect())) {
            e.preventDefault()
        }
    });

    function changeTipMessage(thisObj, correctSyntax, fieldName) {
        if (fieldName) {
            if (correctSyntax == true) {
                thisObj.css({"border": "1px solid #E25D33", "outline": "none"});
                $("#field" + fieldName)
            }
            else {
                thisObj.css({"border": "2px solid red", "outline": "none"});
                $("#field" + fieldName)
            }
        }
    }

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
