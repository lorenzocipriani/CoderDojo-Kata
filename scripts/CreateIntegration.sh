#!/bin/bash

GIT_HOME=~/git
KATA_HOME="[set/path/to/root/folder/of/your/website]"

WIKI_REL=REL1_24
WIKI_BRANCH=$WIKI_REL

KATA_REL=master
KATA_BRANCH=$KATA_REL

WORKING_DIR=$(pwd)

rm -rf $GIT_HOME/CoderDojo-Kata
rm -rf $GIT_HOME/CoderDojo-Kata-skins
rm -rf $GIT_HOME/CoderDojo-Kata-extensions

git clone --depth=1 --branch $WIKI_REL https://gerrit.wikimedia.org/r/p/mediawiki/core.git $GIT_HOME/CoderDojo-Kata

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

git clone --depth=1 --recurse-submodules --branch $WIKI_REL https://gerrit.wikimedia.org/r/p/mediawiki/extensions/SemanticMediaWiki.git $GIT_HOME/CoderDojo-Kata/extensions/SemanticMediaWiki
git clone --depth=1 --recurse-submodules --branch $WIKI_REL https://gerrit.wikimedia.org/r/p/mediawiki/extensions/Interfaces.git $GIT_HOME/CoderDojo-Kata/extensions/Interfaces
git clone --depth=1 --recurse-submodules --branch $WIKI_REL https://gerrit.wikimedia.org/r/p/mediawiki/extensions/DataValues.git $GIT_HOME/CoderDojo-Kata/extensions/DataValues
git clone --depth=1 --recurse-submodules --branch $WIKI_REL https://gerrit.wikimedia.org/r/p/mediawiki/extensions/Common.git $GIT_HOME/CoderDojo-Kata/extensions/Common
git clone --depth=1 --recurse-submodules --branch $WIKI_REL https://gerrit.wikimedia.org/r/p/mediawiki/extensions/Validators.git $GIT_HOME/CoderDojo-Kata/extensions/Validators
git clone --depth=1 --recurse-submodules --branch $WIKI_REL https://gerrit.wikimedia.org/r/p/mediawiki/extensions/Time.git $GIT_HOME/CoderDojo-Kata/extensions/Time
git clone --depth=1 --recurse-submodules --branch $WIKI_REL https://gerrit.wikimedia.org/r/p/mediawiki/extensions/Geo.git $GIT_HOME/CoderDojo-Kata/extensions/Geo
git clone --depth=1 --recurse-submodules --branch $WIKI_REL https://gerrit.wikimedia.org/r/p/mediawiki/extensions/ParamProcessor.git $GIT_HOME/CoderDojo-Kata/extensions/ParamProcessor
git clone --depth=1 --recurse-submodules --branch $WIKI_REL https://gerrit.wikimedia.org/r/p/mediawiki/extensions/Validator.git $GIT_HOME/CoderDojo-Kata/extensions/Validator
git clone --depth=1 --recurse-submodules --branch $WIKI_REL https://gerrit.wikimedia.org/r/p/mediawiki/extensions/SemanticExtraSpecialProperties.git $GIT_HOME/CoderDojo-Kata/extensions/SemanticExtraSpecialProperties
git clone --depth=1 --recurse-submodules --branch $WIKI_REL https://gerrit.wikimedia.org/r/p/mediawiki/extensions/SemanticResultFormats.git $GIT_HOME/CoderDojo-Kata/extensions/SemanticResultFormats
git clone --depth=1 --recurse-submodules --branch $WIKI_REL https://gerrit.wikimedia.org/r/p/mediawiki/extensions/SemanticForms.git $GIT_HOME/CoderDojo-Kata/extensions/SemanticForms
git clone --depth=1 --recurse-submodules --branch $WIKI_REL https://gerrit.wikimedia.org/r/p/mediawiki/extensions/SemanticFormsInputs.git $GIT_HOME/CoderDojo-Kata/extensions/SemanticFormsInputs
git clone --depth=1 --recurse-submodules --branch $WIKI_REL https://gerrit.wikimedia.org/r/p/mediawiki/extensions/SemanticCompoundQueries.git $GIT_HOME/CoderDojo-Kata/extensions/SemanticCompoundQueries
git clone --depth=1 --recurse-submodules --branch $WIKI_REL https://gerrit.wikimedia.org/r/p/mediawiki/extensions/SemanticDrilldown.git $GIT_HOME/CoderDojo-Kata/extensions/SemanticDrilldown
git clone --depth=1 --recurse-submodules --branch $WIKI_REL https://gerrit.wikimedia.org/r/p/mediawiki/extensions/SemanticMaps.git $GIT_HOME/CoderDojo-Kata/extensions/SemanticMaps
git clone --depth=1 --recurse-submodules --branch $WIKI_REL https://gerrit.wikimedia.org/r/p/mediawiki/extensions/SemanticImageInput.git $GIT_HOME/CoderDojo-Kata/extensions/SemanticImageInput
git clone --depth=1 --recurse-submodules --branch $WIKI_REL https://gerrit.wikimedia.org/r/p/mediawiki/extensions/SemanticInternalObjects.git $GIT_HOME/CoderDojo-Kata/extensions/SemanticInternalObjects
git clone --depth=1 --recurse-submodules --branch $WIKI_REL https://gerrit.wikimedia.org/r/p/mediawiki/extensions/SemanticWatchlist.git $GIT_HOME/CoderDojo-Kata/extensions/SemanticWatchlist
git clone --depth=1 --recurse-submodules --branch $WIKI_REL https://gerrit.wikimedia.org/r/p/mediawiki/extensions/AdminLinks.git $GIT_HOME/CoderDojo-Kata/extensions/AdminLinks
git clone --depth=1 --recurse-submodules --branch $WIKI_REL https://gerrit.wikimedia.org/r/p/mediawiki/extensions/ApprovedRevs.git $GIT_HOME/CoderDojo-Kata/extensions/ApprovedRevs
git clone --depth=1 --recurse-submodules --branch $WIKI_REL https://gerrit.wikimedia.org/r/p/mediawiki/extensions/Arrays.git $GIT_HOME/CoderDojo-Kata/extensions/Arrays
git clone --depth=1 --recurse-submodules --branch $WIKI_REL https://gerrit.wikimedia.org/r/p/mediawiki/extensions/DataTransfer.git $GIT_HOME/CoderDojo-Kata/extensions/DataTransfer
git clone --depth=1 --recurse-submodules --branch $WIKI_REL https://gerrit.wikimedia.org/r/p/mediawiki/extensions/ExternalData.git $GIT_HOME/CoderDojo-Kata/extensions/ExternalData
git clone --depth=1 --recurse-submodules --branch $WIKI_REL https://gerrit.wikimedia.org/r/p/mediawiki/extensions/HeaderTabs.git $GIT_HOME/CoderDojo-Kata/extensions/HeaderTabs
git clone --depth=1 --recurse-submodules --branch $WIKI_REL https://gerrit.wikimedia.org/r/p/mediawiki/extensions/Maps.git $GIT_HOME/CoderDojo-Kata/extensions/Maps
git clone --depth=1 --recurse-submodules --branch $WIKI_REL https://gerrit.wikimedia.org/r/p/mediawiki/extensions/PageSchemas.git $GIT_HOME/CoderDojo-Kata/extensions/PageSchemas
git clone --depth=1 --recurse-submodules --branch $WIKI_REL https://gerrit.wikimedia.org/r/p/mediawiki/extensions/ReplaceText.git $GIT_HOME/CoderDojo-Kata/extensions/ReplaceText
git clone --depth=1 --recurse-submodules --branch $WIKI_REL https://gerrit.wikimedia.org/r/p/mediawiki/extensions/Widgets.git $GIT_HOME/CoderDojo-Kata/extensions/Widgets

#echo -e "Building the SemanticBundle extension"
#cd $GIT_HOME/CoderDojo-Kata/extensions/SemanticBundle
#rm -rf release
#mkdir release
#awk '{ system("cd release && git clone https://"$$2"/"$$1".git && cd "$$1" && git checkout "$$3" && git submodule init && git submodule update && rm -r .* && cd ../..") }' < externals
#cd $WORKING_DIR

git clone --depth=1 --branch $WIKI_REL https://github.com/lorenzocipriani/CoderDojo-Kata.git $GIT_HOME/CoderDojo-Kata/Kata

git clone --depth=1 --branch $KATA_BRANCH https://bitbucket.org/lorenzocipriani/coderdojokata_skin.git $GIT_HOME/CoderDojo-Kata-skins/CoderDojoKata
git clone --depth=1 --branch $KATA_BRANCH https://bitbucket.org/lorenzocipriani/coderdojokata_extensions.git $GIT_HOME/CoderDojo-Kata-extensions

mv $GIT_HOME/CoderDojo-Kata-skins/CoderDojoKata/coderdojokata $GIT_HOME/CoderDojo-Kata-skins/CoderDojoKata/CoderDojoKata
cp -r $GIT_HOME/CoderDojo-Kata-skins/CoderDojoKata/CoderDojoKata $GIT_HOME/CoderDojo-Kata/skins
cp -r $GIT_HOME/CoderDojo-Kata-extensions/CoderDojoKata $GIT_HOME/CoderDojo-Kata/extensions
cp -r $GIT_HOME/CoderDojo-Kata-extensions/W4G $GIT_HOME/CoderDojo-Kata/extensions

echo -e "Now you can sync (cp, rsync, ftp, git-ftp, etc.) your ${GIT_HOME}/CoderDojo-Kata folder on ${KATA_HOME} folder.\n"
echo -e "E.g.:\nrsync -a ${GIT_HOME}/CoderDojo-Kata/* ${KATA_HOME}\n"

#git push
