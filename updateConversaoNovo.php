<?php
include_once "configBD.php";

$arr = $_POST["arr"];

//preenche array com os dados
foreach ($arr as $ar) {
  $id         = $ar["id"];
  $posicao    = $ar["posicao"];
  $tipoOption = $ar["tipoOption"];

  //criando a query de consulta ? tabela criada
  # $query = "SELECT idQ, $tipoOption FROM banco_quest_questoes WHERE idQ=$id"; // Questoes
  $query = "SELECT idQ, posicao, $tipoOption FROM banco_quest_questoes_itens WHERE idQ=$id AND posicao=$posicao"; // Itens
  $sql = mysqli_query($cx, $query) or die(mysqli_error($cx)); //caso haja um erro na consulta

  //pecorrendo os registros da consulta.
  while($row = mysqli_fetch_assoc($sql)){
    $set[] = array(
      "idQ" => $row["idQ"],
      "posicao" =>$row["posicao"], // para itens
      "tipoOption" => $tipoOption,
      "option" => utf8_encode($row["$tipoOption"]),
      "convert" => base64_encode(utf8_encode($row["$tipoOption"])),
    );
  }
}

foreach ($set as $s) {
  $query = "UPDATE banco_quest_questoes_itens SET ".$s['tipoOption']."='".$s['convert']."' WHERE idQ = ".$s['idQ']." AND posicao = ".$s['posicao']."";//criando a query de atualizar Itens
  $sql = mysqli_query($cx, $query) or die(mysqli_error($cx)); //caso haja um erro na consulta
}
