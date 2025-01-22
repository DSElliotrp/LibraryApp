<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('My borrowed books') }}
            </h2>
        </div>
    </x-slot>

    <div class="space-y-4 my-12 max-w-4xl mx-auto my-12">
        @foreach ($borrowings as $borrowing)
            <a href="/books/{{ $borrowing->bookCopy->book->id }}" class="flex sm:flex-row-reverse text-white sm:pl-4 mx-2 border border-gray-200 rounded-lg bg-gray-800 hover:bg-gray-700 transition-colors duration-300 overflow-hidden">
                <img alt="" src="{{ $borrowing->bookCopy->book->photo_path ? asset($borrowing->bookCopy->book->photo_path) : 'http://picsum.photos/seed/'.$borrowing->bookCopy->book->id.'/400/600' }}" class="rounded-lg h-48 object-cover">
                <div class="m-4 h-auto w-full flex flex-col">
                    <div class="text-xl">
                        <strong>{{ $borrowing->bookCopy->book->title }}</strong> - <i>{{ $borrowing->bookCopy->book->author }}</i>
                    </div>
                    <p>{{ __('Due: ') . $borrowing->due_at }}</p>
                    <x-books.book-tags class="mt-auto flex flex-row-reverse sm:justify-start" :book="$borrowing->bookCopy->book" />
                </div>
            </a>
        @endforeach
    </div>

</x-app-layout>