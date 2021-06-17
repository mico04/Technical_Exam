<?php

class SectionArea
{
    public static function partsBySection ($data)
    {
        $finres = array();
        foreach($data as $x => $val) {
            if (!in_array($val, $finres)) {
                $finres[$val] = array();
            }

        }
        foreach($data as $x => $val) {
            $finres[$val][] = $x;
        }
        


        return $finres;
        
        
    }
}

$data = array
(
    "Battery" => "Assembly",
    "Tablet" => "ITS",
    "Magnet" => "Assembly"
);


echo '<pre>'; print_r(SectionArea:: partsBySection ($data)) echo '</pre>';

