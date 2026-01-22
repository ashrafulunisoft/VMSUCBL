# UCB Visitor Management System - Bootstrap 5 Page Design Documentation

**Version:** 1.0  
**Date:** January 19, 2026  
**Project:** UCB Visitor Management System  
**Technology:** Bootstrap 5 + Laravel 11

---

## Table of Contents

1. [System Overview](#system-overview)
2. [User Roles & Permissions](#user-roles--permissions)
3. [Page Access Matrix](#page-access-matrix)
4. [Detailed Page Specifications](#detailed-page-specifications)
   - [Authentication Pages](#authentication-pages)
   - [Common Pages](#common-pages)
   - [Reception Panel](#reception-panel)
   - [Security Panel](#security-panel)
   - [Host Panel](#host-panel)
   - [Admin Panel](#admin-panel)
   - [Management Panel](#management-panel)
   - [System Pages](#system-pages)

---

## System Overview

### Total Pages: 53

The UCB Visitor Management System requires **53 unique pages** organized into **7 major categories**:

| Category | Pages | Purpose |
|----------|-------|---------|
| Authentication | 4 | Login, password recovery, verification |
| Common | 2 | Dashboard, profile/settings |
| Reception Panel | 10 | Visitor registration, check-in/out, badge management |
| Security Panel | 9 | Monitoring, alerts, blacklist management |
| Host Panel | 8 | Pre-registration, approvals, notifications |
| Admin Panel | 12 | System configuration, user management |
| Management Panel | 6 | Reports, analytics, performance monitoring |
| System Pages | 2 | Error pages, maintenance |

### Key System Features

- **6 Core Modules**: Registration, Approval Workflow, Badge Management, Check-in/Check-out, Security & Monitoring, Reporting & Analytics
- **5 User Roles**: Reception, Security, Host, Admin, Management
- **End-to-End Automation**: Pre-registration → Approval → Check-in → Monitoring → Check-out
- **Real-Time Monitoring**: Live dashboards, instant alerts, overstay detection
- **Enterprise Integrations**: LDAP, Email, SMS, RFID access control

---

## User Roles & Permissions

### 1. Reception (5 Users)
- **Primary Responsibilities**: Visitor registration, check-in/out, badge management
- **Access Level**: Operational - Front desk operations
- **Key Actions**: Register visitors, issue badges, process check-in/check-out

### 2. Security (4 Users)
- **Primary Responsibilities**: Dashboard monitoring, blacklist management, alert resolution
- **Access Level**: Monitoring - Security oversight
- **Key Actions**: Monitor visitors, manage blacklists, resolve alerts, view evacuation lists

### 3. Host (Unlimited Users)
- **Primary Responsibilities**: Pre-registration, visit approvals, guest notifications
- **Access Level**: Requester - Visit request management
- **Key Actions**: Pre-register visitors, approve/reject visits, receive notifications

### 4. Admin (2 Users)
- **Primary Responsibilities**: System configuration, user management, master data setup
- **Access Level**: System Administration - Full control
- **Key Actions**: Manage users, configure system, set up master data, view audit logs

### 5. Management (5 Users)
- **Primary Responsibilities**: Reports, analytics, performance monitoring
- **Access Level**: Executive - Strategic oversight
- **Key Actions**: View reports, analyze data, monitor system performance

---

## Page Access Matrix

| Page | Reception | Security | Host | Admin | Management |
|------|-----------|----------|------|-------|------------|
| **Authentication Pages** |
| Login | ✅ | ✅ | ✅ | ✅ | ✅ |
| Forgot Password | ✅ | ✅ | ✅ | ✅ | ✅ |
| Reset Password | ✅ | ✅ | ✅ | ✅ | ✅ |
| Email Verification | ✅ | ✅ | ✅ | ✅ | ✅ |
| **Common Pages** |
| Dashboard | ✅ | ✅ | ✅ | ✅ | ✅ |
| Profile & Settings | ✅ | ✅ | ✅ | ✅ | ✅ |
| **Reception Panel** |
| Reception Dashboard | ✅ | ❌ | ❌ | ✅ | ✅ |
| Walk-in Registration | ✅ | ❌ | ❌ | ❌ | ❌ |
| Pre-registered Visitor Check-in | ✅ | ❌ | ❌ | ❌ | ❌ |
| Visitor Check-out | ✅ | ❌ | ❌ | ❌ | ❌ |
| Badge Issuance | ✅ | ❌ | ❌ | ✅ | ❌ |
| Badge Return | ✅ | ❌ | ❌ | ✅ | ❌ |
| Today's Visitors List | ✅ | ✅ | ❌ | ✅ | ✅ |
| Visitor Search | ✅ | ✅ | ✅ | ✅ | ✅ |
| Visitor History | ✅ | ✅ | ✅ | ✅ | ✅ |
| Pending Approvals View | ✅ | ❌ | ✅ | ✅ | ✅ |
| **Security Panel** |
| Security Dashboard | ✅ | ✅ | ❌ | ✅ | ✅ |
| Live Visitor Monitoring | ✅ | ✅ | ❌ | ✅ | ✅ |
| Blacklist Management | ✅ | ✅ | ❌ | ✅ | ❌ |
| Watchlist Management | ✅ | ✅ | ❌ | ✅ | ❌ |
| Real-time Alerts | ✅ | ✅ | ❌ | ✅ | ✅ |
| Evacuation List | ✅ | ✅ | ❌ | ✅ | ✅ |
| Floor-wise Occupancy | ✅ | ✅ | ❌ | ✅ | ✅ |
| Alert Resolution | ✅ | ✅ | ❌ | ✅ | ✅ |
| Visitor Movement History | ✅ | ✅ | ❌ | ✅ | ✅ |
| **Host Panel** |
| Host Dashboard | ✅ | ✅ | ✅ | ✅ | ✅ |
| Visitor Pre-registration | ✅ | ❌ | ✅ | ✅ | ❌ |
| My Visitors List | ✅ | ❌ | ✅ | ✅ | ✅ |
| Pending Approvals | ✅ | ❌ | ✅ | ✅ | ✅ |
| Approval Actions | ✅ | ❌ | ✅ | ✅ | ✅ |
| Visitor Notifications | ✅ | ❌ | ✅ | ✅ | ❌ |
| Visit History | ✅ | ❌ | ✅ | ✅ | ✅ |
| Schedule Visits | ✅ | ❌ | ✅ | ✅ | ❌ |
| **Admin Panel** |
| Admin Dashboard | ✅ | ✅ | ❌ | ✅ | ✅ |
| User Management | ❌ | ❌ | ❌ | ✅ | ❌ |
| Role & Permissions | ❌ | ❌ | ❌ | ✅ | ❌ |
| Department Management | ❌ | ❌ | ❌ | ✅ | ❌ |
| Employee Directory (LDAP Sync) | ✅ | ✅ | ✅ | ✅ | ✅ |
| Visitor Categories Setup | ❌ | ❌ | ❌ | ✅ | ❌ |
| Badge Management (Admin) | ✅ | ❌ | ❌ | ✅ | ❌ |
| System Settings | ❌ | ❌ | ❌ | ✅ | ❌ |
| Email/SMS Configuration | ❌ | ❌ | ❌ | ✅ | ❌ |
| Access Control Integration | ❌ | ❌ | ❌ | ✅ | ❌ |
| Audit Logs | ✅ | ✅ | ❌ | ✅ | ✅ |
| System Backup & Recovery | ❌ | ❌ | ❌ | ✅ | ❌ |
| **Management Panel** |
| Management Dashboard | ❌ | ❌ | ❌ | ✅ | ✅ |
| Visitor Summary Reports | ❌ | ❌ | ❌ | ✅ | ✅ |
| Daily/Monthly Reports | ❌ | ❌ | ❌ | ✅ | ✅ |
| Department Analytics | ❌ | ❌ | ❌ | ✅ | ✅ |
| Custom Report Builder | ❌ | ❌ | ❌ | ✅ | ✅ |
| Export Data (Excel/PDF) | ❌ | ❌ | ❌ | ✅ | ✅ |
| **System Pages** |
| 404 Error Page | ✅ | ✅ | ✅ | ✅ | ✅ |
| Maintenance Page | ✅ | ✅ | ✅ | ✅ | ✅ |

---

## Detailed Page Specifications

---

### Authentication Pages

#### 1. Login Page
**Purpose**: Secure entry point for all users into the system  
**Access**: All users (5 roles)  
**Bootstrap 5 Components**:
- Container/Container-fluid
- Card
- Form (floating labels)
- Input groups
- Buttons (primary, link)
- Alerts
- Navbar

**Main Sections**:
1. **Header Section**
   - Company logo (UCB)
   - System title: "Visitor Management System"
   - Version number

2. **Login Form Card**
   - Username/Email input (floating label)
   - Password input (floating label with show/hide toggle)
   - "Remember Me" checkbox
   - "Forgot Password?" link
   - Login button (full width, primary)
   - Help text with contact info

3. **Footer Section**
   - Copyright information
   - System status indicator
   - Last login timestamp (if cached)

4. **Error/Success Alerts**
   - Invalid credentials alert
   - Account locked alert
   - Maintenance alert

**Key Features**:
- LDAP/Active Directory integration
- Session management
- Remember me functionality
- Account lockout after failed attempts
- Last login display

---

#### 2. Forgot Password Page
**Purpose**: Allow users to initiate password recovery process  
**Access**: All users (5 roles)  
**Bootstrap 5 Components**:
- Container
- Card
- Form (floating labels)
- Input groups
- Buttons
- Alerts
- Modal (optional)

**Main Sections**:
1. **Header Section**
   - Back to Login link
   - Page title: "Forgot Password"

2. **Email Input Form**
   - Email address input (floating label)
   - "Send Reset Link" button
   - Cancel/Back button

3. **Instructions Section**
   - Step-by-step instructions
   - Expected email delivery time
   - Spam folder reminder

4. **Success Message**
   - "Reset link sent to your email"
   - Link to resend if not received

**Key Features**:
- Email validation
- Rate limiting (prevent spam)
- Token generation
- Expiring reset links (15 minutes)

---

#### 3. Reset Password Page
**Purpose**: Allow users to set a new password using reset token  
**Access**: All users (5 roles) - via email link  
**Bootstrap 5 Components**:
- Container
- Card
- Form (floating labels)
- Input groups
- Progress bar (password strength)
- Buttons
- Alerts
- List group (password requirements)

**Main Sections**:
1. **Header Section**
   - Page title: "Reset Password"
   - Valid token confirmation

2. **New Password Form**
   - New password input (floating label with show/hide)
   - Confirm password input
   - Password strength meter (progress bar)
   - Password requirements list:
     - Minimum 8 characters
     - At least one uppercase
     - At least one number
     - At least one special character
   - "Update Password" button
   - Cancel button

3. **Success/Error Alerts**
   - Password updated successfully
   - Passwords don't match
   - Token expired or invalid

**Key Features**:
- Real-time password strength validation
- Password history check (no reuse of last 3 passwords)
- Token expiration handling
- Automatic login after reset

---

#### 4. Email Verification Page
**Purpose**: Verify user email address for account activation  
**Access**: All users (5 roles) - via email link  
**Bootstrap 5 Components**:
- Container
- Card
- Buttons
- Alerts
- Spinner (loading state)

**Main Sections**:
1. **Header Section**
   - Page title: "Email Verification"

2. **Loading State**
   - Spinner with "Verifying your email..." message

3. **Success State**
   - Checkmark icon
   - "Email verified successfully"
   - "Continue to Login" button

4. **Error State**
   - Exclamation icon
   - "Verification link expired or invalid"
   - "Resend verification email" button

**Key Features**:
- Token-based verification
- Link expiration (24 hours)
- Automatic redirect after verification
- Resend functionality

---

### Common Pages

#### 5. Role-Specific Dashboard
**Purpose**: Main landing page showing role-relevant information and quick actions  
**Access**: All users (5 roles) - content varies by role  
**Bootstrap 5 Components**:
- Navbar (user menu, notifications, logout)
- Sidebar/Offcanvas (navigation)
- Cards (stats, info)
- Tables
- Badges
- Buttons
- Progress bars
- Modal (quick actions)
- Alerts
- Dropdowns

**Main Sections**:

**Reception Dashboard**:
1. **Quick Stats Row** (4 cards)
   - Visitors checked-in today
   - Pending check-outs
   - Available badges
   - Visitors waiting for approval

2. **Today's Visitors Table**
   - Check-in time
   - Visitor name
   - Host
   - Department
   - Badge ID
   - Status (Checked-in/Checked-out)
   - Action buttons (Check-out)

3. **Quick Actions**
   - Register new visitor button
   - Check-in visitor button
   - Check-out visitor button
   - Issue badge button

4. **Recent Activity Feed**
   - Recent check-ins/check-outs
   - Badge issuances
   - System notifications

**Security Dashboard**:
1. **Quick Stats Row** (4 cards)
   - Active visitors on premises
   - Security alerts today
   - Blacklisted visitors blocked
   - Overstay alerts

2. **Live Visitor Monitoring**
   - Real-time visitor count per floor
   - List of all active visitors
   - Time on premises
   - Location tracking

3. **Active Alerts Panel**
   - Alert type
   - Severity
   - Time
   - Action buttons (Resolve, Dismiss)

4. **Recent Security Events**
   - Blacklist blocks
   - Overstay detections
   - Watchlist matches

**Host Dashboard**:
1. **Quick Stats Row** (4 cards)
   - My visitors today
   - Pending approvals
   - Scheduled visits
   - Upcoming visitors

2. **My Visitors Table**
   - Visitor name
   - Check-in time
   - Purpose
   - Status
   - Action buttons (Message, View)

3. **Pending Approvals**
   - Visitor details
   - Request date
   - Action buttons (Approve, Reject)

4. **Upcoming Visits**
   - Scheduled date/time
   - Visitor name
   - Purpose

**Admin Dashboard**:
1. **Quick Stats Row** (4 cards)
   - Total users
   - Active visitors today
   - System health status
   - Storage usage

2. **System Health Panel**
   - Server status
   - Database status
   - Redis status
   - Last backup time

3. **User Activity Summary**
   - Recent logins
   - Failed login attempts
   - New user registrations

4. **Quick Admin Actions**
   - Add user button
   - System settings link
   - View audit logs button

**Management Dashboard**:
1. **Quick Stats Row** (4 cards)
   - Total visitors this month
   - Average visit duration
   - Most visited department
   - System uptime

2. **Visitor Trends Chart**
   - Daily visitor count (last 30 days)
   - Peak hours visualization

3. **Department Statistics**
   - Top departments by visitor count
   - Category breakdown (Vendor, Guest, Auditor, etc.)

4. **Quick Reports**
   - Generate report buttons
   - Export options

**Key Features**:
- Real-time data refresh (every 30 seconds)
- Role-specific content
- Responsive layout
- Notification badges
- Quick action shortcuts
- Date range filters

---

#### 6. Profile & Settings Page
**Purpose**: Allow users to update personal information and preferences  
**Access**: All users (5 roles)  
**Bootstrap 5 Components**:
- Navbar
- Container
- Card
- Form
- Input groups
- Tabs
- Buttons
- Alerts
- Modal (password change)

**Main Sections**:

**Profile Tab**:
1. **Profile Picture**
   - Current avatar display
   - Upload/change button

2. **Personal Information Form**
   - Full name (read-only from LDAP for some users)
   - Email (read-only)
   - Phone number
   - Employee ID
   - Department
   - Designation

3. **Contact Preferences**
   - Notification preferences checkbox group
   - Email notifications
   - SMS notifications
   - Push notifications

**Security Tab**:
1. **Password Change**
   - Current password input
   - New password input
   - Confirm password input
   - "Change Password" button

2. **Two-Factor Authentication**
   - Enable/disable toggle
   - Setup instructions (if disabled)
   - QR code display (for setup)
   - Backup codes display

3. **Login History**
   - Table showing recent logins
   - Date/time
   - IP address
   - Device/browser
   - Location

**Preferences Tab**:
1. **Language Selection**
   - Dropdown (English, Bangla)

2. **Theme Selection**
   - Light/Dark mode toggle
   - Accent color selection

3. **Date/Time Format**
   - Dropdown (24h/12h)
   - Date format selection

4. **Dashboard Preferences**
   - Default view selection
   - Show/hide widgets toggles

**Key Features**:
- Profile picture upload
- Password strength validation
- 2FA setup/management
- Session management (view active sessions)
- Logout from all devices option

---

### Reception Panel

#### 7. Reception Dashboard
*Covered in Page #5 - Role-Specific Dashboard*

---

#### 8. Walk-in Registration
**Purpose**: Register visitors who arrive without prior appointment  
**Access**: Reception, Admin  
**Bootstrap 5 Components**:
- Navbar
- Container
- Card
- Form (multi-step)
- Input groups
- Buttons
- Modal (photo capture)
- Webcam integration
- File upload
- Alerts
- Progress indicator
- Tabs

**Main Sections**:

**Step 1: Visitor Information**
1. **Visitor Details Form**
   - First name (required)
   - Last name (required)
   - Email address
   - Phone number (required)
   - Company/Organization
   - Category dropdown (Vendor, Guest, Auditor, Regulator, Contractor)
   - ID type dropdown (NID, Passport, Driving License, Employee ID)
   - ID number (required)
   - Photo capture button (opens modal)
   - Upload ID document button

2. **Photo Capture Modal**
   - Live webcam feed
   - Capture button
   - Retake button
   - Confirm button
   - Preview area

**Step 2: Visit Details**
1. **Visit Information Form**
   - Host selection (searchable dropdown from LDAP)
   - Department (auto-filled from host)
   - Purpose of visit
   - Check-in date/time (default: now)
   - Expected check-out time
   - Notes/comments

2. **Badge Assignment**
   - Badge selection dropdown (available badges only)
   - Badge preview (if applicable)

**Step 3: Confirmation**
1. **Review Section**
   - Summary of all entered information
   - Photo preview
   - ID document preview
   - Host information
   - Visit details
   - Badge assignment

2. **Action Buttons**
   - "Confirm & Check-in" button (primary)
   - "Back" button
   - "Cancel" button

**Key Features**:
- Multi-step form with progress indicator
- Real-time host search with LDAP integration
- Webcam photo capture
- ID document upload (PDF/Image)
- Automatic badge assignment (lowest ID number)
- Repeat visitor detection (auto-fill from history)
- Check-in time auto-population
- Validation at each step
- Print badge option after registration

---

#### 9. Pre-registered Visitor Check-in
**Purpose**: Process check-in for pre-registered visitors  
**Access**: Reception, Admin  
**Bootstrap 5 Components**:
- Navbar
- Container
- Card
- Form
- Input groups
- Buttons
- Table
- Badges
- Modal (photo capture)
- Alerts
- Tabs

**Main Sections**:

1. **Search Section**
   - Visitor name search input
   - Visitor ID search input
   - Date filter (today)
   - Search button

2. **Pending Check-in List**
   - Table showing pre-registered visitors awaiting check-in
   - Columns:
     - Visitor name
     - Company
     - Host
     - Scheduled time
     - Category (badge)
     - Status
     - Action button ("Check-in")

3. **Check-in Action Modal** (triggered on "Check-in" click)
   - Visitor details display
   - Photo capture section (if not already uploaded)
   - Verify ID section
   - Badge selection dropdown
   - "Confirm Check-in" button
   - "Cancel" button

4. **Success Message**
   - "Visitor checked in successfully"
   - Badge ID issued
   - Print badge option

**Key Features**:
- Real-time search
- Photo verification
- Badge assignment
- Email/SMS notification to host
- Check-in timestamp
- Print badge option
- Bulk check-in capability

---

#### 10. Visitor Check-out
**Purpose**: Process visitor check-out and return badges  
**Access**: Reception, Admin  
**Bootstrap 5 Components**:
- Navbar
- Container
- Card
- Form
- Input groups
- Buttons
- Table
- Badges
- Modal
- Alerts

**Main Sections**:

1. **Search/Scan Section**
   - Badge ID scan input (for RFID scanner)
   - Visitor name search
   - Check-in date filter
   - Search button

2. **Active Visitors List**
   - Table showing currently checked-in visitors
   - Columns:
     - Badge ID (clickable for quick check-out)
     - Visitor name
     - Company
     - Host
     - Check-in time
     - Duration on premises
     - Floor/Location
     - Action button ("Check-out")

3. **Check-out Confirmation Modal**
   - Visitor details
   - Check-in time
   - Current duration
   - Overstay warning (if applicable)
   - Badge return confirmation
   - "Confirm Check-out" button
   - "Cancel" button

4. **Success Message**
   - "Visitor checked out successfully"
   - Duration of visit
   - Badge returned

**Key Features**:
- Quick badge scan for fast check-out
- Overstay detection and alerts
- Automatic duration calculation
- Badge return tracking
- Email/SMS notification to host
- Check-out timestamp
- Print receipt option

---

#### 11. Badge Issuance
**Purpose**: Issue badges to checked-in visitors  
**Access**: Reception, Admin  
**Bootstrap 5 Components**:
- Navbar
- Container
- Card
- Form
- Input groups
- Buttons
- Table
- Badges
- Alerts

**Main Sections**:

1. **Badge Selection**
   - Available badges dropdown
   - Badge status display (Available count)
   - Low stock warning (< 5 available)

2. **Visitor Selection**
   - Checked-in visitors without badge table
   - Columns:
     - Visitor name
     - Company
     - Host
     - Check-in time
     - Action button ("Issue Badge")

3. **Issue Confirmation Modal**
   - Visitor details
   - Badge information
   - "Confirm Issuance" button
   - "Cancel" button

4. **Success Message**
   - "Badge issued successfully"

**Key Features**:
- Available badge filtering
- Low stock alerts
- Badge assignment history
- Print badge option
- Bulk badge issuance
- RFID badge support

---

#### 12. Badge Return
**Purpose**: Process badge return during check-out  
**Access**: Reception, Admin  
**Bootstrap 5 Components**:
- Navbar
- Container
- Card
- Form
- Input groups
- Buttons
- Table
- Badges
- Modal
- Alerts

**Main Sections**:

1. **Badge Scan Section**
   - Badge ID scan input (RFID scanner)
   - Manual badge ID input
   - Search button

2. **Issued Badges List**
   - Table showing badges currently issued
   - Columns:
     - Badge ID
     - Visitor name
     - Issue time
     - Status
     - Action button ("Return")

3. **Return Confirmation Modal**
   - Badge information
   - Visitor information
   - Condition assessment (Good/Damaged/Lost) dropdown
   - Notes textarea
   - "Confirm Return" button
   - "Cancel" button

4. **Success Message**
   - "Badge returned successfully"
   - Badge status updated

**Key Features**:
- Quick badge scan
- Condition tracking
- Lost badge reporting
- Damage reporting
- Badge availability update
- History logging

---

#### 13. Today's Visitors List
**Purpose**: View all visitors for the current day  
**Access**: Reception, Admin, Security, Management  
**Bootstrap 5 Components**:
- Navbar
- Container
- Card
- Table
- Badges
- Buttons
- Dropdowns
- Pagination
- Alerts

**Main Sections**:

1. **Filter Bar**
   - Status filter (All, Checked-in, Checked-out, Pending)
   - Category filter (All, Vendor, Guest, Auditor, etc.)
   - Department filter
   - Search input (visitor name/company)
   - Export button (Excel/PDF)

2. **Visitors Table**
   - Columns:
     - Check-in time
     - Visitor name
     - Company
     - Category (badge)
     - Host
     - Department
     - Badge ID
     - Status
     - Duration (if checked-in)
     - Action buttons (View, Check-out)

3. **Summary Cards**
   - Total visitors today
   - Currently checked-in
   - Checked-out
   - Pending check-outs

4. **Pagination**
   - Page size selector
   - Page navigation

**Key Features**:
- Real-time data refresh
- Multiple filters
- Export functionality
- Action buttons
- Status badges
- Duration calculation
- Search functionality

---

#### 14. Visitor Search
**Purpose**: Search visitors across all history  
**Access**: Reception, Security, Host, Admin, Management  
**Bootstrap 5 Components**:
- Navbar
- Container
- Card
- Form
- Input groups
- Buttons
- Table
- Dropdowns
- Pagination
- Tabs

**Main Sections**:

1. **Search Form**
   - Visitor name input
   - Company/organization input
   - Email address input
   - Phone number input
   - ID number input
   - Date range picker (from/to)
   - Category dropdown
   - Status dropdown
   - "Search" button
   - "Clear" button
   - Save search filter option

2. **Search Results**
   - Table showing matching visitors
   - Columns:
     - Check-in date/time
     - Visitor name
     - Company
     - Category
     - Host
     - Department
     - Badge ID
     - Status
     - Duration
     - Action button ("View Details")

3. **Search Summary**
   - Total results found
   - Displaying X to Y of Z results

4. **Saved Searches Tab**
   - List of saved search filters
   - Quick apply buttons
   - Delete saved search option

**Key Features**:
- Advanced search with multiple criteria
- Date range filtering
- Save search filters
- Export results
- View visitor details
- Search history
- Quick search shortcuts

---

#### 15. Visitor History
**Purpose**: View complete visitor history and details  
**Access**: Reception, Security, Host, Admin, Management  
**Bootstrap 5 Components**:
- Navbar
- Container
- Card
- Table
- Badges
- Buttons
- Modal
- Tabs
- Accordion
- Alerts

**Main Sections**:

**Overview Tab**:
1. **Visitor Information**
   - Profile picture
   - Name
   - Company/Organization
   - Category
   - Contact information
   - ID information

2. **Visit Statistics**
   - Total visits
   - First visit date
   - Last visit date
   - Average visit duration
   - Most visited departments

**Visit History Tab**:
1. **Visits Table**
   - Columns:
     - Date
     - Host
     - Department
     - Check-in time
     - Check-out time
     - Duration
     - Purpose
     - Status
     - Action button ("View Details")

2. **Visit Details Modal**
   - Complete visit information
   - Badge details
   - Approval workflow (if pre-registered)
   - Notes

**Documents Tab**:
1. **Uploaded Documents**
   - List of ID documents
   - Upload date
   - Document type
   - View/Download buttons

**Notes Tab**:
1. **Visit Notes**
   - Notes from visits
   - Timestamp
   - Added by

**Key Features**:
- Complete visitor profile
- Visit history timeline
- Document management
- Notes and comments
- Export visitor data
- Block/unblock visitor option (Admin/Security)

---

#### 16. Pending Approvals View
**Purpose**: View visitors waiting for host approval  
**Access**: Reception, Host, Admin, Management  
**Bootstrap 5 Components**:
- Navbar
- Container
- Card
- Table
- Badges
- Buttons
- Dropdowns
- Alerts

**Main Sections**:

1. **Filter Bar**
   - Department filter
   - Category filter
   - Status filter (Pending, Approved, Rejected)
   - Search input
   - Refresh button

2. **Pending Approvals Table**
   - Columns:
     - Request date/time
     - Visitor name
     - Company
     - Category
     - Host
     - Department
     - Purpose
     - Status
     - Action buttons (View Details)

3. **Approval Summary Cards**
   - Total pending approvals
   - Approved today
   - Rejected today
   - Overdue approvals

**Key Features**:
- Real-time updates
- Approval workflow tracking
- Send reminder to host option
- Bulk approval option (for hosts)
- Approval history
- SLA monitoring
- Escalation alerts

---

### Security Panel

#### 17. Security Dashboard
*Covered in Page #5 - Role-Specific Dashboard*

---

#### 18. Live Visitor Monitoring
**Purpose**: Real-time view of all visitors on premises  
**Access**: Reception, Security, Admin, Management  
**Bootstrap 5 Components**:
- Navbar
- Container
- Card
- Table
- Badges
- Buttons
- Dropdowns
- Progress bars
- Auto-refresh indicator
- Alert banners

**Main Sections**:

1. **Summary Cards**
   - Total visitors on premises
   - Vendors
   - Guests
   - Auditors
   - Regulators
   - Contractors

2. **Floor-wise Occupancy**
   - Cards for each floor
   - Visitor count per floor
   - List of visitors on each floor
   - Color-coded by duration

3. **Live Visitors Table**
   - Columns:
     - Badge ID
     - Visitor name
     - Company
     - Category
     - Host
     - Check-in time
     - Duration
     - Floor/Location
     - Overstay indicator (badge)
     - Action buttons (View, Check-out, Alert)

4. **Auto-Refresh Control**
   - Refresh interval selector (30s, 1m, 5m)
   - Pause/Resume button
   - Last refreshed timestamp

5. **Alert Banner**
   - Overstay visitors count
   - Blacklisted visitors blocked count
   - Watchlist matches count

**Key Features**:
- Real-time updates (configurable)
- Floor-wise tracking
- Overstay detection
- Color-coded duration indicators
- Quick action buttons
- Export current view
- Full-screen mode
- Mobile-responsive

---

#### 19. Blacklist Management
**Purpose**: Manage blacklisted visitors who are not allowed on premises  
**Access**: Reception, Security, Admin  
**Bootstrap 5 Components**:
- Navbar
- Container
- Card
- Form
- Input groups
- Buttons
- Table
- Badges
- Modal
- Dropdowns
- Alerts

**Main Sections**:

1. **Add to Blacklist Form**
   - Visitor name input
   - Company input
   - ID type dropdown
   - ID number input
   - Reason dropdown (Security, Fraud, Misconduct, etc.)
   - Notes textarea
   - "Add to Blacklist" button

2. **Blacklist Search**
   - Search input (name, company, ID)
   - Filter by reason
   - Filter by date added

3. **Blacklisted Visitors Table**
   - Columns:
     - Date added
     - Visitor name
     - Company
     - ID information
     - Reason
     - Added by
     - Notes
     - Status (Active/Inactive)
     - Action buttons (View, Edit, Remove, Block)

4. **Action Confirmation Modal**
   - Warning message
   - Visitor details
   - "Confirm Action" button
   - "Cancel" button

**Key Features**:
- Add visitors to blacklist
- Search blacklisted visitors
- Edit blacklist entries
- Remove from blacklist
- Blacklist history
- Automatic block on check-in attempt
- Email alerts on block attempt
- Export blacklist

---

#### 20. Watchlist Management
**Purpose**: Monitor visitors on watchlist without blocking entry  
**Access**: Reception, Security, Admin  
**Bootstrap 5 Components**:
- Navbar
- Container
- Card
- Form
- Input groups
- Buttons
- Table
- Badges
- Modal
- Dropdowns
- Alerts

**Main Sections**:

1. **Add to Watchlist Form**
   - Visitor name input
   - Company input
   - ID type dropdown
   - ID number input
   - Reason dropdown
   - Monitoring level dropdown (Low, Medium, High)
   - Notes textarea
   - "Add to Watchlist" button

2. **Watchlist Search**
   - Search input
   - Filter by reason
   - Filter by monitoring level
   - Filter by status

3. **Watchlisted Visitors Table**
   - Columns:
     - Date added
     - Visitor name
     - Company
     - ID information
     - Reason
     - Monitoring level (color-coded badge)
     - Added by
     - Visit count
     - Last visit date
     - Status
     - Action buttons (View, Edit, Remove, Remove to Blacklist)

4. **Monitoring Activity**
   - Recent watchlist hits
   - Alerts generated
   - Visit history for watchlisted visitors

**Key Features**:
- Add visitors to watchlist
- Different monitoring levels
- Real-time alerts on visit
- View watchlist activity
- Move to blacklist option
- Automatic alerts
- Monitor without blocking
- Export watchlist

---

#### 21. Real-time Alerts
**Purpose**: Display and manage security alerts  
**Access**: Reception, Security, Admin, Management  
**Bootstrap 5 Components**:
- Navbar
- Container
- Card
- Table
- Badges
- Buttons
- Dropdowns
- Progress bars
- Modal
- Alerts
- Tabs

**Main Sections**:

1. **Alert Summary Cards**
   - New alerts (today)
   - In progress alerts
   - Resolved alerts (today)
   - Critical alerts

2. **Alert Filters**
   - Status filter (All, New, In Progress, Resolved)
   - Severity filter (All, Critical, High, Medium, Low)
   - Type filter (All, Overstay, Blacklist, Watchlist, System)
   - Date filter

3. **Alerts Table**
   - Columns:
     - Alert time
     - Type (badge)
     - Severity (color-coded badge)
     - Visitor name
     - Description
     - Status
     - Assigned to
     - Action buttons (View, Assign, Resolve, Dismiss)

4. **Alert Details Modal**
   - Complete alert information
   - Visitor details
   - Timeline
   - Resolution notes textarea
   - Assign to dropdown
   - "Resolve" button
   - "Dismiss" button

**Key Features**:
- Real-time alert updates
- Severity levels
- Alert assignment
- Alert resolution workflow
- Automatic alert generation
- Email/SMS notifications for critical alerts
- Alert history
- Export alerts
- Sound notification for critical alerts

---

#### 22. Evacuation List
**Purpose**: Generate on-demand evacuation list of all visitors on premises  
**Access**: Reception, Security, Admin, Management  
**Bootstrap 5 Components**:
- Navbar
- Container
- Card
- Table
- Buttons
- Modal
- Alerts
- Badges

**Main Sections**:

1. **Generation Controls**
   - "Generate Evacuation List" button
   - "Print Evacuation List" button
   - "Export to PDF" button
   - Last generated timestamp

2. **Evacuation List Table**
   - Columns:
     - Badge ID
     - Visitor name
     - Company
     - Category
     - Host
     - Check-in time
     - Floor/Location
     - Meeting room (if applicable)
     - Phone number
     - Photo thumbnail

3. **Floor-wise Breakdown**
   - Group by floor sections
   - Count per floor
   - List per floor

4. **Total Count**
   - Total visitors on premises
   - Total by category
   - Last updated timestamp

**Key Features**:
- Instant generation
- Floor-wise grouping
- Photo thumbnails for identification
- Print-ready format
- PDF export
- Real-time data
- One-click generation
- Mobile-friendly for emergency response

---

#### 23. Floor-wise Occupancy
**Purpose**: Monitor visitor count and location per floor  
**Access**: Reception, Security, Admin, Management  
**Bootstrap 5 Components**:
- Navbar
- Container
- Card
- Badges
- Progress bars
- Table
- Buttons
- Dropdowns
- Accordion

**Main Sections**:

1. **Floor Overview Cards**
   - Card for each floor (Ground, 1, 2, 3, etc.)
   - Visitor count
   - Capacity utilization (progress bar)
   - Last updated time

2. **Floor Details** (expandable accordion)
   For each floor:
   - Total visitors
   - Breakdown by category
   - List of visitors with:
     - Visitor name
     - Company
     - Category
     - Host
     - Check-in time
     - Duration
     - Location/Room
     - Badge ID

3. **Occupancy Chart**
   - Visual representation of floor occupancy
   - Color-coded by capacity utilization

4. **Filter Options**
   - Filter by category
   - Filter by duration
   - Search visitors

**Key Features**:
- Real-time occupancy tracking
- Capacity monitoring
- Floor-wise breakdown
- Search functionality
- Export per floor
- Overcrowding alerts
- Historical occupancy data

---

#### 24. Alert Resolution
**Purpose**: Track and resolve security alerts  
**Access**: Reception, Security, Admin, Management  
**Bootstrap 5 Components**:
- Navbar
- Container
- Card
- Form
- Input groups
- Buttons
- Table
- Badges
- Modal
- Tabs
- Alerts

**Main Sections**:

1. **Alert Status Summary**
   - Cards showing alert counts by status
   - New alerts
   - In progress alerts
   - Resolved alerts (today)
   - Overdue alerts

2. **Assigned Alerts Table**
   - Filters: Status, Severity, Type, Assigned To
   - Columns:
     - Alert time
     - Type
     - Severity
     - Visitor name
     - Description
     - Status
     - Assigned to
     - Due time
     - Action buttons (View, Resolve, Reassign)

3. **Resolution Form Modal**
   - Alert details display
   - Resolution notes textarea
   - Resolution type dropdown
   - Attachments upload
   - "Mark as Resolved" button
   - "Reassign" button
   - "Add Comment" button

4. **Resolution Timeline**
   - History of actions taken
   - Comments added
   - Status changes

**Key Features**:
- Alert assignment
- Resolution workflow
- Resolution tracking
- SLA monitoring
- Automatic escalation for overdue alerts
- Resolution notes
- Alert history
- Email notifications on resolution

---

#### 25. Visitor Movement History
**Purpose**: Track visitor movement across floors and locations  
**Access**: Reception, Security, Admin, Management  
**Bootstrap 5 Components**:
- Navbar
- Container
- Card
- Form
- Input groups
- Buttons
- Table
- Badges
- Timeline
- Dropdowns
- Pagination

**Main Sections**:

1. **Search/Filter Form**
   - Visitor name/company search
   - Date range picker
   - Floor filter
   - Location filter
   - "Search" button
   - "Clear" button

2. **Movement Timeline**
   - Chronological display of movements
   - For each movement:
     - Timestamp
     - Floor/Location
     - Entry/Exit indicator
     - Badge scan event
     - If applicable: Meeting room access

3. **Visitor Movement Table**
   - Columns:
     - Visitor name
     - Company
     - Check-in time
     - Current location
     - Movement count
     - Total time per floor
     - Action button (View Full Timeline)

4. **Movement Statistics**
   - Most visited floors
   - Average time per floor
   - Movement patterns

**Key Features**:
- Complete movement tracking
- RFID badge scan integration
- Floor entry/exit logging
- Meeting room access tracking
- Timeline visualization
- Export movement data
- Pattern analysis
- Security audit trail

---

### Host Panel

#### 26. Host Dashboard
*Covered in Page #5 - Role-Specific Dashboard*

---

#### 27. Visitor Pre-registration
**Purpose**: Allow hosts to pre-register visitors before their visit  
**Access**: Reception, Host, Admin  
**Bootstrap 5 Components**:
- Navbar
- Container
- Card
- Form (multi-step)
- Input groups
- Buttons
- Modal
- File upload
- Date/time picker
- Dropdowns
- Tabs
- Progress indicator

**Main Sections**:

**Step 1: Visitor Information**
1. **Visitor Details Form**
   - First name (required)
   - Last name (required)
   - Email address (required - for notification)
   - Phone number (required)
   - Company/Organization (required)
   - Category dropdown (Vendor, Guest, Auditor, Regulator, Contractor)
   - ID type dropdown
   - ID number
   - Upload ID document button

2. **Additional Visitors**
   - "Add Another Visitor" button
   - List of added visitors
   - Remove visitor option

**Step 2: Visit Details**
1. **Visit Information Form**
   - Visit date (required)
   - Expected arrival time (required)
   - Expected duration (hours)
   - Purpose of visit (required)
   - Department (auto-filled from host)
   - Floor/Room preference
   - Equipment needed checkbox
   - Parking required checkbox

2. **Badge Preference**
   - Badge type dropdown
   - Special requirements textarea

**Step 3: Review & Submit**
1. **Review Section**
   - Summary of all visitor information
   - Visit details
   - Additional notes
   - Check-in instructions

2. **Action Buttons**
   - "Submit for Approval" button (if multi-level approval required)
   - "Confirm Registration" button (if no approval needed)
   - "Save as Draft" button
   - "Back" button

3. **Success Message**
   - "Visitor pre-registered successfully"
   - Registration ID
   - Email confirmation sent

**Key Features**:
- Multi-visitor registration
- Draft save option
- Email notification to visitor
- Multi-level approval workflow
- Repeat visitor detection
- Bulk registration option
- Template save (for frequent visitors)
- Calendar integration

---

#### 28. My Visitors List
**Purpose**: View all visitors registered by the host  
**Access**: Reception, Host, Admin, Management  
**Bootstrap 5 Components**:
- Navbar
- Container
- Card
- Table
- Badges
- Buttons
- Dropdowns
- Tabs
- Pagination

**Main Sections**:

**Upcoming Visits Tab**:
1. **Filter Bar**
   - Status filter (Confirmed, Pending, Cancelled)
   - Category filter
   - Date range picker
   - Search input
   - Export button

2. **Upcoming Visitors Table**
   - Columns:
     - Visit date/time
     - Visitor name
     - Company
     - Category
     - Purpose
     - Status
     - Action buttons (View, Edit, Cancel)

**Past Visits Tab**:
1. **Filter Bar**
   - Date range picker
     - Category filter
     - Search input

2. **Past Visitors Table**
   - Columns:
     - Visit date
     - Visitor name
     - Company
     - Category
     - Check-in time
     - Check-out time
     - Duration
     - Purpose
     - Action button (View Details)

**Cancelled Visits Tab**:
1. **Cancelled Visits Table**
   - Columns:
     - Visit date
     - Visitor name
     - Company
     - Cancelled date
     - Cancellation reason

**Key Features**:
- Status-based tabs
- Search and filter
- Edit upcoming visits
- Cancel visits
- View visit details
- Export visitor data
- Calendar view option
- Send reminder option

---

#### 29. Pending Approvals
**Purpose**: View and approve/reject visit requests  
**Access**: Reception, Host, Admin, Management  
**Bootstrap 5 Components**:
- Navbar
- Container
- Card
- Table
- Badges
- Buttons
- Modal
- Dropdowns
- Tabs
- Alerts

**Main Sections**:

**Pending Approvals Tab**:
1. **Filter Bar**
   - Department filter
   - Category filter
   - Priority filter
   - Search input
   - Sort dropdown

2. **Pending Approvals Table**
   - Columns:
     - Request date
     - Visit date
     - Visitor name
     - Company
     - Category
     - Purpose
     - Duration
     - Priority
     - Action buttons (Approve, Reject, View Details)

3. **Bulk Actions**
   - Select all checkbox
   - Bulk approve button
   - Bulk reject button

**Approval Action Modal**:
1. **Visitor Details**
   - Complete visitor information
   - Visit details
   - Requester information

2. **Approval Form**
   - Approval notes textarea
   - Alternative time/date suggestion (optional)
   - "Approve" button
   - "Reject" button
   - "Request More Info" button

**Rejection Confirmation Modal**:
1. **Warning Message**
   - "Are you sure you want to reject this request?"

2. **Rejection Form**
   - Rejection reason dropdown
   - Additional notes textarea
   - "Confirm Rejection" button
   - "Cancel" button

**Key Features**:
- One-click approval
- One-click rejection
- Bulk approval
- Email notifications
- Approval history
- SLA monitoring
- Auto-escalation for overdue approvals
- Approval notes

---

#### 30. Approval Actions
**Purpose**: View and manage approval actions taken  
**Access**: Reception, Host, Admin, Management  
**Bootstrap 5 Components**:
- Navbar
- Container
- Card
- Table
- Badges
- Buttons
- Dropdowns
- Tabs
- Timeline

**Main Sections**:

1. **Filter Bar**
   - Date range picker
   - Action type filter (Approve, Reject, Pending)
   - Department filter
   - Search input

2. **Approval Actions Table**
   - Columns:
     - Action date
     - Visitor name
     - Company
     - Action taken (badge)
     - Action taken by
     - Visit date
     - Status
     - Action button (View Details)

3. **Approval Details Modal**
   - Complete request information
   - Approval workflow timeline
   - Approval notes
   - Email sent confirmation

**Key Features**:
- Approval history
- Audit trail
- View approval timeline
- Filter by action type
- Search functionality
- Export approval data

---

#### 31. Visitor Notifications
**Purpose**: View and manage visitor notifications  
**Access**: Reception, Host, Admin  
**Bootstrap 5 Components**:
- Navbar
- Container
- Card
- Table
- Badges
- Buttons
- Dropdowns
- Tabs
- Alerts

**Main Sections**:

1. **Notification Summary**
   - Unread count badge
   - Filter tabs (All, Unread, Read)

2. **Notifications List**
   - For each notification:
     - Type (badge - Check-in, Check-out, Approval, Reminder, Alert)
     - Date/time
     - Visitor name
     - Message preview
     - Read/Unread indicator
     - Action button (View Details)

3. **Notification Details Modal**
   - Complete message
     - Visitor details
     - Related visit information
     - Action buttons (Mark as Read, Archive, Delete)

4. **Notification Settings**
   - Email notifications toggle
   - SMS notifications toggle
   - Push notifications toggle
   - Notification preferences (select types)

**Key Features**:
- Real-time notifications
- Mark as read/unread
- Archive notifications
- Delete notifications
- Notification preferences
- Email/SMS integration
- Push notifications
- Sound alerts

---

#### 32. Visit History
**Purpose**: View complete history of visits hosted  
**Access**: Reception, Host, Admin, Management  
**Bootstrap 5 Components**:
- Navbar
- Container
- Card
- Table
- Badges
- Buttons
- Dropdowns
- Pagination
- Tabs
- Chart/Graph (optional)

**Main Sections**:

1. **Filter Bar**
   - Date range picker
   - Category filter
   - Status filter
   - Department filter
   - Search input
   - Export button

2. **Visit History Table**
   - Columns:
     - Visit date
     - Visitor name
     - Company
     - Category
     - Check-in time
     - Check-out time
     - Duration
     - Purpose
     - Action button (View Details)

3. **Visit Statistics**
   - Total visits
   - By category (chart/table)
   - Average duration
   - Most frequent visitors
   - Monthly trend

4. **Visit Details Modal**
   - Complete visit information
   - Visitor details
   - Badge information
   - Approval history
   - Notes

**Key Features**:
- Complete visit history
- Statistics and trends
- Export functionality
- Search and filter
- Visit analytics
- Compare periods
- Print visit records

---

#### 33. Schedule Visits
**Purpose**: Schedule and manage future visits  
**Access**: Reception, Host, Admin  
**Bootstrap 5 Components**:
- Navbar
- Container
- Card
- Calendar
- Form
- Input groups
- Buttons
- Modal
- Dropdowns
- Tabs

**Main Sections**:

1. **Calendar View**
   - Month/Week/Day view toggle
   - Display scheduled visits on calendar
   - Color-coded by category
   - Click on visit to view/edit

2. **Schedule New Visit Form**
   - Pre-registration form (similar to Page #27)
   - Date/time picker with availability
   - Recurring visit option
   - Template selection

3. **Upcoming Schedule List**
   - Table showing scheduled visits
   - Columns:
     - Visit date/time
     - Visitor name
     - Company
     - Category
     - Purpose
     - Status
     - Action buttons (View, Edit, Cancel, Reschedule)

4. **Reschedule Modal**
   - New date/time picker
   - Reason for reschedule
   - Notification options
   - "Confirm Reschedule" button

**Key Features**:
- Calendar integration
- Drag-and-drop scheduling
- Recurring visits
- Reschedule visits
- Cancel visits
- Sync with external calendar
- Meeting room availability check
- Automatic reminders

---

### Admin Panel

#### 34. Admin Dashboard
*Covered in Page #5 - Role-Specific Dashboard*

---

#### 35. User Management
**Purpose**: Manage all system users and their access  
**Access**: Admin  
**Bootstrap 5 Components**:
- Navbar
- Container
- Card
- Table
- Badges
- Buttons
- Modal
- Form
- Input groups
- Dropdowns
- Tabs
- Pagination

**Main Sections**:

**Users List Tab**:
1. **Filter Bar**
   - Role filter
   - Status filter (Active, Inactive, Pending)
   - Department filter
   - Search input (name, email)
   - "Add User" button
   - Export button

2. **Users Table**
   - Columns:
     - Name
     - Email
     - Role (badge)
     - Department
     - Status (badge)
     - Last login
     - Action buttons (View, Edit, Deactivate, Delete)

**Add/Edit User Modal**:
1. **User Information Form**
   - First name (required)
   - Last name (required)
   - Email address (required)
   - Phone number
   - Role dropdown (required)
   - Department dropdown (required)
   - Designation
   - Employee ID

2. **Account Settings**
   - Status dropdown (Active, Inactive)
   - "Send welcome email" checkbox
   - "Require password change on login" checkbox

3. **Permissions**
   - Permission checkboxes based on role
   - Custom permissions option

**User Details Modal**:
1. **User Profile**
   - Profile picture
   - Basic information
   - Contact information

2. **Account Information**
   - Account status
   - Last login
   - Created date
   - Modified date

3. **Activity Log**
   - Recent actions
   - Login history

**Key Features**:
- Add/Edit/Delete users
- User activation/deactivation
- Role assignment
- Permission management
- LDAP integration
- User search and filter
- Export user data
- Activity logging
- Password reset

---

#### 36. Role & Permissions
**Purpose**: Configure roles and their associated permissions  
**Access**: Admin  
**Bootstrap 5 Components**:
- Navbar
- Container
- Card
- Table
- Badges
- Buttons
- Modal
- Form
- Input groups
- Checkbox groups
- Tabs
- Accordion

**Main Sections**:

1. **Roles List**
   - Cards for each role (Reception, Security, Host, Admin, Management)
   - For each role:
     - Role name
     - Number of users
     - Description
     - Action buttons (View Permissions, Edit Role)

2. **Role Details Modal**
   - Role information
     - Role name
     - Description
     - Number of users
     - User count breakdown

   - Permissions Table
     - Grouped by module (Registration, Approval, Badge Management, etc.)
     - Checkbox for each permission
     - "Select All" per module
     - "Save Changes" button

3. **Add Role Form** (if custom roles needed)
   - Role name input
   - Description textarea
   - Permission selection
   - "Create Role" button

4. **Permission Summary**
   - Total permissions defined
   - Permissions by role
   - Custom permissions count

**Key Features**:
- Role-based access control (RBAC)
- Granular permissions
- Module-based permission grouping
- Custom role creation
- Permission inheritance
- Role editing
- User count per role
- Export role definitions

---

#### 37. Department Management
**Purpose**: Manage organizational departments  
**Access**: Admin  
**Bootstrap 5 Components**:
- Navbar
- Container
- Card
- Table
- Badges
- Buttons
- Modal
- Form
- Input groups
- Tree view (for hierarchy)
- Tabs

**Main Sections**:

1. **Department Tree/Hierarchy**
   - Visual hierarchy of departments
   - Expand/collapse nodes
   - Add department button
   - Edit department button
   - Delete department button

2. **Departments Table**
   - Columns:
     - Department name
     - Parent department
     - Head of department
     - Floor/Location
     - Employee count
     - Status
     - Action buttons (View, Edit, Delete)

3. **Add/Edit Department Modal**
   - Department name input (required)
   - Parent department dropdown
   - Head of department dropdown (from LDAP)
   - Floor/Location input
   - Building/Address
   - Contact email
   - Contact phone
   - Status dropdown (Active, Inactive)
   - "Save" button

4. **Department Details**
   - Department information
   - Sub-departments
   - Employees list
   - Access requirements

**Key Features**:
- Hierarchical structure
- LDAP synchronization
- Department head assignment
- Floor/location mapping
- Employee tracking
- Access control integration
- Export department structure
- Active/Inactive status

---

#### 38. Employee Directory (LDAP Sync)
**Purpose**: View and sync employees from LDAP/Active Directory  
**Access**: Reception, Security, Host, Admin, Management  
**Bootstrap 5 Components**:
- Navbar
- Container
- Card
- Table
- Badges
- Buttons
- Input groups
- Dropdowns
- Pagination
- Modal
- Progress bar

**Main Sections**:

1. **Sync Controls**
   - "Sync Now" button
   - Last sync timestamp
   - Sync status
   - Sync schedule (daily at 2 AM)
   - "View Sync History" button

2. **Search/Filter**
   - Search input (name, email, employee ID)
   - Department filter
   - Designation filter
   - Status filter

3. **Employees Table**
   - Columns:
     - Employee ID
     - Name
     - Email
     - Department
     - Designation
     - Floor/Location
     - Phone
     - LDAP status
     - Action buttons (View Details)

4. **Employee Details Modal**
   - Complete employee information
   - Profile picture (from LDAP)
   - Contact information
   - Department information
   - System access (if applicable)

5. **Sync History**
   - Date/time
   - Records synced
   - Status
   - Duration
   - Error details (if any)

**Key Features**:
- LDAP/AD integration
- Automatic daily sync
- Manual sync option
- Employee search
- Department filtering
- Sync history tracking
- Error handling
- Incremental updates

---

#### 39. Visitor Categories Setup
**Purpose**: Configure visitor categories and their properties  
**Access**: Admin  
**Bootstrap 5 Components**:
- Navbar
- Container
- Card
- Table
- Badges
- Buttons
- Modal
- Form
- Input groups
- Color picker
- Tabs

**Main Sections**:

1. **Categories Table**
   - Columns:
     - Category name
     - Description
     - Badge color
     - Approval required
     - Maximum duration (hours)
     - Badge type
     - Status
     - Action buttons (View, Edit, Delete, Reorder)

2. **Add/Edit Category Modal**
   - Category name input (required)
   - Description textarea
   - Badge color picker
   - "Approval required" checkbox
   - Approval level dropdown (None, Single, Multi-level)
   - Maximum duration input (hours)
   - Badge type dropdown (Standard, RFID, Temporary)
   - Required documents checkbox group (ID, Photo, etc.)
   - Check-in requirements
   - Status dropdown (Active, Inactive)
   - "Save" button

3. **Category Preview**
   - Badge preview with selected color
   - Display of category properties

**Key Features**:
- Custom category creation
- Color-coded badges
- Approval workflow configuration
- Duration limits
- Badge type selection
- Document requirements
- Category reordering
- Active/Inactive status

---

#### 40. Badge Management (Admin)
**Purpose**: Manage badge inventory and configuration  
**Access**: Reception, Admin  
**Bootstrap 5 Components**:
- Navbar
- Container
- Card
- Table
- Badges
- Buttons
- Modal
- Form
- Input groups
- Dropdowns
- Tabs
- Progress bars

**Main Sections**:

**Badge Inventory Tab**:
1. **Summary Cards**
   - Total badges
   - Available badges
   - Issued badges
   - Damaged badges
   - Lost badges
   - Low stock alert (< 5 available)

2. **Badges Table**
   - Columns:
     - Badge ID
     - Badge type
     - Status (badge - Available, Issued, Damaged, Lost)
     - Current holder (if issued)
     - Issue date/time
     - Last used
     - Condition
     - Action buttons (View, Edit, Mark Damaged, Mark Lost, Delete)

**Badge Configuration Tab**:
1. **Badge Types**
   - Card for each badge type
   - Name, description, RFID support
   - Add/Edit badge type

2. **Add/Edit Badge Type Modal**
   - Badge type name
   - Description
   - RFID support checkbox
   - Badge prefix (for numbering)
   - Starting number
   - "Save" button

**Badge History Tab**:
1. **Search/Filter**
   - Badge ID search
   - Status filter
   - Date range picker

2. **Issuance History**
   - Columns:
     - Badge ID
     - Issued to
     - Issue date/time
     - Returned date/time
     - Duration
     - Condition on return

**Key Features**:
- Badge inventory tracking
- Badge type configuration
- RFID badge support
- Status tracking (Available, Issued, Damaged, Lost)
- Low stock alerts
- Badge history
- Bulk badge creation
- Print badges

---

#### 41. System Settings
**Purpose**: Configure system-wide settings  
**Access**: Admin  
**Bootstrap 5 Components**:
- Navbar
- Container
- Card
- Form
- Input groups
- Buttons
- Switches
- Tabs
- Modal
- Alerts

**Main Sections**:

**General Settings Tab**:
1. **Basic Information**
   - System name input
   - Company name input
   - Logo upload
   - Timezone dropdown
   - Date format dropdown
   - Time format dropdown (24h/12h)
   - Language dropdown

2. **Security Settings**
   - Session timeout input (minutes)
   - Password expiry (days)
   - Minimum password length
   - Password complexity requirements
   - Two-factor authentication toggle
   - Maximum login attempts
   - Account lockout duration

**Visitor Settings Tab**:
1. **Registration Settings**
   - Require photo capture toggle
   - Require ID document upload toggle
   - Allow walk-in visitors toggle
   - Auto-assign badges toggle
   - Default visit duration (hours)
   - Overstay alert threshold (hours)

2. **Approval Settings**
   - Default approval workflow dropdown
   - Auto-approval timeout (minutes)
   - Escalation enabled toggle
   - Escalation timeline (hours)

**Notification Settings Tab**:
1. **Email Settings**
   - SMTP server
   - SMTP port
   - SMTP username
   - SMTP password
   - "Test Email" button

2. **SMS Settings**
   - SMS gateway API
   - API key
   - Sender ID
   - "Test SMS" button

3. **Notification Preferences**
   - Enable email notifications toggle
   - Enable SMS notifications toggle
   - Enable push notifications toggle

**Backup Settings Tab**:
1. **Backup Configuration**
   - Automated backup toggle
   - Backup frequency dropdown (Daily, Weekly)
   - Backup time
   - Retention period (days)
   - Offsite backup toggle
   - "Backup Now" button

2. **Restore**
   - Select backup file
   - "Restore" button
   - Confirmation warning

**Key Features**:
- System configuration
- Security settings
- Visitor settings
- Approval workflow configuration
- Email/SMS integration
- Automated backups
- Restore functionality
- Test notifications
- Settings export/import

---

#### 42. Email/SMS Configuration
**Purpose**: Configure email and SMS notification settings  
**Access**: Admin  
**Bootstrap 5 Components**:
- Navbar
- Container
- Card
- Form
- Input groups
- Buttons
- Tabs
- Modal
- Alerts
- Textarea

**Main Sections**:

**Email Configuration Tab**:
1. **SMTP Settings**
   - SMTP host input
   - SMTP port input
   - Encryption dropdown (TLS, SSL, None)
   - SMTP username input
   - SMTP password input
   - From email input
   - From name input
   - "Test Connection" button
   - "Send Test Email" button

2. **Email Templates**
   - Template type dropdown (Welcome, Check-in, Check-out, Approval, Reminder, Alert)
   - Subject line input
   - Email body textarea (with variables: {visitor_name}, {host_name}, etc.)
   - "Preview" button
   - "Save Template" button

**SMS Configuration Tab**:
1. **Gateway Settings**
   - Gateway provider dropdown
   - API endpoint URL input
   - API key input
   - Sender ID input
   - "Test Connection" button
   - "Send Test SMS" button

2. **SMS Templates**
   - Template type dropdown
   - Message content textarea (with character count)
   - Variables available
   - "Preview" button
   - "Save Template" button

3. **SMS Credits**
   - Credits remaining
   - Last purchase date
   - "Purchase Credits" button

**Notification Rules Tab**:
1. **Email Rules**
   - Checkbox list for email triggers
   - Check-in notification
   - Check-out notification
   - Approval request
   - Approval granted
   - Approval rejected
   - Overstay alert
   - Blacklist alert

2. **SMS Rules**
   - Checkbox list for SMS triggers
   - Same as above

3. **Recipients**
   - Who receives each type of notification
   - Recipient type dropdown (Host, Reception, Security, Admin)

**Key Features**:
- SMTP configuration
- SMS gateway configuration
- Customizable email templates
- Customizable SMS templates
- Template preview
- Variable substitution
- Notification rules
- Test functionality
- SMS credits management

---

#### 43. Access Control Integration
**Purpose**: Configure RFID door access control integration  
**Access**: Admin  
**Bootstrap 5 Components**:
- Navbar
- Container
- Card
- Form
- Input groups
- Buttons
- Switches
- Tabs
- Table
- Badges
- Modal

**Main Sections**:

1. **Integration Status**
   - Connection status (Connected/Disconnected)
   - Last sync timestamp
   - "Test Connection" button
   - "Reconnect" button

2. **Access Control Settings**
   - Integration enabled toggle
   - API endpoint URL input
   - API key input
   - Sync frequency dropdown (Real-time, Every 5 minutes, Every 15 minutes)
   - "Save Settings" button

3. **Floor/Zone Configuration**
   - Table showing floors and access requirements
   - Columns:
     - Floor/Zone
     - Access level
     - Badge requirement
     - RFID required
     - Restricted access
     - Action buttons (Edit, View Access Rules)

4. **Access Rules Modal**
   - Floor/Zone name
   - Allowed visitor categories (checkboxes)
   - Time restrictions
   - Host approval required toggle
   - "Save Rules" button

5. **Badge Access Mapping**
   - Map badge types to access levels
   - Table showing:
     - Badge type
     - Access level
     - Floors accessible
     - Time restrictions
     - Action buttons (Edit)

**Key Features**:
- RFID badge integration
- Door access control
- Floor-wise access rules
- Real-time synchronization
- Access level configuration
- Time-based restrictions
- Connection testing
- Access logging

---

#### 44. Audit Logs
**Purpose**: View complete system activity log  
**Access**: Reception, Security, Admin, Management  
**Bootstrap 5 Components**:
- Navbar
- Container
- Card
- Table
- Badges
- Buttons
- Dropdowns
- Pagination
- Tabs
- Modal
- Date range picker

**Main Sections**:

1. **Filter Bar**
   - Date range picker
   - User filter
   - Action type filter (Login, Logout, Create, Update, Delete, etc.)
   - Module filter (Registration, Approval, Badge, etc.)
   - Search input
   - Export button

2. **Audit Logs Table**
   - Columns:
     - Timestamp
     - User
     - Action
     - Module
     - Description
     - IP Address
     - Browser/Device
     - Status (Success, Failed)
     - Action button (View Details)

3. **Log Details Modal**
   - Complete log entry
   - Timestamp
   - User information
   - Action details
   - Before/After values (for updates)
   - Additional data
   - IP address
   - User agent

4. **Log Statistics**
   - Total actions logged
   - Actions by user
   - Actions by module
   - Failed actions
   - Daily activity graph

**Key Features**:
- Complete activity logging
- Immutable audit trail
- Search and filter
- Detailed view
- Export logs
- User activity tracking
- Failed action monitoring
- Security audit

---

#### 45. System Backup & Recovery
**Purpose**: Perform system backups and data recovery  
**Access**: Admin  
**Bootstrap 5 Components**:
- Navbar
- Container
- Card
- Buttons
- Table
- Badges
- Modal
- Progress bars
- Alerts
- Switches
- Date range picker

**Main Sections**:

1. **Quick Actions**
   - "Create Backup Now" button
   - "Configure Automated Backups" button
   - System health status

2. **Backup Schedule**
   - Automated backup toggle
   - Frequency dropdown (Daily, Weekly)
   - Backup time input
   - Retention period input (days)
   - Offsite backup toggle
   - "Save Configuration" button

3. **Recent Backups Table**
   - Columns:
     - Backup date/time
     - Type (Manual, Automatic)
     - Size
     - Location (Local, Offsite)
     - Status (Success, Failed, In Progress)
     - Action buttons (Restore, Download, Delete)

4. **Restore Backup Modal**
   - Warning message
   - Selected backup information
   - "Confirm Restore" button
   - "Cancel" button

5. **Restore Progress**
   - Progress bar
   - Current step
   - Estimated time remaining
   - "Cancel Restore" button (if applicable)

6. **System Health**
   - Database status
   - Storage usage
   - Last backup time
   - Last restore time (if any)

**Key Features**:
- Manual backup creation
- Automated backup scheduling
- Backup history
- Restore functionality
- Offsite backup support
- Progress tracking
- Storage management
- Backup validation
- System health monitoring

---

### Management Panel

#### 46. Management Dashboard
*Covered in Page #5 - Role-Specific Dashboard*

---

#### 47. Visitor Summary Reports
**Purpose**: View comprehensive visitor statistics and summaries  
**Access**: Admin, Management  
**Bootstrap 5 Components**:
- Navbar
- Container
- Card
- Table
- Badges
- Buttons
- Dropdowns
- Tabs
- Charts/Graphs (Chart.js or similar)
- Date range picker

**Main Sections**:

1. **Date Range Selector**
   - Presets (Today, Yesterday, Last 7 days, Last 30 days, This Month, Last Month, Custom)
   - Custom date range picker
   - "Generate Report" button

2. **Summary Cards**
   - Total visitors
   - Unique visitors
   - Average visitors per day
   - Peak day
   - Average visit duration
   - Total check-ins
   - Total check-outs

3. **Visitor Trends Chart**
   - Line chart showing visitor count over time
   - Daily/Monthly view toggle

4. **Category Breakdown**
   - Pie chart showing visitor categories (Vendor, Guest, Auditor, etc.)
   - Table with counts and percentages

5. **Department Statistics**
   - Bar chart showing visitors by department
   - Top 10 departments table

6. **Time Analysis**
   - Peak hours chart
   - Busiest times of day

7. **Host Statistics**
   - Top 10 hosts by visitor count
   - Table with details

**Key Features**:
- Date range filtering
- Visual charts and graphs
- Multiple summary metrics
- Export to PDF
- Export to Excel
- Print report
- Drill-down capability

---

#### 48. Daily/Monthly Reports
**Purpose**: Generate and view scheduled reports  
**Access**: Admin, Management  
**Bootstrap 5 Components**:
- Navbar
- Container
- Card
- Table
- Badges
- Buttons
- Modal
- Dropdowns
- Tabs
- Date picker

**Main Sections**:

1. **Report Generation**
   - Report type dropdown (Daily, Monthly, Custom)
   - Date/Month selector
   - Department filter (optional)
   - Category filter (optional)
   - "Generate Report" button

2. **Scheduled Reports**
   - Table showing scheduled reports
   - Columns:
     - Report name
     - Type
     - Frequency
     - Recipients
     - Next run date
     - Status
     - Action buttons (View, Edit, Delete, Run Now)

3. **Report History**
   - Table showing generated reports
   - Columns:
     - Report name
     - Generated date
     - Type
     - Generated by
     - File format
     - File size
     - Action buttons (Download, View, Delete)

4. **Generate Custom Report Modal**
   - Report name input
   - Report type selection
   - Date range
   - Filters
   - Columns to include
   - Output format (PDF, Excel)
   - Email recipients
   - "Schedule Report" checkbox
   - Frequency dropdown (if scheduled)
   - "Generate" button

5. **Report Preview**
   - Report display area
   - Download buttons (PDF, Excel)
   - Print button
   - Email report button

**Key Features**:
- Report scheduling
- Custom report generation
- Multiple output formats
- Email delivery
- Report history
- Template-based reports
- Column selection
- Filter options

---

#### 49. Department Analytics
**Purpose**: Analyze visitor traffic by department  
**Access**: Admin, Management  
**Bootstrap 5 Components**:
- Navbar
- Container
- Card
- Table
- Badges
- Buttons
- Dropdowns
- Charts/Graphs
- Date range picker
- Tabs

**Main Sections**:

1. **Filter Bar**
   - Date range picker
   - Department dropdown
   - Category filter
   - "Generate Analytics" button

2. **Department Overview**
   - Cards showing:
     - Total visitors
     - Average per day
     - Busiest day
     - Peak hour
     - Average duration
     - Unique visitors

3. **Department Comparison**
   - Bar chart comparing departments
   - Top departments by visitor count

4. **Selected Department Details**
   - Visitor trends line chart
   - Category breakdown pie chart
   - Time analysis (peak hours)
   - Host breakdown
   - Visit purpose analysis

5. **Department Rankings**
   - Table showing all departments ranked by:
     - Total visitors
     - Average visitors per day
     - Average visit duration
     - Unique visitors

**Key Features**:
- Department comparison
- Trend analysis
- Time-based analytics
- Category breakdown
- Host analysis
- Export analytics
- Print analytics
- Drill-down capability

---

#### 50. Custom Report Builder
**Purpose**: Build custom reports with flexible parameters  
**Access**: Admin, Management  
**Bootstrap 5 Components**:
- Navbar
- Container
- Card
- Form
- Input groups
- Buttons
- Checkboxes
- Dropdowns
- Modal
- Tabs
- Date range picker
- Sortable lists

**Main Sections**:

1. **Report Configuration**
   - Report name input
   - Description textarea

2. **Data Source**
   - Data source dropdown (Visitors, Check-ins, Check-outs, Badges, Alerts, etc.)

3. **Date Range**
   - Date range picker
   - Presets (Today, Yesterday, Last 7 days, etc.)

4. **Filters**
   - Add filter button
   - Filter type dropdown (Department, Category, Host, Status, etc.)
   - Filter value input/dropdown
   - Remove filter option

5. **Columns Selection**
   - Available columns list (draggable)
   - Selected columns list (draggable)
   - Column order adjustment
   - Column alias option

6. **Sorting**
   - Sort by dropdown (column)
   - Sort order dropdown (Ascending, Descending)

7. **Grouping**
   - Group by dropdown (optional)
   - Aggregation options (Sum, Count, Average, etc.)

8. **Output Options**
   - Output format (PDF, Excel, CSV)
   - Page size (for PDF)
   - Orientation (Portrait, Landscape)

9. **Save & Run**
   - "Save Report" button
   - "Save & Run" button
   - "Run Preview" button

10. **Report Preview**
    - Tabular preview of results
    - Pagination
    - Export options
    - Print option

**Key Features**:
- Flexible report building
- Multiple data sources
- Custom filters
- Column selection
- Sorting and grouping
- Save report templates
- Run on-demand
- Schedule reports
- Export options

---

#### 51. Export Data (Excel/PDF)
**Purpose**: Export system data to various formats  
**Access**: Admin, Management  
**Bootstrap 5 Components**:
- Navbar
- Container
- Card
- Form
- Input groups
- Buttons
- Dropdowns
- Tabs
- Modal
- Date range picker

**Main Sections**:

1. **Export Type Selection**
   - Data type dropdown (Visitors, Check-ins, Check-outs, Badges, Users, Alerts, etc.)

2. **Filter Options**
   - Date range picker
   - Department filter
   - Category filter
   - Status filter
   - Custom filters

3. **Format Selection**
   - Format dropdown (Excel, PDF, CSV)
   - PDF options (page size, orientation)
   - Excel options (include charts, formatting)

4. **Columns Selection**
   - Select all checkbox
   - Individual column checkboxes
   - Column ordering

5. **Export Preview**
   - Sample data preview
   - Total records count
   - Estimated file size

6. **Export Actions**
   - "Export Now" button
   - "Export & Email" button
   - Email recipients input

7. **Export History**
   - Table showing recent exports
   - Columns:
     - Export date
     - Data type
     - Format
     - Records
     - File size
     - Download button
     - Delete button

**Key Features**:
- Multiple data types
- Multiple formats
- Flexible filtering
- Column selection
- Email export
- Export history
- Large data export handling
- Download management

---

### System Pages

#### 52. 404 Error Page
**Purpose**: Display when a page is not found  
**Access**: All users  
**Bootstrap 5 Components**:
- Container
- Card
- Buttons
- Illustration/Image

**Main Sections**:

1. **Error Message**
   - Large "404" heading
   - "Page Not Found" text
   - Helpful message: "The page you're looking for doesn't exist or has been moved."

2. **Actions**
   - "Go to Dashboard" button
   - "Back to Home" button

3. **Contact Support**
   - "Need help?" text
   - Contact email link
   - Contact phone number

**Key Features**:
- User-friendly error message
- Navigation options
- Support contact
- Consistent branding
- Mobile-responsive

---

#### 53. Maintenance/Under Construction Page
**Purpose**: Display during system maintenance  
**Access**: All users  
**Bootstrap 5 Components**:
- Container
- Card
- Buttons
- Progress bar (optional)
- Alert
- Icon/Illustration

**Main Sections**:

1. **Maintenance Notice**
   - Large icon/illustration
   - "System Maintenance" heading
   - Maintenance message
   - "We'll be back shortly" text

2. **Progress Information** (if applicable)
   - Progress bar showing completion percentage
   - Estimated time remaining

3. **Contact Information**
   - "For urgent matters" text
   - Contact email
   - Contact phone number
   - Reception desk number

4. **Actions**
   - "Refresh Page" button
   - "Contact Support" button

**Key Features**:
- Clear communication
- Progress indication (if available)
- Contact information
- Auto-refresh option
- Consistent branding
- Mobile-responsive

---

## Bootstrap 5 Component Summary

### Core Components Used Throughout System

| Component | Usage Frequency | Notes |
|-----------|-----------------|-------|
| Navbar | All pages | User menu, notifications, logout |
| Container/Container-fluid | All pages | Layout structure |
| Card | Most pages | Content grouping |
| Table | Data-heavy pages | Display lists and records |
| Form | Input pages | User input and data entry |
| Buttons | All pages | Actions and navigation |
| Modal | Most pages | Pop-ups and confirmations |
| Badge | Data tables | Status indicators |
| Alerts | Most pages | Notifications and warnings |
| Input groups | Forms | Input with addons |
| Dropdowns | Navigation pages | Selectors and filters |
| Tabs | Multi-section pages | Content organization |
| Pagination | List pages | Data pagination |
| Progress bars | Status pages | Progress indication |
| Switches | Settings pages | Toggle options |
| Accordion | Expandable content | Collapsible sections |

### Optional Bootstrap Plugins

- **Bootstrap Icons**: For icons throughout the interface
- **Bootstrap Datepicker**: For date/time selection
- **Bootstrap Select**: For enhanced dropdowns
- **Chart.js**: For charts and graphs (dashboard pages)
- **Bootstrap Table**: For enhanced table features
- **SweetAlert2**: For better alert modals

---

## Design Guidelines

### Color Scheme
- **Primary**: Bootstrap default blue (#0d6efd) or corporate blue
- **Success**: Green (#198754) - for approved, successful states
- **Danger**: Red (#dc3545) - for rejected, overstay, alert states
- **Warning**: Yellow (#ffc107) - for pending, overstay warning states
- **Info**: Cyan (#0dcaf0) - for information, neutral states
- **Light/Dark**: Use Bootstrap's light and dark themes

### Responsive Design
- Mobile-first approach
- Breakpoints: xs (<576px), sm (≥576px), md (≥768px), lg (≥992px), xl (≥1200px)
- Use Bootstrap's responsive grid system
- Optimize tables for mobile (horizontal scroll or card view)
- Collapsible navigation for mobile

### Accessibility
- Use semantic HTML
- ARIA labels for screen readers
- Keyboard navigation support
- Sufficient color contrast
- Alt text for images
- Focus indicators for interactive elements

### Performance
- Minimize CSS and JavaScript
- Lazy load images
- Optimize large tables with pagination
- Use CDN for Bootstrap files
- Implement caching strategies

---

## Implementation Notes

### File Structure Recommendation
```
/
├── assets/
│   ├── css/
│   │   ├── bootstrap.min.css
│   │   └── custom.css
│   ├── js/
│   │   ├── bootstrap.bundle.min.js
│   │   └── custom.js
│   └── img/
├── includes/
│   ├── header.php
│   ├── footer.php
│   └── navbar.php
├── pages/
│   ├── auth/
│   ├── reception/
│   ├── security/
│   ├── host/
│   ├── admin/
│   └── management/
└── index.php
```

### Common Features to Implement
- Real-time data refresh (using JavaScript intervals or WebSockets)
- Form validation (client-side and server-side)
- AJAX calls for dynamic content loading
- Local storage for user preferences
- Session management
- CSRF protection
- XSS prevention

### Third-Party Libraries to Consider
- **Chart.js**: For charts and graphs
- **SweetAlert2**: For beautiful alerts
- **Bootstrap Datepicker**: For date/time selection
- **jQuery**: For easier DOM manipulation (if needed)
- **Select2**: For enhanced dropdowns
- **DataTable.js**: For advanced table features

---

## Conclusion

This document provides a comprehensive overview of all 53 pages required for the UCB Visitor Management System. Each page includes:

- Clear purpose and functionality
- User role access permissions
- Bootstrap 5 component recommendations
- Detailed section breakdown
- Key features and interactions

### Implementation Priority

1. **Phase 1 (Core)**: Authentication, Common Pages, Reception Panel (14 pages)
2. **Phase 2 (Security)**: Security Panel (9 pages)
3. **Phase 3 (Host)**: Host Panel (8 pages)
4. **Phase 4 (Admin)**: Admin Panel (12 pages)
5. **Phase 5 (Management)**: Management Panel (6 pages)
6. **Phase 6 (System)**: System Pages (2 pages)

### Total Implementation Effort

- **Total Pages**: 53
- **User Roles**: 5
- **Modules**: 6
- **Estimated Timeline**: 18-20 weeks (as per project specification)

This documentation serves as a comprehensive guide for front-end development using Bootstrap 5, ensuring a consistent, user-friendly, and functional interface across all user roles and system modules.

---

**Document Version**: 1.0  
**Last Updated**: January 19, 2026  
**Prepared For**: UCB Visitor Management System Project  
**Technology Stack**: Bootstrap 5 + Laravel 11 + MySQL 8
