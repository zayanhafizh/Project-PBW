const allSideMenu = document.querySelectorAll('#sidebar .side-menu.top li .category-menu');
allSideMenu.forEach(item => {
    const li = item.parentElement;

    item.addEventListener('click', function (e) {
        allSideMenu.forEach(i => {
            i.parentElement.classList.remove('active');
            i.parentElement.classList.remove('add-margin');
            i.nextElementSibling.classList.remove('display-nav-menu');
        });

        // Toggle the classes on the clicked item
        li.classList.toggle('active');
        
        // Check if the element already has the 'active' class
        if (li.classList.contains('active')) {
            li.classList.add('add-margin');
            item.nextElementSibling.classList.add('display-nav-menu');
        } else {
            li.classList.remove('add-margin');
            item.nextElementSibling.classList.remove('display-nav-menu');
        }
    });
});




// TOGGLE SIDEBAR
const menuBar = document.querySelector('#content nav .bx.bx-menu');
const sidebar = document.getElementById('sidebar');

menuBar.addEventListener('click', function () {
	sidebar.classList.toggle('hide');
})

// JavaScript untuk menambahkan kelas 'active' ke tabel saat halaman dimuat atau AJAX berhasil
document.addEventListener('DOMContentLoaded', function () {   
    table.classList.add('active');
});


const searchButton = document.querySelector('#content nav form .form-input button');
const searchButtonIcon = document.querySelector('#content nav form .form-input button .bx');
const searchForm = document.querySelector('#content nav form');

searchButton.addEventListener('click', function (e) {
	if(window.innerWidth < 576) {
		e.preventDefault();
		searchForm.classList.toggle('show');
		if(searchForm.classList.contains('show')) {
			searchButtonIcon.classList.replace('bx-search', 'bx-x');
		} else {
			searchButtonIcon.classList.replace('bx-x', 'bx-search');
		}
	}
})


if(window.innerWidth < 768) {
	sidebar.classList.add('hide');
} else if(window.innerWidth > 576) {
	searchButtonIcon.classList.replace('bx-x', 'bx-search');
	searchForm.classList.remove('show');
}


window.addEventListener('resize', function () {
	if(this.innerWidth > 576) {
		searchButtonIcon.classList.replace('bx-x', 'bx-search');
		searchForm.classList.remove('show');
	}
})



const switchMode = document.getElementById('switch-mode');

switchMode.addEventListener('change', function () {
	if(this.checked) {
		document.body.classList.add('dark');
	} else {
		document.body.classList.remove('dark');
	}
})

// count animation
document.addEventListener('DOMContentLoaded', function () {
    const counts = document.querySelectorAll('.count');

    counts.forEach(count => {
        const target = parseInt(count.getAttribute('data-target'));
        const duration = 1000; // Durasi total animasi dalam milidetik
        const increment = target / (duration / 10); // Hitung peningkatan per langkah animasi
        let currentCount = 0;
        let startTime;

        const updateCount = (timestamp) => {
            if (!startTime) startTime = timestamp;
            const elapsedTime = timestamp - startTime;
            if (elapsedTime < duration) {
                currentCount += increment;
                count.textContent = Math.ceil(currentCount);
                requestAnimationFrame(updateCount); // Lanjutkan animasi ke langkah berikutnya
            } else {
                count.textContent = target;
            }
        };

        requestAnimationFrame(updateCount);
    });
});

// toggle searchbar
const searchIcon = document.getElementById('search-icon');
const searchBox = document.getElementById('search-box');

// Ketika ikon pencarian diklik
searchIcon.addEventListener('click', function () {
    searchBox.classList.toggle('show'); // Tampilkan atau sembunyikan kotak pencarian saat ikon pencarian diklik
    searchIcon.classList.toggle('hiden'); // Semmbunyikan atau tampilkan ikon pencarian saat kotak pencarian ditampilkan
});

// Ketika klik dilakukan di luar kotak pencarian
document.addEventListener('click', function (event) {
    const isClickInside = searchBox.contains(event.target) || searchIcon.contains(event.target);
    if (!isClickInside) {
        searchBox.classList.remove('show'); // Sembunyikan kotak pencarian jika klik dilakukan di luar kotak pencarian
        searchIcon.classList.add('show'); // Tampilkan ikon pencarian lagi
    }
});

// AJAX untuk pencarian langsung
const inputReport = document.getElementById('input-report');
const table = document.querySelector('table');
const tableBody = table.querySelector('tbody');
var path = window.location.pathname;
path = path.split('/');
path = path[4];
var url = window.location.href;
url = url.split('/');
url = url[7];
url = url.split('.')[0];
inputReport.addEventListener('keyup', function () {
    const keyword = encodeURIComponent(inputReport.value.trim());
    var xhr = new XMLHttpRequest();

    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4) {
            if (xhr.status === 200) {
                tableBody.innerHTML = xhr.responseText;
            } else {
                console.error('Error: ' + xhr.status + ' - ' + xhr.statusText);
            }
        }
    };

    // Eksekusi AJAX
	xhr.open('GET', '../ajax/ajax.php?keyword=' + keyword + '&kategory=' + url + '&jenisBarang=' + path, true);
    xhr.send();
});

const tableData = document.querySelectorAll('tr[data-id]');

tableData.forEach(item => {
    const actionButtons = item.querySelectorAll('.button-edit');
    var id = item.getAttribute('data-id');
    var kategoriBarang = url.split('.')[0]; // Anda perlu mendapatkan kategori barang di luar loop agar nilainya dapat diakses di dalam event listener

    actionButtons.forEach(item => {
        item.addEventListener('click', function() {
            if (item.className === "button-edit") {
                // Mengirimkan ID dan kategori barang ke editController.php
                window.location.href = `http://localhost/fixSiPencari/client/edit/index.php?id=${id}&kat=${kategoriBarang}`;
            } else {
                // Mengirimkan ID dan kategori barang ke deleteController.php
                const cookiesContent = document.querySelector('.cookiesContent');
                cookiesContent.classList.add('display');
                const deleteAccept = cookiesContent.querySelector('.accept')
                deleteAccept.addEventListener('click', () => {
                    window.location.href = `http://localhost/fixSiPencari/controller/deleteController.php?id=${id}&kat=${kategoriBarang}`;
                }); 
            }
            console.log(item.className);
        });
    });
});

// Togle modal
const closeModal = document.querySelector('.close');
const cookiesContent = document.querySelector('.cookiesContent');
closeModal.addEventListener('click', function () {
	cookiesContent.classList.remove('display');
	console.log("halo")
})
