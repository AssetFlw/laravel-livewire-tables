<?php

namespace Rappasoft\LaravelLivewireTables\Events;

use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class FilterSet
{
    use Dispatchable, SerializesModels;

    public $key;

    public $filter;

    public $value;

    public function __construct($key, $filter, $value)
    {
        $this->key = $key;
        $this->filter = $filter;
        $this->value = $value;
    }
}
