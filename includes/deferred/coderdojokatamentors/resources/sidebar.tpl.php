
<ul class="nav nav-pills nav-stacked">
	<li class="main"><a href="<?php echo $viewHelper["ArticlePath"], "Main_Page"; ?>">Home</a></li>
	<li class="main"><a href="<?php echo $viewHelper["ArticlePath"], "About_Kata"; ?>">About Kata</a></li>
	<li id="OrganiserMenuItem" class="organiser-resource dropdown">
		<a class="dropdown-toggle" data-toggle="dropdown" href="#">Organiser Resources <span class="caret"></span></a>
		<ul class="dropdown-menu" role="menu">
			<li>
				<a href="<?php echo $viewHelper["ArticlePath"], "Special:Organiser_Resources"; ?>">Learn more</a>
			</li>
			<li>
				<a href="#">How to start a dojo</a>
			</li>
			<li>
				<a href="#">Top Tips</a>
			</li>
		</ul>
	</li>

	<li id="TechnicalMenuItem" class="technical-resource dropdown">
		<a class="dropdown-toggle" data-toggle="dropdown" href="#">Technical Resources <span class="caret"></span></a>
		<ul class="dropdown-menu" role="menu">
			<li>
				<a href="<?php echo $viewHelper["ArticlePath"], "Special:Technical_Resources"; ?>">Learn more</a>
			</li>
			<li>
				<a href="#">Tutorials</a>
			</li>
		</ul>
	</li>
	<li id="NinjaMenuItem" class="ninja-resource dropdown">
		<a class="dropdown-toggle" data-toggle="dropdown" href="#">Ninja Resources <span class="caret"></span></a>
		<ul class="dropdown-menu" role="menu">
			<li>
				<a href="<?php echo $viewHelper["ArticlePath"], "Special:Ninja_Resources"; ?>">Explore</a>
			</li>
		</ul>
	</li>
</ul>
