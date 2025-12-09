<?php $__env->startSection('content'); ?>

     <?php $__env->slot('header', null, []); ?> 
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Laporan Mingguan & Bulanan
        </h2>
     <?php $__env->endSlot(); ?>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <?php if(session('success')): ?>
                <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
                    <?php echo e(session('success')); ?>

                </div>
            <?php endif; ?>

            <!-- Filter -->
            <div class="bg-white shadow-sm sm:rounded-lg p-6 mb-6">
                <form method="GET" action="<?php echo e(route('reports.index')); ?>" class="flex flex-wrap gap-4">
                    <!-- Filter Tahun -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Tahun</label>
                        <select name="year"
                            class="border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200">
                            <?php for($y = now()->year; $y >= 2020; $y--): ?>
                                <option value="<?php echo e($y); ?>" <?php echo e($year == $y ? 'selected' : ''); ?>><?php echo e($y); ?>

                                </option>
                            <?php endfor; ?>
                        </select>
                    </div>

                    <!-- Filter Bulan -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Bulan</label>
                        <select name="month"
                            class="border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200">
                            <?php $__currentLoopData = [1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April', 5 => 'Mei', 6 => 'Juni', 7 => 'Juli', 8 => 'Agustus', 9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $m => $name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($m); ?>" <?php echo e($month == $m ? 'selected' : ''); ?>><?php echo e($name); ?>

                                </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>

                    <!-- Filter Barang -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Barang</label>
                        <select name="item_id"
                            class="border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200">
                            <option value="">Semua Barang</option>
                            <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($item->id); ?>" <?php echo e($item_id == $item->id ? 'selected' : ''); ?>>
                                    <?php echo e($item->nama_barang); ?>

                                </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>

                    <!-- Tombol -->
                    <div class="flex items-end gap-2">
                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Tampilkan
                        </button>
                        <a href="<?php echo e(route('reports.index')); ?>"
                            class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                            Reset
                        </a>
                    </div>
                </form>

                <!-- Tombol Regenerate -->
                <div class="mt-4 pt-4 border-t">
                    <form method="POST" action="<?php echo e(route('reports.regenerate')); ?>"
                        onsubmit="return confirm('Regenerate laporan? Data lama akan dihapus.')">
                        <?php echo csrf_field(); ?>
                        <input type="hidden" name="year" value="<?php echo e($year); ?>">
                        <input type="hidden" name="month" value="<?php echo e($month); ?>">
                        <input type="hidden" name="item_id" value="<?php echo e($item_id); ?>">
                        <button type="submit"
                            class="bg-yellow-500 hover:bg-yellow-600 text-white text-sm font-bold py-1 px-3 rounded">
                            🔄 Regenerate Laporan
                        </button>
                        <span class="text-xs text-gray-500 ml-2">Gunakan jika ada perubahan data transaksi</span>
                    </form>
                </div>
            </div>

            <!-- Summary Bulanan -->
            <?php if(!empty($monthlySummary)): ?>
                <div class="bg-white shadow-sm sm:rounded-lg p-6 mb-6">
                    <h3 class="text-lg font-semibold mb-4">📊 Ringkasan Bulanan -
                        <?php echo e(['', 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'][$month]); ?>

                        <?php echo e($year); ?></h3>

                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nama Barang
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Satuan</th>
                                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">Stok Awal
                                        Bulan</th>
                                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">Total
                                        Penambahan</th>
                                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">Total
                                        Pengurangan</th>
                                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">Stok Akhir
                                        Bulan</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                <?php $__currentLoopData = $monthlySummary; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $summary): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td class="px-6 py-4 text-sm font-medium text-gray-900">
                                            <?php echo e($summary['item']->nama_barang); ?></td>
                                        <td class="px-6 py-4 text-sm text-gray-500"><?php echo e($summary['item']->satuan); ?></td>
                                        <td class="px-6 py-4 text-sm text-right text-gray-900">
                                            <?php echo e($summary['stok_awal_bulan']); ?></td>
                                        <td class="px-6 py-4 text-sm text-right text-green-600 font-semibold">
                                            +<?php echo e($summary['total_penambahan']); ?></td>
                                        <td class="px-6 py-4 text-sm text-right text-red-600 font-semibold">
                                            -<?php echo e($summary['total_pengurangan']); ?></td>
                                        <td class="px-6 py-4 text-sm text-right font-bold text-blue-600">
                                            <?php echo e($summary['stok_akhir_bulan']); ?></td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            <?php endif; ?>

            <!-- Laporan Mingguan per Item -->
            <?php $__empty_1 = true; $__currentLoopData = $reportsByItem; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item_id => $reports): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <div class="bg-white shadow-sm sm:rounded-lg p-6 mb-6">
                    <h3 class="text-lg font-semibold mb-4">
                        📦 <?php echo e($reports->first()->item->nama_barang); ?> (<?php echo e($reports->first()->item->satuan); ?>)
                    </h3>

                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Minggu</th>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Periode</th>
                                    <th class="px-4 py-3 text-right text-xs font-medium text-gray-500 uppercase">Stok Awal
                                    </th>
                                    <th class="px-4 py-3 text-right text-xs font-medium text-gray-500 uppercase">Penambahan
                                    </th>
                                    <th class="px-4 py-3 text-right text-xs font-medium text-gray-500 uppercase">Pengurangan
                                    </th>
                                    <th class="px-4 py-3 text-right text-xs font-medium text-gray-500 uppercase">Stok Akhir
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                <?php $__currentLoopData = $reports; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $report): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr class="<?php echo e($loop->last ? 'bg-blue-50 font-semibold' : ''); ?>">
                                        <td class="px-4 py-3 text-sm">Minggu <?php echo e($report->week); ?></td>
                                        <td class="px-4 py-3 text-sm">
                                            <?php echo e($report->start_date->format('d M')); ?> -
                                            <?php echo e($report->end_date->format('d M Y')); ?>

                                        </td>
                                        <td class="px-4 py-3 text-sm text-right"><?php echo e($report->stok_awal); ?></td>
                                        <td class="px-4 py-3 text-sm text-right text-green-600">
                                            +<?php echo e($report->total_penambahan); ?></td>
                                        <td class="px-4 py-3 text-sm text-right text-red-600">
                                            -<?php echo e($report->total_pengurangan); ?></td>
                                        <td class="px-4 py-3 text-sm text-right font-bold"><?php echo e($report->stok_akhir); ?></td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <div class="bg-white shadow-sm sm:rounded-lg p-6 text-center text-gray-500">
                    Tidak ada data laporan untuk periode ini
                </div>
            <?php endif; ?>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.public', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\inventory\resources\views/reports/index.blade.php ENDPATH**/ ?>