<?php
// addDocument.php

// Ativar relatório de erros para depuração (remover em produção)
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Definir os cabeçalhos CORS
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: http://localhost:5173'); 
header('Access-Control-Allow-Methods: GET, POST, OPTIONS'); 
header('Access-Control-Allow-Headers: Content-Type, Authorization'); 
header('Access-Control-Allow-Credentials: true');

// Tratar requisições OPTIONS (pré-verificação CORS)
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit();
}

// Incluir a conexão com o banco de dados
include_once('../api/db.php'); // Certifique-se de que este caminho está correto

$response = ['success' => false, 'message' => ''];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_FILES['file']) && $_FILES['file']['error'] === 0) {
        $file = $_FILES['file'];
        $allowedTypes = [
            'application/pdf', 
            'application/vnd.openxmlformats-officedocument.wordprocessingml.document'
        ]; // Tipos permitidos (.pdf e .docx)
        $uploadDir = '../uploads/';  // Diretório de upload (certifique-se de que exista ou será criado)
        $filePath = $uploadDir . basename($file['name']);
        $fileType = mime_content_type($file['tmp_name']);
        
        // Verifica o tipo do arquivo
        if (!in_array($fileType, $allowedTypes)) {
            $response['message'] = 'Tipo de arquivo não permitido. Apenas .pdf e .docx são aceitos.';
            http_response_code(400);
            echo json_encode($response);
            exit();
        }

        // Verifica o tamanho do arquivo (máximo de 5MB)
        if ($file['size'] > 5 * 1024 * 1024) {
            $response['message'] = 'O arquivo excede o tamanho máximo permitido de 5MB.';
            http_response_code(400);
            echo json_encode($response);
            exit();
        }

        $sql = "INSERT INTO documentos VALUES (null,'$fileName', '$filePathDb',null,null)";
        if ($db->query($sql) === true) {
            $response['success'] = true;
            $response['message'] = 'Upload concluído e salvo no banco de dados.';
        } else {
            $response['message'] = 'Erro ao salvar no banco de dados: ' . $db->error;
            http_response_code(500);
        }

        // Verifica se o diretório de upload existe, se não, cria
        if (!is_dir($uploadDir)) {
            if (!mkdir($uploadDir, 0755, true)) {
                $response['message'] = 'Erro ao criar o diretório de upload.';
                http_response_code(500);
                echo json_encode($response);
                exit();
            }
        }

        // Move o arquivo para o diretório de upload
        if (move_uploaded_file($file['tmp_name'], $filePath)) {
            // Prepara a consulta para evitar SQL injection
            $fileName = $db->real_escape_string($file['name']);
            $filePathDb = $db->real_escape_string($filePath); // Escapar o caminho para segurança

            // // Verifique se a coluna correta é 'path' ou 'dpath' na tabela 'documentos'
            // $sql = "INSERT INTO documentos VALUES (null,'$fileName', '$filePathDb',null,null)"; // Altere 'path' para 'dpath' se necessário

            // if ($db->query($sql) === TRUE) {
            //     $response['success'] = true;
            //     $response['message'] = 'Upload concluído e salvo no banco de dados.';
            // } else {
            //     $response['message'] = 'Erro ao salvar no banco de dados: ' . $db->error;
            //     http_response_code(500);
            // }

            echo json_encode($response);
        } else {
            $response['message'] = 'Erro ao mover o arquivo.';
            http_response_code(500);
            echo json_encode($response);
        }
    } else {
        $response['message'] = 'Nenhum arquivo enviado ou houve um erro no envio.';
        http_response_code(400);
        echo json_encode($response);
    }
} else {
    $response['message'] = 'Método não permitido.';
    http_response_code(405);
    echo json_encode($response);
}

$db->close(); // Use $conn, não $db
?>
