
# TODO List Microservices

This is a modular Laravel application designed to manage TODO lists using the repository and contracts design pattern. The application is divided into microservices, allowing for scalability, maintainability, and independent deployment of each module.


## Features

- `TODO Management`: Create, update, and delete TODO items.
- `User Authentication`: Secure user registration and login functionality
- `Authorization` : Control access to TODO lists based on user roles and    permissions.
- `Modular Design`: Each microservice focuses on specific functionality, allowing for easier development and maintenance.
- `Repository Pattern `: Implements the repository pattern to abstract data persistence and provide a consistent interface for working with different data sources.
- `Contracts`: Utilizes contracts to define interfaces and enforce implementation standards, improving code reusability and flexibility.
- `Scalable Architecture`: The microservices architecture enables horizontal scaling by deploying multiple instances of the same service.
- `RESTful API`: Provides a RESTful API for seamless integration with frontend applications or third-party services.
- `Testing`: Includes comprehensive unit tests and integration tests to ensure application reliability and correctness.

## Running the Microservices

To run all the microservices at once, you can use the provided script `start_microservices.sh`. This script automates the process of starting each microservice using Docker Compose.

### Prerequisites

Before running the script, make sure you have Docker and Docker Compose installed on your machine.

### Design


![Logo](https://github.com/khalifa-dv/TodoMicroservices/blob/main/Docs/Design.png)


### Steps

1. Open a terminal and navigate to the root directory of the project.
2. Run the following command to give execute permission to the script:

   ```
    - chmod +x start_microservices.sh
   ./start_microservices.sh

   ```




