#!/bin/bash

source ./build.properties

if [ ! -d "${GIT_HOME}/CoderDojo-Kata" ]
then
    exit 1
fi

if [ ! -d "${KATA_BUILD}" ]
then
    mkdir $KATA_BUILD
fi

rsync -a --exclude '.git' --exclude '.git*' --exclude '.js*' --exclude '.travis*' ${GIT_HOME}/CoderDojo-Kata/core/* ${KATA_BUILD}/
rsync -a --exclude '.git' --exclude '.git*' --exclude '.js*' --exclude '.travis*' ${GIT_HOME}/CoderDojo-Kata/vendor ${KATA_BUILD}/
rsync -a --exclude '.git' --exclude '.git*' --exclude '.js*' --exclude '.travis*' ${GIT_HOME}/CoderDojo-Kata/skins ${KATA_BUILD}/
rsync -a --exclude '.git' --exclude '.git*' --exclude '.js*' --exclude '.travis*' ${GIT_HOME}/CoderDojo-Kata/extensions ${KATA_BUILD}/
rsync -a --exclude '.git' --exclude '.git*' --exclude '.js*' --exclude '.travis*' ${GIT_HOME}/CoderDojo-Kata/Kata ${KATA_BUILD}/
rsync -a --exclude '.git' --exclude '.git*' --exclude '.js*' --exclude '.travis*' ${GIT_HOME}/CoderDojo-Kata/kata-skins/coderdojokata ${KATA_BUILD}/skins/
rsync -a --exclude '.git' --exclude '.git*' --exclude '.js*' --exclude '.travis*' ${GIT_HOME}/CoderDojo-Kata/kata-extensions/* ${KATA_BUILD}/extensions/
#rsync -a --exclude '.git' --exclude '.git*' --exclude '.js*' --exclude '.travis*' ${GIT_HOME}/CoderDojo-Kata/composer/* ${KATA_BUILD}/

if [ -d "$KATA_BUILD/skins/coderdojokata" ]
then
    if [ -d "$KATA_BUILD/skins/CoderDojoKata" ]
    then
        rm -rf $KATA_BUILD/skins/CoderDojoKata
    fi
    mv $KATA_BUILD/skins/coderdojokata $KATA_BUILD/skins/CoderDojoKata
fi

if [ ! -d "$KATA_BUILD/composer" ]
then
    mkdir $KATA_BUILD/composer
fi
cd $KATA_BUILD/composer
$PHP_CLI -r "readfile('https://getcomposer.org/installer');" | $PHP_CLI
cd $WORKING_DIR

cd $KATA_BUILD
echo -e "Composer: installing semantic-media-wiki"
$PHP_CLI composer.phar require mediawiki/semantic-media-wiki "~2.1"
echo -e "Composer: installing semantic-extra-special-properties"
$PHP_CLI composer.phar require mediawiki/semantic-extra-special-properties:~1.2
echo -e "Composer: installing semantic-result-formats"
$PHP_CLI composer.phar require mediawiki/semantic-result-formats "1.9.*"
echo -e "Composer: installing semantic-maps"
$PHP_CLI composer.phar require mediawiki/semantic-maps "*"
echo -e "Composer: installing semantic-watchlist"
$PHP_CLI composer.phar require mediawiki/semantic-watchlist:~1.0
cd $WORKING_DIR

echo -e "Now you can sync (cp, rsync, ftp, git-ftp, etc.) your ${KATA_BUILD} folder on ${KATA_HOME} folder.\n"
echo -e "E.g.:\nrsync -a ${KATA_BUILD}/* ${KATA_HOME}\n"