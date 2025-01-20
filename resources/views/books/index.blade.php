<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Books') }}
            </h2>
            @can('create books')
                <x-link-button href="/books/create">
                    {{ __('Add Book') }}
                </x-link-button>
            @endcan
        </div>
    </x-slot>

    <div class="w-full max-w-2xl mx-auto my-24 bg-gray-800 p-8 rounded-lg">
        <form method="GET" action="/books">
            <x-text-input
                id="query"
                name="query"
                type="text"
                class="mx-auto w-full p-4"
                placeholder="Search by title, author or genre"
                value="{{ request('query') }}"
                />
            </form>
    </div>

    <div class="space-y-4 my-12 max-w-4xl mx-auto my-12">
        @foreach ($books as $book)
            <a href="/books/{{ $book['id'] }}" class="text-white block px-4 py-10 sm:py-8 mx-2 border border-gray-200 rounded-lg bg-gray-800 hover:bg-gray-700 overflow-hidden relative">
                <x-books.book-tags class="absolute top-0 right-0 mt-2 mr-2" :book="$book" />
                <strong>{{ $book->title }}</strong> - <i>{{ $book->author }}</i>
            </a>
        @endforeach
    </ul>

    <div>
        {{ $books->withQueryString()->links()}}
    </div>

</x-app-layout>