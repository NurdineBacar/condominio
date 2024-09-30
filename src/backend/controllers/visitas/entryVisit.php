<?php

include_once('../../api/db.php');

$response = ['success' => false, 'message' => ''];

try {
    $data = json_decode(file_get_contents('php://input'), true);

    if (!$data) {
        throw new Exception('Dados inválidos ou ausentes.');
    }

    $visit_id = $data['id'] ?? '';

    // Prepara a consulta
    $query = $db->prepare("UPDATE visitas SET hora_entrada = NOW() WHERE id = ?");

    if ($query === false) {
        throw new Exception('Erro ao preparar a consulta: ' . $db->error);
    }

    // Associar o parâmetro ? à variável $visit_id
    $query->bind_param('i', $visit_id);

    // Executar a consulta
    if ($query->execute()) {
        $response['success'] = true;
        $response['message'] = 'Reserva aprovada e hora de entrada registrada com sucesso.';
    } else {
        $response['message'] = 'Erro ao aprovar a reserva: ' . $query->error;
    }

    // Fechar a consulta
    $query->close();
} catch (mysqli_sql_exception $e) {
    $response['message'] = 'Erro ao executar a consulta: ' . $e->getMessage();
} catch (Exception $e) {
    $response['message'] = $e->getMessage();
}

echo json_encode($response);
