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
    const deleteForm = document.getElementById("deleteForm");
    const siswaNama = document.getElementById("siswaNama");
    const siswaNIS = document.getElementById("siswaNIS");

    deleteModal.addEventListener("show.bs.modal", function(event) {
        let button = event.relatedTarget;
        let siswaId = button.getAttribute("data-id");
        let nama = button.getAttribute("data-nama");
        let nis = button.getAttribute("data-nis");

        // Tampilkan nama dan NIS siswa di modal
        siswaNama.textContent = nama;
        siswaNIS.textContent = nis;

        // Update action form
        deleteForm.action = "/siswas/" + siswaId;
    });
});




// Create User
document.addEventListener('DOMContentLoaded', function () {
    let nameSelect = document.getElementById('name');
    let usernameInput = document.getElementById('username');
    let roleInput = document.getElementById('role_id');

    // Ambil data siswa dan guru
    fetch('/get-all-names')
        .then(response => response.json())
        .then(data => {
            data.forEach(item => {
                let option = document.createElement('option');
                option.value = item.nama;
                option.dataset.username = item.username; // Simpan username (NIS/NIP)
                option.dataset.role = item.role; // Simpan role (2 = siswa, 3 = guru)
                option.textContent = item.nama;
                nameSelect.appendChild(option);
            });
        });

    // Ketika nama dipilih, isi username dan role secara otomatis
    nameSelect.addEventListener('change', function () {
        let selectedOption = nameSelect.options[nameSelect.selectedIndex];
        usernameInput.value = selectedOption.dataset.username || '';
        roleInput.value = selectedOption.dataset.role || '';
    });
});