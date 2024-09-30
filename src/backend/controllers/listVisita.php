<?php 

include_once('../api/db.php');

$response = ['success' => false, 'data' => [], 'message' => ''];

try{
    $query = "SELECT * FROM visitas where estado = 'pendente'"; 
    $stmt = $db->prepare($query);
    $stmt->execute();

    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
    if ($data) {
        $response['success'] = true;
        $response['data'] = $data;
    } else {
        $response['message'] = 'Nenhum dado encontrado.';
    }


} catch (PDOException $e) {
    $response['message'] = 'Erro ao recuperar dados: ' . $e->getMessage();
}

echo json_encode($response);

