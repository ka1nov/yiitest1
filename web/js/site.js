$(document).ready(function() {
    $('#phones').on('click', '.remove', function() {
        $(this).parents('.form-group').remove();
        return false;
    });
    $('#addphone').click(function() {
        $('#phones .form-group:first').clone().appendTo('#phones');
        $('#phones .form-group:last input').val('');
        return false;
    });
});
