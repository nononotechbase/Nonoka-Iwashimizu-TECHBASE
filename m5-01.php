<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
<form action="" method="POST">
    <input type="text" name="name" placeholder="名前">
    <input type="text" name="comment" placeholder="コメント">
    <input type="password" name="password" placeholder="パスワード">
    <input type="submit" value="登録">
</form>

<form action="" method="POST">
    <input type="number" name="number" placeholder="番号">
    <input type="password" name="confirmation" placeholder="パスワード">
    <input type="submit" name="delete" value="削除">
</form>

<form action="" method="POST">
<input type="number" name="editnumber" placeholder="編集番号">
<input type="text" name="newname" placeholder="新しい名前">
<input type="text" name="newcomment" placeholder="新しいコメント">
<input type="password" name="editconfirmation" placeholder="パスワード">
<input type="submit" value="編集">
</form>

<?php
// ・データベース名：
// ・ユーザー名：
// ・パスワード：

$dsn = 'mysql:dbname=データベース名;host=localhost';
$user= "ユーザー名";
$password="パスワード";

$pdo = new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
$sql = "create table if not exists mission5"
 ."("
 . "id INT AUTO_INCREMENT PRIMARY KEY,"
 . "name char(32),"
 . "comment TEXT,"
 . "password char(32),"
 . "datetime char(32)"
 .");";
// $sql = "DROP TABLE mission5";
$stmt = $pdo -> query($sql);
if(!empty($_POST["name"]) && !empty($_POST["password"])) {
$datetime = date("Y/m/d/H/i/s");
$name = $_POST["name"];
$comment = $_POST["comment"];
$confirmation = $_POST["password"];
$datetime = date("Y/m/d/H/i/s");
$sq = $pdo -> prepare("INSERT INTO mission5 (name, comment, password, datetime) VALUES (:name, :comment, :confirmation, :datetime)");
$sq -> bindParam(":name", $name, PDO::PARAM_STR);
$sq -> bindParam(":comment", $comment, PDO::PARAM_STR);
$sq -> bindParam(":confirmation", $confirmation, PDO::PARAM_STR);
$sq -> bindParam(":datetime", $datetime, PDO::PARAM_STR);
$sq -> execute();
}
$sql = "SELECT * from mission5";
// $sql = "DROP TABLE mission5";
$stmt = $pdo -> query($sql);
$result = $stmt -> fetchAll();
foreach($result as $v) {
echo "{$v["id"]}{$v["name"]}{$v["comment"]}{$v["datetime"]}". "<br>";
}
     
if(!empty($_POST["number"]) && !empty($_POST["confirmation"]))
{
$password = $_POST["confirmation"];
$id = $_POST["number"];
$delete = $pdo -> prepare("DELETE from mission5 where id = :id and password = :password");
$delete -> bindParam(":id", $id, PDO::PARAM_STR);
$delete -> bindParam(":password", $password, PDO::PARAM_STR);
$delete -> execute();
}
if(!empty($_POST["editnumber"]))
{
$editnumber = $_POST["editnumber"];
$newname = $_POST["newname"];
$newcomment = $_POST["newcomment"];
$newdate = date("Y/m/d/H/i/s");
$id = $_POST["editnumber"];
$confirmation = $_POST["editconfirmation"];
$edit = $pdo -> prepare("UPDATE mission5 set name = :newname, comment = :newcomment, datetime = :newdate where id = :id and password = :confirmation");
$edit -> bindParam(":newname", $newname, PDO::PARAM_STR);
$edit -> bindParam(":newcomment", $newcomment, PDO::PARAM_STR);
$edit -> bindParam(":newdate", $newdate, PDO::PARAM_STR);
$edit -> bindParam(":id", $id, PDO::PARAM_STR);
$edit -> bindParam(":confirmation", $confirmation, PDO::PARAM_STR);
$edit ->execute();
}
?>