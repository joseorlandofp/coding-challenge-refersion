# Laravel 11 Project

## Getting Started

This is a regular Laravel 11 project. To run it, follow these steps:

1. **Clone the repository**
   ```sh
   git clone https://github.com/joseorlandofp/coding-challenge-refersion
   ```

2. **Navigate to the project directory**
   ```sh
   cd /path/to/repository
   ```

3. **Copy the environment file**
   ```sh
   cp .env.example .env
   ```

4. **Set the credentials** in the `.env` file for the public and secret key. Placeholders should already be in place.
  ```sh
    REFERSION_PUBLIC_KEY=
    REFERSION_SECRET_KEY=
   ```

5. **Install dependencies**
   ```sh
   composer install
   ```

6. **Generate the application key**
   ```sh
   php artisan key:generate
   ```

7. **Start the server**
   ```sh
   php artisan serve
   ```

## API Requests

Currently, requests are made using synchronous HTTP calls via Laravel's built-in HTTP client. The setup for the Refersion API is encapsulated within a macro located at:

📌 `app/Providers/AppServiceProvider.php`

## Possible Improvements

- **Asynchronous Requests:** Since multiple requests are being made, we could process affiliate totals asynchronously. However, to prevent potential rate-limiting issues, synchronous requests were used to ensure the task functions correctly during testing.

- **Denormalization & Webhooks:** Instead of calling the API every time, we could denormalize data and set up a webhook to receive conversion events. This would significantly improve speed.

## Known Issue

The `Get Totals` endpoint currently returns zero commissions for all affiliates. Despite modifying API parameters such as date, status, and type, the response remains unchanged. Based on this, it is assumed that the commission values in the database are genuinely zero.

## Leaderboard

Once everything is set up, navigate to the address provided by `php artisan serve`. The leaderboard will display the top five affiliates with the **"Display on Leaderboard"** flag set to `true`.

⚠️ Since commission values are currently zero, the system simply sorts and selects the first five affiliates based on this condition but it has a method to sort it properly if values are real.


