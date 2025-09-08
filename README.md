# JournaTracker

JournaTracker is a modern blog post and journal management application built with Laravel. It allows users to create, edit, and organize their blog posts or personal journal entries efficiently. With a clean interface and robust features, JournaTracker is designed to help writers, bloggers, and anyone who wants to keep track of their thoughts and stories in a structured way.

Key features include:

- Easy post creation and editing
- Categorization and tagging
- Responsive dashboard analytics
- User-friendly interface

Whether you're maintaining a personal diary or running a professional blog, JournaTracker streamlines your writing workflow and keeps your content organized.

## Getting Started

Follow these steps to set up the system:

1. **Clone the repository**

   ```sh
   git clone https://github.com/DJmistMAGO/journatracker.git
   cd journatracker
   ```

2. **Install PHP dependencies**

   ```sh
   composer install
   ```

3. **Install Node.js dependencies**

   ```sh
   npm install
   ```

4. **Copy the example environment file and set your configuration**

   ```sh
   cp .env.example .env
   ```

5. **Generate the application key**

   ```sh
   php artisan key:generate
   ```

6. **Run database migrations**

   ```sh
   php artisan migrate
   ```

7. **Start the development server**

   ```sh
   php artisan serve
   ```

8. **Compile frontend assets**
   ```sh
   npm run dev
   ```

Now you can access the application at `http://localhost:8000`.

---

### Or if using Laragon

If you are using Laragon, follow these steps:

1. Place the cloned `journatracker` folder inside your Laragon `www` directory (e.g., `C:\laragon\www\journatracker`).
2. Start Laragon and ensure Apache/Nginx and MySQL are running.
3. Open a terminal in the project directory and run:
   ```sh
   composer install
   npm install
   cp .env.example .env
   php artisan key:generate
   php artisan migrate
   npm run dev
   ```
4. Visit your project in the browser at `http://journatracker.test` (or the domain Laragon assigns).
