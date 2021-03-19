<div>
    <!-- Rating Stars Box -->
    <div class='rating-stars text-center'>
        <ul id='stars' class="post-{{ $id }}">
            <li class='star' title='Poor' data-value='1'>
                <i class='fa fa-star fa-fw'></i>
            </li>
            <li class='star' title='Fair' data-value='2'>
                <i class='fa fa-star fa-fw'></i>
            </li>
            <li class='star' title='Good' data-value='3'>
                <i class='fa fa-star fa-fw'></i>
            </li>
            <li class='star' title='Excellent' data-value='4'>
                <i class='fa fa-star fa-fw'></i>
            </li>
            <li class='star' title='WOW!!!' data-value='5'>
                <i class='fa fa-star fa-fw'></i>
            </li>
        </ul>
    </div>
    <div class='success-box post-{{ $id }}'>
        <div class="text-message py-3 px-5 mb-4 bg-green-100 text-green-900 text-sm rounded-md border border-green-200" role="alert">

        </div>
    </div>
</div>
<script>
    $(document).ready(function(){
        const averageRating = {!! json_encode($averageRating) !!};
        const postId = {!! json_encode($id) !!};

        if(averageRating > 0) {
            applyRating(averageRating, postId);
        }
        /* 1. Visualizing things on Hover - See next part for action on click */
        $(`#stars.post-${postId} li`).on('mouseover', function(){
            var onStar = parseInt($(this).data('value'), 10); // The star currently mouse on

            // Now highlight all the stars that's not after the current hovered star
            $(this).parent().children('li.star').each(function(e){
                if (e < onStar) {
                    $(this).addClass('hover');
                }
                else {
                    $(this).removeClass('hover');
                }
            });

        }).on('mouseout', function(){
            $(this).parent().children('li.star').each(function(e){
                $(this).removeClass('hover');
            });
        });


        /* 2. Action to perform on click */
        $(`#stars.post-${postId} li`).on('click', function(){
            const onStar = parseInt($(this).data('value'), 10); // The star currently selected
            const stars = $(this).parent().children('li.star');

            for (i = 0; i < stars.length; i++) {
                $(stars[i]).removeClass('selected');
            }

            for (i = 0; i < onStar; i++) {
                $(stars[i]).addClass('selected');
            }

            // Send rating to backend
            const ratingValue = parseInt($('#stars li.selected').last().data('value'), 10);

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            const data = {
                post_id: postId,
                rating: ratingValue
            };

            $.ajax({
                type: 'POST',
                url: '/ratings',
                data,
                dataType: 'json',
                success: function (data) {
                    const averageRating = data.averageRating;
                    if(averageRating > 0) {
                        applyRating(averageRating, postId);
                        let msg = "";
                        if (ratingValue > 0) {
                            msg = "Thanks! You rated this " + ratingValue + " stars.";
                        }

                        responseMessage(msg, postId);
                    }
                },
                error: function (error) {
                    console.log(error);
                }
            });

        });


    });

    function applyRating(rating, postId) {
        const stars = $(`#stars.post-${postId} li`).parent().children('li.star');
        for (let i = 0; i < rating; i++) {
            $(stars[i]).addClass('selected');
        }
    }


    function responseMessage(msg, postId) {
        $(`.success-box.post-${postId}`).fadeIn(200);
        $(`.success-box.post-${postId} div.text-message`).html("<span>" + msg + "</span>");
    }
</script>
