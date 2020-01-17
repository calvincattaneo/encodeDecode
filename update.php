<?php
include_once "configBD.php";

$id         = $_POST["id"];
$option     = $_POST["option"];
$tipoOption = $_POST["tipoOption"];
$convert    = $_POST["convert"];

//criando a query de consulta ? tabela criada
$query = "UPDATE banco_quest_questoes SET $tipoOption='".$option."' WHERE idQ=$id";

$sql = mysqli_query($cx, $query)
  or die(mysqli_error($cx) //caso haja um erro na consulta
);

if($sql){
  echo 1;
}else{
  echo 0;
}
