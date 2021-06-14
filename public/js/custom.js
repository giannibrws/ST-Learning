

$(function() {

    // submit note:
    const myForm = $("#addNote");
    $(".createNote").click(function(){
        myForm.submit();
    });

    // delete note:
    $('.delete-confirm').on('click', function (event) {
        event.preventDefault();
        // if confirm redirect destroy route:
        const url = $(this).attr('href') + '/delete';
        var keyword = 'note';

        swal({
            title: 'Are you sure?',
            text: 'This ' + keyword + ' and it`s details will be permanantly deleted!',
            icon: 'warning',
            buttons: ["Cancel", "Yes!"],
        }).then(function(value) {
            if (value) {
                window.location.href = url;
            }
        });
    });



});

