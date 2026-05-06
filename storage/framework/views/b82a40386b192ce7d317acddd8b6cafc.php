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
     <?php $__env->slot('header', null, []); ?> <h2 class="font-semibold text-xl text-gray-800"><?php echo e($post->title); ?></h2> <?php $__env->endSlot(); ?>
    <div class="max-w-7xl mx-auto px-4 py-8 grid lg:grid-cols-4 gap-6">
        <div class="lg:col-span-3 space-y-6">
            <article class="bg-white p-6 rounded shadow">
                <p class="text-sm text-gray-500"><?php echo e($post->category->name); ?> | <?php echo e($post->created_at->format('M d, Y')); ?> | By <?php echo e($post->user->name); ?></p>
                <?php if($post->featured_image): ?><img src="<?php echo e($post->featured_image); ?>" class="w-full h-72 object-cover rounded my-4" alt="<?php echo e($post->title); ?>"><?php endif; ?>
                <div class="prose max-w-none"><?php echo nl2br(e($post->content)); ?></div>
                <div class="mt-4 flex gap-2 flex-wrap"><?php $__currentLoopData = $post->tags; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tag): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><span class="bg-gray-200 px-2 py-1 rounded text-sm">#<?php echo e($tag->name); ?></span><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?></div>
                <?php if(auth()->guard()->check()): ?>
                    <?php if(auth()->id()===$post->user_id): ?>
                        <div class="mt-6 flex gap-3">
                            <a href="<?php echo e(route('posts.edit',$post)); ?>" class="bg-yellow-500 text-white px-4 py-2 rounded">Edit</a>
                            <form method="POST" action="<?php echo e(route('posts.destroy',$post)); ?>"><?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?><button class="bg-red-600 text-white px-4 py-2 rounded" onclick="return confirm('Delete this post?')">Delete</button></form>
                        </div>
                    <?php endif; ?>
                <?php endif; ?>
            </article>

            <section class="bg-white p-6 rounded shadow">
                <h3 class="font-bold text-lg mb-3">Comments</h3>
                <?php if(auth()->guard()->check()): ?>
                    <form method="POST" action="<?php echo e(route('comments.store')); ?>" class="mb-4"><?php echo csrf_field(); ?>
                        <input type="hidden" name="post_id" value="<?php echo e($post->id); ?>">
                        <textarea name="content" class="w-full border rounded p-2" rows="3" required></textarea>
                        <button class="mt-2 bg-gray-900 text-white px-4 py-2 rounded">Add Comment</button>
                    </form>
                <?php else: ?>
                    <p class="mb-4 text-sm">Please <a class="text-blue-600" href="<?php echo e(route('login')); ?>">login</a> to comment.</p>
                <?php endif; ?>
                <div class="space-y-4">
                    <?php $__empty_1 = true; $__currentLoopData = $post->comments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $comment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <div class="border-b pb-3">
                            <p class="text-sm text-gray-500"><?php echo e($comment->user->name); ?> | <?php echo e($comment->created_at->diffForHumans()); ?></p>
                            <p><?php echo e($comment->content); ?></p>
                            <?php if(auth()->guard()->check()): ?>
                                <?php if(auth()->id()===$comment->user_id || auth()->id()===$post->user_id || auth()->user()->email==='admin@example.com'): ?>
                                    <form method="POST" action="<?php echo e(route('comments.destroy',$comment)); ?>" class="mt-1"><?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?><button class="text-red-600 text-sm">Delete</button></form>
                                <?php endif; ?>
                            <?php endif; ?>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?> <p>No comments yet.</p> <?php endif; ?>
                </div>
            </section>

            <section class="bg-white p-6 rounded shadow">
                <h3 class="font-bold text-lg mb-3">Related Posts</h3>
                <div class="grid md:grid-cols-2 gap-4">
                    <?php $__empty_1 = true; $__currentLoopData = $relatedPosts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $related): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <a class="border rounded p-3 block hover:bg-gray-50" href="<?php echo e(route('posts.show',$related->slug)); ?>"><?php echo e($related->title); ?></a>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?> <p>No related posts found.</p> <?php endif; ?>
                </div>
            </section>
        </div>
        <aside class="bg-white p-5 rounded shadow h-fit">
            <h4 class="font-bold mb-3">Archive</h4>
            <ul class="space-y-2 text-sm"><?php $__currentLoopData = $archives; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $archive): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><li><a class="text-blue-600" href="<?php echo e(route('posts.archive',[$archive->year,$archive->month])); ?>"><?php echo e(\Carbon\Carbon::create($archive->year,$archive->month,1)->format('F Y')); ?> (<?php echo e($archive->post_count); ?>)</a></li><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?></ul>
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
<?php /**PATH C:\Users\Admin\Downloads\blog_project\resources\views/posts/show.blade.php ENDPATH**/ ?>