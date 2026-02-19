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
