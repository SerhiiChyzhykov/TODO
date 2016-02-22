<div class="container ">
	<div class="row">
		<?if(!isset($_POST['installdb']) ):?>
		<form method="POST" class="col s12">
			<label><input type=radio name=installdb value=mysql onclick=\"document.getElementById('mysqlsettings').style.display=''\" checked=\"checked\"><h4 class="center">MySQL</h4></label>

			<div class="row ">
				<div class="input-field col s6 ">
					<input id="Host" type="text" length="20" name=mysql_host value=localhost>
					<label for="Host">Host</label>
				</div>
			</div>
			<div class="row  ">
				<div class="input-field col s6">
					<input id="Database" type="text" length="20" name=mysql_db value=todo>
					<label for="Database">Database</label>
				</div>
			</div>
			<div class="row ">
				<div class="input-field col s6">
					<input id="User" type="text" length="20" name=mysql_user value=root>
					<label for="User">User</label>
				</div>
			</div>
			<div class="row ">
				<div class="input-field col s6">
					<input id="Password"  length="20" type=password name=mysql_password>
					<label for="Password">Password</label>
				</div>
			</div>
			<button class="btn waves-effect waves-light" type="submit" name="action">Submit
				<i class="material-icons right">send</i>
			</button>
		</form>
	<? else:?>
	<div class="row center">
		<h4 class="center">Done</h4>
		<a href="create">
			<button class="btn waves-effect waves-light">Main Page</button></a>
			<?endif;?>
		</div>
	</div>

