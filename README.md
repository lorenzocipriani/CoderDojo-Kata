# CoderDojo Kata #

This repository contains the source for CoderDojo Kata wiki site based on MediaWiki.
In the main design of the project, this is the Integration environment

## Main design ##

The development life-cycle is based on 3 environments:
*  Development
*  Integration
*  Deployment


The repository fetches data from the following git repositories:
*  MediaWiki core
*  MediaWiki skins/Vector
*  MediaWiki extensions/...
*  MediaWiki extensions/...
*  CoderDojo-Kata skins-CoderDojoKata
*  CoderDojo-Kata extensions-CoderDojoKata

## Integration Environment Workspace ##

### Prerequisite ###

*  Git 1.7.5+

### Configuration ###

#### Quick configuration ####

This is the entire command list without descriptions (E.g.: copy and paste in your command line to execute all).
```bash
<<<<<<< HEAD
mkdir ~/git/CoderDojo-Kata
cd ~/git/CoderDojo-Kata
git init && \
git remote add integration https://github.com/lorenzocipriani/CoderDojo-Kata.git && \
git remote add -t REL1_24 -m REL1_24 --no-tags core-1.24 https://gerrit.wikimedia.org/r/p/mediawiki/core.git && \
git remote set-url --push core-1.24 https://github.com/lorenzocipriani/CoderDojo-Kata.git && \
git fetch --depth=1 core-1.24 && \
git checkout -B integration-1.24 core-1.24/REL1_24 && \
cd skins
git init
mkdir Vector
cd Vector
git init && \
git remote add -t REL1_24 -m REL1_24 --no-tags skins-vector-1.24 https://gerrit.wikimedia.org/r/p/mediawiki/skins/Vector.git && \
git remote set-url --push skins-vector-1.24 https://github.com/lorenzocipriani/CoderDojo-Kata.git && \
git fetch --depth=1 skins-vector-1.24 && \
git checkout -B integration-1.24 skins-vector-1.24/REL1_24 && \
cd ..
rm .gitignore
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


```

#### Step by step configuration ####

*  Create a folder in your git workspace an move into it
```bash
mkdir ~/git/CoderDojo-Kata
cd ~/git/CoderDojo-Kata
```

*  Initialise the folder as a Git repository
```bash
git init
```

*  Copy the CoderDojo-Kata project repository from GitHub to the local one
```bash
git clone https://github.com/lorenzocipriani/CoderDojo-Kata.git
```

*  Add the CoderDojo-Kata repository (alias integration) as a source for fetching and a target for pushing the last updates
```bash
git remote add integration https://github.com/lorenzocipriani/CoderDojo-Kata.git
=======
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
git pull -a -n kata-rel-1.24 REL1_24
git commit -m 'Add kata-rel-1.24'
```

#### Step by step configuration ####

*  Clone the branch related to the release (e.g. integration-1.24) and add it to the remote repositories
```bash
git clone --depth=1 --branch integration-1.24 https://github.com/lorenzocipriani/CoderDojo-Kata.git
cd CoderDojo-Kata
git remote add -t integration-1.24 -m integration-1.24 --no-tags kata-integration-1.24 https://github.com/lorenzocipriani/CoderDojo-Kata.git
>>>>>>> fada30dff11750752274e3552a60ce6b37d304b0
```

##### MediaWiki core #####

<<<<<<< HEAD
*  Add the REL_1.24 branch in MediaWiki core repository (alias core-1.24) as a source for fetching last updates
```bash
git remote add -t REL1_24 -m REL1_24 --no-tags core-1.24 https://gerrit.wikimedia.org/r/p/mediawiki/core.git
```

*  Set the CoderDojo-Kata repository as a target for pushing last updates from MediaWiki core
```bash
git remote set-url --push core-1.24 https://github.com/lorenzocipriani/CoderDojo-Kata.git
```

*  Fetch the REL_1.24 branch from MediaWiki core
```bash 
git fetch --depth=1 core-1.24
```

*  Checkout fetched REL_1.24 branch into local integration branch
```bash
git checkout -B integration-1.24 core-1.24/REL1_24 
```

##### MediaWiki skins/Vector #####

*  Move into the skins folder and initialise it as a Git repository
```bash
cd skins
git init
```

*  Create the Vector folder, move into it and initialise it as a Git repository
```bash
mkdir Vector
cd Vector
git init
```

*  Add the REL_1.24 branch in MediaWiki skins/Vector repository (alias skins-vector-1.24) as a source for fetching last updates
```bash
git remote add -t REL1_24 -m REL1_24 --no-tags skins-vector-1.24 https://gerrit.wikimedia.org/r/p/mediawiki/skins/Vector.git
```

*  Set the CoderDojo-Kata repository as a target for pushing last updates from MediaWiki skins/Vector
```bash
git remote set-url --push skins-vector-1.24 https://github.com/lorenzocipriani/CoderDojo-Kata.git
```

*  Fetch the REL_1.24 branch from MediaWiki skins/Vector
```bash
git fetch --depth=1 skins-vector-1.24
```

*  Checkout fetched REL_1.24 branch into local integration branch
```bash
git checkout -B integration-1.24 skins-vector-1.24/REL1_24
```

##### CoderDojo-Kata skins-CoderDojoKata #####

*  Move back to the parent folder (skins) and remove the .gitignore file
```bash
cd ..
rm .gitignore
```

*  Add the REL_1.24 branch in CoderDojo-Kata skins-CoderDojoKata repository (alias skins-CoderDojoKata-1.24) as a source for fetching last updates 
```bash
git remote add -t REL-1.24 -m REL-1.24 --no-tags skins-CoderDojoKata-1.24 https://bitbucket.org/lorenzocipriani/coderdojokata_skin.git
```

*  Set the CoderDojo-Kata repository as a secondary target for pushing last updates from CoderDojo-Kata skins-CoderDojoKata
```bash
git remote set-url --push skins-CoderDojoKata-1.24 --add https://bitbucket.org/lorenzocipriani/coderdojokata_skin.git
git remote set-url --push skins-CoderDojoKata-1.24 --add https://github.com/lorenzocipriani/CoderDojo-Kata.git
```

*  Fetch the REL_1.24 branch from CoderDojo-Kata skins-CoderDojoKata
```bash
git fetch --depth=1 skins-CoderDojoKata-1.24
```

*  Checkout fetched REL_1.24 branch into local integration branch
```bash
git checkout -B integration-1.24 skins-CoderDojoKata-1.24/REL-1.24
```

##### CoderDojo-Kata skins-CoderDojoKata #####

*  Move to the extensions folder, remove the .gitignore file and initialise as a Git repository
```bash
cd ../extensions
rm .gitignore
git init
```

*  Add the REL_1.24 branch in CoderDojo-Kata extensions-CoderDojoKata repository (alias extensions-CoderDojoKata-1.24) as a source for fetching last updates 
```bash
git remote add -t REL-1.24 -m REL-1.24 --no-tags extensions-CoderDojoKata-1.24 https://bitbucket.org/lorenzocipriani/coderdojokata_extensions.git
```

*  Set the CoderDojo-Kata repository as a secondary target for pushing last updates from CoderDojo-Kata extensions-CoderDojoKata
```bash
git remote set-url --push extensions-CoderDojoKata-1.24 --add https://bitbucket.org/lorenzocipriani/coderdojokata_extensions.git
git remote set-url --push extensions-CoderDojoKata-1.24 --add https://github.com/lorenzocipriani/CoderDojo-Kata.git
```

*  Fetch the REL_1.24 branch from MediaWiki skins/Vector
```bash
git fetch --depth=1 extensions-CoderDojoKata-1.24
```

*  Checkout fetched REL_1.24 branch into local integration branch
```bash
git checkout -B integration-1.24 extensions-CoderDojoKata-1.24/REL-1.24
```

##### MediaWiki extensions #####

*  Add the REL_1.24 branch in MediaWiki extensions repository (alias extensions-1.24) as a source for fetching last updates
```bash
git remote add -t REL1_24 -m REL1_24 --no-tags extensions-1.24 https://gerrit.wikimedia.org/r/p/mediawiki/extensions.git
```

*  Set the CoderDojo-Kata repository as a target for pushing last updates from MediaWiki extensions
```bash
git remote set-url --push extensions-1.24 https://github.com/lorenzocipriani/CoderDojo-Kata.git
```

*  Fetch the REL_1.24 branch from MediaWiki extensions
```bash
git fetch --depth=1 skins-vector-1.24
```

*  Checkout fetched REL_1.24 branch into local integration branch
```bash
git checkout -B integration-1.24 skins-vector-1.24/REL1_24
```





[remote "extensions"]
   url = https://gerrit.wikimedia.org/r/p/mediawiki/extensions.git
   fetch = +refs/heads/*:refs/remotes/extensions/*


=======
*  Add the REL_1.24 branch in MediaWiki core repository (alias core-1.24) as a source for fetching last updates, fetch the sources, merge to the local repository (integration-1.24) and commit the merged files
```bash
git remote add -t REL1_24 -m REL1_24 --no-tags core-1.24 https://gerrit.wikimedia.org/r/p/mediawiki/core.git
git fetch --depth=1 core-1.24
git merge --squash -s ours --no-commit core-1.24/REL1_24
git read-tree -u -m integration-1.24 core-1.24
git commit -m 'Load core-1.24'
```

##### MediaWiki skins: Vector #####

*  Add the REL_1.24 branch in MediaWiki skins/Vector repository (alias skins-Vector-1.24) as a source for fetching last updates, merge as a subtree (skins/Vector) of the local repository and commit the merged files
```bash
git remote add -t REL1_24 -m REL1_24 --no-tags skins-Vector-1.24 https://gerrit.wikimedia.org/r/p/mediawiki/skins/Vector.git
git fetch --depth=1 skins-Vector-1.24
git merge --squash -s subtree --no-commit skins-Vector-1.24/REL1_24
git read-tree --prefix=skins/Vector -u skins-Vector-1.24
git commit -m 'Add skins-Vector-1.24'
```

##### MediaWiki extensions: VisualEditor, TemplateData, SemanticDrilldown, Ratings, Validator #####

*  Add the REL_1.24 branch in MediaWiki extensions/VisualEditor repository (alias extensions-VisualEditor-1.24) as a source for fetching last updates, merge as a subtree (extensions/VisualEditor) of the local repository and commit the merged files
```bash
git remote add -t REL1_24 -m REL1_24 --no-tags extensions-VisualEditor-1.24 https://gerrit.wikimedia.org/r/p/mediawiki/extensions/VisualEditor.git
git fetch --depth=1 extensions-VisualEditor-1.24
git merge --squash -s subtree --no-commit extensions-VisualEditor-1.24/REL1_24
git read-tree --prefix=extensions/VisualEditor -u extensions-VisualEditor-1.24
git commit -m 'Add extensions-VisualEditor-1.24'
```

*  Add the REL_1.24 branch in MediaWiki extensions/TemplateData repository (alias extensions-TemplateData-1.24) as a source for fetching last updates, merge as a subtree (extensions/TemplateData) of the local repository and commit the merged files
```bash
git remote add -t REL1_24 -m REL1_24 --no-tags extensions-TemplateData-1.24 https://gerrit.wikimedia.org/r/p/mediawiki/extensions/TemplateData.git
git fetch --depth=1 extensions-TemplateData-1.24
git merge --squash -s subtree --no-commit extensions-TemplateData-1.24/REL1_24
git read-tree --prefix=extensions/TemplateData -u extensions-TemplateData-1.24
git commit -m 'Add extensions-TemplateData-1.24'
```

*  Add the REL_1.24 branch in MediaWiki extensions/SemanticDrilldown repository (alias extensions-SemanticDrilldown-1.24) as a source for fetching last updates, merge as a subtree (extensions/SemanticDrilldown) of the local repository and commit the merged files
```bash
git remote add -t REL1_24 -m REL1_24 --no-tags extensions-SemanticDrilldown-1.24 https://gerrit.wikimedia.org/r/p/mediawiki/extensions/SemanticDrilldown.git
git fetch --depth=1 extensions-SemanticDrilldown-1.24
git merge --squash -s subtree --no-commit extensions-SemanticDrilldown-1.24/REL1_24
git read-tree --prefix=extensions/SemanticDrilldown -u extensions-SemanticDrilldown-1.24
git commit -m 'Add extensions-SemanticDrilldown-1.24'
```

*  Add the REL_1.24 branch in MediaWiki extensions/Ratings repository (alias extensions-Ratings-1.24) as a source for fetching last updates, merge as a subtree (extensions/Ratings) of the local repository and commit the merged files
```bash
git remote add -t REL1_24 -m REL1_24 --no-tags extensions-Ratings-1.24 https://gerrit.wikimedia.org/r/p/mediawiki/extensions/Ratings.git
git fetch --depth=1 extensions-Ratings-1.24
git merge --squash -s subtree --no-commit extensions-Ratings-1.24/REL1_24
git read-tree --prefix=extensions/Ratings -u extensions-Ratings-1.24
git commit -m 'Add extensions-Ratings-1.24'
```

*  Add the REL_1.24 branch in MediaWiki extensions/Validator repository (alias extensions-Validator-1.24) as a source for fetching last updates, merge as a subtree (extensions/Validator) of the local repository and commit the merged files
```bash
git remote add -t REL1_24 -m REL1_24 --no-tags extensions-Validator-1.24 https://gerrit.wikimedia.org/r/p/mediawiki/extensions/Validator.git
git fetch --depth=1 extensions-Validator-1.24
git merge --squash -s subtree --no-commit extensions-Validator-1.24/REL1_24
git read-tree --prefix=extensions/Validator -u extensions-Validator-1.24
git commit -m 'Add extensions-Validator-1.24'
```

##### CoderDojo-Kata skins: CoderDojoKata #####

*  Add the REL_1.24 branch in CoderDojo-Kata skins/CoderDojoKata repository (alias skins-CoderDojoKata-1.24) as a source for fetching last updates, merge as a subtree (skins/CoderDojoKata) of the local repository and commit the merged files
```bash
git remote add -t REL-1.24 -m REL-1.24 --no-tags skins-CoderDojoKata-1.24 https://bitbucket.org/lorenzocipriani/coderdojokata_skin.git
git fetch --depth=1 skins-CoderDojoKata-1.24
git merge --squash -s subtree --no-commit skins-CoderDojoKata-1.24/REL-1.24
git read-tree --prefix=skins/CoderDojoKata -u skins-CoderDojoKata-1.24/REL-1.24:coderdojokata
git commit -m 'Add skins-CoderDojoKata-1.24'
```

##### CoderDojo-Kata extensions: CoderDojoKata #####

*  Add the REL_1.24 branch in MediaWiki extensions/Validator repository (alias extensions-CoderDojoKata-1.24) as a source for fetching last updates, merge as a subtree (extensions/CoderDojoKata) of the local repository and commit the merged files
```bash
git remote add -t REL-1.24 -m REL-1.24 --no-tags extensions-CoderDojoKata-1.24 https://bitbucket.org/lorenzocipriani/coderdojokata_extensions.git
git fetch --depth=1 extensions-CoderDojoKata-1.24
git merge --squash -s subtree --no-commit extensions-CoderDojoKata-1.24/REL-1.24
git read-tree --prefix=extensions/CoderDojoKata -u extensions-CoderDojoKata-1.24/REL-1.24:CoderDojoKata
git commit -m 'Add extensions-CoderDojoKata-1.24'
```

##### CoderDojo-Kata core #####

*  Add the REL_1.24 branch in CoderDojo-Kata core repository (alias kata-rel-1.24) as a source for fetching last updates, fetch the sources and commit the merged files
```bash
git remote add -t REL1_24 -m REL1_24 --no-tags kata-rel-1.24 https://github.com/lorenzocipriani/CoderDojo-Kata.git
git fetch --depth=1 kata-rel-1.24
git pull -a -n kata-rel-1.24 REL1_24
git commit -m 'Add kata-rel-1.24'
```


>>>>>>> fada30dff11750752274e3552a60ce6b37d304b0
### Build ###

In order to build the Integration Environment with last updates, you need to run the following commands:
```bash
cd ~/git/CoderDojo-Kata
git pull --all && \
git add --all && \
git commit -m 'Integration Build' && \
git push --all

```
