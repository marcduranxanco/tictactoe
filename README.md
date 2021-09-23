# TIC TAC TOE API GAME


## Install the project
The project has a mikefile that allows you to perform the basic actions for this project. Description:
- make install: installs the project
- make up: starts the docker containers
- make down: stops the docker containers
- make dump: run the composer -- dump
- make dumpo: composer dump -o
- make php: access to the php container
- make run-tests: runs the project tests
- make play: starts the cli project

## Foder estructure
A structure has been created by trying to apply DDD as follows:
- Bounded Context: Game (src/Game)
 - Modules: Users, Games (each module needs its own domain and controller)
- Shared: Common classes (src/Shared)
- App: Main apps (src/app)
- - tictactoe: main tictactoe game app
- Tests: The test folder follows the folder code structure