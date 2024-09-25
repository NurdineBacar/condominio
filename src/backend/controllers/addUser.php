<?php

include_once('../api/db.php');

$response = ['success' => false, 'message' => ''];

try {
    $data = json_decode(file_get_contents('php://input'), true);

    if (!$data) {
        throw new Exception('Dados inválidos ou ausentes.');
    }

    $user_name = $data['user_name'] ?? '';
    $telephone = $data['telephone'] ?? '';
    $email = $data['email'] ?? '';
    $nhouse = $data['nhouse'] ?? '';
    $typeUser = $data['typeUser'] ?? '';
    $upassword = rand(100000, 999999); // Gera uma senha de 6 dígitos

    // Prepara a consulta
    $query = $db->query("INSERT INTO users(name_user, telephone, email, nhouse, upassword,typeUser) 
                         VALUES ('$user_name','$telephone','$email','$nhouse','$upassword','$typeUser')");
    
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
