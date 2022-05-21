# Example CI with php

Example of how to run ci with php on GitHub.

## what includes
* tests with phpunit
* code analysis with php codesniffer
* code analysis with localhost sonarqube
* code analysis on every pull request with sonarcloud

## Requirements
* [sonar-scanner](https://docs.sonarqube.org/latest/analysis/scan/sonarscanner/)


## localhost tests
* you will need to have sonar-scanner installed
* run
```
docker-compose up -d
```
* access the local sonarqube, change your password and create your project. then create the sonar-project.properties file by copying from sonar-project.properties.dev and add your login token
```
http://localhost:9000/
```
* enter the container and run the tests
```
docker-compose exec app-example-ci-php bash
composer tests-dev
```
* exit the container and run sonar-scanner
```
sonar-scanner
```
* access sonarqube and see the results
```
http://localhost:9000/
```

## remote tests
* just create a pull request that is all integrated with GitHub actions and sonarcloud.
