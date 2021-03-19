@if(Auth::check() && Auth::user()->id === $userId ?? '')
    <a class="mx-2 px-2 py-1 bg-gray-600 text-gray-100 font-bold rounded hover:bg-gray-500" href="/posts/{!! $id !!}/edit">
        Edit
    </a>
    <button id="delete" class="post-{{ $id }} mx-2 px-2 py-1 bg-red-600 text-white font-bold rounded hover:bg-red-500">
        Delete
    </button>
    <script>
        $(`#delete.post-{{ $id }}`).click(() => {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: 'POST',
                url: '/posts/{{ $id }}',
                data:{
                    _method:"DELETE"
                },
                dataType: 'json',
                success: function (data) {
                    if(data.success) {
                        window.location = '/dashboard';
                    }
                },
                error: function (error) {
                    console.log(error);
                }
            });
        })
    </script>
@endif
