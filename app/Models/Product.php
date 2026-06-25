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

    public function getProductsByFilter($filters = []) {
        $sql = "SELECT p.*, p.base_price as price, c.name as category, 
                (SELECT image_url FROM product_images pi WHERE pi.product_id = p.id AND pi.is_primary = 1 LIMIT 1) as image 
                FROM product p
                LEFT JOIN categories c ON p.category_id = c.id
                WHERE p.status = 1";
        $params = [];

        if (!empty($filters['gender']) && $filters['gender'] !== 'all') {
            $sql .= " AND p.gender = :gender";
            $params['gender'] = $filters['gender'];
        }

        if (!empty($filters['category']) && $filters['category'] !== 'all') {
            $sql .= " AND c.name = :category";
            $params['category'] = $filters['category'];
        }

        if (!empty($filters['price']) && $filters['price'] !== 'all') {
            if ($filters['price'] === 'lt3') {
                $sql .= " AND p.base_price < 3000000";
            } elseif ($filters['price'] === '3to5') {
                $sql .= " AND p.base_price >= 3000000 AND p.base_price <= 5000000";
            } elseif ($filters['price'] === 'gt5') {
                $sql .= " AND p.base_price > 5000000";
            }
        }

        if (!empty($filters['sort'])) {
            switch ($filters['sort']) {
                case 'price-asc':
                    $sql .= " ORDER BY p.base_price ASC";
                    break;
                case 'price-desc':
                    $sql .= " ORDER BY p.base_price DESC";
                    break;
                case 'name-asc':
                    $sql .= " ORDER BY p.name ASC";
                    break;
                default:
                    $sql .= " ORDER BY p.id DESC";
                    break;
            }
        } else {
            $sql .= " ORDER BY p.id DESC";
        }

        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getProductWithImages($id) {
        $sql = "SELECT p.*, p.base_price as price, c.name as category 
                FROM product p
                LEFT JOIN categories c ON p.category_id = c.id
                WHERE p.id = :id AND p.status = 1";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(['id' => $id]);
        $product = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($product) {
            $product['images'] = $this->getProductImages($id);
            // Default image property for frontend compatibility
            $product['image'] = !empty($product['images']) ? $product['images'][0]['image_url'] : '';
        }
        return $product;
    }

    public function getRelatedProducts($productId, $categoryId, $gender, $limit = 4) {
        // Find by same category, fallback to same gender
        $sql = "SELECT p.*, p.base_price as price, c.name as category, 
                (SELECT image_url FROM product_images pi WHERE pi.product_id = p.id AND pi.is_primary = 1 LIMIT 1) as image 
                FROM product p
                LEFT JOIN categories c ON p.category_id = c.id
                WHERE p.id != :id AND p.status = 1 
                AND (p.category_id = :category_id OR p.gender = :gender)
                ORDER BY (p.category_id = :category_id) DESC, p.id DESC
                LIMIT " . (int)$limit;
        
        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            'id' => $productId,
            'category_id' => $categoryId,
            'gender' => $gender
        ]);
        
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
        $stmt = $this->db->prepare("SELECT * FROM product_images WHERE product_id = :product_id ORDER BY is_primary DESC");
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
