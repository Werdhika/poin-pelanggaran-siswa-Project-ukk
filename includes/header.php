<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <base href="http://localhost/poin_pelanggaran_siswa/">
    <title>Document</title>
    <link rel="stylesheet" href="./src/output.css">
</head>

<body>
    <header class="bg-white shadow-md">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="flex h-20 items-center justify-between">
                <div class="flex-1 md:flex md:items-center md:gap-12">
                    <a href="#" class="block text-2xl text-gray-900 font-urbanist font-bold">
                        e-Pelanggaran
                    </a>
                </div>

                <div class="md:flex md:items-center md:gap-7">
                    <nav aria-label="Global" class="hidden md:block">
                        <ul class="flex items-center gap-4 text-sm">
                            <li>
                                <a class="text-gray-500 text-sm font-poppins transition hover:text-black" href="pages/dashboard.php">Dashboard</a>
                            </li>
                            <li>
                                <a class="text-gray-500 text-sm font-poppins transition hover:text-black" href="pages/siswa/list.php">Data Siswa</a>
                            </li>
                            <li>
                                <a class="text-gray-500 text-sm font-poppins transition hover:text-black" href="#">Pelanggaran</a>
                            </li>
                            <li>
                                <a class="text-gray-500 text-sm font-poppins transition hover:text-black" href="#">Surat & Laporan</a>
                            </li>
                        </ul>
                    </nav>

                    <div class="hidden md:relative md:block">
                        <button id="menuButton" type="button" class="overflow-hidden rounded-full border border-gray-300 shadow-inner">
                            <span class="sr-only">Toggle dashboard menu</span>

                            <img src="https://images.unsplash.com/photo-1438761681033-6461ffad8d80?auto=format&amp;fit=crop&amp;q=80&amp;w=1160" alt="" class="size-12 object-cover">
                        </button>

                        <div id="userMenu"
                            class="hidden absolute end-0 z-10 mt-0.5 w-56 divide-y divide-gray-100 rounded-md border border-gray-100 bg-white shadow-lg  transition-all duration-200 ease-out origin-top-right scale-95 opacity-0" role="menu">
                            <div class="p-2">
                                <a href="#" class="block rounded-lg px-4 py-2 text-sm text-gray-500 hover:bg-gray-50 hover:text-gray-700" role="menuitem">
                                    Pengaturan Akun
                                </a>
                            </div>

                            <div class="p-2">
                                <form method="POST" action="#">
                                    <button type="submit" class="flex w-full items-center gap-2 rounded-lg px-4 py-2 text-sm text-red-700 hover:bg-red-50" role="menuitem">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 15 3 9m0 0 6-6M3 9h12a6 6 0 0 1 0 12h-3"></path>
                                        </svg>

                                        Logout
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="block md:hidden">
                        <button class="rounded-sm bg-gray-100 p-2 text-gray-600 transition hover:text-gray-600/75">
                            <svg xmlns="http://www.w3.org/2000/svg" class="size-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16"></path>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <main class="mx-auto max-w-7xl lg:px-7 pt-16">