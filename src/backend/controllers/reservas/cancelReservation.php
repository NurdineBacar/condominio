<?php

include_once('../../api/db.php');

$response = ['success' => false, 'message' => ''];

try {
    $data = json_decode(file_get_contents('php://input'), true);

    if (!$data) {
        throw new Exception('Dados inválidos ou ausentes.');
    }

    $reserv_id = $data['id'] ?? '';

    // Prepara a consulta
    $query = $db->prepare("UPDATE reservas SET estado = 'cancelado' WHERE id = ?");

    if ($query === false) {
        throw new Exception('Erro ao preparar a consulta: ' . $db->error);
    }

    // Associar o parâmetro ? à variável $user_id
    $query->bind_param('i', $reserv_id);

    // Executar a consulta
    if ($query->execute()) {
        $response['success'] = true;
        $response['message'] = 'Reserva deletada com sucesso.';
    } else {
        $response['message'] = 'Erro ao deletar reserva: ' . $query->error;
    }

    // Fechar a consulta
    $query->close();
} catch (mysqli_sql_exception $e) {
    $response['message'] = 'Erro ao executar a consulta: ' . $e->getMessage();
} catch (Exception $e) {
    $response['message'] = $e->getMessage();
}

echo json_encode($response);
