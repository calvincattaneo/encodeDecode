<?php
include_once "configBD.php";
$draw = $_POST['draw'];
$row = $_POST['start'];
$start = $_POST['start'];
$rowperpage = $_POST['length']; // Rows display per page

$columnIndex = $_POST['order'][0]['column']; // Column index
$columnName = $_POST['columns'][$columnIndex]['data']; // Column name
$columnSortOrder = $_POST['order'][0]['dir']; // asc or desc
$searchValue = $_POST['search']['value']; // Search value

if($_POST["options"] == "texto") {
  $option = "texto";
} elseif($_POST["options"] == "prompt") {
  $option = "prompt";
} else {
  $option = "title";
}

## Total number of records without filtering
# $sel = mysqli_query($cx,"select count(*) as allcount from banco_quest_questoes WHERE $option != '' "); // Questoes
$sel = mysqli_query($cx,"select count(*) as allcount from correcoes_questoes_itens WHERE $option != '' "); // Itens
$records = mysqli_fetch_assoc($sel);
$totalRecords = $records['allcount'];

## Total number of records filtering
# $sel = mysqli_query($cx,"select count(*) as allcount from banco_quest_questoes_itens WHERE 1 $searchQuery AND $option != '' "); // Questoes
$sel = mysqli_query($cx,"select count(*) as allcount from correcoes_questoes_itens WHERE 1 $searchQuery AND $option != '' "); // Itens
$records = mysqli_fetch_assoc($sel);
$totalRecordwithFilter = $records['allcount'];


//criando a query de consulta � tabela criada
# $query = "SELECT idQ, $option FROM banco_quest_questoes WHERE $option != '' ORDER BY idQ LIMIT $row, $rowperpage"; // Questoes
$query = "SELECT idQ, idCorrecao, $option, posicao FROM correcoes_questoes_itens WHERE $option != '' ORDER BY idQ LIMIT $row, $rowperpage"; // Itens
//var_dump($query);
$sql = mysqli_query($cx,
  $query)
  or die(mysqli_error($cx) //caso haja um erro na consulta
);

//pecorrendo os registros da consulta.
$set = array();
while($row = mysqli_fetch_assoc($sql)){
  $set[] = array(
    "idQ" => $row["idQ"],
    "idCorrecao" =>$row["idCorrecao"], // para itens
    "$option" => htmlentities(utf8_encode($row["$option"])),
    "posicao" => $row["posicao"],
    "convertido" => utf8_encode($row["$option"]),
    "checkedId" => $row["idQ"],
    "btnId" => $row["idQ"],
  );
}
$data = array(
  'draw' => intval($draw),
  'iTotalRecords' => intval($totalRecords),
  'iTotalDisplayRecords' => intval($totalRecordwithFilter),
  'data' => $set
);
echo json_encode($data);
