<?php

class LoginRequiredMiddleware extends BaseMiddleware {
    public function apply(BaseController $controller, array $context) {

        $sql = <<<EOL
SELECT * FROM users
EOL;

        $query = $controller->pdo->prepare($sql);
        $query->execute();

        $data = $query->fetch();

        $valid_user = $data['username'];
        $valid_password = $data['password'];
        
        $user = isset($_SERVER['PHP_AUTH_USER']) ?$_SERVER['PHP_AUTH_USER'] : '';
        $password = isset($_SERVER['PHP_AUTH_PW']) ?$_SERVER['PHP_AUTH_PW'] : '';
        
        if ($valid_user != $user || $valid_password !=$password) {
            header('WWW-Authenticate: Basic realm="Video Cards"');
            http_response_code(401);
            exit;
        }
    }
}
