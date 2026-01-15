# Visitor Management System (VMS)

## 📌 প্রজেক্ট পরিচিতি
এই প্রজেক্টটি একটি **Enterprise Visitor Management System**। এখানে অফিস/ব্যাংক/কর্পোরেট বিল্ডিং-এ আগত সকল ভিজিটরকে ডিজিটালভাবে ম্যানেজ করা হবে।

আমরা ব্যবহার করবো:
- **Laravel 11** (Backend)
- **AJAX / Axios / Fetch** (Frontend API Call)
- **Bootstrap** (UI)
- **MySQL / PostgreSQL** (Database)
- **Redis** (Cache + Queue)
- **Docker + Docker Swarm** (Deployment)
- **Nginx** (Web Server)
- **Prometheus + Grafana** (Monitoring)
- **Loki** (Log Management)

---

## 🎯 প্রজেক্টের লক্ষ্য
- ভিজিটর রেজিস্ট্রেশন সহজ করা
- সিকিউরিটি বাড়ানো
- Manual কাজ কমানো
- Real-time Monitoring

---

## 👥 User Role (Actor) সমূহ

### 1️⃣ Reception User
**কাজ:**
- Walk-in visitor রেজিস্ট্রেশন
- Check-in / Check-out
- Badge Assign

**Example:**
> একজন ভিজিটর অফিসে এলে Reception তার তথ্য সিস্টেমে ঢুকাবে

---

### 2️⃣ Host User (Employee)
**কাজ:**
- Visitor Pre-registration
- Visitor Approve / Reject

**Example:**
> আপনি যদি কাউকে দাওয়াত দেন, আগে থেকেই তার তথ্য এন্ট্রি করবেন

---

### 3️⃣ Security User
**কাজ:**
- Blacklist ম্যানেজ
- Live Visitor Monitoring
- Overstay Alert

---

### 4️⃣ Admin User
**কাজ:**
- User Management
- System Settings
- Master Data (Department, Floor)

---

### 5️⃣ Management User
**কাজ:**
- Report দেখা
- Analytics

---

## 🔁 Visitor Flow (Step by Step)

1. Visitor Pre-register অথবা Walk-in
2. Host Approval
3. Check-in
4. Badge Assign
5. Visit Monitoring
6. Check-out

---

## 🧩 Module Breakdown

### Module 1: Visitor Registration
- Name, Phone, NID
- Photo Upload
- Visit Purpose

---

### Module 2: Approval System
- Email/SMS Approval
- One Click Approve

---

### Module 3: Check-in / Check-out
- QR / Badge Scan
- Auto Time Capture

---

### Module 4: Security & Blacklist
- Blacklist Visitor
- Alert System

---

### Module 5: Report & Analytics
- Daily Report
- PDF / Excel Export

---

## 🏗️ Database Design (Simple)

### users
- id
- name
- role

### visitors
- id
- name
- phone
- photo

### visits
- visitor_id
- host_id
- check_in
- check_out

---

## ⚙️ Laravel Architecture

- Controller → Request Handle
- Service → Business Logic
- Repository → Database Query

---

## 🌐 Frontend (Bootstrap + AJAX)

- Form Submit via AJAX
- No Page Reload
- Fetch API ব্যবহার

---

## 🐳 Docker Setup (Simple)

- app (Laravel)
- nginx
- mysql
- redis

---

## 🚀 Docker Swarm

- Multiple Server Support
- Load Balancing

---

## 📊 Monitoring

### Prometheus
- CPU, Memory Track

### Grafana
- Visual Dashboard

### Loki
- Log Collect

---

## 🔐 Security
- CSRF Protection
- Role Permission
- Audit Log

---

## 🧪 Testing
- Feature Test
- API Test

---

## 📦 Deployment Flow

1. Code Push
2. Docker Build
3. Swarm Deploy
4. Monitoring Check

---

## ✅ Final Outcome
- Scalable System
- Secure
- Easy to Maintain

---

## 🎉 শেষ কথা
এই গাইড ফলো করলে আপনি **beginner হয়েও একটি enterprise-level project** তৈরি করতে পারবেন।

👉 চাইলে আমি পরবর্তী ধাপে:
- Database ER Diagram
- Laravel Folder Structure
- API Example

ধাপে ধাপে করে দেবো 😊

