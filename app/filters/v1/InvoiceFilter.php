<?php
namespace App\filters\v1;
use Illuminate\Http\Request;
use App\filters\ApiFilters;

class InvoiceFilter extends ApiFilters{
    protected $safePramaters=[
        'customer_id'=>['eq'],
        'amount'=>['eq','lt','gt','lte','gte'],
        'status'=>['eq','ne'],
        'billedDate'=>['eq','lt','gt','lte','gte'],
        'paidDate'=>['eq','lt','gt','lte','gte'],
    ];
    protected $columnMap =[
        'customerId'=>'customer_id',
        'billedDate'=>'billed_dated',
        'paidDate'=>'paid_dated'
    ];
    protected $operatorMap=[
        'eq'=>'=',
        'lt'=>'<',
        'gt'=>'>',
        'lte'=>'<=',
        'gte'=>'>=',
        'ne'=>'!='
    ];

}









?>
