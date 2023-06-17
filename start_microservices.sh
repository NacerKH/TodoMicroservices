#!/bin/bash

# Array of directories containing docker-compose.yml files
directories=(
    "./authorization-ms"
    "./gatway-ms"
    "./taskManagement-ms"
    # Add more directories as needed
)

echo "==========================="
echo "🚀 Starting microservices 🚀"
echo "Your computer is having a hard time running all the microservices at once. But don't worry, I've got you covered! 😊"
echo "I will create local-compose.yml files for you, each with its own database. 📝"
echo "We'll use Nginx as part of the PHP image for a more optimized setup. 🌟"

echo "Do you want to create a new network? (This is useful if it's your first time running the microservices) 🌐 [Y/n]"

read -r network_reply
if [[ $network_reply =~ ^[Yy]$ ]]; then
    echo "==========================="
    echo "Creating a new network... ⚡️"
    docker network create todo-network
    echo "New network 'mynetwork' created successfully! 🎉"
fi

echo "Do you want to use local-compose.yml files? (These files provide better resource management) 📄 [Y/n]"

read -r compose_reply
if [[ $compose_reply =~ ^[Yy]$ ]]; then
    echo "==========================="
    echo "Starting microservices with local-compose.yml... 🚀"
    for dir in "${directories[@]}"; do
        echo "📂 Starting microservices in directory: $dir"
        cd "$dir" || exit
        pwd
        docker-compose -f local-compose.yml up -d --build --remove-orphans
        # docker-compose -f local-compose.yml logs -f &
        echo "==========================="
        echo "🛑 Docker-compose exited with status $?" 
        cd ..
    done
else
    echo "==========================="
    echo "Starting microservices with docker-compose.yml... 🚀"
    for dir in "${directories[@]}"; do
        echo "📂 Starting microservices in directory: $dir"
        cd "$dir" || exit
        pwd
        docker-compose up -d --build --remove-orphans
        # docker-compose logs -f &
        echo "==========================="
        echo "🛑 Docker-compose exited with status $?" 
        cd ..
    done
fi

echo "==========================="
echo "Microservices deployment completed! 🎉"
