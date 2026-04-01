<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <base href="http://localhost/poin_pelanggaran_siswa/">
    <title>Document</title>
    <link rel="stylesheet" href="./src/output.css">
</head>

<body class="bg-gray-50">
    <header class="bg-white shadow-md no-print">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="flex h-20 items-center justify-between">
                <div class="flex-1 md:flex md:items-center md:gap-12">
                    <a href="#" class="block text-2xl text-gray-900 font-urbanist font-bold">
                        RuleSphere
                    </a>
                </div>

                <div class="md:flex md:items-center md:gap-7">
                    <nav aria-label="Global" class="hidden md:block">
                        <ul class="flex items-center gap-4 text-sm">
                            <li>
                                <a href="pages/dashboard.php" class="text-gray-500 text-sm font-poppins transition hover:text-black">Dashboard</a>
                            </li>

                            <!-- Dropdown Kelola Data -->
                            <li class="relative">
                                <button class="dropdown-nav-btn flex items-center gap-1 text-gray-500 text-sm font-poppins hover:text-black transition">
                                    Kelola Data
                                    <svg class="w-4 h-4 transition-transform duration-200 dropdown-icon"
                                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                        <path stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                            d="m19 9-7 7-7-7" />
                                    </svg>
                                </button>

                                <div class="dropdown-nav-menu absolute left-0 mt-7 z-10 hidden bg-white border border-gray-200 rounded-md shadow-md w-56">
                                    <ul class="p-2 text-sm font-medium font-poppins text-gray-700">
                                        <li>
                                            <a href="pages/siswa/list.php" class="block p-2 rounded-sm hover:bg-gray-100 transition">Siswa</a>
                                        </li>

                                        <li>
                                            <a href="pages/guru/list.php" class="block p-2 rounded-sm hover:bg-gray-100 transition">Guru</a>
                                        </li>

                                        <li>
                                            <a href="pages/orang_tua/list.php" class="block p-2 rounded-sm hover:bg-gray-100 transition">Orang Tua & Wali</a>
                                        </li>

                                        <li>
                                            <a href="pages/jenis_pelanggaran/list.php" class="block p-2 rounded-sm hover:bg-gray-100 transition">Jenis Pelanggaran</a>
                                        </li>

                                        <li>
                                            <a href="pages/program_keahlian/list.php" class="block p-2 rounded-sm hover:bg-gray-100 transition">Program Keahlian</a>
                                        </li>

                                        <li>
                                            <a href="pages/tingkat/list.php" class="block p-2 rounded-sm hover:bg-gray-100 transition">tingkat</a>
                                        </li>

                                        <li>
                                            <a href="pages/kelas/list.php" class="block p-2 rounded-sm hover:bg-gray-100 transition">Kelas</a>
                                        </li>

                                        <li>
                                            <a href="pages/jenis_pelanggaran/list.php" class="block p-2 rounded-sm hover:bg-gray-100 transition">Jenis Pelanggaran</a>
                                        </li>

                                        <li>
                                            <a href="pages/tahun_ajaran/list.php" class="block p-2 rounded-sm hover:bg-gray-100 transition">Tahun Ajaran</a>
                                        </li>

                                        <li>
                                            <a href="pages/surat_pindah/list.php" class="block p-2 rounded-sm hover:bg-gray-100 transition">Surat Pindah</a>
                                        </li>

                                        <li>
                                            <a href="pages/profil_sekolah/list.php" class="block p-2 rounded-sm hover:bg-gray-100 transition">Profil Sekolah</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>

                            <!-- Dropdown Surat & Laporan -->
                            <li class="relative">
                                <button class="dropdown-nav-btn flex items-center gap-1 text-gray-500 text-sm font-poppins hover:text-black transition">
                                    Surat & Laporan
                                    <svg class="w-4 h-4 transition-transform duration-200 dropdown-icon"
                                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                        <path stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                            d="m19 9-7 7-7-7" />
                                    </svg>
                                </button>

                                <div class="dropdown-nav-menu absolute left-0 mt-7 z-10 hidden bg-white border border-gray-200 rounded-md shadow-md w-56">
                                    <ul class="p-2 text-sm font-medium font-poppins text-gray-700">
                                        <li>
                                            <a href="pages/surat_keluar/list.php" class="block p-2 rounded-sm hover:bg-gray-100 transition">Surat Keluar</a>
                                        </li>

                                        <li>
                                            <a href="pages/siswa/list.php" class="block p-2 rounded-sm hover:bg-gray-100 transition">Surat Perjanjian Siswa</a>
                                        </li>

                                        <li>
                                            <a href="pages/laporan/pelanggaran_siswa/list.php" class="block p-2 rounded-sm hover:bg-gray-100 transition">Surat Pelanggaran Siswa</a>
                                        </li>

                                        <li>
                                            <a href="pages/siswa/list.php" class="block p-2 rounded-sm hover:bg-gray-100 transition">Surat Perjanjian Orang Tua</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                        </ul>
                    </nav>

                    <!-- Profile -->
                    <div class="hidden md:relative md:block">
                        <button id="menuButton" type="button"
                            class="dropdown-nav-btn overflow-hidden rounded-full border border-gray-300 shadow-inner">
                            <span class="sr-only">Toggle dashboard menu</span>
                            <img src="https://images.unsplash.com/photo-1438761681033-6461ffad8d80?auto=format&amp;fit=crop&amp;q=80&amp;w=1160" alt="" class="size-12 object-cover">
                        </button>

                        <!-- Dropdown -->
                        <div id="userMenu"
                            class="dropdown-nav-menu hidden absolute end-0 z-10 mt-2.5 w-56 divide-y divide-gray-100 rounded-md border border-gray-100 bg-white shadow-lg transition-all duration-200 origin-top-right scale-95 opacity-0" role="menu">
                            <div class="p-2">
                                <a href="#" class="block rounded-sm px-4 py-2 text-sm font-poppins font-medium text-gray-500 hover:bg-gray-50 hover:text-gray-700" role="menuitem">
                                    Pengaturan Akun
                                </a>
                            </div>

                            <div class="p-2">
                                <form method="POST" action="#">
                                    <button type="submit"
                                        class="flex w-full items-center gap-2 rounded-md px-4 py-2 text-sm font-medium font-poppins text-red-700 hover:bg-red-50" role="menuitem">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 15 3 9m0 0 6-6M3 9h12a6 6 0 0 1 0 12h-3"></path>
                                        </svg>
                                        Logout
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <main class="mx-auto max-w-7xl lg:px-7 pt-16 print:pt-0!">