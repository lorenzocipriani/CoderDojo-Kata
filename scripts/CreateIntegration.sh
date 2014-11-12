#!/bin/bash
mkdir ~/git/CoderDojo-Kata
cd ~/git/CoderDojo-Kata
git init && \

git remote add -t REL1_24 -m REL1_24 --no-tags integration-1.24 https://github.com/lorenzocipriani/CoderDojo-Kata.git
git fetch --depth=1 integration-1.24
git checkout -B integration-1.24 integration-1.24/REL1_24

git remote add -t REL1_24 -m REL1_24 --no-tags core-1.24 https://gerrit.wikimedia.org/r/p/mediawiki/core.git
git remote set-url --push core-1.24 https://github.com/lorenzocipriani/CoderDojo-Kata.git
git fetch --depth=1 core-1.24
git checkout -B integration-1.24 core-1.24/REL1_24

git remote add -t REL1_24 -m REL1_24 --no-tags skins-vector-1.24 https://gerrit.wikimedia.org/r/p/mediawiki/skins/Vector.git && \
git remote set-url --push skins-vector-1.24 https://github.com/lorenzocipriani/CoderDojo-Kata.git && \
git fetch --depth=1 skins-vector-1.24 && \
git checkout -B integration-1.24 skins-vector-1.24/REL1_24 && \

git remote add -t REL-1.24 -m REL-1.24 --no-tags skins-CoderDojoKata-1.24 https://bitbucket.org/lorenzocipriani/coderdojokata_skin.git && \
git remote set-url --push skins-CoderDojoKata-1.24 --add https://bitbucket.org/lorenzocipriani/coderdojokata_skin.git && \
git remote set-url --push skins-CoderDojoKata-1.24 --add https://github.com/lorenzocipriani/CoderDojo-Kata.git && \
git fetch --depth=1 skins-CoderDojoKata-1.24 && \
git checkout -B integration-1.24 skins-CoderDojoKata-1.24/REL-1.24 && \
cd ../extensions
rm .gitignore
git init
git remote add -t REL-1.24 -m REL-1.24 --no-tags extensions-CoderDojoKata-1.24 https://bitbucket.org/lorenzocipriani/coderdojokata_extensions.git && \
git remote set-url --push extensions-CoderDojoKata-1.24 --add https://bitbucket.org/lorenzocipriani/coderdojokata_extensions.git && \
git remote set-url --push extensions-CoderDojoKata-1.24 --add https://github.com/lorenzocipriani/CoderDojo-Kata.git && \
git fetch --depth=1 extensions-CoderDojoKata-1.24 && \
git checkout -B integration-1.24 extensions-CoderDojoKata-1.24/REL-1.24


