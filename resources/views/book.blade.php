<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ $book['title'] }}
        </h2>
    </x-slot>

    <div>
        <p class="text-white">
            {{ $book['author'] }}
        </p>
        {{-- <p class="text-gray-500">
            {{ $book['published'] }}
        </p>
        <p class="text-gray-500">
            {{ $book['genre'] }}
        </p> --}}
    </div>
</x-app-layout>