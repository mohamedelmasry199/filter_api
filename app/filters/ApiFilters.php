<?php
namespace App\filters;
use Illuminate\Http\Request;

class ApiFilters{
    protected $safePramaters=[];  //ex 'name'=>['eq'] ..,....,...,'postalCode'=>['eq','gt','lt']   eq==equal
    protected $columnMap =[];//real name in database as postalCode which is postal_code
    protected $operatorMap=[]; //eq => '='

    public function transform(Request $request){
        $eloQuery =[];
        foreach($this->safePramaters as $parm => $operators){
            $query = $request->query($parm);  //For example, in the URL http://example.com/?postalCode[gt]=50" ->$quuery=$request->query(postalCode) so $query is array ='gt' => 50,
            if(!isset($query)){
                continue; //If the current parameter is not present in the request's query string, skip to the next iteration of the loop." This is a way to handle cases where certain parameters might be optional, and the absence of a parameter should not disrupt the processing of other parameters.
            }
            $column = $this->columnMap[$parm] ?? $parm; // "If there's a mapping for the current parameter in $columnMap, use that as the column name; otherwise, use the parameter name as the default column name."

            foreach($operators as $operator){
                if(isset($query[$operator])){  //If there is a value for the current operator in the query string
                    $eloQuery[]=[$column , $this->operatorMap[$operator], $query[$operator]]; //$eloQuery[] = ['postal_code', '>', 50];

                }
            }
        }
        return $eloQuery;
    }

}

//----------------explain-------------
// First Iteration ($parameter = 'name', $operators = ['eq']):
// $query = $request->query('name');
// Since 'name' is not present in the URL, $query will be null.
// The condition if (!isset($query)) is true, so it continues to the next iteration.
// Second Iteration ($parameter = 'type', $operators = ['eq']):
// $query = $request->query('type');
// Since 'type' is not present in the URL, $query will be null.
// The condition if (!isset($query)) is true, so it continues to the next iteration.
// Third Iteration ($parameter = 'email', $operators = ['eq']):
// $query = $request->query('email');
// Since 'email' is not present in the URL, $query will be null.
// The condition if (!isset($query)) is true, so it continues to the next iteration.
// Fourth Iteration ($parameter = 'address', $operators = ['eq']):
// $query = $request->query('address');
// Since 'address' is not present in the URL, $query will be null.
// The condition if (!isset($query)) is true, so it continues to the next iteration.
// Fifth Iteration ($parameter = 'city', $operators = ['eq']):
// $query = $request->query('city');
// Since 'city' is not present in the URL, $query will be null.
// The condition if (!isset($query)) is true, so it continues to the next iteration.
// Sixth Iteration ($parameter = 'state', $operators = ['eq']):
// $query = $request->query('state');
// Since 'state' is not present in the URL, $query will be null.
// The condition if (!isset($query)) is true, so it continues to the next iteration.
// Seventh Iteration ($parameter = 'postalCode', $operators = ['eq', 'gt', 'lt']):
// $query = $request->query('postalCode');
// Since 'postalCode' is present in the URL with an operator 'gt', $query will be an array: ['gt' => 50].
// The condition if (!isset($query)) is false, so it proceeds to the next step.
// Inner Loop ($operator = 'eq', $operator = 'gt', $operator = 'lt'):
// For the 'postalCode' parameter, it iterates over the operators 'eq', 'gt', and 'lt'.
// In the first iteration, the condition if (isset($query['eq'])) is false.
// In the second iteration, the condition if (isset($query['gt'])) is true.
// It adds a condition to $eloQuery: ['postal_code', '>', 50].
// The result is that $eloQuery will be an array with the condition ['postal_code', '>', 50]. This condition can be used in an Eloquent query to filter customers based on the 'postalCode' parameter with a 'gt' (greater than) operator and a value of 5
//من الاخر بيلف علي ساف برامترز لحد ما يوصل لل موجودين في اليو ار ال و بعدين يلف علي الاوبريترز لحد ما يوصل للي موجودين في ال يو ار ال
?>
