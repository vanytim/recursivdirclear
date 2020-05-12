<?php

$default  = "c:r::d::";


$comand_data = getopt($default);


foreach($comand_data as $c_name => $c_data){

    switch ($c_name) {
        case 'c':
            create_test_dirs_with_files("test");
            break;
        
        default:
            # code...
            break;
    }

}


function create_test_dirs_with_files($name)
{
    mkdir($name);
    for ($i=1; $i <= 10 ; $i+1) { 
        mkdir($name.$i);
        $f = fopen($name.$i.".bat", "r+");
        fclose($f);
    }
}