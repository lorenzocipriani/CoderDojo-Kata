<?php
$wgResourceModules['skins.coderdojokata'] = array(
    'styles' => array(
        'common/commonElements.css' => array( 'media' => 'screen' ),
        'common/commonContent.css' => array( 'media' => 'screen' ),
        'common/commonInterface.css' => array( 'media' => 'screen' ),
        'coderdojokata/screen.css' => array( 'media' => 'screen' ),
        'coderdojokata/test.css' => array( 'media' => 'screen' ),
    ),
    'scripts' => 'coderdojokata/vector.js',
    'remoteBasePath' => $GLOBALS['wgStylePath'],
    'localBasePath' => $GLOBALS['wgStyleDirectory'],
);

$wgValidSkinNames['coderdojokata'] = 'CoderdojoKata';
$wgAutoloadClasses['SkinCoderdojoKata'] = __DIR__ . '/coderdojokata.php';
#$wgMessagesDirs['CoderdojoKata'] = __DIR__ . '/i18n';
?>
