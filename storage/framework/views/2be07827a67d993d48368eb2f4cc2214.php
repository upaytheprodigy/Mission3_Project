

<?php $__env->startSection('title', 'Dashboard Dosen'); ?>

<?php $__env->startSection('content'); ?>
<div class="container">
    <h1 class="mb-4">Dashboard Dosen</h1>
    <p>Selamat datang, <?php echo e(Auth::user()->full_name); ?>!</p>

    <div class="card">
        <div class="card-header">
            Mata Kuliah yang Anda Ajar
        </div>
        <div class="card-body">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Nama Mata Kuliah</th>
                        <th>Jumlah Mahasiswa</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $courses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $course): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td><?php echo e($course->course_name); ?></td>
                            <td><?php echo e($course->students_count); ?> orang</td>
                            <td>
                                <a href="<?php echo e(route('dosen.courses.students', $course->id)); ?>" class="btn btn-sm btn-info">
                                    Lihat & Input Nilai
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="3" class="text-center">Anda belum ditugaskan untuk mengajar mata kuliah apapun.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\Laravel Project\resources\views/dosen/dashboard.blade.php ENDPATH**/ ?>