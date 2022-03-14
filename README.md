## Task 1 & 2 

Please find the task 1 and 2 in the other_tasks directory.

## Task 3
- Setup database add credentials in the .env.
- Install composer and npm dependencies. ```composer install``` & ```npm install```
- Run migrations. ```php artisan migrate```
- Run seeders. ```php artisan db:seed``` it will fetch the record from the api and insert to the database.
- Update the ```BASE_URL``` value to your backend api url by navigating ``resources/js/services/httpService.js``
- Create build file. ```npm run dev```
- Serve the app. ```php artisan serve ```
- For export user feature file generation handle in the queue and file will sent via email attachment as we cannot send the response from the queue we can use websockets for that but this is out of the scope for this task. 

## Task 4
Please find the postman api [documention](https://documenter.getpostman.com/view/6195708/UVsLQ5hE) for this task.
