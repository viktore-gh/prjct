<div id="wrapper">
<form method="post" name="newnote" action="">
<p><input name="name" class="form-control" placeholder="Заголовок" value="<?php if (!empty($_POST['name'])) {echo $_POST['name'];}?>" ></p>
<p><textarea name="note" class="form-control"  placeholder="Текст записи" ><?php if (!empty($_POST['note'])) { echo $_POST['note'];}?></textarea></p>
<p><input type="submit" name="submit" class="btn btn-primary btn-block"  value="Добавить запись"></p>
</form>
</div>

<?php
$isError = false;

if (isset($_POST['submit'])) {
    $name = htmlspecialchars($_POST["name"]);
    $note = htmlspecialchars($_POST["note"]);
    
    function check_input($data, $problem = "")
    {
        //очистка данных от тегов
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        
        //проверка длины строки
        if ($problem && strlen($data) == 0) {
        	global $isError;
            $isError = true;
            show_error($problem);
            
        }
        return $data;
        
    }
    
    function show_error($myError = "Произошла ошибка!")
    {
        
        echo "<div id=\"wrapper\" class=\"info alert alert-danger\">{$myError}</div>";
        exit();
    }
    
    $name = check_input($_POST["name"], "Введите заголовок!");
    $note = check_input($_POST["note"], "Введите ввести текст записи!");

    //если после проверки формы нет ошибок, вызываем метод addNote() для добавления записи в БД
    if ($isError == false) {
    	//текущие дата и время
        $dateTime = date("Y-m-d H:i:s", time() + 3600 * 3);
        $obj->addNote($name, $note, $dateTime);
        header("Location: /list_note/index.php");
    }
}
?>