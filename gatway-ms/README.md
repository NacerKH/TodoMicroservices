

# Gateway Service 🚀

The gateway service acts as an intermediary between client applications and the microservices in the system. It handles routing requests to the appropriate microservice, performs authentication and authorization checks, and communicates with external services.

## ⚙️ Functionality

- Routing: The gateway service routes incoming requests to the appropriate microservice based on the requested endpoint.
- Authentication: It performs authentication checks by validating the authorization token in the request headers.
- Authorization: The gateway service verifies the user's permissions and role-based access control before forwarding the request to the microservices.
- Service Communication: It communicates with the microservices using HTTP requests and handles the response.
- Error Handling: The gateway service handles errors and returns appropriate error responses to the client applications.

## 🛠️ Technologies Used

- 🐘 PHP
- 🌐 Laravel Framework



## 🔒 Security and Authentication

- The gateway service ensures the security of the system by performing authentication and authorization checks.
- Requests to protected endpoints require an authorization token in the request headers.
- The gateway service validates the token by forwarding it to the authorization microservice for verification.
- If the token is valid, the user's role-based permissions are checked before forwarding the request to the corresponding microservice.

## 🚦 Routing and Endpoint Examples

- The gateway service routes requests to the appropriate microservice based on the requested endpoint.
- Here are some examples of the supported endpoints:

  - `GET /TaskManagement/list-task`: Retrieves all to-do lists from the Task Management microservice.
  - `POST /TaskManagement/list-task`: Creates a new to-do list in the Task Management microservice.
  - `GET /TaskManagement/task/{id}`: Retrieves a specific task by ID from the Task Management microservice.
  - `POST /TaskManagement/task/assign/{id}`: Assigns a task to a user in the Task Management microservice.
  - `POST /Authorization/login`: Performs user authentication in the Authorization microservice.

- You can find more details about the supported endpoints in the respective microservice's documentation.

## 💡 Customization and Extensibility

- The gateway service can be customized and extended according to your specific requirements.
- You can add middleware to perform additional checks or transformations on incoming requests.
- You can modify the routing logic to handle complex request routing scenarios.
- Additional error handling and logging can be implemented to enhance the service's robustness and maintainability.

Apologies for the confusion. Here's the revised version of the README file with the unnecessary YAML configuration removed:



## 🚀 Setup and Installation

To set up the gateway service, follow these steps:

1. Make sure you have Docker and Docker Compose installed on your machine.

2. Create a new directory for your project and navigate to it in your terminal.

3. Create a `docker-compose.yml` file and paste the necessary service configurations.

4. Customize the service configurations according to your needs. You can modify environment variables, ports, volumes, etc.

5. Save the `docker-compose.yml` file.

6. In the terminal, navigate to the project directory and run the following command to start the services:

```bash
docker-compose up -d
```

7. Docker Compose will build the necessary images and start the containers for the gateway service, MySQL database, and Nginx web server.

8. Once the containers are up and running, you can access the gateway service through `http://localhost:3098` in your web browser.

9. You can make requests to the supported endpoints mentioned in the README, and the gateway service will handle the routing and communication with the microservices.

That's it! You now have the gateway service up and running using Docker Compose.

Feel free to customize the configuration further to fit your specific project requirements.
```
