<?php

namespace App\Filters;

use Illuminate\Http\Request;
use App\Filters\ApiFilter;

class OrderFilter extends ApiFilter {
    protected $safeParms = [
        'user_id'=> ['eq'],
        'payment_id'=> ['eq'],
        'order_date'=> ['eq', 'lt', 'gt'],
        'state'=> ['eq', 'ne'],
        'city'=> ['eq', 'ne'],
        'street'=> ['eq', 'ne'],
        'building_number'=> ['eq'],
        'apartment_number'=> ['eq'],
        'zip_code'=> ['eq'],
        'total_price'=> ['eq', 'lt', 'gt', 'lte', 'gte'],
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