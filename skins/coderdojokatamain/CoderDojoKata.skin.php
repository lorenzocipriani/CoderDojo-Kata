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
	 * Outputs the entire contents of the page
	 */
	public function execute() 
	{
		/**
		 * View Helper pattern for simplifying access to:
		 * -  ThisPage > Current page id
		 * -  SiteName > Site Name
		 * -  ImagePath > Shortcut to Skin Images Path
		 * -  ResourcePath > Shortcut to Skin Resources Path
		 */	
		$viewHelper = array(
				"ThisPage" => $this->data["thispage"],
				"SiteName" => $this->data["sitename"],
				"ImagePath" => "{$this->data["stylepath"]}/{$this->data["skinname"]}/images/",
				"ResourcePath" => "{$this->data["stylepath"]}/{$this->data["skinname"]}/resources/"
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

        <div class="kata-seperator"></div>
         
            <!-- CONTAINER::SIDEBAR -->
            <div id="SideBar">
	   
<?php include 'resources/sidebar.tpl.php';?>

            </div>
            <!-- CONTAINER::SIDEBAR END -->         
        
      	   
         <!-- CONTAINER::COL2BODY -->
         <div id="Col2BodyContainer" class="col-md-10" style="
    z-index: -9999;">
         
            <!-- CONTAINER::MAINCONTAINER -->
            <div id="MainContainer">
	   
<?php include 'resources/main.tpl.php';?>

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

<div id="debug">
	<code>
		<?php print_r($this->data); ?>
	</code>
</div>

</body>
</html>
<?php
	}
}
?>
