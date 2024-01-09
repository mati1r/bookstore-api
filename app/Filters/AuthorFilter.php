<?php

namespace App\Filters;

use Illuminate\Http\Request;
use App\Filters\ApiFilter;

class AuthorFilter extends ApiFilter {
    protected $safeParms = [
        'name'=> ['eq', 'ne'],
        'surname'=> ['eq', 'ne']
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