<?php
header('Content-Type: application/json');

include_once('../api/db.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents("php://input"), true);
    $otp = $data['otp'] ?? '';
    $newPassword = $data['newPassword'] ?? '';

    // Verifique se o OTP e a nova senha foram fornecidos
    if (!empty($otp) && !empty($newPassword)) {
        // Verifique se o OTP existe no banco de dados
        $stmt = $db->prepare("SELECT id FROM users WHERE code_otp = ?");
        $stmt->bind_param('s', $otp);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            // Atualize a senha do usuário
            $userId = $result->fetch_assoc()['id'];
            $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

            $updateStmt = $db->prepare("UPDATE users SET upassword = ?, code_otp = NULL WHERE id = ?");
            $updateStmt->bind_param('si', $hashedPassword, $userId);
            $updateStmt->execute();

            echo json_encode(['success' => true, 'message' => 'Senha redefinida com sucesso.']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Código OTP inválido.']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Por favor, preencha todos os campos.']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Método não permitido.']);
}
?>
