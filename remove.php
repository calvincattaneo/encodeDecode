<?php 
include_once "configBD.php";

$id = $_POST['id'];

if($id > 0){
    // Deleta registro
    # $query = "DELETE FROM banco_quest_questoes WHERE idQ=".$id; banco_quest_questoes_itens
    $query = "DELETE FROM banco_quest_questoes_itens WHERE idQ=".$id; 
    mysqli_query($cx,$query) or die(mysqli_error($cx)); //caso haja um erro na consulta 
    echo 1;
    exit;
}

echo 0;
exit;

