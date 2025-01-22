<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Book details') }}
            </h2>
        </div>
    </x-slot>

    <div class="max-w-2xl mx-2 sm:mx-auto grid grid-cols-3 gap-4 mt-12">
        <div class="md:col-span-1">
            <img alt="" src="{{ $book->photo_path ? asset($book->photo_path) : 'http://picsum.photos/seed/'.$book->id.'/400/600' }}" class="rounded-xl object-cover">
        </div>
        <div class="col-span-2 p-4 bg-gray-800 shadow-lg rounded-lg overflow-hidden relative">
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
        <div class="h-fit col-span-3 bg-gray-800 shadow-lg rounded-lg overflow-hidden p-8">
            <h3 class="text-white font-bold pb-2">{{__("Description")}}</h3>
            <p class="text-gray-200">{{ $book->description }}</p>
        </div>
        @can('loan books')
            <div class="col-span-3 bg-gray-800 shadow-lg rounded-lg overflow-hidden p-8 space-y-4">
                <h3 class="text-white font-bold pb-2">{{__("Copies")}}</h3>
                @foreach ($book->copies as $copy)
                    <div class="flex justify-between flex-col sm:flex-row gap-4 items-center p-2 col-span-3 md:col-span-1 bg-gray-700 shadow-lg rounded-lg overflow-hidden p-1">
                        <h3 class="text-white font-bold text-sm">{{ $copy->reference }}</h3>
                        @if ($copy->isBorrowed())
                            <p class="text-white">Due on: {{ $copy->activeBorrowing()->due_at }}</p>
                        @endif
                        <div class="flex gap-4">
                            @if (!$copy->isBorrowed())
                                <x-link-button href="/books/{{ $book->id }}/copies/{{ $copy->id }}/borrowing/create">
                                    {{ __('Loan') }}
                                </x-link-button>
                            @else
                                <x-primary-button type="submit" form="return-form-{{ $copy->id }}">
                                    {{ __('Return') }}
                                </x-primary-button>
                                <form method="POST" action="/books/{{ $book->id }}/copies/{{ $copy->id }}/borrowing/{{ $copy->activeBorrowing()->id }}/edit" id="return-form-{{ $copy->id }}" class="hidden">
                                    @csrf
                                </form>
                            @endif
                            <x-danger-button form="delete-form-{{ $copy->id }}">
                                {{ __('Delete') }}
                            </x-danger-button>
                            <form method="POST" action="/books/{{ $book->id }}/copies/{{ $copy->id }}" id="delete-form-{{ $copy->id }}" class="hidden">
                                @csrf
                                @method('DELETE')
                            </form>
                        </div>
                    </div>
                @endforeach
                <x-primary-button type="submit" form="add-form">
                    {{ __('Add copy') }}
                </x-primary-button>
                <form method="POST" action="/books/{{ $book->id }}/copies" id="add-form" class="hidden">
                    @csrf
                </form>
            </div>
        @endcan
        <div class="col-span-3 flex">
            @can('edit books')
                <x-link-button href="/books/{{ $book->id }}/edit">
                    {{ __('Edit book') }}
                </x-link-button>
            @endcan
        </div>
    </div>
</x-app-layout>
