@php
    $theme = $component->getTheme();
@endphp

@if ($theme === 'tailwind')
    <div class="rounded-md shadow-sm">
        <select multiple
            wire:model.stop="{{ $component->getTableName() }}.filters.{{ $filter->getKey() }}"
            wire:key="{{ $component->getTableName() }}-filter-{{ $filter->getKey() }}"
            id="{{ $component->getTableName() }}-filter-{{ $filter->getKey() }}"
            class="block w-full transition duration-150 ease-in-out border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 dark:bg-gray-800 dark:text-white dark:border-gray-600"
        >
        @if ($filter->getFirstOption() != "")
             <option @if($filter->isEmpty($this)) selected @endif value="all">{{ $filter->getFirstOption()}}</option>
        @endif
            @foreach($filter->getOptions() as $key => $value)
                @if (is_iterable($value))
                    <optgroup label="{{ $key }}">
                        @foreach ($value as $optionKey => $optionValue)
                            <option value="{{ $optionKey }}">{{ $optionValue }}</option>
                        @endforeach
                    </optgroup>
                @else
                    <option value="{{ $key }}">{{ $value }}</option>
                @endif
            @endforeach
        </select>
    </div>
    <div class="flex items-center ml-1 space-x-2">
        <div class="items-center">
            <input type="radio" wire:model.lazy="{{ $component->getTableName() }}.filters.{{ $filter->getKey() }}.operator" id="{{ $component->getTableName() }}.filters.{{ $filter->getKey() }}-operator-and" name="{{ $component->getTableName() }}.filters.{{ $filter->getKey() }}-operator" value="and" class="text-indigo-500 text-medium focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 dark:bg-gray-900 dark:text-white dark:border-gray-600 dark:hover:bg-gray-600 dark:focus:bg-gray-600 disabled:opacity-50 disabled:cursor-wait">
            <label class="text-xs" for="{{ $component->getTableName() }}.filters.{{ $filter->getKey() }}-operator-and">AND</label>
        </div>
        <div class="items-center">
            <input type="radio" wire:model.lazy="{{ $component->getTableName() }}.filters.{{ $filter->getKey() }}.operator" id="{{ $component->getTableName() }}.filters.{{ $filter->getKey() }}-operator-or" name="{{ $component->getTableName() }}.filters.{{ $filter->getKey() }}-operator" value="or" class="text-indigo-500 text-medium focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 dark:bg-gray-900 dark:text-white dark:border-gray-600 dark:hover:bg-gray-600 dark:focus:bg-gray-600 disabled:opacity-50 disabled:cursor-wait">
            <label class="text-xs" for="{{ $component->getTableName() }}.filters.{{ $filter->getKey() }}-operator-or">OR</label>
        </div>
    </div>
@elseif ($theme === 'bootstrap-4' || $theme === 'bootstrap-5')
    <select multiple
        wire:model.stop="{{ $component->getTableName() }}.filters.{{ $filter->getKey() }}"
        wire:key="{{ $component->getTableName() }}-filter-{{ $filter->getKey() }}"
        id="{{ $component->getTableName() }}-filter-{{ $filter->getKey() }}"
        class="{{ $theme === 'bootstrap-4' ? 'form-control' : 'form-select' }}"
    >
    @if ($filter->getFirstOption() != "")
        <option @if($filter->isEmpty($this)) selected @endif value="all">{{ $filter->getFirstOption()}}</option>
    @endif
        @foreach($filter->getOptions() as $key => $value)
            @if (is_iterable($value))
                <optgroup label="{{ $key }}">
                    @foreach ($value as $optionKey => $optionValue)
                        <option value="{{ $optionKey }}">{{ $optionValue }}</option>
                    @endforeach
                </optgroup>
            @else
                <option value="{{ $key }}">{{ $value }}</option>
            @endif
        @endforeach
    </select>
@endif
