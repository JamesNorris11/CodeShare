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

        else if ($(this).attr('name') == "password") {

            fieldName = "Password";
            fieldMessage = "Please enter a valid password"

            correctSyntax = passwordCorrect();
        }

        changeTipMessage($(this), correctSyntax, fieldName, fieldMessage);
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

    $('.submit').click(function(e) {
        if ((!emailCorrect()) || (!passwordCorrect())) {
            e.preventDefault()
        }
    });

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

    function passwordCorrect()
    {
        var len = $('input[name=password]').val().length;
        if ((len >= 1) && (len <= 100)) {
            return true;
        }
        else {
            return false;
        }
    }

});
