#!/bin/bash

cd ~/git
git clone --depth=1 --branch integration-1.24 https://github.com/lorenzocipriani/CoderDojo-Kata.git
cd CoderDojo-Kata
git remote add -t integration-1.24 -m integration-1.24 --no-tags kata-integration-1.24 https://github.com/lorenzocipriani/CoderDojo-Kata.git

git remote add -t REL1_24 -m REL1_24 --no-tags core-1.24 https://gerrit.wikimedia.org/r/p/mediawiki/core.git
git fetch --depth=1 core-1.24
git merge --squash -s ours --no-commit core-1.24/REL1_24
git read-tree -u -m integration-1.24 core-1.24
git commit -m 'Load core-1.24'

git remote add -t REL1_24 -m REL1_24 --no-tags skins-Vector-1.24 https://gerrit.wikimedia.org/r/p/mediawiki/skins/Vector.git
git fetch --depth=1 skins-Vector-1.24
git merge --squash -s subtree --no-commit skins-Vector-1.24/REL1_24
git read-tree --prefix=skins/Vector -u skins-Vector-1.24
git commit -m 'Add skins-Vector-1.24'

git remote add -t REL1_24 -m REL1_24 --no-tags extensions-VisualEditor-1.24 https://gerrit.wikimedia.org/r/p/mediawiki/extensions/VisualEditor.git
git fetch --depth=1 extensions-VisualEditor-1.24
git merge --squash -s subtree --no-commit extensions-VisualEditor-1.24/REL1_24
git read-tree --prefix=extensions/VisualEditor -u extensions-VisualEditor-1.24
git commit -m 'Add extensions-VisualEditor-1.24'

git remote add -t REL1_24 -m REL1_24 --no-tags extensions-TemplateData-1.24 https://gerrit.wikimedia.org/r/p/mediawiki/extensions/TemplateData.git
git fetch --depth=1 extensions-TemplateData-1.24
git merge --squash -s subtree --no-commit extensions-TemplateData-1.24/REL1_24
git read-tree --prefix=extensions/TemplateData -u extensions-TemplateData-1.24
git commit -m 'Add extensions-TemplateData-1.24'

git remote add -t REL1_24 -m REL1_24 --no-tags extensions-SemanticDrilldown-1.24 https://gerrit.wikimedia.org/r/p/mediawiki/extensions/SemanticDrilldown.git
git fetch --depth=1 extensions-SemanticDrilldown-1.24
git merge --squash -s subtree --no-commit extensions-SemanticDrilldown-1.24/REL1_24
git read-tree --prefix=extensions/SemanticDrilldown -u extensions-SemanticDrilldown-1.24
git commit -m 'Add extensions-SemanticDrilldown-1.24'

git remote add -t REL1_24 -m REL1_24 --no-tags extensions-Ratings-1.24 https://gerrit.wikimedia.org/r/p/mediawiki/extensions/Ratings.git
git fetch --depth=1 extensions-Ratings-1.24
git merge --squash -s subtree --no-commit extensions-Ratings-1.24/REL1_24
git read-tree --prefix=extensions/Ratings -u extensions-Ratings-1.24
git commit -m 'Add extensions-Ratings-1.24'

git remote add -t REL1_24 -m REL1_24 --no-tags extensions-Validator-1.24 https://gerrit.wikimedia.org/r/p/mediawiki/extensions/Validator.git
git fetch --depth=1 extensions-Validator-1.24
git merge --squash -s subtree --no-commit extensions-Validator-1.24/REL1_24
git read-tree --prefix=extensions/Validator -u extensions-Validator-1.24
git commit -m 'Add extensions-Validator-1.24'

git remote add -t REL-1.24 -m REL-1.24 --no-tags skins-CoderDojoKata-1.24 https://bitbucket.org/lorenzocipriani/coderdojokata_skin.git
git fetch --depth=1 skins-CoderDojoKata-1.24
git merge --squash -s subtree --no-commit skins-CoderDojoKata-1.24/REL-1.24
git read-tree --prefix=skins/CoderDojoKata -u skins-CoderDojoKata-1.24/REL-1.24:coderdojokata
git commit -m 'Add skins-CoderDojoKata-1.24'

git remote add -t REL-1.24 -m REL-1.24 --no-tags extensions-CoderDojoKata-1.24 https://bitbucket.org/lorenzocipriani/coderdojokata_extensions.git
git fetch --depth=1 extensions-CoderDojoKata-1.24
git merge --squash -s subtree --no-commit extensions-CoderDojoKata-1.24/REL-1.24
git read-tree --prefix=extensions/CoderDojoKata -u extensions-CoderDojoKata-1.24/REL-1.24:CoderDojoKata
git commit -m 'Add extensions-CoderDojoKata-1.24'

git remote add -t REL1_24 -m REL1_24 --no-tags kata-rel-1.24 https://github.com/lorenzocipriani/CoderDojo-Kata.git
git fetch --depth=1 kata-rel-1.24
git pull --no-commit -a -n kata-rel-1.24 REL1_24
git commit -m 'Add kata-rel-1.24'

git push
