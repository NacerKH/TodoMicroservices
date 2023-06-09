#!/bin/bash

# Array of directories containing microservices
directories=(
    "./authorization-ms"
    "./gatway-ms"
    "./taskManagement-ms"
    # Add more directories as needed
)
echo  "What You use local-compose ? [Y/n] 🌀 "
read REPLY 
echo $REPLY
if [[ $REPLY =~ ^[Yy]$ ]]
then
    echo "==========================="
    echo "Stoping microservices with local-compose.yml"
    for dir in "${directories[@]}"
    do
        echo "Stoping microservices in directory: $dir"
        cd "$dir"
        pwd
        docker-compose -f local-compose.yml down
            echo "==========================="
            echo "Docker-compose exited with status $?" 
        cd ..
    done
else
    echo "==========================="
    echo "Stoping microservices with docker-compose.yml"
    for dir in "${directories[@]}"
    do
        echo "Stoping microservices in directory: $dir"
        cd "$dir"
        pwd
        docker-compose down
            echo "==========================="
            echo "Docker-compose exited with status $?" 
        cd ..
    done
fi

echo "==========================="