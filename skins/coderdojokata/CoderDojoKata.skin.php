<?php
/**
 * Skin file for CoderDojo Kata skin
 *
 * @file
 * @ingroup Skins
 * @author CoderDojo Foundation
 * @license http://www.gnu.org/copyleft/gpl.html GNU General Public License 2.0 or later
 */

/**
 * SkinTemplate class for CoderDojo Kata skin
 * @ingroup Skins
 * @author CoderDojo Foundation
 * @license http://www.gnu.org/copyleft/gpl.html GNU General Public License 2.0 or later
 */
class SkinCoderDojoKata extends SkinTemplate
{
	var $skinname = 'coderdojokata';
	var $stylename = 'CoderDojoKata';
	var $template = 'CoderDojoKataTemplate';
	var $useHeadElement = true;
 
	/**
	 * Add JavaScript via ResourceLoader
	 *
	 * @param OutputPage $out
	 */
	/*
	public function initPage( OutputPage $out ) {
		parent::initPage( $out );
		$out->addModules( 'skins.coderdojokata.js' );
	}
	*/
 
	/**
	 * Add CSS via ResourceLoader
	 *
	 * @param $out OutputPage
	 */
	function setupSkinUserCss( OutputPage $out ) 
	{
		parent::setupSkinUserCss( $out );
		$out->addModuleStyles( 'skins.coderdojokata' );
	}
	
}


/**
 * BaseTemplate class for CoderDojo Kata skin
 *
 * @ingroup Skins
 * @author CoderDojo Foundation
 * @license http://www.gnu.org/copyleft/gpl.html GNU General Public License 2.0 or later
 */
class CoderDojoKataTemplate extends BaseTemplate
{

	/**
	 * View Helper pattern for simplifying access to:
	 * -  ThisPage > Current page id
	 * -  SiteName > Site Name
	 * -  Namespace > Namespace of the current page (blank if normal page)
	 * -  Categories > Return an array of the parent categories of the current page
	 * -  ArticlePath > Root path URL to wiki contents
	 * -  SkinTemplate > Name of the skin template that needs to be loaded for render the page
	 * -  ImagePath > Shortcut to Skin Images Path
	 * -  ResourcePath > Shortcut to Skin Resources Path
	 */
	public function getViewHelper()
	{
		$context = ContextSource::getContext();
		$wikiPage = $context->getWikiPage();
		$categories = $context->getOutput()->getCategories();
		$namespace = $wikiPage->getTitle()->getNamespace();
		$namespaceName = $GLOBALS["wgExtraNamespaces"][$namespace];
		
		$skinTemplate = "main";
		$cssClasses = " " . strtolower(strtr($namespaceName, "_", "-"));
		
		
		// Check the namespace to load the right template
		switch (true)
		{
			case ($namespace == NS_SPECIAL):
				break;
				
			case ($namespace == NS_MAIN):
				
				$skinTemplate = "main";
				$cssClasses = " main" . $cssClasses;
				$kataSection = "Kata :: ";
				
				if ($wikiPage->getTitle()->getDBkey() == "Main_Page")
				{
					$skinTemplate .= "Page";
				}
				break;
				
			case (($namespace >= 3100) && ($namespace <= 3199)):
				
				$skinTemplate = "organiser";
				$cssClasses = " organiser-resource" . $cssClasses;
				$kataSection = "Organiser Resources > ";
				break;
				
			case (($namespace >= 3300) && ($namespace <= 3399)):
				
				$skinTemplate = "technical";
				$cssClasses = " technical-resource" . $cssClasses;
				$kataSection = "Technical Resources > ";
				break;
				
			case (($namespace >= 3500) && ($namespace <= 3599)):
				
				$skinTemplate = "ninja";
				$cssClasses = " ninja-resource" . $cssClasses;
				$kataSection = "Ninja Resources > ";
				break;
				
			case ($namespace == NS_TEMPLATE):
				break;
				
			case ($namespace == NS_CATEGORY):
				break;
		}
		
		$viewHelper = array(
				"ThisPage" => $this->data["thispage"],
				"SiteName" => $this->data["sitename"],
				"Section" => $kataSection,
				"Namespace" => $wikiPage->getTitle()->getNamespace(),
				"Categories" => $categories,
				"ArticlePath" => substr($this->data["articlepath"], 0, -2),
				"SkinTemplate" => $skinTemplate,
				"CssClasses" => trim($cssClasses),
				"ImagePath" => "{$this->data["stylepath"]}/{$this->data["skinname"]}/images/",
				"ResourcePath" => "{$this->data["stylepath"]}/{$this->data["skinname"]}/resources/"
		);
		
		return $viewHelper;
		
	}
	
	/**
	 * Outputs the entire contents of the page
	 */
	public function execute() 
	{
		$context = ContextSource::getContext();
		$wikiPage = ContextSource::getContext()->getWikiPage();
		
		$viewHelper = $this->getViewHelper();
	
		$this->html( 'headelement' );
		
?>
<!-- put everything inside <body></body> (body tags excuded) -->

<!-- CONTAINER::PAGE -->
<div id="PageContainer" class="container-fluid">

	<!-- CONTAINER::HEADER -->
	<div id="HeaderContainer" class="row">

<?php include "resources/header.tpl.php";?>

	</div>
	<!-- CONTAINER::HEADER END -->

	<!-- CONTAINER::BODY -->
	<div id="BodyContainer" class="row">

	<!-- CONTAINER::COL1BODY -->
		<div id="Col1BodyContainer" class="col-md-2">

			<!-- CONTAINER::SIDEBAR -->
			<div id="SideBar" class="col-md-12">

				<div class="kata-seperator"></div>

<?php include "resources/sidebar.tpl.php";?>

			</div>
			<!-- CONTAINER::SIDEBAR END -->
		</div>
		<!-- CONTAINER::COL1BODY END -->

		<!-- CONTAINER::COL2BODY -->
		<div id="Col2BodyContainer" class="col-md-10">

			<!-- CONTAINER::MAINCONTAINER -->
			<div id="MainContainer" class="row <?php echo $viewHelper['CssClasses']; ?>">
	   
<?php include "resources/{$viewHelper['SkinTemplate']}.tpl.php";?>

			</div>
			<!-- CONTAINER::MAINCONTAINER END -->
		</div>
		<!-- CONTAINER::COL2BODY END -->
	</div>
	<!-- CONTAINER::BODY END -->

	<!-- CONTAINER::FOOTER -->
	<div id="FooterContainer" class="row">
	
<?php include "resources/footer.tpl.php";?>

	</div>
	<!-- CONTAINER::FOOTER END -->

</div>
<!-- CONTAINER::PAGE END -->

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script
	src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script
	src="<?php echo $viewHelper["ResourcePath"], "bootstrap.min.js"; ?>"></script>

<?php
		$this->printTrail ();
		?>
<hr>
<hr>
<h1>$wikiPage</h1>
<hr>
<hr>
<div>
	<pre>
		<?php print_r($wikiPage); ?>
	</pre>
</div>
<hr>
<hr>
<h1>$wikiPage->getTitle()</h1>
<hr>
<hr>
<div>
	<pre>
		<?php print_r($wikiPage->getTitle()); ?>
	</pre>
</div>
<hr>
<hr>
<h1>$wikiPage->getContent()</h1>
<hr>
<hr>
<div>
	<pre>
		<?php print_r($wikiPage->getContent()); ?>
	</pre>
</div>
<hr>
<hr>
<h1>$this->data['content_navigation']</h1>
<hr>
<hr>
<div>
	<pre>
		<?php print_r($this->data['content_navigation']); ?>
	</pre>
</div>
<hr>
<hr>
<h1>$this->data['content_actions']</h1>
<hr>
<hr>
<div>
	<pre>
		<?php print_r($this->data['content_actions']); ?>
	</pre>
</div>
<hr>
<hr>
<h1>$context->getOutput()->getCategories()</h1>
<hr>
<hr>
<div>
	<pre>
		<?php print_r($context->getOutput()->getCategories()); ?>
	</pre>
</div>

<hr>
<hr>
<h1>$context->getConfig()</h1>
<hr>
<hr>
<div>
	<pre>
		<?php //print_r($context->getConfig()); ?>
	</pre>
</div>
<hr>
<hr>
<h1>$context->getLanguage()</h1>
<hr>
<hr>
<div>
	<pre>
		<?php print_r($context->getLanguage()); ?>
	</pre>
</div>
<hr>
<hr>
<h1>$context->getMain()</h1>
<hr>
<hr>
<div>
	<pre>
		<?php print_r($context->getMain()); ?>
	</pre>
</div>
<hr>
<hr>
<h1>$context->getOutput()</h1>
<hr>
<hr>
<div>
	<pre>
		<?php print_r($context->getOutput()); ?>
	</pre>
</div>
<hr>
<hr>
<h1>$context->getRequest()</h1>
<hr>
<hr>
<div>
	<pre>
		<?php print_r($context->getRequest()); ?>
	</pre>
</div>
<hr>
<hr>
<h1>$context->getSkin()</h1>
<hr>
<hr>
<div>
	<pre>
		<?php print_r($context->getSkin()); ?>
	</pre>
</div>
<hr>
<hr>
<h1>$context->getTitle()</h1>
<hr>
<hr>
<div>
	<pre>
		<?php print_r($context->getTitle()); ?>
	</pre>
</div>
<hr>
<hr>
<h1>$context->getUser()</h1>
<hr>
<hr>
<div>
	<pre>
		<?php print_r($context->getUser()); ?>
	</pre>
</div>
<hr>
<hr>
<h1>$context->getWikiPage()</h1>
<hr>
<hr>
<div>
	<pre>
		<?php print_r($context->getWikiPage()); ?>
	</pre>
</div>

<hr>
<hr>
<h1>ContextSource::getContext()</h1>
<hr>
<hr>
<div>
	<pre>
		<?php print_r(ContextSource::getContext()); ?>
	</pre>
</div>

</body>
</html>
<?php
	}
}
?>
