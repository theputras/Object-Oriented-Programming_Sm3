<?php

class outlet  {
    private $conn;
    private $table_name = "outlets";
    public $nama_outlet;
    public $alamat_outlet;
    public $tipe_outlet;
    public $id_outlet;
    
    public function __construct($db) {
        $this->conn = $db;
    }
    public function readOutlets(){
        $query = "SELECT * FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }
    
    public function createOutlet() {
        $query = "INSERT INTO " . $this->table_name . "
                  SET nama_outlet=:nama_outlet, 
                      alamat_outlet=:alamat_outlet, 
                      tipe_outlet=:tipe_outlet";
        $stmt = $this->conn->prepare($query);
    
        $this->nama_outlet = htmlspecialchars(strip_tags($this->nama_outlet ?? ''));
        $this->alamat_outlet = htmlspecialchars(strip_tags($this->alamat_outlet ?? ''));
        $this->tipe_outlet = htmlspecialchars(strip_tags($this->tipe_outlet ?? ''));
    
        $stmt->bindParam(":nama_outlet", $this->nama_outlet);
        $stmt->bindParam(":alamat_outlet", $this->alamat_outlet);
        $stmt->bindParam(":tipe_outlet", $this->tipe_outlet);
    
        return $stmt->execute();
    }
    
public function updateOutlet() {
    // Perbaiki query dengan menambahkan spasi setelah nama tabel
    $query = "UPDATE " . $this->table_name . " SET 
              nama_outlet = :nama_outlet, 
              alamat_outlet = :alamat_outlet, 
              tipe_outlet = :tipe_outlet 
              WHERE id_outlet = :id_outlet";
    
    $stmt = $this->conn->prepare($query);

    // Sanitize input
    $this->nama_outlet = htmlspecialchars(strip_tags($this->nama_outlet));
    $this->alamat_outlet = htmlspecialchars(strip_tags($this->alamat_outlet));
    $this->tipe_outlet = htmlspecialchars(strip_tags($this->tipe_outlet));
    $this->id_outlet = htmlspecialchars(strip_tags($this->id_outlet));

    // Bind parameter
    $stmt->bindParam(":nama_outlet", $this->nama_outlet);
    $stmt->bindParam(":alamat_outlet", $this->alamat_outlet);
    $stmt->bindParam(":tipe_outlet", $this->tipe_outlet);
    $stmt->bindParam(":id_outlet", $this->id_outlet);

    // Eksekusi query
    return $stmt->execute();
}
    
    
    public function cariOutlet() {
        $query = "SELECT * FROM ".$this -> table_name." WHERE id_outlet = :id_outlet";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id_outlet", $this->id_outlet);
        $stmt->execute();
        return $stmt;
    }
    
    public function deleteOutlet() {
        // Hapus data terkait di tabel products_quantity
        $query = "DELETE FROM products_quantity WHERE id_outlet = :id_outlet";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id_outlet", $this->id_outlet);
        $stmt->execute(); 
        
        $query = "DELETE FROM products_inventory WHERE id_outlet = :id_outlet";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id_outlet", $this->id_outlet);
        $stmt->execute();
        
        $query = "DELETE FROM products_quantity WHERE id_outlet = :id_outlet";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id_outlet", $this->id_outlet);
        $stmt->execute(); 
        
        $query = "DELETE FROM transaction_details WHERE id_outlet = :id_outlet";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id_outlet", $this->id_outlet);
        $stmt->execute();

        // Hapus data di tabel outlets
        $query = "DELETE FROM " . $this->table_name . " WHERE id_outlet = :id_outlet";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id_outlet", $this->id_outlet);
        return $stmt->execute();
    }
}