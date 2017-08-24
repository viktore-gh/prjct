<?php
require_once 'config.php';
require_once "lib/PDO.php";
require_once 'header.html';

class ListClass
{
   private $DBH;
    //создание экземпляра PDO для соединения с БД
    public function __construct(PDO $DBH)
    {
        $this->DBH = $DBH;
    }

    public function addNote($name, $note, $dateTime)
    {
        //подготовка запроса к выполнению
        $STH = $this->DBH->prepare("INSERT INTO list_note (name, note, date_time) 
                                    VALUES (:name, :note, :date_time)");
        //связывание параметров со значениями
        $STH->bindValue(":name", $name);
        $STH->bindValue(":note", $note);
        $STH->bindValue(":date_time", $dateTime);
        //запуск запроса на выполнение
        $STH->execute();
    }
    
    public function getAllNotes()
    {   //подготовка запроса к выполнению
        $STH = $this->DBH->prepare("SELECT  * FROM list_note ORDER BY date_time DESC");
        //запуск запроса на выполнение
        $STH->execute();
        //получение ассоциативного массива 
        $result = $STH->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
}

$obj = new ListClass($DBH);
$recordArray = $obj->getAllNotes();

if (count($recordArray) != 0) {
    foreach ($recordArray as $num => $name) {
        foreach ($name as $key => $value) {
            if ($key == "date_time")
                echo "<p><span class=\"date\">{$value}</span>\n";
            else if ($key == "name")
                echo "<span class=\"name\">{$value}</span></p>\n";
            else if ($key == "note")
                echo "<p>{$value}</p>\n";
        }
    }
}
require_once 'form.php';
require_once 'footer.html';
?> 
