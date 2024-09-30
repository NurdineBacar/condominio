<?php 

include_once('../../api/db.php');

$response = ['success' => false, 'data' => [], 'message' => ''];

try {

    // Prepara a consulta
    $stmt = $db->prepare("
SELECT 
    notificacoes.*, 
    users.id AS usuario_id, 
    users.name_user AS usuario_nome, 
    users.email AS usuario_email,
    users.typeUser
FROM notificacoes 
JOIN users ON notificacoes.id_user = users.id
");
    
    
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
