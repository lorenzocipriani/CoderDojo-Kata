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

Workspace contains data from the following git repositories:
*  MediaWiki core
*  MediaWiki vendor
*  MediaWiki skins/Vector
*  MediaWiki extensions/[several ones]
*  CoderDojo-Kata Kata (this repository)
*  CoderDojo-Kata kata-skins
*  CoderDojo-Kata kata-extensions
and merge them together into a folder that is used to sync last updates to the running wiki platform.

### Prerequisite ###

*  Git 1.7.5+
*  PHP 5.4+

### Create local repository ###

Clone to a local folder branch REL1_24 from CoderDojo-Kata Kata repository on Github:
```bash
git clone --depth=1 --branch REL1_24 https://github.com/lorenzocipriani/CoderDojo-Kata.git 
```

Move to the scripts folder and edit the build.properties to reflect you local setup.
Main elements to be configured are:
```bash
GIT_HOME={/full/path/to/the/folder/of/local/git/repository}
KATA_HOME={/full/path/to/the/folder/of/running/wiki/instance}
PHP_CLI={/full/path/to/the/php/executable}
```

Execute the script CreateRepository.sh
```bash
bash ./CreateRepository.sh
```

### Integration build ###

When the local repository has been created in $GIT_HOME, execute the script BuildIntegration.sh
```bash
bash ./BuildIntegration.sh
```

### Build updates (TO BE DONE!!!) ###

CreateRepository.sh is needed only when the first time a local repository needs to be created. To keep this repository updated execute the script UpdateIntegration.sh
```bash
bash ./UpdateIntegration.sh
```
Then execute the script BuildIntegration.sh
```bash
bash ./BuildIntegration.sh
```
