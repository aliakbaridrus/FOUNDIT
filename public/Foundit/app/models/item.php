<?php

require_once __DIR__ . '/../config/Database.php';

class Item
{
    private $conn;

    public function __construct()
    {
        $this->conn = Database::connect();
    }

    public function getByUser($user_id)
    {
        $sql = "SELECT * FROM items 
                WHERE user_id = '$user_id'
                ORDER BY created_at DESC";

        $result = mysqli_query($this->conn, $sql);

        $items = [];

        while ($row = mysqli_fetch_assoc($result)) {
            $items[] = $row;
        }

        return $items;
    }

    public function getStats($items)
    {
        $total = 0;
        $lost = 0;
        $found = 0;

        foreach ($items as $item) {
            $total++;

            if ($item['status'] == 'Lost') {
                $lost++;
            }

            if ($item['status'] == 'Found' || $item['status'] == 'Returned') {
                $found++;
            }
        }

        return [
            'total' => $total,
            'lost' => $lost,
            'found' => $found
        ];
    }

    public function getByIdAndUser($id, $user_id)
    {
        $sql = "SELECT * FROM items
                WHERE id = '$id'
                AND user_id = '$user_id'";

        $result = mysqli_query($this->conn, $sql);

        return mysqli_fetch_assoc($result);
    }

    public function deleteByIdAndUser($id, $user_id)
    {
        $sql = "DELETE FROM items
                WHERE id = '$id'
                AND user_id = '$user_id'";

        return mysqli_query($this->conn, $sql);
    }
}