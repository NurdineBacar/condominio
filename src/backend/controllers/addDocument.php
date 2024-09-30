<?php
// Define o diretório de upload
$uploadDir = 'uploads/';
include_once('../api/db.php');

// Verifica se o diretório de upload existe, caso contrário, cria
if (!is_dir($uploadDir)) {
    mkdir($uploadDir, 0755, true);
}

$response = ['success' => false, 'message' => ''];

if (isset($_FILES['file']) && isset($_POST['fileName'])) {
    $file = $_FILES['file'];
    $fileName = $_POST['fileName']; // Captura o nome do arquivo enviado

    // Gera o caminho completo para o arquivo
    $filePath = $uploadDir . basename($fileName);

    // Move o arquivo para a pasta de uploads
    if (move_uploaded_file($file['tmp_name'], $filePath)) {
        $response['success'] = true;
        $response['message'] = 'Upload bem-sucedido! Arquivo salvo em: ' . $filePath;
    } else {
        $response['message'] = 'Erro ao mover o arquivo.';
    }
} else {
    $response['message'] = 'Nenhum arquivo ou nome enviado.';
}

// Retorna a resposta em formato JSON
header('Content-Type: application/json');
echo json_encode($response);
?>
