<div class="clearfix">
	<form action="/user" method="post" class="form-signin" id="create-user">
	<h2>Sign up.  It's free.</h2>
		<fieldset>
			<input type="hidden" name="action" value="create" />
			<div class="control-group">
				<label class="sr-only" for="email">Email Address</label>
				<input type="email" id="email" class="form-control" name="email" placeholder="email" maxlength="45" required />
				<span class="help-block">No spam ever.  We promise.</span>
				<label class="sr-only" for="username">Username</label>
				<input type="text" pattern="^[a-zA-Z0-9]+$" name="username" class="form-control" id="username" placeholder="username" maxlength="45" required />
				<span class="help-block">a-Z, 0-9 only, 45 characters max length</span>
				<label class="sr-only" for="password">Password</label><input type="password" pattern = ".{8,}" name="password" class="form-control" id="password" placeholder="password" required />
				<span class="help-block">Min 8 characters</span>
				<label class="sr-only" for="password-again">Password Again</label><input type="password" pattern = ".{8,}" name="password_again" class="form-control" id="password_again" placeholder="password again" required />
				<span class="help-block">Passwords must match</span>
				<button class="btn btn-lg btn-primary btn-block" type="submit" name="submit">Create Account</button>
			</div>
		</fieldset>
	</form>
</div>
