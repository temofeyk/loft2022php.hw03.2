<?php


class Order
{
    private Db $db;
    private int $userId;
    public int $id;

    public function __construct(int $userId, array $data)
    {
        $this->db = Db::getInstance();
        $this->userId = $userId;
        $this->id = $this->addOrder($data);
    }
    private function addOrder(array $data): int
    {
        $query = "insert into orders(user_id, address, created_at) values(:user_id, :address, :created_at)";
        $res = $this->db->exec(
            $query,
            [
                ':user_id' => $this->userId,
                ':address' => $data['address'],
                ':created_at' => date('Y-m-d H:i:s')
            ]
        );
        if ($res) {
            // номер заказа
            $res = $this->db->lastInsertId();
            $this->incOrders();
        }
        return $res;
    }

    private function incOrders()
    {
        $query = "update users set orders_count = orders_count + 1 where id = $this->userId";
        $this->db->exec($query);
    }
}