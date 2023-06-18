
# Microservice Authorization 🔒

A microservice authorization system built using HMVC (Hierarchical Model-View-Controller) architecture. This system provides user authentication, role-based permissions, and activity logging for tracking user actions.

## ✔️ Features

✅ User login and logout functionality  
✅ Role-based permissions  
✅ Activity logging for tracking user actions  
✅ Redis-based event listener for task-related events  
✅ Supervisor configuration for running the event listener in the background  

## 🔧 Technologies Used

- 🐘 PHP
- ⚙️ Laravel Framework
- 🔁 Redis
- 💾 MySQL
- 💻 Nginx

## 🚀 Installation

1. Clone the repository:

```
git clone <repository-url>
```

2. Set up the Docker environment:

```
docker-compose up -d
```

3. Install dependencies:

```
docker-compose exec todo-authorization-ms composer install
```

4. Run database migrations and seeders:

```
docker-compose exec todo-authorization-ms php artisan migrate --seed
```

5. Generate the configuration cache:

```
docker-compose exec todo-authorization-ms php artisan config:cache
```

6. Clear the route cache:

```
docker-compose exec todo-authorization-ms php artisan route:clear
```

7. Start the event listener using Supervisor:

```
docker-compose exec todo-authorization-ms ./start-supervisor.sh
```

8. Open the application in your browser:

```
http://localhost:3080
```

## 💻 Usage

### User Authentication

- To log in, send a POST request to `/authorization/login` with the following parameters:
  - `email`: The user's email address
  - `password`: The user's password

- To log out, send a POST request to `/authorization/logout` with the user's authorization token in the headers.

- To check the validity of an access token, send a GET request to `/check-token` with the user's authorization token in the headers.

### Role-based Permissions

- The system supports role-based permissions. You can define roles and assign permissions to each role.

### Activity Logging

- All user actions are logged using the ActivityLog module. To view the activity logs, send a GET request to `/activity-logs`. Authentication is required to access this endpoint.

### Task-related Events

- The system listens to task-related events using Redis. To trigger a task-related event, publish a message to one of the following channels:
  - `reminder-task`: Sends reminder notifications for tasks.
  - `change-status-task`: Sends notifications for task status changes.
  - `task-was-assigned`: Sends notifications for assigned tasks.

- The event listener (`TasksEventsListener`) processes the received events and sends the appropriate notifications to the assigned users.

