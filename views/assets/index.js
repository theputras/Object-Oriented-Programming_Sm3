const cancelProduct =  document.getElementById('cancelProduct')
cancelProduct.addEventListener('click', function() {
    document.getElementById('editAddProduct').classList.add('hidden');
});

document.getElementById('addProduct').addEventListener('click', function() {
    document.getElementById('editAddProduct').classList.remove('hidden');
});

document.getElementById('addProduct').addEventListener('click', function() {
    document.getElementById('productForm').action = 'index.php?action=create';
    document.getElementById('productId').value = '';
    document.getElementById('nama_product').value = '';
    document.getElementById('harga_product').value = '';
    document.getElementById('quantity').value = '';
    document.getElementById('id_outlet').value = '';
    document.getElementById('editAddProduct').classList.remove('hidden');
});

document.querySelectorAll('.editProduct').forEach(function(button) {
    button.addEventListener('click', function() {
        document.getElementById('formAction').value = 'edit';
        document.getElementById('productForm').action = 'index.php?action=edit&id_product=' + this.getAttribute('data-id');
        document.getElementById('productId').value = this.getAttribute('data-id');
        document.getElementById('nama_product').value = this.getAttribute('data-nama');
        document.getElementById('harga_product').value = this.getAttribute('data-harga');
        document.getElementById('gambar_product').value = this.getAttribute('data-gambar');
        document.getElementById('keterangan_product').value = this.getAttribute('data-keterangan');
        document.getElementById('quantity').value = this.getAttribute('data-quantity');
        const outletId = this.getAttribute('data-outlet');
        const outletSelect = document.getElementById('id_outlet');
        outletSelect.value = outletId;
        document.getElementById('editAddProduct').classList.remove('hidden');
    });
});
document.getElementById('idProduct').addEventListener('input', function() {
    var idProduct = this.value;
    var namaProduk = document.getElementById('namaProduk');
    var idOutlet = document.getElementById('idOutlet');
    var namaOutlet = document.getElementById('namaOutlet');
    var outletDropdownContainer = document.getElementById('outletDropdownContainer');
    var outletInputContainer = document.getElementById('outletInputContainer');

    if (idProduct.trim() !== '') {
        var xhr = new XMLHttpRequest();
        xhr.open('GET', 'views/product/cariProduk.php?id=' + idProduct, true);
        xhr.onload = function() {
            if (xhr.status === 200) {
                var response = xhr.responseText.trim();
                if (response) {
                    var data = response.split('|');
                    namaProduk.value = data[0] || 'Produk tidak ada';
                    if (data[1] && data[2]) {
                        idOutlet.value = data[1];
                        namaOutlet.value = data[2];
                        outletDropdownContainer.classList.add('hidden');
                        outletInputContainer.classList.remove('hidden');
                    } else {
                        outletDropdownContainer.classList.remove('hidden');
                        outletInputContainer.classList.add('hidden');
                    }
                } else {
                    namaProduk.value = '';
                    outletDropdownContainer.classList.remove('hidden');
                    outletInputContainer.classList.add('hidden');
                }
            } else {
                namaProduk.value = '';
                outletDropdownContainer.classList.remove('hidden');
                outletInputContainer.classList.add('hidden');
            }
        };
        xhr.send();
    } else {
        namaProduk.value = '';
        outletDropdownContainer.classList.remove('hidden');
        outletInputContainer.classList.add('hidden');
    }
});

document.getElementById('idOutlet').addEventListener('change', function() {
    const outletId = this.value;
    updateNamaOutletKasir(outletId);
});

function updateNamaOutletKasir(outletId) {
    const outletSelect = document.getElementById('idOutlet');
    const selectedOption = outletSelect.options[outletSelect.selectedIndex];
    const namaOutletInput = document.getElementById('namaOutlet');
    if (selectedOption && selectedOption.text) {
        namaOutletInput.value = selectedOption.text;
    } else {
        namaOutletInput.value = outletId;
    }
}


document.getElementById('toggleTableProduct').addEventListener('click', function() {
    const toggleText = document.getElementById('toggleText');
    const toggleIconProduct = document.getElementById('toggleIconProduct');

    if (divProduct.classList.contains('hidden')) {
        divProduct.classList.remove('hidden');
        divProduct.classList.add('animate-slide-down');
        divProduct.classList.remove('animate-slide-up');
        toggleIconProduct.innerHTML = '<path d="M12 9l-6 6h12l-6-6z" fill="currentColor"/>'; // Ikon untuk menutup
    } else {
        divProduct.classList.add('animate-slide-up');
        divProduct.classList.remove('animate-slide-down');
        divProduct.addEventListener('animationend', function() {
            divProduct.classList.add('hidden');
        }, { once: true });
        toggleIconProduct.innerHTML = '<path d="M12 15l-6-6h12l-6 6z" fill="currentColor"/>'; // Ikon untuk membuka
    }
});


document.getElementById('toggleTableKasir').addEventListener('click', function() {
    const divKasir = document.getElementById('divKasir');
    const toggleIconKasir = document.getElementById('toggleIconKasir');

    if (divKasir.classList.contains('hidden')) {
        divKasir.classList.remove('hidden');
        divKasir.classList.add('animate-slide-down');
        divKasir.classList.remove('animate-slide-up');
        toggleIconKasir.innerHTML = '<path d="M12 9l-6 6h12l-6-6z" fill="currentColor"/>'; // Ikon untuk menutup
    } else {
        divKasir.classList.add('animate-slide-up');
        divKasir.classList.remove('animate-slide-down');
        divKasir.addEventListener('animationend', function() {
            divKasir.classList.add('hidden');
        }, { once: true });
        toggleIconKasir.innerHTML = '<path d="M12 15l-6-6h12l-6 6z" fill="currentColor"/>'; // Ikon untuk membuka
    }
});

document.getElementById('idProduct').addEventListener('input', function() {
    var idProduct = this.value;
    var namaProduk = document.getElementById('namaProduk');
    
    if (idProduct.trim() !== '') {
        var xhr = new XMLHttpRequest();
        xhr.open('GET', 'views/product/cariProduk.php?id=' + idProduct, true);
        xhr.onload = function() {
            if (xhr.status === 200) {
                namaProduk.value = data[0]|| 'Produk tidak ada';
            } else {
                namaProduk.value = '';
            }
        };
        xhr.send();
    } else {
        namaProduk.value = '';
    }
});




const strukKasir = document.getElementById('strukKasir');

document.querySelectorAll('.printKasir').forEach(item => {
    item.addEventListener('click', function() {
        const id_struk = this.getAttribute('data-id');  // Get the ID from the data-id attribute
        showStruk(id_struk);  // Call the function with the ID
    });
});

function formatNumber(number) {
    return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
}


function showStruk(id_struk) {
    fetch(`index.php?action=cetakStruk&id_struk=${id_struk}`)
        .then(response => response.text())
        .then(data => {
            if (data) {
                const parser = new DOMParser();
            const doc = parser.parseFromString(data, 'text/html');
            const namaProduk = doc.getElementById('nama_product').textContent;
            const jumlahProduk = doc.getElementById('jumlah').textContent;
            const hargaProduk = doc.getElementById('harga_product').textContent;

            // Update the modal with transaction details
            document.getElementById('strukNamaProduk').innerText =  `${namaProduk}`;
            document.getElementById('strukHargaProduk').innerText = `Rp ${formatNumber(hargaProduk)}`;
            document.getElementById('strukJumlahProduk').innerText = `${formatNumber(jumlahProduk)}` + ` Pcs`;
            document.getElementById('strukTotalHarga').innerText = `Rp ${formatNumber(hargaProduk * jumlahProduk)}`;
                
                // Show the modal
                document.getElementById('strukKasir').classList.remove('hidden');
            } else {
                alert('Transaction details not found!');
            }
        })
        .catch(error => {
            console.error('Error fetching transaction:', error);
        });
}

// Close modal when "Tutup" button is clicked
document.getElementById('closeStruk').addEventListener('click', function() {
    strukKasir.classList.add('hidden');
});

// // Close modal when clicked outside the modal content
// document.getElementById('strukKasir').addEventListener('click', function(event) {
//     if (event.target === this) {
//         this.classList.add('hidden');
//     }
// });

