<?php
require_once 'views/UI.php';
UI::setTitle("Product:Edit Product");
UI::setHeader("Edit Product");
?>
    <form action="index.php?action=edit&id=<?php echo $product['id']; ?>" method="post" class="w3-container">
        <label for="nama_product">Nama Product:</label>
        <input type="text" name="nama_product" id="nama_product" value="<?php echo $product['nama_product']; ?>" required class="w3-input">
        <br>
        <label for="harga">Harga:</label>
        <input type="number" name="harga_product" id="harga_product" value="<?php echo $product['harga_product']; ?>" required class="w3-input">
        <br>
        <input type="submit" value="Update" class="w3-input w3-blue">
    </form>
	<br>
<?php
UI::setFooter("Kelas PBO P1 241");
?>