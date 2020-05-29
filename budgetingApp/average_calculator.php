<?php
require('query_class.php');

/**
 * Calculate % averages
 *
 * @return array
 */
function calculateGlobalAverage(){

    $query = new Query();
    $budgets = $query->getAllUserBudgets();
    $user_count = sizeof($budgets, 0);
    
    $result = array(
    		"entertainment" => 0,
    		"housing" => 0,
    		"recreation" => 0,
    		"nutrition" => 0,
    		"transportation" => 0,
    		"workstudy" => 0,
    		"savings" => 0,
    		"other" => 0);

    $keys = array_keys($result);

    $blank_fields = $result;
    
    //add all percentages
    for($i = 0; $i < $user_count; $i++){
        for($j = 0; $j < sizeof($result); $j++){
        	if($budgets[$i][$keys[$j]] != NULL){
        		$result[$keys[$j]] += $budgets[$i][$keys[$j]];
        	}
        	else{
        		$blank_fields[$keys[$j]]++;
        	}
        }
    }

    //divide to get avg
    for($k = 0; $k < sizeof($result); $k++){
        $result[$keys[$k]] = $result[$keys[$k]] / ($user_count - $blank_fields[$keys[$k]]);
    }
    
    return $result;
}

echo json_encode(calculateGlobalAverage());
?>