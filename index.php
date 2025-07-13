<?php
//переменная с ссылкой на текстовый файл
$file = 'emails.txt';

//настройка файла игнор новых строк и пустых линий
$lines = file($file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
//изменение регистра строк имейлов на нижний регистр через колбэк функцию
$normalizedEmails = array_map(function ($email){
    return strtolower(trim($email));
}, $lines);
//количество строк в файле
$emailCounts = array_count_values($normalizedEmails);
//проверка на количество дубликатов в файле через колбэк функцию
$duplicates = array_filter($emailCounts, function ($count){
    return $count > 1;
});

//проверка, найдены ли дубликаты
if (!empty($duplicates))
{
    echo "Найдены дубликаты имейлов: \n";
    foreach ($duplicates as $email => $count)
    {
        echo "- {$email} встречается {$count} раз(а)";
    }
} else {
    echo "Дубликаты email адресов не найдено";
}
