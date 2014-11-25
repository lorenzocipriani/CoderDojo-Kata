<?php
class SpecialKataCourse extends SpecialPage {
	public $context = null;
	public $serverPath = "";
	
	private $parentCategory = null;
	private $specialPageID = 'KataCourse';
	private $dbr = null;
	private $pageContentTitle = null;
	private $request = null;
	
	private $currentPageTitle = null;
	private $parentPageTitle = null;
	
	private $currentPageTitleText = null;

	function __construct() {
		global $wgServer, $wgScriptPath;
		$this->serverPath = $wgServer . $wgScriptPath;
		
		$this->context = ContextSource::getContext();
		$this->context->getTitle()->mNamespace = NS_TECHNICAL_RESOURCE;
		
		parent::__construct($this->specialPageID);
	}
	
	function setPageTitleObject(){
		$this->currentPageTitle = Title::newFromText($this->pageContentTitle);
		$this->currentPageTitleText = $this->getContentTitleText($this->currentPageTitle);
		if(!$this->isSubPage($this->currentPageTitle)){
			$this->parentPageTitle = $this->currentPageTitle;
		}
	}
	
	function initPage(){
		$this->setHeaders();
		$this->request = $this->getRequest();
		$this->pageContentTitle =  htmlspecialchars($this->request->getText('page'));
		$this->dbr = wfGetDB( DB_SLAVE );
		$this->setPageTitleObject();
	}
	
	function execute() {
		$this->initPage();
		$out = $this->getOutput();
		$empty = null;
		
		$pageContent = $this->getContentPageData();
		
		$out->setPageTitle($pageContent["title"]);
		$out->addHTML($this->generatePage($pageContent));
	}
	
	function getRatingBar(){
		global $wgW4GRB_Settings;
		$htmlRatingBar = "";
		
		if(!$this->isSubPage($this->currentPageTitle)) {
			$wgW4GRB_Settings['auto-include'] = true;
			$htmlRatingBar = W4GrbHTML($this->getOutput(), $this->currentPageTitle);
			$wgW4GRB_Settings['auto-include'] = false;
		}
		
		return $htmlRatingBar;
	}
	
	
	function generatePage($pageContent){
		$htmlPage = $this->generateBreadcrumbs();
		
		$htmlPage .= Html::openElement("div", array("class" => "row kata-mentors-group"));
			$htmlPage .= Html::openElement("table", array("class" => "kata-tutorial-container"));
				$htmlPage .= Html::openElement("tr", array());
					$htmlPage .= Html::rawElement("td", array("colspan" => "2"), "&nbsp;");
				$htmlPage .= Html::closeElement("tr");
				$htmlPage .= Html::openElement("tr", array());
					$htmlPage .= Html::rawElement("td", array("class" => "kata-tutorial-navigation-container"), $this->generateCourseNavigation($pageContent["index"]));
					$htmlPage .= Html::openElement("td", array("class" => "kata-tutorial-content-container"));
						$htmlPage .= Html::openElement("div", array("class" => "mw-content-ltr"));
							$htmlPage .= Html::rawElement("div", array("class" => "kata-tutorial-step-title"), $pageContent["title"]);
							$htmlPage .= Html::rawElement("div", array("class" => "kata-tutorial-step-content"), $pageContent["content"]);
							$htmlPage .= Html::rawElement("div", array("class" => "kata-tutorial-rating"), $this->getRatingBar());
						$htmlPage .= Html::closeElement("div");
					$htmlPage .= Html::closeElement("td");
				$htmlPage .= Html::closeElement("tr");
			$htmlPage .= Html::closeElement("table");
		$htmlPage .= Html::closeElement("div");
		
		return $htmlPage;
	}
	
	function generateBreadcrumbs(){
		$htmlBreadcrumbs = Html::openElement("div", array("class" => "row kata-box"));
			$htmlBreadcrumbs .= Html::openElement("div", array("class" => "kata-breadcrumbs"));
				$htmlBreadcrumbs .= Html::rawElement("div", array("class" => "kata-breadcrumb"), $this->getNamespaceText());
				if($this->isSubPage($this->currentPageTitle))
					$htmlBreadcrumbs .= Html::rawElement("div", array("class" => "kata-breadcrumb"), $this->getContentTitleText($this->parentPageTitle));
				$htmlBreadcrumbs .= Html::rawElement("div", array("class" => "kata-breadcrumb  kata-breadcrumb-selected"), $this->currentPageTitleText);
			$htmlBreadcrumbs .= Html::closeElement("div");
		$htmlBreadcrumbs .= Html::closeElement("div");
		
		return $htmlBreadcrumbs;
	}
	
	function generateCourseNavigation($pageList){
		$htmlList = Html::openElement("table", array("class" => "kata-tutorial-navigation"));
		$rowItemCSSClass = "kata-tutorial-navigation-item";
		foreach ($pageList as $pageIndex) {
			$htmlList .= Html::openElement("tr", array());
				$rowItemCSSClass = ($this->currentPageTitleText == $this->getContentTitleText(Title::newFromText($pageIndex))) ? 
										"kata-tutorial-navigation-item kata-tutorial-navigation-item-selected" : 
										"kata-tutorial-navigation-item";
				$htmlList .= Html::openElement("td", array("class" => $rowItemCSSClass));
					$htmlList .= Html::rawElement(	"a",
													array('href' => $this->serverPath ."/index.php/Special:KataCourse?page=" . $pageIndex),
													$this->getContentTitleText(Title::newFromText($pageIndex)));
				$htmlList .= Html::closeElement("td");
			$htmlList .= Html::closeElement("tr");
		}
		$htmlList .= Html::closeElement("table");
	
		return $htmlList;
	}
	
	function getContentPageData(){
		$wikiPage = new WikiPage($this->currentPageTitle);
		$wikiPageContent = $this->parseWikiPageContent($wikiPage);
		
		
		return array(
			"title"	=> $this->currentPageTitleText,
			"index" => $this->getCourseIndex(),	
    		"content" => $wikiPageContent->mText);
	}
	
	function getNamespaceText(){
		$pageNamespaceArray = explode(":", $this->pageContentTitle);
	
		return $pageNamespaceArray[0];
	}
	
	function getContentTitleText($pageTitle){
		if(!is_object($pageTitle))
			return "";
		
		$textTitle = $pageTitle->mTextform;
		
		if($this->isSubPage($pageTitle)){
			$pageTitleArray = explode("/", $pageTitle->mTextform);
			$textTitle = $pageTitleArray[1];
		}
		
		return $textTitle;
	}
	
	function isSubPage($title){
		return (count(explode("/", $title->mTextform)) > 1) ? true : false;
	}
	
	function getCourseIndex(){
		$title = $this->currentPageTitle;
		if($this->isSubPage($this->currentPageTitle)){
			$pageTitleArray = explode("/", $this->currentPageTitle->mTextform);
			$pageNamespaceArray = explode(":", $this->pageContentTitle);
			$this->parentPageTitle = Title::newFromText($pageNamespaceArray[0] . ":" . $pageTitleArray[0]);
			$title = $this->parentPageTitle;
		}
		
		return $this->parseTemplateDataAPI($this->pageContentTitle);
	}
	
	function parseHTMLCourseIndex($tagName, $content)
	{
		$doc = new DOMDocument();
		$doc->preserveWhiteSpace = false;
		@$doc->loadHTML($content);
		
		$tags = $doc->getElementsByTagName($tagName);
		$indexItem = $tags->item(0);
		$indexArray = array();
		if(!is_null($indexItem))
			$indexArray = json_decode($indexItem->nodeValue, true);
			
		return $indexArray;
	}
	
	function parseTemplateDataAPI($title){
		$tData = array();
		$requestData = $this->httpRequest($this->serverPath ."/api.php?action=templatedata&titles=" . $title);
		
		if(!is_null($requestData)){
			$tData = json_decode($requestData, true);
			$tData = reset($tData["pages"]);
			$tData = $tData["params"]["sessions"]["description"]["en"];
			$tData = explode(",", $tData);
		}
		
		return $tData;
	}
	
	function httpRequest($url){
		$data = null;
		$request = curl_init();
		
		curl_setopt($request, CURLOPT_URL, $url);
		curl_setopt($request, CURLOPT_HEADER, 0);
		curl_setopt($request, CURLOPT_RETURNTRANSFER, true);
		
		$data = curl_exec($request);
		
		curl_close($request);
		
		return $data;
	}
	
	function parseWikiPageContent($wikiPage){
		$parserOptions = new ParserOptions();
		$parsedPage = $wikiPage->getParserOutput($parserOptions);
	
		return $parsedPage;
	}
	
	function getSubPages(){
		$title = Title::newFromText($this->pageContentTitle);
		$titleArrayFromResult = $title->getSubpages(1024);
	
		while($titleArrayFromResult->valid()){
			var_dump($titleArrayFromResult->current());
			$titleArrayFromResult->next();
		}
	}
}