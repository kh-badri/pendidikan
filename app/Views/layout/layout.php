<!DOCTYPE html>
<html lang="id" class="h-full">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($title ?? 'Pola Latar Belakang Tokoh Sukses Menggunakan Metode Clustering K-Means') ?></title>

    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght=300;400;600;700;800&display=swap" rel="stylesheet">

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Plus Jakarta Sans', 'sans-serif']
                    },
                    colors: {
                        'brand-teal': '#26CCC2',
                        'brand-yellow': '#FFF57E',
                        'brand-orange': '#FFB76C',
                        'brand-bg': '#F8FAFB',
                        'brand-dark': '#1A1A1A',
                    }
                }
            }
        }
    </script>

    <style>
        #page-loader {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: #F8FAFB;
            z-index: 9999;
            display: flex;
            justify-content: center;
            align-items: center;
            transition: opacity 0.5s, visibility 0.5s;
        }

        .spinner {
            width: 60px;
            height: 60px;
            border: 6px solid #FFF;
            border-top-color: #26CCC2;
            border-radius: 50%;
            animation: spin 1s cubic-bezier(0.68, -0.55, 0.27, 1.55) infinite;
        }

        @keyframes spin {
            to {
                transform: rotate(360deg);
            }
        }

        .custom-scrollbar::-webkit-scrollbar {
            width: 6px;
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

        [x-cloak] {
            display: none !important;
        }

        .active-nav {
            background-color: #FFF57E !important;
            color: #1A1A1A !important;
            box-shadow: 0 10px 20px -5px rgba(255, 245, 126, 0.5);
        }

        @keyframes toast-in {
            from {
                transform: translateX(100%) scale(0.9);
                opacity: 0;
            }

            to {
                transform: translateX(0) scale(1);
                opacity: 1;
            }
        }

        .animate-toast {
            animation: toast-in 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275) forwards;
        }
    </style>
</head>

<body class="h-full bg-brand-bg text-brand-dark font-sans antialiased selection:bg-brand-teal selection:text-white"
    x-data="{ 
        sidebarOpen: false, 
        showNotice: <?= (session()->getFlashdata('success') || session()->getFlashdata('error')) ? 'true' : 'false' ?>,
        noticeType: '<?= session()->getFlashdata('success') ? 'success' : 'error' ?>',
        noticeMsg: '<?= session()->getFlashdata('success') ?? session()->getFlashdata('error') ?>'
      }"
    x-init="if(showNotice) { setTimeout(() => showNotice = false, 5000) }">

    <!-- TOAST NOTIFICATION SYSTEM -->
    <template x-if="showNotice">
        <div class="fixed top-8 right-8 z-[100] w-full max-w-[350px] animate-toast">
            <div class="relative bg-white rounded-[2rem] shadow-[0_20px_50px_rgba(0,0,0,0.1)] border border-white overflow-hidden p-6">
                <div class="flex items-start gap-4">
                    <div :class="noticeType === 'success' ? 'bg-brand-teal' : 'bg-red-500'"
                        class="p-3 rounded-2xl text-white shadow-lg shrink-0">
                        <template x-if="noticeType === 'success'">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" />
                            </svg>
                        </template>
                        <template x-if="noticeType === 'error'">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </template>
                    </div>
                    <div class="flex-1">
                        <h4 class="text-[10px] font-black uppercase tracking-[0.2em] mb-1"
                            :class="noticeType === 'success' ? 'text-brand-teal' : 'text-red-500'"
                            x-text="noticeType === 'success' ? 'Protocol Verified' : 'System Error'"></h4>
                        <p class="text-sm font-bold text-gray-600 leading-tight italic" x-text="noticeMsg"></p>
                    </div>
                    <button @click="showNotice = false" class="text-gray-300 hover:text-gray-500 transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
                <div class="absolute bottom-0 left-0 h-1 bg-gray-100 w-full">
                    <div class="h-full transition-all duration-[5000ms] ease-linear bg-brand-teal"
                        :class="noticeType === 'success' ? 'bg-brand-teal' : 'bg-red-500'"
                        :style="showNotice ? 'width: 0%' : 'width: 100%'"
                        x-init="setTimeout(() => $el.style.width = '0%', 10)"></div>
                </div>
            </div>
        </div>
    </template>

    <!-- INITIAL PAGE LOADER -->
    <div id="page-loader">
        <div class="text-center">
            <div class="spinner mx-auto mb-6"></div>
            <p class="text-brand-teal text-xs tracking-[0.3em] uppercase font-black animate-pulse">Initializing System</p>
        </div>
    </div>

    <!-- MOBILE HEADER -->
    <div class="md:hidden flex items-center justify-between bg-white/80 backdrop-blur-md p-6 sticky top-0 z-40 border-b border-white">
        <div class="flex items-center gap-3">
            <div class="w-8 h-8 bg-brand-teal rounded-xl shadow-lg flex items-center justify-center text-white font-black text-xs italic">K</div>
            <span class="font-black tracking-tighter text-sm text-brand-dark uppercase italic">Pola Latar Belakang <span class="text-gray-300">Tokoh Sukses</span></span>
        </div>
        <button @click="sidebarOpen = !sidebarOpen" class="bg-brand-bg p-2 rounded-xl text-brand-dark focus:outline-none">
            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" />
            </svg>
        </button>
    </div>

    <div class="flex h-screen overflow-hidden p-0 md:p-4">
        <!-- SIDEBAR CONTAINER -->
        <aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'" class="fixed inset-y-0 left-0 z-50 w-72 bg-white transition-transform duration-300 ease-in-out md:relative md:translate-x-0 flex flex-col shadow-2xl shadow-gray-200/50 md:rounded-[2.5rem] border border-white overflow-hidden">

            <!-- SIDEBAR LOGO HEADER -->
            <div class="flex items-center gap-4 px-8 h-32 shrink-0">
                <div class="w-14 h-14 shrink-0 flex items-center justify-center bg-brand-yellow rounded-2xl shadow-lg shadow-brand-yellow/30 transform -rotate-3 border-2 border-white">
                    <img src="<?= base_url('public/k-means.png') ?>" alt="Logo" class="w-8 h-8 object-contain" onerror="this.src='https://img.icons8.com/fluency/48/data-configuration.png'">
                </div>
                <div class="overflow-hidden">
                    <h1 class="text-[12px] font-black text-brand-dark leading-tight tracking-tighter italic uppercase">Pola Latar Belakang <br><span class="text-brand-teal">Tokoh Sukses</span></h1>
                    <p class="text-[8px] text-gray-400 uppercase tracking-[0.2em] font-bold mt-1.5">Clustering K-Means</p>
                </div>
            </div>

            <!-- DYNAMIC NAVIGATION SYSTEM -->
            <nav class="flex-1 px-6 py-4 space-y-3 overflow-y-auto custom-scrollbar">
                <?php
                // Mengubah nama parameter $activeMenu menjadi $active_menu agar sinkron dengan data controller
                function sidebarItem($href, $label, $active_menu, $menuName, $iconPath)
                {
                    $isActive = trim($active_menu ?? '') === trim($menuName);
                    $activeClass = $isActive ? 'active-nav font-black scale-105' : 'text-gray-400 hover:text-brand-teal hover:bg-brand-bg font-bold';

                    echo '<a href="' . base_url($href) . '" class="flex items-center gap-4 px-6 py-4 rounded-2xl text-xs uppercase tracking-widest transition-all duration-300 group ' . $activeClass . '">
                            <div class="p-2 ' . ($isActive ? 'bg-black/10' : 'bg-white/10') . ' rounded-lg group-hover:rotate-12 transition-transform">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">' . $iconPath . '</svg>
                            </div>' . $label . '</a>';
                }

                // Ambil data menu aktif dari controller saat ini
                $currentActiveMenu = $active_menu ?? '';

                sidebarItem('/', 'Dashboard', $currentActiveMenu, 'home', '<path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />');
                sidebarItem('/dataset', 'Dataset Tokoh', $currentActiveMenu, 'dataset', '<path stroke-linecap="round" stroke-linejoin="round" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />');
                sidebarItem('/prediksi', 'Prediksi', $currentActiveMenu, 'prediksi', '<path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z" />');
                sidebarItem('/history', 'History Data', $currentActiveMenu, 'history', '<path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />');
                ?>
            </nav>

            <!-- SIDEBAR FOOTER CARD PROFILE -->
            <div class="p-6 shrink-0">
                <div class="bg-brand-bg rounded-[2rem] p-6 border border-white">
                    <div class="flex items-center gap-3 mb-4">
                        <img class="h-10 w-10 rounded-xl object-cover ring-2 ring-white shadow-sm" src="<?= base_url('uploads/foto_profil/' . (session()->get('foto') ?: 'default.jpg')) ?>" onerror="this.src='https://ui-avatars.com/api/?name=' + encodeURIComponent('<?= session()->get('username') ?? 'Admin' ?>') + '&background=26CCC2&color=fff'">
                        <div class="overflow-hidden">
                            <p class="text-[10px] font-black text-brand-dark truncate uppercase italic"><?= esc(session()->get('username') ?? 'User Admin') ?></p>
                            <span class="text-[8px] text-brand-teal font-black uppercase">Administrator</span>
                        </div>
                    </div>
                    <div class="grid grid-cols-2 gap-2">
                        <a href="<?= site_url('logout') ?>" class="flex items-center justify-center py-2 bg-white text-red-500 rounded-xl text-[9px] font-black uppercase tracking-widest hover:bg-red-500 hover:text-white transition-all shadow-sm italic">Logout</a>
                        <a href="<?= base_url('/akun') ?>" class="flex items-center justify-center py-2 bg-white text-gray-500 rounded-xl text-[9px] font-black uppercase tracking-widest hover:bg-brand-teal hover:text-white transition-all shadow-sm italic">Akun</a>
                    </div>
                </div>
            </div>
        </aside>

        <!-- MAIN VIEW CONTENT CONTAINER -->
        <main class="flex-1 flex flex-col h-full overflow-hidden relative md:ml-4">
            <div class="flex-1 overflow-y-auto bg-brand-bg custom-scrollbar md:rounded-[3rem] border border-white shadow-inner">
                <div class="p-4 md:p-10">

                    <!-- AREA RENDERING VIEW -->
                    <?= $this->renderSection('content') ?>

                    <!-- FOOTER LAYER -->
                    <footer class="mt-20 py-10 text-center opacity-30">
                        <p class="text-[10px] font-black uppercase tracking-[0.2em]">&copy; <?= date('Y') ?> Pola Latar Belakang Tokoh Sukses - Clustering K-Means</p>
                    </footer>
                </div>
            </div>
        </main>
    </div>

    <!-- REMOVE PAGE LOADER SCRIPT -->
    <script>
        window.addEventListener('load', () => {
            const loader = document.getElementById('page-loader');
            if (loader) {
                loader.style.opacity = '0';
                setTimeout(() => loader.remove(), 500);
            }
        });
    </script>
</body>

</html>