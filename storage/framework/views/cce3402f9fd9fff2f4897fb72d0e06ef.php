

<?php $__env->startSection('title', 'Course List - Admin'); ?>

<?php $__env->startSection('content'); ?>
<div class="container">
    <h1 class="mb-3">Course List</h1>

    <?php if(session('success')): ?>
        <div class="alert alert-success"><?php echo e(session('success')); ?></div>
    <?php endif; ?>

    <div class="mb-3">
        <a href="<?php echo e(route('admin.courses.create')); ?>" class="btn btn-primary">
            + Add Course
        </a>
    </div>

    <div class="table-responsive">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th style="width:50px">#</th>
                <th>Course Name</th>
                <th>Description</th>
                <th style="width:180px">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php $__empty_1 = true; $__currentLoopData = $courses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $course): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr>
                    <td><?php echo e($loop->iteration); ?></td>
                    <td><?php echo e($course->course_name); ?></td>
                    <td><?php echo e($course->description ?? '-'); ?></td>
                    <td>
                        <a href="<?php echo e(route('admin.courses.edit', $course->id)); ?>" class="btn btn-sm btn-warning">Edit</a>

                        <form action="<?php echo e(route('admin.courses.destroy', $course->id)); ?>" 
                              method="POST" 
                              style="display:inline-block"
                              onsubmit="return confirm('Are you sure you want to delete this course?');">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('DELETE'); ?>
                            <button type="submit" class="btn btn-sm btn-danger">
                                Delete
                            </button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr>
                    <td colspan="4" class="text-center">No courses found</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\Laravel Project\resources\views/admin/courses/index.blade.php ENDPATH**/ ?>