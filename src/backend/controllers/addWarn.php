<?php
include_once('../api/db.php');

$response = ['success' => false, 'message' => ''];

try {
    // Capturar os dados enviados no corpo da requisição
    $data = json_decode(file_get_contents('php://input'), true);

    if (!$data) {
        throw new Exception('Dados inválidos ou ausentes.');
    }

    // Atribuir os dados recebidos às variáveis correspondentes
    $titulo = $data['titulo'] ?? '';
    $tipo = $data['tipo'] ?? '';
    $data_validade = $data['data_validade'] ?? '';
    $nivel_prioridade = $data['nivel_prioridade'] ?? '';
    $observacoes = $data['observacoes'] ?? '';
    $dataAtual = date('Y-m-d');  // Data atual no formato YYYY-MM-DD
    $id_user = $data['id_user'];

    // Prepara a consulta SQL para inserir o aviso
    $query = "INSERT INTO avisos (titulo, tipo, data_validade, nivel_prioridade, observacoes, data_registo) 
              VALUES (?, ?, ?, ?, ?, ?)";

    // Prepara a declaração
    $stmt = $db->prepare($query);
    $stmt->bind_param('ssssss', $titulo, $tipo, $data_validade, $nivel_prioridade, $observacoes, $dataAtual);

    // Executa a consulta para inserir o aviso
    if ($stmt->execute()) {
        // Obter o ID do aviso inserido
        $aviso_id = $stmt->insert_id;

        // Criar notificação
        $mensagem_notificacao = "Novo aviso criado: " . $titulo;
        // Substitua pelo ID real do usuário que deve receber a notificação
        $lida = 0; // 0 se a notificação não foi lida, 1 se foi lida
        $visualizacao_individual = 1; // Ou 0, dependendo de como você quer tratar isso
        $type_not = $data['type_not'];

        // Prepara a consulta para inserir a notificação
        $query_notificacao = "INSERT INTO notificacoes (id_user, tipo, mensagem, lida, data_criacao, visualizacao_individual) 
                              VALUES (?, ?, ?, ?, NOW(), ?)";

        // Prepara a declaração
        $stmt_notificacao = $db->prepare($query_notificacao);
        $stmt_notificacao->bind_param('ssisi', $id_user, $tipo, $type_not, $lida, $visualizacao_individual);

        // Executa a consulta para inserir a notificação
        if ($stmt_notificacao->execute()) {
            $response['success'] = true;
            $response['message'] = 'Aviso e notificação criados com sucesso.';
        } else {
            throw new Exception('Erro ao criar notificação: ' . $stmt_notificacao->error);
        }
    } else {
        throw new Exception('Erro ao inserir aviso: ' . $stmt->error);
    }

} catch (mysqli_sql_exception $e) {
    $response['message'] = 'Erro ao executar a consulta: ' . $e->getMessage();
} catch (Exception $e) {
    $response['message'] = $e->getMessage();
}

// Retorna a resposta em formato JSON
echo json_encode($response);
?>
