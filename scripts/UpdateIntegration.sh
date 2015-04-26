#!/bin/bash

source ./build.properties

#CoderDojo-Kata/ CoderDojo-Kata-extensions/ CoderDojo-Kata-skins/
#Kata/  core/ extensions/ kata-extensions/ kata-skins/ skins/ vendor/

echo -e "\nUpdating $GIT_HOME/CoderDojo-Kata/core\n"
cd $GIT_HOME/CoderDojo-Kata/core
git $SSL pull --depth=1 

echo -e "\nUpdating $GIT_HOME/CoderDojo-Kata/vendor\n"
cd $GIT_HOME/CoderDojo-Kata/vendor
git $SSL pull --depth=1 --recurse-submodules

echo -e "\nUpdating $GIT_HOME/CoderDojo-Kata/skins/Vector\n"
cd $GIT_HOME/CoderDojo-Kata/skins/Vector
git $SSL pull --depth=1 --recurse-submodules

echo -e "\nUpdating $GIT_HOME/CoderDojo-Kata/extensions/*\n"
cd $GIT_HOME/CoderDojo-Kata/extensions

for D in *
do
  if [ -d "${D}" ]
  then
    echo -e "\nUpdating $GIT_HOME/CoderDojo-Kata/extensions/${D}\n"
    cd $GIT_HOME/CoderDojo-Kata/extensions/$D
    git $SSL pull --depth=1 --recurse-submodules
    cd $GIT_HOME/CoderDojo-Kata/extensions
  fi
done

echo -e "\nUpdating $GIT_HOME/CoderDojo-Kata/Kata\n"
cd $GIT_HOME/CoderDojo-Kata/Kata
git $SSL pull --depth=1 --recurse-submodules

echo -e "\nUpdating $GIT_HOME/CoderDojo-Kata/kata-skins\n"
cd $GIT_HOME/CoderDojo-Kata/kata-skins
git $SSL pull --depth=1 --recurse-submodules

echo -e "\nUpdating $GIT_HOME/CoderDojo-Kata/kata-extensions\n"
cd $GIT_HOME/CoderDojo-Kata/kata-extensions
git $SSL pull --depth=1 --recurse-submodules

cd $WORKING_DIR

echo -e "Now you can build the integration running\n"
echo -e "bash ${WORKING_DIR}/BuildIntegration.sh\n"

#bash ${WORKING_DIR}/BuildIntegration.sh
