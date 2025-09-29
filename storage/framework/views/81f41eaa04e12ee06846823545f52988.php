


<?php $__env->startSection('title', 'Admin Dashboard - SIAKAD Mini'); ?>

<?php $__env->startSection('content'); ?>
<div class="container mt-4">

    
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3>Admin Dashboard</h3>
        <small><?php echo e(now()->format('l, d F Y')); ?></small>
    </div>

    
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card text-center">
                <div class="card-body">
                    <h5>Total Users</h5>
                    <p class="display-6"><?php echo e($totalUsers); ?></p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-center">
                <div class="card-body">
                    <h5>Total Courses</h5>
                    <p class="display-6"><?php echo e($totalCourses); ?></p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-center">
                <div class="card-body">
                    <h5>Students</h5>
                    <p class="display-6"><?php echo e($totalStudents); ?></p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-center">
                <div class="card-body">
                    <h5>Lecturers</h5>
                    <p class="display-6"><?php echo e($totalDosens); ?></p>
                </div>
            </div>
        </div>
    </div>

    
    <div class="row mb-4">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">Add Student</div>
                <div class="card-body">
                    <form action="<?php echo e(route('admin.students.store')); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <div class="mb-3">
                            <label>Full Name</label>
                            <input type="text" name="full_name" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label>Email</label>
                            <input type="email" name="email" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label>Username</label>
                            <input type="text" name="username" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label>Password</label>
                            <input type="password" name="password" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label>Entry Year</label>
                            <select name="entry_year" class="form-select" required>
                                <?php for($year = 2020; $year <= date('Y'); $year++): ?>
                                    <option value="<?php echo e($year); ?>"><?php echo e($year); ?></option>
                                <?php endfor; ?>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Save Student</button>
                    </form>
                </div>
            </div>
        </div>

        
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">Add Course</div>
                <div class="card-body">
                    <form action="<?php echo e(route('admin.courses.store')); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <div class="mb-3">
                            <label>Course Name</label>
                            <input type="text" name="course_name" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label>Credits</label>
                            <select name="credits" class="form-select" required>
                                <option value="">Choose...</option>
                                <?php for($i=1; $i<=6; $i++): ?>
                                    <option value="<?php echo e($i); ?>"><?php echo e($i); ?></option>
                                <?php endfor; ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label>Lecturer</label>
                            <select name="dosen_id" class="form-select" required>
                                <option value="">Select Lecturer</option>
                                <?php $__currentLoopData = $dosens; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dosen): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($dosen->id); ?>"><?php echo e($dosen->full_name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label>Description</label>
                            <textarea name="description" class="form-control"></textarea>
                        </div>
                        <button type="submit" class="btn btn-success">Save Course</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    
    <div class="card">
        <div class="card-header">Recent Users</div>
        <div class="card-body">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Username</th>
                        <th>Full Name</th>
                        <th>Role</th>
                        <th>Entry Year</th>
                        <th>Created</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <td><?php echo e($user->username); ?></td>
                        <td><?php echo e($user->full_name); ?></td>
                        <td><?php echo e(ucfirst($user->role)); ?></td>
                        <td><?php echo e($user->entry_year ?? '-'); ?></td>
                        <td><?php echo e($user->created_at->format('d M Y')); ?></td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td colspan="5" class="text-center">No users found</td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\Laravel Project\resources\views/admin/dashboard.blade.php ENDPATH**/ ?>