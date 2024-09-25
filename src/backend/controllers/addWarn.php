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
    $titulo = $data['titulo'] ?? '';
    $tipo = $data['tipo'] ?? '';
    $data_validade = $data['data_validade'] ?? '';
    $nivel_prioridade = $data['nivel_prioridade'] ?? '';
    $observacoes = $data['observacoes'] ?? '';
    $dataAtual = date('Y-m-d');  // Data atual no formato YYYY-MM-DD

    // Prepara a consulta SQL
    $query = "INSERT INTO avisos(titulo, tipo, data_validade, nivel_prioridade, observacoes, data_registo) 
              VALUES ('$titulo', '$tipo', '$data_validade', '$nivel_prioridade', '$observacoes', '$dataAtual')";

    // Executa a consulta
    if ($db->query($query) === true) {
        $response['success'] = true;
        $response['message'] = 'Aviso inserido com sucesso.';
    } else {
        throw new Exception('Erro ao inserir aviso: ' . $db->error);
    }

} catch (mysqli_sql_exception $e) {
    $response['message'] = 'Erro ao executar a consulta: ' . $e->getMessage();
} catch (Exception $e) {
    $response['message'] = $e->getMessage();
}

// Retorna a resposta em formato JSON
echo json_encode($response);


?>