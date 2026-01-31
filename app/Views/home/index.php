<?= $this->extend('layout/layout'); ?>
<?= $this->section('content'); ?>

<div class="min-h-screen bg-brand-bg font-sans text-brand-dark overflow-hidden">
    <div class="container mx-auto max-w-7xl px-4 py-12">
        <div class="flex flex-col lg:flex-row items-center gap-16 animate-fadeIn">
            <div class="flex-1 text-center lg:text-left">
                <div class="inline-flex items-center gap-3 mb-6 bg-white px-6 py-2 rounded-full shadow-sm border border-white">
                    <span class="relative flex h-3 w-3">
                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-brand-teal opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-3 w-3 bg-brand-teal"></span>
                    </span>
                    <span class="text-[10px] font-black uppercase tracking-[0.3em] text-brand-teal">System Operational</span>
                </div>
                <h1 class="text-6xl md:text-7xl font-black tracking-tighter leading-[0.9] uppercase italic mb-8">
                    Smart Cluster <br>
                    <span class="text-brand-teal">Analysis</span> Center
                </h1>
                <p class="text-gray-400 font-bold text-lg max-w-xl mx-auto lg:mx-0 leading-relaxed mb-10 italic">
                    Platform riset cerdas berbasis algoritma K-Means untuk memetakan pola latar belakang pendidikan tokoh sukses secara akurat.
                </p>
                <div class="flex flex-wrap justify-center lg:justify-start gap-4">
                    <a href="<?= base_url('prediksi') ?>" class="bg-brand-teal text-white px-10 py-5 rounded-[2rem] font-black uppercase tracking-widest text-xs shadow-2xl shadow-brand-teal/30 hover:bg-brand-dark transition-all transform hover:-translate-y-1 active:scale-95">
                        Mulai Analisis
                    </a>
                    <a href="<?= base_url('dataset') ?>" class="bg-white text-brand-dark border-2 border-white px-10 py-5 rounded-[2rem] font-black uppercase tracking-widest text-xs shadow-xl hover:bg-brand-yellow transition-all transform hover:-translate-y-1 active:scale-95">
                        Lihat Dataset
                    </a>
                </div>
            </div>

            <div class="flex-1 w-full max-w-2xl relative">
                <div class="absolute -inset-4 bg-gradient-to-tr from-brand-teal/20 to-brand-yellow/20 blur-3xl rounded-[4rem]"></div>
                <div class="relative grid grid-cols-2 gap-6">
                    <div class="bg-white p-8 rounded-[3rem] shadow-2xl border border-white transform hover:scale-105 transition-all duration-500">
                        <div class="w-12 h-12 bg-brand-yellow rounded-2xl mb-6 flex items-center justify-center shadow-lg shadow-brand-yellow/30">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3">
                                <path d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                        </div>
                        <p class="text-[10px] font-black text-gray-300 uppercase tracking-widest mb-1">Total Dataset</p>
                        <p class="text-4xl font-black text-brand-dark"><?= $total_tokoh ?? '50' ?></p>
                    </div>
                    <div class="bg-brand-dark p-8 rounded-[3rem] shadow-2xl mt-12 transform hover:scale-105 transition-all duration-500">
                        <div class="w-12 h-12 bg-brand-teal rounded-2xl mb-6 flex items-center justify-center shadow-lg shadow-brand-teal/30">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3">
                                <path d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                            </svg>
                        </div>
                        <p class="text-[10px] font-black text-gray-500 uppercase tracking-widest mb-1">K-Value Limit</p>
                        <p class="text-4xl font-black text-brand-yellow">K=5</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-32">
            <div class="text-center mb-16">
                <h2 class="text-xs font-black text-brand-teal uppercase tracking-[0.5em] mb-4">Research Workflow</h2>
                <div class="w-20 h-1 bg-brand-yellow mx-auto rounded-full"></div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="group bg-white p-10 rounded-[3rem] border border-white shadow-xl hover:shadow-brand-teal/10 transition-all">
                    <div class="text-5xl font-black text-brand-bg group-hover:text-brand-teal/10 transition-colors mb-6 tracking-tighter uppercase italic">01</div>
                    <h3 class="text-xl font-black uppercase italic mb-4">Data Collection</h3>
                    <p class="text-sm text-gray-400 font-bold leading-relaxed italic">Import data tokoh sukses melalui file CSV atau input manual secara terstruktur.</p>
                </div>
                <div class="group bg-brand-teal p-10 rounded-[3rem] border border-brand-teal shadow-2xl transform md:-translate-y-6 transition-all">
                    <div class="text-5xl font-black text-white/10 mb-6 tracking-tighter uppercase italic">02</div>
                    <h3 class="text-xl font-black uppercase italic text-white mb-4">Clustering Engine</h3>
                    <p class="text-sm text-white/70 font-bold leading-relaxed italic">Algoritma K-Means memproses data berdasarkan jarak Euclidean hingga konvergen.</p>
                </div>
                <div class="group bg-white p-10 rounded-[3rem] border border-white shadow-xl hover:shadow-brand-teal/10 transition-all">
                    <div class="text-5xl font-black text-brand-bg group-hover:text-brand-teal/10 transition-colors mb-6 tracking-tighter uppercase italic">03</div>
                    <h3 class="text-xl font-black uppercase italic mb-4">Pattern Result</h3>
                    <p class="text-sm text-gray-400 font-bold leading-relaxed italic">Dapatkan hasil pengelompokan yang akurat beserta riwayat analisis terperinci.</p>
                </div>
            </div>
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
        background-image: radial-gradient(#e5e7eb 1px, transparent 1px);
        background-size: 40px 40px;
    }
</style>

<?= $this->endSection(); ?>