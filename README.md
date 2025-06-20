# 💪 FitFusion – Gym Management Web Application

FitFusion is a web-based gym management platform that allows trainers and members to connect and manage fitness routines, nutrition plans, sessions, and billing — all in one place.

---

## 📸 Demo Screenshots

> _Insert screenshots here after pushing images or linking from `/screenshots/` folder_

- Home Page  
- Member Dashboard  
- Trainer Dashboard  
- Registration / Login  
- Diet Plan / Session View

---

## ⚙️ Features

### 👤 Member Functionality
- Sign up with name, email, password, age, and weight
- View assigned diet plans and session schedules
- Submit feedback to trainers

### 🧑‍🏫 Trainer Functionality
- Secure login
- View assigned members with their age/weight
- Assign nutrition plans, workouts, and session times
- Claim unassigned members

### 🧰 Admin/General
- PHP-based routing and authentication
- Secure password hashing (via `password_hash`)
- Session-based login/logout for roles

---

## 🛠️ Tech Stack

| Technology   | Purpose                     |
|--------------|-----------------------------|
| PHP          | Backend scripting           |
| MySQL        | Database                    |
| HTML/CSS     | Frontend UI                 |
| JavaScript   | UI Interactions             |
| XAMPP        | Local development environment |
| phpMyAdmin   | MySQL database management   |

---

## 🗄️ Database Structure

### Tables:
- `member(member_id, name, email, password, age, weight, trainer_id)`
- `trainer(trainer_id, name, email, password)`
- `nutrition_plan(plan_id, member_id, plan_details)`
- `workout_plan(plan_id, member_id, plan_details)`
- `sessions(session_id, member_id, session_time)`
- `feedback(feedback_id, member_id, message, date_submitted)`
- `payment(payment_id, member_id, amount, date)`

> _SQL schema available in `/database/fitfusion.sql`_

---

## 🧭 Project Setup (Run Locally)

1. **Install XAMPP** and start Apache + MySQL
2. Clone this repository:
   ```bash
   git clone https://github.com/your-username/fitfusion.git
Copy project folder to C:/xampp/htdocs/fitfusion

Open phpMyAdmin → Import fitfusion.sql into a new DB called fitfusion

Start server and visit:
http://localhost/fitfusion/
👥 Team Members
Name	Role
Umair Masood	Frontend, UI, PHP Integration
Asma	Database schema and tables
Palwasha	Data structure and security

📝 License
This project is built for academic purposes.
You are free to use, modify, and learn from it.

📬 Feedback & Contributions
Feel free to submit issues or PRs to improve the project.
Feedback welcome at: umairmasood687@gmail.com
