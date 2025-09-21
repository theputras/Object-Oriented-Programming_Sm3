<?php
class Books {
    public $title;
    public $author;
    public $publisher;
    public $year;
    public $price;

    public function __construct($title, $author, $publisher, $year, $price) {
        $this->title = $title;
        $this->author = $author;
        $publisher = $publisher;
        $this->year = $year;
        $this->price = $price;
    }

    public function displayInfo() {
        echo "Judul Buku: " . $this->title ."\n";
        echo "Penulis: " . $this->author ."\n";
        echo "Penerbit: " . $this->publisher ."\n";
        echo "Tahun Terbit: " . $this->year."\n";
        echo "Harga: Rp " . number_format($this->price, 0, ',', '.') . "\n";
        echo "\n";
    }
}


?>