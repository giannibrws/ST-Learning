$(document).ready(function(){

    let cooldown = false;
    const cooldown_time = 100; // 100ms of cooldown to prevent request exhaustion.

    function startCooldown() {
        cooldown = true;
        setTimeout (function(){ cooldown = false}, cooldown_time);
    }

    $('#searchClassrooms').on('keyup keydown', function () {
        var searchRequest = $(this).val();
        console.log(searchRequest);

        // start searching only if 3 or more & refresh if 1 or less.
        if((!cooldown && searchRequest.length >= 3) || (!cooldown && searchRequest.length == 0)){
              $.ajax({
                url: "classrooms/search",
                type: 'GET',
                data: {
                    'searchRequest': searchRequest
                },
                success:function(data){
                    // console.log(data)

                    // Manipulate DOM:
                    $('#dynamic_cr_results').html(data);
                    // show last card once user has finished searching:
                    searchRequest.length <= 1 ? $('#cr_card_submit').show() : $('#cr_card_submit').hide()
                }
            });
              // allow 100ms of cooldown:
            startCooldown();
        }
    });
});

