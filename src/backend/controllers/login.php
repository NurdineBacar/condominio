<?php
include_once('../api/db.php');

$response = ['success' => false, 'message' => '', 'data' => []];

try {
    // Capturar os dados enviados no corpo da requisição
    $data = json_decode(file_get_contents('php://input'), true);

    if (!$data) {
        throw new Exception('Dados inválidos ou ausentes.');
    }

    // Atribuir os dados recebidos às variáveis correspondentes
    $username = $data['username'] ?? '';
    $password = $data['password'] ?? '';

    // Validação básica
    if (empty($username) || empty($password)) {
        throw new Exception('Username ou password ausente.');
    }

    // Prepara a consulta SQL
    $query = "SELECT * FROM users WHERE email = ? AND upassword = ?";
    $stmt = $db->prepare($query);

    // Vincula os parâmetros para evitar SQL Injection
    $stmt->bind_param('ss', $username, $password);
    $stmt->execute();

    // Obtém o resultado da consulta
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        // Usuário encontrado, você pode extrair os dados, se necessário
        $userData = $result->fetch_assoc();
        $response['success'] = true;
        $response['message'] = 'Usuário autenticado com sucesso.';
        $response['data'] = $userData; // Retorna os dados do usuário, se necessário
    } else {
        throw new Exception('Credenciais inválidas.');
    }

    $stmt->close();

} catch (mysqli_sql_exception $e) {
    $response['message'] = 'Erro ao executar a consulta: ' . $e->getMessage();
} catch (Exception $e) {
    $response['message'] = $e->getMessage();
}

// Retorna a resposta em formato JSON
echo json_encode($response);
?>
