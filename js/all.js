// change message of tip message depending on which field is being amended by the user
function changeTipMessage(thisObj, correctSyntax, fieldName, fieldMessage) {
    if (fieldName) {
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

// @return true or false
function emailCorrect()
{
    var len = $('input[name=email]').val().length;
    if (len <= 100) {
        var email = $('input[name=email]').val();
        var re = /^[a-zA-Z0-9_-]+@[a-zA-Z0-9_-]+\.[a-zA-Z0-9_-]+$/;

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