

<?php $__env->startSection('title', 'Course Students'); ?>

<?php $__env->startSection('content'); ?>
<div class="container">
    <h1>Students in <?php echo e($course->course_name); ?></h1>
    
    <div class="card">
        <div class="card-header">
            <h5>Input Grades</h5>
        </div>
        <div class="card-body">
            <?php if($enrollments->count() > 0): ?>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Student Name</th>
                            <th>Username</th>
                            <th>Enroll Date</th>
                            <th>Current Grade</th>
                            <th>Update Grade</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $enrollments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $enrollment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($enrollment->student->full_name); ?></td>
                            <td><?php echo e($enrollment->student->username); ?></td>
                            <td><?php echo e($enrollment->enroll_date->format('d/m/Y')); ?></td>
                            <td>
                                <?php if($enrollment->grade): ?>
                                    <span class="badge bg-success"><?php echo e($enrollment->grade); ?></span>
                                <?php else: ?>
                                    <span class="badge bg-warning">No Grade</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <form action="<?php echo e(route('dosen.grades.update', $enrollment->id)); ?>" method="POST" class="d-flex">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('PUT'); ?>
                                    <input type="number" name="grade" value="<?php echo e($enrollment->grade); ?>" 
                                           step="0.01" min="0" max="4" class="form-control me-2" style="width: 80px;">
                                    <button type="submit" class="btn btn-sm btn-primary">Update</button>
                                </form>
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            <?php else: ?>
                <div class="alert alert-info">
                    No students enrolled in this course.
                </div>
            <?php endif; ?>
        </div>
    </div>
    
    <div class="mt-3">
        <a href="<?php echo e(route('dosen.dashboard')); ?>" class="btn btn-secondary">Back to Dashboard</a>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\Laravel Project\resources\views/dosen/student.blade.php ENDPATH**/ ?>