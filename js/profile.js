$(document).ready(function(){

    var initialDisplayName = $('#dispNameColValue').html();
    var initialEmail = $('#emailColValue').html();
    var correctSyntax;
    var fieldName;


    // When the "update button is pressed", this displays the form to change user details in the table
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
            changeFieldTipMessage($(this), emailCorrect(), "Email");
        }
        else if ($(this).attr('name') == "displayName") {
            changeFieldTipMessage($(this), displayNameCorrect(), "DisplayName");

        }
        else if ($(this).attr('name') == "password") {
            // this is extra to update repeat password message when password field is changed
            changeFieldTipMessage(
                $('input[name=repeatPassword]'), repeatPasswordCorrect(), "RepeatPassword"
            );

            changeFieldTipMessage($(this), passwordCorrect(), "Password");

        }
        else if ($(this).attr('name') == "repeatPassword") {
            changeFieldTipMessage($(this), repeatPasswordCorrect(), "RepeatPassword");
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

    function changeFieldTipMessage(thisObj, correctSyntax, fieldName) {
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
});
