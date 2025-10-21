
# 🕒 Timetable System

A Laravel-based **School Timetable Management System** that allows administrators to manage **classes, subjects, teachers, time slots, and weekly schedules** efficiently.

## 🚀 Features

- Full CRUD for **Classes, Teachers, Subjects, and Time Slots**
- Assign subjects to specific classes (e.g., Class 10 → Mathematics, English, etc.)
- Generate weekly timetables for each class
- Display class-wise timetables (easy viewing for teachers/students)
- Dashboard with quick statistics (total classes, teachers, subjects, time slots)
- Modern UI using **Laravel Breeze + Tailwind CSS**
- Clean and relational database structure with Eloquent ORM

## 🧰 Tech Stack

- **Laravel** (PHP Framework)
- **Laravel Breeze** (Authentication & Starter Kit)
- **Tailwind CSS** (Styling)
- **MySQL** (Database)
- **Eloquent ORM** (Model relationships)

## ⚙️ Installation Guide

Follow these steps to set up the project locally:

1. **Clone the repository**
   ```bash
   git clone https://github.com/mimranlahoori/timetable_system.git
   cd timetable_system
   ```

2. **Install dependencies**

   ```bash
   composer install
   npm install
   npm run dev   # or npm run build for production
   ```

3. **Environment setup**

   * Copy `.env.example` to `.env`
   * Update your database credentials
   * Generate the app key:

     ```bash
     php artisan key:generate
     ```

4. **Run migrations and seeders**

   ```bash
   php artisan migrate --seed
   ```

5. **Start the local server**

   ```bash
   php artisan serve
   ```

   Open your browser and visit: [http://localhost:8000](http://localhost:8000)

6. **Login or Register**

   * Laravel Breeze provides authentication out of the box.
   * After login, you can access the dashboard, manage classes, subjects, and create timetables.

## 📂 Project Structure Overview

| Directory                        | Description                                                        |
| -------------------------------- | ------------------------------------------------------------------ |
| `app/Models`                     | Eloquent models (Classroom, Teacher, Subject, TimeSlot, Timetable) |
| `database/migrations`            | All migration files defining table structures                      |
| `database/seeders`               | Demo data (classrooms, teachers, subjects, etc.)                   |
| `resources/views`                | Blade templates for dashboard, timetable views, CRUD pages         |
| `routes/web.php`                 | Web routes for all modules                                         |
| `resources/css` & `resources/js` | Tailwind and Vite setup for frontend assets                        |

## 🧩 Future Enhancements

* Drag-and-drop timetable editing
* PDF export of weekly schedules
* Role-based access control (Admin, Teacher, Student)
* Notifications for class schedule changes

## 🧑‍💻 Author

Developed by [**M imran Lahoori**](https://github.com/mimranlahoori)
Feel free to fork, contribute, or report any issues!
