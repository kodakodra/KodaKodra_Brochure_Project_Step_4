# KodaKodra — Step 4: SQL, User Auth & Dashboard

## What This Is
The PHP brochure from Step 3 extended with a MySQL database and full user authentication — register, login, logout, sessions, and a personal dashboard.

## What This Demonstrates
- MySQL database setup via migration.sql
- PDO database connection with prepared statements
- User registration with server-side validation and bcrypt password hashing
- User login with session management and session fixation prevention
- Secure logout — session fully destroyed including cookie
- Auth guard (auth.php) protecting pages that require login
- Session-aware navbar — shows different links based on login state
- Role-aware sessions — user role stored and accessible throughout

## File Structure
```
/
├── includes/
│   ├── config.php          — Site constants, DB and mail settings
│   ├── db.php              — PDO database connection
│   ├── auth.php            — Login guard, include on protected pages
│   ├── header.php          — Reusable header, session-aware navbar
│   └── footer.php          — Reusable footer and script tags
├── vendor/                 — PHPMailer installed via Composer
├── migration.sql           — Run once to create the database and users table
├── index.php               — Home page
├── about.php               — About page
├── services.php            — Services page
├── contact.php             — Contact page with form
├── contact-handler.php     — Form processing and PHPMailer
├── register.php            — Registration form and handler
├── login.php               — Login form and handler
├── logout.php              — Destroys session and redirects
├── dashboard.php           — Logged in user's personal page
├── style.css               — All custom styles
└── script.js               — Form validation and fetch submission
```

## Setup
1. Run `migration.sql` against your MySQL database
2. Update `includes/config.php` with your database credentials
3. Register an account via register.php
4. To promote a user to admin, update the role column directly in the database:
   `UPDATE users SET role = 'admin' WHERE email = 'your@email.com';`

## Tech Used
- HTML5
- CSS3 (style.css)
- JavaScript (script.js)
- Bootstrap 5
- Font Awesome 6
- PHP
- PHPMailer
- MySQL
- PDO

## Notes
- Passwords are hashed with PASSWORD_BCRYPT — never stored plain
- Login errors are deliberately vague to avoid confirming whether an email exists
- Dashboard placeholders for submissions and tickets — both added in Step 5 and 6
- All subsequent steps build on this same base without retrofitting
