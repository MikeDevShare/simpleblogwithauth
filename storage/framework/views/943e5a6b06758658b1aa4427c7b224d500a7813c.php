<?php $__env->startSection('content'); ?>
<div class="container dash">
    <div class="row">
    	<div class="col-md-10 col-md-offset-1">
    		<div class="panel panel-default">
    			<div class="panel-heading"><?php echo e($post->post_title); ?></div>
    			<div class="panel-body">
                    <div class="post-content"> 
                        <?php echo e($post->post_content); ?>

                    </div>
    			</div>

    		</div>
    	</div>
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Leave a comment</div>
                <div class="panel-body">
                    <?php if(Auth::guest()): ?>
                        <p>Login to Comment</p>
                    <?php else: ?>
                        <form action="<?php echo e(url('/')); ?>/comments/add-comment" method="post">
                            <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
                            <input type="hidden" name="on_post" value="<?php echo e($post->id); ?>">
                            <div class="form-group">
                                <textarea name="comment-body" required="required" placeholder="Enter comment here" class="form-control"></textarea>
                            </div>
                            <input type="submit" name='post_comment' class="btn btn-success" value = "Post"/>
                        </form>
                    <?php endif; ?>

                </div>

            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>