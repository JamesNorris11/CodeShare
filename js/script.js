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

            var email = document.forms["registerForm"]["email"].value;
            var re = /\S+@\S+\.\S+/;

            correctSyntax = re.test(email);
        }
        else if ($(this).attr('name') == "displayName") {
            fieldName = "DisplayName";
            fieldMessage = "Something2"

        }
        else if ($(this).attr('name') == "password") {
            fieldName = "Password";
            fieldMessage = "Something3"
            //@TODO if first password is changed and that makes the passwords match then error message needs to go away!

        }
        else if ($(this).attr('name') == "repeatPassword") {

            // @TODO THIS DOESN'T WORK YET
            fieldName = "RepeatPassword";
            fieldMessage = "Your passwords do not match!"

            console.log($(this).text());
            console.log( $('input[name=password]').text());
            if ($(this).val() == $('input[name=password]').val()) {
                correctSyntax = true;
            }
            else {
                correctSyntax = false;
            }

        }

        if (correctSyntax == true) {
            $(this).css({"border": "1px solid #E25D33", "outline": "none"});
            $("#tip" + fieldName)
                .text("");
        }
        else {
            $(this).css({"border": "2px solid red", "outline": "none"});
            $("#tip" + fieldName)
                .text(fieldMessage)
                .css("color", "red");
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
            $('#helpMessage').text("Set a secure password. Do not make it too simple!");
        }
        else if ($(this).attr('id') == "helpRepeatPassword") {
            $('#helpMessage').text("This must match the first password exactly. Make sure you type it carefully!");
        }
    });

    $('.hoverHelp').mouseleave(function () {
        $('#helpMessage').hide();
    });

});
