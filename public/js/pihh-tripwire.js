// Require jQuery
$("form").each(function(){
    var input = document.createElement('input');
    input.name = 'pihhtw';
    input.type = 'hidden';
    $(this).append(input);
});
