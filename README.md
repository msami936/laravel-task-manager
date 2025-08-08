# Laravel Task Manager

A modern, responsive task management web application built with Laravel 10, featuring drag-and-drop task reordering, project organization, and a beautiful Bootstrap-based UI.

## 🚀 Features

### Core Features
- **Create Tasks** - Add tasks with names and assign them to projects
- **Edit Tasks** - Modify task names and project assignments
- **Delete Tasks** - Remove tasks with confirmation
- **Drag & Drop Reordering** - Reorder tasks via drag-and-drop with automatic priority updates
- **Project Management** - Organize tasks into projects
- **Project Filtering** - Filter tasks by project using dropdown
- **Responsive Design** - Modern, mobile-friendly Bootstrap 5 interface

### Technical Features
- **Laravel 10** - Latest Laravel framework with best practices
- **MySQL Database** - Robust data persistence
- **Eloquent Relationships** - Proper model relationships between tasks and projects
- **Resource Controllers** - RESTful API design
- **Request Validation** - Comprehensive input validation
- **CSRF Protection** - Built-in security features
- **Modern UI/UX** - Bootstrap 5 with Font Awesome icons

## 📋 Requirements

- PHP 8.1 or higher
- Composer
- MySQL 5.7 or higher
- Web server (Apache/Nginx) or PHP built-in server

## 🛠️ Installation

### 1. Clone the Repository
```bash
git clone <repository-url>
cd laravel-task-manager
```

### 2. Install Dependencies
```bash
composer install
```

### 3. Environment Setup
```bash
cp .env.example .env
```

Edit the `.env` file with your database credentials:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel_task_manager
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

### 4. Generate Application Key
```bash
php artisan key:generate
```

### 5. Run Migrations and Seeders
```bash
php artisan migrate --seed
```

This will create the database tables and populate them with sample data.

### 6. Start the Development Server
```bash
php artisan serve
```

The application will be available at `http://localhost:8000`

## 🎯 Usage

### Managing Projects
1. Navigate to **Projects** in the top navigation
2. Click **Add Project** to create new projects
3. Use the action buttons to edit, view, or delete projects
4. Click **View Tasks** to see all tasks in a specific project

### Managing Tasks
1. Navigate to **Tasks** in the top navigation
2. Use the **Filter by Project** dropdown to view tasks by project
3. Click **Add Task** to create new tasks
4. **Drag and drop** tasks to reorder them (priority updates automatically)
5. Use action buttons to edit, view, or delete tasks

### Drag & Drop Reordering
- Tasks can be reordered by dragging them up or down
- Priority numbers update automatically in the database
- Visual feedback during dragging
- Smooth animations for better UX

## 🗄️ Database Structure

### Projects Table
- `id` - Primary key
- `name` - Project name
- `created_at` - Creation timestamp
- `updated_at` - Last update timestamp

### Tasks Table
- `id` - Primary key
- `name` - Task name
- `priority` - Integer priority (1 = highest)
- `project_id` - Foreign key to projects table
- `created_at` - Creation timestamp
- `updated_at` - Last update timestamp

## 🔧 API Endpoints

### Tasks
- `GET /tasks` - List all tasks
- `GET /tasks/create` - Show create form
- `POST /tasks` - Store new task
- `GET /tasks/{id}` - Show task details
- `GET /tasks/{id}/edit` - Show edit form
- `PUT /tasks/{id}` - Update task
- `DELETE /tasks/{id}` - Delete task
- `POST /tasks/reorder` - Reorder tasks (AJAX)

### Projects
- `GET /projects` - List all projects
- `GET /projects/create` - Show create form
- `POST /projects` - Store new project
- `GET /projects/{id}` - Show project details
- `GET /projects/{id}/edit` - Show edit form
- `PUT /projects/{id}` - Update project
- `DELETE /projects/{id}` - Delete project

## 🎨 Frontend Technologies

- **Bootstrap 5** - Modern CSS framework
- **Font Awesome 6** - Icon library
- **SortableJS** - Drag and drop functionality
- **Vanilla JavaScript** - No heavy frameworks

## 🔒 Security Features

- CSRF protection on all forms
- Input validation and sanitization
- SQL injection protection via Eloquent ORM
- XSS protection via Blade templating

## 🚀 Deployment

### Production Setup

1. **Server Requirements**
   - PHP 8.1+
   - MySQL 5.7+
   - Composer
   - Web server (Apache/Nginx)

2. **Deployment Steps**
   ```bash
   # Clone repository
   git clone <repository-url>
   cd laravel-task-manager
   
   # Install dependencies
   composer install --optimize-autoloader --no-dev
   
   # Set up environment
   cp .env.example .env
   # Edit .env with production settings
   
   # Generate key
   php artisan key:generate
   
   # Run migrations
   php artisan migrate --force
   
   # Set proper permissions
   chmod -R 755 storage bootstrap/cache
   
   # Configure web server to point to public/ directory
   ```

3. **Web Server Configuration**
   - Point document root to `public/` directory
   - Enable URL rewriting (mod_rewrite for Apache)
   - Set proper file permissions

## 🧪 Testing

Run the test suite:
```bash
php artisan test
```

## 📝 License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

## 🤝 Contributing

1. Fork the repository
2. Create a feature branch
3. Make your changes
4. Add tests if applicable
5. Submit a pull request

## 📞 Support

For support, please open an issue on the GitHub repository or contact the development team.

---

**Built with ❤️ using Laravel 10**
