<?php
header('Content-Type: application/json');
include_once('../api/db.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Lê o corpo da requisição
    $data = json_decode(file_get_contents("php://input"), true);

    if (isset($data['id'])) {
        $id = intval($data['id']);

        // Obtenha o caminho do arquivo
        $query = "SELECT dpath FROM documentos WHERE id = ?";
        $stmt = $db->prepare($query);
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $document = $result->fetch_assoc();

        if ($document) {
            $filePath = $document['dpath'];

            // Exclua o arquivo do servidor
            if (file_exists($filePath)) {
                unlink($filePath);
            }

            // Exclua o registro do banco de dados
            $deleteQuery = "DELETE FROM documentos WHERE id = ?";
            $deleteStmt = $db->prepare($deleteQuery);
            $deleteStmt->bind_param('i', $id);
            $deleteStmt->execute();

            echo json_encode(['success' => true, 'message' => 'Arquivo excluído com sucesso.']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Documento não encontrado.']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'ID não fornecido.']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Método não permitido.']);
}
?>
