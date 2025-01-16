<?php
class Product {
    private $conn;
    private $table_name = "products";

    public $id;
    public $nama_product;
    public $harga_product;
    public $gambar_product;
    public $keterangan_product;

    public function __construct($db) {
        $this->conn = $db;
    }


    public function read() {
    
        $query = "SELECT * FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function create() {
    
        $query = "INSERT INTO " . $this->table_name . " SET nama_product=:nama_product, harga_product=:harga_product, gambar_product=:gambar_product, keterangan_product=:keterangan_product";
        $stmt = $this->conn->prepare($query);
        $this->nama_product = htmlspecialchars(strip_tags($this->nama_product ?? ''));
        $this->harga_product = htmlspecialchars(strip_tags($this->harga_product ?? ''));
        $this->gambar_product = htmlspecialchars(strip_tags($this->gambar_product ?? ''));
        $this->keterangan_product = htmlspecialchars(strip_tags($this->keterangan_product ?? ''));

        $stmt->bindParam(":nama_product", $this->nama_product);
        $stmt->bindParam(":harga_product", $this->harga_product);
        $stmt->bindParam(":gambar_product", $this->gambar_product);
        $stmt->bindParam(":keterangan_product", $this->keterangan_product);

        if($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function update() {
        $query = "UPDATE " . $this->table_name . " SET nama_product = :nama_product, harga_product=:harga_product, gambar_product=:gambar_product, keterangan_product=:keterangan_product WHERE id = :id";
        $stmt = $this->conn->prepare($query);

        $this->nama_product = htmlspecialchars(strip_tags($this->nama_product));
        $this->harga_product = htmlspecialchars(strip_tags($this->harga_product));
        $this->gambar_product = htmlspecialchars(strip_tags($this->gambar_product));
        $this->keterangan_product = htmlspecialchars(strip_tags($this->keterangan_product));
        $this->id = htmlspecialchars(strip_tags($this->id));

        $stmt->bindParam(":nama_product", $this->nama_product);
        $stmt->bindParam(":harga_product", $this->harga_product);
        $stmt->bindParam(":gambar_product", $this->gambar_product);
        $stmt->bindParam(":keterangan_product", $this->keterangan_product);
        $stmt->bindParam(":id", $this->id);

        if($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function delete() {
        $query = "DELETE FROM " . $this->table_name . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);

        $this->id = htmlspecialchars(strip_tags($this->id));
        $stmt->bindParam(":id", $this->id);

        if($stmt->execute()) {
            return true;
        }
        return false;
    }
	public function cari() {
        $query = "SELECT * FROM " . $this->table_name . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);

        $this->id = htmlspecialchars(strip_tags($this->id));
        $stmt->bindParam(":id", $this->id);
		 $stmt->execute();
		return $stmt;
    }
    
    
}
?>