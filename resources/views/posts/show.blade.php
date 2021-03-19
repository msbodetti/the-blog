<x-app-layout>
    <x-slot name="header">
        <div class="heading text-center font-bold text-2xl m-5 text-gray-800">{{ $post->title }}</div>
    </x-slot>
    <div class="p-8 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex justify-between">
        <div class="mt-2 mb-2 flex justify-start align-middle items-center">
            <img src="https://placeimg.com/640/480/people"
                     class="h-10 w-10 rounded-full mr-2 object-cover" />
            <span class="font-light text-gray-600 text-sm">
                {{ $post->user->name }}
                -
                {{ date('j F Y', strtotime($post->created_at)) }}
            </span>
        </div>
        <div>
            <!-- Rating Stars Box -->
            <div class='rating-stars text-center'>
                <ul id='stars'>
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
            <div class='success-box'>
                <div class="text-message py-3 px-5 mb-4 bg-green-100 text-green-900 text-sm rounded-md border border-green-200" role="alert">

                </div>
            </div>
        </div>
    </div>
    <div class="mt-4 mb-4 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        {!! $post->content !!}
    </div>
    <div class="mt-4 mb-4 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        @if(Auth::user()->id === $post->user->id)
            <a
                href="/posts/{!! $post->id !!}/edit"
                class="border border-gray-700 bg-gray-700 text-white rounded-md px-4 py-2 m-2 transition duration-500 ease select-none hover:bg-gray-800 focus:outline-none focus:shadow-outline"
            >
                Edit post
            </a>
        @endif
    </div>
    <script>
        $(document).ready(function(){
            const averageRating = {!! json_encode($post->averageRating()) !!};
            const postId = {!! json_encode($post->id) !!};
            if(averageRating > 0) {
                applyRating(averageRating);
            }
            /* 1. Visualizing things on Hover - See next part for action on click */
            $('#stars li').on('mouseover', function(){
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
            $('#stars li').on('click', function(){
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
                console.log(ratingValue);
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                const formData = {
                    post_id: postId,
                    rating: ratingValue
                };

                $.ajax({
                    type: 'POST',
                    url: '/ratings',
                    data: formData,
                    dataType: 'json',
                    success: function (data) {
                        const averageRating = data.averageRating;
                        if(averageRating > 0) {
                            applyRating(averageRating);
                            let msg = "";
                            if (ratingValue > 0) {
                                msg = "Thanks! You rated this " + ratingValue + " stars.";
                            }

                            responseMessage(msg);
                        }
                    },
                    error: function (error) {
                        console.log(error);
                    }
                });

            });


        });

        function applyRating(rating) {
            const stars = $('#stars li').parent().children('li.star');
            for (let i = 0; i < rating; i++) {
                $(stars[i]).addClass('selected');
            }
        }


        function responseMessage(msg) {
            $('.success-box').fadeIn(200);
            $('.success-box div.text-message').html("<span>" + msg + "</span>");
        }
    </script>
</x-app-layout>
