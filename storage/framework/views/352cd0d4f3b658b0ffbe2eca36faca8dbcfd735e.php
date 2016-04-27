<?php $__env->startSection('content'); ?>
<div class="container dash">
    <div class="row">
    	<div class="col-md-10 col-md-offset-1">
    		<div class="panel panel-default">
    			<div class="panel-heading">Dashboard</div>
    			<div class="panel-body">
    				<ul>
    					<li>
                            <a href="<?php echo e(url('/dashboard/new-post')); ?>">Add new post</a>
                        </li>
                        <li>
                            <a href="<?php echo e(url('/dashboard/categories')); ?>">Categories</a>
                        </li>
    				</ul>
    			</div>
    		</div>
    	</div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>