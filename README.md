# YAAnonymousBoard
Yet Another Anonymous Board

## Docker Setup

This project can be run using Docker Compose for easy deployment.

### Prerequisites
- Docker
- Docker Compose

### Running the Application

1. Clone this repository
2. Start the containers:
   ```
   docker-compose up -d
   ```
3. Access the application in your browser:
   ```
   http://localhost:80
   ```

### Stopping the Application
```
docker-compose down
```

To remove all data (including the database):
```
docker-compose down -v
```
