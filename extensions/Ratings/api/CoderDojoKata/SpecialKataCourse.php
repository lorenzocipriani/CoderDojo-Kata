<?php
class SpecialKataCourse extends SpecialPage {
	private $parentCategory = null;
	private $pageID = null;

	function __construct() {
		$this->parentCategory = 'KataCourse';
		$this->pageID = 'KataCourse';
		parent::__construct($this->pageID);
	}
	
	function execute( $par ) {
		$request = $this->getRequest();
		$out = $this->getOutput();
		$this->setHeaders();
 
		# Get request data from, e.g.
		$param = $request->getText( 'param' );
 
		$out->setPageTitle("Kata for Mentors");
		$wikitext = 'Hello world!';
		$out->addWikiText( $wikitext );
	}
}