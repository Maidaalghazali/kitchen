<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Inventory System</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
    <nav class="bg-white border-b p-4">
        <div class="container mx-auto flex justify-between">
            <a href="<?php echo e(route('items.index')); ?>" class="text-xl font-bold">📦 Inventory</a>
            <?php if(auth()->guard()->check()): ?>
                <div>
                    <span><?php echo e(Auth::user()->name); ?> (<?php echo e(Auth::user()->role); ?>)</span>
                    <form method="POST" action="<?php echo e(route('logout')); ?>" class="inline ml-4">
                        <?php echo csrf_field(); ?>
                        <button type="submit" class="underline">Logout</button>
                    </form>
                </div>
            <?php endif; ?>
        </div>
    </nav>

    <main class="container mx-auto py-8">
        <?php echo $__env->yieldContent('content'); ?>
    </main>
</body>
</html>
<?php /**PATH C:\laragon\www\inventory\resources\views/layouts/public.blade.php ENDPATH**/ ?>