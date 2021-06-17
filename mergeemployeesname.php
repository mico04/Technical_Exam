<?php

class EmployeeNames
{
    public static function unique_names ($array1, $array2)
    {
    	$finale = array_unique(array_merge($array1, $array2));
       	return $finale;
    }
}


//$array1 = array("jack", "marwan", "balato");
//$array2 = array("balato", "arniel","Ivana");
//echo EmployeeNames:: unique_names ($array1, $array2);

//echo join(', ', $empnames); // should print jack, marwan, balato, Arniel,Ivana

$empnames = EmployeeNames::unique_names(array("jack", "marwan", "balato"), array("balato", "arniel","Ivana"));

echo join(', ', $empnames); // should print jack, marwan, balato, Arniel,Ivana
?>