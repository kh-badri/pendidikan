<?= $this->extend('layout/layout'); ?>
<?= $this->section('content'); ?>

<?php
$institusi_map  = [1 => 'NEGERI', 2 => 'SWASTA'];
$lokasi_map     = [1 => 'DALAM NEGERI', 2 => 'LUAR NEGERI'];
$pendidikan_map = [1 => 'SMA', 2 => 'D3', 3 => 'S1', 4 => 'S2', 5 => 'S3'];
$prodi_map      = [
    1 => 'Agama',
    2 => 'Sosial',
    3 => 'Ekonomi',
    4 => 'Hukum',
    5 => 'Teknik',
    6 => 'Pendidikan',
    7 => 'Kesehatan',
    8 => 'Pertanian',
    9 => 'Seni/Lainnya'
];
?>

<div class="min-h-screen bg-[#F8FAFB] py-12 px-6 font-sans text-[#1A1A1A]">
    <div class="container mx-auto max-w-7xl">

        <!-- HEADER -->
        <div class="flex flex-col md:flex-row justify-between items-start mb-10 gap-6">
            <div>
                <div class="flex items-center gap-3 mb-2">
                    <span class="w-12 h-1 bg-[#26CCC2] rounded-full"></span>
                    <span class="text-[#26CCC2] font-bold tracking-widest text-[10px] uppercase">Pola Latar Belakang Tokoh Sukses - Clustering K-Means</span>
                </div>
                <h1 class="text-4xl md:text-5xl font-black tracking-tight uppercase">Hasil <span class="text-gray-400">Analisis</span></h1>
                <p class="text-gray-500 mt-2 font-medium italic">Perhitungan matematis berbasis Euclidean Distance sesuai standarisasi acuan skripsi.</p>
            </div>

            <div class="bg-white border-2 border-[#26CCC2] p-5 rounded-[2rem] shadow-xl shadow-[#26CCC2]/10 max-w-sm w-full">
                <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-2 text-center">Persamaan Euclidean Distance</p>
                <div class="bg-[#F8FAFB] p-3.5 rounded-2xl text-center border border-gray-100">
                    <div class="text-sm md:text-base font-serif italic text-gray-800 font-bold">
                        d = &radic; [ &Sigma; (x<sub>i</sub> - y<sub>i</sub>)<sup>2</sup> ]
                    </div>
                </div>
                <p class="text-[10px] text-gray-400 text-center mt-2 italic">d = &radic;[(a1-a2)&sup2; + (b1-b2)&sup2; + (c1-c2)&sup2; + (d1-d2)&sup2; + (e1-e2)&sup2;]</p>
            </div>
        </div>

        <!-- COMPONENT 1: CARD TITIK PUSAT KLASTER ACUAN (CENTROID SKRIPSI) -->
        <div class="bg-white rounded-[2.5rem] p-8 mb-10 shadow-xl shadow-gray-200/50 border border-white relative overflow-hidden">
            <div class="flex flex-col md:flex-row md:items-center justify-between pb-5 mb-5 border-b border-gray-100 gap-4">
                <div>
                    <div class="flex items-center gap-2 mb-1">
                        <span class="px-3 py-0.5 rounded-full bg-[#FFF57E] text-[#1A1A1A] font-black text-[10px] tracking-wider uppercase">Tabel Acuan Skripsi</span>
                        <span class="text-xs text-gray-400 font-bold">• Nilai Centroid Yang Ditentukan</span>
                    </div>
                    <h3 class="text-xl md:text-2xl font-black uppercase tracking-tight text-gray-800">Titik Pusat Klaster Acuan (Centroid)</h3>
                </div>
                <div class="text-xs text-gray-400 font-medium">
                    <span class="font-bold text-gray-600">A</span>: Inst &bull; <span class="font-bold text-gray-600">B</span>: Pend &bull; <span class="font-bold text-gray-600">C</span>: Prodi &bull; <span class="font-bold text-gray-600">D</span>: Lama &bull; <span class="font-bold text-gray-600">E</span>: Lokasi
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                <?php
                $centroidColors = [
                    0 => ['border' => 'border-[#26CCC2]', 'badge' => 'bg-[#26CCC2] text-white', 'code' => 'C1'],
                    1 => ['border' => 'border-[#FFB76C]', 'badge' => 'bg-[#FFB76C] text-white', 'code' => 'C2'],
                    2 => ['border' => 'border-purple-400', 'badge' => 'bg-purple-600 text-white', 'code' => 'C3'],
                ];
                foreach ($centroids as $idx => $c):
                    $color = $centroidColors[$idx] ?? ['border' => 'border-gray-300', 'badge' => 'bg-gray-800 text-white', 'code' => 'C' . ($idx + 1)];
                ?>
                    <div class="bg-[#F8FAFB] rounded-2xl p-5 border-2 <?= $color['border'] ?> relative">
                        <div class="flex items-center justify-between mb-3">
                            <span class="px-3 py-1 rounded-xl font-black text-xs <?= $color['badge'] ?>">Cluster <?= $idx + 1 ?> (<?= $color['code'] ?>)</span>
                            <span class="text-[11px] font-bold text-gray-400 uppercase">Centroid <?= $color['code'] ?></span>
                        </div>
                        <div class="grid grid-cols-5 gap-1.5 text-center mt-3 font-mono">
                            <div class="p-2 bg-white rounded-xl border border-gray-100">
                                <span class="text-[9px] text-gray-400 block font-bold">A (Inst)</span>
                                <span class="text-sm font-black text-gray-800"><?= $c['jenis_institusi'] ?></span>
                            </div>
                            <div class="p-2 bg-white rounded-xl border border-gray-100">
                                <span class="text-[9px] text-gray-400 block font-bold">B (Pend)</span>
                                <span class="text-sm font-black text-gray-800"><?= $c['pendidikan_terakhir'] ?></span>
                            </div>
                            <div class="p-2 bg-white rounded-xl border border-gray-100">
                                <span class="text-[9px] text-gray-400 block font-bold">C (Prodi)</span>
                                <span class="text-sm font-black text-gray-800"><?= $c['jurusan_prodi'] ?></span>
                            </div>
                            <div class="p-2 bg-white rounded-xl border border-gray-100">
                                <span class="text-[9px] text-gray-400 block font-bold">D (Lama)</span>
                                <span class="text-sm font-black text-gray-800"><?= $c['lama_selesai'] ?></span>
                            </div>
                            <div class="p-2 bg-white rounded-xl border border-gray-100">
                                <span class="text-[9px] text-gray-400 block font-bold">E (Lokasi)</span>
                                <span class="text-sm font-black text-gray-800"><?= $c['lokasi_institusi'] ?></span>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

        <!-- COMPONENT 2: HIGHLIGHT HASIL PREDIKSI DATA TOKOH BARU -->
        <div class="bg-gradient-to-br from-[#1A1A1A] to-[#2D2D2D] text-white rounded-[3.5rem] p-8 md:p-10 mb-10 shadow-2xl relative overflow-hidden border-4 border-white">
            <div class="absolute top-0 right-0 w-48 h-48 bg-[#26CCC2] rounded-bl-[10rem] opacity-20 -mr-10 -mt-10"></div>

            <div class="relative z-10 grid grid-cols-1 md:grid-cols-3 gap-8 items-center">
                <div class="md:col-span-2">
                    <span class="bg-[#26CCC2] text-white px-5 py-1.5 rounded-full font-black text-[10px] uppercase tracking-widest">Sampel Data Baru Teruji</span>
                    <h2 class="text-3xl md:text-4xl font-black uppercase italic tracking-tight mt-3 mb-2 text-[#FFF57E]">
                        <?= esc($data_baru['nama_tokoh']) ?>
                    </h2>
                    <p class="text-gray-300 font-medium text-xs md:text-sm leading-relaxed max-w-2xl">
                        Berdasarkan perhitungan persamaan Euclidean Distance terhadap titik pusat klaster acuan, sampel tokoh ini memiliki jarak terdekat dan diklasifikasikan ke dalam:
                    </p>

                    <!-- Parameter preview (A, B, C, D, E) -->
                    <div class="flex flex-wrap gap-2 mt-5 font-mono text-[11px] text-gray-300">
                        <span class="bg-white/10 px-3 py-1.5 rounded-xl border border-white/10"><strong>A (Inst):</strong> <?= $data_baru['jenis_institusi'] ?> (<?= $institusi_map[$data_baru['jenis_institusi']] ?? $data_baru['jenis_institusi'] ?>)</span>
                        <span class="bg-white/10 px-3 py-1.5 rounded-xl border border-white/10"><strong>B (Pend):</strong> <?= $data_baru['pendidikan_terakhir'] ?> (<?= $pendidikan_map[$data_baru['pendidikan_terakhir']] ?? $data_baru['pendidikan_terakhir'] ?>)</span>
                        <span class="bg-white/10 px-3 py-1.5 rounded-xl border border-white/10"><strong>C (Prodi):</strong> <?= $data_baru['jurusan_prodi'] ?> (<?= $prodi_map[$data_baru['jurusan_prodi']] ?? $data_baru['jurusan_prodi'] ?>)</span>
                        <span class="bg-white/10 px-3 py-1.5 rounded-xl border border-white/10"><strong>D (Masa):</strong> <?= $data_baru['lama_selesai'] ?> Thn</span>
                        <span class="bg-white/10 px-3 py-1.5 rounded-xl border border-white/10"><strong>E (Lokasi):</strong> <?= $data_baru['lokasi_institusi'] ?> (<?= $lokasi_map[$data_baru['lokasi_institusi']] ?? $data_baru['lokasi_institusi'] ?>)</span>
                    </div>

                    <!-- Perbandingan Nilai Jarak -->
                    <div class="mt-4 flex flex-wrap gap-3 font-mono text-xs">
                        <?php foreach ($centroids as $idx => $c): ?>
                            <span class="bg-white/5 border border-white/10 px-3 py-1 rounded-lg text-gray-300">
                                Jarak C<?= $idx + 1 ?>: <strong class="text-white"><?= number_format($data_baru['distances'][$idx], 2) ?></strong>
                            </span>
                        <?php endforeach; ?>
                    </div>
                </div>

                <!-- Hasil Badge Besar -->
                <div class="text-center md:text-right">
                    <div class="inline-block bg-[#FFF57E] text-[#1A1A1A] px-10 py-3.5 rounded-[2.5rem] font-black text-xl uppercase tracking-wider shadow-2xl border-4 border-white animate-pulse mb-2">
                        CLUSTERING <?= $data_baru['cluster_prediksi'] + 1 ?> (C<?= $data_baru['cluster_prediksi'] + 1 ?>)
                    </div>
                    <br>
                    <div class="inline-block bg-[#26CCC2] text-white px-8 py-2.5 rounded-[2rem] font-black text-sm uppercase tracking-wider shadow-xl border-2 border-white">
                        Jarak Terdekat: <?= number_format(min($data_baru['distances']), 2) ?>
                    </div>
                    <p class="text-[11px] font-bold text-gray-400 uppercase tracking-widest mt-3 text-center md:text-right mr-2">
                        Hasil Klasifikasi Minimum Distance
                    </p>
                </div>
            </div>
        </div>

        <!-- BUTTON ACTIONS -->
        <div class="mb-10 flex flex-wrap justify-center gap-4">
            <button onclick="openModal('modalManualCalculation')" class="bg-[#26CCC2] hover:bg-[#1da8a0] text-white px-9 py-4 rounded-[2rem] font-black shadow-xl shadow-[#26CCC2]/30 transition-all transform hover:-translate-y-1 active:scale-95 text-base uppercase tracking-widest flex items-center gap-3">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                </svg>
                Lihat Langkah Perhitungan Manual
            </button>

            <form action="<?= base_url('prediksi/simpan') ?>" method="post">
                <?= csrf_field() ?>
                <input type="hidden" name="k_value" value="<?= $k_value ?>">
                <input type="hidden" name="iterasi" value="<?= $iterasi_ke ?>">
                <input type="hidden" name="detail_json" value='<?= esc($detail_json) ?>'>
                <button type="submit" class="bg-[#FFB76C] hover:bg-[#ff9d36] text-white px-9 py-4 rounded-[2rem] font-black shadow-xl shadow-[#FFB76C]/30 transition-all transform hover:-translate-y-1 active:scale-95 text-base uppercase tracking-widest flex items-center gap-3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4" />
                    </svg>
                    Simpan Prediksi & History
                </button>
            </form>
        </div>

        <!-- TABEL DATASET UTAMA (TABEL 4.4 SKRIPSI) -->
        <div class="bg-white rounded-[3rem] shadow-2xl shadow-gray-200/60 overflow-hidden border border-white">
            <div class="p-8 border-b border-gray-100 flex flex-col md:flex-row justify-between md:items-center bg-[#F8FAFB]/50 gap-4">
                <div>
                    <div class="flex items-center gap-2 mb-1">
                        <span class="px-3 py-0.5 rounded-full bg-[#FFF57E] text-[#1A1A1A] font-black text-[10px] uppercase">Tabel 4.4 Skripsi</span>
                        <span class="text-xs text-gray-400 font-bold">• Hasil Pengelompokan Clustering</span>
                    </div>
                    <h3 class="font-black text-2xl uppercase tracking-tighter text-gray-800">Tabel Hasil Pengelompokan Dataset</h3>
                    <p class="text-xs text-gray-400 font-bold mt-0.5">Nilai jarak C1, C2, C3 dan keputusan klaster setiap sampel dataset tokoh.</p>
                </div>
                <span class="bg-[#FFF57E] px-5 py-2 rounded-full font-black text-xs uppercase border border-white self-start md:self-auto">Total: <?= count($dataset_hasil) ?> Sampel Tokoh</span>
            </div>

            <div class="overflow-x-auto h-[550px] custom-scrollbar">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-white sticky top-0 z-10 border-b border-gray-100 text-center">
                            <th class="p-4 text-gray-400 font-bold uppercase text-[10px] tracking-widest">No</th>
                            <th class="p-4 text-gray-800 font-black uppercase text-xs tracking-widest text-left">Nama Tokoh Dataset</th>
                            <?php for ($i = 1; $i <= $k_value; $i++) : ?>
                                <th class="p-4 text-gray-600 font-black uppercase text-xs tracking-widest">C<?= $i ?></th>
                            <?php endfor; ?>
                            <th class="p-4 text-gray-800 font-black uppercase text-xs tracking-widest">Cluster</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50 text-center">
                        <?php foreach ($dataset_hasil as $idx => $row) : ?>
                            <tr class="hover:bg-gray-50/80 transition-colors">
                                <td class="p-4 text-gray-400 font-bold text-xs"><?= $idx + 1 ?></td>
                                <td class="p-4 font-black text-gray-800 text-sm text-left">
                                    <span class="block"><?= esc($row['nama_tokoh']) ?></span>
                                    <span class="text-[10px] text-gray-400 font-mono font-normal">
                                        (<?= $row['jenis_institusi'] ?>, <?= $row['pendidikan_terakhir'] ?>, <?= $row['jurusan_prodi'] ?>, <?= $row['lama_selesai'] ?>, <?= $row['lokasi_institusi'] ?>)
                                    </span>
                                </td>
                                <?php for ($i = 0; $i < $k_value; $i++) :
                                    $isMin = ($row['cluster'] === $i);
                                ?>
                                    <td class="p-4 text-sm font-mono font-bold <?= $isMin ? 'text-[#0fa89f] font-black' : 'text-gray-500' ?>">
                                        <span class="<?= $isMin ? 'bg-[#26CCC2]/10 px-2.5 py-1 rounded-lg border border-[#26CCC2]/30' : '' ?>">
                                            <?= number_format($row['distances'][$i], 2) ?>
                                        </span>
                                    </td>
                                <?php endfor; ?>
                                <td class="p-4">
                                    <div class="inline-block px-4 py-1.5 rounded-xl font-black text-xs <?= $row['cluster'] == 0 ? 'bg-[#26CCC2] text-white' : ($row['cluster'] == 1 ? 'bg-[#FFB76C] text-white' : 'bg-[#FFF57E] text-[#1A1A1A]') ?> shadow-sm">
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

<!-- MODAL PERHITUNGAN LOG PREDIKSI DATA BARU SESUAI PERSAMAAN SKRIPSI -->
<div id="modalManualCalculation" class="fixed inset-0 z-50 hidden bg-[#1A1A1A]/95 backdrop-blur-md flex items-center justify-center p-4">
    <div class="bg-white rounded-[3rem] shadow-2xl w-full max-w-4xl h-[90vh] overflow-hidden border border-white animate-zoomIn flex flex-col">

        <div class="bg-[#FFF57E] p-6 md:p-8 text-[#1A1A1A] flex justify-between items-center shadow-lg relative z-10">
            <div>
                <h3 class="text-2xl md:text-3xl font-black italic uppercase leading-none mb-1">Perhitungan Manual Euclidean Distance</h3>
                <p class="text-[11px] font-bold uppercase tracking-widest text-gray-700">Persamaan Matematis Sesuai Rumus Skripsi</p>
            </div>
            <button onclick="closeModal('modalManualCalculation')" class="bg-[#1A1A1A] text-white w-10 h-10 rounded-full hover:scale-110 transition-all flex items-center justify-center text-xl font-black shadow-lg">&times;</button>
        </div>

        <div class="p-6 md:p-10 overflow-y-auto custom-scrollbar flex-grow bg-[#F8FAFB]">
            <div class="space-y-8">

                <!-- STEP 1: VARIABEL NILAI INPUT -->
                <div class="bg-white p-6 md:p-8 rounded-[2rem] shadow-sm border border-gray-100 relative overflow-hidden">
                    <div class="absolute top-0 left-0 w-2 h-full bg-[#26CCC2]"></div>
                    <div class="flex items-center gap-2 mb-4">
                        <span class="w-8 h-8 bg-[#26CCC2] text-white rounded-xl flex items-center justify-center font-black text-sm">1</span>
                        <h4 class="text-lg font-black uppercase text-gray-800">
                            Nilai Parameter Sampel Tokoh Baru: <span class="text-[#26CCC2]"><?= esc($data_baru['nama_tokoh']) ?></span>
                        </h4>
                    </div>
                    <div class="grid grid-cols-2 md:grid-cols-5 gap-3 font-mono text-center">
                        <div class="p-3 bg-gray-50 rounded-xl border border-gray-100">
                            <p class="text-[9px] font-black text-gray-400 uppercase">A (Institusi)</p>
                            <p class="text-xl font-black text-gray-800"><?= $data_baru['jenis_institusi'] ?></p>
                            <p class="text-[10px] text-gray-500 font-sans"><?= $institusi_map[$data_baru['jenis_institusi']] ?? '' ?></p>
                        </div>
                        <div class="p-3 bg-gray-50 rounded-xl border border-gray-100">
                            <p class="text-[9px] font-black text-gray-400 uppercase">B (Pendidikan)</p>
                            <p class="text-xl font-black text-gray-800"><?= $data_baru['pendidikan_terakhir'] ?></p>
                            <p class="text-[10px] text-gray-500 font-sans"><?= $pendidikan_map[$data_baru['pendidikan_terakhir']] ?? '' ?></p>
                        </div>
                        <div class="p-3 bg-gray-50 rounded-xl border border-gray-100">
                            <p class="text-[9px] font-black text-gray-400 uppercase">C (Prodi)</p>
                            <p class="text-xl font-black text-gray-800"><?= $data_baru['jurusan_prodi'] ?></p>
                            <p class="text-[10px] text-gray-500 font-sans"><?= $prodi_map[$data_baru['jurusan_prodi']] ?? '' ?></p>
                        </div>
                        <div class="p-3 bg-gray-50 rounded-xl border border-gray-100">
                            <p class="text-[9px] font-black text-gray-400 uppercase">D (Lama Pendidikan)</p>
                            <p class="text-xl font-black text-gray-800"><?= $data_baru['lama_selesai'] ?></p>
                            <p class="text-[10px] text-gray-500 font-sans"><?= $data_baru['lama_selesai'] ?> Tahun</p>
                        </div>
                        <div class="p-3 bg-gray-50 rounded-xl border border-gray-100">
                            <p class="text-[9px] font-black text-gray-400 uppercase">E (Lokasi Institusi)</p>
                            <p class="text-xl font-black text-gray-800"><?= $data_baru['lokasi_institusi'] ?></p>
                            <p class="text-[10px] text-gray-500 font-sans"><?= $lokasi_map[$data_baru['lokasi_institusi']] ?? '' ?></p>
                        </div>
                    </div>
                </div>

                <!-- STEP 2: PERHITUNGAN DETAIL PERSAMAAN EUCLIDEAN DISTANCE -->
                <div class="bg-white p-6 md:p-8 rounded-[2rem] shadow-sm border border-gray-100 relative overflow-hidden">
                    <div class="absolute top-0 left-0 w-2 h-full bg-[#FFB76C]"></div>
                    <div class="flex items-center gap-2 mb-2">
                        <span class="w-8 h-8 bg-[#FFB76C] text-white rounded-xl flex items-center justify-center font-black text-sm">2</span>
                        <h4 class="text-lg font-black uppercase text-gray-800">
                            Perhitungan Jarak Menggunakan Persamaan Euclidean Distance:
                        </h4>
                    </div>
                    <p class="text-xs text-gray-500 font-mono mb-4 pl-10">
                        Rumus: d = &radic;( ( a1 - a2 )&sup2; + ( b1 - b2 )&sup2; + ( c1 - c2 )&sup2; + ( d1 - d2 )&sup2; + ( e1 - e2 )&sup2; )
                    </p>

                    <div class="space-y-4">
                        <?php
                        $clusterNames = ['C1', 'C2', 'C3'];
                        foreach ($centroids as $index => $c) :
                            $lh = $data_baru['langkah_hitung'][$index] ?? null;
                            $cName = $clusterNames[$index] ?? ('C' . ($index + 1));
                            $cCoord = "A={$c['jenis_institusi']}, B={$c['pendidikan_terakhir']}, C={$c['jurusan_prodi']}, D={$c['lama_selesai']}, E={$c['lokasi_institusi']}";
                        ?>
                            <div class="bg-[#1A1A1A] p-5 rounded-2xl text-white font-mono text-xs shadow-inner space-y-2">
                                <div class="flex flex-wrap items-center justify-between border-b border-white/10 pb-2 gap-2">
                                    <span class="text-[#FFF57E] font-black text-sm uppercase">Jarak Ke &ndash; <?= $cName ?> :</span>
                                    <span class="text-[11px] text-gray-400 bg-white/10 px-2.5 py-0.5 rounded-lg">(Centroid: <?= $cCoord ?>)</span>
                                </div>
                                <div class="text-gray-300 leading-relaxed space-y-1 pt-1 font-mono">
                                    <p class="text-gray-400">
                                        d = &radic;( ( <?= $data_baru['jenis_institusi'] ?> - <?= $c['jenis_institusi'] ?> )&sup2; + ( <?= $data_baru['pendidikan_terakhir'] ?> - <?= $c['pendidikan_terakhir'] ?> )&sup2; + ( <?= $data_baru['jurusan_prodi'] ?> - <?= $c['jurusan_prodi'] ?> )&sup2; + ( <?= $data_baru['lama_selesai'] ?> - <?= $c['lama_selesai'] ?> )&sup2; + ( <?= $data_baru['lokasi_institusi'] ?> - <?= $c['lokasi_institusi'] ?> )&sup2; )
                                    </p>
                                    <?php if ($lh): ?>
                                        <p>
                                            &nbsp; = ( <?= $lh['diff']['a'] ?> )&sup2; + ( <?= $lh['diff']['b'] ?> )&sup2; + ( <?= $lh['diff']['c'] ?> )&sup2; + ( <?= $lh['diff']['d'] ?> )&sup2; + ( <?= $lh['diff']['e'] ?> )&sup2;
                                        </p>
                                        <p>
                                            &nbsp; = <?= $lh['sq']['a'] ?> + <?= $lh['sq']['b'] ?> + <?= $lh['sq']['c'] ?> + <?= $lh['sq']['d'] ?> + <?= $lh['sq']['e'] ?>
                                        </p>
                                        <p>
                                            &nbsp; = <?= $lh['sum'] ?>
                                        </p>
                                        <p class="text-sm font-black text-[#6AECE1] pt-1">
                                            d = &radic;<?= $lh['sum'] ?> = <?= number_format($lh['dist'], 2) ?>
                                            <span class="text-[10px] text-gray-400 font-normal ml-2">(Nilai eksak: <?= number_format($lh['dist'], 4) ?>)</span>
                                        </p>
                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>

                <!-- STEP 3: KESIMPULAN KEPUTUSAN K-MEANS -->
                <div class="bg-white p-6 md:p-8 rounded-[2rem] shadow-sm border border-gray-100 relative overflow-hidden">
                    <div class="absolute top-0 left-0 w-2 h-full bg-[#FFF57E]"></div>
                    <div class="flex items-center gap-2 mb-2">
                        <span class="w-8 h-8 bg-[#FFF57E] text-[#1A1A1A] rounded-xl flex items-center justify-center font-black text-sm">3</span>
                        <h4 class="text-lg font-black uppercase text-gray-800">
                            Kesimpulan Keputusan Klasifikasi Klaster
                        </h4>
                    </div>
                    <p class="text-gray-600 text-xs md:text-sm leading-relaxed pl-10">
                        Berdasarkan algoritma K-Means, data sampel masuk ke dalam cluster yang memiliki nilai jarak Euclidean paling <strong>MINIMUM / TERKECIL</strong>.
                    </p>
                    <div class="mt-4 p-5 bg-[#F8FAFB] rounded-2xl border border-gray-200 flex flex-wrap justify-between items-center gap-4">
                        <div>
                            <p class="text-xs font-bold text-gray-400 uppercase">Jarak Minimum Terpilih:</p>
                            <p class="text-lg font-mono font-black text-gray-800 mt-0.5">
                                Min(<?= implode(', ', array_map(fn($v) => number_format($v, 2), $data_baru['distances'])) ?>) = <span class="text-[#26CCC2]"><?= number_format(min($data_baru['distances']), 2) ?></span>
                            </p>
                        </div>
                        <div class="bg-[#1A1A1A] text-white font-black px-6 py-3 rounded-2xl text-xs uppercase tracking-wider text-right">
                            <span class="text-gray-400 block text-[10px]">Keputusan Akhir:</span>
                            <span class="text-[#FFF57E] text-sm">Masuk ke Cluster C<?= $data_baru['cluster_prediksi'] + 1 ?></span>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <div class="p-6 bg-gray-50 border-t border-gray-100 text-center">
            <button onclick="closeModal('modalManualCalculation')" class="text-gray-500 hover:text-red-500 font-black uppercase text-xs tracking-widest transition-colors">Tutup Log Perhitungan</button>
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
        width: 6px;
        height: 6px;
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

    @keyframes zoomIn {
        from {
            opacity: 0;
            transform: scale(0.97) translateY(10px);
        }

        to {
            opacity: 1;
            transform: scale(1) translateY(0);
        }
    }

    .animate-zoomIn {
        animation: zoomIn 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
    }
</style>

<?= $this->endSection(); ?>