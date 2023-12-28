****Laravel Backend Documentation********

**Overview**

This Laravel backend serves as the backend component for a library management system. It includes CRUD REST APIs for managing users, books, and book loans.
**Installation**

**1. Clone the repository**
  	 git clone https://github.com/keith-owira/eLibraryMgmt.git 

**2. Install dependencies:**
 	    composer install

3. Copy `.env.example` to `.env` and configure your environment variables.

**4. Generate application key:**
  	 php artisan key:generate

****Database Setup****

1. Create a MySQL database.

2. Configure your database connection in the `.env` file:

   ```env
   DB_CONNECTION=mysql
   DB_HOST=your_database_host
   DB_PORT=your_database_port
   DB_DATABASE=your_database_name
   DB_USERNAME=your_database_user
   DB_PASSWORD=your_database_password
   ```

3. Run migrations and seed the database:
   php artisan migrate --seed
API Documentation
The api Documentation is accesible via https://documenter.getpostman.com/view/16144750/2s9YkuZdZ7#intro the link.


**Authentication**

The application uses Laravel Sanctum for API authentication. 

Laravel Backend
Required Endpoints
Create Admin User
Admin should create User
Admin should create books
Admin Should edit books
Admin should manage book loans
Create normal User
Normal User should borrow a book
Admin Should approve the loan request
Admin should issue the book to the user
Users should be able to extend the book loan if they cannot return it within the specified return date.
User to get a reminder of when the book is due

