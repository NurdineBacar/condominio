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
    $nhouse = $data['nhouse'] ?? '';
    $casa = $data['nome_casa'] ?? '';

    // Prepara a consulta SQL
    $query = "INSERT INTO houses(nhouse, nome_casa) 
              VALUES ('$nhouse', '$casa')";

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