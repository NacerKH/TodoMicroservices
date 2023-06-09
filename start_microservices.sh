#!/bin/bash

# Array of directories containing docker-compose.yml files
directories=(
    "./authorization-ms"
    "./gatway-ms"
    "./taskManagement-ms"
    # Add more directories as needed
)

# Iterate over each directory and start microservices
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