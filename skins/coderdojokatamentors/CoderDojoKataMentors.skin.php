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
class SkinCoderDojoKataMentors extends SkinTemplate
{
	var $skinname = 'coderdojokatamentors';
	var $stylename = 'CoderDojoKataMentors';
	var $template = 'CoderDojoKataMentorsTemplate';
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
		$out->addModuleStyles( 'skins.coderdojokatamentors' );
	}
	
}


/**
 * BaseTemplate class for CoderDojo Kata skin
 *
 * @ingroup Skins
 * @author CoderDojo Foundation
 * @license http://www.gnu.org/copyleft/gpl.html GNU General Public License 2.0 or later
 */
class CoderDojoKataMentorsTemplate extends BaseTemplate
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
	   			<?php
	   			$skin = $this->data['skin'];
	   			$out = $skin->getOutput();
	   			$categories = $out->mCategories;
	   			$categoryToCssClass = array(
	   				'KataMentors' => 'kata-mentors',
	   				'Ninja_Resources' => 'kata-ninjas'
	   			);
	   			$cssClasses = '';
	   			foreach ($categories as $category) {
	   				if (isset($categoryToCssClass[$category])) {
	   					$cssClasses .= $categoryToCssClass[$category] . ' ';
	   				}
	   			}
	   			?>
	   			<div class="<?=$cssClasses;?>">
					<?php $this->html( 'bodycontent' ) ?>
				</div>
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
   <!-- <script src="js/bootstrap.min.js"></script> -->

<script>
$('.alpha-filter').not('.no-js').each(function() {
	var cont = $(this);
	if (cont.data('filter-initialized')) {
		return;
	}
	var filters = cont.find('.filters>*[data-filter]');
	var elements = cont.find('.filter-elements>*[data-filter]');
	filters.off('click.alpha-filter').not('.disabled').on('click.alpha-filter', function() {
		var $t = $(this);
		var f = $t.data('filter');
		elements.hide().filter('[data-filter=' + f + ']').show();
		filters.removeClass('selected');
		$t.addClass('selected');
		return false;
	});
	elements.hide();
	cont.data('filter-initialized', true);
	if (filters.filter('.selected').length > 0) {
		filters.filter('.selected').triggerHandler('click');
	} else {
		filters.not('.disabled').slice(0, 1).triggerHandler('click');
	}
});
</script>
<?php
      $this->printTrail(); 
?>

</body>
</html>
<?php
	}
}
?>
