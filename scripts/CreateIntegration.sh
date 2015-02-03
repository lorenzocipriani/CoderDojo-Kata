#!/bin/bash

GIT_HOME=~/git
KATA_HOME=[/set/path/to/root/folder/of/your/website]
PHP_CLI=[/set/path/to/root/folder/of/your/php/cli]

WIKI_REL=REL1_24
WIKI_BRANCH=$WIKI_REL

KATA_REL=master
KATA_BRANCH=$KATA_REL

WORKING_DIR=$PWD

if [-d "${GIT_HOME}/CoderDojo-Kata"]
then
    rm -rf $GIT_HOME/CoderDojo-Kata
    rm -rf $GIT_HOME/CoderDojo-Kata-skins
    rm -rf $GIT_HOME/CoderDojo-Kata-extensions
fi

git clone --depth=1 --branch $WIKI_REL https://gerrit.wikimedia.org/r/p/mediawiki/core.git $GIT_HOME/CoderDojo-Kata/core

cd $GIT_HOME/CoderDojo-Kata/core
$PHP_CLI -r "readfile('https://getcomposer.org/installer');" | $PHP_CLI
cd $WORKING_DIR

git clone --depth=1 --recurse-submodules https://gerrit.wikimedia.org/r/p/mediawiki/vendor.git $GIT_HOME/CoderDojo-Kata/vendor

git clone --depth=1 --recurse-submodules --branch $WIKI_REL https://gerrit.wikimedia.org/r/p/mediawiki/skins/Vector.git $GIT_HOME/CoderDojo-Kata/skins/Vector

git clone --depth=1 --recurse-submodules --branch $WIKI_REL https://gerrit.wikimedia.org/r/p/mediawiki/extensions/ParserFunctions.git $GIT_HOME/CoderDojo-Kata/extensions/ParserFunctions
git clone --depth=1 --recurse-submodules --branch $WIKI_REL https://gerrit.wikimedia.org/r/p/mediawiki/extensions/Parsoid.git $GIT_HOME/CoderDojo-Kata/extensions/Parsoid
git clone --depth=1 --recurse-submodules --branch $WIKI_REL https://gerrit.wikimedia.org/r/p/mediawiki/extensions/TemplateData.git $GIT_HOME/CoderDojo-Kata/extensions/TemplateData
git clone --depth=1 --recurse-submodules --branch $WIKI_REL https://gerrit.wikimedia.org/r/p/mediawiki/extensions/VisualEditor.git $GIT_HOME/CoderDojo-Kata/extensions/VisualEditor
git clone --depth=1 --recurse-submodules --branch $WIKI_REL https://gerrit.wikimedia.org/r/p/mediawiki/extensions/Babel.git $GIT_HOME/CoderDojo-Kata/extensions/Babel
git clone --depth=1 --recurse-submodules --branch $WIKI_REL https://gerrit.wikimedia.org/r/p/mediawiki/extensions/cldr.git $GIT_HOME/CoderDojo-Kata/extensions/cldr
git clone --depth=1 --recurse-submodules --branch $WIKI_REL https://gerrit.wikimedia.org/r/p/mediawiki/extensions/CleanChanges.git $GIT_HOME/CoderDojo-Kata/extensions/CleanChanges
git clone --depth=1 --recurse-submodules --branch $WIKI_REL https://gerrit.wikimedia.org/r/p/mediawiki/extensions/LocalisationUpdate.git $GIT_HOME/CoderDojo-Kata/extensions/LocalisationUpdate
git clone --depth=1 --recurse-submodules --branch $WIKI_REL https://gerrit.wikimedia.org/r/p/mediawiki/extensions/Translate.git $GIT_HOME/CoderDojo-Kata/extensions/Translate
git clone --depth=1 --recurse-submodules --branch $WIKI_REL https://gerrit.wikimedia.org/r/p/mediawiki/extensions/UniversalLanguageSelector.git $GIT_HOME/CoderDojo-Kata/extensions/UniversalLanguageSelector

#cd $GIT_HOME/CoderDojo-Kata
#echo -e "Composer: installing semantic-media-wiki"
#$PHP_CLI composer.phar require mediawiki/semantic-media-wiki "~2.1"
#echo -e "Composer: installing semantic-extra-special-properties"
#$PHP_CLI composer.phar require mediawiki/semantic-extra-special-properties:~1.2
#echo -e "Composer: installing semantic-result-formats"
#$PHP_CLI composer.phar require mediawiki/semantic-result-formats "1.9.*"
#echo -e "Composer: installing semantic-maps"
#$PHP_CLI composer.phar require mediawiki/semantic-maps "*"
#echo -e "Composer: installing semantic-watchlist"
#$PHP_CLI composer.phar require mediawiki/semantic-watchlist:~1.0
#cd $WORKING_DIR

git clone --depth=1 --recurse-submodules --branch $WIKI_REL https://gerrit.wikimedia.org/r/p/mediawiki/extensions/SemanticForms.git $GIT_HOME/CoderDojo-Kata/extensions/SemanticForms
git clone --depth=1 --recurse-submodules --branch $WIKI_REL https://gerrit.wikimedia.org/r/p/mediawiki/extensions/SemanticFormsInputs.git $GIT_HOME/CoderDojo-Kata/extensions/SemanticFormsInputs
git clone --depth=1 --recurse-submodules --branch $WIKI_REL https://gerrit.wikimedia.org/r/p/mediawiki/extensions/SemanticCompoundQueries.git $GIT_HOME/CoderDojo-Kata/extensions/SemanticCompoundQueries
git clone --depth=1 --recurse-submodules --branch $WIKI_REL https://gerrit.wikimedia.org/r/p/mediawiki/extensions/SemanticDrilldown.git $GIT_HOME/CoderDojo-Kata/extensions/SemanticDrilldown
git clone --depth=1 --recurse-submodules --branch $WIKI_REL https://gerrit.wikimedia.org/r/p/mediawiki/extensions/SemanticImageInput.git $GIT_HOME/CoderDojo-Kata/extensions/SemanticImageInput
git clone --depth=1 --recurse-submodules --branch $WIKI_REL https://gerrit.wikimedia.org/r/p/mediawiki/extensions/SemanticInternalObjects.git $GIT_HOME/CoderDojo-Kata/extensions/SemanticInternalObjects
git clone --depth=1 --recurse-submodules --branch $WIKI_REL https://gerrit.wikimedia.org/r/p/mediawiki/extensions/SemanticSignup.git $GIT_HOME/CoderDojo-Kata/extensions/SemanticSignup
git clone --depth=1 --recurse-submodules --branch $WIKI_REL https://gerrit.wikimedia.org/r/p/mediawiki/extensions/AdminLinks.git $GIT_HOME/CoderDojo-Kata/extensions/AdminLinks
git clone --depth=1 --recurse-submodules --branch $WIKI_REL https://gerrit.wikimedia.org/r/p/mediawiki/extensions/ApprovedRevs.git $GIT_HOME/CoderDojo-Kata/extensions/ApprovedRevs
#git clone --depth=1 --recurse-submodules --branch $WIKI_REL https://gerrit.wikimedia.org/r/p/mediawiki/extensions/Arrays.git $GIT_HOME/CoderDojo-Kata/extensions/Arrays
git clone --depth=1 --recurse-submodules --branch $WIKI_REL https://gerrit.wikimedia.org/r/p/mediawiki/extensions/DataTransfer.git $GIT_HOME/CoderDojo-Kata/extensions/DataTransfer
git clone --depth=1 --recurse-submodules --branch $WIKI_REL https://gerrit.wikimedia.org/r/p/mediawiki/extensions/ExternalData.git $GIT_HOME/CoderDojo-Kata/extensions/ExternalData
git clone --depth=1 --recurse-submodules --branch $WIKI_REL https://gerrit.wikimedia.org/r/p/mediawiki/extensions/HeaderTabs.git $GIT_HOME/CoderDojo-Kata/extensions/HeaderTabs
#git clone --depth=1 --recurse-submodules --branch $WIKI_REL https://gerrit.wikimedia.org/r/p/mediawiki/extensions/Maps.git $GIT_HOME/CoderDojo-Kata/extensions/Maps
#git clone --depth=1 --recurse-submodules --branch $WIKI_REL https://gerrit.wikimedia.org/r/p/mediawiki/extensions/PageSchemas.git $GIT_HOME/CoderDojo-Kata/extensions/PageSchemas
git clone --depth=1 --recurse-submodules --branch $WIKI_REL https://gerrit.wikimedia.org/r/p/mediawiki/extensions/ReplaceText.git $GIT_HOME/CoderDojo-Kata/extensions/ReplaceText
git clone --depth=1 --recurse-submodules --branch $WIKI_REL https://gerrit.wikimedia.org/r/p/mediawiki/extensions/Widgets.git $GIT_HOME/CoderDojo-Kata/extensions/Widgets

git clone --depth=1 --recurse-submodules --branch master https://github.com/Alexia/mediawiki-embedvideo.git $GIT_HOME/CoderDojo-Kata/extensions/EmbedVideo

git clone --depth=1 --branch $WIKI_REL https://github.com/lorenzocipriani/CoderDojo-Kata.git $GIT_HOME/CoderDojo-Kata/Kata

git clone --depth=1 --branch $KATA_BRANCH https://bitbucket.org/lorenzocipriani/coderdojokata_skin.git $GIT_HOME/CoderDojo-Kata/skins/CoderDojoKata
git clone --depth=1 --branch $KATA_BRANCH https://bitbucket.org/lorenzocipriani/coderdojokata_extensions.git $GIT_HOME/CoderDojo-Kata/extensions/CoderDojoKata

mv $GIT_HOME/CoderDojo-Kata/skins/CoderDojoKata/coderdojokata $GIT_HOME/CoderDojo-Kata/skins/CoderDojoKata/CoderDojoKata
cp -r $GIT_HOME/CoderDojo-Kata/skins/CoderDojoKata/CoderDojoKata $GIT_HOME/CoderDojo-Kata/skins
cp -r $GIT_HOME/CoderDojo-Kata-extensions/CoderDojoKata $GIT_HOME/CoderDojo-Kata/extensions
cp -r $GIT_HOME/CoderDojo-Kata-extensions/W4G $GIT_HOME/CoderDojo-Kata/extensions

echo -e "Now you can sync (cp, rsync, ftp, git-ftp, etc.) your ${GIT_HOME}/CoderDojo-Kata folder on ${KATA_HOME} folder.\n"
echo -e "E.g.:\nrsync -a ${GIT_HOME}/CoderDojo-Kata/* ${KATA_HOME}\n"

#git push
