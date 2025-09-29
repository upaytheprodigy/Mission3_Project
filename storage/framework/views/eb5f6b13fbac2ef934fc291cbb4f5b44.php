


<?php $__env->startSection('title', 'Student Dashboard'); ?>

<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-md-12">
        <h1>Dashboard Student</h1>
        <p>Selamat datang, <?php echo e(Auth::user()->full_name); ?>!</p>
    </div>
</div>

<div class="row">
    <div class="col-md-4">
        <div class="card text-white bg-info">
            <div class="card-body">
                <h5 class="card-title">Enrolled Courses</h5>
                <h2><?php echo e($enrolledCourses->count()); ?></h2>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card text-white bg-success">
            <div class="card-body">
                <h5 class="card-title">GPA</h5>
                <h2><?php echo e($gpa); ?></h2>
            </div>
        </div>
    </div>
</div>

<div class="row mt-4">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h5>My Courses & Grades</h5>
            </div>
            <div class="card-body">
                <?php if($enrolledCourses->count() > 0): ?>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Course Name</th>
                                <th>Credits</th>
                                <th>Dosen</th>
                                <th>Enroll Date</th>
                                <th>Grade</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $enrolledCourses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $course): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($course->course_name); ?></td>
                                <td><?php echo e($course->credits); ?></td>
                                <td><?php echo e($course->dosen->full_name); ?></td>
                                <td><?php echo e($course->pivot->enroll_date->format('d/m/Y')); ?></td>
                                <td>
                                    <?php if($course->pivot->grade): ?>
                                        <span class="badge bg-success"><?php echo e($course->pivot->grade); ?></span>
                                    <?php else: ?>
                                        <span class="badge bg-warning">Belum ada nilai</span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                <?php else: ?>
                    <p>Anda belum mendaftar di course manapun. <a href="<?php echo e(route('student.courses')); ?>">Lihat available courses</a></p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\Laravel Project\resources\views/student/dashboard.blade.php ENDPATH**/ ?>