<?php
/**
 * Shows a widget with viewing blog entries
 * by months or years.
 * 
 * @package blog
 */

/**
 * Matt's Archive Widget!  It's pretty funky. Oh yes.
 */
class BetterArchiveWidget extends Widget {
	static $title = 'Archives';

	static $cmsTitle = 'Better Blog Archive';

	static $description = 'Provides a sidebar widget for easy archive navigation.';	

	function ArchivePosts() {
		// Set suffix for query depending on current stage
		$curStage = Versioned::current_stage();
		$suffix = Versioned::get_live_stage() == $curStage ? '_Live' : '_' . $curStage;
		
		// Construct query to grab & customize blog posts
		$sqlQuery = new SQLQuery();
		$sqlQuery->select = array(
			'*',
			'MONTHNAME(BlogEntry'.$suffix.'.Date) AS Month',
			'YEAR(BlogEntry'.$suffix.'.Date) AS Year',
		);
		$sqlQuery->from = array(
			"BlogEntry$suffix"
		);
		$sqlQuery->innerJoin("SiteTree".$suffix,"SiteTree".$suffix.".ID = BlogEntry".$suffix.".ID");
		$sqlQuery->orderby = ("BlogEntry".$suffix.".Date DESC");
		
		// Results need to have: month, year, title, link
		$result = $sqlQuery->execute();

		$results = new DataObjectSet();

		$newMonth = false;
		$newYear = false;
		$lastMonth = null;
		$lastYear = null;
		
		$results = new DataObjectSet();
		foreach($result as $entry){
			$BlogEntry = new BlogEntry($entry);
			
			if($BlogEntry->Month != $lastMonth) {
				$newMonth = true;
				$lastMonth = $BlogEntry->Month;
			} else {
				$newMonth = false;
			}
			if($BlogEntry->Year != $lastYear) {
				$newYear = true;
				$lastYear = $BlogEntry->Year;
			} else {
				$newYear = false;
			}
			
			$BlogEntry->NewYear = $newYear;
			$BlogEntry->NewMonth = $newMonth;
			$results->push($BlogEntry);
		}
		return $results;
	}
}

class BetterArchiveWidget_Controller extends Widget_Controller {
}
