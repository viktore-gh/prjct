<?php
$DBH=new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
$DBH->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);