FOOD MENU MANAGEMENT SYSTEM

OVERVIEW:
A Laravel 12 + PostgreSQL web application for managing food & drink menus. Includes:
- User login & registration (Breeze for web, JWT for API)
- CRUD operations for food menus
- Image upload for each menu item
- Search, filter, and sorting
- RESTful API endpoints (JWT protected)
- Action logging (who created/updated/deleted food menus)


TECH STACK:
- Backend: Laravel 12
- Frontend: Blade templates + jQuery DataTables (client-side)
- Database: PostgreSQL
- Authentication: Laravel Breeze (web), JWT (API)
- Logging: food_menu_logs table records all CRUD actions


INSTALLLATIONS:

1. Clone repo
git clone https://github.com/amirhxil/FullStack-FoodMenuManagement-Assessment.git

2. Install dependencies
composer install
npm install
npm run dev

3. Configure .env
DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=your_db_name
DB_USERNAME=your_db_user
DB_PASSWORD=your_db_password
JWT_SECRET=your_jwt_secret

4. Run migrations & seed (optional for sample data)
php artisan migrate

5. Run server
php artisan serve
Visit http://127.0.0.1:8000


FEATURES:

1. Web (Blade)
- Dashboard: Overview
- Food Menus:
    - List menus (search by name, filter by type, sort by name)
    - Add new menu with image
    - Edit / Delete menu
- User profile: Edit or delete account

2. API (JWT):
- Register & Login: POST /api/register, POST /api/login
- Protected endpoints (JWT required):
    - GET /api/food-menus → list menus
    - GET /api/food-menus/{id} → view menu
    - POST /api/food-menus → create menu
    - PUT /api/food-menus/{id} → update menu
    - DELETE /api/food-menus/{id} → delete menu

3. Logging
- Table: food_menu_logs
- Columns: id, user_id, food_menu_id, action, created_at, updated_at
- Purpose: Tracks which user created, updated, or deleted a food menu
- Check logs: Open pgAdmin4 → select database → food_menu_logs table