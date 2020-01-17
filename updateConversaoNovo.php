<?php
include_once "configBD.php";

$arr = $_POST["arr"];

//preenche array com os dados
foreach ($arr as $ar) {
  $id         = $ar["id"];
  $tipoOption = $ar["tipoOption"];

  //criando a query de consulta ? tabela criada
  $query = "SELECT idQ, $tipoOption FROM banco_quest_questoes WHERE idQ=$id"; // Quest?es
  $sql = mysqli_query($cx, $query) or die(mysqli_error($cx)); //caso haja um erro na consulta

  //pecorrendo os registros da consulta.
  while($row = mysqli_fetch_assoc($sql)){
    $set[] = array(
      "idQ" => $row["idQ"],
      "tipoOption" => $tipoOption,
      "option" => utf8_encode($row["$tipoOption"]),
      "convert" => base64_encode(utf8_encode($row["$tipoOption"])),
    );
  }
}

foreach ($set as $s) {
  $query = "UPDATE banco_quest_questoes SET ".$s['tipoOption']."='".$s['convert']."' WHERE idQ = ".$s['idQ']."";//criando a query de atualiza??o para QUEST?ES
  $sql = mysqli_query($cx, $query) or die(mysqli_error($cx)); //caso haja um erro na consulta
}
