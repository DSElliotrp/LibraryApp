<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Loan book') }}
            </h2>
        </div>
    </x-slot>
    <div class="max-w-xl mx-auto my-12 bg-gray-800 rounded-lg p-4">
    
        <form method="POST" action="/books/{{ $book->id }}/copies/{{ $copy->id }}/borrowing" enctype="multipart/form-data">
            @csrf
            <div class="space-y-12">
                <div class="border-b border-gray-900/10 pb-12">
                    <h2 class="text-base/7 font-semibold text-white">Loan book {{ $copy->reference }} to customer</h2>
                    <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6 max-w-md mx-auto">
                        <div class="sm:col-span-full">
                            <x-input-label for="customer_email" :value="__('Customer email')" />
                            <x-text-input id="customer_email" name="customer_email" type="text" class="mt-1 block w-full"
                                required placeholder="john@example.com" />
                            <x-input-error class="mt-2" :messages="$errors->get('customer_email')" />
                        </div>
                    </div>
                </div>
            </div>
            <div class="mt-6 flex items-center justify-end gap-x-6">
                <a href="/books/{{ $book->id }}" class="text-sm/6 font-semibold text-white">Cancel</a>
                <x-primary-button type="submit"
                    class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                    {{ __('Loan') }}
                </x-primary-button>
            </div>
        </form>
    </div>
</x-app-layout>
