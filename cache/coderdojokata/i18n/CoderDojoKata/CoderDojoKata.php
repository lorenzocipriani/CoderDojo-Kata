<?php
# Alert the user that this is not a valid access point to MediaWiki if they try to access the special pages file directly.
if ( !defined( 'MEDIAWIKI' ) ) {
	echo <<<EOT
To install this extension, put the following line in LocalSettings.php:
require_once( "\$IP/extensions/CoderDojoKata/CoderDojoKata.php" );
EOT;
	exit( 1 );
}
 
$wgExtensionCredits[ 'specialpage' ][] = array(
	'path' => __FILE__,
	'name' => 'CoderDojoKata',
	'author' => 'Claudio Bertoli',
	'url' => 'https://www.mediawiki.org/wiki/Extension:CoderDojoKata',
	'descriptionmsg' => 'Special pages for CoderDojo Kata',
	'version' => '0.0.1',
);
 
$wgAutoloadClasses[ 'SpecialKataMentors' ] = __DIR__ . '/SpecialKataMentors.php'; # Location of the SpecialKataMentors class (Tell MediaWiki to load this file)
$wgSpecialPages[ 'KataMentors' ] = 'SpecialKataMentors'; # Tell MediaWiki about the new special page and its class name
$wgSpecialPageGroups[ 'SpecialKataMentors' ] = 'other';
$wgExtensionMessagesFiles[ 'SpecialKataMentors' ] = __DIR__ . '/SpecialKataMentors.i18n.php'; # Location of localisation files (Tell MediaWiki to load them)
$wgExtensionMessagesFiles[ 'SpecialKataMentorsAliases' ] = __DIR__ . '/SpecialKataMentors.alias.php'; # Location of localisation files (Tell MediaWiki to load them)

# Mentors tutorial list
$wgAutoloadClasses[ 'SpecialKataMentorsTutorialList' ] = __DIR__ . '/SpecialKataMentorsTutorialList.php'; # Location of the SpecialKataMentors class (Tell MediaWiki to load this file)
$wgSpecialPages[ 'KataMentorsTutorialList' ] = 'SpecialKataMentorsTutorialList'; # Tell MediaWiki about the new special page and its class name
$wgSpecialPageGroups[ 'SpecialKataMentorsTutorialList' ] = 'other';
$wgExtensionMessagesFiles[ 'SpecialKataMentorsTutorialList' ] = __DIR__ . '/SpecialKataMentorsTutorialList.i18n.php'; # Location of localisation files (Tell MediaWiki to load them)
$wgExtensionMessagesFiles[ 'SpecialKataMentorsTutorialListAliases' ] = __DIR__ . '/SpecialKataMentorsTutorialList.alias.php'; # Location of localisation files (Tell MediaWiki to load them)

$wgAutoloadClasses[ 'SpecialKataCourse' ] = __DIR__ . '/SpecialKataCourse.php'; # Location of the SpecialKataMentors class (Tell MediaWiki to load this file)
$wgSpecialPages[ 'KataCourse' ] = 'SpecialKataCourse'; # Tell MediaWiki about the new special page and its class name
$wgSpecialPageGroups[ 'SpecialKataCourse' ] = 'other';
$wgExtensionMessagesFiles[ 'SpecialKataCourse' ] = __DIR__ . '/SpecialKataCourse.i18n.php'; # Location of localisation files (Tell MediaWiki to load them)
$wgExtensionMessagesFiles[ 'SpecialKataCourseAliases' ] = __DIR__ . '/SpecialKataCourse.alias.php'; # Location of localisation files (Tell MediaWiki to load them)

?>