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


// Format Rupiah
const rupiah = document.getElementById('rupiah');

rupiah.addEventListener('input', function (e) {
    let value = this.value.replace(/\D/g, '');
    value = value.replace(/\B(?=(\d{3})+(?!\d))/g, '.');
    this.value = value;
});