<?php helper('form'); ?>
<?= $this->extend('layout/layout'); ?>
<?= $this->section('content'); ?>

<div class="min-h-screen bg-[#F8FAFB] py-12 px-6 font-sans text-[#1A1A1A]">
    <div class="container mx-auto max-w-5xl text-center">

        <!-- HEADER -->
        <div class="mb-8">
            <div class="flex justify-center items-center gap-3 mb-4">
                <span class="w-16 h-1.5 bg-[#26CCC2] rounded-full"></span>
                <span class="text-[#26CCC2] font-black tracking-[0.3em] text-sm uppercase">Analisis Pola Latar Belakang Tokoh Sukses</span>
                <span class="w-16 h-1.5 bg-[#26CCC2] rounded-full"></span>
            </div>
            <h1 class="text-6xl font-black tracking-tighter uppercase mb-2">Uji <span class="text-gray-400">Prediksi</span></h1>
            <p class="text-gray-500 font-medium text-lg italic">Masukkan data tokoh baru untuk memprediksi kecenderungan klasifikasi klaster dengan metode K-Means.</p>
        </div>



        <!-- Alert Error jika validasi gagal di controller -->
        <?php if (session()->getFlashdata('error')) : ?>
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-2xl mb-6 max-w-4xl mx-auto font-bold text-sm text-left">
                <?= session()->getFlashdata('error') ?>
            </div>
        <?php endif; ?>

        <!-- MAIN FORM CONTAINER -->
        <div class="bg-white rounded-[3rem] shadow-2xl shadow-gray-200/60 p-12 border border-white relative overflow-hidden text-left">
            <div class="absolute top-0 right-0 w-32 h-32 bg-[#FFF57E] rounded-bl-[5rem] -mr-10 -mt-10 opacity-50"></div>

            <form action="<?= base_url('prediksi/proses') ?>" method="post" class="relative z-10">
                <?= csrf_field() ?>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-10">

                    <!-- KOLOM KIRI: Konfigurasi Nilai K & Info Centroid Skripsi -->
                    <div class="md:col-span-1 bg-[#F8FAFB] p-6 rounded-[2.5rem] border border-gray-100 shadow-inner flex flex-col justify-between">
                        <div>
                            <label class="block text-xs font-black uppercase tracking-widest text-gray-400 mb-4 text-center">Jumlah Cluster (K)</label>
                            <div class="flex items-center justify-center gap-4">
                                <input type="number" name="k_value" min="2" max="5" value="3"
                                    class="w-28 bg-white border-4 border-[#26CCC2] rounded-3xl p-4 text-center text-4xl font-black text-[#1A1A1A] focus:ring-8 focus:ring-[#6AECE1]/20 outline-none transition-all shadow-lg" required>
                            </div>
                            <p class="mt-4 text-[11px] font-bold text-gray-400 italic text-center">Rekomendasi Skripsi: <strong>K = 3</strong></p>
                        </div>

                        <!-- Referensi Centroid Acuan Skripsi -->
                        <div class="mt-6 bg-white p-4 rounded-2xl border border-gray-100 shadow-sm text-left">
                            <div class="flex items-center gap-2 mb-2">
                                <span class="w-2 h-2 rounded-full bg-[#26CCC2]"></span>
                                <span class="text-[10px] font-black uppercase tracking-wider text-gray-600">Centroid Acuan (K=3)</span>
                            </div>
                            <div class="space-y-1.5 font-mono text-[10px] text-gray-600">
                                <div class="p-1.5 bg-[#F8FAFB] rounded-lg flex justify-between items-center">
                                    <span class="font-bold text-[#26CCC2]">C1</span>
                                    <span>[1, 2, 2, 2, 1]</span>
                                </div>
                                <div class="p-1.5 bg-[#F8FAFB] rounded-lg flex justify-between items-center">
                                    <span class="font-bold text-[#FFB76C]">C2</span>
                                    <span>[1.5, 3.5, 5, 3.5, 1.5]</span>
                                </div>
                                <div class="p-1.5 bg-[#F8FAFB] rounded-lg flex justify-between items-center">
                                    <span class="font-bold text-gray-800">C3</span>
                                    <span>[2, 5, 8, 5, 2]</span>
                                </div>
                            </div>
                            <p class="text-[9px] text-gray-400 mt-2 italic text-center">Sesuai Bab IV Tabel Centroid Awal Skripsi</p>
                        </div>
                    </div>

                    <!-- KOLOM KANAN: Input Variabel Data Uji Baru Sesuai A, B, C, D, E -->
                    <div class="md:col-span-2 space-y-4">
                        <div class="border-b-2 border-dashed border-gray-100 pb-2 mb-4">
                            <h3 class="text-xl font-black uppercase text-[#1A1A1A]">Data Tokoh Baru</h3>
                            <p class="text-xs text-gray-400 font-bold uppercase tracking-wider">Variabel disesuaikan dengan parameter perhitungan manual skripsi (A s/d E).</p>
                        </div>

                        <!-- Input Nama Tokoh -->
                        <div>
                            <label class="block text-xs font-black uppercase tracking-wider text-gray-400 mb-1">Nama Tokoh / Sampel Uji</label>
                            <input type="text" name="nama_tokoh" placeholder="Contoh: Tokoh Uji Baru"
                                class="w-full bg-[#F8FAFB] border-2 border-gray-200 rounded-2xl p-3.5 px-5 font-bold text-sm focus:border-[#26CCC2] focus:bg-white outline-none transition-all shadow-sm" required>
                        </div>

                        <!-- Grid Parameter Numerik Sesuai A, B, C, D, E -->
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <!-- Variabel A -->
                            <div>
                                <label class="flex items-center gap-1.5 text-xs font-black uppercase tracking-wider text-gray-500 mb-1">
                                    <span class="w-5 h-5 rounded-full bg-[#26CCC2] text-white flex items-center justify-center text-[10px]">A</span>
                                    Jenis Institusi
                                </label>
                                <select name="jenis_institusi" class="w-full bg-[#F8FAFB] border-2 border-gray-200 rounded-2xl p-3.5 px-5 font-bold text-sm focus:border-[#26CCC2] focus:bg-white outline-none transition-all shadow-sm" required>
                                    <option value="1">1 - NEGERI</option>
                                    <option value="2">2 - SWASTA</option>
                                </select>
                            </div>

                            <!-- Variabel B -->
                            <div>
                                <label class="flex items-center gap-1.5 text-xs font-black uppercase tracking-wider text-gray-500 mb-1">
                                    <span class="w-5 h-5 rounded-full bg-[#26CCC2] text-white flex items-center justify-center text-[10px]">B</span>
                                    Pendidikan Terakhir
                                </label>
                                <select name="pendidikan_terakhir" class="w-full bg-[#F8FAFB] border-2 border-gray-200 rounded-2xl p-3.5 px-5 font-bold text-sm focus:border-[#26CCC2] focus:bg-white outline-none transition-all shadow-sm" required>
                                    <option value="1">1 - SMA / Sederajat</option>
                                    <option value="2">2 - D3</option>
                                    <option value="3">3 - S1</option>
                                    <option value="4">4 - S2</option>
                                    <option value="5" selected>5 - S3</option>
                                </select>
                            </div>

                            <!-- Variabel C -->
                            <div>
                                <label class="flex items-center gap-1.5 text-xs font-black uppercase tracking-wider text-gray-500 mb-1">
                                    <span class="w-5 h-5 rounded-full bg-[#26CCC2] text-white flex items-center justify-center text-[10px]">C</span>
                                    Program Studi / Jurusan
                                </label>
                                <select name="jurusan_prodi" class="w-full bg-[#F8FAFB] border-2 border-gray-200 rounded-2xl p-3.5 px-5 font-bold text-sm focus:border-[#26CCC2] focus:bg-white outline-none transition-all shadow-sm" required>
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

                            <!-- Variabel D -->
                            <div>
                                <label class="flex items-center gap-1.5 text-xs font-black uppercase tracking-wider text-gray-500 mb-1">
                                    <span class="w-5 h-5 rounded-full bg-[#26CCC2] text-white flex items-center justify-center text-[10px]">D</span>
                                    Lama Pendidikan (Tahun)
                                </label>
                                <input type="number" step="any" name="lama_selesai" value="4" placeholder="Misal: 2, 3, 3.5, 4"
                                    class="w-full bg-[#F8FAFB] border-2 border-gray-200 rounded-2xl p-3.5 px-5 font-bold text-sm focus:border-[#26CCC2] focus:bg-white outline-none transition-all shadow-sm" required>
                            </div>
                        </div>

                        <!-- Variabel E -->
                        <div>
                            <label class="flex items-center gap-1.5 text-xs font-black uppercase tracking-wider text-gray-500 mb-1">
                                <span class="w-5 h-5 rounded-full bg-[#26CCC2] text-white flex items-center justify-center text-[10px]">E</span>
                                Lokasi Institusi
                            </label>
                            <select name="lokasi_institusi" class="w-full bg-[#F8FAFB] border-2 border-gray-200 rounded-2xl p-3.5 px-5 font-bold text-sm focus:border-[#26CCC2] focus:bg-white outline-none transition-all shadow-sm" required>
                                <option value="1">1 - DALAM NEGERI</option>
                                <option value="2">2 - LUAR NEGERI</option>
                            </select>
                        </div>
                    </div>

                </div>

                <!-- Button Submit -->
                <div class="max-w-md mx-auto">
                    <button type="submit" class="w-full bg-[#FFF57E] hover:bg-[#F3E66B] text-[#1A1A1A] font-black py-5 rounded-[2rem] shadow-xl shadow-[#FFF57E]/40 transition-all transform hover:-translate-y-1 active:scale-95 text-xl uppercase tracking-[0.2em] flex items-center justify-center gap-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z" />
                        </svg>
                        Proses & Hitung Jarak
                    </button>
                </div>
            </form>
        </div>

        <!-- Alur Kerja / Step Sesuai Skripsi -->
        <div class="mt-12 grid grid-cols-1 md:grid-cols-4 gap-6">
            <div class="bg-white p-6 rounded-3xl border border-gray-100 shadow-sm">
                <div class="text-[#26CCC2] font-black text-xl mb-1">Step 1</div>
                <p class="text-xs font-bold text-gray-500 uppercase tracking-tighter">Normalisasi / Encoding Data (A - E)</p>
            </div>
            <div class="bg-white p-6 rounded-3xl border border-gray-100 shadow-sm">
                <div class="text-[#FFB76C] font-black text-xl mb-1">Step 2</div>
                <p class="text-xs font-bold text-gray-500 uppercase tracking-tighter">Inisialisasi Centroid C1, C2, C3</p>
            </div>
            <div class="bg-white p-6 rounded-3xl border border-gray-100 shadow-sm">
                <div class="text-[#26CCC2] font-black text-xl mb-1">Step 3</div>
                <p class="text-xs font-bold text-gray-500 uppercase tracking-tighter">Hitung Euclidean Distance</p>
            </div>
            <div class="bg-white p-6 rounded-3xl border border-gray-100 shadow-sm">
                <div class="text-[#FFB76C] font-black text-xl mb-1">Step 4</div>
                <p class="text-xs font-bold text-gray-500 uppercase tracking-tighter">Penetapan Klaster Minimum</p>
            </div>
        </div>
    </div>
</div>

<style>
    @keyframes zoomIn {
        from {
            opacity: 0;
            transform: scale(0.95);
        }

        to {
            opacity: 1;
            transform: scale(1);
        }
    }

    .container {
        animation: zoomIn 0.5s ease-out;
    }
</style>

<?= $this->endSection(); ?>