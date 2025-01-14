@props(['book'])

@php
    $availableCopiesCount = $book->availableCopies()->count();
@endphp

@foreach ($book->genres as $genre)
<span class="px-3 py-1 bg-blue-100 text-blue-800 text-xs font-semibold rounded-full mr-2 sm:text-sm">
    {{ $genre->name }}
</span>
@endforeach

@if ($availableCopiesCount > 0)
<span class="px-3 py-1 bg-green-100 text-green-800 text-xs font-semibold rounded-full sm:text-sm">
    {{ $availableCopiesCount }} Available
</span>
@else
<span class="px-3 py-1 bg-red-100 text-red-800 text-xs font-semibold rounded-full sm:text-sm">
    Not Available
</span>
@endif