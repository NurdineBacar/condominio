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

    // Prepara a consulta SQL para buscar o usuário pelo email
    $query = "SELECT * FROM users WHERE email = ?";
    $stmt = $db->prepare($query);
    
    // Vincula os parâmetros para evitar SQL Injection
    $stmt->bind_param('s', $username);
    $stmt->execute();

    // Obtém o resultado da consulta
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        // Usuário encontrado
        $userData = $result->fetch_assoc();
        $storedPassword = $userData['upassword']; // Obtém a senha armazenada no banco de dados

        // Verifica se a senha armazenada é hasheada ou não
        if (password_verify($password, $storedPassword)) {
            // Senha correta (hasheada)
            $response['success'] = true;
            $response['message'] = 'Usuário autenticado com sucesso (senha hasheada).';
            $response['data'] = $userData;
        } elseif ($password === $storedPassword) {
            // Senha correta (texto plano)
            $response['success'] = true;
            $response['message'] = 'Usuário autenticado com sucesso (senha em texto plano).';
            $response['data'] = $userData;
        } else {
            // Senha incorreta
            throw new Exception('Credenciais inválidas.');
        }
    } else {
        // Usuário não encontrado
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
