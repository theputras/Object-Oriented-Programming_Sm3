<?php
require_once 'views/UI.php';
UI::setTitle("View Database");
UI::setHeader("Data Product");

// Initialize database and product object
$database = new Database();
$db = $database->getConnection();
$product = new Product($db);

// Fetch all products
$stmt = $product->read();
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
  <div class="relative min-h-screen px-5">
  <h3 class="p-5 text-xl flex items-center">
    View All Products
    <button id="toggleTable" class="flex items-center px-4 py-2 ml-4 text-black rounded">
        
        <svg id="toggleIcon" xmlns="http://www.w3.org/2000/svg" class="ml-2" width="24" height="24" viewBox="0 0 24 24" fill="none">
            <path d="M12 15l-6-6h12l-6 6z" fill="currentColor"/>
        </svg>
    </button>
</h3>
  <div id="divProduct" class="rounded-lg flex flex-col items-end relative w-full h-auto bg-[#F1DEC6] border border-black border-2 gap-5 rounded-2 my-4 overflow-hidden">
  <div class="h-6 justify-end items-end gap-2.5 flex px-4 my-4 " >
                  <div class="w-6 h-6  cursor-pointer hover:bg-transparent active:bg-[#f4a3ba] lg:hover:bg-[#f4a3ba] rounded " id="addProduct">
                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="24" viewBox="0 0 25 24" fill="none">
                        <path d="M19.5 12.998H13.5V18.998H11.5V12.998H5.5V10.998H11.5V4.998H13.5V10.998H19.5V12.998Z" fill="black"/>
                      </svg>
                </div>
                
                <div class="w-6 h-6  cursor-pointer hover:bg-transparent active:bg-[#f4a3ba] lg:hover:bg-[#f4a3ba] rounded" id="refreshProducts" >
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" d="M12 20q-3.35 0-5.675-2.325T4 12t2.325-5.675T12 4q1.725 0 3.3.712T18 6.75V5q0-.425.288-.712T19 4t.713.288T20 5v5q0 .425-.288.713T19 11h-5q-.425 0-.712-.288T13 10t.288-.712T14 9h3.2q-.8-1.4-2.187-2.2T12 6Q9.5 6 7.75 7.75T6 12t1.75 4.25T12 18q1.7 0 3.113-.862t2.187-2.313q.2-.35.563-.487t.737-.013q.4.125.575.525t-.025.75q-1.025 2-2.925 3.2T12 20"/></svg>
                </div>
                    
                    
                </div>
        <div class="my-4 w-full max-h-[350px] overflow-y-auto overflow-x-auto">
          <table border="1" class=" min-w-full table-auto border-collapse" id="productsTable">
          <thead>
        <tr>
            <th class="text-center text-wrap">ID</th>
            <th class="text-center text-wrap">Nama Product</th>
            <th class="text-center text-wrap">Harga</th>
            <th class="text-center text-wrap max-w-20">Gambar Produk</th>
            <th class="text-center text-wrap">Keterangan</th>
            <th class="text-center text-wrap">Actions</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach($products as $product): ?>
        <tr>
            <td class="text-center text-wrap"><?php echo $product['id']; ?></td>
            <td class="text-center text-wrap"><?php echo $product['nama_product']; ?></td>
            <td class="text-center text-wrap"><?php echo $product['harga_product']; ?></td>
            <td class="text-center text-wrap justify-center flex">
            <?php if (!empty($product['gambar_product'])): ?>
            <div class="bg-white aspect-w-1 aspect-h-1 w-20 h-20">
                                <img src="<?php echo $product['gambar_product']; ?>" alt="Gambar Produk" class="object-contain w-full h-full">
                            </div>
                            <?php endif; ?>
            </td>
            <td class="text-center text-wrap"><?php echo $product['keterangan_product']; ?></td>
            <td class="text-center text-wrap">
            
            <div class="flex gap-2 items-center justify-center p-4">
                <div class="w-6 h-6 relative cursor-pointer hover:bg-transparent active:bg-[#f4a3ba] lg:hover:bg-[#f4a3ba] rounded editProduct" data-id="<?php echo $product['id']; ?>" data-nama="<?php echo $product['nama_product']; ?>" data-harga="<?php echo $product['harga_product']; ?>" data-gambar="<?php echo $product['gambar_product']; ?>" data-keterangan="<?php echo $product['keterangan_product']; ?>">
                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="24" viewBox="0 0 25 24" fill="none">
                        <path d="M5.5 19H6.925L16.7 9.225L15.275 7.8L5.5 17.575V19ZM3.5 21V16.75L16.7 3.575C16.9 3.39167 17.121 3.25 17.363 3.15C17.605 3.05 17.859 3 18.125 3C18.391 3 18.6493 3.05 18.9 3.15C19.1507 3.25 19.3673 3.4 19.55 3.6L20.925 5C21.125 5.18333 21.271 5.4 21.363 5.65C21.455 5.9 21.5007 6.15 21.5 6.4C21.5 6.66667 21.4543 6.921 21.363 7.163C21.2717 7.405 21.1257 7.62567 20.925 7.825L7.75 21H3.5ZM15.975 8.525L15.275 7.8L16.7 9.225L15.975 8.525Z" fill="black"/>
                    </svg>
                </div>
                <a href="index.php?action=delete&id=<?php echo $product['id']; ?>" class="w-6 h-6 relative cursor-pointer hover:bg-transparent active:bg-[#f4a3ba] lg:hover:bg-[#f4a3ba] rounded delete-User">
                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="24" viewBox="0 0 25 24" fill="none">
                        <path d="M7.5 21C6.95 21 6.47933 20.8043 6.088 20.413C5.69667 20.0217 5.50067 19.5507 5.5 19V6H4.5V4H9.5V3H15.5V4H20.5V6H19.5V19C19.5 19.55 19.3043 20.021 18.913 20.413C18.5217 20.805 18.0507 21.0007 17.5 21H7.5ZM9.5 17H11.5V8H9.5V17ZM13.5 17H15.5V8H13.5V17Z" fill="black"/>
                    </svg>
                </a>
            </div>
            <!-- <a  class="w3-button w3-green editProduct" ">Edit</a>
                <a  class="w3-button w3-red">Delete</a> -->
            </td>
        </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
        </div>
   <div id="editAddOutlets" class="hidden fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50">
    <div class="bg-white rounded-lg shadow-lg p-6 w-full max-w-md mx-4">
    <form id="outletsForm" action="" method="POST">
    <input type="hidden" name="action" id="formAction" value="">
    <input type="hidden" name="id" id="productId">
            <div class="mb-4">
                <label for="nama_product" class="block text-sm font-medium text-gray-700">Nama Product</label>
                <input type="text" id="nama_product" name="nama_product" class="w-full h-12 px-6 lg:h-14  mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
            </div>
            <div class="mb-4">
                <label for="harga_product" class="block text-sm font-medium text-gray-700">Harga Produk</label>
                <input type="number" id="harga_product" name="harga_product" class="w-full h-12 px-6 lg:h-14 mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
            </div> 
            
            <div class="mb-4">
                <label for="gambar_product" class="block text-sm font-medium text-gray-700">Gambar Produk</label>
                <input type="text" id="gambar_product" name="gambar_product" class="w-full h-12 px-6 lg:h-14 mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
            </div>
            
            <div class="mb-4">
                <label for="keterangan_product" class="block text-sm font-medium text-gray-700">Keterangan</label>
                <input type="text" id="keterangan_product" name="keterangan_product" class="w-full h-12 px-6 lg:h-14 mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
            </div>
            
            
            <div class="flex justify-end space-x-4">
                <button type="button"  id="cancelUser" class="bg-gray-500 text-white px-4 py-2 rounded-md">Cancel</button>
                <button type="submit" id="saveUser" class="bg-indigo-600 text-white px-4 py-2 rounded-md">Save</button>
            </div>
        </form>
    </div>
</div>
  </div>
   
	</div>

	 
	 <script>
document.getElementById('cancelUser').addEventListener('click', function() {
    document.getElementById('editAddOutlets').classList.add('hidden');
});

document.getElementById('addProduct').addEventListener('click', function() {
    document.getElementById('editAddOutlets').classList.remove('hidden');
});

document.getElementById('addProduct').addEventListener('click', function() {
    document.getElementById('outletsForm').action = 'index.php?action=create';
    document.getElementById('productId').value = '';
    document.getElementById('nama_product').value = '';
    document.getElementById('harga_product').value = '';
    document.getElementById('editAddOutlets').classList.remove('hidden');
});

document.querySelectorAll('.editProduct').forEach(function(button) {
    button.addEventListener('click', function() {
        document.getElementById('formAction').value = 'edit';
        document.getElementById('outletsForm').action = 'index.php?action=edit&id=' + this.getAttribute('data-id');
        document.getElementById('productId').value = this.getAttribute('data-id');
        document.getElementById('nama_product').value = this.getAttribute('data-nama');
        document.getElementById('harga_product').value = this.getAttribute('data-harga');
        document.getElementById('gambar_product').value = this.getAttribute('data-gambar');
        document.getElementById('keterangan_product').value = this.getAttribute('data-keterangan');
        document.getElementById('editAddOutlets').classList.remove('hidden');
    });
});


async function fetchProducts() {
    try {
        const response = await fetch('index.php?action=refresh');
        if (!response.ok) {
            throw new Error('Gagal mengambil data produk');
        }
        const data = await response.text();
        
    } catch (error) {
        console.error('Error fetching products:', error.message);
    }
}

document.getElementById('refreshProducts').addEventListener('click', fetchProducts);
document.getElementById('toggleTable').addEventListener('click', function() {
    const table = document.getElementById('divProduct');
    const toggleText = document.getElementById('toggleText');
    const toggleIcon = document.getElementById('toggleIcon');

    if (table.classList.contains('hidden')) {
        table.classList.remove('hidden');
        table.classList.add('animate-slide-down');
        table.classList.remove('animate-slide-up');
        toggleIcon.innerHTML = '<path d="M12 15l-6-6h12l-6 6z" fill="currentColor"/>';
    } else {
        table.classList.add('animate-slide-up');
        table.classList.remove('animate-slide-down');
        table.addEventListener('animationend', function() {
            table.classList.add('hidden');
        }, { once: true });
        toggleIcon.innerHTML = '<path d="M12 9l-6 6h12l-6-6z" fill="currentColor"/>';
    }
});
</script>
<?php


UI::setFooter("Kelas PBO P1 241");
?>