<?php foreach($post as $single_post) :?>
	<h2><?php echo $single_post['title'];?></h2>
	<small class="post-date">Posted on:<?php echo $single_post['created_at'];?></small>
	<img class="single-post-thumb" src="<?php echo site_url();?>assets/images/posts/<?php echo $single_post['post_image'];?>">
	<div class="post-body">

		<?php echo $single_post['description'];?>
		<br/><br/>
	</div>

<?php if($this->session->userdata('user_id') == $single_post['user_id']): ?>
<hr>
<div class="row">
	<a class="btn btn-secondary pull-left post-edit-btn" href="edit/<?php echo $single_post['slug'];?>">Edit</a>

	<?php echo form_open(('posts/delete/'.$single_post['id']), array('class' => 'post-delete-btn'));?>
		<input type="submit" value="Delete" class="btn btn-danger">  
	<?php echo form_close();?>
</div>
<?php endif; ?>
<hr>
<h3>Comments</h3>

<?php 
if($comments): 

	foreach($comments as $comment) : ?>
		<div class="well">
			<h5><?php echo $comment['body'];?> [by <strong><?php echo $comment['name'];?></strong>]</h5>
		</div>
<?php endforeach;

else: ?>

	<p>No Comments to display.</p>

<?php 
endif; 
?>

<hr>
<h3>Add Comment</h3>
<?php echo validation_errors(); ?>
<?php echo form_open('comments/create/'.$single_post['id']); ?>
	
	<div class="form-group">
		<label>Name</label>
		<input type="text" name="name" class="form-control">
	</div>
	<div class="form-group">
		<label>Email</label>
		<input type="email" name="email" class="form-control">
	</div>
	<div class="form-group">
		<label>Body</label>
		<textarea name="body" class="form-control"></textarea>
	</div>
	<input type="hidden" name="slug" value="<?php echo $single_post['slug'];?>">

	<button class="btn btn-primary" type="submit">Submit</button>

<?php echo form_close(); ?>

<?php endforeach; ?>
