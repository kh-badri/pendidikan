<?php
helper('form');
$institusi_map  = [1 => 'NEGERI', 2 => 'SWASTA'];
$lokasi_map     = [1 => 'DALAM NEGERI', 2 => 'LUAR NEGERI'];
$pendidikan_map = [1 => 'SMA', 2 => 'D3', 3 => 'S1', 4 => 'S2', 5 => 'S3'];
$prodi_map      = [
    1 => 'Agama',
    2 => 'Sosial',
    3 => 'Ekonomi',
    4 => 'Hukum',
    5 => 'Teknik',
    6 => 'Pendidikan',
    7 => 'Kesehatan',
    8 => 'Pertanian',
    9 => 'Seni/Lainnya'
];
?>
<?= $this->extend('layout/layout'); ?>
<?= $this->section('content'); ?>

<div class="min-h-screen bg-[#F8FAFB] py-12 px-6 font-sans text-[#1A1A1A]">
    <div class="container mx-auto max-w-7xl">

        <!-- HEADER SECTION -->
        <div class="flex flex-col md:flex-row justify-between items-end mb-10 gap-6">
            <div>
                <div class="flex items-center gap-3 mb-2">
                    <span class="w-12 h-1 bg-[#26CCC2] rounded-full"></span>
                    <span class="text-[#26CCC2] font-bold tracking-widest text-xs uppercase">Research Dataset</span>
                </div>
                <h1 class="text-4xl md:text-5xl font-extrabold tracking-tight">Dataset <span class="text-gray-400">Tokoh Sukses</span></h1>
                <p class="text-gray-400 mt-2 font-medium">Manajemen data latar belakang pendidikan untuk pemetaan clustering K-Means.</p>
            </div>

            <div class="bg-white p-2 rounded-[2rem] shadow-xl shadow-gray-200/50 flex items-center border border-white">
                <div class="bg-[#FFF57E] p-5 rounded-[1.5rem] mr-4 shadow-sm text-[#1A1A1A]">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                    </svg>
                </div>
                <div class="pr-8">
                    <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Total Baris</p>
                    <p class="text-3xl font-black leading-none text-gray-800"><?= count($dataset) ?></p>
                </div>
            </div>
        </div>

        <?php if (session()->getFlashdata('success')) : ?>
            <div class="auto-dismiss-alert bg-[#6AECE1] text-[#1A1A1A] px-8 py-5 rounded-3xl shadow-lg shadow-[#6AECE1]/20 mb-8 flex items-center gap-4 border border-white/50">
                <div class="bg-white/40 p-2 rounded-full shadow-inner">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                    </svg>
                </div>
                <span class="font-bold text-lg"><?= session()->getFlashdata('success') ?></span>
            </div>
        <?php endif; ?>

        <?php if (session()->getFlashdata('error')) : ?>
            <div class="auto-dismiss-alert bg-red-100 text-red-700 px-8 py-5 rounded-3xl shadow-lg mb-8 flex items-center gap-4 border border-red-200">
                <div class="bg-red-200 p-2 rounded-full shadow-inner">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </div>
                <span class="font-bold text-base"><?= session()->getFlashdata('error') ?></span>
            </div>
        <?php endif; ?>

        <!-- ACTION BUTTON BAR -->
        <div class="bg-white/80 backdrop-blur-md p-4 rounded-[2.5rem] shadow-xl shadow-gray-200/40 border border-white mb-8 flex flex-wrap justify-between items-center gap-4">
            <div class="flex flex-wrap gap-3">
                <button onclick="openModal('modalManual')" class="bg-[#FFF57E] hover:bg-[#F3E66B] text-[#1A1A1A] px-7 py-3.5 rounded-[1.8rem] font-bold transition-all shadow-md flex items-center gap-2.5 active:scale-95 text-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
                    </svg>
                    Tambah Tokoh
                </button>
                <button onclick="openModal('modalUpload')" class="bg-[#FFB76C] hover:bg-[#ff9d36] text-white px-7 py-3.5 rounded-[1.8rem] font-bold transition-all shadow-md flex items-center gap-2.5 active:scale-95 text-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" />
                    </svg>
                    Import CSV
                </button>
                <button type="button" onclick="toggleGuide()" class="bg-white hover:bg-gray-50 border border-gray-200 text-gray-700 px-6 py-3.5 rounded-[1.8rem] font-bold transition-all shadow-sm flex items-center gap-2.5 active:scale-95 text-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-[#26CCC2]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                    </svg>
                    <span id="guideToggleText">Pedoman Konversi Angka</span>
                    <svg id="guideToggleIcon" xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400 transition-transform duration-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>
            </div>

            <a href="<?= base_url('dataset/hapus-semua') ?>" onclick="return confirm('Hapus semua data permanent?')" class="bg-white border-2 border-red-500 text-red-500 hover:bg-red-500 hover:text-white px-7 py-3.5 rounded-[1.8rem] font-bold transition-all shadow-md shadow-red-100 flex items-center gap-2 active:scale-95 text-xs uppercase tracking-widest">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                </svg>
                Reset Dataset
            </a>
        </div>

        <!-- CARD PATOKAN & KETENTUAN KONVERSI TEXT MENJADI ANGKA -->
        <div id="guideSection" class="transition-all duration-300 mb-8">
            <div class="bg-white rounded-[2.5rem] p-6 md:p-8 shadow-2xl shadow-gray-200/60 border border-white relative overflow-hidden">
                <!-- Decorative background blur -->
                <div class="absolute -top-12 -right-12 w-48 h-48 bg-gradient-to-bl from-[#FFF57E]/50 via-[#26CCC2]/20 to-transparent rounded-full blur-2xl pointer-events-none"></div>

                <!-- Header Ketentuan -->
                <div class="flex flex-col md:flex-row md:items-center justify-between pb-6 mb-6 border-b border-gray-100 gap-4 relative z-10">
                    <div class="flex items-start gap-4">
                        <div class="w-13 h-13 p-3.5 rounded-2xl bg-gradient-to-br from-[#26CCC2] to-[#17a59c] text-white flex items-center justify-center shadow-lg shadow-[#26CCC2]/30 flex-shrink-0">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <div>
                            <div class="flex items-center gap-2 mb-1">
                                <span class="px-3 py-0.5 rounded-full bg-[#FFF57E] text-[#1A1A1A] font-black text-[10px] tracking-wider uppercase">Ketentuan K-Means Encoding</span>
                                <span class="text-xs text-gray-400 font-bold">• Data Mining Standard</span>
                            </div>
                            <h2 class="text-2xl md:text-3xl font-black text-gray-900 tracking-tight">Ketentuan & Patokan Konversi Text ke Angka</h2>
                            <p class="text-gray-500 text-xs md:text-sm mt-1 max-w-3xl leading-relaxed">
                                Metode clustering K-Means bekerja dengan menghitung jarak matematis Euclidean, sehingga data kategorik (teks) wajib diubah menjadi angka numerik. Gunakan standarisasi konversi berikut saat menambah data manual maupun upload file CSV:
                            </p>
                        </div>
                    </div>
                </div>

                <!-- 5 CARDS GRID: DAFTAR VARIABEL & NILAI KONVERSI -->
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-5 gap-4 relative z-10">

                    <!-- VARIABEL 1: JENIS INSTITUSI -->
                    <div class="bg-[#F8FAFB] hover:bg-white rounded-2xl p-5 border border-gray-100 hover:border-[#26CCC2]/40 transition-all shadow-sm hover:shadow-md flex flex-col justify-between">
                        <div>
                            <div class="flex items-center justify-between mb-3">
                                <span class="text-[10px] font-black text-[#26CCC2] uppercase tracking-wider bg-[#26CCC2]/10 px-2.5 py-1 rounded-lg">Var 1</span>
                                <span class="text-[10px] font-mono text-gray-400 font-bold">jenis_institusi</span>
                            </div>
                            <h3 class="text-base font-extrabold text-gray-800 mb-3 flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-[#26CCC2]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                </svg>
                                Jenis Institusi
                            </h3>
                            <div class="space-y-2">
                                <div class="flex items-center justify-between p-2 rounded-xl bg-white border border-gray-100">
                                    <span class="text-xs font-bold text-gray-700">NEGERI</span>
                                    <span class="w-6 h-6 rounded-lg bg-[#26CCC2] text-white font-mono font-black text-xs flex items-center justify-center shadow-sm">1</span>
                                </div>
                                <div class="flex items-center justify-between p-2 rounded-xl bg-white border border-gray-100">
                                    <span class="text-xs font-bold text-gray-700">SWASTA</span>
                                    <span class="w-6 h-6 rounded-lg bg-[#FFF57E] text-[#1A1A1A] font-mono font-black text-xs flex items-center justify-center shadow-sm">2</span>
                                </div>
                            </div>
                        </div>
                        <p class="text-[10px] text-gray-400 mt-4 pt-3 border-t border-gray-100 leading-tight">Perguruan tinggi / sekolah negeri vs swasta.</p>
                    </div>

                    <!-- VARIABEL 2: LOKASI INSTITUSI -->
                    <div class="bg-[#F8FAFB] hover:bg-white rounded-2xl p-5 border border-gray-100 hover:border-[#FFB76C]/40 transition-all shadow-sm hover:shadow-md flex flex-col justify-between">
                        <div>
                            <div class="flex items-center justify-between mb-3">
                                <span class="text-[10px] font-black text-[#FFB76C] uppercase tracking-wider bg-[#FFB76C]/10 px-2.5 py-1 rounded-lg">Var 2</span>
                                <span class="text-[10px] font-mono text-gray-400 font-bold">lokasi_institusi</span>
                            </div>
                            <h3 class="text-base font-extrabold text-gray-800 mb-3 flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-[#FFB76C]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                Lokasi Institusi
                            </h3>
                            <div class="space-y-2">
                                <div class="flex items-center justify-between p-2 rounded-xl bg-white border border-gray-100">
                                    <span class="text-xs font-bold text-gray-700">DALAM NEGERI</span>
                                    <span class="w-6 h-6 rounded-lg bg-[#FFB76C] text-white font-mono font-black text-xs flex items-center justify-center shadow-sm">1</span>
                                </div>
                                <div class="flex items-center justify-between p-2 rounded-xl bg-white border border-gray-100">
                                    <span class="text-xs font-bold text-gray-700">LUAR NEGERI</span>
                                    <span class="w-6 h-6 rounded-lg bg-orange-500 text-white font-mono font-black text-xs flex items-center justify-center shadow-sm">2</span>
                                </div>
                            </div>
                        </div>
                        <p class="text-[10px] text-gray-400 mt-4 pt-3 border-t border-gray-100 leading-tight">Kampus/sekolah dalam negeri (Indonesia) vs luar negeri.</p>
                    </div>

                    <!-- VARIABEL 3: PENDIDIKAN TERAKHIR -->
                    <div class="bg-[#F8FAFB] hover:bg-white rounded-2xl p-5 border border-gray-100 hover:border-indigo-400/40 transition-all shadow-sm hover:shadow-md flex flex-col justify-between">
                        <div>
                            <div class="flex items-center justify-between mb-3">
                                <span class="text-[10px] font-black text-indigo-500 uppercase tracking-wider bg-indigo-50 px-2.5 py-1 rounded-lg">Var 3</span>
                                <span class="text-[10px] font-mono text-gray-400 font-bold">pendidikan_terakhir</span>
                            </div>
                            <h3 class="text-base font-extrabold text-gray-800 mb-3 flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-indigo-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path d="M12 14l9-5-9-5-9 5 9 5z" />
                                    <path d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z" />
                                </svg>
                                Pendidikan Terakhir
                            </h3>
                            <div class="space-y-1.5">
                                <div class="flex items-center justify-between p-1.5 px-2 rounded-lg bg-white border border-gray-100">
                                    <span class="text-xs font-bold text-gray-700">SMA / SMK</span>
                                    <span class="w-5 h-5 rounded-md bg-indigo-100 text-indigo-700 font-mono font-black text-xs flex items-center justify-center">1</span>
                                </div>
                                <div class="flex items-center justify-between p-1.5 px-2 rounded-lg bg-white border border-gray-100">
                                    <span class="text-xs font-bold text-gray-700">D3 (Diploma)</span>
                                    <span class="w-5 h-5 rounded-md bg-indigo-100 text-indigo-700 font-mono font-black text-xs flex items-center justify-center">2</span>
                                </div>
                                <div class="flex items-center justify-between p-1.5 px-2 rounded-lg bg-white border border-gray-100">
                                    <span class="text-xs font-bold text-gray-700">S1 (Sarjana)</span>
                                    <span class="w-5 h-5 rounded-md bg-indigo-500 text-white font-mono font-black text-xs flex items-center justify-center">3</span>
                                </div>
                                <div class="flex items-center justify-between p-1.5 px-2 rounded-lg bg-white border border-gray-100">
                                    <span class="text-xs font-bold text-gray-700">S2 (Magister)</span>
                                    <span class="w-5 h-5 rounded-md bg-indigo-600 text-white font-mono font-black text-xs flex items-center justify-center">4</span>
                                </div>
                                <div class="flex items-center justify-between p-1.5 px-2 rounded-lg bg-white border border-gray-100">
                                    <span class="text-xs font-bold text-gray-700">S3 (Doktor)</span>
                                    <span class="w-5 h-5 rounded-md bg-indigo-800 text-white font-mono font-black text-xs flex items-center justify-center">5</span>
                                </div>
                            </div>
                        </div>
                        <p class="text-[10px] text-gray-400 mt-3 pt-2.5 border-t border-gray-100 leading-tight">Tingkat strata jenjang pendidikan akademik.</p>
                    </div>

                    <!-- VARIABEL 4: JURUSAN / PROGRAM STUDI -->
                    <div class="bg-[#F8FAFB] hover:bg-white rounded-2xl p-5 border border-gray-100 hover:border-[#26CCC2]/40 transition-all shadow-sm hover:shadow-md flex flex-col justify-between">
                        <div>
                            <div class="flex items-center justify-between mb-3">
                                <span class="text-[10px] font-black text-[#26CCC2] uppercase tracking-wider bg-[#26CCC2]/10 px-2.5 py-1 rounded-lg">Var 4</span>
                                <span class="text-[10px] font-mono text-gray-400 font-bold">jurusan_prodi</span>
                            </div>
                            <h3 class="text-base font-extrabold text-gray-800 mb-2 flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-[#26CCC2]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                </svg>
                                Jurusan / Prodi
                            </h3>
                            <div class="grid grid-cols-1 gap-1 text-[11px]">
                                <div class="flex items-center justify-between py-1 px-2 rounded bg-white border border-gray-100">
                                    <span class="font-bold text-gray-700">Agama</span>
                                    <span class="w-4 h-4 rounded bg-[#26CCC2]/20 text-[#0fa89f] font-mono font-black text-[10px] flex items-center justify-center">1</span>
                                </div>
                                <div class="flex items-center justify-between py-1 px-2 rounded bg-white border border-gray-100">
                                    <span class="font-bold text-gray-700">Sosial</span>
                                    <span class="w-4 h-4 rounded bg-[#26CCC2]/20 text-[#0fa89f] font-mono font-black text-[10px] flex items-center justify-center">2</span>
                                </div>
                                <div class="flex items-center justify-between py-1 px-2 rounded bg-white border border-gray-100">
                                    <span class="font-bold text-gray-700">Ekonomi</span>
                                    <span class="w-4 h-4 rounded bg-[#26CCC2]/20 text-[#0fa89f] font-mono font-black text-[10px] flex items-center justify-center">3</span>
                                </div>
                                <div class="flex items-center justify-between py-1 px-2 rounded bg-white border border-gray-100">
                                    <span class="font-bold text-gray-700">Hukum</span>
                                    <span class="w-4 h-4 rounded bg-[#26CCC2]/20 text-[#0fa89f] font-mono font-black text-[10px] flex items-center justify-center">4</span>
                                </div>
                                <div class="flex items-center justify-between py-1 px-2 rounded bg-white border border-gray-100">
                                    <span class="font-bold text-gray-700">Teknik</span>
                                    <span class="w-4 h-4 rounded bg-[#26CCC2]/20 text-[#0fa89f] font-mono font-black text-[10px] flex items-center justify-center">5</span>
                                </div>
                                <div class="flex items-center justify-between py-1 px-2 rounded bg-white border border-gray-100">
                                    <span class="font-bold text-gray-700">Pendidikan</span>
                                    <span class="w-4 h-4 rounded bg-[#26CCC2]/20 text-[#0fa89f] font-mono font-black text-[10px] flex items-center justify-center">6</span>
                                </div>
                                <div class="flex items-center justify-between py-1 px-2 rounded bg-white border border-gray-100">
                                    <span class="font-bold text-gray-700">Kesehatan</span>
                                    <span class="w-4 h-4 rounded bg-[#26CCC2]/20 text-[#0fa89f] font-mono font-black text-[10px] flex items-center justify-center">7</span>
                                </div>
                                <div class="flex items-center justify-between py-1 px-2 rounded bg-white border border-gray-100">
                                    <span class="font-bold text-gray-700">Pertanian</span>
                                    <span class="w-4 h-4 rounded bg-[#26CCC2]/20 text-[#0fa89f] font-mono font-black text-[10px] flex items-center justify-center">8</span>
                                </div>
                                <div class="flex items-center justify-between py-1 px-2 rounded bg-white border border-gray-100">
                                    <span class="font-bold text-gray-700">Seni / Lainnya</span>
                                    <span class="w-4 h-4 rounded bg-[#26CCC2]/20 text-[#0fa89f] font-mono font-black text-[10px] flex items-center justify-center">9</span>
                                </div>
                            </div>
                        </div>
                        <p class="text-[10px] text-gray-400 mt-3 pt-2.5 border-t border-gray-100 leading-tight">Pengelompokan 9 rumpun disiplin keilmuan.</p>
                    </div>

                    <!-- VARIABEL 5: LAMA SELESAI PENDIDIKAN -->
                    <div class="bg-[#F8FAFB] hover:bg-white rounded-2xl p-5 border border-gray-100 hover:border-emerald-400/40 transition-all shadow-sm hover:shadow-md flex flex-col justify-between">
                        <div>
                            <div class="flex items-center justify-between mb-3">
                                <span class="text-[10px] font-black text-emerald-600 uppercase tracking-wider bg-emerald-50 px-2.5 py-1 rounded-lg">Var 5</span>
                                <span class="text-[10px] font-mono text-gray-400 font-bold">lama_selesai</span>
                            </div>
                            <h3 class="text-base font-extrabold text-gray-800 mb-3 flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-emerald-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                Lama Selesai
                            </h3>
                            <div class="p-4 rounded-xl bg-white border border-gray-100 text-center space-y-2">
                                <div class="text-xs font-bold text-gray-500 uppercase tracking-wider">Format Nilai</div>
                                <div class="text-2xl font-black text-emerald-600">Angka Riil</div>
                                <div class="inline-block bg-[#FFF57E] px-3 py-1 rounded-lg text-xs font-black text-[#1A1A1A]">
                                    Satuan: Tahun
                                </div>
                            </div>
                            <div class="mt-3 space-y-1.5 text-xs text-gray-600">
                                <div class="flex items-center justify-between p-1.5 px-2 bg-white rounded-lg border border-gray-100">
                                    <span>Contoh D3:</span>
                                    <span class="font-mono font-bold text-emerald-700">2 - 3 Tahun</span>
                                </div>
                                <div class="flex items-center justify-between p-1.5 px-2 bg-white rounded-lg border border-gray-100">
                                    <span>Contoh S1:</span>
                                    <span class="font-mono font-bold text-emerald-700">4 - 5 Tahun</span>
                                </div>
                            </div>
                        </div>
                        <p class="text-[10px] text-gray-400 mt-3 pt-2.5 border-t border-gray-100 leading-tight">Diisi langsung durasi tahun masa studi.</p>
                    </div>

                </div>

                <!-- CSV FORMAT HELPER STRIP -->
                <div class="mt-6 bg-[#F8FAFB] rounded-2xl p-4 md:p-5 border border-gray-100 flex flex-col md:flex-row items-center justify-between gap-4 text-xs font-medium text-gray-600">
                    <div class="flex items-center gap-3">
                        <div class="w-8 h-8 rounded-xl bg-[#FFF57E] text-[#1A1A1A] flex items-center justify-center font-bold flex-shrink-0">
                            CSV
                        </div>
                        <div>
                            <span class="font-black text-gray-800 uppercase tracking-wider block">Urutan Kolom File CSV:</span>
                            <span class="font-mono text-[11px] text-gray-600">No, Nama Tokoh, Jenis Institusi (1-2), Pendidikan Terakhir (1-5), Jurusan/Prodi (1-9), Lama Selesai (Tahun), Lokasi Institusi (1-2)</span>
                        </div>
                    </div>
                    <div class="flex items-center gap-2">
                        <span class="bg-white border border-gray-200 px-3 py-1.5 rounded-xl font-mono text-[11px] font-bold text-[#0fa89f]">
                            Contoh: 1, Nama Tokoh, 1, 3, 5, 4, 1
                        </span>
                    </div>
                </div>

            </div>
        </div>

        <!-- TABEL DATASET TOKOH SUKSES -->
        <div class="bg-white rounded-[3rem] shadow-2xl shadow-gray-200/60 overflow-hidden border border-white relative">
            <div class="overflow-x-auto h-[650px] custom-scrollbar">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-white border-b border-gray-100 sticky top-0 z-10">
                            <th class="p-4 text-gray-400 font-bold uppercase text-[10px] tracking-[0.2em] text-center">ID</th>
                            <th class="p-4 text-gray-800 font-extrabold uppercase text-xs tracking-widest">Profile Tokoh</th>
                            <th class="p-4 text-gray-800 font-bold uppercase text-xs tracking-widest text-center">
                                <div>Institusi</div>
                                <div class="text-[9px] text-gray-400 font-semibold tracking-normal normal-case">(1=Negeri, 2=Swasta)</div>
                            </th>
                            <th class="p-4 text-gray-800 font-bold uppercase text-xs tracking-widest text-center">
                                <div>Lokasi</div>
                                <div class="text-[9px] text-gray-400 font-semibold tracking-normal normal-case">(1=Dalam, 2=Luar)</div>
                            </th>
                            <th class="p-4 text-gray-800 font-bold uppercase text-xs tracking-widest text-center">
                                <div>Pendidikan</div>
                                <div class="text-[9px] text-gray-400 font-semibold tracking-normal normal-case">(1=SMA s/d 5=S3)</div>
                            </th>
                            <th class="p-4 text-gray-800 font-bold uppercase text-xs tracking-widest text-center">
                                <div>Prodi</div>
                                <div class="text-[9px] text-gray-400 font-semibold tracking-normal normal-case">(1 s/d 9)</div>
                            </th>
                            <th class="p-4 text-gray-800 font-bold uppercase text-xs tracking-widest text-center">
                                <div>Masa Studi</div>
                                <div class="text-[9px] text-gray-400 font-semibold tracking-normal normal-case">(Tahun)</div>
                            </th>
                            <th class="p-4 text-gray-800 font-bold uppercase text-xs tracking-widest text-center">Opsi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50 bg-white">
                        <?php if (empty($dataset)) : ?>
                            <tr>
                                <td colspan="8" class="py-40 text-center text-gray-300 font-bold uppercase tracking-widest">Database Kosong</td>
                            </tr>
                        <?php else : ?>
                            <?php foreach ($dataset as $row) : ?>
                                <tr class="hover:bg-gray-50/50 transition-all duration-300 group text-center">
                                    <td class="p-4 text-gray-400 font-bold"><?= $row['id'] ?></td>
                                    <td class="p-4 text-left">
                                        <span class="block font-black text-gray-800 text-base"><?= esc($row['nama_tokoh']) ?></span>
                                    </td>
                                    <!-- INSTITUSI -->
                                    <td class="p-4">
                                        <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl bg-gray-50 border border-gray-100 font-bold text-xs text-gray-700">
                                            <span class="w-5 h-5 rounded-lg <?= $row['jenis_institusi'] == 1 ? 'bg-[#26CCC2] text-white' : 'bg-[#FFF57E] text-gray-900' ?> font-mono font-black text-[11px] flex items-center justify-center">
                                                <?= $row['jenis_institusi'] ?>
                                            </span>
                                            <span><?= $institusi_map[$row['jenis_institusi']] ?? $row['jenis_institusi'] ?></span>
                                        </span>
                                    </td>
                                    <!-- LOKASI -->
                                    <td class="p-4">
                                        <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl bg-gray-50 border border-gray-100 font-bold text-xs text-gray-700">
                                            <span class="w-5 h-5 rounded-lg <?= $row['lokasi_institusi'] == 1 ? 'bg-[#FFB76C] text-white' : 'bg-orange-500 text-white' ?> font-mono font-black text-[11px] flex items-center justify-center">
                                                <?= $row['lokasi_institusi'] ?>
                                            </span>
                                            <span><?= $lokasi_map[$row['lokasi_institusi']] ?? $row['lokasi_institusi'] ?></span>
                                        </span>
                                    </td>
                                    <!-- PENDIDIKAN -->
                                    <td class="p-4">
                                        <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl bg-gray-50 border border-gray-100 font-bold text-xs text-gray-700">
                                            <span class="w-5 h-5 rounded-lg bg-indigo-50 text-indigo-700 font-mono font-black text-[11px] flex items-center justify-center border border-indigo-100">
                                                <?= $row['pendidikan_terakhir'] ?>
                                            </span>
                                            <span><?= $pendidikan_map[$row['pendidikan_terakhir']] ?? $row['pendidikan_terakhir'] ?></span>
                                        </span>
                                    </td>
                                    <!-- PRODI -->
                                    <td class="p-4">
                                        <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl bg-[#26CCC2]/10 border border-[#26CCC2]/20 font-bold text-xs text-[#0fa89f]">
                                            <span class="w-5 h-5 rounded-lg bg-[#26CCC2] text-white font-mono font-black text-[11px] flex items-center justify-center">
                                                <?= $row['jurusan_prodi'] ?>
                                            </span>
                                            <span><?= $prodi_map[$row['jurusan_prodi']] ?? $row['jurusan_prodi'] ?></span>
                                        </span>
                                    </td>
                                    <!-- MASA STUDI -->
                                    <td class="p-4">
                                        <div class="inline-flex items-center gap-1 bg-[#FFF57E] px-3.5 py-1.5 rounded-xl border border-white text-gray-800 font-black shadow-sm text-sm italic">
                                            <?= $row['lama_selesai'] ?> <span class="text-xs not-italic font-bold text-gray-600">Thn</span>
                                        </div>
                                    </td>
                                    <!-- OPSI -->
                                    <td class="p-4">
                                        <div class="flex justify-center gap-2">
                                            <button onclick='openEditModal(<?= json_encode($row) ?>)' class="p-3 bg-white border border-gray-100 text-[#26CCC2] rounded-2xl hover:bg-[#26CCC2] hover:text-white transition-all shadow-sm" title="Edit Data">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                                    <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                                                </svg>
                                            </button>
                                            <a href="<?= base_url('dataset/delete/' . $row['id']) ?>" onclick="return confirm('Hapus tokoh ini?')" class="p-3 bg-red-50 text-red-500 rounded-2xl hover:bg-red-500 hover:text-white transition-all shadow-sm" title="Hapus Data">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                                    <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                                                </svg>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>

<!-- MODAL TAMBAH DATA MANUAL -->
<div id="modalManual" class="fixed inset-0 z-50 hidden bg-[#1A1A1A]/60 backdrop-blur-sm flex items-center justify-center p-6 text-left">
    <div class="bg-white rounded-[3rem] shadow-2xl w-full max-w-lg overflow-hidden animate-zoomIn border border-white max-h-[90vh] overflow-y-auto custom-scrollbar">
        <div class="bg-[#FFF57E] p-8 text-[#1A1A1A] flex justify-between items-center shadow-md sticky top-0 z-10">
            <div>
                <h3 class="text-2xl font-black italic tracking-tight uppercase">Entry Tokoh Baru</h3>
                <p class="text-xs font-bold text-gray-700 mt-0.5">Pilih nilai sesuai pedoman konversi numerik</p>
            </div>
            <button onclick="closeModal('modalManual')" class="bg-[#1A1A1A]/10 p-2 rounded-full hover:bg-[#1A1A1A]/20 transition-all text-2xl leading-none">&times;</button>
        </div>
        <form action="<?= base_url('dataset/save') ?>" method="post" class="p-8 md:p-10 space-y-5">
            <?= csrf_field() ?>
            <div>
                <label class="block text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] mb-2">Nama Lengkap Tokoh</label>
                <input type="text" name="nama_tokoh" placeholder="Contoh: Binsar Panjaitan" class="w-full bg-[#F8FAFB] border-none rounded-2xl p-4 text-base font-bold focus:ring-4 focus:ring-[#FFF57E] outline-none" required>
            </div>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] mb-2">Institusi (1-2)</label>
                    <select name="jenis_institusi" class="w-full bg-[#F8FAFB] border-none rounded-2xl p-4 font-bold text-sm outline-none focus:ring-4 focus:ring-[#FFF57E]">
                        <option value="1">1 - NEGERI</option>
                        <option value="2">2 - SWASTA</option>
                    </select>
                </div>
                <div>
                    <label class="block text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] mb-2">Lokasi (1-2)</label>
                    <select name="lokasi_institusi" class="w-full bg-[#F8FAFB] border-none rounded-2xl p-4 font-bold text-sm outline-none focus:ring-4 focus:ring-[#FFF57E]">
                        <option value="1">1 - DALAM NEGERI</option>
                        <option value="2">2 - LUAR NEGERI</option>
                    </select>
                </div>
            </div>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] mb-2">Pendidikan (1-5)</label>
                    <select name="pendidikan_terakhir" class="w-full bg-[#F8FAFB] border-none rounded-2xl p-4 font-bold text-sm outline-none focus:ring-4 focus:ring-[#FFF57E]">
                        <option value="1">1 - SMA / SMK</option>
                        <option value="2">2 - D3 (Diploma)</option>
                        <option value="3" selected>3 - S1 (Sarjana)</option>
                        <option value="4">4 - S2 (Magister)</option>
                        <option value="5">5 - S3 (Doktor)</option>
                    </select>
                </div>
                <div>
                    <label class="block text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] mb-2">Jurusan/Prodi (1-9)</label>
                    <select name="jurusan_prodi" class="w-full bg-[#F8FAFB] border-none rounded-2xl p-4 font-bold text-sm outline-none focus:ring-4 focus:ring-[#FFF57E]" required>
                        <option value="1">1 - Agama</option>
                        <option value="2">2 - Sosial</option>
                        <option value="3" selected>3 - Ekonomi</option>
                        <option value="4">4 - Hukum</option>
                        <option value="5">5 - Teknik</option>
                        <option value="6">6 - Pendidikan</option>
                        <option value="7">7 - Kesehatan</option>
                        <option value="8">8 - Pertanian</option>
                        <option value="9">9 - Seni/Lainnya</option>
                    </select>
                </div>
            </div>
            <div>
                <label class="block text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] mb-2">Lama Masa Studi (Tahun)</label>
                <input type="number" step="any" name="lama_selesai" placeholder="Misal: 4 atau 3.5" class="w-full bg-[#F8FAFB] border-none rounded-2xl p-4 font-bold text-sm outline-none focus:ring-4 focus:ring-[#FFF57E]" required>
            </div>
            <button type="submit" class="w-full bg-[#FFF57E] text-[#1A1A1A] font-black py-4.5 rounded-[2rem] shadow-xl hover:bg-[#F3E66B] transition-all uppercase tracking-widest mt-4">Simpan Ke Dataset</button>
        </form>
    </div>
</div>

<!-- MODAL EDIT DATA -->
<div id="modalEdit" class="fixed inset-0 z-50 hidden bg-[#1A1A1A]/60 backdrop-blur-sm flex items-center justify-center p-6 text-left">
    <div class="bg-white rounded-[3rem] shadow-2xl w-full max-w-lg overflow-hidden animate-zoomIn border border-white max-h-[90vh] overflow-y-auto custom-scrollbar">
        <div class="bg-[#FFF57E] p-8 text-[#1A1A1A] flex justify-between items-center shadow-md sticky top-0 z-10">
            <h3 class="text-2xl font-black italic tracking-tight uppercase flex items-center gap-3">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                </svg>
                Perbarui Data Tokoh
            </h3>
            <button onclick="closeModal('modalEdit')" class="bg-[#1A1A1A]/10 p-2 rounded-full hover:bg-[#1A1A1A]/20 transition-all text-2xl leading-none">&times;</button>
        </div>
        <form id="formEdit" action="" method="post" class="p-8 md:p-10 space-y-5">
            <?= csrf_field() ?>
            <div>
                <label class="block text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] mb-2">Nama Tokoh</label>
                <input type="text" id="edit_nama" name="nama_tokoh" class="w-full bg-[#F8FAFB] border-none rounded-2xl p-4 text-base font-bold focus:ring-4 focus:ring-[#FFF57E] outline-none" required>
            </div>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-[10px] font-black text-gray-400 uppercase mb-2">Institusi</label>
                    <select name="jenis_institusi" id="edit_institusi" class="w-full bg-[#F8FAFB] rounded-2xl p-4 font-bold text-sm focus:ring-4 focus:ring-[#FFF57E] outline-none">
                        <option value="1">1 - NEGERI</option>
                        <option value="2">2 - SWASTA</option>
                    </select>
                </div>
                <div>
                    <label class="block text-[10px] font-black text-gray-400 uppercase mb-2">Lokasi</label>
                    <select name="lokasi_institusi" id="edit_lokasi" class="w-full bg-[#F8FAFB] rounded-2xl p-4 font-bold text-sm focus:ring-4 focus:ring-[#FFF57E] outline-none">
                        <option value="1">1 - DALAM NEGERI</option>
                        <option value="2">2 - LUAR NEGERI</option>
                    </select>
                </div>
            </div>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-[10px] font-black text-gray-400 uppercase mb-2">Pendidikan</label>
                    <select name="pendidikan_terakhir" id="edit_pendidikan" class="w-full bg-[#F8FAFB] rounded-2xl p-4 font-bold text-sm focus:ring-4 focus:ring-[#FFF57E] outline-none">
                        <option value="1">1 - SMA / SMK</option>
                        <option value="2">2 - D3 (Diploma)</option>
                        <option value="3">3 - S1 (Sarjana)</option>
                        <option value="4">4 - S2 (Magister)</option>
                        <option value="5">5 - S3 (Doktor)</option>
                    </select>
                </div>
                <div>
                    <label class="block text-[10px] font-black text-gray-400 uppercase mb-2">Jurusan</label>
                    <select name="jurusan_prodi" id="edit_prodi" class="w-full bg-[#F8FAFB] rounded-2xl p-4 font-bold text-sm focus:ring-4 focus:ring-[#FFF57E] outline-none" required>
                        <option value="1">1 - Agama</option>
                        <option value="2">2 - Sosial</option>
                        <option value="3">3 - Ekonomi</option>
                        <option value="4">4 - Hukum</option>
                        <option value="5">5 - Teknik</option>
                        <option value="6">6 - Pendidikan</option>
                        <option value="7">7 - Kesehatan</option>
                        <option value="8">8 - Pertanian</option>
                        <option value="9">9 - Seni/Lainnya</option>
                    </select>
                </div>
            </div>
            <div>
                <label class="block text-[10px] font-black text-gray-400 uppercase mb-2">Masa Studi (Tahun)</label>
                <input type="number" step="any" id="edit_lama" name="lama_selesai" class="w-full bg-[#F8FAFB] rounded-2xl p-4 font-bold text-sm focus:ring-4 focus:ring-[#FFF57E] outline-none" required>
            </div>
            <div class="flex gap-4 pt-4">
                <button type="button" onclick="closeModal('modalEdit')" class="w-1/3 py-4.5 font-bold text-gray-400 uppercase tracking-widest text-xs">Batal</button>
                <button type="submit" class="w-2/3 bg-[#FFF57E] text-[#1A1A1A] font-black py-4.5 rounded-[2rem] shadow-xl hover:bg-[#F3E66B] transition-all uppercase tracking-widest">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div>

<!-- MODAL IMPORT CSV -->
<div id="modalUpload" class="fixed inset-0 z-50 hidden bg-[#1A1A1A]/60 backdrop-blur-sm flex items-center justify-center p-6 text-left">
    <div class="bg-white rounded-[3rem] shadow-2xl w-full max-w-lg overflow-hidden animate-zoomIn border border-white max-h-[90vh] overflow-y-auto custom-scrollbar">
        <div class="bg-[#FFB76C] p-8 text-white flex justify-between items-center shadow-md">
            <div>
                <h3 class="text-2xl font-black italic tracking-tight uppercase">Bulk Import CSV</h3>
                <p class="text-xs font-bold text-white/90 mt-0.5">Upload dataset dalam format CSV standar</p>
            </div>
            <button onclick="closeModal('modalUpload')" class="bg-white/20 p-2 rounded-full leading-none text-2xl hover:bg-white/30 transition-all">&times;</button>
        </div>
        <form action="<?= base_url('dataset/upload') ?>" method="post" enctype="multipart/form-data" class="p-8 md:p-10">
            <?= csrf_field() ?>

            <!-- PANDUAN RINGKAS FORMAT CSV -->
            <div class="bg-[#FFF57E]/25 border border-[#FFF57E] rounded-2xl p-4 mb-6 text-xs text-gray-700 space-y-2">
                <div class="font-black flex items-center gap-2 text-gray-900 uppercase tracking-wider text-[11px]">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-amber-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    Ketentuan Nilai Kolom CSV:
                </div>
                <p class="text-[11px] text-gray-600">Pastikan file CSV memiliki 7 kolom berurutan dan menggunakan angka:</p>
                <div class="grid grid-cols-2 gap-1.5 text-[11px] font-medium pt-1 border-t border-[#FFF57E]/50">
                    <div>• <strong>Inst</strong>: 1 (Negeri), 2 (Swasta)</div>
                    <div>• <strong>Lokasi</strong>: 1 (Dalam), 2 (Luar)</div>
                    <div>• <strong>Pend</strong>: 1 (SMA) s/d 5 (S3)</div>
                    <div>• <strong>Prodi</strong>: 1 (Agama) s/d 9 (Seni)</div>
                    <div class="col-span-2">• <strong>Lama Selesai</strong>: Angka masa studi (contoh: 2, 4)</div>
                </div>
            </div>

            <div class="bg-[#F8FAFB] border-4 border-dashed border-gray-100 rounded-[2rem] p-8 mb-6 text-center">
                <div class="bg-white w-14 h-14 rounded-[1.2rem] shadow-lg flex items-center justify-center mx-auto mb-4 text-[#FFB76C]">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                    </svg>
                </div>
                <label class="block text-xs font-black text-gray-700 uppercase mb-2">Pilih File CSV (.csv)</label>
                <input type="file" name="file_csv" class="text-xs font-bold text-gray-400 w-full" required accept=".csv">
                <p class="text-[10px] text-gray-400 mt-2">Maksimal ukuran file: 2 MB</p>
            </div>
            <button type="submit" class="w-full bg-[#FFB76C] text-white font-black py-4.5 rounded-[2rem] shadow-xl hover:bg-[#ff9d36] transition-all uppercase tracking-widest">Sinkronisasi Data</button>
        </form>
    </div>
</div>

<script>
    function openModal(id) {
        document.getElementById(id).classList.remove('hidden');
    }

    function closeModal(id) {
        document.getElementById(id).classList.add('hidden');
    }

    function toggleGuide() {
        const guide = document.getElementById('guideSection');
        const icon = document.getElementById('guideToggleIcon');
        const text = document.getElementById('guideToggleText');
        if (guide.classList.contains('hidden')) {
            guide.classList.remove('hidden');
            if (text) text.innerText = 'Sembunyikan Pedoman';
            if (icon) icon.classList.add('rotate-180');
        } else {
            guide.classList.add('hidden');
            if (text) text.innerText = 'Pedoman Konversi Angka';
            if (icon) icon.classList.remove('rotate-180');
        }
    }

    function openEditModal(data) {
        document.getElementById('edit_nama').value = data.nama_tokoh;
        document.getElementById('edit_institusi').value = data.jenis_institusi;
        document.getElementById('edit_lokasi').value = data.lokasi_institusi;
        document.getElementById('edit_pendidikan').value = data.pendidikan_terakhir;
        document.getElementById('edit_prodi').value = data.jurusan_prodi;
        document.getElementById('edit_lama').value = data.lama_selesai;
        document.getElementById('formEdit').action = "<?= base_url('dataset/update') ?>/" + data.id;
        openModal('modalEdit');
    }

    document.addEventListener('DOMContentLoaded', () => {
        setTimeout(() => {
            const alerts = document.querySelectorAll('.auto-dismiss-alert');
            alerts.forEach(a => a.remove());
        }, 4000);
    });
</script>

<style>
    @keyframes zoomIn {
        from {
            opacity: 0;
            transform: scale(0.98) translateY(10px);
        }

        to {
            opacity: 1;
            transform: scale(1) translateY(0);
        }
    }

    .animate-zoomIn {
        animation: zoomIn 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
    }

    .custom-scrollbar::-webkit-scrollbar {
        width: 6px;
        height: 6px;
    }

    .custom-scrollbar::-webkit-scrollbar-track {
        background: transparent;
    }

    .custom-scrollbar::-webkit-scrollbar-thumb {
        background: #E2E8F0;
        border-radius: 20px;
    }

    .custom-scrollbar::-webkit-scrollbar-thumb:hover {
        background: #26CCC2;
    }
</style>

<?= $this->endSection(); ?>