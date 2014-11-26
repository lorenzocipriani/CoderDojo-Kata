<?php
class SpecialKataCourse extends SpecialPage {
	public $context = null;
	public $serverPath = "";
	
	private $specialPageID = 'KataCourse';
	private $dbr = null;
	private $pageContentTitle = null;
	private $request = null;
	
	private $currentPageTitle = null;
	private $rootPageTitle = null;
	
	private $namespaceTextID = null;
	private $namespaceText = null;
	private $namespaceID = null;
	private $language = null;
	
	private $isSubpage = false;
	private $isValid = true;

	function __construct() {
		parent::__construct($this->specialPageID);
	}
	
	function setPageTitleObject(){
		global $wgServer, $wgScriptPath, $wgExtraNamespaces;
		
		$this->serverPath = $wgServer . $wgScriptPath;
		
		$this->currentPageTitle = Title::newFromText($this->pageContentTitle);
		$this->namespaceTextID = $this->currentPageTitle->getNsText();
		$this->namespaceText = str_replace("_", " ", $this->namespaceTextID);
		$this->namespaceID = array_search($this->namespaceTextID, $wgExtraNamespaces);
		$this->isSubpage = $this->currentPageTitle->isSubpage();
		
		$this->context = ContextSource::getContext();
		$this->context->getTitle()->mNamespace = ($this->namespaceID) ? $this->namespaceID : 3320;
		
		$this->language = $this->currentPageTitle->getPageViewLanguage();
		$this->rootPageTitle = $this->currentPageTitle->getRootTitle();
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
		
		if(!$this->isSubpage && $this->isValid) {
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
				$htmlBreadcrumbs .= Html::rawElement("div", array("class" => "kata-breadcrumb"), $this->namespaceText);
				if($this->isSubpage)
					$htmlBreadcrumbs .= Html::rawElement("div", array("class" => "kata-breadcrumb"), $this->rootPageTitle->getText());
				$htmlBreadcrumbs .= Html::rawElement("div", array("class" => "kata-breadcrumb  kata-breadcrumb-selected"), $this->currentPageTitle->getSubpageText());
			$htmlBreadcrumbs .= Html::closeElement("div");
		$htmlBreadcrumbs .= Html::closeElement("div");
		
		return $htmlBreadcrumbs;
	}
	
	function generateCourseNavigation($pageList){
		$htmlList = Html::openElement("table", array("class" => "kata-tutorial-navigation"));
		$rowItemCSSClass = "kata-tutorial-navigation-item";
		foreach ($pageList as $pageIndex) {
			$pageTitle = Title::newFromText($pageIndex);
			$htmlList .= Html::openElement("tr", array());
				$rowItemCSSClass = ($this->currentPageTitle->getSubpageText() == $pageTitle->getSubpageText()) ? 
										"kata-tutorial-navigation-item kata-tutorial-navigation-item-selected" : 
										"kata-tutorial-navigation-item";
				$htmlList .= Html::openElement("td", array("class" => $rowItemCSSClass));
					$htmlList .= Html::rawElement(	"a",
													array('href' => $this->serverPath ."/index.php/Special:KataCourse?page=" . $pageIndex),
													$pageTitle->getSubpageText());
				$htmlList .= Html::closeElement("td");
			$htmlList .= Html::closeElement("tr");
		}
		$htmlList .= Html::closeElement("table");
	
		return $htmlList;
	}
	
	function getContentPageData(){
		$wikiPage = new WikiPage($this->currentPageTitle);
		$wikiPageContent = $this->parseWikiPageContent($wikiPage);
		if(!is_object($wikiPageContent))
			return $this->handlePageNotFound();
		
		return array(
			"title"	=> $this->currentPageTitle->getSubpageText(),
			"index" => $this->parseTemplateDataAPI(),	
    		"content" => $wikiPageContent->mText);
	}
	
	function handlePageNotFound(){
		$this->isValid = false;
		return array(
				"title"	=> wfMsg('katacourse_pnf_title'),
				"index" => array(),
				"content" => wfMsg('katacourse_pnf_content'));
	}
	
	function parseTemplateDataAPI(){
		$tData = array();
		$requestData = $this->httpRequest($this->serverPath ."/api.php?action=templatedata&titles=" . $this->namespaceTextID . ":" . $this->rootPageTitle->getText());
		
		if(!is_null($requestData)){
			$tData = json_decode($requestData, true);
			$tData = reset($tData["pages"]);
			$tData = $tData["params"]["sessions"]["description"][$this->language->getCode()];
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
}