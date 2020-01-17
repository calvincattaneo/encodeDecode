<?php
include_once "configBD.php";

$id = $_POST["id"];
$option = $_POST["option"];

//criando a query de consulta ? tabela criada
# $query = "SELECT idQ, $option FROM banco_quest_questoes WHERE idQ=$id";  
$query = "SELECT idQ, posicao, $option FROM banco_quest_questoes_itens WHERE idQ=$id";  
$sql = mysqli_query($cx, 
  $query) 
  or die(mysqli_error($cx) //caso haja um erro na consulta 
);

//pecorrendo os registros da consulta. 
while($row = mysqli_fetch_assoc($sql)){
  $set = array(
    "idQ" => $row["idQ"],
    "posicao" => $row["posicao"], // Posicao - Itens
    "$option" => htmlentities(utf8_encode($row["$option"])),
  );
}

//var_dump($set["idQ"]);
//var_dump($set["$option"]);
echo json_encode($set);