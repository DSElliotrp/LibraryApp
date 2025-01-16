@props(['options' => []])

<div x-data="{ open: false, selected: [] }" @click.outside="open = false" class="relative border border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
    <div @click="open = !open" class="cursor-pointer p-2">
        <template x-if="selected.length === 0">
            <span class="text-gray-400">Select genres</span>
        </template>
        <template x-for="(option, index) in selected" :key="index">
            <span class="bg-blue-500 text-white rounded-md px-2 py-1 text-xs mr-1" x-text="option"></span>
        </template>
    </div>
    <div x-show="open" class="absolute z-10 mt-2 w-full p-2 border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
        <template x-for="(option, index) in @js($options)" :key="index">
            <div class="cursor-pointer p-2 hover:bg-gray-700" @click="selected.includes(option) ? selected = selected.filter(item => item !== option) : selected.push(option)">
                <span x-text="option"></span>
                <template x-if="selected.includes(option)">
                    <span class="text-green-500 ml-2">&#10003;</span>
                </template>
            </div>
        </template>
    </div>
    <input type="hidden" name="genres" :value="selected">
</div>
