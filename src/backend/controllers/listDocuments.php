<?php 

include_once('../api/db.php');

$response = ['success' => false, 'data' => [], 'message' => ''];

try {
    $query = $db->query("SELECT * FROM documentos");

    if ($query->num_rows > 0) {
        while($row = $query->fetch_assoc()) {
            $response['data'][] = $row;
        }
        $response['success'] = true;
    } else {
        $response['message'] = 'Nenhum dado encontrado.';
    }
} catch (PDOException $e) {
    $response['message'] = 'Erro ao recuperar dados: ' . $e->getMessage();
}

echo json_encode($response);

?>
