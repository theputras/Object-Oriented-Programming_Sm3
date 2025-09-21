<?php
class Product {
    private $conn;
    private $table_name = "products";

    public $id_product;
    public $nama_product;
    public $harga_product;
    public $gambar_product;
    public $keterangan_product;
    public $jumlah;
    public $id_outlet;
    public $quantity;

    public function __construct($db) {
        $this->conn = $db;
    }


    public function readProduct() {
        $query = "SELECT p.*, pq.quantity, pq.id_outlet, o.nama_outlet 
                  FROM " . $this->table_name . " p
                  LEFT JOIN products_quantity pq ON p.id_product = pq.id_product
                  LEFT JOIN outlets o ON pq.id_outlet = o.id_outlet
                  ORDER BY p.id_product ASC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function createProduct() {
        $query = "INSERT INTO " . $this->table_name . " 
                  SET nama_product=:nama_product, 
                      harga_product=:harga_product, 
                      gambar_product=:gambar_product, 
                      keterangan_product=:keterangan_product";
        $stmt = $this->conn->prepare($query);
    
        $this->nama_product = htmlspecialchars(strip_tags($this->nama_product ?? ''));
        $this->harga_product = htmlspecialchars(strip_tags($this->harga_product ?? ''));
        $this->gambar_product = htmlspecialchars(strip_tags($this->gambar_product ?? ''));
        $this->keterangan_product = htmlspecialchars(strip_tags($this->keterangan_product ?? ''));
    
        $stmt->bindParam(":nama_product", $this->nama_product);
        $stmt->bindParam(":harga_product", $this->harga_product);
        $stmt->bindParam(":gambar_product", $this->gambar_product);
        $stmt->bindParam(":keterangan_product", $this->keterangan_product);
    
        if ($stmt->execute()) {
            $this->id_product = $this->conn->lastInsertId();
            $query = "INSERT INTO products_quantity 
                      SET id_product=:id_product, 
                          id_outlet=:id_outlet, 
                          quantity=:quantity";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(":id_product", $this->id_product);
            $stmt->bindParam(":id_outlet", $this->id_outlet);
            $stmt->bindParam(":quantity", $this->quantity);
            return $stmt->execute();
        }
        return false;
    }

    public function updateProduct() {
        $query = "UPDATE " . $this->table_name . " SET nama_product = :nama_product, harga_product=:harga_product, gambar_product=:gambar_product, keterangan_product=:keterangan_product WHERE id_product = :id_product";
        $stmt = $this->conn->prepare($query);

        $this->nama_product = htmlspecialchars(strip_tags($this->nama_product));
        $this->harga_product = htmlspecialchars(strip_tags($this->harga_product));
        $this->gambar_product = htmlspecialchars(strip_tags($this->gambar_product));
        $this->keterangan_product = htmlspecialchars(strip_tags($this->keterangan_product));
        $this->id_product = htmlspecialchars(strip_tags($this->id_product));

        $stmt->bindParam(":nama_product", $this->nama_product);
        $stmt->bindParam(":harga_product", $this->harga_product);
        $stmt->bindParam(":gambar_product", $this->gambar_product);
        $stmt->bindParam(":keterangan_product", $this->keterangan_product);
        $stmt->bindParam(":id_product", $this->id_product);

        
    if($stmt->execute()) {
        // Check if the product exists in products_quantity
        $query = "SELECT COUNT(*) as count FROM products_quantity WHERE id_product = :id_product";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id_product", $this->id_product);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if($row['count'] > 0) {
            // Update existing record
            $query = "UPDATE products_quantity SET quantity=:quantity, id_outlet=:id_outlet WHERE id_product=:id_product";
        } else {
            // Insert new record
            $query = "INSERT INTO products_quantity (quantity, id_outlet, id_product) VALUES (:quantity, :id_outlet, :id_product)";
        }
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":quantity", $this->quantity);
        $stmt->bindParam(":id_product", $this->id_product);
        $stmt->bindParam(":id_outlet", $this->id_outlet);
        return $stmt->execute();
    }
    return false;
    }
    
    public function cetakStruk($id_struk) {
        $query = "SELECT td.id_struk, p.nama_product, td.jumlah, p.harga_product 
                  FROM transaction_details td
                  JOIN products p ON td.id_product = p.id_product
                  WHERE td.id_struk = :id_struk";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id_struk", $id_struk);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    
    public function getTransactionById($id_struk) {
        $query = "SELECT td.id_struk, p.nama_product, td.jumlah, p.harga_product 
                  FROM transaction_details td
                  JOIN products p ON td.id_product = p.id_product
                  WHERE td.id_struk = :id_struk";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id_struk", $id_struk);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public function getTransactions() {
        $query = "SELECT td.id_struk, p.nama_product, o.nama_outlet, td.jumlah 
                  FROM transaction_details td
                  JOIN products p ON td.id_product = p.id_product
                  JOIN outlets o ON td.id_outlet = o.id_outlet
                 ORDER BY p.id_product ASC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function deleteProduct($id_product) {
        // Hapus data terkait di tabel transaction_details
        $query = "DELETE FROM transaction_details WHERE id_product = :id_product";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id_product", $id_product);
        $stmt->execute();
    
        // Hapus data terkait di tabel products_inventory
        $query = "DELETE FROM products_inventory WHERE id_product = :id_product";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id_product", $id_product);
        $stmt->execute();
    
        // Hapus data terkait di tabel products_quantity
        $query = "DELETE FROM products_quantity WHERE id_product = :id_product";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id_product", $id_product);
        $stmt->execute();
    
        // Kemudian hapus data di tabel products
        $query = "DELETE FROM " . $this->table_name . " WHERE id_product = :id_product";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id_product", $id_product);
    
        return $stmt->execute();
    }
    
    
	public function cari() {
        $query = "SELECT p.*, pq.quantity, pq.id_outlet 
                  FROM " . $this->table_name . " p
                  LEFT JOIN products_quantity pq ON p.id_product = pq.id_product
                  WHERE p.id_product = :id_product";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id_product", $this->id_product);
        $stmt->execute();
        return $stmt;
    }
    
    
   public function cariProduct() {
    $query = "SELECT nama_product FROM " . $this->table_name . " WHERE id_product = :id_product";
    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(":id_product", $this->id_product);
    $stmt->execute();
    return $stmt;
}
  
public function processTransaction($idProduct, $idOutlet, $jumlah) {
    // Validate product and outlet existence
    if (!$this->checkOutletExists($idOutlet)) {
        return false;
    }

    $query = "INSERT INTO transaction_details (id_product, id_outlet, jumlah)
              VALUES (:id_product, :id_outlet, :jumlah)";
    $stmt = $this->conn->prepare($query);

    // Bind parameters
    $stmt->bindParam(":id_product", $idProduct, PDO::PARAM_INT);
    $stmt->bindParam(":id_outlet", $idOutlet, PDO::PARAM_INT);
    $stmt->bindParam(":jumlah", $jumlah, PDO::PARAM_INT);

    return $stmt->execute();
}

    
public function checkOutletExists($id_outlet) {
    $query = "SELECT COUNT(*) as count FROM outlets WHERE id_outlet = :id_outlet";
    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(":id_outlet", $id_outlet);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    return $row['count'] > 0;
}

public function formatNumber($number) {
    return number_format($number, 0, ',', '.');
}
}
?>