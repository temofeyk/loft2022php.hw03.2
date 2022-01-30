<?php

class Db
{
    /** @var PDO|null */

    private ?PDO $pdo = null;
    private static ?Db $instance = null;

    private function __construct()
    {
    }

    private function __clone()
    {
    }

    public static function getInstance(): self
    {
        if (self::$instance == null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    private function getConnection(): PDO
    {
        $host = DB_HOST;
        $dbName = DB_NAME;
        $dbUser = DB_USER;
        $dbPassword = DB_PASSWORD;

        if ($this->pdo == null) {
            $this->pdo = new PDO("mysql:host=$host;dbname=$dbName", $dbUser, $dbPassword);
        }
        return $this->pdo;
    }

    public function fetchOne(string $query, array $params = [])
    {
        $prepared = $this->getConnection()->prepare($query);

        $ret = $prepared->execute($params);
        if (!$ret) {
            $errorInfo = $prepared->errorInfo();
            trigger_error("$errorInfo[0]#$errorInfo[1]: " . "$errorInfo[2]");
            return [];
        }

        $data = $prepared->fetchAll(PDO::FETCH_ASSOC);
        if (!$data) {
            return false;
        }
        return reset($data);
    }

    public function exec(string $query, array $params = []): int
    {
        $pdo = $this->getConnection();
        $prepared = $pdo->prepare($query);

        $ret = $prepared->execute($params);
        if (!$ret) {
            $errorInfo = $prepared->errorInfo();
            trigger_error("$errorInfo[0]#$errorInfo[1]: " . "$errorInfo[2]");
            return -1;
        }
        return $prepared->rowCount();
    }

    public function lastInsertId(): string//возвращает id последней вставленной записи
    {
        return $this->getConnection()->lastInsertId();
    }
}