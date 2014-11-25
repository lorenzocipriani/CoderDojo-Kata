#!/bin/bash
cd ~/git/CoderDojo-Kata
git fetch --depth=1 --all
git pull --no-commit -a -n kata-integration-1.24 REL1_24
git commit -a -m 'Update kata-integration'
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
git pull --no-commit -s subtree extensions-CoderDojoKata-1.24 REL1_24
git commit -a -m 'Update extensions-CoderDojoKata-1.24'
git pull --no-commit -s subtree skins-CoderDojoKata-1.24 REL1_24
git commit -a -m 'Update skins-CoderDojoKata-1.24'
git pull --no-commit -a -n kata-rel-1.24 REL1_24
git commit -a -m 'Update kata-rel-1.24'
git push

