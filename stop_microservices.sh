#!/bin/bash

# Array of directories containing microservices
directories=(
    "./authorization-ms"
    "./gatway-ms"
    "./taskManagement-ms"
    # Add more directories as needed
)

# Iterate over each directory and stop microservices
for dir in "${directories[@]}"
do
    echo "stop docker-compose in directory: $dir"
    cd "$dir"
    pwd
    docker-compose -f local-compose.yml down
        echo "==========================="
        echo "Docker-compose exited with status $?" 
    cd ..
done