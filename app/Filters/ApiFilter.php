<?php

namespace App\Filters;

use Illuminate\Http\Request;

class ApiFilter {
    protected $safeParms = [];

    protected $operatorMap = [];

    public function transform(Request $request) {
        $eloquentQuery = [];

        foreach ($this->safeParms as $parm => $operators) {
            $query = $request->query($parm);

            if(!isset($query)) {
                continue;
            }

            foreach ($operators as $operator) {
                if(isset($query[$operator])){
                    $eloquentQuery[] = [$parm, $this->operatorMap[$operator], $query[$operator]];
                }
            }
        }

        return $eloquentQuery;
    }
}