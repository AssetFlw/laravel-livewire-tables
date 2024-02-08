@aware(['component'])
@props(['rows'])

@php
    $theme = $component->getTheme();
@endphp

@if ($component->hasConfigurableAreaFor('before-pagination'))
    @include(
        $component->getConfigurableAreaFor('before-pagination'),
        $component->getParametersForConfigurableArea('before-pagination'))
@endif

@if ($theme === 'tailwind')
    <div>
        @if ($component->paginationVisibilityIsEnabled())
            <div class="items-center justify-between px-4 mt-4 space-y-4 md:p-0 sm:flex sm:space-y-0">
                <div>
                    @if ($component->paginationIsEnabled() && $component->isPaginationMethod('standard') && $rows->lastPage() > 1)
                        <p class="text-sm leading-5 text-gray-700 paged-pagination-results ">
                            <span>@lang('Showing')</span>
                            <span class="font-medium">{{ $rows->firstItem() }}</span>
                            <span>@lang('to')</span>
                            <span class="font-medium">{{ $rows->lastItem() }}</span>
                            <span>@lang('of')</span>
                            <span class="font-medium"><span x-text="paginationTotalItemCount"></span></span>
                            <span>@lang('results')</span>
                        </p>
                    @elseif ($component->paginationIsEnabled() && $component->isPaginationMethod('simple'))
                        <p class="text-sm leading-5 text-gray-700 paged-pagination-results ">
                            <span>@lang('Showing')</span>
                            <span class="font-medium">{{ $rows->firstItem() }}</span>
                            <span>@lang('to')</span>
                            <span class="font-medium">{{ $rows->lastItem() }}</span>
                        </p>
                    @else
                        <p class="text-sm leading-5 text-gray-700 total-pagination-results ">
                            @lang('Showing')
                            <span class="font-medium">{{ $rows->count() }}</span>
                            @lang('results')
                        </p>
                    @endif
                </div>

                @if ($component->paginationIsEnabled())
                    {{ $rows->links('livewire-tables::specific.tailwind.pagination') }}
                @endif
            </div>
        @endif
    </div>
@elseif ($theme === 'bootstrap-4')
    <div >
        @if ($component->paginationVisibilityIsEnabled())
            @if ($component->paginationIsEnabled() && $component->isPaginationMethod('standard') && $rows->lastPage() > 1)
                <div class="mt-3 row">
                    <div class="overflow-auto col-12 col-md-6">
                        {{ $rows->links('livewire-tables::specific.bootstrap-4.pagination') }}
                    </div>

                    <div class="text-center col-12 col-md-6 text-md-right text-muted">
                        <span>@lang('Showing')</span>
                        <strong>{{ $rows->count() ? $rows->firstItem() : 0 }}</strong>
                        <span>@lang('to')</span>
                        <strong>{{ $rows->count() ? $rows->lastItem() : 0 }}</strong>
                        <span>@lang('of')</span>
                        <strong><span x-text="paginationTotalItemCount"></span></strong>
                        <span>@lang('results')</span>
                    </div>
                </div>
            @elseif ($component->paginationIsEnabled() && $component->isPaginationMethod('simple'))
                <div class="mt-3 row">
                    <div class="overflow-auto col-12 col-md-6">
                        {{ $rows->links('livewire-tables::specific.bootstrap-4.pagination') }}
                    </div>

                    <div class="text-center col-12 col-md-6 text-md-right text-muted">
                        <span>@lang('Showing')</span>
                        <strong>{{ $rows->count() ? $rows->firstItem() : 0 }}</strong>
                        <span>@lang('to')</span>
                        <strong>{{ $rows->count() ? $rows->lastItem() : 0 }}</strong>
                    </div>
                </div>
            @else
                <div class="mt-3 row">
                    <div class="col-12 text-muted">
                        @lang('Showing')
                        <strong>{{ $rows->count() }}</strong>
                        @lang('results')
                    </div>
                </div>
            @endif
        @endif
    </div>
@elseif ($theme === 'bootstrap-5')
    <div >
        @if ($component->paginationVisibilityIsEnabled())
            @if ($component->paginationIsEnabled() && $component->isPaginationMethod('standard') && $rows->lastPage() > 1)
                <div class="mt-3 row">
                    <div class="overflow-auto col-12 col-md-6">
                        {{ $rows->links('livewire-tables::specific.bootstrap-4.pagination') }}
                    </div>

                    <div class="text-center col-12 col-md-6 text-md-end text-muted">
                        <span>@lang('Showing')</span>
                        <strong>{{ $rows->count() ? $rows->firstItem() : 0 }}</strong>
                        <span>@lang('to')</span>
                        <strong>{{ $rows->count() ? $rows->lastItem() : 0 }}</strong>
                        <span>@lang('of')</span>
                        <strong><span x-text="paginationTotalItemCount"></span></strong>
                        <span>@lang('results')</span>
                    </div>
                </div>
            @elseif ($component->paginationIsEnabled() && $component->isPaginationMethod('simple'))
                <div class="mt-3 row">
                    <div class="overflow-auto col-12 col-md-6">
                        {{ $rows->links('livewire-tables::specific.bootstrap-4.pagination') }}
                    </div>

                    <div class="text-center col-12 col-md-6 text-md-end text-muted">
                        <span>@lang('Showing')</span>
                        <strong>{{ $rows->count() ? $rows->firstItem() : 0 }}</strong>
                        <span>@lang('to')</span>
                        <strong>{{ $rows->count() ? $rows->lastItem() : 0 }}</strong>
                    </div>
                </div>
            @else
                <div class="mt-3 row">
                    <div class="col-12 text-muted">
                        @lang('Showing')
                        <strong>{{ $rows->count() }}</strong>
                        @lang('results')
                    </div>
                </div>
            @endif
        @endif
    </div>
@endif

@if ($component->hasConfigurableAreaFor('after-pagination'))
    @include(
        $component->getConfigurableAreaFor('after-pagination'),
        $component->getParametersForConfigurableArea('after-pagination'))
@endif
