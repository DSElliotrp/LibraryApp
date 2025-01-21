@props(['book'])

@php
    $availableCopiesCount = $book->availableCopies()->count();
@endphp

<div {{ $attributes(["class" => "flex flex-wrap gap-2 items-center"]) }}>
    @foreach ($book->genres as $genre)
    <span class="px-3 py-1 bg-blue-100 text-blue-800 text-xs font-semibold rounded-full">
        {{ $genre->name }}
    </span>
    @endforeach
    
    @if ($availableCopiesCount > 0)
    <span class="px-3 py-1 bg-green-100 text-green-800 text-xs font-semibold rounded-full">
        {{ $availableCopiesCount }} Available
    </span>
    @else
    <span class="px-3 py-1 bg-red-100 text-red-800 text-xs font-semibold rounded-full">
        Not Available
    </span>
    @endif
</div>