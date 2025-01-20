<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Book details') }}
            </h2>
        </div>
    </x-slot>

    <div class="max-w-2xl mx-2 sm:mx-auto grid grid-rows-4 grid-cols-3 md:grid-rows-3 gap-4 mt-12">
        <div class="md:col-span-1 md:row-span-1">
            <img alt="" src="{{ $book->photo_path ? asset($book->photo_path) : 'http://picsum.photos/seed/'.$book->id.'/400/600' }}" class="rounded-xl">
        </div>
        <div class="col-span-2 row-span-1 p-4 bg-gray-800 shadow-lg rounded-lg overflow-hidden relative">
            <div class="absolute top-0 right-0 mt-2 mr-2 text-xs text-gray-400 sm:text-sm">
                ISBN: {{ $book->isbn }}
            </div>
            <div class="flex flex-col pt-2 md:p-8 h-full justify-between">
                <h1 class="text-2xl font-bold text-white mb-2">{{ $book->title }}</h1>
                <p class="text-gray-300 mb-4">By <span class="font-semibold">{{ $book->author }}</span></p>
                <x-books.book-tags class="mb-4" :book="$book" />
                @isset($book->published_at)
                    <p class="mt-auto text-gray-300 italic">Published on: <span class="font-semibold">{{ $book->published_at }}</span>
                    </p>
                @endisset
            </div>
        </div>
        <div class="h-fit col-span-3 row-span-2 md:col-span-3 md:row-span-1 bg-gray-800 shadow-lg rounded-lg overflow-hidden p-8">
            <h3 class="text-white font-bold pb-2">{{__("Description")}}</h3>
            <p class="text-gray-200">{{ $book->description }}</p>
        </div>
        @can('edit books')
            <x-link-button class="md:col-span-1 md:row-span-1" href="/books/{{ $book->id }}/edit">
                {{ __('Edit Book') }}
            </x-link-button>
        @endcan
    </div>

</x-app-layout>
