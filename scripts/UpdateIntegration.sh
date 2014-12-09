#!/bin/bash

GIT_HOME=~/git
KATA_HOME=[set/path/to/root/folder/of/your/website]

WIKI_REL=REL1_24
WIKI_BRANCH=$WIKI_REL

KATA_REL=master
KATA_BRANCH=$KATA_REL

cd $GIT_HOME/CoderDojo-Kata
git pull --depth=1

cd $GIT_HOME/CoderDojo-Kata/vendor
git pull --recurse-submodules --depth=1

cd $GIT_HOME/CoderDojo-Kata/skins/Vector
git pull --recurse-submodules --depth=1

cd $GIT_HOME/CoderDojo-Kata/extensions/Parsoid
git pull --recurse-submodules --depth=1
cd $GIT_HOME/CoderDojo-Kata/extensions/TemplateData
git pull --recurse-submodules --depth=1
cd $GIT_HOME/CoderDojo-Kata/extensions/VisualEditor
git pull --recurse-submodules --depth=1

cd $GIT_HOME/CoderDojo-Kata/Kata
git pull --depth=1

cd $GIT_HOME/CoderDojo-Kata-skins/CoderDojoKata
git pull --depth=1
cd $GIT_HOME/CoderDojo-Kata-extensions
git pull --depth=1

mv $GIT_HOME/CoderDojo-Kata-skins/CoderDojoKata/coderdojokata $GIT_HOME/CoderDojo-Kata-skins/CoderDojoKata/CoderDojoKata

rm -rf $GIT_HOME/CoderDojo-Kata/skins/CoderDojoKata
cp -r $GIT_HOME/CoderDojo-Kata-skins/CoderDojoKata/CoderDojoKata $GIT_HOME/CoderDojo-Kata/skins

rm -rf $GIT_HOME/CoderDojo-Kata/extensions/CoderDojoKata
cp -r $GIT_HOME/CoderDojo-Kata-extensions/CoderDojoKata $GIT_HOME/CoderDojo-Kata/extensions

rm -rf $GIT_HOME/CoderDojo-Kata/extensions/W4G
cp -r $GIT_HOME/CoderDojo-Kata-extensions/W4G $GIT_HOME/CoderDojo-Kata/extensions

cd $GIT_HOME

echo -e "Now you can sync (cp, rsync, ftp, git-ftp, etc.) your ${GIT_HOME}/CoderDojo-Kata folder on ${KATA_HOME} folder\n"

#git push

