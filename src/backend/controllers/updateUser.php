<?php
// Conexão ao banco de dados
include_once '../api/db.php';

$response = array('success' => false, 'message' => '');

try {
    // Recebe os dados da requisição JSON
    $data = json_decode(file_get_contents('php://input'), true);

    // Verifica se os dados foram recebidos corretamente
    if (!$data) {
        throw new Exception('Dados inválidos ou ausentes.');
    }

    // Verifica se os campos obrigatórios estão presentes
    if (
        isset($data['id']) && !empty($data['id']) &&
        isset($data['name_user']) && !empty($data['name_user']) &&
        isset($data['telephone']) && !empty($data['telephone']) &&
        isset($data['email']) && !empty($data['email']) &&
        isset($data['typeUser']) && !empty($data['typeUser'])
    ) {
        // Recebe os dados do JSON
        $id = $data['id'];
        $name_user = $data['name_user'];
        $telephone = $data['telephone'];
        $email = $data['email'];
        $typeUser = $data['typeUser'];
        $nhouse = isset($data['nhouse']) ? $data['nhouse'] : null;

        // Prepara a consulta SQL para atualizar o usuário
        $query = "UPDATE users SET name_user = ?, telephone = ?, email = ?, typeUser = ?";
        if ($typeUser === 'morador') {
            $query .= ", nhouse = ? WHERE id = ?";
        } else {
            $query .= ", nhouse = NULL WHERE id = ?";
        }

        // Prepara a declaração SQL
        if ($stmt = $db->prepare($query)) {
            // Faz o bind dos parâmetros
            if ($typeUser === 'morador') {
                $stmt->bind_param('ssssii', $name_user, $telephone, $email, $typeUser, $nhouse, $id);
            } else {
                $stmt->bind_param('ssssi', $name_user, $telephone, $email, $typeUser, $id);
            }

            // Executa a consulta
            if ($stmt->execute()) {
                $response['success'] = true;
                $response['message'] = 'Usuário atualizado com sucesso!';
            } else {
                throw new Exception('Erro ao atualizar usuário: ' . $stmt->error);
            }

            // Fecha a declaração
            $stmt->close();
        } else {
            throw new Exception('Erro ao preparar a consulta SQL.');
        }
    } else {
        throw new Exception('Preencha todos os campos obrigatórios.');
    }
} catch (PDOException $e) {
    $response['message'] = 'Erro ao atualizar usuário: ' . $e->getMessage();
} catch (Exception $e) {
    $response['message'] = $e->getMessage();
}

// Retorna a resposta como JSON
echo json_encode($response);

?>
