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
            <a href="/books/{{ $book['id'] }}" class="flex sm:flex-row-reverse text-white sm:pl-4 mx-2 border border-gray-200 rounded-lg bg-gray-800 hover:bg-gray-700 transition-colors duration-300 overflow-hidden">
                <img alt="" src="{{ $book->photo_path ? asset($book->photo_path) : 'http://picsum.photos/seed/'.$book->id.'/400/600' }}" class="rounded-lg h-48 object-cover">
                <div class="m-4 h-auto w-full flex flex-col">
                    <div class="text-xl">
                        <strong>{{ $book->title }}</strong> - <i>{{ $book->author }}</i>
                    </div>
                    <x-books.book-tags class="mt-auto flex flex-row-reverse sm:justify-start" :book="$book" />
                </div>
            </a>
        @endforeach
        <div>
            {{ $books->withQueryString()->links() }}
        </div>
    </div>


</x-app-layout>