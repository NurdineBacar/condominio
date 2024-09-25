<?php

include_once('../api/db.php');

$response = ['success' => false, 'message' => ''];

try {
    $data = json_decode(file_get_contents('php://input'), true);

    if (!$data) {
        throw new Exception('Dados inválidos ou ausentes.');
    }

    $nome_visita = $data['nome_visita'] ?? '';
    $data_visita = $data['data'] ?? '';
    $hora = $data['hora'] ?? '';
    $user_id = $data['user_id'] ?? '';

    // Prepara a consulta
    $query = $db->query("INSERT INTO visitas(nome_visita,data_visita,hora,user) 
                         VALUES ('{$nome_visita}','{$data_visita}','{$hora}',{$user_id})");
    
    // Executa a consulta
    if ($query) {
        $response['success'] = true;
        $response['message'] = 'Dados inseridos com sucesso.';
    } else {
        $response['message'] = 'Erro ao inserir dados.';
    }
} catch (PDOException $e) {
    $response['message'] = 'Erro ao inserir dados: ' . $e->getMessage();
} catch (Exception $e) {
    $response['message'] = $e->getMessage();
}

echo json_encode($response);

?>
