<header>
	<div class="row kata">
		<div class="col-md-12">
			<div class="logo kata">
				<a href="https://coderdojo.com"><img alt="CoderDojo.org"
					src="<?php echo $viewHelper["ImagePath"], "logo.png"; ?>" width="48px"
					height="48px"> <span class="kata-logo-text"> <?php echo $viewHelper["SiteName"]; ?></span>
				</a>
			</div>
			<div class="login kata">
				<img src="<?php echo $viewHelper["ImagePath"], "user.png"; ?>" alt=""> <input
					type="text" id="kata_username" value="username" class=""> <input
					type="password" id="kata_username" value="password"> <a
					href="Register.html" style=""><?php wfMessage( 'descriptionmsg' )->text();  ?> </a>
				<a href="login.html" style="color: black;"><?php wfMessage( 'login' )->text() ?> </a>
			</div>
		</div>
	</div>
</header>