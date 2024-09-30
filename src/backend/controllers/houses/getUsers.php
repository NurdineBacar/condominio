<?php 

include_once('../../api/db.php');

$response = ['success' => false, 'data' => [], 'message' => ''];

try {
    $nhouse = $_GET['nhouse']; // Obter o número da casa da requisição
    $query = $db->prepare("SELECT * FROM users WHERE nhouse = ?");
    $query->bind_param("s", $nhouse);
    $query->execute();
    $result = $query->get_result();

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $response['data'][] = $row;
        }
        $response['success'] = true;
    } else {
        $response['message'] = 'Nenhum morador encontrado.';
    }
} catch (Exception $e) {
    $response['message'] = 'Erro ao recuperar dados: ' . $e->getMessage();
}

echo json_encode($response);
?>
