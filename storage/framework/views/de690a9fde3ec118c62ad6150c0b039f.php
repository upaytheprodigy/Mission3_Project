

<?php $__env->startSection('content'); ?>
<div class="container">
    <h1>Tambah Course</h1>

    
    <?php if($errors->any()): ?>
        <div class="alert alert-danger">
            <ul>
                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $err): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li><?php echo e($err); ?></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </div>
    <?php endif; ?>

    
    <form action="<?php echo e(route('admin.courses.store')); ?>" method="POST">
        <?php echo csrf_field(); ?>

        <div class="mb-3">
            <label for="course_name" class="form-label">Nama Course</label>
            <input type="text" name="course_name" id="course_name" 
                   class="form-control" value="<?php echo e(old('course_name')); ?>" required>
        </div>

        <div class="mb-3">
            <label for="credits" class="form-label">Jumlah SKS</label>
            <input type="number" name="credits" id="credits" 
                   class="form-control" value="<?php echo e(old('credits')); ?>" min="1" max="6" required>
        </div>

        <div class="mb-3">
            <label for="dosen_id" class="form-label">Dosen Pengampu</label>
            <select name="dosen_id" id="dosen_id" class="form-select" required>
                <option value="">-- Pilih Dosen --</option>
                <?php $__currentLoopData = $dosens; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dosen): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($dosen->id); ?>" <?php echo e(old('dosen_id') == $dosen->id ? 'selected' : ''); ?>>
                        <?php echo e($dosen->full_name); ?>

                    </option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Deskripsi</label>
            <textarea name="description" id="description" rows="3" class="form-control"><?php echo e(old('description')); ?></textarea>
        </div>

        <button type="submit" class="btn btn-success">Simpan</button>
        <a href="<?php echo e(route('admin.courses.index')); ?>" class="btn btn-secondary">Batal</a>
    </form>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\Laravel Project\resources\views/admin/courses/create.blade.php ENDPATH**/ ?>