<?php

namespace Rappasoft\LaravelLivewireTables\Traits;

use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Events\FilterSet;
use Rappasoft\LaravelLivewireTables\Traits\Configuration\FilterConfiguration;
use Rappasoft\LaravelLivewireTables\Traits\Helpers\FilterHelpers;

trait WithFilters
{
    use FilterConfiguration,
        FilterHelpers;

    public bool $filtersStatus = true;

    public bool $filtersVisibilityStatus = true;

    public bool $filterPillsStatus = true;

    public bool $filterSlideDownDefaultVisible = false;

    public string $filterLayout = 'popover';

    public int $filterCount;

    protected $filterCollection;

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
                        $operator = (is_array($value) ? (array_key_exists('operator', $value) ? $value['operator'] : 'or') : 'or');
                        $options = (is_array($value) ? (array_key_exists('options', $value) ? $value['options'] : $value) : $value);
                        $options = $filter->validate($options);

                        if ($value === false) {
                            continue;
                        }

                        event(new FilterSet($this->getDataTableFingerprint(), $filter->getKey(), $options));

                        ($filter->getFilterCallback())($this->getBuilder(), $options, $operator);
                    }
                }
            }
        }

        return $this->getBuilder();
    }
}
