#!/bin/bash

WIKI_REL=REL1_24
KATA_REL=1.24

cd ~/git
git clone --depth=1 --branch integration-$KATA_REL https://github.com/lorenzocipriani/CoderDojo-Kata.git
cd CoderDojo-Kata
git remote add -t integration-$KATA_REL -m integration-$KATA_REL --no-tags kata-integration-$KATA_REL https://github.com/lorenzocipriani/CoderDojo-Kata.git

git remote add -t $WIKI_REL -m $WIKI_REL --no-tags core-$KATA_REL https://gerrit.wikimedia.org/r/p/mediawiki/core.git
git fetch --depth=1 core-$KATA_REL
git merge --squash -s ours --no-commit core-$KATA_REL/$WIKI_REL
git read-tree -u -m integration-$KATA_REL core-$KATA_REL
git commit -m "Load core-${KATA_REL}"

git remote add -t $WIKI_REL -m $WIKI_REL --no-tags skins-Vector-$KATA_REL https://gerrit.wikimedia.org/r/p/mediawiki/skins/Vector.git
git fetch --depth=1 skins-Vector-$KATA_REL
git merge --squash -s subtree --no-commit skins-Vector-$KATA_REL/$WIKI_REL
git read-tree --prefix=skins/Vector -u skins-Vector-$KATA_REL
git commit -m "Add skins-Vector-${KATA_REL}"

git remote add -t $WIKI_REL -m $WIKI_REL --no-tags extensions-VisualEditor-$KATA_REL https://gerrit.wikimedia.org/r/p/mediawiki/extensions/VisualEditor.git
git fetch --depth=1 extensions-VisualEditor-$KATA_REL
git merge --squash -s subtree --no-commit extensions-VisualEditor-$KATA_REL/$WIKI_REL
git read-tree --prefix=extensions/VisualEditor -u extensions-VisualEditor-$KATA_REL
git commit -m "Add extensions-VisualEditor-${KATA_REL}"

git remote add -t $WIKI_REL -m $WIKI_REL --no-tags extensions-TemplateData-$KATA_REL https://gerrit.wikimedia.org/r/p/mediawiki/extensions/TemplateData.git
git fetch --depth=1 extensions-TemplateData-$KATA_REL
git merge --squash -s subtree --no-commit extensions-TemplateData-$KATA_REL/$WIKI_REL
git read-tree --prefix=extensions/TemplateData -u extensions-TemplateData-$KATA_REL
git commit -m "Add extensions-TemplateData-${KATA_REL}"

#git remote add -t $WIKI_REL -m $WIKI_REL --no-tags extensions-SemanticDrilldown-$KATA_REL https://gerrit.wikimedia.org/r/p/mediawiki/extensions/SemanticDrilldown.git
#git fetch --depth=1 extensions-SemanticDrilldown-$KATA_REL
#git merge --squash -s subtree --no-commit extensions-SemanticDrilldown-$KATA_REL/$WIKI_REL
#git read-tree --prefix=extensions/SemanticDrilldown -u extensions-SemanticDrilldown-$KATA_REL
#git commit -m "Add extensions-SemanticDrilldown-${KATA_REL}"

#git remote add -t $WIKI_REL -m $WIKI_REL --no-tags extensions-Ratings-$KATA_REL https://gerrit.wikimedia.org/r/p/mediawiki/extensions/Ratings.git
#git fetch --depth=1 extensions-Ratings-$KATA_REL
#git merge --squash -s subtree --no-commit extensions-Ratings-$KATA_REL/$WIKI_REL
#git read-tree --prefix=extensions/Ratings -u extensions-Ratings-$KATA_REL
#git commit -m "Add extensions-Ratings-${KATA_REL}"

#git remote add -t $WIKI_REL -m $WIKI_REL --no-tags extensions-Validator-$KATA_REL https://gerrit.wikimedia.org/r/p/mediawiki/extensions/Validator.git
#git fetch --depth=1 extensions-Validator-$KATA_REL
#git merge --squash -s subtree --no-commit extensions-Validator-$KATA_REL/$WIKI_REL
#git read-tree --prefix=extensions/Validator -u extensions-Validator-$KATA_REL
#git commit -m "Add extensions-Validator-${KATA_REL}"

git remote add -t REL-$KATA_REL -m REL-$KATA_REL --no-tags skins-CoderDojoKata-$KATA_REL https://bitbucket.org/lorenzocipriani/coderdojokata_skin.git
git fetch --depth=1 skins-CoderDojoKata-$KATA_REL
git merge --squash -s subtree --no-commit skins-CoderDojoKata-$KATA_REL/REL-$KATA_REL
git read-tree --prefix=skins/CoderDojoKata -u skins-CoderDojoKata-$KATA_REL/REL-$KATA_REL:coderdojokata
git commit -m "Add skins-CoderDojoKata-${KATA_REL}"

git remote add -t REL-$KATA_REL -m REL-$KATA_REL --no-tags extensions-CoderDojoKata-$KATA_REL https://bitbucket.org/lorenzocipriani/coderdojokata_extensions.git
git fetch --depth=1 extensions-CoderDojoKata-$KATA_REL
git merge --squash -s subtree --no-commit extensions-CoderDojoKata-$KATA_REL/REL-$KATA_REL
git read-tree --prefix=extensions/CoderDojoKata -u extensions-CoderDojoKata-$KATA_REL/REL-$KATA_REL:CoderDojoKata
git read-tree --prefix=extensions/W4G -u extensions-CoderDojoKata-$KATA_REL/REL-$KATA_REL:W4G
git commit -m "Add extensions-CoderDojoKata-${KATA_REL}"

git remote add -t $WIKI_REL -m $WIKI_REL --no-tags kata-rel-$KATA_REL https://github.com/lorenzocipriani/CoderDojo-Kata.git
git fetch --depth=1 kata-rel-$KATA_REL
git pull --no-commit -a -n kata-rel-$KATA_REL $WIKI_REL
git commit -m "Add kata-rel-${KATA_REL}"

git push
