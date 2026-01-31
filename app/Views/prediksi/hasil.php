<?= $this->extend('layout/layout'); ?>
<?= $this->section('content'); ?>

<div class="min-h-screen bg-[#F8FAFB] py-12 px-6 font-sans text-[#1A1A1A]">
    <div class="container mx-auto max-w-7xl">

        <div class="flex flex-col md:flex-row justify-between items-start mb-12 gap-6">
            <div>
                <div class="flex items-center gap-3 mb-2">
                    <span class="w-12 h-1 bg-[#26CCC2] rounded-full"></span>
                    <span class="text-[#26CCC2] font-bold tracking-widest text-xs uppercase">Clustering Result</span>
                </div>
                <h1 class="text-5xl font-black tracking-tight uppercase">Hasil <span class="text-gray-400">Analisis</span></h1>
                <p class="text-gray-500 mt-2 font-medium italic">Proses clustering selesai dalam <?= $iterasi_ke ?> iterasi.</p>
            </div>

            <div class="bg-white border-4 border-[#26CCC2] p-6 rounded-[2rem] shadow-xl shadow-[#26CCC2]/10 max-w-sm">
                <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-4 text-center">Euclidean Distance Formula</p>
                <div class="bg-[#F8FAFB] p-5 rounded-2xl text-center border border-gray-100">
                    <div class="text-2xl font-serif italic text-gray-800">
                        d = &radic;&Sigma; (x<sub>i</sub> - y<sub>i</sub>)<sup>2</sup>
                    </div>
                </div>
            </div>
        </div>

        <div class="mb-12 flex flex-wrap justify-center gap-4">
            <button onclick="openModal('modalManualCalculation')" class="bg-[#26CCC2] hover:bg-[#1da8a0] text-white px-10 py-5 rounded-[2rem] font-black shadow-2xl shadow-[#26CCC2]/40 transition-all transform hover:-translate-y-1 active:scale-95 text-lg uppercase tracking-widest flex items-center gap-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                </svg>
                Cara Perhitungan Manual
            </button>

            <form action="<?= base_url('prediksi/simpan') ?>" method="post">
                <?= csrf_field() ?>
                <input type="hidden" name="k_value" value="<?= $k_value ?>">
                <input type="hidden" name="iterasi" value="<?= $iterasi_ke ?>">
                <input type="hidden" name="detail_json" value='<?= $detail_json ?>'>
                <button type="submit" class="bg-[#FFB76C] hover:bg-[#ff9d36] text-white px-10 py-5 rounded-[2rem] font-black shadow-2xl shadow-[#FFB76C]/40 transition-all transform hover:-translate-y-1 active:scale-95 text-lg uppercase tracking-widest flex items-center gap-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4" />
                    </svg>
                    Simpan Ke History
                </button>
            </form>
        </div>

        <div class="bg-white rounded-[3.5rem] shadow-2xl shadow-gray-200/60 overflow-hidden border border-white">
            <div class="p-10 border-b border-gray-100 flex justify-between items-center bg-[#F8FAFB]/50">
                <h3 class="font-black text-2xl uppercase tracking-tighter italic">Tabel Hasil Akhir Cluster</h3>
                <span class="bg-[#FFF57E] px-6 py-2 rounded-full font-black text-xs uppercase border border-white">N = <?= count($dataset_hasil) ?> Data</span>
            </div>
            <div class="overflow-x-auto h-[600px] custom-scrollbar">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-white sticky top-0 z-10">
                            <th class="p-8 text-gray-400 font-bold uppercase text-[10px] tracking-widest text-center">ID</th>
                            <th class="p-8 text-gray-800 font-black uppercase text-xs tracking-widest">Nama Tokoh</th>
                            <?php for ($i = 1; $i <= $k_value; $i++) : ?>
                                <th class="p-8 text-gray-400 font-bold uppercase text-[10px] tracking-widest text-center italic">Dist C<?= $i ?></th>
                            <?php endfor; ?>
                            <th class="p-8 text-gray-800 font-black uppercase text-xs tracking-widest text-center">Final Cluster</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50">
                        <?php foreach ($dataset_hasil as $row) : ?>
                            <tr class="hover:bg-gray-50/80 transition-colors">
                                <td class="p-8 text-center text-gray-400 font-bold"><?= $row['id'] ?></td>
                                <td class="p-8 font-black text-gray-800 text-lg uppercase italic"><?= $row['nama_tokoh'] ?></td>
                                <?php for ($i = 0; $i < $k_value; $i++) : ?>
                                    <td class="p-8 text-center text-xs font-bold text-gray-400"><?= number_format($row['distances'][$i], 4) ?></td>
                                <?php endfor; ?>
                                <td class="p-8 text-center">
                                    <div class="inline-block px-10 py-3 rounded-2xl font-black text-sm <?= $row['cluster'] == 0 ? 'bg-[#26CCC2] text-white' : ($row['cluster'] == 1 ? 'bg-[#FFB76C] text-white' : 'bg-[#FFF57E] text-[#1A1A1A]') ?> shadow-lg">
                                        CLUSTER <?= $row['cluster'] + 1 ?>
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

<div id="modalManualCalculation" class="fixed inset-0 z-50 hidden bg-[#1A1A1A]/95 backdrop-blur-md flex items-center justify-center p-4">
    <div class="bg-white rounded-[3rem] shadow-2xl w-full max-w-5xl h-[90vh] overflow-hidden border border-white animate-zoomIn flex flex-col">

        <div class="bg-[#FFF57E] p-8 text-[#1A1A1A] flex justify-between items-center shadow-lg relative z-10">
            <div>
                <h3 class="text-3xl font-black italic uppercase leading-none mb-1">Manual Calculation Log</h3>
                <p class="text-[11px] font-bold uppercase tracking-widest text-gray-600 italic">Simulasi Alur Perhitungan Iterasi Akhir</p>
            </div>
            <button onclick="closeModal('modalManualCalculation')" class="bg-[#1A1A1A] text-white w-12 h-12 rounded-full hover:scale-110 transition-all flex items-center justify-center text-2xl font-black shadow-lg">&times;</button>
        </div>

        <div class="p-10 overflow-y-auto custom-scrollbar flex-grow bg-[#F8FAFB]">
            <div class="space-y-12">

                <div class="bg-white p-10 rounded-[2.5rem] shadow-sm border border-gray-100 relative overflow-hidden">
                    <div class="absolute top-0 left-0 w-2 h-full bg-[#26CCC2]"></div>
                    <h4 class="text-xl font-black uppercase text-[#26CCC2] mb-6 flex items-center gap-3">
                        <span class="w-10 h-10 bg-[#26CCC2] text-white rounded-xl flex items-center justify-center">1</span>
                        Nilai Input Data (Contoh Tokoh Ke-1)
                    </h4>
                    <div class="grid grid-cols-2 md:grid-cols-5 gap-4">
                        <?php $d1 = $dataset_hasil[0];
                        $c1 = $centroids[0]; ?>
                        <div class="p-4 bg-gray-50 rounded-2xl text-center border-b-4 border-gray-200">
                            <p class="text-[9px] font-black text-gray-400 uppercase">Inst (x1)</p>
                            <p class="text-2xl font-black"><?= $d1['jenis_institusi'] ?></p>
                        </div>
                        <div class="p-4 bg-gray-50 rounded-2xl text-center border-b-4 border-gray-200">
                            <p class="text-[9px] font-black text-gray-400 uppercase">Lokasi (x2)</p>
                            <p class="text-2xl font-black"><?= $d1['lokasi_institusi'] ?></p>
                        </div>
                        <div class="p-4 bg-gray-50 rounded-2xl text-center border-b-4 border-gray-200">
                            <p class="text-[9px] font-black text-gray-400 uppercase">Pend (x3)</p>
                            <p class="text-2xl font-black"><?= $d1['pendidikan_terakhir'] ?></p>
                        </div>
                        <div class="p-4 bg-gray-50 rounded-2xl text-center border-b-4 border-gray-200">
                            <p class="text-[9px] font-black text-gray-400 uppercase">Prodi (x4)</p>
                            <p class="text-2xl font-black"><?= $d1['jurusan_prodi'] ?></p>
                        </div>
                        <div class="p-4 bg-gray-50 rounded-2xl text-center border-b-4 border-[#26CCC2]">
                            <p class="text-[9px] font-black text-gray-400 uppercase">Masa (x5)</p>
                            <p class="text-2xl font-black"><?= $d1['lama_selesai'] ?></p>
                        </div>
                    </div>
                </div>

                <div class="bg-white p-10 rounded-[2.5rem] shadow-sm border border-gray-100 relative overflow-hidden">
                    <div class="absolute top-0 left-0 w-2 h-full bg-[#FFB76C]"></div>
                    <h4 class="text-xl font-black uppercase text-[#FFB76C] mb-6 flex items-center gap-3">
                        <span class="w-10 h-10 bg-[#FFB76C] text-white rounded-xl flex items-center justify-center">2</span>
                        Hitung Jarak Euclidean (Ke Centroid 1)
                    </h4>
                    <div class="bg-[#1A1A1A] p-8 rounded-3xl text-white font-mono text-lg space-y-4 shadow-inner overflow-x-auto">
                        <p class="text-[#6AECE1]">d = &radic; [ (x1-c1)&sup2; + (x2-c2)&sup2; + (x3-c3)&sup2; + (x4-c4)&sup2; + (x5-c5)&sup2; ]</p>
                        <p>d = &radic; [
                            (<?= $d1['jenis_institusi'] ?> - <?= round($c1['jenis_institusi'], 2) ?>)&sup2; +
                            (<?= $d1['lokasi_institusi'] ?> - <?= round($c1['lokasi_institusi'], 2) ?>)&sup2; +
                            (<?= $d1['pendidikan_terakhir'] ?> - <?= round($c1['pendidikan_terakhir'], 2) ?>)&sup2; +
                            (<?= $d1['jurusan_prodi'] ?> - <?= round($c1['jurusan_prodi'], 2) ?>)&sup2; +
                            (<?= $d1['lama_selesai'] ?> - <?= round($c1['lama_selesai'], 2) ?>)&sup2;
                            ]</p>
                        <p class="text-2xl text-[#6AECE1] font-black">Hasil d = <?= number_format($d1['distances'][0], 4) ?></p>
                    </div>
                </div>

                <div class="bg-white p-10 rounded-[2.5rem] shadow-sm border border-gray-100 relative overflow-hidden">
                    <div class="absolute top-0 left-0 w-2 h-full bg-[#FFF57E]"></div>
                    <h4 class="text-xl font-black uppercase text-gray-800 mb-6 flex items-center gap-3">
                        <span class="w-10 h-10 bg-[#FFF57E] text-[#1A1A1A] rounded-xl flex items-center justify-center font-black">3</span>
                        Pembaruan Nilai Centroid Baru
                    </h4>
                    <p class="text-gray-500 font-medium mb-6 leading-relaxed">
                        Setelah semua data dikelompokkan, sistem menghitung rata-rata nilai variabel dari seluruh anggota dalam satu cluster untuk menjadi titik pusat (Centroid) baru bagi iterasi berikutnya.
                    </p>

                    <div class="bg-gray-50 p-8 rounded-[2rem] border-2 border-dashed border-gray-200 mb-8">
                        <div class="flex flex-col md:flex-row items-center justify-center gap-10">
                            <div class="text-center">
                                <p class="text-[10px] font-black text-gray-400 uppercase mb-2">Rumus Rata-rata Cluster</p>
                                <div class="bg-white px-8 py-4 rounded-2xl shadow-sm text-2xl font-serif italic border border-gray-100">
                                    V<sub>ij</sub> = &Sigma; X<sub>kj</sub> / n<sub>i</sub>
                                </div>
                            </div>
                            <div class="hidden md:block text-3xl text-gray-300">&rarr;</div>
                            <div class="space-y-2 text-sm font-bold text-gray-600">
                                <p><span class="w-2 h-2 inline-block bg-[#26CCC2] rounded-full mr-2"></span> &Sigma; X<sub>kj</sub> : Total Nilai Variabel j Anggota Cluster i</p>
                                <p><span class="w-2 h-2 inline-block bg-[#26CCC2] rounded-full mr-2"></span> n<sub>i</sub> : Jumlah Seluruh Anggota Cluster i</p>
                            </div>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div class="bg-white border border-gray-100 p-8 rounded-3xl shadow-sm">
                            <h5 class="text-xs font-black text-gray-400 uppercase tracking-widest mb-4">Contoh Update Centroid 1 (C1)</h5>
                            <?php
                            // Simulasi sederhana untuk tampilan: ambil 3 data pertama yang masuk cluster yang sama jika ada
                            $clusterCount = count(array_filter($dataset_hasil, fn($x) => $x['cluster'] == 0));
                            ?>
                            <ul class="space-y-3 text-sm font-medium text-gray-700">
                                <li class="flex justify-between border-b pb-2"><span>Jumlah Anggota Cluster 1 (n<sub>1</sub>)</span> <span class="font-black text-[#26CCC2]"><?= $clusterCount ?> Orang</span></li>
                                <li class="flex justify-between border-b pb-2"><span>Total Nilai Masa Studi (&Sigma;X<sub>k5</sub>)</span> <span class="font-black"><?= round($centroids[0]['lama_selesai'] * $clusterCount) ?></span></li>
                                <li class="flex justify-between pt-2"><span>Centroid Masa Studi Baru (v<sub>15</sub>)</span> <span class="font-black text-xl text-[#26CCC2]"><?= round($centroids[0]['lama_selesai'], 2) ?></span></li>
                            </ul>
                        </div>

                        <div class="bg-[#1A1A1A] p-8 rounded-3xl text-white">
                            <h5 class="text-xs font-black text-gray-500 uppercase tracking-widest mb-6">Centroid Final Semua Cluster</h5>
                            <div class="space-y-4">
                                <?php foreach ($centroids as $idx => $cen): ?>
                                    <div class="flex items-center gap-4">
                                        <span class="w-10 h-10 rounded-lg flex items-center justify-center font-black <?= $idx == 0 ? 'bg-[#26CCC2]' : 'bg-[#FFB76C]' ?>">C<?= $idx + 1 ?></span>
                                        <div class="text-[10px] font-mono grid grid-cols-5 gap-2 opacity-80">
                                            <span>I:<?= round($cen['jenis_institusi'], 1) ?></span>
                                            <span>L:<?= round($cen['lokasi_institusi'], 1) ?></span>
                                            <span>P:<?= round($cen['pendidikan_terakhir'], 1) ?></span>
                                            <span>J:<?= round($cen['jurusan_prodi'], 1) ?></span>
                                            <span class="text-[#FFF57E]">M:<?= round($cen['lama_selesai'], 1) ?></span>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>

                    <div class="mt-10 p-8 bg-[#1A1A1A] rounded-[2rem] text-center shadow-2xl">
                        <h5 class="text-white text-xl font-bold italic uppercase tracking-widest">
                            Iterasi Berhenti: Centroid <span class="text-[#FFF57E]">Sudah Stabil (Konvergen)</span>
                        </h5>
                    </div>
                </div>

            </div>
        </div>

        <div class="p-8 bg-gray-50 border-t border-gray-100 text-center">
            <button onclick="closeModal('modalManualCalculation')" class="text-gray-400 hover:text-red-500 font-black uppercase text-xs tracking-widest">Tutup Log Perhitungan</button>
        </div>
    </div>
</div>

<script>
    function openModal(id) {
        document.getElementById(id).classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    }

    function closeModal(id) {
        document.getElementById(id).classList.add('hidden');
        document.body.style.overflow = 'auto';
    }
</script>

<style>
    .custom-scrollbar::-webkit-scrollbar {
        width: 8px;
    }

    .custom-scrollbar::-webkit-scrollbar-track {
        background: #F1F1F1;
        border-radius: 10px;
    }

    .custom-scrollbar::-webkit-scrollbar-thumb {
        background: #26CCC2;
        border-radius: 10px;
    }

    @keyframes zoomIn {
        from {
            opacity: 0;
            transform: scale(0.95) translateY(20px);
        }

        to {
            opacity: 1;
            transform: scale(1) translateY(0);
        }
    }

    .animate-zoomIn {
        animation: zoomIn 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);
    }
</style>

<?= $this->endSection(); ?>