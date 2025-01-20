<x-app-layout>
    <x-slot:header>
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit book details') }}
        </h2>
    </x-slot>
    <div class="max-w-xl mx-auto my-12 bg-gray-800 rounded-lg p-4">
        <form method="POST" action="/books/{{ $book->id }}">
            @csrf
            @method('PATCH')
            <div class="space-y-12">
                <div class="border-b border-gray-900/10 pb-12">
                    <h2 class="text-base/7 font-semibold text-white">Add a new book</h2>
                    <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6 max-w-md mx-auto">
                        <div class="sm:col-span-full">
                            <x-input-label for="title" :value="__('Title')" />
                            <x-text-input id="title" name="title" type="text" class="mt-1 block w-full"
                                required placeholder="The Great Gatsby" value="{{ $book->title }}"/>
                            <x-input-error class="mt-2" :messages="$errors->get('title')" />
                        </div>

                        <div class="sm:col-span-full">
                            <x-input-label for="author" :value="__('Author')" />
                            <x-text-input id="author" name="author" type="text" class="mt-1 block w-full"
                                required placeholder="F. Scott Fitzgerald" value="{{ $book->author }}" />
                            <x-input-error class="mt-2" :messages="$errors->get('author')" />
                        </div>

                        <div class="sm:col-span-full">
                            <x-input-label for="genres" :value="__('Genres (comma separated)')" />
                            <x-text-input id="genres" name="genres" type="text" class="mt-1 block w-full"
                                required placeholder="Biography,Non-Fiction" :value="$book->genres->pluck('name')->implode(',')"/>
                            <x-input-error class="mt-2" :messages="$errors->get('genres')" />
                        </div>

                        <div class="sm:col-span-full">
                            <x-input-label for="published_at" :value="__('Publication date')" />
                            <x-text-input id="published_at" name="published_at" type="text" class="mt-1 block w-full" value="{{ $book->published_at }}"
                                required />
                            <x-input-error class="mt-2" :messages="$errors->get('published_at')" />
                        </div>

                        <div class="sm:col-span-full">
                            <x-input-label for="isbn" :value="__('ISBN')" />
                            <x-text-input id="isbn" name="isbn" type="text" class="mt-1 block w-full" value="{{ $book->isbn }}"
                                required placeholder="123456789012" />
                            <x-input-error class="mt-2" :messages="$errors->get('isbn')" />
                        </div>

                        <div class="sm:col-span-full">
                            <x-input-label for="description" :value="__('Description')" />
                            <x-text-area-input id="description" name="description" type="text"
                                class="mt-1 block w-full" required
                                placeholder="Enter a few sentences describing the book.">
                                {{ $book->description }}
                            </x-text-area-input>
                            <x-input-error class="mt-2" :messages="$errors->get('description')" />
                        </div>

                        <div class="sm:col-span-full">
                            <x-input-label for="number_of_copies" :value="__('Number of copies')" />
                            <x-text-input id="number_of_copies" name="number_of_copies" type="number" value="{{ $book->availableCopies()->count() }}"
                                class="mt-1 block w-full" required />
                            <x-input-error class="mt-2" :messages="$errors->get('number_of_copies')" />
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-6 flex items-center justify-between gap-x-6">
                <div class="flex items-center gap-x-6">
                    <x-danger-button form="delete-form">
                        Delete
                    </x-danger-button>
                </div>
                <div class="flex items-center gap-x-6">
                    <a href="/books/{{ $book->id }}" class="text-sm/6 font-semibold text-white">Cancel</a>
                    <x-primary-button type="submit"
                        class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                        Update
                    </x-primary-button>
                </div>
            </div>
        </form>

        <form method="POST" action="/books/{{ $book->id }}" id="delete-form" class="hidden">
            @csrf
            @method('DELETE')
        </form>
    </div>

</x-app-layout>
