<?php

namespace App\Filters;

use Illuminate\Http\Request;
use App\Filters\ApiFilter;

class GenreFilter extends ApiFilter {
    protected $safeParms = [
        'name'=> ['eq', 'ne']
    ];

    protected $operatorMap = [
        'eq'=> '=',
        'lt'=> '<',
        'lte'=> '<=',
        'gt'=> '>',
        'gte'=> '>=',
        'ne' => '!='
    ];
}