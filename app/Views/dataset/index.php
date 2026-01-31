<?php helper('form'); ?>
<?= $this->extend('layout/layout'); ?>
<?= $this->section('content'); ?>

<div class="min-h-screen bg-[#F8FAFB] py-12 px-6 font-sans text-[#1A1A1A]">
    <div class="container mx-auto max-w-7xl">

        <div class="flex flex-col md:flex-row justify-between items-end mb-12 gap-6">
            <div>
                <div class="flex items-center gap-3 mb-2">
                    <span class="w-12 h-1 bg-[#26CCC2] rounded-full"></span>
                    <span class="text-[#26CCC2] font-bold tracking-widest text-xs uppercase">Research Dataset</span>
                </div>
                <h1 class="text-5xl font-extrabold tracking-tight">Dataset <span class="text-gray-400">Tokoh Sukses</span></h1>
                <p class="text-gray-400 mt-2 font-medium">Manajemen data latar belakang pendidikan untuk pemetaan K-Means.</p>
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
            <div class="auto-dismiss-alert bg-[#6AECE1] text-[#1A1A1A] px-8 py-5 rounded-3xl shadow-lg shadow-[#6AECE1]/20 mb-10 flex items-center gap-4 border border-white/50">
                <div class="bg-white/40 p-2 rounded-full shadow-inner">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                    </svg>
                </div>
                <span class="font-bold text-lg"><?= session()->getFlashdata('success') ?></span>
            </div>
        <?php endif; ?>

        <div class="bg-white/80 backdrop-blur-md p-4 rounded-[2.5rem] shadow-xl shadow-gray-200/40 border border-white mb-8 flex flex-wrap justify-between items-center gap-4">
            <div class="flex gap-3">
                <button onclick="openModal('modalManual')" class="bg-[#FFF57E] hover:bg-[#F3E66B] text-[#1A1A1A] px-8 py-4 rounded-[1.8rem] font-bold transition-all shadow-lg flex items-center gap-3 active:scale-95">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
                    </svg>
                    Tambah Tokoh
                </button>
                <button onclick="openModal('modalUpload')" class="bg-[#FFB76C] hover:bg-[#ff9d36] text-white px-8 py-4 rounded-[1.8rem] font-bold transition-all shadow-lg flex items-center gap-3 active:scale-95">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" />
                    </svg>
                    Import CSV
                </button>
                <button onclick="openModal('modalKetentuan')" class="bg-[#26CCC2] hover:bg-[#1da8a0] text-white px-8 py-4 rounded-[1.8rem] font-bold transition-all shadow-lg flex items-center gap-3 active:scale-95">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    Ketentuan Nilai
                </button>
            </div>

            <a href="<?= base_url('dataset/hapus-semua') ?>" onclick="return confirm('Hapus semua data permanent?')" class="bg-white border-2 border-red-500 text-red-500 hover:bg-red-500 hover:text-white px-8 py-4 rounded-[1.8rem] font-bold transition-all shadow-lg shadow-red-100 flex items-center gap-2 active:scale-95 text-xs uppercase tracking-widest">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                </svg>
                Reset Dataset
            </a>
        </div>

        <div class="bg-white rounded-[3rem] shadow-2xl shadow-gray-200/60 overflow-hidden border border-white relative">
            <div class="overflow-x-auto h-[650px] custom-scrollbar">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-white border-b border-gray-100 sticky top-0 z-10">
                            <th class="p-8 text-gray-400 font-bold uppercase text-[10px] tracking-[0.2em] text-center">ID</th>
                            <th class="p-8 text-gray-800 font-extrabold uppercase text-xs tracking-widest">Profile Tokoh</th>
                            <th class="p-8 text-gray-800 font-bold uppercase text-xs tracking-widest text-center">Inst</th>
                            <th class="p-8 text-gray-800 font-bold uppercase text-xs tracking-widest text-center">Lokasi</th>
                            <th class="p-8 text-gray-800 font-bold uppercase text-xs tracking-widest text-center">Pend</th>
                            <th class="p-8 text-gray-800 font-bold uppercase text-xs tracking-widest text-center">Prodi</th>
                            <th class="p-8 text-gray-800 font-bold uppercase text-xs tracking-widest text-center">Masa (Tahun)</th>
                            <th class="p-8 text-gray-800 font-bold uppercase text-xs tracking-widest text-center">Opsi</th>
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
                                    <td class="p-8 text-gray-400 font-bold"><?= $row['id'] ?></td>
                                    <td class="p-8 text-left">
                                        <span class="block font-black text-gray-800 text-lg"><?= $row['nama_tokoh'] ?></span>
                                    </td>
                                    <td class="p-8 font-black text-gray-600 text-xl"><?= $row['jenis_institusi'] ?></td>
                                    <td class="p-8 font-black text-gray-600 text-xl"><?= $row['lokasi_institusi'] ?></td>
                                    <td class="p-8 font-black text-gray-600 text-xl"><?= $row['pendidikan_terakhir'] ?></td>
                                    <td class="p-8 font-black text-[#26CCC2] text-xl"><?= $row['jurusan_prodi'] ?></td>
                                    <td class="p-8">
                                        <div class="inline-flex items-center bg-[#FFF57E] px-5 py-2 rounded-2xl border border-white text-gray-800 font-black shadow-sm text-xl italic">
                                            <?= $row['lama_selesai'] ?>
                                        </div>
                                    </td>
                                    <td class="p-8">
                                        <div class="flex justify-center gap-3">
                                            <button onclick='openEditModal(<?= json_encode($row) ?>)' class="p-3 bg-white border border-gray-100 text-[#26CCC2] rounded-2xl hover:bg-[#26CCC2] hover:text-white transition-all shadow-sm">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                                    <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                                                </svg>
                                            </button>
                                            <a href="<?= base_url('dataset/delete/' . $row['id']) ?>" onclick="return confirm('Hapus?')" class="p-3 bg-red-50 text-red-500 rounded-2xl hover:bg-red-500 hover:text-white transition-all shadow-sm">
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

<div id="modalKetentuan" class="fixed inset-0 z-50 hidden bg-[#1A1A1A]/60 backdrop-blur-sm flex items-center justify-center p-6 text-left">
    <div class="bg-white rounded-[3rem] shadow-2xl w-full max-w-2xl overflow-hidden animate-zoomIn border border-white">
        <div class="bg-[#26CCC2] p-8 text-white flex justify-between items-center shadow-md">
            <h3 class="text-2xl font-black italic tracking-tight uppercase flex items-center gap-3">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                Ketentuan Nilai Angka Pada Tabel
            </h3>
            <button onclick="closeModal('modalKetentuan')" class="bg-white/20 p-2 rounded-full hover:bg-white/40 transition-all leading-none text-2xl">&times;</button>
        </div>
        <div class="p-10 grid grid-cols-1 md:grid-cols-2 gap-8 h-[450px] overflow-y-auto custom-scrollbar">
            <div class="space-y-3 font-bold">
                <h4 class="text-[#26CCC2] uppercase tracking-widest text-[10px] border-b pb-2">Jenis Institusi (Inst)</h4>
                <p class="text-sm">1 : <span class="bg-gray-50 px-2 py-0.5 rounded border">NEGERI</span></p>
                <p class="text-sm">2 : <span class="bg-gray-50 px-2 py-0.5 rounded border">SWASTA</span></p>
            </div>
            <div class="space-y-3 font-bold">
                <h4 class="text-[#FFB76C] uppercase tracking-widest text-[10px] border-b pb-2">Lokasi Institusi (Lokasi)</h4>
                <p class="text-sm">1 : <span class="bg-gray-50 px-2 py-0.5 rounded border">DALAM NEGERI</span></p>
                <p class="text-sm">2 : <span class="bg-gray-50 px-2 py-0.5 rounded border">LUAR NEGERI</span></p>
            </div>
            <div class="space-y-3 font-bold">
                <h4 class="text-[#26CCC2] uppercase tracking-widest text-[10px] border-b pb-2">Pendidikan Terakhir (Pend)</h4>
                <p class="text-sm">1 : SMA | 2 : D3 | 3 : S1</p>
                <p class="text-sm">4 : S2 (Magister) | 5 : S3 (Doktor)</p>
            </div>
            <div class="space-y-3 font-bold">
                <h4 class="text-[#FFB76C] uppercase tracking-widest text-[10px] border-b pb-2">Jurusan Prodi (Prodi)</h4>
                <p class="text-xs">1: Agama | 2: Sosial | 3: Ekonomi | 4: Hukum</p>
                <p class="text-xs">5: Teknik | 6: Pendidikan | 7: Kesehatan</p>
                <p class="text-xs">8: Pertanian | 9: Seni/Lainnya</p>
            </div>
        </div>
        <div class="p-6 bg-gray-50 text-center border-t">
            <button onclick="closeModal('modalKetentuan')" class="bg-[#1A1A1A] text-white px-10 py-3 rounded-full font-black uppercase text-xs tracking-widest">Tutup Panduan</button>
        </div>
    </div>
</div>

<div id="modalManual" class="fixed inset-0 z-50 hidden bg-[#1A1A1A]/60 backdrop-blur-sm flex items-center justify-center p-6 text-left">
    <div class="bg-white rounded-[3rem] shadow-2xl w-full max-w-lg overflow-hidden animate-zoomIn border border-white">
        <div class="bg-[#FFF57E] p-8 text-[#1A1A1A] flex justify-between items-center shadow-md">
            <h3 class="text-2xl font-black italic tracking-tight uppercase">Entry Tokoh Baru</h3>
            <button onclick="closeModal('modalManual')" class="bg-[#1A1A1A]/10 p-2 rounded-full hover:bg-[#1A1A1A]/20 transition-all text-2xl leading-none">&times;</button>
        </div>
        <form action="<?= base_url('dataset/save') ?>" method="post" class="p-10 space-y-5">
            <?= csrf_field() ?>
            <div>
                <label class="block text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] mb-2">Nama Lengkap Tokoh</label>
                <input type="text" name="nama_tokoh" class="w-full bg-[#F8FAFB] border-none rounded-2xl p-4 text-lg font-bold focus:ring-4 focus:ring-[#FFF57E] outline-none" required>
            </div>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] mb-2">Institusi</label>
                    <select name="jenis_institusi" class="w-full bg-[#F8FAFB] border-none rounded-2xl p-4 font-bold outline-none focus:ring-4 focus:ring-[#FFF57E]">
                        <option value="1">1 - NEGERI</option>
                        <option value="2">2 - SWASTA</option>
                    </select>
                </div>
                <div>
                    <label class="block text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] mb-2">Lokasi</label>
                    <select name="lokasi_institusi" class="w-full bg-[#F8FAFB] border-none rounded-2xl p-4 font-bold outline-none focus:ring-4 focus:ring-[#FFF57E]">
                        <option value="1">1 - DALAM NEGERI</option>
                        <option value="2">2 - LUAR NEGERI</option>
                    </select>
                </div>
            </div>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] mb-2">Pendidikan</label>
                    <select name="pendidikan_terakhir" class="w-full bg-[#F8FAFB] border-none rounded-2xl p-4 font-bold outline-none focus:ring-4 focus:ring-[#FFF57E]">
                        <option value="1">1 - SMA</option>
                        <option value="2">2 - D3</option>
                        <option value="3">3 - S1</option>
                        <option value="4">4 - S2</option>
                        <option value="5">5 - S3</option>
                    </select>
                </div>
                <div>
                    <label class="block text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] mb-2">Jurusan</label>
                    <input type="number" name="jurusan_prodi" min="1" max="9" class="w-full bg-[#F8FAFB] border-none rounded-2xl p-4 font-bold outline-none focus:ring-4 focus:ring-[#FFF57E]" required>
                </div>
            </div>
            <div>
                <label class="block text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] mb-2">Masa Studi (Tahun)</label>
                <input type="number" name="lama_selesai" class="w-full bg-[#F8FAFB] border-none rounded-2xl p-4 font-bold outline-none focus:ring-4 focus:ring-[#FFF57E]" required>
            </div>
            <button type="submit" class="w-full bg-[#FFF57E] text-[#1A1A1A] font-black py-5 rounded-[2rem] shadow-xl hover:bg-[#F3E66B] transition-all uppercase tracking-widest mt-4">Simpan Ke Dataset</button>
        </form>
    </div>
</div>

<div id="modalEdit" class="fixed inset-0 z-50 hidden bg-[#1A1A1A]/60 backdrop-blur-sm flex items-center justify-center p-6 text-left">
    <div class="bg-white rounded-[3rem] shadow-2xl w-full max-w-lg overflow-hidden animate-zoomIn border border-white">
        <div class="bg-[#FFF57E] p-8 text-[#1A1A1A] flex justify-between items-center shadow-md">
            <h3 class="text-2xl font-black italic tracking-tight uppercase flex items-center gap-3">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                </svg>
                Perbarui Data Tokoh
            </h3>
            <button onclick="closeModal('modalEdit')" class="bg-[#1A1A1A]/10 p-2 rounded-full hover:bg-[#1A1A1A]/20 transition-all text-2xl leading-none">&times;</button>
        </div>
        <form id="formEdit" action="" method="post" class="p-10 space-y-5">
            <?= csrf_field() ?>
            <div>
                <label class="block text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] mb-2">Nama Tokoh</label>
                <input type="text" id="edit_nama" name="nama_tokoh" class="w-full bg-[#F8FAFB] border-none rounded-2xl p-4 text-lg font-bold focus:ring-4 focus:ring-[#FFF57E] outline-none" required>
            </div>
            <div class="grid grid-cols-2 gap-4">
                <div><label class="block text-[10px] font-black text-gray-400 uppercase mb-2 text-center">Institusi</label><select name="jenis_institusi" id="edit_institusi" class="w-full bg-[#F8FAFB] rounded-2xl p-4 font-bold focus:ring-4 focus:ring-[#FFF57E] outline-none">
                        <option value="1">1</option>
                        <option value="2">2</option>
                    </select></div>
                <div><label class="block text-[10px] font-black text-gray-400 uppercase mb-2 text-center">Lokasi</label><select name="lokasi_institusi" id="edit_lokasi" class="w-full bg-[#F8FAFB] rounded-2xl p-4 font-bold focus:ring-4 focus:ring-[#FFF57E] outline-none">
                        <option value="1">1</option>
                        <option value="2">2</option>
                    </select></div>
            </div>
            <div class="grid grid-cols-2 gap-4">
                <div><label class="block text-[10px] font-black text-gray-400 uppercase mb-2 text-center">Pendidikan</label>
                    <select name="pendidikan_terakhir" id="edit_pendidikan" class="w-full bg-[#F8FAFB] rounded-2xl p-4 font-bold focus:ring-4 focus:ring-[#FFF57E] outline-none">
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                    </select>
                </div>
                <div><label class="block text-[10px] font-black text-gray-400 uppercase mb-2 text-center">Jurusan</label><input type="number" id="edit_prodi" name="jurusan_prodi" class="w-full bg-[#F8FAFB] rounded-2xl p-4 font-bold focus:ring-4 focus:ring-[#FFF57E] outline-none" required></div>
            </div>
            <div>
                <label class="block text-[10px] font-black text-gray-400 uppercase mb-2 text-center">Masa Studi</label>
                <input type="number" id="edit_lama" name="lama_selesai" class="w-full bg-[#F8FAFB] rounded-2xl p-4 font-bold focus:ring-4 focus:ring-[#FFF57E] outline-none" required>
            </div>
            <div class="flex gap-4 pt-4">
                <button type="button" onclick="closeModal('modalEdit')" class="w-1/3 py-5 font-bold text-gray-400 uppercase tracking-widest text-xs">Batal</button>
                <button type="submit" class="w-2/3 bg-[#FFF57E] text-[#1A1A1A] font-black py-5 rounded-[2rem] shadow-xl hover:bg-[#F3E66B] transition-all uppercase tracking-widest">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div>

<div id="modalUpload" class="fixed inset-0 z-50 hidden bg-[#1A1A1A]/60 backdrop-blur-sm flex items-center justify-center p-6 text-center text-left">
    <div class="bg-white rounded-[3rem] shadow-2xl w-full max-w-md overflow-hidden animate-zoomIn border border-white">
        <div class="bg-[#FFB76C] p-8 text-white flex justify-between items-center shadow-md">
            <h3 class="text-2xl font-black italic tracking-tight uppercase">Bulk Import CSV</h3>
            <button onclick="closeModal('modalUpload')" class="bg-white/20 p-2 rounded-full leading-none text-2xl">&times;</button>
        </div>
        <form action="<?= base_url('dataset/upload') ?>" method="post" enctype="multipart/form-data" class="p-10">
            <?= csrf_field() ?>
            <div class="bg-[#F8FAFB] border-4 border-dashed border-gray-100 rounded-[2rem] p-12 mb-8">
                <div class="bg-white w-16 h-16 rounded-[1.2rem] shadow-lg flex items-center justify-center mx-auto mb-6 text-[#FFB76C]">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                    </svg>
                </div>
                <input type="file" name="file_csv" class="text-xs font-bold text-gray-400" required accept=".csv">
            </div>
            <button type="submit" class="w-full bg-[#FFB76C] text-white font-black py-5 rounded-[2rem] shadow-xl hover:bg-[#ff9d36] transition-all uppercase tracking-widest">Sinkronisasi Data</button>
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