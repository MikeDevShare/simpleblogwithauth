<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="row">   
      <div class="col-md-10 col-md-offset-1">
        <div class="panel panel-default">
          <div class="panel-heading">Categories</div>
          <input type="hidden" id="base-url" value="<?php echo e(url('/')); ?>">
          <div class="panel-body">
            <div class="row">
              <div class="col-md-6 cat-list">
                <ul>
                  <?php foreach($cats as $cat): ?>
                    <?php if( $cat->id != 1 ): ?>
                      <li>
                        <a href="" rel="<?php echo e($cat->id); ?>"><?php echo e($cat->title); ?></a> 
                        <div class="action"> <small><a href="#edit" rel="<?php echo e($cat->id); ?>">Edit</a> | <a href="#delete" rel="<?php echo e($cat->id); ?>">Delete</a>
                        <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
                        </small>
                        </div>
                      </li>
                    <?php else: ?>
                      <li><a href="" rel="<?php echo e($cat->id); ?>"><?php echo e($cat->title); ?></a></li>
                    <?php endif; ?>
                  <?php endforeach; ?>
                </ul>
                
              </div>
              <div class="col-md-6 cat-edit-form">
                <div class="message"></div>
                <form class="hidden edit-cat" action="<?php echo e(url('/')); ?>/dashboard/categories/edit" method="post">
                  <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
                  <input type="hidden" name="cat_id" value="<?php echo e(old('cat_id')); ?>">
                  <div class="form-group">
                    <input required="required" value="<?php echo e(old('title')); ?>" placeholder="Enter category title here" type="text" name = "title"class="form-control" />
                  </div>
                  <div class="form-group">
                    <textarea name='body'class="form-control"><?php echo e(old('body')); ?></textarea>
                  </div>
                  <input type="submit" name='publish' class="btn btn-success" value = "Publish"/>
                </form>
              </div>
            </div>

            <p>
              <a href="javascript:void(0);" id="add-cat">Add Category</a>
            </p>
            <form action="<?php echo e(url('/')); ?>/dashboard/categories/add" method="post">
              <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
              <div class="form-group">
                <input required="required" value="<?php echo e(old('title')); ?>" placeholder="Enter category title here" type="text" name = "title"class="form-control" />
              </div>
              <div class="form-group">
                <textarea name='body'class="form-control"><?php echo e(old('body')); ?></textarea>
              </div>
              <input type="submit" name='publish' class="btn btn-success" value = "Publish"/>
            </form>
          </div>
        </div>
      </div>
    </div>
</div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>