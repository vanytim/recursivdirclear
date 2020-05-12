<?php

$default  = "c:r:d::";
$optind = true;

$comand_data = getopt($default, [], $false);

/* print_r($comand_data);
die(); */
foreach($comand_data as $c_name => $c_data){

    if($c_name == "c" and trim($c_data) != ""){
        create_test_dirs_with_files($c_data, $c_data."xx");
    }


    if($c_name == "r" and trim($c_data) != ""){
        clear_dir($c_data);
    }

    if($c_name == "d"){
      //  delete_dir($c_data);
    }



}

die();


/**
 * Функция рекурсивно создает папки и подпапки с файлами bat и doc 
 * doc файлы создаются рандомно 
 * 
 * @param mixed $path - начальный путь
 * @param mixed $dir - имя папки которая будет создана в указанной директории
 * @param int $stop  колличество вложений подпапок
 * @return void 
 */

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




function clear_dir($path){
   $exclude = [".", ".."];
   $dirs =  scandir( $path );
    // var_dump($dirs);
    rem_bat_file($path);

    foreach ($dirs as $df) {
        $next_path = $path . "/" . $df;
        if ( is_dir($next_path) and (!in_array($df, $exclude)) ) {
            rem_bat_file($next_path);
            clear_dir($next_path);
        }
    }

}



function rem_bat_file($path){

    $search_doc = glob($path . "/*.doc");
    $search_bat = glob($path . "/*.bat");

    //var_dump($search_bat); die;

    foreach ($search_bat as $bat) {
        $for_find_doc = substr($bat, 0, -4).".doc";
        //var_dump($for_find_doc); die;
        if (!in_array($for_find_doc, $search_doc)) {
            unlink($bat);
        }
    }
}