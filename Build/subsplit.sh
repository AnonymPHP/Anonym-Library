#!/usr/bin/env bash

git subsplit init https://github.com/AnonymPHP/Anonym-Library.git

git subsplit publish --heads="master" --no-tags src/Anonym/Patterns:git@github.com:AnonymPHP/patterns.git
