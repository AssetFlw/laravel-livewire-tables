<?php

namespace Rappasoft\LaravelLivewireTables\Events;

use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class FilterSet
{
    use Dispatchable, SerializesModels;

    public $filters;
    public $key;

    public function __construct($key, $filters)
    {
        $this->key = $key;
        $this->filters = $filters;
    }
}
