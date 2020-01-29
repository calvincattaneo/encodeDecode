<?php
include_once "configBD.php";

$arr = $_POST["arr"];

//preenche array com os dados
foreach ($arr as $ar) {
  $id         = $ar["id"];
  $idCorrecao    = $ar["idCorrecao"];
  $tipoOption = $ar["tipoOption"];

  //criando a query de consulta ? tabela criada
  # $query = "SELECT idQ, $tipoOption FROM banco_quest_questoes WHERE idQ=$id"; // Questoes
  $query = "SELECT idQ, idCorrecao, $tipoOption FROM correcoes_questoes WHERE idQ=$id AND idCorrecao=$idCorrecao"; // Itens
  $sql = mysqli_query($cx, $query) or die(mysqli_error($cx)); //caso haja um erro na consulta

  //pecorrendo os registros da consulta.
  while($row = mysqli_fetch_assoc($sql)){
    $set[] = array(
      "idQ" => $row["idQ"],
      "idCorrecao" =>$row["idCorrecao"], // para idCorrecao
      "tipoOption" => $tipoOption,
      "option" => utf8_encode($row["$tipoOption"]),
      "convert" => base64_encode(utf8_encode($row["$tipoOption"])),
    );
  }
}

foreach ($set as $s) {
  $query = "UPDATE correcoes_questoes SET ".$s['tipoOption']."='".$s['convert']."' WHERE idQ = ".$s['idQ']." AND idCorrecao = ".$s['idCorrecao']."";//criando a query de atualizar idCorrecao
  $sql = mysqli_query($cx, $query) or die(mysqli_error($cx)); //caso haja um erro na consulta
}
