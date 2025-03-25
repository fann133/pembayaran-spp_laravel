// JS loading
document.addEventListener("DOMContentLoaded", function() {
    setTimeout(function() {
        document.querySelector('.preloader').classList.add('hidden');
    }, 500); // 0.5 detik
});


// Notif Flashdata 
setTimeout(function() {
    let alert = document.querySelector('.alert');
    if (alert) {
        alert.style.transition = "opacity 0.5s";
        alert.style.opacity = "0";
        setTimeout(() => alert.remove(), 500); // Hapus setelah animasi selesai
    }
}, 5000); // 1 detik



// Filter Data Kategori Biaya
document.getElementById('filterKategori').addEventListener('change', function () {
    let selectedKategori = this.value;
    let url = new URL(window.location.href);
    if (selectedKategori) {
        url.searchParams.set('kategori', selectedKategori);
    } else {
        url.searchParams.delete('kategori');
    }
    window.location.href = url.toString();
});



// Modal Hapus Siswa
document.addEventListener("DOMContentLoaded", function() {
    const deleteModal = document.getElementById("deleteModal");
    const secondDeleteModal = document.getElementById("secondDeleteModal");
    const deleteForm = document.getElementById("deleteForm");
    const siswaNama = document.getElementById("siswaNama");
    const siswaNIS = document.getElementById("siswaNIS");
    const finalSiswaNama = document.getElementById("finalSiswaNama");
    const finalSiswaNIS = document.getElementById("finalSiswaNIS");
    const nextConfirmation = document.getElementById("nextConfirmation");

    let siswaId = "";

    deleteModal.addEventListener("show.bs.modal", function(event) {
        let button = event.relatedTarget;
        siswaId = button.getAttribute("data-id");
        let nama = button.getAttribute("data-nama");
        let nis = button.getAttribute("data-nis");

        // Tampilkan nama dan NIS siswa di modal pertama
        siswaNama.textContent = nama;
        siswaNIS.textContent = nis;
    });

    // Ketika tombol "Hapus" di modal pertama ditekan, modal kedua muncul
    nextConfirmation.addEventListener("click", function() {
        // Tutup modal pertama
        let firstModal = bootstrap.Modal.getInstance(deleteModal);
        firstModal.hide();

        // Tampilkan nama dan NIS siswa di modal kedua
        finalSiswaNama.textContent = siswaNama.textContent;
        finalSiswaNIS.textContent = siswaNIS.textContent;

        // Perbarui action form sebelum modal kedua terbuka
        deleteForm.action = "siswa/" + siswaId;

        // Tampilkan modal kedua
        let secondModal = new bootstrap.Modal(secondDeleteModal);
        secondModal.show();
    });
});


// JS Modal Hapus Guru
document.addEventListener("DOMContentLoaded", function() {
    const deleteModalGuru = document.getElementById("deleteModalGuru");
    const secondDeleteModalGuru = document.getElementById("secondDeleteModalGuru");
    const deleteFormGuru = document.getElementById("deleteFormGuru");
    
    const guruNama = document.getElementById("guruNama");
    const guruNIP = document.getElementById("guruNIP");
    const finalGuruNama = document.getElementById("finalGuruNama");
    const finalGuruNIP = document.getElementById("finalGuruNIP");

    const nextConfirmationGuru = document.getElementById("nextConfirmationGuru");

    deleteModalGuru.addEventListener("show.bs.modal", function(event) {
        let button = event.relatedTarget;
        let guruId = button.getAttribute("data-id");
        let nama = button.getAttribute("data-nama");
        let nip = button.getAttribute("data-nip");

        // Set nama & NIP di modal pertama
        guruNama.textContent = nama;
        guruNIP.textContent = nip;

        // Set action form
        deleteFormGuru.action = "guru/" + guruId;

        // Ketika tombol "Hapus" ditekan, tutup modal pertama dan buka modal kedua
        nextConfirmationGuru.onclick = function() {
            let modal1 = bootstrap.Modal.getInstance(deleteModalGuru);
            modal1.hide();

            // Set nama & NIP di modal kedua
            finalGuruNama.textContent = nama;
            finalGuruNIP.textContent = nip;

            let modal2 = new bootstrap.Modal(secondDeleteModalGuru);
            modal2.show();
        };
    });
});



// JS Modal Hapus Kelas
document.addEventListener("DOMContentLoaded", function() {
    const deleteModalKelas = document.getElementById("deleteModalKelas");
    const secondDeleteModalKelas = document.getElementById("secondDeleteModalKelas");
    const deleteFormKelas = document.getElementById("deleteFormKelas");

    const kelasNama = document.getElementById("kelasNama");
    const kelasKode = document.getElementById("kelasKode");
    const finalKelasNama = document.getElementById("finalKelasNama");
    const finalKelasKode = document.getElementById("finalKelasKode");

    const nextConfirmationKelas = document.getElementById("nextConfirmationKelas");

    deleteModalKelas.addEventListener("show.bs.modal", function(event) {
        let button = event.relatedTarget;
        let kelasId = button.getAttribute("data-id");
        let nama = button.getAttribute("data-nama");
        let kode = button.getAttribute("data-kode");

        kelasNama.textContent = nama;
        kelasKode.textContent = kode;

        deleteFormKelas.action = "kelas/" + kelasId;

        nextConfirmationKelas.onclick = function() {
            let modal1 = bootstrap.Modal.getInstance(deleteModalKelas);
            modal1.hide();

            finalKelasNama.textContent = nama;
            finalKelasKode.textContent = kode;

            let modal2 = new bootstrap.Modal(secondDeleteModalKelas);
            modal2.show();
        };
    });
});



// JS Modal Hapus Biaya
document.addEventListener("DOMContentLoaded", function() {
    const deleteModalBiaya = document.getElementById("deleteModalBiaya");
    const secondDeleteModalBiaya = document.getElementById("secondDeleteModalBiaya");
    const deleteFormBiaya = document.getElementById("deleteFormBiaya");

    const biayaNama = document.getElementById("biayaNama");
    const biayaKode = document.getElementById("biayaKode");
    const finalBiayaNama = document.getElementById("finalBiayaNama");
    const finalBiayaKode = document.getElementById("finalBiayaKode");

    const nextConfirmationBiaya = document.getElementById("nextConfirmationBiaya");

    deleteModalBiaya.addEventListener("show.bs.modal", function(event) {
        let button = event.relatedTarget;
        let biayaId = button.getAttribute("data-id");
        let nama = button.getAttribute("data-nama");
        let kode = button.getAttribute("data-kode");

        // Set nama & kode di modal pertama
        biayaNama.textContent = nama;
        biayaKode.textContent = kode;

        // Set action form ke route yang sesuai
        deleteFormBiaya.action = "/admin/biaya/" + biayaId;

        // Ketika tombol "Hapus" ditekan, tutup modal pertama dan buka modal kedua
        nextConfirmationBiaya.onclick = function() {
            let modal1 = bootstrap.Modal.getInstance(deleteModalBiaya);
            modal1.hide();

            // Set nama & kode di modal kedua
            finalBiayaNama.textContent = nama;
            finalBiayaKode.textContent = kode;

            let modal2 = new bootstrap.Modal(secondDeleteModalBiaya);
            modal2.show();
        };
    });
});







