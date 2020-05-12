<h1> Скрипт очистки от остаточных файло *.bat с возможностью удаления пустых папок(опционально) </h1>
<br>

<b> Принимаемые параметры</b> <br>
    a) -c <path> - параметр создает тестовую структуру папок и файлов в рандомном порядке<br>
    б) -r <path> - выполняет очистку всего дерева папок от неиспользуемых файлов *.bat<br>
    в) -d <path> - опционально работает в связке с "-r" иначе выкинет ошибку об неизвестном пути для удаления <br>


<b>Вызом</b><br>
/path to php/php.exe /path to /clearfile.php -r /path/to/clear/dir -d (optional)

<b>Пример</b><br>
/path to php/php.exe clearfile.php -c test_dir : создаст тестовую структуру папок<br>
/path to php/php.exe clearfile.php -r test_dir : очистит от лишних *.bat файлов<br>
/path to php/php.exe clearfile.php -r test_dir -d : удалит пустые папки или дерево пустых папок
