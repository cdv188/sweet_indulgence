# 🍰 Sweet Indulgence Web Application

**Sweet Indulgence** is a web-based kiosk system built with **PHP**, **JavaScript**, **HTML/CSS**, **Bootstrap**, and **Composer**.  
It allows customers to place dessert or pastry orders and automatically generates a **recipe/receipt**. The **admin dashboard** tracks, confirms, and manages incoming orders.

---

## 🧾 Key Features

### 🧍 Customer Side
- Browse the digital menu (cakes, pastries, desserts)
- Place an order via kiosk-style UI
- Instantly generate and view a **recipe/receipt**
- Responsive design with Bootstrap

### 🛠️ Admin Side
- View and manage all customer orders
- Confirm, track, or cancel orders
- Download receipts for record-keeping
- Admin authentication (if implemented)

---

## 🧰 Tech Stack

- **PHP** – Backend scripting
- **Composer** – Dependency management
- **JavaScript** – Client-side functionality
- **Bootstrap** – Responsive and styled UI
- **HTML/CSS** – Webpage layout and styling
- **MySQL** – Database for storing orders and menu items (assumed)

---

## 🗂️ Project Structure (Example)

```
sweet_indulgence/
│
├── customer/              # Customer-side interface
│   ├── index.php          # Kiosk order page
│   ├── receipt.php        # Displays generated recipe
│   └── assets/            # Images, scripts, styles
│
├── admin/                 # Admin-side dashboard
│   ├── orders.php         # View/manage orders
│   ├── receipt-download.php  # Download receipt PDF
│   └── confirm-order.php  # Order confirmation handler
│
├── includes/              # Reusable PHP scripts (DB, sessions)
├── vendor/                # Composer-managed packages
├── composer.json          # Composer configuration
├── database.sql           # Database schema and sample data
└── README.md              # Project readme
```

---

## 🚀 Getting Started

### 1. Clone the Repository
```bash
git clone https://github.com/your-username/sweet_indulgence.git
cd sweet_indulgence
```

### 2. Install Dependencies
```bash
composer install
```

### 3. Set Up the Database
- Import `database.sql` using phpMyAdmin or MySQL CLI

### 4. Configure Database Connection
Edit your connection file (e.g., `includes/db.php`):
```php
$host = "localhost";
$user = "root";
$pass = "";
$dbname = "sweet_indulgence";
```

### 5. Run the App
- Place the project in your web server directory (e.g., `htdocs` in XAMPP)
- Access it in your browser:
  ```
  http://localhost/sweet_indulgence/customer/
  http://localhost/sweet_indulgence/admin/
  ```

---

## 📥 Contribution

Contributions are welcome! Feel free to fork, open issues, or submit pull requests.

---

## 📄 License

This project is open-source. Use and modify it freely to fit your bakery or dessert business needs.
