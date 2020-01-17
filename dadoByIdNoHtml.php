<?php
include_once "configBD.php";

$id         = $_POST["id"];
$tipoOption = $_POST["tipoOption"];

//criando a query de consulta ? tabela criada
$query = "SELECT idQ, posicao, $tipoOption FROM banco_quest_questoes_itens WHERE idQ=$id AND posicao=$posicao";
$sql = mysqli_query($cx,
  $query)
  or die(mysqli_error($cx) //caso haja um erro na consulta
);

//pecorrendo os registros da consulta.
while($row = mysqli_fetch_assoc($sql)){
  $set = array(
    "idQ" => $row["idQ"],
    "posicao" => $row["posicao"],
    "$tipoOption" => utf8_encode($row["$tipoOption"]),
  );
}

//var_dump($set["idQ"]);
//var_dump($set["$option"]);
echo json_encode($set);
