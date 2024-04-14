## Next-Basket Technical Challenge BE

This technical challenge involves two Symfony microservices communicating through RabbitMQ.

## Getting Started
To begin, execute the install.sh script.

## Test
Run the test.sh script to perform tests.
    
## User
Access the User service via Postman at http://localhost:81 Make a POST request to /users with a body containing the keys {"email", "firstName", "lastName"}.

## Notifications
Whenever a new user is created in the User service, the information is stored in the database and simultaneously saved to a log via RabbitMQ.
