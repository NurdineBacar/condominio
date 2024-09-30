<?php

include_once('../api/db.php');

$response = ['success' => false, 'message' => ''];

try {
    $data = json_decode(file_get_contents('php://input'), true);

    if (!$data) {
        throw new Exception('Dados inválidos ou ausentes.');
    }

    $fileName = $data['fileName'] ?? '';
    $dpath = '../controllers/uploads/'.$data['fileName'] ?? '';
    // Prepara a consulta
    $query = $db->query("INSERT INTO documentos(doc_name,dpath) 
                         VALUES ('{$fileName}','{$dpath}')");
    
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
