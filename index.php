<?php

$default  = "c:r::d::";


$comand_data = getopt($default);

/* print_r($comand_data);
die(); */
foreach($comand_data as $c_name => $c_data){

    if($c_name and trim($c_data) != ""){
        create_test_dirs_with_files($c_data, $c_data."xx");
    }

}

die();

function create_test_dirs_with_files($path, $dir, $stop = 10)
{
    $parenrt = $path;
    @mkdir($parenrt);
    //rand(3, 10)
    for ($i=1; $i <=  $stop; $i++) { 
        $next_dir = $parenrt."\\". $dir.$i;
        @mkdir($next_dir);
        $f_bat = fopen($next_dir."/".$dir.$i.".bat", "a");
        fclose( $f_bat);
        if(rand(3, 5) == 4){
            $f_doc = fopen($next_dir."/".$dir.$i.".doc", "a");
            fclose($f_doc);
        }
        if( ($i + 0.5) * 2 < $stop)
        create_test_dirs_with_files($next_dir, $dir, rand(3, 5));
    }
}