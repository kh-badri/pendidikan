<?= $this->extend('layout/layout'); ?>
<?= $this->section('content'); ?>

<div class="min-h-screen bg-brand-bg py-10 px-4 font-sans text-brand-dark" x-data="{ activeTab: 'profil' }">
    <div class="container mx-auto max-w-6xl">

        <div class="flex flex-col md:flex-row items-center justify-between gap-6 mb-12">
            <div class="flex items-center gap-5 text-center md:text-left">
                <div class="p-4 bg-brand-teal rounded-[1.5rem] shadow-xl shadow-brand-teal/20 transform -rotate-3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4" />
                    </svg>
                </div>
                <div>
                    <h1 class="text-4xl font-black tracking-tighter uppercase italic">Account <span class="text-brand-teal">Protocol</span></h1>
                    <p class="text-gray-400 font-bold uppercase tracking-[0.2em] text-[10px]">User Authentication & Profile Management</p>
                </div>
            </div>

            <div class="bg-white px-8 py-4 rounded-[2rem] border border-white shadow-xl shadow-gray-200/50 flex items-center gap-4">
                <div class="text-right">
                    <p class="text-[10px] font-black text-gray-300 uppercase">Current Session</p>
                    <p class="text-sm font-black text-brand-dark italic"><?= esc($user['username']) ?></p>
                </div>
                <div class="w-10 h-10 bg-brand-yellow rounded-xl flex items-center justify-center font-black italic">A</div>
            </div>
        </div>

        <?php if (session()->getFlashdata('errors')) : ?>
            <div class="bg-white border-l-8 border-red-500 p-6 mb-10 rounded-[2rem] shadow-xl flex items-start gap-4 animate-zoomIn">
                <div class="bg-red-100 p-2 rounded-lg text-red-500">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <div>
                    <p class="font-black text-brand-dark uppercase tracking-widest text-xs">Validation Failed</p>
                    <ul class="text-sm text-gray-500 mt-2 space-y-1 font-medium italic">
                        <?php foreach (session()->getFlashdata('errors') as $error) : ?>
                            <li>• <?= esc($error) ?></li>
                        <?php endforeach ?>
                    </ul>
                </div>
            </div>
        <?php endif; ?>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-10">

            <div class="lg:col-span-3">
                <div class="bg-white p-3 rounded-[2.5rem] border border-white shadow-xl shadow-gray-200/50 sticky top-8">
                    <nav class="flex flex-col space-y-2">
                        <button @click="activeTab = 'profil'"
                            :class="activeTab === 'profil' ? 'bg-brand-yellow text-brand-dark shadow-lg shadow-brand-yellow/30' : 'text-gray-400 hover:bg-brand-bg hover:text-brand-teal'"
                            class="flex items-center gap-4 px-6 py-5 rounded-[2rem] font-black text-[10px] uppercase tracking-[0.2em] transition-all duration-300 w-full group">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 transition-transform group-hover:scale-110" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            Public Identity
                        </button>

                        <button @click="activeTab = 'keamanan'"
                            :class="activeTab === 'keamanan' ? 'bg-brand-yellow text-brand-dark shadow-lg shadow-brand-yellow/30' : 'text-gray-400 hover:bg-brand-bg hover:text-brand-teal'"
                            class="flex items-center gap-4 px-6 py-5 rounded-[2rem] font-black text-[10px] uppercase tracking-[0.2em] transition-all duration-300 w-full group">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 transition-transform group-hover:scale-110" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                            </svg>
                            Security Log
                        </button>
                    </nav>
                </div>
            </div>

            <div class="lg:col-span-9">

                <div x-show="activeTab === 'profil'" x-transition:enter="transition ease-out duration-300 transform" x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0">
                    <div class="bg-white rounded-[3.5rem] shadow-2xl shadow-gray-200/60 overflow-hidden border border-white">
                        <div class="px-10 py-10 bg-gray-50/50 border-b border-gray-100 flex items-center justify-between">
                            <div>
                                <h2 class="text-2xl font-black tracking-tighter uppercase italic">General <span class="text-brand-teal">Settings</span></h2>
                                <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mt-1">Identity & Avatar Synchronization</p>
                            </div>
                            <span class="w-12 h-12 bg-brand-teal/10 text-brand-teal rounded-full flex items-center justify-center font-black">ID</span>
                        </div>

                        <div class="p-10 md:p-12">
                            <form action="<?= site_url('akun/update_profil') ?>" method="post" enctype="multipart/form-data">
                                <?= csrf_field() ?>

                                <div class="flex flex-col md:flex-row items-center gap-10 mb-12 pb-12 border-b-4 border-dashed border-gray-100">
                                    <div class="relative group shrink-0">
                                        <div class="absolute -inset-2 bg-gradient-to-tr from-brand-teal to-brand-yellow rounded-3xl blur opacity-25 group-hover:opacity-50 transition duration-500"></div>
                                        <img class="relative h-40 w-40 rounded-[2.5rem] object-cover border-8 border-white shadow-2xl ring-1 ring-gray-100"
                                            src="<?= base_url('uploads/foto_profil/' . esc($user['foto'])) ?>"
                                            onerror="this.src='https://ui-avatars.com/api/?name=<?= urlencode($user['username']) ?>&background=26CCC2&color=fff&size=256';">
                                        <div class="absolute -bottom-2 -right-2 bg-brand-teal text-white p-3 rounded-2xl shadow-lg border-4 border-white">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                                <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                                            </svg>
                                        </div>
                                    </div>

                                    <div class="flex-1 w-full text-center md:text-left">
                                        <label class="block text-[10px] font-black text-brand-dark uppercase tracking-[0.3em] mb-4">Uplink Avatar Matrix</label>
                                        <input type="file" name="foto" class="block w-full text-xs text-gray-500
                                            file:mr-6 file:py-3 file:px-8
                                            file:rounded-2xl file:border-0
                                            file:text-[10px] file:font-black file:uppercase file:tracking-widest
                                            file:bg-brand-dark file:text-white
                                            hover:file:bg-brand-teal transition-all
                                            cursor-pointer border-2 border-brand-bg rounded-3xl p-2 bg-gray-50">
                                        <p class="text-[10px] text-gray-400 mt-4 font-bold italic uppercase tracking-tighter">Supported Formats: JPG, PNG • Max Load: 1MB</p>
                                    </div>
                                </div>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-12">
                                    <div class="md:col-span-2">
                                        <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-3 ml-2">Full Name Identifier</label>
                                        <input type="text" name="nama_lengkap" value="<?= esc($user['nama_lengkap']) ?>" class="w-full bg-brand-bg border-none rounded-[1.5rem] px-8 py-5 font-black text-brand-dark focus:ring-4 focus:ring-brand-teal/20 transition-all outline-none italic">
                                    </div>

                                    <div>
                                        <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-3 ml-2">System Username (Locked)</label>
                                        <div class="relative">
                                            <input type="text" value="<?= esc($user['username']) ?>" class="w-full bg-gray-100 border-none rounded-[1.5rem] px-8 py-5 font-black text-gray-400 cursor-not-allowed italic" disabled>
                                            <div class="absolute inset-y-0 right-6 flex items-center">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-300" viewBox="0 0 20 20" fill="currentColor">
                                                    <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd" />
                                                </svg>
                                            </div>
                                        </div>
                                    </div>

                                    <div>
                                        <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-3 ml-2">Secure Email Address</label>
                                        <input type="email" name="email" value="<?= esc($user['email']) ?>" class="w-full bg-brand-bg border-none rounded-[1.5rem] px-8 py-5 font-black text-brand-dark focus:ring-4 focus:ring-brand-teal/20 transition-all outline-none italic">
                                    </div>
                                </div>

                                <div class="flex justify-end">
                                    <button type="submit" class="w-full md:w-auto bg-brand-teal text-white font-black py-5 px-12 rounded-[2rem] shadow-xl shadow-brand-teal/30 hover:bg-brand-dark transition-all transform hover:-translate-y-1 uppercase tracking-[0.2em] text-[10px] flex items-center justify-center gap-3">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                        </svg>
                                        Execute Update
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div x-show="activeTab === 'keamanan'" x-transition:enter="transition ease-out duration-300 transform" x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0" x-cloak>
                    <div class="bg-white rounded-[3.5rem] shadow-2xl shadow-gray-200/60 overflow-hidden border border-white">
                        <div class="px-10 py-10 bg-brand-dark border-b border-brand-dark text-white flex items-center justify-between">
                            <div>
                                <h2 class="text-2xl font-black tracking-tighter uppercase italic text-brand-yellow">Security <span class="text-white">Protocol</span></h2>
                                <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mt-1">Encrypted Access Control & Password Reset</p>
                            </div>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-brand-teal" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                            </svg>
                        </div>

                        <div class="p-10 md:p-12">
                            <form action="<?= site_url('akun/update_sandi') ?>" method="post">
                                <?= csrf_field() ?>

                                <div class="bg-brand-bg border-2 border-brand-teal/20 rounded-[2rem] p-8 mb-10 flex items-start gap-5">
                                    <div class="bg-brand-yellow p-3 rounded-2xl text-brand-dark shadow-lg">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                        </svg>
                                    </div>
                                    <div class="text-xs font-bold text-gray-500 italic uppercase leading-relaxed">
                                        <p class="text-brand-dark font-black mb-1">Attention Required:</p>
                                        <p>Changing your password will force a system re-authorization on your next login session. Ensure your new secret key is robust.</p>
                                    </div>
                                </div>

                                <div class="space-y-8 max-w-2xl mx-auto">
                                    <div>
                                        <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-3 ml-2 text-center">Legacy Passcode</label>
                                        <input type="password" name="password_lama" class="w-full bg-brand-bg border-none rounded-[2rem] px-10 py-6 font-black text-brand-dark text-center tracking-[0.5em] focus:ring-4 focus:ring-brand-teal/20 transition-all outline-none" placeholder="••••••••" required>
                                    </div>

                                    <div class="relative py-4">
                                        <div class="absolute inset-0 flex items-center">
                                            <div class="w-full border-t-4 border-dashed border-brand-bg"></div>
                                        </div>
                                        <div class="relative flex justify-center"><span class="bg-white px-6 py-1 text-[8px] font-black text-gray-300 uppercase tracking-[0.5em]">Sequence Break</span></div>
                                    </div>

                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                                        <div>
                                            <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-3 ml-2">New Secret Token</label>
                                            <input type="password" name="password_baru" class="w-full bg-brand-bg border-none rounded-[1.5rem] px-8 py-5 font-black text-brand-dark tracking-[0.3em] focus:ring-4 focus:ring-brand-teal/20 transition-all outline-none" placeholder="******" required>
                                        </div>

                                        <div>
                                            <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-3 ml-2">Verify Token Sequence</label>
                                            <input type="password" name="konfirmasi_password" class="w-full bg-brand-bg border-none rounded-[1.5rem] px-8 py-5 font-black text-brand-dark tracking-[0.3em] focus:ring-4 focus:ring-brand-teal/20 transition-all outline-none" placeholder="******" required>
                                        </div>
                                    </div>

                                    <div class="pt-8">
                                        <button type="submit" class="w-full bg-brand-yellow text-brand-dark font-black py-6 rounded-[2.5rem] shadow-xl shadow-brand-yellow/30 hover:bg-brand-teal hover:text-white transition-all transform hover:-translate-y-1 uppercase tracking-[0.3em] text-[10px]">
                                            Authorize Password Mutation
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

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

    .animate-zoomIn {
        animation: zoomIn 0.4s ease-out;
    }
</style>

<?= $this->endSection(); ?>