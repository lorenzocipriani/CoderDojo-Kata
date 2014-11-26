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
class SkinCoderDojoKataNinjas1 extends SkinTemplate
{
	var $skinname = 'coderdojokataninjas1';
	var $stylename = 'CoderDojoKataNinjas1';
	var $template = 'CoderDojoKataNinjas1Template';
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
		$out->addModuleStyles( 'skins.coderdojokataninjas1' );
	}
	
}


/**
 * BaseTemplate class for CoderDojo Kata skin
 *
 * @ingroup Skins
 * @author CoderDojo Foundation
 * @license http://www.gnu.org/copyleft/gpl.html GNU General Public License 2.0 or later
 */
class CoderDojoKataNinjas1Template extends BaseTemplate
{
	/**
	 * Outputs the entire contents of the page
	 */
	public function execute() 
	{
		/**
		 * View Helper pattern for simplifying access to:
		 * -  ThisPage > Current page id
		 * -  SiteName > Site Name
		 * -  ArticlePath > Root path URL to wiki contents
		 * -  ImagePath > Shortcut to Skin Images Path
		 * -  ResourcePath > Shortcut to Skin Resources Path
		 */	
		$viewHelper = array(
				"ThisPage" => $this->data["thispage"],
				"SiteName" => $this->data["sitename"],
				"ArticlePath" => substr($this->data["articlepath"], 0, -2),
				"ImagePath" => "{$this->data["stylepath"]}/coderdojokata/images/",
				"ResourcePath" => "{$this->data["stylepath"]}/coderdojokata/resources/"
		);
	
		$this->html( 'headelement' );
		
?>
<!-- put everything inside <body></body> (body tags excuded) -->

	<!-- CONTAINER::PAGE -->
	<div id="PageContainer" class="container-fluid">
	
	   <!-- CONTAINER::HEADER -->
	   <div id="HeaderContainer" class="row">
	   
<?php include 'resources/header.tpl.php';?>

	   </div>
	   <!-- CONTAINER::HEADERHEADER END -->

	   <!-- CONTAINER::BODY -->
	   <div id="BodyContainer" class="row">

         <!-- CONTAINER::COL1BODY -->
         <div id="Col1BodyContainer" class="col-md-2">
         
            <!-- CONTAINER::SIDEBAR -->
            <div id="SideBar">
	   
<?php include 'resources/sidebar.tpl.php';?>

            </div>
            <!-- CONTAINER::SIDEBAR END -->         
         </div>
         <!-- CONTAINER::COL1BODY END -->
      	   
         <!-- CONTAINER::COL2BODY -->
         <div id="Col2BodyContainer" class="col-md-10">
         
            <!-- CONTAINER::MAINCONTAINER -->
            <div id="MainContainer">
	   
<?php include 'resources/ninjas1.tpl.php';?>

            </div>
            <!-- CONTAINER::MAINCONTAINER END -->         
         </div>
         <!-- CONTAINER::COL2BODY END -->
      	   
	   </div>
	   <!-- CONTAINER::BODY END -->
	   
<?php include 'resources/footer.tpl.php';?>

	   </div>
	<!-- CONTAINER::PAGE END -->
   
   <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
   <!-- Include all compiled plugins (below), or include individual files as needed -->
   <script src="js/bootstrap.min.js"></script>
    
<?php
      $this->printTrail(); 
?>

</body>
</html>
<?php
	}
}
?>
