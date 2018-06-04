
<h2><?= $title; ?></h2>

<?php echo validation_errors(); ?>
<!--open create form-->
<?php echo form_open_multipart('posts/create'); ?>
        <!--Title-->
    <div class="form-group">
        <label>Title</label>
        <input type="text" class="form-control"  placeholder="Add title" name="title">
    </div>

        <!--Body-->
    <div class="form-group">
        <label>Body</label>
        <textarea id="editor1" type="password" class="form-control"  placeholder="Add body" name="body"></textarea>
    </div>

    <!--Category-->
    <div class="form-group">
        <label>Category</label>
        <select name="category_id" class="form-control">
            <?php foreach ($categories as $category):  ?>
            <option value="<?php echo $category['id']; ?>"><?php echo $category['name']; ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="form-group">
        <label>Upload Image</label>
        <input type="file" name="userfile" size="20">

    </div>
    <button type="submit" class="btn btn-default">Submit</button>

</form>