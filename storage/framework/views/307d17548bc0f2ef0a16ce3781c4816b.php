<?php if (isset($component)) { $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54 = $attributes; } ?>
<?php $component = App\View\Components\AppLayout::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('app-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\AppLayout::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?> <?php $__env->slot('header', null, []); ?> <h2 class="font-semibold text-xl text-gray-800">Category Form</h2> <?php $__env->endSlot(); ?><div class="max-w-2xl mx-auto px-4 py-8"><form method="POST" action="<?php echo e(isset($category) ? route('categories.update',$category) : route('categories.store')); ?>" class="bg-white p-6 rounded shadow space-y-4"><?php echo csrf_field(); ?> <?php if(isset($category)): ?> <?php echo method_field('PUT'); ?> <?php endif; ?><input name="name" value="<?php echo e(old('name',$category->name ?? '')); ?>" class="w-full border rounded p-2" placeholder="Name" required><input name="slug" value="<?php echo e(old('slug',$category->slug ?? '')); ?>" class="w-full border rounded p-2" placeholder="Slug"><button class="bg-gray-900 text-white px-4 py-2 rounded">Save</button></form></div> <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $attributes = $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $component = $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php /**PATH C:\Users\Admin\Downloads\blog_project\resources\views/categories/form.blade.php ENDPATH**/ ?>