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
            <x-rating :averageRating="$post->averageRating()" :id="$post->id"></x-rating>
        </div>
    </div>
    <div class="mt-4 mb-4 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        {!! $post->content !!}
    </div>
    <div class="mt-4 mb-4 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <x-post-actions :userId="$post->user->id" :id="$post->id"></x-post-actions>
    </div>
</x-app-layout>
