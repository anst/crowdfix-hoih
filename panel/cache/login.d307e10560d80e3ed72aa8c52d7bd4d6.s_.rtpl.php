<?php if(!class_exists('raintpl')){exit;}?>					<!--[if lt IE 7]>
			            <p class="chromeframe">You are using an outdated browser. <a href="http://browsehappy.com/">Upgrade your browser today</a> or <a href="http://www.google.com/chromeframe/?redirect=true">install Google Chrome Frame</a> to better experience this site.</p>
			        <![endif]-->
<div class="login-container">
	<div id="login-form">
		<h3 align="right">Taylor High School Halloween Fright Fest</h1>
		<p>
			 Welcome to Taylor High School!
		</p>
		<hr id="loginhr"/>
		<form id="form" method="post" action="home/login">
			 Team #: <input type="text" name="username" id="username"/><br/>
			Password: <input type="password" name="password" id="passwordl"/><br/>
			<a href="#myModal" role="button" class="btn btn-success" data-toggle="modal" value="Login"><i class="icon-list-alt icon-white"></i>&nbsp;Register</a>
			<a href="" role="button" class="btn btn-primary" value="Login"/>Login&nbsp;<i class="icon-arrow-right icon-white"></i></a>
		</form>
	</div>
	<div style="width: 750; height: 20px; ">
		 &copy; Taylor High School
	</div>
</div>
<div class="modal fade hide" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="width: 600px; outline: none;">
	<div class="modal-header">
		<a class="close" data-dismiss="modal">×</a>
		<h3>Register</h3>
	</div>
	<div class="modal-body">
		<form action="" id="register_form" class="form-horizontal">
			<fieldset>
				<div class="control-group">
					<label class="control-label" for="novadv" style="width: 300px; padding-right: 10px;">Novice or Advanced: </label>
					<div class="controls">
						<select name="novadv" id="novadv" class="required">
							<option value="">--- Check One ---</option>
							<option value="nov">Novice</option>
							<option value="adv">Advanced</option>
						</select>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="school" style="width: 300px; padding-right: 10px;">School: </label>
					<div class="controls">
						<input type="text" name="school" id="school" class="required"/>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="teamnumber" style="width: 300px; padding-right: 10px;">Team Number: </label>
					<div class="controls">
						<input type="text" name="teamnumber" id="teamnumber" class="required"/>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="password" style="width: 300px; padding-right: 10px;">Password: </label>
					<div class="controls">
						<input type="password" name="password" id="password" class="required"/>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="passwordc" style="width: 300px; padding-right: 10px;">Confirm Password: </label>
					<div class="controls">
						<input type="password" name="passwordc" id="passwordc" class="required"/>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="member1" style="width: 300px; padding-right: 10px;">Team Member #1: </label>
					<div class="controls">
						<input type="text" name="member1" id="member1" class="required"/>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="member2" style="width: 300px; padding-right: 10px;">Team Member #2 (leave blank if nonexistant): </label>
					<div class="controls">
						<input type="text" name="member2" id="member2"/>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="member3" style="width: 300px; padding-right: 10px;">Team Member #3 (leave blank if nonexistant): </label>
					<div class="controls">
						<input type="text" name="member3" id="member3"/>
					</div>
				</div>
			</fieldset>
		</div>
		<div class="modal-footer">
			<input type="submit" name="register" class="btn btn-inverse" value="Register" id="register"/>
		</form>
	</div>
</div>