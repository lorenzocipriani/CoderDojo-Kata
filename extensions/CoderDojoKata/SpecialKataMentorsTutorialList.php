<?php

// class SpecialKataMentors extends PageQueryPage {
class SpecialKataMentorsTutorialList extends SpecialPage {
	private $parentCategory = 'KataMentors';
	/*
		validParentCategories needs to contains valid Parent Categories
		and they must be lowercase and must have ' ' (whitespaces) replaced with '_' (underscores)
	*/
	private $validParentCategories = array(
		'technology',
		'topic'
	);
	
	private $pageSize = 10;
	private $paginatedTutorials = array();

	function __construct() {
		parent::__construct('KataMentorsTutorialList');
	}


	function getQueryParentCategory($subCategory) {
		/*
			SELECT
				catlink.cl_to as parent_cat
			FROM
				`mw_page` as kpage
				inner join
				`mw_categorylinks` as catlink
				on kpage.page_id = catlink.cl_from
				where LCASE(CONVERT(kpage.page_title using utf8)) = 'html'
				AND LCASE(CONVERT(catlink.cl_to using utf8)) in ('technology', 'topic')
		*/
		$subCat = strtolower($subCategory);
		return array (
			'fields' => array ( 'catlink.cl_to as parent_cat', 'kpage.page_title as category' ),
			'tables' => array ( 'kpage' => 'page', 'catlink' => 'categorylinks' ),
			'join_conds' => array (
				'catlink' => array (
					'INNER JOIN', 'kpage.page_id = catlink.cl_from'
				)
			),
			'conds' => array ( 
				"LCASE(CONVERT(kpage.page_title using utf8)) = '$subCat'",
				"LCASE(CONVERT(catlink.cl_to using utf8)) in ('".join("','", $this->validParentCategories)."')"
			)
		);

	}

	function getQueryTutorialsByCategory($namespace, $categories) {
		/*
			select
				count(distinct cl.cl_to) as numCategories, kp.page_title as page_title, count(distinct pl.pl_title) as sessions, group_concat(DISTINCT allcat.cl_to separator ', ') as categories
			from
				`mw_categorylinks` as cl
				join
				`mw_page` as kp
					on cl.cl_from = kp.page_id and cl1.cl_type = 'page'
				join
				`mw_pagelinks` as pl
					on pl.pl_from = kp.page_id
				join
				`mw_categorylinks` as allcat
					on allcat.cl_from = kp.page_id
				where
					kp.page_namespace = '...' and cl.cl_to in ('HTML') and kp.page_title not like '%/%'
				group by kp.page_id
				having numCategories = 1
		*/
		$categoryList = "'".strtolower(str_replace(' ', '_', join("','", array_filter($categories))))."'";
		$categoryNum = count(array_filter($categories));
		return array (
			'options' => array('GROUP BY' => 'kp.page_id', 'HAVING' => "numCategories = $categoryNum"),
			'fields' => array ( 'kp.page_title as page_title', 'count(distinct pl.pl_title) as sessions', 'group_concat(DISTINCT allcat.cl_to separator \', \') as categories', 'count(distinct cl.cl_to) as numCategories' ),
			'tables' => array ( 'cl' => 'categorylinks', 'kp' => 'page', 'pl' => 'pagelinks', 'allcat' => 'categorylinks' ),
			'join_conds' => array (
				'kp' => array (
					'INNER JOIN', 'cl.cl_from = kp.page_id and cl.cl_type = \'page\''
				),
				'pl' => array (
					'LEFT JOIN', 'pl.pl_from = kp.page_id'
				),
				'allcat' => array (
					'INNER JOIN', 'allcat.cl_from = kp.page_id'
				)
			),
			'conds' => array (
				"kp.page_namespace = '$namespace'", // limit namespace
				"LCASE(CONVERT(cl.cl_to using utf8)) in ($categoryList)", // limit parent category
				"kp.page_title not like '%/%'" // don't consider subpages
			),
		);
	}
	
	function getQuerySubCategories($parentCategory) {
		/*
			select
				kp.page_title as subcat
			from
				`mw_page` as kp
				join
				`mw_categorylinks` as cl
					on kp.page_id = cl.cl_from and cl.cl_type = 'subcat'
				where
					kp.page_namespace = '...' and cl.cl_to = 'Topic' and kp.page_title not like '%/%'
		*/
		$category = strtolower(str_replace(' ', '_', $parentCategory));
		return array (
			'fields' => array ( 'kp.page_title as subcat' ),
			'tables' => array ( 'kp' => 'page', 'cl' => 'categorylinks' ),
			'join_conds' => array (
				'cl' => array (
					'INNER JOIN', 'kp.page_id = cl.cl_from and cl.cl_type = \'subcat\''
				)
			),
			'conds' => array (
				"LCASE(CONVERT(cl.cl_to using utf8)) = '$category'", // limit parent category
				"kp.page_title not like '%/%'" // don't consider subpages
			),
		);
	}

	// public function formatResult( $skin, $row ) {
	// 	global $wgContLang;

	// 	$title = Title::makeTitleSafe( $row->namespace, $row->title );

	// 	if ( $title instanceof Title ) {
	// 		$text = $wgContLang->convert( $title->getPrefixedText() );
	// 		return Linker::linkKnown( $title, htmlspecialchars( $text ) );
	// 	} else {
	// 		return Html::element( 'span', array( 'class' => 'mw-invalidtitle' ),
	// 			Linker::getInvalidTitleDescription( $this->getContext(), $row->namespace, $row->title ) );
	// 	}
	// }

	function execute( $subPage) {
		ContextSource::getContext()->getTitle()->mNamespace = NS_TECHNICAL_RESOURCE;
		
		$request = $this->getRequest();
		$out = $this->getOutput();
		$this->setHeaders();

		$out->setPageTitle("Kata for Mentors");

		# Get request data from, e.g.
		$this->useskin = $request->getText( 'useskin' );
		$category = $request->getText( 'category' );
		$parentCat = "";
		$pageNumber = filter_var($request->getText( 'page' ) ? $request->getText( 'page' ) : 1, FILTER_VALIDATE_INT);
		
		# Do stuff
		# ...

		$dbr = wfGetDB( DB_SLAVE );
		
		$res = $this->executeQuery($dbr, $this->getQueryParentCategory($category));
		if($obj = $dbr->fetchObject($res)) {
			$parentCat = str_replace('_', ' ', $obj->parent_cat);
			$category = str_replace('_', ' ', $obj->category);
		}

		// this div is created in the skin :)
		// $out->addHTML(
		// 	Html::openElement( 'div', array( 'class' => 'kata-mentors' ) ). "\n"
		// );
		$out->addHTML(
			Html::openElement('div', array( 'class' => 'kata-mentors')). "\n".
			Html::openElement('div', array( 'class' => 'row kata-box')). "\n".
			Html::openElement('div', array( 'class' => 'kata-breadcrumbs')). "\n".
			($parentCat ? Html::element('div', array( 'class' => 'kata-breadcrumb'), $parentCat) : "").
			Html::element('div', array( 'class' => 'kata-breadcrumb'), $category).
			Html::closeElement( 'div' )."\n".
			Html::closeElement( 'div' )."\n"
		);

		// BEGIN filters
		$isTopicCurrent = strtolower($parentCat) == 'topic';
		$isTechnologyCurrent = strtolower($parentCat) == 'technology';
		$topicSelection = $isTopicCurrent ? $category : $request->getText( 'topic' );
		$technologySelection = $isTechnologyCurrent ? $category : $request->getText( 'technology' );
		$this->printFilters($out, array(
			array('title' => 'Skill Level', 'name' => 'skill', 'options' => array(array('name' => 'Select an option', 'value' => '', 'selected' => true), array('name' => 'Beginner', 'value' => 'beginner'))),
			array('title' => 'Topic', 'name' => $isTopicCurrent ? 'category' : 'topic', 'options' => $this->populateFilter($dbr, 'topic', $topicSelection, $isTopicCurrent)),
			array('title' => 'Technology', 'name' => $isTechnologyCurrent ? 'category' : 'technology', 'options' => $this->populateFilter($dbr, 'technology', $technologySelection, $isTechnologyCurrent)),
			array('title' => 'Ratings', 'name' => 'rating', 'options' => array(array('name' => 'Select an option', 'value' => '', 'selected' => true), array('name' => '*****', 'value' => '5')))
		));
		// END filters
		
		$res = $this->executeQuery($dbr, $this->getQueryTutorialsByCategory(NS_MENTOR_COURSE, array($topicSelection, $technologySelection)));
		$tutorials = array();
		while($obj = $dbr->fetchObject($res)) {
			array_push($tutorials, array(
				'name' => str_replace('_', ' ', $obj->page_title),
				'author' => 'Bill Lowe',
				'description' => 'Lorem ipsum dolor sit amet, consectetur adipisci elit, sed eiusmod tempor incidunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquid ex ea commodi consequat. Quis aute iure reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint obcaecat cupiditat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
				'image' => 'http://placekitten.com/g/250/250',
				'skillLevel' => 'Beginner',
				'sessions' => $obj->sessions == 0 ? 1 : $obj->sessions,
				'category' => $obj->categories
			));
		}
		
		// BEGIN tutorials list
		$this->printPagination($out, $this->getTotalPages($tutorials), $pageNumber);
		$this->printTutorials($out, $this->getTutorialsInPage($tutorials, $pageNumber));
		$this->printPagination($out, $this->getTotalPages($tutorials), $pageNumber);
		// END tutorials list
		
		// BEGIN scripts
		$out->addHTML('
			<script>
				function kataDisableEmptyInputs(form){
					$(form).find(":input").each(function(){
						var t = $(this), v = t.val();
						!v && (t.attr("disabled", "disabled"));
					});
				}
			</script>
		');
		// END scripts
		
		// close div.kata-mentors
		$out->addHTML(
			Html::closeElement( 'div' )
		);
	}
	
	function getTutorialsInPage($allTutorials, $pageNumber) {
		$paginatedTutorials = $this->paginateTutorials($allTutorials);
		if(!is_int($pageNumber) || count($paginatedTutorials) < $pageNumber || $pageNumber < 1) {
			return array();
		}
		
		return $paginatedTutorials[$pageNumber - 1];
	}
	
	function getTotalPages($allTutorials) {
		return count($this->paginateTutorials($allTutorials));
	}
	
	function paginateTutorials($tutorials) {
		if($this->paginatedTutorials) {
			return $this->paginatedTutorials;
		}
		
		if(count($tutorials) <= $this->pageSize) {
			return array($tutorials);
		}
		$page = array_slice($tutorials, 0, $this->pageSize);
		$remainingPages = $this->paginateTutorials(array_slice($tutorials, $this->pageSize));
		$this->paginatedTutorials = array_merge(array($page), $remainingPages);
		return $this->paginatedTutorials;
	}
	
	function populateFilter($dbr, $category, $subcategory, $isCurrentCategory = false) {
		$res = $this->executeQuery($dbr, $this->getQuerySubCategories($category));
		$options = array();
		$defaultOpt = array('name' => 'Select an option', 'value' => '', 'selected' => true);
		
		while($obj = $dbr->fetchObject($res)) {
			$tmp = array('name' => str_replace('_', ' ', $obj->subcat), 'value' => $obj->subcat);
			
			if(strtolower(str_replace(' ', '_', $subcategory)) == strtolower($obj->subcat)) {
					$tmp['selected'] = true;
					$defaultOpt['selected'] = false;
			}
			array_push($options, $tmp);
		}
		
		if(!$isCurrentCategory) {
			array_unshift($options, $defaultOpt);
		}
		
		return $options;
	}

	function executeQuery($dbr, $query) {
		$fname = get_class( $this ) . "::getPages";
		$tables = isset( $query['tables'] ) ? (array)$query['tables'] : array();
		$fields = isset( $query['fields'] ) ? (array)$query['fields'] : array();
		$conds = isset( $query['conds'] ) ? (array)$query['conds'] : array();
		$options = isset( $query['options'] ) ? (array)$query['options'] : array();
		$join_conds = isset( $query['join_conds'] ) ? (array)$query['join_conds'] : array();

		$res = $dbr->select(
			$tables, $fields, $conds, $fname,
			$options, $join_conds
		);
		return $res;
	}

	function printFilters($out, $filters) {
		$out->addHTML(
			Html::openElement('div', array( 'class' => 'row kata-box')) . "\n".
			Html::openElement('div', array( 'class' => 'col-xs-12 kata-box-content' )) . "\n".
			Html::openElement('form', array( 'method' => 'GET', 'onsubmit' => 'return kataDisableEmptyInputs(this);' )). "\n".
			Html::element('input', array('type' => 'hidden', 'value' => $this->useskin, 'name' => 'useskin')). "\n".
			Html::openElement('table', array( 'class' => 'kata-filter-section' ))
		);
		$headers = Html::openElement('tr', array());
		$options = Html::openElement('tr', array());
		foreach ($filters as $filter) {
			$headers .= Html::element('th', array('class' => 'kata-filter-element'), $filter['title']);
			$options .= Html::openElement('td', array('class' => 'kata-filter-element')) .
						$this->createOptions($filter['options'], $filter['name']) .
						Html::closeElement('td');
		}
		$headers .= Html::element('th', array( 'class' => 'kata-filter-element')) .
					Html::closeElement('tr');
		$options .= Html::openElement('td', array( 'class' => 'kata-filter-element')) .
					Html::element('input', array( 'class' => 'kata-button', 'type' => 'submit', 'value' => 'Apply' )) .
					Html::closeElement('td') .
					Html::closeElement('tr');
		$out->addHTML(
			$headers . "\n".
			$options . "\n".
			Html::closeElement( 'table' ) . "\n".
			Html::closeElement( 'form' ) . "\n".
			Html::closeElement( 'div' ) . "\n".
			Html::closeElement( 'div' )
		);
	}
	
	function createOptions($options, $filterName) {
		$html = Html::openElement('select', array( 'class' => 'kata-select', 'name' => $filterName ));
		foreach ($options as $option) {
			$html .= Html::element('option', array('value' =>  $option['value'], 'selected' =>  $option['selected']), $option['name']);
		}
		$html .= Html::closeElement('select');
		return $html;
	}
	
	function printPagination($out, $totalPages, $selectedPage) {
		$urlParams = $this->getRequest()->getQueryValues();
		unset($urlParams['title']);
		$urlParams['page'] = ($selectedPage-1);
		$out->addHTML(
			Html::openElement('ul', array('class' => 'pagination')). "\n".
			Html::openElement('li', array('class' => $selectedPage > 1 ? null : 'disabled')). "\n".
			Html::element('a', array('href' => $selectedPage > 1 ? '?'.http_build_query($urlParams) : null), '«'). "\n".
			Html::closeElement('li')
		);
		
		for($i = 1; $i <= $totalPages; $i++) {
			$urlParams['page'] = $i;
			$out->addHTML(
				Html::openElement('li', array('class' => $selectedPage == $i ? 'active' : '')). "\n".
				Html::element('a', array('href' => '?'.http_build_query($urlParams)), "$i"). "\n".
				Html::closeElement('li')
			);
		}
		$urlParams['page'] = ($selectedPage+1);
		$out->addHTML(
			Html::openElement('li', array('class' => $selectedPage < $totalPages ? null : 'disabled')). "\n".
			Html::element('a', array('href' => $selectedPage < $totalPages ? '?'.http_build_query($urlParams) : null), '»'). "\n".
			Html::closeElement('li'). "\n".
			Html::closeElement('ul')
		);
	}
	
	function printTutorials($out, $tutorials) {
		foreach($tutorials as $tutorial) {
			$this->appendTutorial($out, $tutorial);
		}
	}
	
	function appendTutorial($out, $tutorial) {
		$out->addHTML(
			Html::openElement('div', array( 'class' => 'row kata-box')) . "\n".
			Html::openElement('div', array( 'class' => 'col-xs-12 kata-box-content' )) . "\n".
			Html::openElement('table', array( 'class' => 'kata-result-section' )) . "\n".
			
			Html::openElement('tr', array()) . "\n".
			Html::element('th', array( 'class' => 'kata-result-element' ), 'Name:') . "\n".
			Html::element('th', array( 'class' => 'kata-result-element' ), 'Author:') . "\n".
			Html::element('th', array( 'class' => 'kata-result-element-description' ), 'Description:') . "\n".
			Html::openElement('td', array( 'class' => 'kata-result-element', 'rowspan' => '6' )) . "\n".
			Html::element('img', array( 'src' => $tutorial['image'] )) . "\n".
			Html::closeElement('td') . "\n".
			Html::closeElement('tr') . "\n".
			
			Html::openElement('tr', array()) . "\n".
			Html::element('td', array( 'class' => 'kata-result-element' ), $tutorial['name']) . "\n".
			Html::element('td', array( 'class' => 'kata-result-element' ), $tutorial['author']) . "\n".
			Html::element('td', array( 'class' => 'kata-result-element-description', 'rowspan' => '5' ), $tutorial['description']) . "\n".
			Html::closeElement('tr') . "\n".
			
			Html::openElement('tr', array()) . "\n".
			Html::element('th', array( 'class' => 'kata-result-element' ), 'Skill Level:') . "\n".
			Html::element('th', array( 'class' => 'kata-result-element' ), 'Sessions:') . "\n".
			Html::closeElement('tr') . "\n".
			
			Html::openElement('tr', array()) . "\n".
			Html::element('td', array( 'class' => 'kata-result-element' ), $tutorial['skillLevel']) . "\n".
			Html::element('td', array( 'class' => 'kata-result-element' ), $tutorial['sessions']) . "\n".
			Html::closeElement('tr') . "\n".
			
			Html::openElement('tr', array()) . "\n".
			Html::element('th', array( 'class' => 'kata-result-element', 'colspan' => '2' ), 'Category') . "\n".
			Html::closeElement('tr') . "\n".
			
			Html::openElement('tr', array()) . "\n".
			Html::element('td', array( 'class' => 'kata-result-element', 'colspan' => '2' ), $tutorial['category']) . "\n".
			Html::closeElement('tr') . "\n".
			
			Html::openElement('tr', array()) . "\n".
			Html::element('td', array( 'class' => 'kata-result-element', 'colspan' => '3' )) . "\n".
			Html::openElement('td', array( 'class' => 'kata-result-element' )) . "\n".
			Html::element('button', array( 'class' => 'kata-button' ), 'Start Tutorial') . "\n".
			Html::closeElement('td') . "\n".
			Html::closeElement('tr') . "\n".
			
			Html::closeElement( 'table' ) . "\n".
			Html::closeElement( 'div' ) . "\n".
			Html::closeElement( 'div' )
		);
	}
}

?>