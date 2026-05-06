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
     <?php $__env->slot('header', null, []); ?> <h2 class="font-semibold text-xl text-gray-800"><?php echo e(isset($post) ? 'Edit Post' : 'Create Post'); ?></h2> <?php $__env->endSlot(); ?>
    <div class="max-w-4xl mx-auto px-4 py-8">
        <form method="POST" action="<?php echo e(isset($post) ? route('posts.update',$post) : route('posts.store')); ?>" class="bg-white p-6 rounded shadow space-y-4">
            <?php echo csrf_field(); ?>
            <?php if(isset($post)): ?> <?php echo method_field('PUT'); ?> <?php endif; ?>
            <input name="title" value="<?php echo e(old('title',$post->title ?? '')); ?>" class="w-full border rounded p-2" placeholder="Title" required>
            <input name="slug" value="<?php echo e(old('slug',$post->slug ?? '')); ?>" class="w-full border rounded p-2" placeholder="Slug (optional)">
            <textarea name="content" rows="8" class="w-full border rounded p-2" placeholder="Content" required><?php echo e(old('content',$post->content ?? '')); ?></textarea>
            <input name="featured_image" value="<?php echo e(old('featured_image',$post->featured_image ?? '')); ?>" class="w-full border rounded p-2" placeholder="Featured Image URL">
            <select name="category_id" class="w-full border rounded p-2" required>
                <option value="">Select Category</option>
                <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><option value="<?php echo e($category->id); ?>" <?php if(old('category_id',$post->category_id ?? '')==$category->id): echo 'selected'; endif; ?>><?php echo e($category->name); ?></option><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
            <div>
                <p class="font-medium mb-1">Tags</p>
                <div class="grid grid-cols-2 gap-2">
                    <?php $__currentLoopData = $tags; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tag): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <label><input type="checkbox" name="tags[]" value="<?php echo e($tag->id); ?>" <?php if(in_array($tag->id, old('tags', isset($post) ? $post->tags->pluck('id')->toArray() : []))): echo 'checked'; endif; ?>> <?php echo e($tag->name); ?></label>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
            <select name="status" class="w-full border rounded p-2" required>
                <option value="draft" <?php if(old('status',$post->status ?? 'draft')==='draft'): echo 'selected'; endif; ?>>Draft</option>
                <option value="published" <?php if(old('status',$post->status ?? '')==='published'): echo 'selected'; endif; ?>>Published</option>
            </select>
            <button class="bg-gray-900 text-white px-5 py-2 rounded"><?php echo e(isset($post) ? 'Update' : 'Publish'); ?></button>
        </form>
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
<?php /**PATH C:\Users\Admin\Downloads\blog_project\resources\views/posts/form.blade.php ENDPATH**/ ?>