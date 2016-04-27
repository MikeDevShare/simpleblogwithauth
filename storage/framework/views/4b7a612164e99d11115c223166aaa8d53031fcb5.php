<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Blog</div>

                <div class="panel-body">
                    <?php if( !$posts->count() ): ?>
                        <p>There is no post till now. </p>
                    <?php else: ?>
                    <div class="">
                      <?php foreach( $posts as $post ): ?>
                      <div class="list-group">
                        <div class="list-group-item">
                          <h3><a href="<?php echo e(url('/blog/'.$post->slug)); ?>"><?php echo e($post->post_title); ?></a>
                            <?php if(!Auth::guest() && ($post->author_id == Auth::user()->id || Auth::user()->is_admin())): ?>
                              <?php if($post->active == '1'): ?>
                              <button class="btn" style="float: right"><a href="<?php echo e(url('edit/'.$post->slug)); ?>">Edit Post</a></button>
                              <?php else: ?>
                              <button class="btn" style="float: right"><a href="<?php echo e(url('edit/'.$post->slug)); ?>">Edit Draft</a></button>
                              <?php endif; ?>
                            <?php endif; ?>
                          </h3>
                          <p><?php echo e($post->created_at->format('M d,Y \a\t h:i a')); ?> By <a href="<?php echo e(url('/user/'.$post->author_id)); ?>"><?php echo e($post->author->name); ?></a></p>
                        </div>
                        <div class="list-group-item">
                          <article>
                            <?php echo str_limit($post->body, $limit = 1500, $end = '....... <a href='.url("/".$post->slug).'>Read More</a>'); ?>

                          </article>
                        </div>
                      </div>
                      <?php endforeach; ?>
                      <?php echo $posts->render(); ?>

                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>