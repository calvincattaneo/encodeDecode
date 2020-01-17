<?php

//iniciando a conexão com o banco de dados
$cx = mysqli_connect("127.0.0.1", "root", "");
//$cx = mysqli_connect("desenv.senairs.org.br", "#senaidb", "s&na!Mysq1");

if (!$cx) {
    echo "Error: Unable to connect to MySQL." . PHP_EOL;
    echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
    echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
    exit;
}
/*echo "Success: A proper connection to MySQL was made! The my_db database is great." . PHP_EOL;
echo "Host information: " . mysqli_get_host_info($link) . PHP_EOL;*/

//var_dump($cx->get_charset());
//selecionando o banco de dados
$db = mysqli_select_db($cx, "webcursos1");
