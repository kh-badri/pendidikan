<?= $this->extend('layout/layout'); ?>
<?= $this->section('content'); ?>

<div class="min-h-screen bg-[#F8FAFB] py-12 px-6 font-sans text-[#1A1A1A]">
    <div class="container mx-auto max-w-6xl">

        <div class="flex justify-between items-end mb-12">
            <div>
                <div class="flex items-center gap-3 mb-2">
                    <span class="w-12 h-1 bg-[#FFB76C] rounded-full"></span>
                    <span class="text-[#FFB76C] font-bold tracking-widest text-xs uppercase">Archive System</span>
                </div>
                <h1 class="text-5xl font-black tracking-tight uppercase">History <span class="text-gray-400">Analisis</span></h1>
                <p class="text-gray-400 mt-2 font-medium">Rekaman hasil perhitungan clustering K-Means yang telah disimpan.</p>
            </div>

            <div class="bg-white p-4 rounded-3xl shadow-xl border border-white text-center min-w-[150px]">
                <p class="text-[10px] font-black text-gray-400 uppercase">Total Arsip</p>
                <p class="text-3xl font-black text-[#1A1A1A]"><?= count($history) ?></p>
            </div>
        </div>

        <div class="bg-white rounded-[3rem] shadow-2xl shadow-gray-200/60 overflow-hidden border border-white">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-50/50 border-b border-gray-100">
                        <th class="p-8 text-gray-400 font-bold uppercase text-[10px] tracking-widest text-center">No</th>
                        <th class="p-8 text-gray-800 font-black uppercase text-xs tracking-widest">Waktu Analisis</th>
                        <th class="p-8 text-gray-800 font-black uppercase text-xs tracking-widest text-center">Jumlah Cluster (K)</th>
                        <th class="p-8 text-gray-800 font-black uppercase text-xs tracking-widest text-center">Total Iterasi</th>
                        <th class="p-8 text-gray-800 font-black uppercase text-xs tracking-widest text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    <?php if (empty($history)) : ?>
                        <tr>
                            <td colspan="5" class="py-20 text-center text-gray-300 font-bold uppercase tracking-widest">Belum ada riwayat tersimpan</td>
                        </tr>
                    <?php else : ?>
                        <?php $no = 1;
                        foreach ($history as $h) : ?>
                            <tr class="hover:bg-gray-50/50 transition-colors">
                                <td class="p-8 text-center text-gray-400 font-bold"><?= $no++ ?></td>
                                <td class="p-8">
                                    <span class="block font-black text-gray-800"><?= date('d M Y', strtotime($h['created_at'])) ?></span>
                                    <span class="text-[10px] font-bold text-gray-400 uppercase"></span>
                                </td>
                                <td class="p-8 text-center">
                                    <span class="bg-[#26CCC2] text-white px-5 py-2 rounded-full font-black text-xs shadow-sm">K = <?= $h['k_value'] ?></span>
                                </td>
                                <td class="p-8 text-center font-black text-gray-600 italic"><?= $h['iterasi'] ?> Iterasi</td>
                                <td class="p-8">
                                    <div class="flex justify-center gap-3">
                                        <a href="<?= base_url('history/detail/' . $h['id']) ?>" class="p-3 bg-white border border-gray-100 text-[#26CCC2] rounded-2xl hover:bg-[#26CCC2] hover:text-white transition-all shadow-sm">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                            </svg>
                                        </a>
                                        <a href="<?= base_url('history/delete/' . $h['id']) ?>" onclick="return confirm('Hapus permanen riwayat ini?')" class="p-3 bg-red-50 text-red-500 rounded-2xl hover:bg-red-500 hover:text-white transition-all shadow-sm">
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

<?= $this->endSection(); ?>