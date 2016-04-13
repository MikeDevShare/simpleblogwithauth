<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
            	<div class="panel-heading">New Post</div>
            	<div class="panel-body">
					<form action="<?php echo e(url('/')); ?>/new-post" method="post">
					  <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
					  <div class="form-group">
					    <input required="required" value="<?php echo e(old('title')); ?>" placeholder="Enter title here" type="text" name = "title"class="form-control" />
					  </div>
					  <div class="form-group">
					    <textarea name='body'class="form-control"><?php echo e(old('body')); ?></textarea>
					  </div>
					  <input type="submit" name='publish' class="btn btn-success" value = "Publish"/>
					  <input type="submit" name='save' class="btn btn-default" value = "Save Draft" />
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>