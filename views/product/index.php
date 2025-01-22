<?php
require_once 'views/UI.php';
UI::setTitle("View Database");
UI::setHeader("Data Product");
$productController = new ProductController();
$productController = new transactionController();
$namaProduk = '';
$error = '';





$transactions = $productController->getTransactions();
?>
  <div class="relative min-h-screen px-5">
  <h3 class="p-5 text-xl flex items-center">
    Kasir
    <button id="toggleTableKasir" class="flex items-center px-4 py-2 ml-4 text-black rounded focus:outline-none">
        
        <svg id="toggleIconKasir" xmlns="http://www.w3.org/2000/svg" class="ml-2" width="24" height="24" viewBox="0 0 24 24" fill="none">
            <path d="M12 15l-6-6h12l-6 6z" fill="currentColor"/>
        </svg>
    </button>
</h3>
    <div id="divKasir" class="hidden rounded-lg flex flex-col items-end relative w-full h-auto bg-[#F1DEC6] gap-5 rounded-2 my-4 overflow-hidden">

        <div class="my-4 w-full ">
        <?php if ($error): ?>
        <div class="bg-red-500 text-white p-2 rounded mb-4">
          <?php echo $error; ?>
        </div>
      <?php endif; ?>
        <form class="px-4" action="index.php?action=processTransaction" id="cashierForm" method="POST">
        <div class="mb-4">
                <label for="idProduct" class="block text-sm font-medium text-gray-700">ID Produk</label>
                <input type="number" id="idProduct" name="idProduct" class="w-full h-12 px-6 lg:h-14 mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" value="<?php echo isset($idProduk) ? $idProduk : ''; ?>" required>
            </div>
            <div class="mb-4" id="outletDropdownContainer">
                <label for="idOutlet" class="block text-sm font-medium text-gray-700">ID Outlet</label>
                <select id="idOutlet" name="idOutlet" class="w-full h-12 px-6 lg:h-14 mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                    <option value="">Pilih Outlet</option>
                    <?php foreach ($outlets as $outlet): ?>
                        <option value="<?php echo $outlet['id_outlet']; ?>">
                            <?php echo $outlet['nama_outlet']; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="mb-4 hidden" id="outletInputContainer">
                <label for="namaOutlet" class="block text-sm font-medium text-gray-700">Nama Outlet</label>
                <input type="text" id="namaOutlet" class="w-full h-12 px-6 lg:h-14 mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" readonly>
            </div>
        
        <div class="mb-4">
          <label for="namaProduk" class="block text-sm font-medium text-gray-700">Nama Produk</label>
          <input type="text" id="namaProduk" class="w-full h-12 px-6 lg:h-14 mt-1 block w-full  rounded-md shadow-sm sm:text-sm" value="<?php echo $namaProduk; ?>" readonly>
        </div>
            <div class="mb-4">
                <label for="jumlahProduk" class="block text-sm font-medium text-gray-700">Jumlah</label>
                <input type="number" id="jumlahProduk" name="jumlahProduk" class="w-full h-12 px-6 lg:h-14 mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
            </div> 
           
            <button type="submit" id="bayarKasir" class="bg-indigo-600 text-white px-4 py-2 rounded-md">Bayar</button>
        </form>
        </div>
        
        <div  class="px-4 rounded-lg flex  flex-col items-end relative w-full h-auto bg-[#F1DEC6] border border-black border-2 gap-5 rounded-2 my-4 overflow-hidden">
        <div class="my-4 w-full max-h-[350px] overflow-y-auto overflow-x-auto">
    <table border="1" class="min-w-full table-auto border-collapse" id="transactionsTable">
        <thead>
            <tr>
                <th class="text-center text-wrap">ID Struk</th>
                <th class="text-center text-wrap">Nama Produk</th>
                <th class="text-center text-wrap">Nama Outlet</th>
                <th class="text-center text-wrap">Jumlah</th>
                <th class="text-center text-wrap">Print</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($transactions as $transaction) : ?>
                <tr>
                    <td class="text-center text-wrap"><?php echo $transaction['id_struk']; ?></td>
                    <td class="text-center text-wrap"><?php echo $transaction['nama_product']; ?></td>
                    <td class="text-center text-wrap"><?php echo $transaction['nama_outlet']; ?></td>
                    <td class="text-center text-wrap"><?php echo number_format($transaction['jumlah'], 0, ',', '.') . ' Pcs';?></td>
                    <td class="text-center text-wrap">
            <div class="flex gap-2 items-center justify-center p-4">
            <div class="w-6 h-6 relative cursor-pointer hover:bg-transparent active:bg-[#f4a3ba] lg:hover:bg-[#f4a3ba] rounded printKasir" 
                                 data-id="<?php echo $transaction['id_struk'];?>">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                    <path fill="currentColor" d="M16 8V5H8v3H6V3h12v5zM4 10h16zm14 2.5q.425 0 .713-.288T19 11.5t-.288-.712T18 10.5t-.712.288T17 11.5t.288.713t.712.287M16 19v-4H8v4zm2 2H6v-4H2v-6q0-1.275.875-2.137T5 8h14q1.275 0 2.138.863T22 11v6h-4zm2-6v-4q0-.425-.288-.712T19 10H5q-.425 0-.712.288T4 11v4h2v-2h12v2z" />
                                </svg>
                            </div>
            </div>
            
            </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
        </div>
        
<div id="strukKasir" class="hidden fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50">
    <div class="bg-white rounded-lg shadow-lg p-6 w-full max-w-md mx-4">
    <h2 class="text-xl font-bold mb-4">Struk Pembelian</h2>
    <div class="mb-4">
    <p class="font-bold">Nama Produk</p>
    <p id="strukNamaProduk"></p>
    </div>
    
    <div class="mb-4">
    <p class="font-bold">Harga Produk</p>
    <p id="strukHargaProduk"></p>
    </div>
    
    <div class="mb-4">
    <p class="font-bold">Jumlah Produk</p>
      <p id="strukJumlahProduk"></p>
      </div>
      
        <div class="mb-4">
        <p class="font-bold">Total Harga</p>
      <p id="strukTotalHarga"></p>
        </div>
      <button id="closeStruk" class="mt-4 bg-red-500 text-white px-4 py-2 rounded">Tutup</button>
    </div>
</div>
  </div>
  
  
<h3 class="p-5 text-xl flex items-center">
    View All Products
    <button id="toggleTableProduct" class="flex items-center px-4 py-2 ml-4 text-black rounded focus:outline-none">
        
        <svg id="toggleIconProduct" xmlns="http://www.w3.org/2000/svg" class="ml-2" width="24" height="24" viewBox="0 0 24 24" fill="none">
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
                
                <!-- <div class="w-6 h-6  cursor-pointer hover:bg-transparent active:bg-[#f4a3ba] lg:hover:bg-[#f4a3ba] rounded" id="refreshProducts" >
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" d="M12 20q-3.35 0-5.675-2.325T4 12t2.325-5.675T12 4q1.725 0 3.3.712T18 6.75V5q0-.425.288-.712T19 4t.713.288T20 5v5q0 .425-.288.713T19 11h-5q-.425 0-.712-.288T13 10t.288-.712T14 9h3.2q-.8-1.4-2.187-2.2T12 6Q9.5 6 7.75 7.75T6 12t1.75 4.25T12 18q1.7 0 3.113-.862t2.187-2.313q.2-.35.563-.487t.737-.013q.4.125.575.525t-.025.75q-1.025 2-2.925 3.2T12 20"/></svg>
                </div> -->
                    
                    
                </div>
        <div id="productsContainer" class="my-4 w-full max-h-[350px] overflow-y-auto overflow-x-auto">
          <table border="1" class=" min-w-full table-auto border-collapse" id="productsTable">
          <thead>
        <tr>
            <th class="text-center text-wrap">ID</th>
            <th class="text-center text-wrap">Nama Product</th>
            <th class="text-center text-wrap">Harga</th>
            <th class="text-center text-wrap max-w-20">Gambar Produk</th>
            <th class="text-center text-wrap">Keterangan</th>
            <th class="text-center text-wrap">Quantity</th>
            <th class="text-center text-wrap">Nama Outlet</th>
            <th class="text-center text-wrap">Actions</th>
        </tr>
        </thead>
        <tbody id="productsTableBody">
        <?php foreach($products as $product): ?>
        <tr>
            <td class="text-center text-wrap"><?php echo $product['id_product']; ?></td>
            <td class="text-center text-wrap"><?php echo $product['nama_product']; ?></td>
            <td class="text-center text-wrap"><?php echo 'Rp ' . number_format($product['harga_product'], 0, ',', '.'); ?></td>
            <td class="text-center text-wrap justify-center flex">
            <?php if (!empty($product['gambar_product'])): ?>
            <div class="bg-white aspect-w-1 aspect-h-1 w-20 h-20">
                                <img src="<?php echo $product['gambar_product']; ?>" alt="Gambar Produk" class="object-contain w-full h-full">
                            </div>
                            <?php endif; ?>
            </td>
            <td class="text-center text-wrap"><?php echo $product['keterangan_product']; ?></td>
            <td class="text-center text-wrap"><?php echo $product['quantity']; ?></td>
            <td class="text-center text-wrap"><?php echo $product['nama_outlet']; ?></td>
            <td class="text-center text-wrap">
            
            <div class="flex gap-2 items-center justify-center p-4">
            <div class="w-6 h-6 relative cursor-pointer hover:bg-transparent active:bg-[#f4a3ba] lg:hover:bg-[#f4a3ba] rounded editProduct" 
     data-id="<?php echo $product['id_product']; ?>" 
     data-nama="<?php echo $product['nama_product']; ?>" 
     data-harga="<?php echo $product['harga_product']; ?>" 
     data-gambar="<?php echo $product['gambar_product']; ?>" 
     data-keterangan="<?php echo $product['keterangan_product']; ?>" 
     data-quantity="<?php echo $product['quantity']; ?>" 
     data-outlet="<?php echo isset($product['id_outlet']) ? $product['id_outlet'] : ''; ?>">
    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="24" viewBox="0 0 25 24" fill="none">
        <path d="M5.5 19H6.925L16.7 9.225L15.275 7.8L5.5 17.575V19ZM3.5 21V16.75L16.7 3.575C16.9 3.39167 17.121 3.25 17.363 3.15C17.605 3.05 17.859 3 18.125 3C18.391 3 18.6493 3.05 18.9 3.15C19.1507 3.25 19.3673 3.4 19.55 3.6L20.925 5C21.125 5.18333 21.271 5.4 21.363 5.65C21.455 5.9 21.5007 6.15 21.5 6.4C21.5 6.66667 21.4543 6.921 21.363 7.163C21.2717 7.405 21.1257 7.62567 20.925 7.825L7.75 21H3.5ZM15.975 8.525L15.275 7.8L16.7 9.225L15.975 8.525Z" fill="black"/>
    </svg>
</div>
                <a href="index.php?action=delete&id_product=<?php echo $product['id_product']; ?>" class="w-6 h-6 relative cursor-pointer hover:bg-transparent active:bg-[#f4a3ba] lg:hover:bg-[#f4a3ba] rounded delete-User">
                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="24" viewBox="0 0 25 24" fill="none">
                        <path d="M7.5 21C6.95 21 6.47933 20.8043 6.088 20.413C5.69667 20.0217 5.50067 19.5507 5.5 19V6H4.5V4H9.5V3H15.5V4H20.5V6H19.5V19C19.5 19.55 19.3043 20.021 18.913 20.413C18.5217 20.805 18.0507 21.0007 17.5 21H7.5ZM9.5 17H11.5V8H9.5V17ZM13.5 17H15.5V8H13.5V17Z" fill="black"/>
                    </svg>
                </a>
            </div>
            
            </td>
        </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
        </div>
   <div id="editAddProduct" class="hidden fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50">
    <div class="bg-white rounded-lg shadow-lg p-6 w-full max-w-md mx-4">
    <form id="productForm" action="" method="POST">
    <input type="hidden" name="action" id="formAction" value="">
    <input type="hidden" name="productId" id="productId">
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
            <div class="mb-4">
                <label for="quantity" class="block text-sm font-medium text-gray-700">Quantity</label>
                <input type="text" id="quantity" name="quantity" class="w-full h-12 px-6 lg:h-14 mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
            </div>
            <div class="mb-4">
    <label for="id_outlet" class="block text-sm font-medium text-gray-700">Outlet</label>
    <select name="id_outlet" id="id_outlet" class="w-full h-12 px-6 lg:h-14 mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
        <option value="">Pilih Outlet</option>
        <?php if (!empty($outlets)): ?>
            <?php foreach ($outlets as $outlet): ?>
                <option value="<?php echo $outlet['id_outlet']; ?>">
                    <?php echo $outlet['nama_outlet']; ?>
                </option>
            <?php endforeach; ?>
        <?php else: ?>
            <option value="">Tidak ada outlet tersedia</option>
        <?php endif; ?>
    </select>
</div>
            
            <div class="flex justify-end space-x-4">
                <button  id="cancelProduct" class="bg-gray-500 text-white px-4 py-2 rounded-md">Cancel</button>
                <button type="submit" id="saveProduct" class="bg-indigo-600 text-white px-4 py-2 rounded-md">Save</button>
            </div>
        </form>
    </div>
</div>
  </div>
  
  <h3 class="p-5 text-xl flex items-center">
    View All Outlets
    <button id="toggleTableOutlets" class="flex items-center px-4 py-2 ml-4 text-black rounded focus:outline-none">
        
        <svg id="toggleIconOutlets" xmlns="http://www.w3.org/2000/svg" class="ml-2" width="24" height="24" viewBox="0 0 24 24" fill="none">
            <path d="M12 15l-6-6h12l-6 6z" fill="currentColor"/>
        </svg>
    </button>
</h3>
  <div id="divOutlets" class="hidden rounded-lg flex flex-col items-end relative w-full h-auto bg-[#F1DEC6] border border-black border-2 gap-5 rounded-2 my-4 overflow-hidden">
  <div class="h-6 justify-end items-end gap-2.5 flex px-4 my-4 " >
                  <div class="w-6 h-6  cursor-pointer hover:bg-transparent active:bg-[#f4a3ba] lg:hover:bg-[#f4a3ba] rounded " id="addProduct">
                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="24" viewBox="0 0 25 24" fill="none">
                        <path d="M19.5 12.998H13.5V18.998H11.5V12.998H5.5V10.998H11.5V4.998H13.5V10.998H19.5V12.998Z" fill="black"/>
                      </svg>
                </div>
                
                <!-- <div class="w-6 h-6  cursor-pointer hover:bg-transparent active:bg-[#f4a3ba] lg:hover:bg-[#f4a3ba] rounded" id="refreshProducts" >
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" d="M12 20q-3.35 0-5.675-2.325T4 12t2.325-5.675T12 4q1.725 0 3.3.712T18 6.75V5q0-.425.288-.712T19 4t.713.288T20 5v5q0 .425-.288.713T19 11h-5q-.425 0-.712-.288T13 10t.288-.712T14 9h3.2q-.8-1.4-2.187-2.2T12 6Q9.5 6 7.75 7.75T6 12t1.75 4.25T12 18q1.7 0 3.113-.862t2.187-2.313q.2-.35.563-.487t.737-.013q.4.125.575.525t-.025.75q-1.025 2-2.925 3.2T12 20"/></svg>
                </div> -->
                    
                    
                </div>
        <div id="outletsContainer" class="my-4 w-full max-h-[350px] overflow-y-auto overflow-x-auto">
          <table border="1" class=" min-w-full table-auto border-collapse" id="outletsTable">
          <thead>
        <tr>
            <th class="text-center text-wrap">ID</th>
            <th class="text-center text-wrap">Nama Product</th>
            <th class="text-center text-wrap">Harga</th>
            <th class="text-center text-wrap max-w-20">Gambar Produk</th>
            <th class="text-center text-wrap">Keterangan</th>
            <th class="text-center text-wrap">Quantity</th>
            <th class="text-center text-wrap">Actions</th>
        </tr>
        </thead>
        <tbody id="productsTableBody">
        <?php foreach($products as $product): ?>
        <tr>
            <td class="text-center text-wrap"><?php echo $product['id_product']; ?></td>
            <td class="text-center text-wrap"><?php echo $product['nama_product']; ?></td>
            <td class="text-center text-wrap"><?php echo 'Rp ' . number_format($product['harga_product'], 0, ',', '.'); ?></td>
            <td class="text-center text-wrap justify-center flex">
            <?php if (!empty($product['gambar_product'])): ?>
            <div class="bg-white aspect-w-1 aspect-h-1 w-20 h-20">
                                <img src="<?php echo $product['gambar_product']; ?>" alt="Gambar Produk" class="object-contain w-full h-full">
                            </div>
                            <?php endif; ?>
            </td>
            <td class="text-center text-wrap"><?php echo $product['keterangan_product']; ?></td>
            <td class="text-center text-wrap"><?php echo $product['quantity']; ?></td>
            <td class="text-center text-wrap">
            
            <div class="flex gap-2 items-center justify-center p-4">
                <div class="w-6 h-6 relative cursor-pointer hover:bg-transparent active:bg-[#f4a3ba] lg:hover:bg-[#f4a3ba] rounded editProduct" data-id="<?php echo $product['id_product']; ?>" data-nama="<?php echo $product['nama_product']; ?>" data-harga="<?php echo $product['harga_product']; ?>" data-gambar="<?php echo $product['gambar_product']; ?>" data-keterangan="<?php echo $product['keterangan_product']; ?>">
                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="24" viewBox="0 0 25 24" fill="none">
                        <path d="M5.5 19H6.925L16.7 9.225L15.275 7.8L5.5 17.575V19ZM3.5 21V16.75L16.7 3.575C16.9 3.39167 17.121 3.25 17.363 3.15C17.605 3.05 17.859 3 18.125 3C18.391 3 18.6493 3.05 18.9 3.15C19.1507 3.25 19.3673 3.4 19.55 3.6L20.925 5C21.125 5.18333 21.271 5.4 21.363 5.65C21.455 5.9 21.5007 6.15 21.5 6.4C21.5 6.66667 21.4543 6.921 21.363 7.163C21.2717 7.405 21.1257 7.62567 20.925 7.825L7.75 21H3.5ZM15.975 8.525L15.275 7.8L16.7 9.225L15.975 8.525Z" fill="black"/>
                    </svg>
                </div>
                <a href="index.php?action=delete&id_product=<?php echo $product['id_product']; ?>" class="w-6 h-6 relative cursor-pointer hover:bg-transparent active:bg-[#f4a3ba] lg:hover:bg-[#f4a3ba] rounded delete-User">
                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="24" viewBox="0 0 25 24" fill="none">
                        <path d="M7.5 21C6.95 21 6.47933 20.8043 6.088 20.413C5.69667 20.0217 5.50067 19.5507 5.5 19V6H4.5V4H9.5V3H15.5V4H20.5V6H19.5V19C19.5 19.55 19.3043 20.021 18.913 20.413C18.5217 20.805 18.0507 21.0007 17.5 21H7.5ZM9.5 17H11.5V8H9.5V17ZM13.5 17H15.5V8H13.5V17Z" fill="black"/>
                    </svg>
                </a>
            </div>
            
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
    <input type="hidden" name="productId" id="productId">
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
            <div class="mb-4">
                <label for="quantity" class="block text-sm font-medium text-gray-700">Quantity</label>
                <input type="text" id="quantity" name="quantity" class="w-full h-12 px-6 lg:h-14 mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
            </div>
            <div class="mb-4">
                <label for="id_outlet" class="block text-sm font-medium text-gray-700">ID Outlet</label>
                <input type="number" name="id_outlet" id="id_outlet" class="w-full h-12 px-6 lg:h-14 mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
            </div>
            
            <div class="flex justify-end space-x-4">
                <button  id="cancelProduct" class="bg-gray-500 text-white px-4 py-2 rounded-md">Cancel</button>
                <button type="submit" id="saveProduct" class="bg-indigo-600 text-white px-4 py-2 rounded-md">Save</button>
            </div>
        </form>
    </div>
</div>
  </div>
   
	</div>

    <script src="views/assets/index.js"></script>
<?php


UI::setFooter("Kelas PBO P1 241");
?>