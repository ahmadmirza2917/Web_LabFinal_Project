<h1> Check Branch "master" for complete Project Files & Folders </h1>
<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>
<div align="center">

# 🏥 Laravel Smart Health System

![Laravel](https://img.shields.io/badge/Laravel-12.x-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)
![PHP](https://img.shields.io/badge/PHP-8.2-777BB4?style=for-the-badge&logo=php&logoColor=white)
![SQLite](https://img.shields.io/badge/SQLite-Database-003B57?style=for-the-badge&logo=sqlite&logoColor=white)
![Bootstrap](https://img.shields.io/badge/Bootstrap-5.x-7952B3?style=for-the-badge&logo=bootstrap&logoColor=white)
![Grok AI](https://img.shields.io/badge/Grok_AI-xAI-000000?style=for-the-badge&logo=x&logoColor=white)
![License](https://img.shields.io/badge/License-Educational-28a745?style=for-the-badge)

**CSC336 — Web Technologies &nbsp;|&nbsp; Semester Project**
**COMSATS University Islamabad, Vehari Campus**

</div>

---

## 📋 Table of Contents

- [Project Overview](#-project-overview)
- [Project Objectives](#-project-objectives)
- [Features](#-features)
- [Technologies Used](#️-technologies-used)
- [System Architecture](#️-system-architecture)
- [Installation Guide](#️-installation-guide)
- [Database Schema](#️-database-schema)
- [Application Routes](#-application-routes)
- [Authentication System](#-authentication-system)
- [AI Health Assistant](#-ai-health-assistant)
- [Core Functionalities](#-core-functionalities)
- [Validation Rules](#-validation-rules)
- [Laravel Concepts Used](#-laravel-concepts-used)
- [Learning Outcomes](#-learning-outcomes)
- [Future Enhancements](#-future-enhancements)
- [Author](#-author-information)

---

## 📌 Project Overview

The **Laravel Smart Health System (SHS)** is a complete web-based healthcare management application built with the **Laravel PHP Framework** following **MVC architecture**.

> 🆕 **Key Highlight:** Custom role-based authentication for Admin, Doctor & Patient + Grok AI-powered health assistant with 4 features.

**Core capabilities:**

- 🔐 Register & securely log in with **role-based access control**
- 👨‍⚕️ Doctors manage appointments and write/edit prescriptions
- 📅 Patients book appointments and view prescription history
- 🤖 AI-powered health tools: Symptom Checker, Chatbot, Health Risk, Prescription Explainer
- 👑 Admin manages doctors and approves/rejects appointments

---

## 📸 Screenshots

### 🏠 Login Page
<img width="1896" height="923" alt="Image" src="https://github.com/user-attachments/assets/1dbe4483-fe97-4f54-b45e-e864681fd559" />

---
### 👑 Admin Dashboard
<img width="1918" height="915" alt="Image" src="https://github.com/user-attachments/assets/cae38a22-1b8e-48ca-8ac1-553efde5301c" />

---
### 👑 Admin — Manage Doctors
<img width="1920" height="918" alt="Image" src="https://github.com/user-attachments/assets/40a33766-a9ef-407b-b4f9-275feb423e7b" />

---
### 👑 Admin — Appointments (Approve / Reject)
<img width="1920" height="912" alt="Image" src="https://github.com/user-attachments/assets/ca1ebb1e-f5eb-4926-a690-8d66c65c6636" />

---
### 👨‍⚕️ Doctor Dashboard
<img width="1920" height="918" alt="Image" src="https://github.com/user-attachments/assets/3c3f17ad-4125-4615-8830-0f89b6afa3d0" />

---
### 👨‍⚕️ Doctor — Write Prescription
<img width="1920" height="917" alt="Image" src="https://github.com/user-attachments/assets/1dc80a6e-3e32-48fa-b061-12698d4686d4" />

---
### 👨‍⚕️ Doctor — Edit Prescription
<img width="1920" height="915" alt="Image" src="https://github.com/user-attachments/assets/eff6956f-29bd-4fe1-8e77-66d2fe592fa9" />

---
### 👨‍⚕️ Doctor — Edit Profile
<img width="1917" height="917" alt="Image" src="https://github.com/user-attachments/assets/7b0542d8-d226-4661-b0dc-4a316035174c" />

---
### 🧑‍💼 Patient Register
<img width="1902" height="916" alt="Image" src="https://github.com/user-attachments/assets/9bf74d1a-ac04-412d-8176-1d7f41637c5a" />

---
### 🧑‍💼 Patient Dashboard
<img width="1900" height="922" alt="Image" src="https://github.com/user-attachments/assets/f0eea3ca-ee01-4dac-bd03-9190c2126c6c" />

---
### 🧑‍💼 Patient — Book Appointment
<img width="1920" height="922" alt="Image" src="https://github.com/user-attachments/assets/f91df895-6788-46e0-a3e6-c0e3a60757d4" />

---
### 🧑‍💼 Patient — View Prescriptions
<img width="1297" height="912" alt="Image" src="https://github.com/user-attachments/assets/09e530a9-b8d1-42ff-b3c4-3cb006a08df6" />

---
### 🧑‍💼 Patient — Edit Appointment
<img width="1920" height="920" alt="Image" src="https://github.com/user-attachments/assets/13f92257-b68b-4650-9c7f-2e41402e94f5" />

---
### 🤖 AI Symptom Checker
<img width="1920" height="917" alt="Image" src="https://github.com/user-attachments/assets/467c8ecd-4e60-4e92-b066-d7a96624f063" />

---
### 🤖 Update Profile
<img width="1907" height="958" alt="Image" src="https://github.com/user-attachments/assets/30362e0e-e5b2-4069-adfb-7de2974abdc8" />

---

## 🎯 Project Objectives

| ID | Objective |
|----|-----------|
| PO-1 | Design a multi-role web application with separate portals for Admin, Doctor, and Patient |
| PO-2 | Enable doctors to manage appointments, write and edit prescriptions |
| PO-3 | Enable patients to book appointments, view prescriptions, and use AI health tools |
| PO-4 | Provide Admin portal for doctor account management and appointment approval |
| PO-5 | Follow clean MVC conventions with RESTful routing and Eloquent ORM |
| PO-6 | Integrate Grok AI API for real-time health assistance features |

---

## ✨ Features

| Feature | Description |
|---------|-------------|
| 🔐 Role-Based Auth | Custom middleware for Admin, Doctor, Patient roles |
| 👑 Doctor Management | Admin can create, edit, delete doctor accounts |
| 📅 Appointment Booking | Patients book appointments with available doctors |
| ✅ Appointment Approval | Admin approves or rejects pending appointments |
| 💊 Prescription Create | Doctors write prescriptions for completed appointments |
| ✏️ Prescription Edit | Doctors edit their own prescriptions with ownership check |
| 👁️ Prescription View | Patients view full prescription details |
| 🤖 Symptom Checker | AI analyzes symptoms and suggests possible conditions |
| 💬 Health Chatbot | AI answers general health questions in real time |
| 📊 Health Risk Assessor | AI evaluates risk based on age, weight, BP, blood sugar |
| 💡 Prescription Explainer | AI explains prescription in simple patient-friendly language |
| 📝 AI Interaction Log | All AI queries saved in database for history |
| 📱 Responsive UI | Mobile-friendly Bootstrap 5 layout |
| 🔔 Flash Messages | Success and error notifications throughout |

---

## 🛠️ Technologies Used

| Technology | Version | Purpose |
|------------|---------|---------|
| Laravel | 12.x | PHP Web Framework — MVC, routing, ORM, middleware |
| PHP | 8.2 | Backend Programming Language |
| SQLite | Built-in | Lightweight Database |
| Bootstrap | 5.x | Frontend Responsive UI |
| Font Awesome | 6.x | Icons throughout all portals |
| Grok API (xAI) | v1 | AI engine for health assistant features |
| Blade | Built-in | Laravel Templating Engine |
| Composer | Latest | PHP Dependency Manager |
| Git & GitHub | Latest | Version Control |

---

## 🏗️ System Architecture

The project strictly follows **MVC (Model–View–Controller)** architecture:

| Component | Responsibility |
|-----------|----------------|
| Models | Database tables and Eloquent relationships |
| Views | Blade templates organized by role (admin / doctor / patient) |
| Controllers | Business logic per role and feature |
| Routes | RESTful URL definitions grouped by role in `web.php` |
| Middleware | RoleMiddleware enforces access control on every route group |
| Database | SQLite with 6 relational tables |

---

## ⚙️ Installation Guide

> **Prerequisites:** PHP 8.2, Composer, Git


### Step 1 — Install PHP Dependencies

```bash
composer install
```

### Step 2 — Environment Setup

```bash
cp .env.example .env
```

Update your `.env` file:

```env
DB_CONNECTION=sqlite
GROK_API_KEY=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
```

### Step 3 — Generate App Key & Run Migrations

```bash
php artisan key:generate
php artisan migrate
```

### Step 4 — Seed the Database (creates Admin account)

```bash
php artisan db:seed
```

### Step 5 — Start Development Server

```bash
php artisan serve
```

Visit 👉 **http://127.0.0.1:8000**

> **Default Admin Login:**
> Email: `admin@portal.com` | Password: `admin123`

---

## 🗄️ Database Schema

| Table | Description |
|-------|-------------|
| `users` | All users with role: `admin`, `doctor`, `patient` |
| `doctors` | Doctor profile: specialization, fee, availability |
| `patients` | Patient profile: DOB, blood group, vitals |
| `appointments` | Bookings with status: pending / approved / rejected / completed |
| `prescriptions` | Diagnosis, medicines, instructions per appointment |
| `ai_interactions` | Log of all AI queries and responses per user |

---

## 🌐 Application Routes

### Public Routes
| Method | URI | Purpose |
|--------|-----|---------|
| GET/POST | `/login` | Login form and processing |
| GET/POST | `/register` | Registration form and processing |
| POST | `/logout` | Logout and session termination |

### Admin Routes (`/admin/*`)
| Method | URI | Purpose |
|--------|-----|---------|
| GET | `/admin/dashboard` | Statistics dashboard |
| Resource | `/admin/doctors` | Full CRUD for doctor management |
| GET | `/admin/appointments` | View all appointments |
| POST | `/admin/appointments/{id}/approve` | Approve appointment |
| POST | `/admin/appointments/{id}/reject` | Reject appointment |
| GET | `/admin/patients` | View all patients |
| DELETE | `/admin/patients/{id}` | Delete patient account |

### Doctor Routes (`/doctor/*`)
| Method | URI | Purpose |
|--------|-----|---------|
| GET | `/doctor/dashboard` | Appointment overview |
| GET | `/doctor/appointments` | All doctor appointments |
| GET | `/doctor/prescriptions` | All prescriptions written |
| GET | `/doctor/prescriptions/create/{appointment}` | New prescription form |
| POST | `/doctor/prescriptions` | Save prescription |
| GET | `/doctor/prescriptions/{id}` | View prescription |
| GET | `/doctor/prescriptions/{id}/edit` | Edit prescription form |
| PUT | `/doctor/prescriptions/{id}` | Update prescription |

### Patient Routes (`/patient/*`)
| Method | URI | Purpose |
|--------|-----|---------|
| GET | `/patient/dashboard` | Patient dashboard |
| GET | `/patient/appointments/book` | Book appointment form |
| POST | `/patient/appointments` | Submit booking |
| DELETE | `/patient/appointments/{id}` | Cancel appointment |
| GET | `/patient/prescriptions` | View prescriptions list |
| GET | `/patient/prescriptions/{id}` | View prescription detail |
| GET/POST | `/patient/ai/symptom-checker` | AI symptom checker |
| GET/POST | `/patient/ai/chatbot` | AI health chatbot |
| GET/POST | `/patient/ai/health-risk` | AI health risk assessor |
| POST | `/patient/ai/explain-prescription/{id}` | AI prescription explainer |

---

## 🔐 Authentication System

Custom authentication built without third-party starter kits for full control.

| Feature | Description |
|---------|-------------|
| Registration | Patients self-register with name, email, password |
| Secure Login | Email + password with session regeneration |
| Role Redirect | Admin → `/admin/dashboard`, Doctor → `/doctor/dashboard`, Patient → `/patient/dashboard` |
| Logout | Full session termination |
| RoleMiddleware | Every route group protected by custom `role:admin/doctor/patient` middleware |
| Ownership Check | Doctors can only edit their own prescriptions (403 on violation) |

---

## 🤖 AI Health Assistant

Powered by **Grok API (xAI)** — 4 features available to all patients.

| Feature | How It Works |
|---------|-------------|
| 🩺 Symptom Checker | Patient describes symptoms → AI returns possible conditions, recommended specialist, advice, warning signs |
| 💬 Health Chatbot | Patient asks any health question → AI responds in real time via JSON |
| 📊 Health Risk Assessor | Patient enters age, weight, BP, blood sugar → AI returns risk level (Low/Medium/High) + recommendations |
| 💊 Prescription Explainer | Patient requests explanation of their prescription → AI explains in simple language |

All interactions are saved in the `ai_interactions` table for history.

**Setup:**
```env
GROK_API_KEY=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
```

API key at 👉 [console.x.ai](https://console.x.ai)

---

## 🧠 Core Functionalities

### Prescription Lifecycle

| Step | Actor | Action |
|------|-------|--------|
| 1 | Patient | Books appointment |
| 2 | Admin | Approves appointment |
| 3 | Doctor | Marks appointment completed + writes prescription |
| 4 | Doctor | Can edit prescription anytime (ownership verified) |
| 5 | Patient | Views prescription + can request AI explanation |

### Appointment Status Flow

| Status | Set By | Meaning |
|--------|--------|---------|
| `pending` | System | Newly booked by patient |
| `approved` | Admin | Admin approved the booking |
| `rejected` | Admin | Admin rejected the booking |
| `completed` | Doctor | Doctor wrote prescription |

---

## 🔐 Validation Rules

| Field | Rule |
|-------|------|
| `email` | Required, valid format, unique |
| `password` | Required, min 8 characters |
| `appointment_date` | Required, date, after or equal to today |
| `appointment_time` | Required |
| `diagnosis` | Required, string |
| `medicines` | Required, string |
| `symptoms` | Optional, max 500 characters |
| `age` | Integer, min 1, max 120 |
| `weight` | Numeric, min 10, max 300 |

---

## 🚀 Laravel Concepts Used

| Concept | How It's Used |
|---------|--------------|
| Routing | RESTful URL definitions grouped by role in `web.php` |
| Controllers | Separate controllers per role and feature |
| Models | Eloquent ORM with `hasMany`, `belongsTo`, `hasOne` |
| Blade Templates | Dynamic views organized in `admin/`, `doctor/`, `patient/` folders |
| Eloquent ORM | Fluent database query builder with eager loading |
| Relationships | User→Doctor, User→Patient, Doctor→Appointments, Patient→Prescriptions |
| Validation | Server-side request validation in all store/update methods |
| Middleware | Custom `RoleMiddleware` protects all role-specific routes |
| Migrations | Database schema versioning with foreign key constraints |
| Http Facade | Laravel `Http::post()` for Grok AI API calls |
| Session Flash | Success/error messages via `with()` |

---

## 📚 Learning Outcomes

- ✅ Laravel MVC Framework Development
- ✅ CRUD Operations with Eloquent ORM
- ✅ RESTful Routing & Resource Controllers
- ✅ Database Migrations & Relationships (Foreign Keys + Cascade Delete)
- ✅ Blade Templating with Shared Layouts
- ✅ Custom Role-Based Authentication & Authorization
- ✅ Middleware Implementation
- ✅ Third-Party API Integration (Grok AI)
- ✅ Bootstrap 5 Responsive UI Design
- ✅ Server-side Form Validation
- ✅ Git & GitHub Version Control

---

## 🔮 Future Enhancements

| Feature | Description |
|---------|-------------|
| 📧 Email Notifications | Notify patient when appointment is approved/rejected |
| 📊 Analytics Dashboard | Patient health trends and appointment history charts |
| 🎥 Video Consultation | Online doctor-patient video call integration |
| 💊 Medicine Reminders | Push notifications for medicine schedules |
| 📄 PDF Prescriptions | Download prescription as formatted PDF |
| ☁️ Cloud Deployment | Deploy to Railway, Forge, or DigitalOcean |
| 📱 Mobile App | Flutter companion app for patients |
| 🔍 Doctor Search | Search and filter doctors by specialization |

---

## 👨‍💻 Author Information

| Field | Details |
|-------|---------|
| **Name** | Ahmad Mirza |
| **Student ID** | CIIT/SP24-BSE-002/VHR |
| **Program** | BS Software Engineering |
| **University** | COMSATS University Islamabad |
| **Campus** | Vehari Campus |

## 👩‍🏫 Instructor

| Field | Details |
|-------|---------|
| **Name** | Ma'am Yasmeen Jana |
| **Course** | CSC336 — Web Technologies |
| **Semester** | Spring 2026 |

---

## 🔗 Repository

```bash
git clone https://github.com/ahmadmirza2917/Web_LabFinal_Project.git
```

---

<div align="center">

*This project is developed for **educational purposes only**.*

⭐ If you found this helpful, consider starring the repository!

</div>
