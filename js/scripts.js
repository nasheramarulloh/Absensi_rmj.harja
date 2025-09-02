/*!
    * Start Bootstrap - SB Admin v7.0.7 (https://startbootstrap.com/template/sb-admin)
    * Copyright 2013-2023 Start Bootstrap
    * Licensed under MIT (https://github.com/StartBootstrap/startbootstrap-sb-admin/blob/master/LICENSE)
    */
    // 
// Scripts
// 

window.addEventListener('DOMContentLoaded', event => {

    // Toggle the side navigation
    const sidebarToggle = document.body.querySelector('#sidebarToggle');
    if (sidebarToggle) {
        // Uncomment Below to persist sidebar toggle between refreshes
        // if (localStorage.getItem('sb|sidebar-toggle') === 'true') {
        //     document.body.classList.toggle('sb-sidenav-toggled');
        // }
        sidebarToggle.addEventListener('click', event => {
            event.preventDefault();
            document.body.classList.toggle('sb-sidenav-toggled');
            localStorage.setItem('sb|sidebar-toggle', document.body.classList.contains('sb-sidenav-toggled'));
        });
    }

});

    let rating = 0;

    // Tampilkan bintang aktif
    document.querySelectorAll('.star-rating i').forEach(star => {
        star.addEventListener('click', function () {
        rating = this.getAttribute('data-value');
        updateStars(rating);
        });
    });

    function updateStars(r) {
        document.querySelectorAll('.star-rating i').forEach(star => {
        const val = star.getAttribute('data-value');
        star.classList.remove('active');
        if (val <= r) star.classList.add('active');
        });
    }

    function kirimUlasan() {
    const nama = document.getElementById('nama').value.trim();
    const ulasan = document.getElementById('ulasan').value.trim();

    if (!nama || !ulasan || rating === 0) {
        alert('Harap lengkapi semua kolom dan beri rating.');
        return;
    }

    const review = {
        nama: nama,
        ulasan: ulasan,
        rating: rating,
        timestamp: new Date().toISOString()  // ✅ disimpan dengan nama "timestamp"
    };

    const ulasanSebelumnya = JSON.parse(localStorage.getItem('ulasan')) || [];
    ulasanSebelumnya.unshift(review);
    localStorage.setItem('ulasan', JSON.stringify(ulasanSebelumnya));

    document.getElementById('nama').value = '';
    document.getElementById('ulasan').value = '';
    rating = 0;
    updateStars(0);

    tampilkanUlasan();
    }


    function tampilkanUlasan() {
    const daftarUlasan = document.getElementById('daftarUlasan');
    daftarUlasan.innerHTML = '';

    const semuaUlasan = JSON.parse(localStorage.getItem('ulasan')) || [];

    semuaUlasan.forEach(item => {
        const waktuSekarang = new Date();
        const waktuUlasan = new Date(item.timestamp);
        const selisihMenit = Math.floor((waktuSekarang - waktuUlasan) / 60000);

        let tampilWaktu = '';
        if (selisihMenit < 1) {
        tampilWaktu = 'Baru saja';
        } else if (selisihMenit === 1) {
        tampilWaktu = '1 menit lalu';
        } else {
        tampilWaktu = `${selisihMenit} menit lalu`;
        }

        const elemen = document.createElement('div');
        elemen.classList.add('review');
        elemen.innerHTML = `
        <div style="display:flex; justify-content:space-between;">
            <b>${item.nama}</b>
            <small class="text-muted">${tampilWaktu}</small>
        </div>
        <span>${'★'.repeat(item.rating)}${'☆'.repeat(5 - item.rating)}</span><br>
        ${item.ulasan}
        `;
        daftarUlasan.appendChild(elemen);
    });
    }

    function hapusUlasan(index) {
  const semuaUlasan = JSON.parse(localStorage.getItem('ulasan')) || [];
  semuaUlasan.splice(index, 1); // Hapus 1 elemen pada index
  localStorage.setItem('ulasan', JSON.stringify(semuaUlasan));
  tampilkanUlasan(document.getElementById('searchUlasan').value);
}

    document.addEventListener('DOMContentLoaded', function () {
    tampilkanUlasan();
    });

    function tampilkanUlasan(filter = '') {
  const daftarUlasan = document.getElementById('daftarUlasan');
  daftarUlasan.innerHTML = '';

  const semuaUlasan = JSON.parse(localStorage.getItem('ulasan')) || [];

  // Filter ulasan berdasarkan nama jika ada filter
  const filtered = semuaUlasan.filter(item =>
    item.nama.toLowerCase().includes(filter.toLowerCase())
  );

  // Tampilkan jumlah total ulasan
  document.getElementById('jumlahUlasan').innerText = filtered.length;

  filtered.forEach((item, index) => {
    const waktuSekarang = new Date();
    const waktuUlasan = new Date(item.timestamp);
    const selisihMenit = Math.floor((waktuSekarang - waktuUlasan) / 60000);

    let tampilWaktu = '';
    if (selisihMenit < 1) {
      tampilWaktu = 'Baru saja';
    } else if (selisihMenit === 1) {
      tampilWaktu = '1 menit lalu';
    } else {
      tampilWaktu = `${selisihMenit} menit lalu`;
    }

    const elemen = document.createElement('div');
    elemen.classList.add('review');
    elemen.innerHTML = `
      <div style="display:flex; justify-content:space-between; align-items:center;">
        <div>
          <b>${item.nama}</b>
          <small class="text-muted ms-2">${tampilWaktu}</small>
        </div>
        <button class="btn btn-sm btn-danger" onclick="hapusUlasan(${index})">
          <i class="bi bi-trash"></i>
        </button>
      </div>
      <span>${'★'.repeat(item.rating)}${'☆'.repeat(5 - item.rating)}</span><br>
      ${item.ulasan}
    `;
    daftarUlasan.appendChild(elemen);
  });
}

// Pencarian dinamis berdasarkan nama
document.getElementById('searchUlasan').addEventListener('input', function () {
  tampilkanUlasan(this.value);
});