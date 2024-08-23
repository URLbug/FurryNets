$(document).ready(function(){
    $('form').on('submit', function(event){
        event.preventDefault();

        var formId = '#' + $(event.target).attr('id');

        var url = $(formId).attr('data-action');

        $.ajax({
            url: url,
            method: 'POST',
            data: new FormData($(formId)[0]),
            dataType: 'JSON',
            contentType: false,
            cache: false,
            processData: false,
            success:function(response)
            {
                $('#likes-' + response.id).html('<i class="fa-solid fa-heart"></i>' + response.likes + ' Like');
            },
            error: function(response) {
                console.log(response);
            }
        });
    });

});