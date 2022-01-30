<?php


class User
{
    private Db $db;
    public int $id;
    public int $orders_count;

    public function __construct(string $email, string $name)
    {
        $this->db = Db::getInstance();
        if (!$this->checkUser($email)) {
            $this->id = $this->createUser($email, $name);
            $this->orders_count = 1;
        }
    }

    /**
     * @param string $email
     * @return bool
     */
    private function checkUser(string $email): bool
    {
        $query = "select id, orders_count from users where email = :email";
        $user = $this->db->fetchOne($query, [':email' => $email]);
        if ($user) {
            $this->id = $user['id'];
            $this->orders_count = $user['orders_count'];
            return true;
        }
        return false;
    }

    /**
     * @param string $email
     * @param string $name
     * @return string
     */
    private function createUser(string $email, string $name): string
    {
        $query = "insert into users(`email`, `name`) values (:email, :name)";
        $this->db->exec($query,
            [
                ':email' => $email,
                ':name' => $name
            ]
        );
        return $this->db->lastInsertId();
    }
}