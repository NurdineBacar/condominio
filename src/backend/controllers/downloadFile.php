<?php
include_once('../api/db.php');

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    
    // Obtenha os detalhes do documento
    $query = "SELECT dpath FROM documentos WHERE id = ?";
    $stmt = $db->prepare($query);
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $document = $result->fetch_assoc();

    if ($document) {
        $filePath = $document['dpath'];
        if (file_exists($filePath)) {
            // Forçar download do arquivo
            header('Content-Description: File Transfer');
            header('Content-Type: application/pdf'); // Altere conforme necessário
            header('Content-Disposition: attachment; filename="' . basename($filePath) . '"');
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Length: ' . filesize($filePath));
            ob_clean(); // Limpa o buffer de saída
            flush(); // Descarrega o buffer do sistema
            readfile($filePath);
            exit;
        } else {
            echo json_encode(['success' => false, 'message' => 'Arquivo não encontrado.']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Documento não encontrado.']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'ID não fornecido.']);
}
?>
