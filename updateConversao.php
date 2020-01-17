<?php
include_once "configBD.php";

$id         = $_POST["id"];
$tipoOption = $_POST["tipoOption"];
$convert    = $_POST["convert"];

//criando a query de atualizaחדo
$query = "UPDATE banco_quest_questoes SET $tipoOption='".$convert."' WHERE idQ=$id";

$sql = mysqli_query($cx, $query)
  or die(mysqli_error($cx) //caso haja um erro na consulta
);

if($sql){
  echo 1;
}else{
  echo 0;
}
