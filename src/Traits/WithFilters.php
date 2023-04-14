<?php

namespace Rappasoft\LaravelLivewireTables\Traits;

use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Traits\Configuration\FilterConfiguration;
use Rappasoft\LaravelLivewireTables\Traits\Helpers\FilterHelpers;
use Rappasoft\LaravelLivewireTables\Events\FilterSet;

trait WithFilters
{
    use FilterConfiguration,
        FilterHelpers;

    public bool $filtersStatus = true;
    public bool $filtersVisibilityStatus = true;
    public bool $filterPillsStatus = true;
    public bool $filterSlideDownDefaultVisible = false;
    public string $filterLayout = 'popover';

    public function filters(): array
    {
        return [];
    }

    public function applyFilters(): Builder
    {
        if ($this->filtersAreEnabled() && $this->hasFilters() && $this->hasAppliedFiltersWithValues()) {
            foreach ($this->getFilters() as $filter) {
                foreach ($this->getAppliedFiltersWithValues() as $key => $value) {
                    if ($filter->getKey() === $key && $filter->hasFilterCallback()) {
                        
                        // Let the filter class validate the value
                        $operator = (array_key_exists('operator', $value)?$value['operator']:'or');
                        $options = (array_key_exists('options', $value)?$value['options']:$value);
                        $options = $filter->validate($options);
                        

                        if ($value === false) {
                            continue;
                        }

                        event(new FilterSet($this->dataTableFingerprint(), $filter->getKey(), $options));

                        ($filter->getFilterCallback())($this->getBuilder(), $options, $operator);
                    }
                }
            }
        }

        return $this->getBuilder();
    }
}
