$(document).ready(function(){

    var correctSyntax;
    var fieldName;
    var fieldMessage;

    $('#helpMessage').hide();

    $('.hoverHelp').mouseover(function () {

        // This needs setting as initially set as display: none;
        $('#helpMessage').css("display", "inline-block");

        $('#helpMessage').show();

        if ($(this).attr('id') == "helpByDescription") {
            $('#helpMessage').text("Search for posts by description. The results for this search will include any posts with your search phrase in their description.");
        }
        else if ($(this).attr('id') == "helpByDisplayName") {
            $('#helpMessage').text("Search for posts by display name. Your search must match the display name of a user exactly to find their posts.");
        }
    });

    $('.hoverHelp').mouseleave(function () {
        $('#helpMessage').hide();
    });
});
