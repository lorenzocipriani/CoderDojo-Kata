= CoderDojo Kata =

This repository contains the source for CoderDojo Kata wiki site based on MediaWiki.
In the main design of the project, this is the Integration environment

== Main design ==

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

== Integration Environment Workspace ==

=== Prerequisite ===

*  Git 1.7.5+

=== Configuration ===

==== Quick configuration ====

This is the entire command list without descriptions (E.g.: copy and paste in your command line to execute all).
```bash
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
git remote add --no-tags skins-CoderDojoKata-1.24 https://bitbucket.org/lorenzocipriani/coderdojokata_skin.git && \
git remote set-url --push skins-CoderDojoKata-1.24 --add https://bitbucket.org/lorenzocipriani/coderdojokata_skin.git && \
git remote set-url --push skins-CoderDojoKata-1.24 --add https://github.com/lorenzocipriani/CoderDojo-Kata.git && \
git fetch --depth=1 skins-CoderDojoKata-1.24 && \
git checkout -B integration-1.24 skins-CoderDojoKata-1.24 && \




```

==== Step by step configuration ===

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
```

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

*  Move back to the parent folder (skins) and remove the .gitignore file
```bash
cd ..
rm .gitignore
```

*  Add the REL_1.24 branch in CoderDojo-Kata skins-CoderDojoKata repository (alias skins-CoderDojoKata-1.24) as a source for fetching last updates 
(TBD: add --no-tags >> add -t REL1_24 -m REL1_24 --no-tags )
```bash
git remote add --no-tags skins-CoderDojoKata-1.24 https://bitbucket.org/lorenzocipriani/coderdojokata_skin.git
```

*  Set the CoderDojo-Kata repository as a secondary target for pushing last updates from CoderDojo-Kata skins-CoderDojoKata
```bash
git remote set-url --push skins-CoderDojoKata-1.24 --add https://bitbucket.org/lorenzocipriani/coderdojokata_skin.git
git remote set-url --push skins-CoderDojoKata-1.24 --add https://github.com/lorenzocipriani/CoderDojo-Kata.git
```

*  Fetch the REL_1.24 branch from MediaWiki skins/Vector
```bash
git fetch --depth=1 skins-CoderDojoKata-1.24
```

*  Checkout fetched REL_1.24 branch into local integration branch (TBD: /master >> /REL_1.24)
```bash
git checkout -B integration-1.24 skins-CoderDojoKata-1.24/master
```


[remote "skin-CoderDojoKata"]
   url = https://bitbucket.org/lorenzocipriani/coderdojokata_skin.git
   fetch = +refs/heads/*:refs/remotes/skin-CoderDojoKata/*
[remote "extension-CoderDojoKata"]
   url = https://bitbucket.org/lorenzocipriani/coderdojokata_extensions.git
   fetch = +refs/heads/*:refs/remotes/extension-CoderDojoKata/*
[remote "extensions"]
   url = https://gerrit.wikimedia.org/r/p/mediawiki/extensions.git
   fetch = +refs/heads/*:refs/remotes/extensions/*

