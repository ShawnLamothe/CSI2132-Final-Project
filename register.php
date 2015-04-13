<br><br><br><br>
<div id="header"> Registration Form</div>
	<form method="POST" action="">
		<p>User Identifier: <input type="text" name="userId" id="UserId"/></p>
		<p>Password: <input type="password" name="password" id="password" /></p>
		<p>Repeat Password: <input type="password" name="repeatPassword" id="repeatPassowrd" /></p>
		<p>Email: <input type="email" name ="email" id="email"/></p>
		<p>Name: <input type="text" name="name" id="name"/><p>
		<p>
			Account Type:
			<select name="type">
				<option value="online">Online</option>
				<option value="blog">Blog</option>
				<option value="food critic">Food Critic</option>
			</select>
		</p>
		<br>
		<p><input type="submit" value="register" name="register" /></p>
	</form>
</body>