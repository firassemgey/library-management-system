<h1>Library Management System (LMS)</h1>

- Postman test Authentication [documenter](https://documenter.getpostman.com/view/34547826/2sA3JNafMy)
- Postman test Authors [documenter](https://documenter.getpostman.com/view/34547826/2sA3JNafN2)
- Postman test Books [documenter](https://documenter.getpostman.com/view/34547826/2sA3JNafN3)
- Postman test Comments [documenter](https://documenter.getpostman.com/view/34547826/2sA3JNafN4)
- Here are the instructions for setting up the project: <br/>
NOTE: you need to install xammp and any editor on your desktop.
<br>1- Clone the repository to your local machine using the following command: 
<br><code>git clone https://github.com/firassemgey/library-management-system</code><br>
2- Install the project dependencies using Composer: 
<br><code>composer install</code><br>
3- Create a copy of the .env.example file and rename it to .env: 
<br><code>cp .env.example .env</code><br>
4- Generate a new application key: 
<br><code>php artisan key:generate</code><br>
5- Configure the database connection in the .env file: 
<br><code>DB_CONNECTION=mysql<br>
        DB_HOST=127.0.0.1
        DB_PORT=3306
        DB_DATABASE=task9
        DB_USERNAME=root
        DB_PASSWORD=></code><br>
6- Run the database migrations: 
<br><code>php artisan mi:f</code><br>
7- Start the development server: 
<br><code>php artisan serve</code><br>
8- Access the application in your web browser at http://localhost:8000. 

