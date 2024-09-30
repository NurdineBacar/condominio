<?php

// Incluir o autoload do Composer para carregar o PHPMailer
// require_once __DIR__ . '/vendor/autoload.php';
require_once '../../../vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

include_once('../api/db.php');

$response = ['success' => false, 'message' => ''];

try {
    $data = json_decode(file_get_contents('php://input'), true);

    if (!$data) {
        throw new Exception('Dados inválidos ou ausentes.');
    }

    // Captura dos dados enviados
    $user_name = $data['user_name'] ?? '';
    $telephone = $data['telephone'] ?? '';
    $email = $data['email'] ?? '';
    $nhouse = $data['nhouse'] ?? '';
    $typeUser = $data['typeUser'] ?? '';
    $upassword = rand(100000, 999999); // Gera uma senha de 6 dígitos

    // Prepara a consulta SQL
    $query = $db->query("INSERT INTO users (name_user, telephone, email, nhouse, upassword, typeUser) 
                         VALUES ('$user_name','$telephone','$email','$nhouse','$upassword','$typeUser')");

    // Executa a consulta e verifica o resultado
    if ($query) {
        // Se a inserção for bem-sucedida, enviar e-mail com a senha
        $mail = new PHPMailer(true);
        try {
            // Configurações do servidor de e-mail
            $mail->isSMTP();                                            // Enviar via SMTP
            $mail->Host       = 'smtp.gmail.com';                  // Defina o servidor SMTP
            $mail->SMTPAuth   = true;                                   // Habilitar autenticação SMTP
            $mail->Username   = 'gamebacar@gmail.com';              // Nome de usuário SMTP
            $mail->Password   = 'eobo yomp zmhi wzxc';                             // Senha SMTP
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Habilitar TLS encryption; use `PHPMailer::ENCRYPTION_SMTPS` se exigido pelo servidor
            $mail->Port       = 587;    

            // Remetente e destinatário
            $mail->setFrom('gamebacar@gmail.com', 'Game bacar');
            $mail->addAddress($email, $user_name); // Envia o e-mail para o endereço do usuário

            // Conteúdo do e-mail
            $mail->Subject = 'Sua nova conta no sistema do condomínio vila Olimpica';
            $mail->Body = "Olá $user_name,\n\nSua conta foi criada com sucesso.\nSua senha temporária é: $upassword\n\nPor favor, altere sua senha após o primeiro login.";

            // Envia o e-mail
            $mail->send();
            $response['success'] = true;
            $response['message'] = 'Usuário adicionado com sucesso e e-mail enviado com a nova senha.';
        } catch (Exception $e) {
            // Erro ao enviar e-mail
            $response['message'] = "Usuário adicionado, mas não foi possível enviar o e-mail: {$mail->ErrorInfo}";
        }
    } else {
        // Erro na inserção dos dados
        $response['message'] = 'Erro ao inserir dados.';
    }
} catch (PDOException $e) {
    $response['message'] = 'Erro ao inserir dados: ' . $e->getMessage();
} catch (Exception $e) {
    $response['message'] = $e->getMessage();
}

// Retorna a resposta em formato JSON
echo json_encode($response);

?>
