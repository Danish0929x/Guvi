# Guvi Task

## Description

User Authencation using PHP with SQL (Login credential) and Mongodb(Profile details).

- Register page - Where user can register by giving basic details, server will check the email if not already exist, It will save [Email, Number, Name] in Mongodb and [Email and password] in SQL. Email will act as key.
- Login page - Where user can login and Redis will help to response if already same request appears. It will redirect to profile page if credentials are correct. Store login details in localhost.
- Profile page - Where user can read profile details which will be fetched from Mongodb using localhost data.

## Prerequisites

List any software, tools, or dependencies that users need to have installed before they can use your project.

- PHP 
- MySQL 
- Web server (Apache)
- jQuery
- Bootstrap

## Getting Started

1. Clone the repository:

   ```bash
   git clone https://github.com/your-username/your-project.git

2. Start the Xampp, start server and sql
3. open localhost/Guvi/
