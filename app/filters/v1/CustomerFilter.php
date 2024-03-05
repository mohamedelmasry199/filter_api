<?php
namespace App\filters\v1;
use Illuminate\Http\Request;
use App\filters\ApiFilters;

class CustomerFilter extends ApiFilters {
    protected $safePramaters=[
        'name'=>['eq'],
        'type'=>['eq'],
        'email'=>['eq'],
        'address'=>['eq'],
        'city'=>['eq'],
        'state'=>['eq'],
        'postalCode'=>['eq','gt','lt']
    ];

    protected $columnMap=[
        'postalCode' => 'postal_code'
    ];

    protected $operatorMap = [
        'eq'=>'=',
        'lt'=> '<',
        'lte'=> '<=',
        'gt'=>'>',
        'gte'=>'>=',
    ];
}

?>
