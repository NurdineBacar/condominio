<?php 

include_once('../api/db.php');

$response = ['success' => false, 'data' => [], 'message' => ''];

try {
    // Prepara a consulta SQL
    $query = "SELECT
        v.id AS visita_id,
        v.nome_visita,
        v.data_visita,
        v.hora,
        v.hora_entrada,
        v.hora_saida,
        u.name_user,
        u.nhouse,
        u.id
      FROM
        visitas v
      INNER JOIN
        users u
      ON
        v.user = u.id";
    
    // Prepara a consulta usando prepared statements
    $stmt = $db->prepare($query);
    $stmt->execute();
    $result = $stmt->get_result();

    // Verifica se há resultados
    if ($result->num_rows > 0) {
        // Busca todos os resultados
        while ($row = $result->fetch_assoc()) {
            $response['data'][] = $row;
        }
        $response['success'] = true;
    } else {
        $response['message'] = 'Nenhum dado encontrado.';
    }

} catch (mysqli_sql_exception $e) {
    // Registro de erro (no log, por exemplo)
    error_log('Erro ao recuperar dados: ' . $e->getMessage());
    $response['message'] = 'Erro ao recuperar dados. Por favor, tente novamente mais tarde.';
}

// Define o tipo de conteúdo como JSON
header('Content-Type: application/json');

// Retorna a resposta em formato JSON
echo json_encode($response);

?>
