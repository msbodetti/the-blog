<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @forelse ($posts as $post)
                <x-post
                    :id="$post->id"
                    :title="$post->title"
                    :content="strlen($post->content) > 100 ? substr(strip_tags($post->content), 0, 100) . '...' : strip_tags($post->content)"
                    :date="date('j F Y', strtotime($post->created_at))"
                    :author="$post->user->name"
                    :userId="$post->user->id"
                    :averageRating="$post->averageRating()"
                ></x-post>
            @empty
                <p>You haven't published any posts, <a class="underline" href="/posts/create">create a post now!</a></p>
            @endforelse
        </div>
    </div>
</x-app-layout>
