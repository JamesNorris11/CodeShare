$(document).ready(function(){

    var correctSyntax;
    var fieldName;
    var fieldMessage;
    var initString = '<span id="helpBoxQ">?</span>';

    $('#helpMessage').hide();

    $('.hoverHelp').mouseover(function () {

        // This needs setting as initially set as display: none;
        $('#helpMessage').css("display", "block");

        $('#helpMessage').show();

        if ($(this).attr('id') == "helpTextUpload") {
            $('#helpMessage').html(initString + 'Enter text here that you would like to upload. This could be program code or any other type of text.');
        }
        else if ($(this).attr('id') == "helpDescription") {
            $('#helpMessage').html(initString + 'Enter a description of your post here. This field is optional.');
        }
        else if ($(this).attr('id') == "helpPassword") {
            $('#helpMessage').html(initString + 'Enter a password for your post, allowing you to choose who can view your post by giving selected people the password. This field is optional.');
        }
        else if ($(this).attr('id') == "helpSyntax") {
            $('#helpMessage').html(initString + 'Here you can select the programming language that your post uses. Your post will then be displayed with syntax highlighting. This field is optional.');
        }
    });

    $('.hoverHelp').mouseleave(function () {
        $('#helpMessage').hide();
    });
});
