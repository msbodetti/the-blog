<x-app-layout>
    <x-slot name="header">
        <div class="heading text-center font-bold text-2xl m-5 text-gray-800">Edit Post</div>
    </x-slot>
    @if ($errors->any())
        <div class="alert alert-danger">
            @foreach ($errors->all() as $error)
                <div class="py-3 px-5 mb-4 bg-red-100 text-red-900 text-sm rounded-md border border-red-200" role="alert">
                    {{ $error }}
                </div>
            @endforeach
        </div>
    @endif
    {!! Form::open(['route' => ['posts.update', $post->id], 'method' => 'put']) !!}
    <div class="editor mx-auto w-10/12 flex flex-col text-gray-800 border border-gray-300 p-4 shadow-lg max-w-2xl m-5">
        {!! Form::text('title', $post->title, [
            'placeholder' => 'Title',
            'class' => 'title bg-gray-100 border border-gray-300 p-2 mb-4 outline-none',
            'required'
        ]) !!}
        <textarea name="content"></textarea>

        <!-- buttons -->
        <div class="buttons flex mt-4">
            <div class="btn border border-gray-300 p-1 px-4 font-semibold cursor-pointer text-gray-500 ml-auto">Cancel</div>
            {!! Form::submit('Update', ['class' => 'btn border border-indigo-500 p-1 px-4 font-semibold cursor-pointer text-gray-200 ml-2 bg-indigo-500']) !!}
        </div>
    </div>
    {!! Form::close() !!}
    <script>
        tinymce.init({
            selector: 'textarea',
            plugins: 'a11ychecker advcode casechange formatpainter linkchecker autolink lists checklist media mediaembed pageembed permanentpen powerpaste table advtable tinycomments tinymcespellchecker',
            toolbar: 'a11ycheck addcomment showcomments casechange checklist code formatpainter pageembed permanentpen table',
            toolbar_mode: 'floating',
            tinycomments_mode: 'embedded',
            tinycomments_author: 'Author name',
            setup: function (editor) {
                editor.on('init', function () {
                    const content = {!! json_encode($post->content) !!};
                    editor.setContent(content);
                });
            }
        });
    </script>
</x-app-layout>
