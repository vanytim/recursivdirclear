<?php

$default  = "c:r:d:"; //принимаемые параметры

$comand_data = getopt($default, [], $false); //получение массива команд с параметрами


$start_path = "";

/**
 * проверка каждого параметра на соответствие
 */

foreach($comand_data as $c_name => $c_data){

    if($c_name == "c" and trim($c_data) != ""){
        create_test_dirs_with_files($c_data, $c_data."xx");
    }elseif($c_name == "с" and trim($c_data) == ""){
        echo ("Warning: Параметр '-с' не может быть пустым"); die();
    }


    if($c_name == "r" and trim($c_data) != ""){
        $start_path = $c_data;
        clear_dir($c_data);
    }elseif($c_name == "r" and trim($c_data) == ""){
        echo ("Warning: Параметр '-r' не может быть пустым"); die();
    }

    if($c_name == "d"){
        if(isset($comand_data["r"]))
        delete_dir($start_path);
        else
        echo ("Warning: Не известный путь для очистки используйте вместе с параметром '-r'"); die();
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

/**
 * Функция удаляет директорю или дерево дерикторий если соответствующие пусты
 * @param mixed $path начальный путь сканирования
 */

function delete_dir($path){
    $exclude = [".", ".."];
    $dirs =  scandir( $path );

    if(count(array_diff($dirs, $exclude)) == 0){
        rmdir($path);
        return;
    }

    foreach ($dirs as $df) {
        $next_path = $path . "/" . $df;
        if ( is_dir($next_path) and (!in_array($df, $exclude)) ) {
            $s_dir = scandir( $next_path );
            $rm_exclude = array_diff($s_dir, $exclude);
            $has_element = count( $rm_exclude );
            if($has_element){ 
                delete_dir($next_path);
            }
            else{
                rmdir($next_path);
                $parent = substr($next_path, 0, strrpos($next_path, "/"));
                delete_dir($parent);
            }
            
        }
    }
}

/**
 * функци рекурсивно проходит по всем вложенным папкам и вызывает функцию очистки папки от лишних *.bat файлов 
 * 
 * @param mixed $path начальная директория для сканирования
 */
function clear_dir($path){
   $exclude = [".", ".."];
   $dirs =  scandir( $path );

    rem_bat_file($path);

    foreach ($dirs as $df) {
        $next_path = $path . "/" . $df;
        if ( is_dir($next_path) and (!in_array($df, $exclude)) ) {
            rem_bat_file($next_path);
            clear_dir($next_path);
        }
    }

}

/**
 * удаляет *.bat файл если у него нету соответствующего ему *.doc файла
 * 
 * @param mixed $path путь к папке с файлами для проверки 
 */

function rem_bat_file($path){

    $search_doc = glob($path . "/*.doc");
    $search_bat = glob($path . "/*.bat");

    foreach ($search_bat as $bat) {
        $for_find_doc = substr($bat, 0, -4).".doc";

        if (!in_array($for_find_doc, $search_doc)) {
            unlink($bat);
        }
    }
}