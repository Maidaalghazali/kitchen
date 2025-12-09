<?php $__env->startSection('content'); ?>
    <h1 class="font-bold text-2xl text-gray-800 leading-tight mb-2 ml-10">
        Daftar Barang
    </h1>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">


            <!-- Search Bar & Tombol Tambah -->
            <div class="mb-6 flex flex-col md:flex-row gap-4 justify-between items-center">
                <!-- Search Form -->
                <form method="GET" action="<?php echo e(route('items.index')); ?>" class="w-full md:w-1/2">
                    <div class="relative">
                        <input type="text" name="search" value="<?php echo e($search ?? ''); ?>"
                            placeholder="🔍 Cari nama barang atau satuan..."
                            class="w-full px-4 py-2 pr-10 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                            autocomplete="off">

                        <?php if($search ?? false): ?>
                            <a href="<?php echo e(route('items.index')); ?>"
                                class="absolute right-10 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-gray-600"
                                title="Clear search">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                            </a>
                        <?php endif; ?>

                        <button type="submit"
                            class="absolute right-2 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-gray-600">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </button>
                    </div>
                </form>

                <div class="flex items-center">
                    <a href="<?php echo e(route('reports.index')); ?>" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded-lg whitespace-nowrap">
                        📊 Laporan
                    </a>
                </div>

                <!-- Tombol Tambah Barang -->
                <a href="<?php echo e(route('items.create')); ?>"
                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded-lg whitespace-nowrap">
                    + Tambah Barang
                </a>
            </div>

            <!-- Info Hasil Search -->
            <?php if($search ?? false): ?>
                <div class="mb-4 bg-blue-50 border border-blue-200 text-blue-700 px-4 py-3 rounded-lg">
                    Menampilkan hasil pencarian untuk: <strong>"<?php echo e($search); ?>"</strong>
                    <span class="text-sm ml-2">(<?php echo e($items->count()); ?> barang ditemukan)</span>
                </div>
            <?php endif; ?>

            <?php if(session('success')): ?>
                <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative"
                    role="alert">
                    <span class="block sm:inline"><?php echo e(session('success')); ?></span>
                </div>
            <?php endif; ?>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        No</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Nama Barang</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Satuan</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Stok Awal</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Penambahan</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Pengurangan</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Stok Akhir</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                <?php $__empty_1 = true; $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900"><?php echo e($loop->iteration); ?>

                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            <?php echo e($item->nama_barang); ?></td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900"><?php echo e($item->satuan); ?>

                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            <?php echo e($item->stok_awal); ?></td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-green-600">
                                            +<?php echo e($item->penambahan); ?></td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-red-600">
                                            -<?php echo e($item->pengurangan); ?></td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-gray-900">
                                            <?php echo e($item->stok_akhir); ?></td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                            <div class="flex space-x-2">
                                                <a href="<?php echo e(route('items.edit', $item)); ?>"
                                                    class="text-yellow-600 hover:text-yellow-900">Edit</a>
                                                <form action="<?php echo e(route('items.destroy', $item)); ?>" method="POST"
                                                    onsubmit="return confirm('Yakin ingin menghapus?');">
                                                    <?php echo csrf_field(); ?>
                                                    <?php echo method_field('DELETE'); ?>
                                                    <button type="submit"
                                                        class="text-red-600 hover:text-red-900">Hapus</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                    <tr>
                                        <td colspan="8" class="px-6 py-4 text-center text-sm text-gray-500">
                                            <?php if($search ?? false): ?>
                                                <div class="py-4">
                                                    <p class="text-gray-600 mb-2">Tidak ada barang yang cocok dengan
                                                        pencarian <strong>"<?php echo e($search); ?>"</strong></p>
                                                    <a href="<?php echo e(route('items.index')); ?>"
                                                        class="text-blue-500 hover:underline">
                                                        ← Tampilkan semua barang
                                                    </a>
                                                </div>
                                            <?php else: ?>
                                                Tidak ada data barang
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.public', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\inventory\resources\views/items/index.blade.php ENDPATH**/ ?>