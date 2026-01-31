<!DOCTYPE html>
<html lang="id" class="h-full">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pendaftaran Akun | Analis K-Means</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&display=swap" rel="stylesheet">

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

    <div class="fixed inset-0 z-0 opacity-40 pointer-events-none" style="background-image: radial-gradient(#26CCC2 1px, transparent 1px); background-size: 40px 40px;"></div>

    <div class="relative z-10 w-full max-w-[550px]">

        <div class="flex flex-col items-center mb-8 animate-fadeIn">
            <div class="w-14 h-14 bg-brand-teal rounded-[1.2rem] shadow-2xl shadow-brand-teal/40 flex items-center justify-center transform rotate-6 border-4 border-white mb-4">
                <img src="<?= base_url('public/nikah2.png') ?>" alt="Logo" class="w-8 h-8 object-contain brightness-0 invert">
            </div>
            <h1 class="text-3xl font-black tracking-tighter uppercase italic text-brand-dark">Lab<span class="text-brand-teal">.</span>Registrasi</h1>
            <p class="text-[10px] font-black uppercase tracking-[0.4em] text-gray-400 mt-2">Pembuatan Identitas Baru Sistem</p>
        </div>

        <div class="bg-white rounded-[3rem] shadow-2xl shadow-gray-200/60 p-8 md:p-12 border border-white animate-slideUp">

            <form action="<?= base_url('/register') ?>" method="post" class="space-y-6">
                <?= csrf_field() ?>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="group md:col-span-2">
                        <label class="block text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] mb-2 ml-1">Nama Lengkap Sesuai ID</label>
                        <input type="text" name="nama_lengkap" value="<?= old('nama_lengkap') ?>" required
                            class="w-full bg-brand-bg border-none rounded-2xl px-6 py-4 font-bold text-brand-dark focus:ring-4 focus:ring-brand-teal/10 transition-all outline-none italic placeholder-gray-300"
                            placeholder="Contoh: Ahmad Fauzi">
                    </div>

                    <div class="group">
                        <label class="block text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] mb-2 ml-1">ID Akses Baru</label>
                        <input type="text" name="username" value="<?= old('username') ?>" required
                            class="w-full bg-brand-bg border-none rounded-2xl px-6 py-4 font-bold text-brand-dark focus:ring-4 focus:ring-brand-teal/10 transition-all outline-none placeholder-gray-300"
                            placeholder="username">
                    </div>

                    <div class="group">
                        <label class="block text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] mb-2 ml-1">Email Aktif</label>
                        <input type="email" name="email" value="<?= old('email') ?>" required
                            class="w-full bg-brand-bg border-none rounded-2xl px-6 py-4 font-bold text-brand-dark focus:ring-4 focus:ring-brand-teal/10 transition-all outline-none placeholder-gray-300"
                            placeholder="name@mail.com">
                    </div>

                    <div class="group">
                        <label class="block text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] mb-2 ml-1">Kata Sandi</label>
                        <input type="password" name="password" required
                            class="w-full bg-brand-bg border-none rounded-2xl px-6 py-4 font-bold text-brand-dark focus:ring-4 focus:ring-brand-teal/10 transition-all outline-none placeholder-gray-300 tracking-[0.2em]"
                            placeholder="••••••••">
                    </div>

                    <div class="group">
                        <label class="block text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] mb-2 ml-1">Ulangi Sandi</label>
                        <input type="password" name="password_confirm" required
                            class="w-full bg-brand-bg border-none rounded-2xl px-6 py-4 font-bold text-brand-dark focus:ring-4 focus:ring-brand-teal/10 transition-all outline-none placeholder-gray-300 tracking-[0.2em]"
                            placeholder="••••••••">
                    </div>
                </div>

                <div class="pt-6">
                    <button type="submit"
                        class="w-full bg-brand-dark text-white font-black py-5 rounded-[2rem] shadow-xl shadow-brand-dark/20 hover:bg-brand-teal transition-all transform hover:-translate-y-1 active:scale-95 uppercase tracking-[0.2em] text-xs">
                        Buat Akun Peneliti
                    </button>

                    <div class="text-center mt-8">
                        <p class="text-[10px] font-black text-gray-300 uppercase tracking-widest">
                            Sudah memiliki akses?
                            <a href="<?= site_url('login') ?>" class="text-brand-teal hover:underline ml-1">Masuk Sekarang</a>
                        </p>
                    </div>
                </div>
            </form>
        </div>

        <p class="mt-10 text-center text-[10px] font-black text-gray-300 uppercase tracking-[0.5em]">
            &copy; <?= date('Y') ?> Protokol Sistem Analis
        </p>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        <?php if (session()->getFlashdata('errors')) : ?>
            Swal.fire({
                icon: 'error',
                title: 'Gagal Registrasi',
                html: '<div class="text-left text-xs font-bold text-gray-500 uppercase italic"><ul><?php foreach (session()->getFlashdata('errors') as $error) : ?><li>• <?= esc($error) ?></li><?php endforeach ?></ul></div>',
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