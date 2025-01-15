<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Book details') }}
            </h2>
            <x-link-button href="/books/{{ $book->id }}/edit">
                {{ __('Edit Book') }}
            </x-link-button>
        </div>
    </x-slot>

    <div class="max-w-2xl mx-2 sm:mx-auto bg-gray-800 shadow-lg rounded-lg overflow-hidden mt-12 relative">
        <div class="absolute top-0 right-0 mt-2 mr-2 text-xs text-gray-400 sm:text-sm">
            ISBN: {{ $book->isbn }}
        </div>
        <div class="px-8 py-8">
            <h1 class="text-2xl font-bold text-white mb-2">{{ $book->title }}</h1>
            <p class="text-gray-300 mb-4">By <span class="font-semibold">{{ $book->author }}</span></p>
            <div class="flex items-center mb-4">
                <x-books.book-tags :book="$book" />
            </div>
            <p class="text-gray-200 mb-4">{{ $book->description }}</p>
            @isset($book->published_at)
                <p class="text-gray-300 italic">Published on: <span class="font-semibold">{{ $book->published_at }}</span>
                </p>
            @endisset
        </div>
    </div>
</x-app-layout>
