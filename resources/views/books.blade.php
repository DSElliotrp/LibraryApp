<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Books') }}
        </h2>
    </x-slot>

    <div class="space-y-4 my-12 max-w-7xl mx-auto my-12">
        @foreach ($books as $book)
            <a href="/book/{{ $book['id'] }}" class="text-white block px-4 py-10 sm:py-8 mx-2 border border-gray-200 rounded-lg bg-gray-800 hover:bg-gray-700 overflow-hidden relative">
                <div class="absolute top-0 right-0 mt-2 mr-2">
                    <x-books.book-tags :book="$book" />
                </div>
                <strong>{{ $book->title }}</strong> - <i>{{ $book->author->name }}</i>
            </a>
        @endforeach
    </ul>

    <div>
        {{ $books->links()}}
    </div>

</x-app-layout>