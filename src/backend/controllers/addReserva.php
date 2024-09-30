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
    $area = $data['area'] ?? '';
    $reason = $data['reason'] ?? '';
    $dateTime = $data['dateTime'] ?? '';
    $initTime = $data['initTime'] ?? '';
    $endTime = $data['endTime'] ?? '';
    $details = $data['details'] ?? '';
    $dataAtual = date('Y-m-d');  // Data atual no formato YYYY-MM-DD

    // Prepara a consulta SQL para inserir a reserva
    $query = "INSERT INTO reservas(area, proposito, data_reserva, hora_inicio, hora_fim, detalhes, data_registo) 
              VALUES (?, ?, ?, ?, ?, ?, ?)";

    // Prepara a declaração
    $stmt = $db->prepare($query);
    if (!$stmt) {
        throw new Exception('Erro na preparação da consulta de reserva: ' . $db->error);
    }

    // Bind dos parâmetros
    $stmt->bind_param('sssssss', $area, $reason, $dateTime, $initTime, $endTime, $details, $dataAtual);

    // Executa a consulta
    if ($stmt->execute()) {
        $reserva_id = $db->insert_id; // Obtém o ID da reserva inserida

        // Criar notificação
        // $mensagem_notificacao = "Nova Reserva criada: " . $reason; // Mensagem personalizada
        $lida = 0; // 0 se a notificação não foi lida
        $visualizacao_individual = 1; // Dependendo de como você quer tratar isso
        $id_user = $data['id_user'];
        $type_not = $data['type_not'];
        $tipo = 'reserva'; // Defina o tipo de notificação

        // Prepara a consulta para inserir a notificação
        $query_notificacao = "INSERT INTO notificacoes (id_user, tipo, mensagem, lida, data_criacao, visualizacao_individual) 
                              VALUES (?, ?, ?, ?, NOW(), ?)";

        // Prepara a declaração
        $stmt_notificacao = $db->prepare($query_notificacao);
        if (!$stmt_notificacao) {
            throw new Exception('Erro na preparação da consulta de notificação: ' . $db->error);
        }

        // Bind dos parâmetros da notificação
        $stmt_notificacao->bind_param('ssisi', $id_user, $tipo, $type_not, $lida, $visualizacao_individual);

        // Executa a consulta para inserir a notificação
        if ($stmt_notificacao->execute()) {
            $response['success'] = true;
            $response['message'] = 'Reserva e notificação criados com sucesso.';
        } else {
            throw new Exception('Erro ao criar notificação: ' . $stmt_notificacao->error);
        }
    } else {
        throw new Exception('Erro ao inserir a reserva: ' . $stmt->error);
    }

} catch (mysqli_sql_exception $e) {
    $response['message'] = 'Erro ao executar a consulta: ' . $e->getMessage();
} catch (Exception $e) {
    $response['message'] = $e->getMessage();
}

// Retorna a resposta em formato JSON
echo json_encode($response);
?>
