<?php
include_once('../api/db.php');

$response = ['success' => false, 'message' => ''];

try {
    // Capturar os dados enviados no corpo da requisição
    $data = json_decode(file_get_contents('php://input'), true);

    if (!$data) {
        throw new Exception('Dados inválidos ou ausentes.');
    }

    // Atribuir os dados recebidos às variáveis correspondentes
    $area = $data['area'] ?? '';
    $reason = $data['reason'] ?? '';
    $dateTime = $data['dateTime'] ?? '';
    $initTime = $data['initTime'] ?? '';
    $endTime = $data['endTime'] ?? '';
    $details = $data['details'] ?? '';
    $dataAtual = date('Y-m-d');  // Data atual no formato YYYY-MM-DD

    // Prepara a consulta SQL
    $query = "INSERT INTO reservas(area, proposito, data_reserva, hora_inicio, hora_fim, detalhes, data_registo) 
              VALUES ('$area', '$reason', '$dateTime', '$initTime', '$endTime', '$details', '$dataAtual')";

    // Executa a consulta
    if ($db->query($query) === true) {
        $response['success'] = true;
        $response['message'] = 'Reserva inserida com sucesso.';
    } else {
        throw new Exception('Erro ao inserir a reserva: ' . $db->error);
    }

} catch (mysqli_sql_exception $e) {
    $response['message'] = 'Erro ao executar a consulta: ' . $e->getMessage();
} catch (Exception $e) {
    $response['message'] = $e->getMessage();
}

// Retorna a resposta em formato JSON
echo json_encode($response);


?>