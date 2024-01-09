<?php

namespace App\Filters;

use Illuminate\Http\Request;
use App\Filters\ApiFilter;

class BookFilter extends ApiFilter {
    protected $safeParms = [
        'publisher'=> ['eq', 'ne'],
        'title'=> ['eq', 'ne'],
        'price'=> ['eq', 'ne', 'lt', 'gt'],
        'publish_year'=>['eq', 'ne', 'lt', 'gt'],
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