<div class="max-w-4xl px-10 my-4 py-6 bg-white rounded-lg shadow-md">
    <div class="flex justify-between items-center">
        <span class="font-light text-gray-600">{{ $date }}</span>
        @if(Auth::check() && Auth::user()->id === $userId)
            <a class="px-2 py-1 bg-gray-600 text-gray-100 font-bold rounded hover:bg-gray-500" href="/posts/{!! $id !!}/edit">
                Edit
            </a>
        @endif
    </div>
    <div class="mt-2">
        <a class="text-2xl text-gray-700 font-bold hover:text-gray-600" href="/posts/{!! $id !!}">
            {{ $title }}
        </a>
        <p class="mt-2 text-gray-600">{!! $content !!}</p>
    </div>
    <div class="flex justify-between items-center mt-4">
        <a class="text-blue-600 hover:underline" href="/posts/{!! $id !!}">Read more</a>
        <div>
            <a class="flex items-center" href="#">
                <img class="mx-4 w-10 h-10 object-cover rounded-full hidden sm:block" src="https://placeimg.com/640/480/people" alt="avatar">
                <h1 class="text-gray-700 font-bold">{{ $author }}</h1>
            </a>
        </div>
    </div>
</div>
