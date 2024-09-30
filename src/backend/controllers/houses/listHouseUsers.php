<?php 

include_once('../../api/db.php');

$response = ['success' => false, 'data' => [], 'message' => ''];

try {
    $nhouse = $_GET['nhouse'] ?? 0;

    // Prepara a consulta
    $stmt = $db->prepare("SELECT * FROM users WHERE nhouse = ?");
    
    // Bind do parâmetro
    $stmt->bind_param('i', $nhouse);
    
    // Executa a consulta
    $stmt->execute();
    
    // Obtém os resultados
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $response['data'][] = $row; // Adiciona cada usuário ao array de dados
        }
        $response['success'] = true; // Define sucesso
    } else {
        $response['message'] = 'Nenhum dado encontrado.'; // Mensagem se não houver dados
    }
} catch (mysqli_sql_exception $e) {
    $response['message'] = 'Erro ao recuperar dados: ' . $e->getMessage(); // Mensagem de erro
}

echo json_encode($response); // Retorna o resultado em formato JSON

?>
