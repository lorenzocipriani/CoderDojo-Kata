# CoderDojo Kata #

This repository contains the source for CoderDojo Kata wiki site based on MediaWiki.
In the main design of the project, this is the Integration environment

## Main design ##

The development life-cycle is based on 3 environments:
*  Development
*  Integration
*  Deployment, that has 3 stages:
**  Development
**  Testing
**  Production

## Integration Environment Workspace ##

The repository fetches data from the following git repositories:
*  MediaWiki core
*  MediaWiki skins/Vector
*  MediaWiki extensions/VisualEditor
*  MediaWiki extensions/TemplateData
*  MediaWiki extensions/SemanticDrilldown
*  MediaWiki extensions/Ratings
*  MediaWiki extensions/Validator
*  CoderDojo-Kata skins-CoderDojoKata
*  CoderDojo-Kata extensions-CoderDojoKata
and merge them together.

### Prerequisite ###

*  Git 1.7.5+

### Configuration ###

#### Quick configuration ####

Download and execute CreateIntegration.sh bash script (the first build is also executed)
```bash
wget -O - https://raw.githubusercontent.com/lorenzocipriani/CoderDojo-Kata/REL1_24/scripts/CreateIntegration.sh | /bin/bash
```

If you need to download and modify the script before execute it, then 
```bash
wget https://raw.githubusercontent.com/lorenzocipriani/CoderDojo-Kata/REL1_24/scripts/CreateIntegration.sh
```

#### Step by step configuration ####

Clone the branch related to the release (e.g. integration-1.24) and add it to the remote repositories
```bash
cd ~/git
git clone --depth=1 --branch integration-1.24 https://github.com/lorenzocipriani/CoderDojo-Kata.git
cd CoderDojo-Kata
git remote add -t integration-1.24 -m integration-1.24 --no-tags kata-integration-1.24 https://github.com/lorenzocipriani/CoderDojo-Kata.git
```

##### MediaWiki core #####

Add the REL_1.24 branch in MediaWiki core repository (alias core-1.24) as a source for fetching last updates, fetch the sources, merge to the local repository (integration-1.24) and commit the merged files
```bash
git remote add -t REL1_24 -m REL1_24 --no-tags core-1.24 https://gerrit.wikimedia.org/r/p/mediawiki/core.git
git fetch --depth=1 core-1.24
git merge --squash -s ours --no-commit core-1.24/REL1_24
git read-tree -u -m integration-1.24 core-1.24
git commit -m 'Load core-1.24'
```

##### MediaWiki skins: Vector #####

Add the REL_1.24 branch in MediaWiki skins/Vector repository (alias skins-Vector-1.24) as a source for fetching last updates, merge as a subtree (skins/Vector) of the local repository and commit the merged files
```bash
git remote add -t REL1_24 -m REL1_24 --no-tags skins-Vector-1.24 https://gerrit.wikimedia.org/r/p/mediawiki/skins/Vector.git
git fetch --depth=1 skins-Vector-1.24
git merge --squash -s subtree --no-commit skins-Vector-1.24/REL1_24
git read-tree --prefix=skins/Vector -u skins-Vector-1.24
git commit -m 'Add skins-Vector-1.24'
```

##### MediaWiki extensions: VisualEditor, TemplateData, SemanticDrilldown, Ratings, Validator #####

Add the REL_1.24 branch in MediaWiki extensions/VisualEditor repository (alias extensions-VisualEditor-1.24) as a source for fetching last updates, merge as a subtree (extensions/VisualEditor) of the local repository and commit the merged files
```bash
git remote add -t REL1_24 -m REL1_24 --no-tags extensions-VisualEditor-1.24 https://gerrit.wikimedia.org/r/p/mediawiki/extensions/VisualEditor.git
git fetch --depth=1 extensions-VisualEditor-1.24
git merge --squash -s subtree --no-commit extensions-VisualEditor-1.24/REL1_24
git read-tree --prefix=extensions/VisualEditor -u extensions-VisualEditor-1.24
git commit -m 'Add extensions-VisualEditor-1.24'
```

Add the REL_1.24 branch in MediaWiki extensions/TemplateData repository (alias extensions-TemplateData-1.24) as a source for fetching last updates, merge as a subtree (extensions/TemplateData) of the local repository and commit the merged files
```bash
git remote add -t REL1_24 -m REL1_24 --no-tags extensions-TemplateData-1.24 https://gerrit.wikimedia.org/r/p/mediawiki/extensions/TemplateData.git
git fetch --depth=1 extensions-TemplateData-1.24
git merge --squash -s subtree --no-commit extensions-TemplateData-1.24/REL1_24
git read-tree --prefix=extensions/TemplateData -u extensions-TemplateData-1.24
git commit -m 'Add extensions-TemplateData-1.24'
```

Add the REL_1.24 branch in MediaWiki extensions/SemanticDrilldown repository (alias extensions-SemanticDrilldown-1.24) as a source for fetching last updates, merge as a subtree (extensions/SemanticDrilldown) of the local repository and commit the merged files
```bash
git remote add -t REL1_24 -m REL1_24 --no-tags extensions-SemanticDrilldown-1.24 https://gerrit.wikimedia.org/r/p/mediawiki/extensions/SemanticDrilldown.git
git fetch --depth=1 extensions-SemanticDrilldown-1.24
git merge --squash -s subtree --no-commit extensions-SemanticDrilldown-1.24/REL1_24
git read-tree --prefix=extensions/SemanticDrilldown -u extensions-SemanticDrilldown-1.24
git commit -m 'Add extensions-SemanticDrilldown-1.24'
```

Add the REL_1.24 branch in MediaWiki extensions/Ratings repository (alias extensions-Ratings-1.24) as a source for fetching last updates, merge as a subtree (extensions/Ratings) of the local repository and commit the merged files
```bash
git remote add -t REL1_24 -m REL1_24 --no-tags extensions-Ratings-1.24 https://gerrit.wikimedia.org/r/p/mediawiki/extensions/Ratings.git
git fetch --depth=1 extensions-Ratings-1.24
git merge --squash -s subtree --no-commit extensions-Ratings-1.24/REL1_24
git read-tree --prefix=extensions/Ratings -u extensions-Ratings-1.24
git commit -m 'Add extensions-Ratings-1.24'
```

Add the REL_1.24 branch in MediaWiki extensions/Validator repository (alias extensions-Validator-1.24) as a source for fetching last updates, merge as a subtree (extensions/Validator) of the local repository and commit the merged files
```bash
git remote add -t REL1_24 -m REL1_24 --no-tags extensions-Validator-1.24 https://gerrit.wikimedia.org/r/p/mediawiki/extensions/Validator.git
git fetch --depth=1 extensions-Validator-1.24
git merge --squash -s subtree --no-commit extensions-Validator-1.24/REL1_24
git read-tree --prefix=extensions/Validator -u extensions-Validator-1.24
git commit -m 'Add extensions-Validator-1.24'
```

##### CoderDojo-Kata skins: CoderDojoKata #####

Add the REL_1.24 branch in CoderDojo-Kata skins/CoderDojoKata repository (alias skins-CoderDojoKata-1.24) as a source for fetching last updates, merge as a subtree (skins/CoderDojoKata) of the local repository and commit the merged files
```bash
git remote add -t REL-1.24 -m REL-1.24 --no-tags skins-CoderDojoKata-1.24 https://bitbucket.org/lorenzocipriani/coderdojokata_skin.git
git fetch --depth=1 skins-CoderDojoKata-1.24
git merge --squash -s subtree --no-commit skins-CoderDojoKata-1.24/REL-1.24
git read-tree --prefix=skins/CoderDojoKata -u skins-CoderDojoKata-1.24/REL-1.24:coderdojokata
git commit -m 'Add skins-CoderDojoKata-1.24'
```

##### CoderDojo-Kata extensions: CoderDojoKata #####

Add the REL_1.24 branch in MediaWiki extensions/Validator repository (alias extensions-CoderDojoKata-1.24) as a source for fetching last updates, merge as a subtree (extensions/CoderDojoKata) of the local repository and commit the merged files
```bash
git remote add -t REL-1.24 -m REL-1.24 --no-tags extensions-CoderDojoKata-1.24 https://bitbucket.org/lorenzocipriani/coderdojokata_extensions.git
git fetch --depth=1 extensions-CoderDojoKata-1.24
git merge --squash -s subtree --no-commit extensions-CoderDojoKata-1.24/REL-1.24
git read-tree --prefix=extensions/CoderDojoKata -u extensions-CoderDojoKata-1.24/REL-1.24:CoderDojoKata
git commit -m 'Add extensions-CoderDojoKata-1.24'
```

##### CoderDojo-Kata core #####

Add the REL_1.24 branch in CoderDojo-Kata core repository (alias kata-rel-1.24) as a source for fetching last updates, fetch the sources and commit the merged files
```bash
git remote add -t REL1_24 -m REL1_24 --no-tags kata-rel-1.24 https://github.com/lorenzocipriani/CoderDojo-Kata.git
git fetch --depth=1 kata-rel-1.24
git pull -a -n kata-rel-1.24 REL1_24
git commit -a -m 'Add kata-rel-1.24'
```

### First build ###

When the configuration is complete, the first build can be made pushing all local repositories to remote branch (integration-1.24)
```bash
git push
```

### Build updates (TO BE DONE!!!)###

In order to build the Integration Environment with last updates run the following commands:
```bash
cd ~/git/CoderDojo-Kata

git pull --no-commit -a -n origin
git commit -a -m 'Update origin'

git pull --no-commit -a -n core-1.24 REL1_24
git commit -a -m 'Update core-1.24'

git pull --no-commit -s subtree skins-Vector-1.24 REL1_24
git commit -a -m 'Update skins-Vector-1.24'

git pull --no-commit -s subtree extensions-VisualEditor-1.24 REL1_24
git commit -a -m 'Update extensions-VisualEditor-1.2i4'
git pull --no-commit -s subtree extensions-TemplateData-1.24 REL1_24
git commit -a -m 'Update extensions-TemplateData-1.24'
git pull --no-commit -s subtree extensions-SemanticDrilldown-1.24 REL1_24
git commit -a -m 'Update extensions-SemanticDrilldown-1.24'
git pull --no-commit -s subtree extensions-Ratings-1.24 REL1_24
git commit -a -m 'Update extensions-Ratings-1.24'
git pull --no-commit -s subtree extensions-Validator-1.24 REL1_24
git commit -a -m 'Update extensions-Validator-1.24'
git pull --no-commit -s subtree extensions-CoderDojoKata-1.24 REL-1.24
git commit -a -m 'Update extensions-CoderDojoKata-1.24'
git pull --no-commit -s subtree skins-CoderDojoKata-1.24 REL-1.24
git commit -a -m 'Update skins-CoderDojoKata-1.24'
git pull --no-commit -a -n kata-rel-1.24 REL1_24
git commit -a -m 'Update kata-rel-1.24'
git push
```

## Deployment Environment Workspace ##

The repository fetches data from the CoderDojo-Kata git repository and push it to one of the scopes (stage: development, testing, production) using git-ftp.


### Prerequisite ###

*  Git 1.7.5+
*  Git-ftp 0.9.0+

### Configuration ###

Clone the branch related to the release (e.g. integration-1.24)
```bash
cd ~/git
git clone --depth=1 --branch integration-1.24 https://github.com/lorenzocipriani/CoderDojo-Kata.git ./CoderDojo-Kata-Deployment
cd CoderDojo-Kata-Deployment
```

Configure the development scope (use your environment's ftp account!)
```bash
git config git-ftp.development.url ftp://ftp.domain.tld/path/to/root/folder
git config git-ftp.development.user username
git config git-ftp.development.password password
```

Configure the testing scope (use your environment's ftp account!)
```bash
git config git-ftp.testing.url ftp://ftp.domain.tld/path/to/root/folder
git config git-ftp.testing.user username
git config git-ftp.testing.password password
```

Configure the production scope (use your environment's ftp account!)
```bash
git config git-ftp.production.url ftp://ftp.domain.tld/path/to/root/folder
git config git-ftp.production.user username
git config git-ftp.production.password password
```

### First deployment ###

Pull latest changes from CoderDojo-Kata repository
```bash
cd ~/git/CoderDojo-Kata-Deployment
git pull --depth=1
```

Then push them to the target stage (scope: development, testing, production)
```bash
git ftp push --all -s development
```
or
```bash
git ftp push --all -s testing
```
or
```bash
git ftp push --all -s production
```

### Deployment ###

Pull latest changes from CoderDojo-Kata repository
```bash
cd ~/git/CoderDojo-Kata-Deployment
git pull --depth=1
```

Then push them to the target stage (scope: development, testing, production)
```bash
git ftp push -s development
```
or
```bash
git ftp push -s testing
```
or
```bash
git ftp push -s production
```
