#!/bin/bash

source ./build.properties

if [ -d "${GIT_HOME}/CoderDojo-Kata" ]
then
    rm -rf $GIT_HOME/CoderDojo-Kata
fi

git $SSL clone --depth=1 --branch $WIKI_REL https://gerrit.wikimedia.org/r/p/mediawiki/core.git $GIT_HOME/CoderDojo-Kata/core

git $SSL clone --depth=1 --recurse-submodules https://gerrit.wikimedia.org/r/p/mediawiki/vendor.git $GIT_HOME/CoderDojo-Kata/vendor

git $SSL clone --depth=1 --recurse-submodules --branch $WIKI_REL https://gerrit.wikimedia.org/r/p/mediawiki/skins/Vector.git $GIT_HOME/CoderDojo-Kata/skins/Vector

git $SSL clone --depth=1 --recurse-submodules --branch $WIKI_REL https://gerrit.wikimedia.org/r/p/mediawiki/extensions/ParserFunctions.git $GIT_HOME/CoderDojo-Kata/extensions/ParserFunctions
git $SSL clone --depth=1 --recurse-submodules --branch $WIKI_REL https://gerrit.wikimedia.org/r/p/mediawiki/extensions/Parsoid.git $GIT_HOME/CoderDojo-Kata/extensions/Parsoid
git $SSL clone --depth=1 --recurse-submodules --branch $WIKI_REL https://gerrit.wikimedia.org/r/p/mediawiki/extensions/TemplateData.git $GIT_HOME/CoderDojo-Kata/extensions/TemplateData
git $SSL clone --depth=1 --recurse-submodules --branch $WIKI_REL https://gerrit.wikimedia.org/r/p/mediawiki/extensions/VisualEditor.git $GIT_HOME/CoderDojo-Kata/extensions/VisualEditor
git $SSL clone --depth=1 --recurse-submodules --branch $WIKI_REL https://gerrit.wikimedia.org/r/p/mediawiki/extensions/Babel.git $GIT_HOME/CoderDojo-Kata/extensions/Babel
git $SSL clone --depth=1 --recurse-submodules --branch $WIKI_REL https://gerrit.wikimedia.org/r/p/mediawiki/extensions/cldr.git $GIT_HOME/CoderDojo-Kata/extensions/cldr
git $SSL clone --depth=1 --recurse-submodules --branch $WIKI_REL https://gerrit.wikimedia.org/r/p/mediawiki/extensions/CleanChanges.git $GIT_HOME/CoderDojo-Kata/extensions/CleanChanges
git $SSL clone --depth=1 --recurse-submodules --branch $WIKI_REL https://gerrit.wikimedia.org/r/p/mediawiki/extensions/LocalisationUpdate.git $GIT_HOME/CoderDojo-Kata/extensions/LocalisationUpdate
git $SSL clone --depth=1 --recurse-submodules --branch $WIKI_REL https://gerrit.wikimedia.org/r/p/mediawiki/extensions/Translate.git $GIT_HOME/CoderDojo-Kata/extensions/Translate
git $SSL clone --depth=1 --recurse-submodules --branch $WIKI_REL https://gerrit.wikimedia.org/r/p/mediawiki/extensions/UniversalLanguageSelector.git $GIT_HOME/CoderDojo-Kata/extensions/UniversalLanguageSelector

git $SSL clone --depth=1 --recurse-submodules --branch $WIKI_REL https://gerrit.wikimedia.org/r/p/mediawiki/extensions/SemanticForms.git $GIT_HOME/CoderDojo-Kata/extensions/SemanticForms
git $SSL clone --depth=1 --recurse-submodules --branch $WIKI_REL https://gerrit.wikimedia.org/r/p/mediawiki/extensions/SemanticFormsInputs.git $GIT_HOME/CoderDojo-Kata/extensions/SemanticFormsInputs
git $SSL clone --depth=1 --recurse-submodules --branch $WIKI_REL https://gerrit.wikimedia.org/r/p/mediawiki/extensions/SemanticCompoundQueries.git $GIT_HOME/CoderDojo-Kata/extensions/SemanticCompoundQueries
git $SSL clone --depth=1 --recurse-submodules --branch $WIKI_REL https://gerrit.wikimedia.org/r/p/mediawiki/extensions/SemanticDrilldown.git $GIT_HOME/CoderDojo-Kata/extensions/SemanticDrilldown
git $SSL clone --depth=1 --recurse-submodules --branch $WIKI_REL https://gerrit.wikimedia.org/r/p/mediawiki/extensions/SemanticImageInput.git $GIT_HOME/CoderDojo-Kata/extensions/SemanticImageInput
git $SSL clone --depth=1 --recurse-submodules --branch $WIKI_REL https://gerrit.wikimedia.org/r/p/mediawiki/extensions/SemanticInternalObjects.git $GIT_HOME/CoderDojo-Kata/extensions/SemanticInternalObjects
git $SSL clone --depth=1 --recurse-submodules --branch $WIKI_REL https://gerrit.wikimedia.org/r/p/mediawiki/extensions/SemanticSignup.git $GIT_HOME/CoderDojo-Kata/extensions/SemanticSignup
git $SSL clone --depth=1 --recurse-submodules --branch $WIKI_REL https://gerrit.wikimedia.org/r/p/mediawiki/extensions/AdminLinks.git $GIT_HOME/CoderDojo-Kata/extensions/AdminLinks
git $SSL clone --depth=1 --recurse-submodules --branch $WIKI_REL https://gerrit.wikimedia.org/r/p/mediawiki/extensions/ApprovedRevs.git $GIT_HOME/CoderDojo-Kata/extensions/ApprovedRevs
#git clone --depth=1 --recurse-submodules --branch $WIKI_REL https://gerrit.wikimedia.org/r/p/mediawiki/extensions/Arrays.git $GIT_HOME/CoderDojo-Kata/extensions/Arrays
git $SSL clone --depth=1 --recurse-submodules --branch $WIKI_REL https://gerrit.wikimedia.org/r/p/mediawiki/extensions/DataTransfer.git $GIT_HOME/CoderDojo-Kata/extensions/DataTransfer
git $SSL clone --depth=1 --recurse-submodules --branch $WIKI_REL https://gerrit.wikimedia.org/r/p/mediawiki/extensions/ExternalData.git $GIT_HOME/CoderDojo-Kata/extensions/ExternalData
git $SSL clone --depth=1 --recurse-submodules --branch $WIKI_REL https://gerrit.wikimedia.org/r/p/mediawiki/extensions/HeaderTabs.git $GIT_HOME/CoderDojo-Kata/extensions/HeaderTabs
#git clone --depth=1 --recurse-submodules --branch $WIKI_REL https://gerrit.wikimedia.org/r/p/mediawiki/extensions/Maps.git $GIT_HOME/CoderDojo-Kata/extensions/Maps
#git clone --depth=1 --recurse-submodules --branch $WIKI_REL https://gerrit.wikimedia.org/r/p/mediawiki/extensions/PageSchemas.git $GIT_HOME/CoderDojo-Kata/extensions/PageSchemas
git $SSL clone --depth=1 --recurse-submodules --branch $WIKI_REL https://gerrit.wikimedia.org/r/p/mediawiki/extensions/ReplaceText.git $GIT_HOME/CoderDojo-Kata/extensions/ReplaceText
git $SSL clone --depth=1 --recurse-submodules --branch $WIKI_REL https://gerrit.wikimedia.org/r/p/mediawiki/extensions/Widgets.git $GIT_HOME/CoderDojo-Kata/extensions/Widgets

git clone --depth=1 --recurse-submodules --branch master https://github.com/Alexia/mediawiki-embedvideo.git $GIT_HOME/CoderDojo-Kata/extensions/EmbedVideo

git clone --depth=1 --branch $WIKI_REL https://github.com/lorenzocipriani/CoderDojo-Kata.git $GIT_HOME/CoderDojo-Kata/Kata

git clone --depth=1 --branch $KATA_BRANCH https://bitbucket.org/lorenzocipriani/coderdojokata_skin.git $GIT_HOME/CoderDojo-Kata/kata-skins
git clone --depth=1 --branch $KATA_BRANCH https://bitbucket.org/lorenzocipriani/coderdojokata_extensions.git $GIT_HOME/CoderDojo-Kata/kata-extensions

#if [ -d "$GIT_HOME/CoderDojo-Kata/kata-skins/coderdojokata" ]
#then
#    mv $GIT_HOME/CoderDojo-Kata/kata-skins/coderdojokata $GIT_HOME/CoderDojo-Kata/kata-skins/CoderDojoKata
#fi

#if [ ! -d "$GIT_HOME/CoderDojo-Kata/composer" ]
#then
#    mkdir $GIT_HOME/CoderDojo-Kata/composer
#fi
#cd $GIT_HOME/CoderDojo-Kata/composer
#$PHP_CLI -r "readfile('https://getcomposer.org/installer');" | $PHP_CLI
#cd $WORKING_DIR

echo -e "Now you can build your integration running\n${WORKING_DIR}/BuildIntegration.sh\n"
