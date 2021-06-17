{{--Search box: --}}
<div class="absolute mx-4 right-0 -mt-5">
    <span class="absolute inset-y-0 left-0 pl-3 flex items-center">
        <i class="fas fa-search"></i>
    </span>
    <input class="items-end form-input w-32 sm:w-64 rounded-md pl-10 pr-4 focus:border-indigo-600"
           type="text"
           wire:model="query"
           placeholder="Search" id="searchClassrooms">
</div>
{{--End Search box: --}}
