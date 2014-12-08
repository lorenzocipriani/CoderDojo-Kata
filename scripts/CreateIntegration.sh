#!/bin/bash

GIT_HOME=~/git
WIKI_REL=REL1_24
WIKI_BRANCH=$WIKI_REL
KATA_REL=master
KATA_BRANCH=$KATA_REL

rm -rf $GIT_HOME/CoderDojo-Kata
rm -rf $GIT_HOME/CoderDojo-Kata-skins
rm -rf $GIT_HOME/CoderDojo-Kata-extensions

git clone --depth=1 --branch $WIKI_REL https://gerrit.wikimedia.org/r/p/mediawiki/core.git $GIT_HOME/CoderDojo-Kata

git clone --depth=1 --recurse-submodules https://gerrit.wikimedia.org/r/p/mediawiki/vendor.git $GIT_HOME/CoderDojo-Kata/vendor

git clone --depth=1 --recurse-submodules --branch $WIKI_REL https://gerrit.wikimedia.org/r/p/mediawiki/skins/Vector.git $GIT_HOME/CoderDojo-Kata/skins/Vector

git clone --depth=1 --recurse-submodules --branch $WIKI_REL https://gerrit.wikimedia.org/r/p/mediawiki/extensions/Parsoid.git $GIT_HOME/CoderDojo-Kata/extensions/Parsoid
git clone --depth=1 --recurse-submodules --branch $WIKI_REL https://gerrit.wikimedia.org/r/p/mediawiki/extensions/TemplateData.git $GIT_HOME/CoderDojo-Kata/extensions/TemplateData
git clone --depth=1 --recurse-submodules --branch $WIKI_REL https://gerrit.wikimedia.org/r/p/mediawiki/extensions/VisualEditor.git $GIT_HOME/CoderDojo-Kata/extensions/VisualEditor

git clone --depth=1 --branch $WIKI_REL https://github.com/lorenzocipriani/CoderDojo-Kata.git $GIT_HOME/CoderDojo-Kata/Kata

git clone --depth=1 --branch $KATA_BRANCH https://bitbucket.org/lorenzocipriani/coderdojokata_skin.git $GIT_HOME/CoderDojo-Kata-skins/CoderDojoKata
git clone --depth=1 --branch $KATA_BRANCH https://bitbucket.org/lorenzocipriani/coderdojokata_extensions.git $GIT_HOME/CoderDojo-Kata-extensions

mv $GIT_HOME/CoderDojo-Kata-skins/CoderDojoKata/coderdojokata $GIT_HOME/CoderDojo-Kata-skins/CoderDojoKata/CoderDojoKata
cp -r $GIT_HOME/CoderDojo-Kata-skins/CoderDojoKata/CoderDojoKata $GIT_HOME/CoderDojo-Kata/skins
cp -r $GIT_HOME/CoderDojo-Kata-extensions/CoderDojoKata $GIT_HOME/CoderDojo-Kata/extensions
cp -r $GIT_HOME/CoderDojo-Kata-extensions/W4G $GIT_HOME/CoderDojo-Kata/extensions

#git push
