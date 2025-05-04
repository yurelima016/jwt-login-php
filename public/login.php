<?php
    require '.././src/config/database.php';

    if($_SERVER['REQUEST_METHOD'] === 'POST') {
        $username = $_POST['user'] ?? '';
        $password = $_POST['password'] ?? '';
    
        $stmt = $pdo -> prepare("SELECT * FROM users WHERE username = ?;");
        $stmt -> execute([$username]);
        $user = $stmt -> fetch();
    
        if ($user && hash('sha256', $password) === $user['password']) {
            session_regenerate_id(true);
            // JWT HEADER
            $header = [
                'alg' => 'HS256',
                'typ' => 'JWT'
            ];
            $header = json_encode($header);
            $header = rtrim(strtr(base64_encode($header), '+/', '-_'), '=');

            // JWT PAYLOAD
            $payload = [
                'username' => $user['username'],
                'iat' => time(),
                'exp' => time() + 3600
            ];
            $payload = json_encode($payload);
            $payload = rtrim(strtr(base64_encode($payload), '+/', '-_'), '=');

            // JWT SIGNATURE
            $key = "key-just-for-test";
            $signature = hash_hmac('sha256', "$header.$payload", $key, true);
            $signature = rtrim(strtr(base64_encode($signature), '+/', '-_'), '=');

            $jwt = "$header.$payload.$signature";
            session_start();
            $_SESSION['user'] = $user['username'];
            $_SESSION['jwt'] = $jwt;
            header('Location: ./protected/dashboard.php');
            exit;
        } else {
            header('Location: ../public/index.html?error=invalid');
            exit;
        }
    }
?>