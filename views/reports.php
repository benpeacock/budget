<div class="container">
	<h2>Filters:</h2>
	<form action="report.php" method="post" class="form-horizontal">
		<div class="row">
			<div class="col-md-2">
				<label>Budget Name(s):</label>
			</div>
			<div class="col-md-2">
				<select id="budget" name="budget[]" multiple="multiple">
					<?php
					$budget = new Budget();
					$result = $budget->getByUser($session->user_id);
					foreach ($result as $row) {
						echo '<option value="' . $row['id'] . '">' . $row['name'] . '</option>';
						}
					?>
				</select>
			</div>
		</div>
		<div class="row">
			<div class="col-md-2">
				<label>Category Name(s):</label>
			</div>
			<div class="col-md-2">
				<select id="category" name="category[]" multiple="multiple">
				<?php 
				$category = new Category();
				$result = $category->getByUser($session->user_id);
				foreach ($result as $row) {
					echo '<option value="' . $row['id'] . '">' . $row['name'] . '</option>';
				}
				?>
				</select>
			</div>
		</div>
		<div class="row">
			<div class="col-md-2">
				<label>Tag Name(s):</label>
			</div>
			<div class="col-md-2">
				<select id="tag" name="tag[]" multiple="multiple">
				<?php 
				$tag = new Tag();
				$result = $tag->getByUser($session->user_id);
				foreach ($result as $row) {
					echo '<option value="' . $row['id'] . '">' . $row['name'] . '</option>';
				}
				?>
				</select>
			</div>
		</div>
<!-- 			<li> -->
<!-- 				Include Overhead Items? -->
<!-- 				Yes: <input type="radio" name="include_overhead" value="yes" /> -->
<!-- 				No: <input type="radio" name="include_overhead" value="no" checked="checked"/> -->
<!-- 			</li> -->
		<div class="col-md-4">
			<div style="padding: 20px 20px 20px 20px;">
				<button class="btn btn-primary" type="submit" name="submit_html">Create Report</button>
				<button class="btn btn-primary" type="submit" name="submit_csv">Export to CSV</button>
			</div>
		</div>
	</form>
</div>
