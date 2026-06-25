<?php

namespace App\Models;

use PDO;

class Product extends BaseModel {
    public function __construct() {
        parent::__construct();
        // Xử lý logic cho các bảng: product, categories, product_variants, product_images, inventory_logs
    }

    // --- PRODUCT ---
    public function createProduct($data) { return $this->insert('product', $data); }
    public function getProduct($id) { return $this->getById('product', $id); }
    public function updateProduct($id, $data) { return $this->update('product', $id, $data); }
    public function deleteProduct($id) { return $this->softDelete('product', $id); }
    
    public function getActiveProducts() {
        $stmt = $this->db->prepare("SELECT * FROM product WHERE status = 1");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // --- CATEGORIES ---
    public function createCategory($data) { return $this->insert('categories', $data); }
    public function getCategory($id) { return $this->getById('categories', $id); }
    public function updateCategory($id, $data) { return $this->update('categories', $id, $data); }
    public function deleteCategory($id) { return $this->softDelete('categories', $id); }

    public function getActiveCategories() {
        $stmt = $this->db->prepare("SELECT * FROM categories WHERE status = 1");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // --- PRODUCT_VARIANTS ---
    public function createProductVariant($data) { return $this->insert('product_variants', $data); }
    public function getProductVariant($id) { return $this->getById('product_variants', $id); }
    public function updateProductVariant($id, $data) { return $this->update('product_variants', $id, $data); }
    public function deleteProductVariant($id) { return $this->softDelete('product_variants', $id); }

    public function getProductVariants($productId) {
        $stmt = $this->db->prepare("SELECT * FROM product_variants WHERE product_id = :product_id AND status = 1");
        $stmt->execute(['product_id' => $productId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // --- PRODUCT_IMAGES ---
    public function createProductImage($data) { return $this->insert('product_images', $data); }
    public function getProductImage($id) { return $this->getById('product_images', $id); }
    public function updateProductImage($id, $data) { return $this->update('product_images', $id, $data); }
    public function deleteProductImage($id) { return $this->softDelete('product_images', $id); }

    public function getProductImages($productId) {
        $stmt = $this->db->prepare("SELECT * FROM product_images WHERE product_id = :product_id AND status = 1 ORDER BY is_primary DESC");
        $stmt->execute(['product_id' => $productId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // --- INVENTORY_LOGS ---
    public function createInventoryLog($data) { return $this->insert('inventory_logs', $data); }
    public function getInventoryLog($id) { return $this->getById('inventory_logs', $id); }
    public function getInventoryLogsByVariant($variantId) {
        $stmt = $this->db->prepare("SELECT * FROM inventory_logs WHERE variant_id = :variant_id ORDER BY id DESC");
        $stmt->execute(['variant_id' => $variantId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
