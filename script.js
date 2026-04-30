function validasiForm() {
    const titleInput = document.querySelector('input[name="title"]');
    const contentInput = document.querySelector('textarea[name="content"]');
    const categoryInput = document.querySelector('select[name="category"]');
    const moodInput = document.querySelector('select[name="mood"]');

    // cek dulu apakah elemen ada
    if (!titleInput || !contentInput || !categoryInput || !moodInput) {
        alert("Form tidak lengkap / elemen tidak ditemukan!");
        return false;
    }

    const title = titleInput.value.trim();
    const content = contentInput.value.trim();
    const category = categoryInput.value;
    const mood = moodInput.value;

    if (title === "") {
        alert("Judul tidak boleh kosong!");
        return false;
    }

    if (title.length < 3) {
        alert("Judul minimal 3 karakter!");
        return false;
    }

    if (content === "") {
        alert("Tulisan tidak boleh kosong!");
        return false;
    }

    if (content.length < 10) {
        alert("Tulisan minimal 10 karakter!");
        return false;
    }

    if (!category) {
        alert("Pilih kategori!");
        return false;
    }

    if (!mood) {
        alert("Pilih mood!");
        return false;
    }

    return true;
}
// ===== DARK MODE =====
const darkBtn = document.getElementById('darkModeToggle');

// Restore theme waktu halaman dibuka
if (localStorage.getItem('theme') === 'dark') {
    document.body.classList.add('dark-theme');
    if (darkBtn) darkBtn.textContent = '☀️';
}

// Toggle dark mode waktu tombol diklik
if (darkBtn) {
    darkBtn.addEventListener('click', function() {
        document.body.classList.toggle('dark-theme');
        
        if (document.body.classList.contains('dark-theme')) {
            localStorage.setItem('theme', 'dark');
            darkBtn.textContent = '☀️';
        } else {
            localStorage.setItem('theme', 'light');
            darkBtn.textContent = '🌙';
        }
    });
}