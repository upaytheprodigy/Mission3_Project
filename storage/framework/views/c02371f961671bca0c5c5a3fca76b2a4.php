


<?php $__env->startSection('title', 'Available Courses'); ?>

<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-md-12">
        <h1>Available Courses</h1>
        <p>Pilih course yang ingin Anda ambil:</p>
    </div>
</div>

<div class="row">
    <?php $__currentLoopData = $availableCourses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $course): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <div class="col-md-4 mb-3">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title"><?php echo e($course->course_name); ?></h5>
                <p class="card-text">
                    <strong>SKS:</strong> <?php echo e($course->credits); ?><br>
                    <strong>Dosen:</strong> <?php echo e($course->dosen->full_name); ?><br>
                    <?php if($course->description): ?>
                        <small class="text-muted"><?php echo e($course->description); ?></small>
                    <?php endif; ?>
                </p>
                <form action="<?php echo e(route('student.courses.enroll', $course->id)); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <button type="submit" class="btn btn-primary" onclick="return confirm('Yakin ingin mendaftar course ini?')">
                        Enroll Course
                    </button>
                </form>
            </div>
        </div>
    </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>

<?php if($availableCourses->count() == 0): ?>
    <div class="alert alert-info">
        Tidak ada course yang tersedia untuk didaftarkan.
    </div>
<?php endif; ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\Laravel Project\resources\views/student/courses.blade.php ENDPATH**/ ?>