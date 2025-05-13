# 🍰 Sweet Indulgence Web Application

**Sweet Indulgence** is a kiosk-style web application for ordering desserts, built using **PHP**, **JavaScript**, **HTML/CSS**, **Bootstrap**, and **Composer**.  
Customers can place orders and receive a recipe/receipt. Admins can track, manage, and download order records through an administrative dashboard.

---

## 🧾 Key Features

### 🧍 Customer Side
- Browse products and add to cart
- Place and update orders
- View and download receipt
- Contact support via contact form

### 🛠️ Admin Side
- Add, delete, or update products
- View, confirm, or complete orders
- Delete messages and download order records
- Admin login dashboard

---

## 🧰 Tech Stack

- **PHP** – Server-side logic
- **Composer** – Dependency management
- **JavaScript** – Client-side interactivity
- **Bootstrap** – Responsive UI
- **HTML/CSS** – Markup and styling
- **MySQL** – Data storage

---

## 🗂️ Folder Structure

```
SWEET_INDULGENCE/
│
├── Admin/                      # Admin dashboard and functionality
│   ├── add.php
│   ├── admin.php
│   ├── change.php
│   ├── complete_order.php
│   ├── delete_message.php
│   ├── delete_order.php
│   ├── delete.php
│   ├── deletetall.php
│   ├── download_records.php
│   ├── message.php
│   ├── order.php
│   └── records.php
│
├── User/                       # User/customer-related functionality
│   ├── cart.php
│   ├── change-order.php
│   ├── checkout.php
│   ├── contactUs.php
│   ├── process_order.php
│   └── products.php
│
├── buynow/
│   └── product.php             # Buy-now style product order page
│
├── logo/                       # Logo image files
│
├── products/                   # Product image uploads
│
├── style/                      # CSS stylesheets
│
├── upload-img/                 # Image upload handler/scripts
│
├── vendor/                     # Composer dependencies
│
├── admin.php                   # Admin login page
├── composer.json               # Composer configuration
├── composer.lock
├── index.php                   # Landing page
├── login.sql                   # SQL schema for login
├── logout.php
├── oop.php                     # Object-oriented PHP code (helper/functions)
├── pdf.php                     # PDF generation for receipts
├── register.php                # User registration page
└── update.php                  # Order or profile update handler
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
- Import `login.sql` into your MySQL database using phpMyAdmin or CLI

### 4. Configure the Database Connection
Edit your database connection file (e.g., `oop.php` or any included config file):
```php
$host = "localhost";
$user = "root";
$pass = "";
$dbname = "sweet_indulgence";
```

### 5. Run the Application
- Place the project in your server directory (e.g., `htdocs` for XAMPP)
- Access via browser:
  ```
  http://localhost/sweet_indulgence/
  ```

---

## 📥 Contribution

Contributions are welcome! Fork the repo, make changes, and submit pull requests.

---

## 📄 License

This project is open-source and freely available for modification and personal/commercial use.
