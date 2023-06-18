# Task Management Microservice 🚀

[![License](https://img.shields.io/badge/license-MIT-blue.svg)](https://opensource.org/licenses/MIT)

> This repository contains the source code for a microservice built using PHP and the Laravel framework. The microservice provides powerful functionalities for managing tasks and to-do lists. It follows the repository pattern for data abstraction and utilizes Redis for event broadcasting and queue management.

## 📚 Models

The microservice includes two main models:

### Task Model ✅

The Task model represents an individual task. It contains attributes such as `title`, `content`, `priority`, `date_of_completion`, `list_task_id`, and `user_id`. The model establishes a relationship with the ListTask model and includes attachments associated with each task.

### ListTask Model 📋

The ListTask model represents a to-do list. It has a single attribute, `name`, which stores the name or title of the list. The model has a one-to-many relationship with the Task model.

## 🗄️ Repositories

This microservice follows the repository pattern, which promotes a separation of concerns and allows for better maintainability and testability. The repositories handle the CRUD operations for tasks and to-do lists and provide an abstraction layer for data access.

## 📢 Event Broadcasting

Event broadcasting is utilized in this microservice to send notifications and updates to the authorization microservice and users. Two events are broadcasted:

- AssignedTaskEvent: 🤝 Broadcasted when a task is assigned to a user.
- ChangeStatusTaskEvent: 🔄 Broadcasted when the status of a task is changed.

The events are listened to by event listeners, which publish the event data to Redis for further processing.

## 🚦 Supervisor Configuration

Supervisor is used to manage processes in the background. In the `supervisor.conf` file, a program named `reminder-tasks-worker` is configured to run the Laravel scheduler using the `schedule:work` command. This ensures that scheduled tasks, such as reminders, are executed reliably.

## 🐳 Docker Configuration

Docker is employed for containerization, allowing for easy deployment and scalability. The configuration includes two services:

- `task-management-ms`: 🖥️ This service runs the microservice using the `digitalocean.com/php` image. The project files are mounted, and environment variables are set to configure the microservice, including database connection, Redis settings, and service-specific configurations.
- `redis`: 📟 This service provides the Redis instance used for event broadcasting and queue management.

Both services are connected to an external Docker network named `todo-network`.

## 🛣️ Routes

The microservice exposes the following routes for task and to-do list management:

- `GET /TaskManagement/list-task`: Retrieves all to-do lists.

- `POST /TaskManagement/list-task`: Creates a new to-do list. ✨
 ```
{

    "name":"todo"
    
}
 ```
 
- `GET /api/TaskManagement/list-task/{id}`: Retrieves a specific to-do list by ID.
- `PUT /api/TaskManagement/list-task/{id}`: Updates a specific to-do list by ID. ✏️
 ```
{

    "name":"todo-update"
    
}
 ```
- `DELETE TaskManagement/list-task/{id}`: Deletes a specific to-do list by ID.

- `GET TaskManagement/task`: Retrieves all tasks.

- `POST /TaskManagement/task`: Creates a new task. ✅
```
{
"title": "feature/Hello_there_is_Kali_here",
"content": " Content for test : Make Majestic Modular Yoo",
"priority":"1" ,
"date_of_completion":"2024-09-24 

20:28:07",
"list_task_id":"1"
}
```
- `GET /api/TaskManagement/task/{id}`: Retrieves a specific task by ID.


- `POST /api/TaskManagement/task/assign/{task:id}`: Assigns a task to a user. 🤝
```
{
    "user_assigned_id":1
}
```
- `GET /api/TaskManagement/task/User/Tasks`: Retrieves tasks assigned to a specific user.
- `POST /api/TaskManagement/task/User/change-status/{task:id}`: Changes the status of a task. 🔄
```
{

  "list_task_id":2
}
```
- `POST /api/TaskManagement/task/User/change-priority/{task:id}`: Change priority of a task.  
```
{

 "priority":0
}
```

## 🔒 Security

To ensure security, the microservice includes an `AuthorizationVerificationMiddleware`. This middleware checks for the presence of the `X-User-Id` header in the request and verifies the authenticity of the user. If the header is missing or invalid, an unauthorized response is returned.

## Usage/Examples

### Broadcasting Reminder Task for Testing 📢

To test the broadcasting of a reminder task, follow these steps:

-  Make sure you have Docker installed on your system.
-  Open your terminal or command prompt.
-  Run the following commands:

```bash
docker-compose up --build --remove-orphans -d
docker exec -it task-management-ms bash
php artisan task:events test
```

These commands will start the Docker containers, access the task-management-ms container's bash terminal, and execute the `task:events` command with the `test` argument to trigger the broadcasting of the reminder task.

Feel free to contribute to this project and make it even better! 🌟





