<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Books') }}
        </h2>
    </x-slot>

    <div class="space-y-4 m-6">
        @foreach ($books as $book)
            <a href="/book/{{ $book['id'] }}" class="text-white block px-4 py-6 border border-gray-200 rounded-lg bg-gray-800 hover:bg-gray-700">
                {{ $book['title'] }}
            </a>
        @endforeach
    </ul>

    <div>
        {{ $books->links()}}
    </div>

</x-app-layout>