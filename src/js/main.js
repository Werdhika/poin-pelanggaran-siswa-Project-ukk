const button = document.getElementById('menuButton');
const menu = document.getElementById('userMenu');

button.addEventListener('click', (e) => {
    e.stopPropagation();

    menu.classList.toggle('hidden');
    menu.classList.toggle('scale-100');
    menu.classList.toggle('opacity-100');
});

document.addEventListener('click', () => {
    menu.classList.add('hidden');
    menu.classList.remove('scale-100');
    menu.classList.remove('opacity-100');
});

document.addEventListener('click', function (e) {
    const btn = e.target.closest('.dropdown-btn');

    // tutup semua dropdown dulu
    document.querySelectorAll('.dropdown-menu').forEach((menu) => {
        menu.classList.add('hidden');
    });

    // jika klik tombol, buka menu miliknya
    if (btn) {
        const td = btn.closest('td');
        const menu = td.querySelector('.dropdown-menu');
        menu.classList.toggle('hidden');
        e.stopPropagation();
    }
});

//% Button Jenis Kelamin & Status

function handleActive(buttonClass, inputId) {
    const buttons = document.querySelectorAll(`.${buttonClass}`);

    buttons.forEach((button) => {
        button.addEventListener('click', function () {
            //! Hapus Active dari semua Tombol
            buttons.forEach((btn) => {
                btn.classList.remove('bg-current','text-white');
            });

            //? Tambah active ke tombol yang di klik
            this.classList.add('bg-current');

            //TODO Set Value ke hidden input
            document.getElementById(inputId).value = this.dataset.value;
        });
    });
}

handleActive('gender-btn', 'jenis_kelamin');
handleActive('status-btn', 'status');
