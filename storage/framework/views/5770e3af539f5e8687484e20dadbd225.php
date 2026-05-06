<?php if (isset($component)) { $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54 = $attributes; } ?>
<?php $component = App\View\Components\AppLayout::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('app-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\AppLayout::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
     <?php $__env->slot('header', null, []); ?> <h2 class="font-semibold text-xl text-gray-800">Dashboard</h2> <?php $__env->endSlot(); ?>
    <div class="py-8 max-w-7xl mx-auto px-4 space-y-4">
        <div class="flex gap-3">
            <a href="<?php echo e(route('posts.create')); ?>" class="bg-gray-900 text-white px-4 py-2 rounded">Create Post</a>
            <a href="<?php echo e(route('categories.index')); ?>" class="bg-gray-700 text-white px-4 py-2 rounded">Categories</a>
            <a href="<?php echo e(route('tags.index')); ?>" class="bg-gray-700 text-white px-4 py-2 rounded">Tags</a>
        </div>
        <div class="bg-white shadow rounded">
            <table class="w-full text-left">
                <thead class="bg-gray-100"><tr><th class="p-3">Title</th><th class="p-3">Status</th><th class="p-3">Category</th><th class="p-3">Actions</th></tr></thead>
                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr class="border-t">
                            <td class="p-3"><?php echo e($post->title); ?></td>
                            <td class="p-3"><?php echo e(ucfirst($post->status)); ?></td>
                            <td class="p-3"><?php echo e($post->category->name); ?></td>
                            <td class="p-3 flex gap-2">
                                <a href="<?php echo e(route('posts.show',$post->slug)); ?>" class="text-blue-600">View</a>
                                <a href="<?php echo e(route('posts.edit',$post)); ?>" class="text-yellow-600">Edit</a>
                                <form method="POST" action="<?php echo e(route('posts.destroy',$post)); ?>"><?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?><button class="text-red-600" onclick="return confirm('Delete?')">Delete</button></form>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr><td class="p-3" colspan="4">No posts yet.</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
        <?php echo e($posts->links()); ?>

    </div>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $attributes = $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $component = $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php /**PATH C:\Users\Admin\Downloads\blog_project\resources\views/dashboard.blade.php ENDPATH**/ ?>