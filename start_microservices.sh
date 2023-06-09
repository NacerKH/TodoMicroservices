#!/bin/bash

# Array of directories containing docker-compose.yml files
directories=(
    "./authorization-ms"
    "./gatway-ms"
    "./taskManagement-ms"
    # Add more directories as needed
)
echo "==========================="
echo "Starting microservices"
echo "Your Computer is having a hard time running all the microservices at once. Dont worry!"
echo "I have a solution for you.   🌟 " 
echo "i make local-compose.yml files for you. " 
echo " One Sql service for all microservices. each microservice has database with different name.  🎉   "
echo " Use Nginx web server Part of image PHP not separatly service webserver.  🚀 "

echo  "Do you want local-compose less Ressource ? [Y/n] " 

read REPLY 
echo $REPLY
if [[ $REPLY =~ ^[Yy]$ ]]
then
    echo "==========================="
    echo "Starting microservices with local-compose.yml"
    for dir in "${directories[@]}"
    do
        echo "Starting microservices in directory: $dir"
        cd "$dir"
        pwd
        docker-compose -f local-compose.yml up -d --build  --remove-orphans 
            echo "==========================="
            echo "Docker-compose exited with status $?" 
        cd ..
    done
else
    echo "==========================="
    echo "Starting microservices with docker-compose.yml"
    for dir in "${directories[@]}"
    do
        echo "Starting microservices in directory: $dir"
        cd "$dir"
        pwd
        docker-compose up -d --build  --remove-orphans 
            echo "==========================="
            echo "Docker-compose exited with status $?" 
        cd ..
    done
fi

echo "==========================="