<?= $this->extend('layout/layout'); ?>
<?= $this->section('content'); ?>

<?php
// Decode data JSON yang tersimpan di database history
$detail = json_decode($history['detail_json'], true);
$data_baru = $detail['data_prediksi'] ?? null;
$dataset_hasil = $detail['hasil'] ?? [];
$centroids = $detail['centroids'] ?? [];
?>

<div class="min-h-screen bg-[#F8FAFB] py-12 px-6 font-sans text-[#1A1A1A]">
    <div class="container mx-auto max-w-7xl">

        <!-- HEADER ARSIP -->
        <div class="flex flex-col md:flex-row justify-between items-start mb-12 gap-6">
            <div>
                <div class="flex items-center gap-3 mb-2">
                    <a href="<?= base_url('history') ?>" class="text-gray-400 hover:text-gray-600 text-xs font-bold uppercase flex items-center gap-1">
                        &larr; Kembali ke Daftar History
                    </a>
                    <span class="text-gray-300">|</span>
                    <span class="text-[#FFB76C] font-bold tracking-widest text-xs uppercase">Detail Record Archive</span>
                </div>
                <h1 class="text-5xl font-black tracking-tight uppercase">Arsip <span class="text-gray-400">Analisis</span></h1>
                <p class="text-gray-500 mt-2 font-medium italic">Disimpan pada tanggal: <strong><?= date('d M Y - H:i', strtotime($history['created_at'])) ?> WIB</strong></p>
            </div>

            <div class="bg-white border-4 border-[#FFB76C] p-5 rounded-[2rem] shadow-xl text-center min-w-[180px]">
                <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-1">Konfigurasi Parameter</p>
                <div class="text-sm font-bold text-gray-700">
                    K = <?= $history['k_value'] ?> | <?= $history['iterasi'] ?> Iterasi
                </div>
            </div>
        </div>

        <!-- JIKA ADA RIWAYAT PREDIKSI DATA TOKOH BARU -->
        <?php if ($data_baru): ?>
            <div class="bg-gradient-to-br from-[#1A1A1A] to-[#2D2D2D] text-white rounded-[3.5rem] p-10 mb-12 shadow-2xl relative overflow-hidden border-4 border-white">
                <div class="absolute top-0 right-0 w-48 h-48 bg-[#FFB76C] rounded-bl-[10rem] opacity-20 -mr-10 -mt-10"></div>

                <div class="relative z-10 grid grid-cols-1 md:grid-cols-3 gap-8 items-center">
                    <div class="md:col-span-2">
                        <span class="bg-[#FFB76C] text-white px-5 py-1.5 rounded-full font-black text-[10px] uppercase tracking-widest">Sampel Tokoh Teruji Pada Arsip Ini</span>
                        <h2 class="text-4xl font-black uppercase italic tracking-tight mt-3 mb-2 text-[#FFF57E]">
                            <?= esc($data_baru['nama_tokoh']) ?>
                        </h2>
                        <p class="text-gray-300 font-medium text-sm leading-relaxed max-w-2xl">
                            Hasil pengujian sampel pada arsip rekam jejak ini menunjukkan bahwa pola latar belakang pendidikan tokoh tersebut masuk ke dalam kelompok:
                        </p>

                        <?php
                            $institusi_map = [1 => 'NEGERI', 2 => 'SWASTA'];
                            $lokasi_map = [1 => 'DALAM NEGERI', 2 => 'LUAR NEGERI'];
                            $pendidikan_map = [1 => 'SMA', 2 => 'D3', 3 => 'S1', 4 => 'S2', 5 => 'S3'];
                            $prodi_map = [1 => 'Agama', 2 => 'Sosial', 3 => 'Ekonomi', 4 => 'Hukum', 5 => 'Teknik', 6 => 'Pendidikan', 7 => 'Kesehatan', 8 => 'Pertanian', 9 => 'Seni/Lainnya'];
                        ?>
                        <div class="flex flex-wrap gap-2 mt-6 font-mono text-[11px] text-gray-400">
                            <span class="bg-white/5 px-3 py-1.5 rounded-xl border border-white/10">Jenis Inst: <?= $institusi_map[$data_baru['jenis_institusi']] ?? $data_baru['jenis_institusi'] ?></span>
                            <span class="bg-white/5 px-3 py-1.5 rounded-xl border border-white/10">Lokasi: <?= $lokasi_map[$data_baru['lokasi_institusi']] ?? $data_baru['lokasi_institusi'] ?></span>
                            <span class="bg-white/5 px-3 py-1.5 rounded-xl border border-white/10">Pendidikan: <?= $pendidikan_map[$data_baru['pendidikan_terakhir']] ?? $data_baru['pendidikan_terakhir'] ?></span>
                            <span class="bg-white/5 px-3 py-1.5 rounded-xl border border-white/10">Prodi: <?= $prodi_map[$data_baru['jurusan_prodi']] ?? $data_baru['jurusan_prodi'] ?></span>
                            <span class="bg-white/5 px-3 py-1.5 rounded-xl border border-white/10">Lama Studi: <?= $data_baru['lama_selesai'] ?> Thn</span>
                        </div>
                    </div>

                    <div class="text-center md:text-right">
                        <div class="inline-block bg-[#FFF57E] text-[#1A1A1A] px-12 py-4 rounded-[2.5rem] font-black text-xl uppercase tracking-wider shadow-2xl border-4 border-white mb-2">
                            CLUSTER <?= $data_baru['cluster_prediksi'] + 1 ?>
                        </div>
                        <br>
                        <div class="inline-block bg-[#26CCC2] text-white px-10 py-3 rounded-[2rem] font-black text-lg uppercase tracking-wider shadow-xl border-2 border-white">
                            STATUS: <?= $data_baru['status_prediksi'] ?? 'TERGOLONG SUKSES' ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>

        <!-- TABEL DATASET SAAT ANALISIS INI DILAKUKAN -->
        <div class="bg-white rounded-[3.5rem] shadow-2xl shadow-gray-200/60 overflow-hidden border border-white">
            <div class="p-10 border-b border-gray-100 flex justify-between items-center bg-[#F8FAFB]/50">
                <div>
                    <h3 class="font-black text-2xl uppercase tracking-tighter italic">Rekam Snapshot Dataset</h3>
                    <p class="text-xs text-gray-400 font-bold uppercase mt-1">Kondisi pembagian cluster data saat komputasi ini disimpan.</p>
                </div>
                <span class="bg-[#FFF57E] px-6 py-2 rounded-full font-black text-xs uppercase border border-white">N = <?= count($dataset_hasil) ?> Rekor</span>
            </div>

            <div class="overflow-x-auto h-[500px] custom-scrollbar">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-white sticky top-0 z-10 border-b border-gray-100">
                            <th class="p-8 text-gray-400 font-bold uppercase text-[10px] tracking-widest text-center">ID</th>
                            <th class="p-8 text-gray-800 font-black uppercase text-xs tracking-widest">Nama Tokoh</th>
                            <?php for ($i = 1; $i <= $history['k_value']; $i++) : ?>
                                <th class="p-8 text-gray-400 font-bold uppercase text-[10px] tracking-widest text-center italic">Dist C<?= $i ?></th>
                            <?php endfor; ?>
                            <th class="p-8 text-gray-800 font-black uppercase text-xs tracking-widest text-center">Final Cluster</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50">
                        <?php foreach ($dataset_hasil as $row) : ?>
                            <tr class="hover:bg-gray-50/80 transition-colors">
                                <td class="p-8 text-center text-gray-400 font-bold"><?= $row['id'] ?? '-' ?></td>
                                <td class="p-8 font-black text-gray-800 text-lg uppercase italic"><?= $row['nama_tokoh'] ?></td>
                                <?php for ($i = 0; $i < $history['k_value']; $i++) : ?>
                                    <td class="p-8 text-center text-xs font-bold text-gray-500 font-mono"><?= isset($row['distances'][$i]) ? number_format($row['distances'][$i], 2) : '-' ?></td>
                                <?php endfor; ?>
                                <td class="p-8 text-center">
                                    <div class="inline-block px-8 py-2.5 rounded-2xl font-black text-xs <?= $row['cluster'] == 0 ? 'bg-[#26CCC2] text-white' : ($row['cluster'] == 1 ? 'bg-[#FFB76C] text-white' : 'bg-[#FFF57E] text-[#1A1A1A]') ?> shadow-sm">
                                        C<?= $row['cluster'] + 1 ?>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>

<style>
    .custom-scrollbar::-webkit-scrollbar {
        width: 8px;
    }

    .custom-scrollbar::-webkit-scrollbar-track {
        background: #F1F1F1;
        border-radius: 10px;
    }

    .custom-scrollbar::-webkit-scrollbar-thumb {
        background: #FFB76C;
        border-radius: 10px;
    }
</style>

<?= $this->endSection(); ?>