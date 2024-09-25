<?php

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: http://localhost:5173'); 
header('Access-Control-Allow-Methods: GET, POST, OPTIONS'); 
header('Access-Control-Allow-Headers: Content-Type, Authorization'); 
header('Access-Control-Allow-Credentials: true');

// Tratar requisições OPTIONS (pré-verificação CORS)
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit();
}

$db= new mysqli("localhost","root","","condominio");

if($db->connect_error)
    die("Erro aco conecatar a base de dados".$db->connect_error);

?>