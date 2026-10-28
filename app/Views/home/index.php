<?= $this->extend('layout/layout'); ?>
<?= $this->section('content'); ?>

<?php
$tokoh = [
    ['nama' => 'Asren Nasution', 'foto' => 'asren.png'],
    ['nama' => 'Bobby Nasution', 'foto' => 'bobby.jpg'],
    ['nama' => 'Chairul Tanjung', 'foto' => 'chairul tanjung.png'],
    ['nama' => 'H. Surya B.Sc', 'foto' => 'h.surya.jpg'],
    ['nama' => 'Musa Rajekshah', 'foto' => 'musa.jpg'],
    ['nama' => 'Rianto S.H. M.A.P', 'foto' => 'rianto.png'],
    ['nama' => 'Sabam Sirait', 'foto' => 'sabam.jpg'],
    ['nama' => 'Syamsul Qodri Marpaung', 'foto' => 'syamsul qodri.jpg'],
    ['nama' => 'Alm. Taufan Gama Simatupang', 'foto' => 'taufangama.jpg'],
    ['nama' => 'Taufik Zainal Abidin', 'foto' => 'taufik.jpg'],
    ['nama' => 'Prof. Dr. Tri Harsono', 'foto' => 'tri.jpg'],
    ['nama' => 'Ustaz Abdul Somad', 'foto' => 'uas.jpg'],
];
?>

<div class="min-h-screen bg-brand-bg font-sans text-brand-dark overflow-hidden py-12">
    <div class="container mx-auto max-w-7xl px-4">
        <div class="text-center mb-16 animate-fadeIn">
            <h1 class="text-4xl md:text-5xl font-black tracking-tighter leading-[1] uppercase italic mb-4">
                Galeri <span class="text-brand-teal">Tokoh Sukses</span>
            </h1>
            <p class="text-gray-500 font-bold text-lg max-w-xl mx-auto leading-relaxed italic">
                Daftar tokoh-tokoh sukses yang menjadi inspirasi dan referensi dalam analisis sistem ini.
            </p>
            <div class="w-20 h-1 bg-brand-yellow mx-auto rounded-full mt-6"></div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8 animate-fadeIn"
            style="animation-delay: 0.2s; animation-fill-mode: both;">
            <?php foreach ($tokoh as $index => $t): ?>
                <div
                    class="group bg-white rounded-[2rem] shadow-xl hover:shadow-2xl transition-all duration-300 overflow-hidden transform hover:-translate-y-2 border border-white hover:border-brand-teal/30">
                    <div class="relative h-72 overflow-hidden bg-gray-100">
                        <img src="<?= base_url('public/tokohsukses/' . $t['foto']) ?>" alt="<?= $t['nama'] ?>"
                            class="w-full h-full object-cover object-top group-hover:scale-110 transition-transform duration-500">
                        <div
                            class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                        </div>
                    </div>
                    <div class="p-6 text-center bg-white relative z-10 flex flex-col justify-center items-center h-28">
                        <h3
                            class="text-[1.1rem] font-bold capitalize text-brand-dark mb-3 group-hover:text-brand-teal transition-colors leading-tight">
                            <?= $t['nama'] ?></h3>
                        <div
                            class="w-10 h-1 bg-brand-yellow rounded-full opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>

<style>
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .animate-fadeIn {
        animation: fadeInUp 0.8s cubic-bezier(0.2, 0.8, 0.2, 1) forwards;
    }

    /* Background Pattern */
    .bg-brand-bg {
        background-color: #f8fafc;
        background-image: radial-gradient(#e5e7eb 1px, transparent 1px);
        background-size: 40px 40px;
    }
</style>

<?= $this->endSection(); ?>