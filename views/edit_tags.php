<h2>Edit Tag: <?php $tag->name ?></h2>
<form action="tag.php" method="post">
<input type="hidden" name="id" value="<?php $tag->id ?>" />
<label>Tag Name: </label><input type="text" name="name" value="<?php $tag->name ?>" />
<input type="submit" name="submit" value="Edit Tag" />
</form>
