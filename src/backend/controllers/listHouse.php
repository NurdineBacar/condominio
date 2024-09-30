<?php 

include_once('../api/db.php');

$response = ['success' => false, 'data' => [], 'message' => ''];

try {
    // Query para selecionar todas as casas e contar o número de usuários por casa
    $query = $db->query("
        SELECT h.id, h.nhouse, h.nome_casa, h.hstatus, COUNT(u.id) AS resident_count 
        FROM houses h 
        LEFT JOIN users u ON h.nhouse = u.nhouse 
        GROUP BY h.id
    ");

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
