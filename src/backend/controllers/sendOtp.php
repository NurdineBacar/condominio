<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// require 'vendor/autoload.php'; // Certifique-se de que o caminho está correto
require '../../../vendor/autoload.php';

header('Content-Type: application/json');

include_once('../api/db.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents("php://input"), true);
    $email = $data['email'] ?? '';

    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // Gerar um código OTP
        $otp = rand(100000, 999999);

        // Salvar o código OTP no banco de dados
        $stmt = $db->prepare("UPDATE users SET code_otp = ? WHERE email = ?");
        $stmt->bind_param('is', $otp, $email);
        $stmt->execute();

        // Configurar o PHPMailer
        $mail = new PHPMailer(true);
        try {
            // Configurações do servidor
            $mail->isSMTP();                                            // Enviar via SMTP
            $mail->Host       = 'smtp.gmail.com';                  // Defina o servidor SMTP
            $mail->SMTPAuth   = true;                                   // Habilitar autenticação SMTP
            $mail->Username   = 'gamebacar@gmail.com';              // Nome de usuário SMTP
            $mail->Password   = 'eobo yomp zmhi wzxc';                             // Senha SMTP
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Habilitar TLS encryption; use `PHPMailer::ENCRYPTION_SMTPS` se exigido pelo servidor
            $mail->Port       = 587;                                    // Porta TCP para conectar
        

            // Destinatários
            $mail->setFrom('gamebacar@gmail.com', 'Game bacar');
            $mail->addAddress($email);

            // Conteúdo do e-mail
            $mail->isHTML(true);
            $mail->Subject = 'Código de Verificação';
            $mail->Body    = "Seu código de verificação é: <strong>$otp</strong>";

            $mail->send();
            echo json_encode(['success' => true, 'message' => 'Código enviado com sucesso.']);
        } catch (Exception $e) {
            echo json_encode(['success' => false, 'message' => 'Erro ao enviar o e-mail: ' . $mail->ErrorInfo]);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Email inválido.']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Método não permitido.']);
}
?>
