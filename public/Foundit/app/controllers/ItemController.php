<?php

require_once __DIR__ . '/../models/Item.php';

class ItemController
{
    private $itemModel;

    public function __construct()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $this->itemModel = new Item();
    }

    public function dashboard()
    {
        if (!isset($_SESSION['user_id'])) {
            header("Location: login.php");
            exit();
        }

        if (isset($_SESSION['role']) && $_SESSION['role'] == 'admin') {
            header("Location: admin_dashboard.php");
            exit();
        }

        $user_id = $_SESSION['user_id'];

        $items = $this->itemModel->getByUser($user_id);
        $stats = $this->itemModel->getStats($items);

        $total = $stats['total'];
        $lost = $stats['lost'];
        $found = $stats['found'];

        require_once __DIR__ . '/../views/items/dashboard.php';
    }

    public function delete()
    {
        if (!isset($_SESSION['user_id'])) {
            header("Location: ../pages/login.php");
            exit();
        }

        if (!isset($_GET['id'])) {
            header("Location: ../pages/dashboard.php");
            exit();
        }

        $id = $_GET['id'];
        $user_id = $_SESSION['user_id'];

        $item = $this->itemModel->getByIdAndUser($id, $user_id);

        if (!$item) {
            die("Item tidak ditemukan");
        }

        $image_path = __DIR__ . "/../../uploads/" . $item['image'];

        if (file_exists($image_path)) {
            unlink($image_path);
        }

        $this->itemModel->deleteByIdAndUser($id, $user_id);

        header("Location: ../pages/dashboard.php");
        exit();
    }
}