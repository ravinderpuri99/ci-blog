<h2><?php echo $title;?></h2>

<?php echo validation_errors();?>

<?php echo form_open_multipart('posts/create');?>

  <div class="form-group">
    <label>Category</label>
    <select name="category_id" class="form-control">
      <?php foreach($categories as $category): ?>
        <option value="<?php echo $category['id'];?>"><?php echo $category['name'];?></option>
      <?php endforeach; ?>
    </select>
  </div>
  <div class="form-group">
    <label>Title</label>
    <input type="text" class="form-control"  placeholder="Enter title" name="title">
  </div>
  <div class="form-group">
    <label>Description</label>
    <textarea name="description" placeholder="Add description" class="form-control" id="description"></textarea>
  </div> 
  <div class="form-group">
    <label>Upload Image</label>
    <input type="file" name="post_image" size="20" class="form-control">
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>

   	<script>
        // Replace the <textarea id="editor1"> with a CKEditor
        // instance, using default configuration.
        CKEDITOR.replace( 'description' );
    </script>
<?php echo form_close();?>

