Скрипт очистки от остаточных файло *.bat с возможностью удаления пустых папок(опционально)

1) Принимаемые параметры 
    a) -c <path> - параметр создает тестовую структуру папок и файлов в рандомном порядке
    б) -r <path> - выполняет очистку всего дерева папок от неиспользуемых файлов *.bat
    в) -d <path> - опционально работает в связке с "-r" иначе выкинет ошибку об неизвестном пути для удаления 

Вызов
/path to php/php.exe clearfile.php -c test_dir : создаст тестовую структуру папок
/path to php/php.exe clearfile.php -r test_dir : очистит от лишних *.bat файлов
/path to php/php.exe clearfile.php -r test_dir -d : удалит пустые папки или дерево пустых папок