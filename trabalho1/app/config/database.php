<?php
define('DB_HOST', 'localhost');
define('DB_NAME', 'eventos_db');
define('DB_USER', 'root'); // Usuário padrão do XAMPP, mude se necessário
define('DB_PASS', '');   // Senha padrão do XAMPP (geralmente vazia), mude se necessário
define('DB_CHARSET', 'utf8mb4');

class Database {
    private static $pdo = null;

    public static function conectar() {
        if (self::$pdo === null) {
            $dsn = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=" . DB_CHARSET;
            $options = [
                PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES   => false,
            ];
            try {
                self::$pdo = new PDO($dsn, DB_USER, DB_PASS, $options);
            } catch (\PDOException $e) {
                throw new \PDOException($e->getMessage(), (int)$e->getCode());
            }
        }
        return self::$pdo;
    }
}
?>