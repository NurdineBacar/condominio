<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Carregar o autoload do Composer
// require 'vendor/autoload.php';
require '../../../vendor/autoload.php';

// Criar uma nova instância do PHPMailer
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

    // Recipiente
    $mail->setFrom('gamebacar@gmail.com', 'Game bacar');
    $mail->addAddress('nurdinebacar@gmail.com', 'Destinatário');     // Adicionar um destinatário

    // Conteúdo do e-mail
    $mail->isHTML(true);                                  // Definir o formato do e-mail para HTML
    $mail->Subject = 'Assunto do E-mail';
    $mail->Body    = 'Este é o corpo do e-mail em <b>HTML</b>';
    $mail->AltBody = 'Este é o corpo do e-mail em texto puro para clientes de e-mail que não suportam HTML';

    // Enviar o e-mail
    $mail->send();
    echo 'E-mail enviado com sucesso';
} catch (Exception $e) {
    echo "Erro ao enviar e-mail: {$mail->ErrorInfo}";
}

?>