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