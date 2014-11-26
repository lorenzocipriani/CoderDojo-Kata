<?php
/**
 * CoderDojo Kata skin
 *
 * @file
 * @ingroup Skins
 * @author CoderDojo Foundation
 * @license http://www.gnu.org/copyleft/gpl.html GNU General Public License 2.0 or later
 */
 
if ( !defined( 'MEDIAWIKI' ) )
{
   die( 'This is an extension to the MediaWiki package and cannot be run standalone.' );
}
 
$wgExtensionCredits['skin'][] = array(
	'path' => __FILE__,
	'name' => 'CoderDojo Kata MENTORS', 
	'namemsg' => 'skinname-coderdojokata',
	'version' => '1.0',
	'url' => 'https://www.mediawiki.org/wiki/Skin:CoderDojoKata',
	'author' => '[https://mediawiki.org/wiki/User:CoderDojo Foundation]',
	'descriptionmsg' => 'coderdojokata-desc',
	'license' => 'GPL-2.0+',
);

$wgValidSkinNames['coderdojokatamentors'] = 'CoderDojoKataMentors';
 
$wgAutoloadClasses['SkinCoderDojoKataMentors'] = __DIR__ . '/CoderDojoKataMentors.skin.php';
$wgMessagesDirs['CoderDojoKata'] = __DIR__ . '/i18n';

$wgResourceModules['skins.coderdojokatamentors'] = array(
	'scripts' => array(
		'coderdojokatamentors/resources/alpha-filter.js'
	),
	'styles' => array(
		'coderdojokata/resources/bootstrap.min.css' => array( 'media' => 'screen' ),
		'coderdojokata/resources/style.css' => array( 'media' => 'screen' ),
		'coderdojokata/resources/theme.css' => array( 'media' => 'screen' ),
		'coderdojokata/resources/screen.css' => array( 'media' => 'screen' ),
		'coderdojokatamentors/resources/screen.css' => array( 'media' => 'screen' )
	),
	'remoteBasePath' => &$GLOBALS['wgStylePath'],
	'localBasePath' => &$GLOBALS['wgStyleDirectory'],
);

?>
