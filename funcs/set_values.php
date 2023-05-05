<?php

function set_values($data)
{
    foreach ($data as $key => $x) {

            $insert_values[] = "{$key} = :{$key}";
        
    }
    $to_string = implode(", ", $insert_values);

    return $to_string;
}


