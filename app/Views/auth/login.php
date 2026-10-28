<!DOCTYPE html>
<html lang="id" class="h-full">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk Sistem | Analis K-Means</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&display=swap"
        rel="stylesheet">

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
                        'brand-dark': '#1A1A1A',
                        'brand-bg': '#F8FAFB',
                    }
                }
            }
        }
    </script>
</head>

<body class="h-full bg-brand-bg flex items-center justify-center p-6 antialiased">

    <div class="fixed inset-0 z-0 opacity-40 pointer-events-none"
        style="background-image: radial-gradient(#26CCC2 1px, transparent 1px); background-size: 40px 40px;"></div>

    <div class="relative z-10 w-full max-w-[440px]">

        <div class="flex flex-col items-center mb-10 animate-fadeIn">
            <div
                class="w-16 h-16 bg-brand-yellow rounded-[1.5rem] shadow-2xl shadow-brand-yellow/40 flex items-center justify-center transform -rotate-6 border-4 border-white mb-4">
                <img src="<?= base_url('public/k-means.png') ?>" alt="Logo" class="w-10 h-10 object-contain">
            </div>
            <h1 class="text-3xl font-black tracking-tighter uppercase italic text-brand-dark"><span
                    class="text-brand-teal"></span>LOGIN</h1>
            <p class="text-[10px] font-black uppercase tracking-[0.4em] text-gray-400 mt-2">Otorisasi Keamanan Sistem
            </p>
        </div>

        <div
            class="bg-white rounded-[3rem] shadow-2xl shadow-gray-200/60 p-10 md:p-12 border border-white animate-slideUp">

            <form action="<?= base_url('/login') ?>" method="post" class="space-y-8">
                <?= csrf_field() ?>

                <div class="space-y-6">
                    <div class="group">
                        <label
                            class="block text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] mb-3 ml-1 group-focus-within:text-brand-teal transition-colors">username</label>
                        <div class="relative">
                            <input type="text" name="username" required
                                class="w-full bg-brand-bg border-none rounded-2xl px-6 py-4 font-bold text-brand-dark focus:ring-4 focus:ring-brand-teal/10 transition-all outline-none placeholder-gray-300"
                                placeholder="Masukkan Username">
                            <div
                                class="absolute right-5 top-1/2 -translate-y-1/2 text-gray-200 group-focus-within:text-brand-teal transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                    fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                        </div>
                    </div>

                    <div class="group">
                        <label
                            class="block text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] mb-3 ml-1 group-focus-within:text-brand-teal transition-colors">Password</label>
                        <div class="relative">
                            <input type="password" name="password" required
                                class="w-full bg-brand-bg border-none rounded-2xl px-6 py-4 font-bold text-brand-dark focus:ring-4 focus:ring-brand-teal/10 transition-all outline-none placeholder-gray-300 tracking-[0.3em]"
                                placeholder="••••••••">
                            <div
                                class="absolute right-5 top-1/2 -translate-y-1/2 text-gray-200 group-focus-within:text-brand-teal transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                    fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="pt-4">
                    <button type="submit"
                        class="w-full bg-brand-dark text-white font-black py-5 rounded-[2rem] shadow-xl shadow-brand-dark/20 hover:bg-brand-teal transition-all transform hover:-translate-y-1 active:scale-95 uppercase tracking-[0.2em] text-xs">
                        Login Akses
                    </button>

                    <div class="text-center mt-8">
                        <p class="text-[10px] font-black text-gray-300 uppercase tracking-widest">
                            Belum punya akun?
                            <a href="<?= site_url('register') ?>" class="text-brand-teal hover:underline ml-1">Daftar
                                Baru</a>
                        </p>
                    </div>
                </div>
            </form>
        </div>

        <p class="mt-12 text-center text-[10px] font-black text-gray-300 uppercase tracking-[0.5em]">
            &copy; <?= date('Y') ?> Protokol Sistem Analis
        </p>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        <?php if (session()->getFlashdata('error')): ?>
            Swal.fire({
                icon: 'error',
                title: 'Akses Ditolak',
                text: '<?= esc(session()->getFlashdata('error'), 'js') ?>',
                confirmButtonColor: '#1A1A1A',
                background: '#ffffff',
                customClass: {
                    popup: 'rounded-[3rem]',
                    confirmButton: 'rounded-2xl font-black uppercase tracking-widest px-8 py-3 text-[10px]'
                }
            });
        <?php endif; ?>
    </script>

    <style>
        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        .animate-slideUp {
            animation: slideUp 0.8s cubic-bezier(0.2, 0.8, 0.2, 1) forwards;
        }

        .animate-fadeIn {
            animation: fadeIn 1s ease-out forwards;
        }
    </style>
</body>

</html>