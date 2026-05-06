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
     <?php $__env->slot('header', null, []); ?> 
        <div class="flex flex-col gap-2">
            <p class="text-sm uppercase tracking-[0.2em] text-slate-500">Editorial</p>
            <h2 class="font-semibold text-3xl text-slate-900">Latest Posts</h2>
        </div>
     <?php $__env->endSlot(); ?>
    <div class="max-w-7xl mx-auto px-4 py-10 grid lg:grid-cols-4 gap-8">
        <div class="lg:col-span-3 space-y-6">
            <?php if(session('success')): ?><div class="bg-emerald-50 border border-emerald-200 text-emerald-700 p-3 rounded-xl"><?php echo e(session('success')); ?></div><?php endif; ?>
            <?php $__empty_1 = true; $__currentLoopData = $posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <article class="surface-card p-6">
                    <div class="flex flex-wrap items-center gap-2 text-xs text-slate-500 uppercase tracking-wider">
                        <span><?php echo e($post->category->name); ?></span>
                        <span>•</span>
                        <span><?php echo e($post->created_at->format('M d, Y')); ?></span>
                    </div>
                    <h3 class="text-2xl font-bold text-slate-900 mt-2 leading-tight">
                        <a class="hover:text-slate-700 transition-colors" href="<?php echo e(route('posts.show',$post->slug)); ?>"><?php echo e($post->title); ?></a>
                    </h3>
                    <p class="text-sm text-slate-500 mt-2">By <?php echo e($post->user->name); ?> | <?php echo e(ucfirst($post->status)); ?></p>
                    <p class="mt-4 text-slate-700 leading-7"><?php echo e(\Illuminate\Support\Str::limit($post->content, 180)); ?></p>
                </article>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <div class="surface-card p-6">No posts found.</div>
            <?php endif; ?>
            <?php echo e($posts->links()); ?>

        </div>
        <aside class="surface-card p-5 h-fit sticky top-24">
            <h4 class="font-bold mb-4 text-slate-900">Archive</h4>
            <ul class="space-y-2 text-sm">
                <?php $__empty_1 = true; $__currentLoopData = $archives; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $archive): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <li><a class="soft-link" href="<?php echo e(route('posts.archive',[$archive->year,$archive->month])); ?>"><?php echo e(\Carbon\Carbon::create($archive->year,$archive->month,1)->format('F Y')); ?> (<?php echo e($archive->post_count); ?>)</a></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <li>No archive yet.</li>
                <?php endif; ?>
            </ul>
        </aside>
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
<?php /**PATH C:\Users\Admin\Downloads\blog_project\resources\views/posts/index.blade.php ENDPATH**/ ?>