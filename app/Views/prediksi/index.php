<?php helper('form'); ?>
<?= $this->extend('layout/layout'); ?>
<?= $this->section('content'); ?>

<div class="min-h-screen bg-[#F8FAFB] py-12 px-6 font-sans text-[#1A1A1A]">
    <div class="container mx-auto max-w-4xl text-center">

        <div class="mb-12">
            <div class="flex justify-center items-center gap-3 mb-4">
                <span class="w-16 h-1.5 bg-[#26CCC2] rounded-full"></span>
                <span class="text-[#26CCC2] font-black tracking-[0.3em] text-sm uppercase">K-Means Configuration</span>
                <span class="w-16 h-1.5 bg-[#26CCC2] rounded-full"></span>
            </div>
            <h1 class="text-6xl font-black tracking-tighter uppercase mb-2">Mulai <span class="text-gray-400">Clustering</span></h1>
            <p class="text-gray-500 font-medium text-lg italic">Tentukan jumlah kelompok untuk memetakan pola pendidikan tokoh sukses.</p>
        </div>

        <div class="bg-white rounded-[3rem] shadow-2xl shadow-gray-200/60 p-12 border border-white relative overflow-hidden">
            <div class="absolute top-0 right-0 w-32 h-32 bg-[#FFF57E] rounded-bl-[5rem] -mr-10 -mt-10 opacity-50"></div>

            <form action="<?= base_url('prediksi/proses') ?>" method="post" class="relative z-10">
                <?= csrf_field() ?>

                <div class="max-w-md mx-auto">
                    <div class="bg-[#F8FAFB] p-10 rounded-[2.5rem] mb-10 border border-gray-100 shadow-inner">
                        <label class="block text-xs font-black uppercase tracking-widest text-gray-400 mb-6">Jumlah Cluster (K)</label>

                        <div class="flex items-center justify-center gap-6">
                            <input type="number" name="k_value" min="2" max="5" value="3"
                                class="w-32 bg-white border-4 border-[#26CCC2] rounded-3xl p-6 text-center text-5xl font-black text-[#1A1A1A] focus:ring-8 focus:ring-[#6AECE1]/20 outline-none transition-all shadow-lg" required>
                        </div>

                        <p class="mt-6 text-sm font-bold text-gray-400 italic">Disarankan menggunakan K=2 atau K=3 untuk 50 dataset.</p>
                    </div>

                    <button type="submit" class="w-full bg-[#FFF57E] hover:bg-[#F3E66B] text-[#1A1A1A] font-black py-6 rounded-[2rem] shadow-xl shadow-[#FFF57E]/40 transition-all transform hover:-translate-y-1 active:scale-95 text-2xl uppercase tracking-[0.2em] flex items-center justify-center gap-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z" />
                        </svg>
                        Eksekusi Algoritma
                    </button>
                </div>
            </form>
        </div>

        <div class="mt-12 grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="bg-white p-6 rounded-3xl border border-gray-100 shadow-sm">
                <div class="text-[#26CCC2] font-black text-xl mb-1">Step 1</div>
                <p class="text-xs font-bold text-gray-500 uppercase tracking-tighter">Inisialisasi Centroid Acak</p>
            </div>
            <div class="bg-white p-6 rounded-3xl border border-gray-100 shadow-sm">
                <div class="text-[#FFB76C] font-black text-xl mb-1">Step 2</div>
                <p class="text-xs font-bold text-gray-500 uppercase tracking-tighter">Hitung Jarak Euclidean</p>
            </div>
            <div class="bg-white p-6 rounded-3xl border border-gray-100 shadow-sm">
                <div class="text-[#26CCC2] font-black text-xl mb-1">Step 3</div>
                <p class="text-xs font-bold text-gray-500 uppercase tracking-tighter">Iterasi Hingga Konvergen</p>
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