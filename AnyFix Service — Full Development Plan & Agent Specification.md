# AnyFix Service — Full Development Plan

## 1. Project Overview

Build a full-stack service management and repair booking platform called **AnyFix Service**.

AnyFix Service is a platform that allows customers to request repair and maintenance services for electronic devices or household equipment.

The system consists of:

1. **Customer Web Application**
2. **Customer Android Application**
3. **Technician Web/Application interface**
4. **Laravel REST API Backend**
5. **Laravel Admin Dashboard**
6. **MySQL Database**

The goal is to create a realistic, production-style portfolio project demonstrating:

- Android development
- Laravel backend development
- REST API development
- Web development
- Authentication
- Role-based authorization
- Database design
- Service management
- Booking management
- Technician management
- Order/workflow management
- File/image upload
- Notifications
- Dashboard and analytics

The application must be designed so that the Android application and web applications use the same Laravel backend and database.

---

# 2. Core Concept

AnyFix Service connects customers who need repairs with technicians who perform the repairs.

Example:

```text
Customer
   │
   │ Request Service
   ▼
AnyFix Platform
   │
   │ Assign / Accept
   ▼
Technician
   │
   │ Diagnose
   ▼
Repair Process
   │
   │ Update Status
   ▼
Customer
   │
   │ Confirm Completion
   ▼
Completed Service
```

Example services:

- Smartphone repair
- Laptop repair
- Computer repair
- Printer repair
- TV repair
- Appliance repair
- Network/Wi-Fi troubleshooting
- Software installation
- Device maintenance

The system should be flexible enough to support additional service categories later.

---

# 3. Platform Architecture

Use this architecture:

```text
                    ┌──────────────────────┐
                    │   Customer Android   │
                    │        App           │
                    └──────────┬───────────┘
                               │
                               │ REST API
                               ▼
┌──────────────────┐  ┌──────────────────────┐
│ Customer Web     │──│                      │
│ Application      │  │   Laravel Backend    │
└──────────────────┘  │      REST API        │
                      │                      │
┌──────────────────┐  │                      │
│ Admin Dashboard  │──│                      │
└──────────────────┘  └──────────┬───────────┘
                                 │
                                 ▼
                      ┌──────────────────────┐
                      │       MySQL          │
                      └──────────────────────┘
                                 ▲
                                 │
                      ┌──────────┴───────────┐
                      │ Technician Interface │
                      └──────────────────────┘
```

Important:

The Android application and web application must never access MySQL directly.

All business operations must pass through Laravel.

---

# 4. Technology Stack

## Backend

Use:

- PHP
- Laravel
- Laravel Sanctum
- MySQL
- Laravel Eloquent
- Laravel Migrations
- Laravel Seeders
- Laravel Form Requests
- Laravel Policies
- Laravel Notifications
- Laravel Storage
- REST API

---

# 5. Web Application

Use Laravel for the web application.

Recommended:

- Laravel Blade
- Tailwind CSS
- Alpine.js where useful
- Responsive design
- Server-side validation
- Reusable Blade components

The web application should support:

- Customer portal
- Technician portal
- Admin dashboard

---

# 6. Android Application

Use:

- Kotlin
- Android Studio
- Jetpack Compose or XML
- Retrofit
- OkHttp
- Kotlin Coroutines
- ViewModel
- Navigation
- Coil
- Secure token storage

Recommended architecture:

```text
UI
 ↓
ViewModel
 ↓
Repository
 ↓
Retrofit
 ↓
Laravel REST API
 ↓
MySQL
```

Do not put API requests directly inside Activities or UI components.

---

# 7. User Roles

Implement three primary roles.

## Customer

Customer can:

- Register
- Login
- Manage profile
- Browse services
- Search services
- View service details
- Create service requests
- Upload device/problem photos
- Select address
- Select schedule
- View service status
- Communicate with technician
- View quotation
- Approve/reject quotation
- View service history
- Confirm service completion
- Rate technician
- Leave review

---

## Technician

Technician can:

- Login
- Manage profile
- Manage skills
- Set service availability
- View assigned service requests
- Accept/reject assignments
- View customer information
- View service details
- Diagnose problem
- Add repair notes
- Upload repair photos
- Create quotation
- Update service status
- Mark work as completed
- View service history
- View earnings/statistics

---

## Admin

Admin can:

- Login
- View dashboard
- Manage customers
- Manage technicians
- Manage service categories
- Manage services
- Manage service requests
- Assign technicians
- Manage payments
- Manage reviews
- View reports
- Manage system settings

---

# 8. Customer Service Flow

The main customer flow:

```text
Open Application
       ↓
Login / Register
       ↓
Home
       ↓
Choose Service
       ↓
Describe Problem
       ↓
Upload Photos
       ↓
Choose Address
       ↓
Choose Schedule
       ↓
Submit Request
       ↓
Waiting for Technician
       ↓
Technician Assigned
       ↓
Technician Diagnosis
       ↓
Quotation
       ↓
Customer Approves
       ↓
Repair
       ↓
Technician Completes
       ↓
Customer Confirmation
       ↓
Payment
       ↓
Rating & Review
       ↓
Completed
```

---

# 9. Service Categories

Create service categories such as:

```text
Smartphone
Laptop
Computer
Printer
Television
Home Appliance
Networking
Software
Other
```

Admin can add/edit/delete categories.

---

# 10. Service Catalog

Each category can contain multiple services.

Example:

```text
Laptop
 ├── Screen Replacement
 ├── Keyboard Replacement
 ├── Battery Replacement
 ├── SSD Upgrade
 ├── Windows Installation
 └── Laptop Cleaning
```

Service fields:

```text
id
category_id
name
slug
description
base_price
estimated_duration
is_active
image
created_at
updated_at
```

The `base_price` should be treated as an estimated starting price.

Final price may be determined after technician diagnosis.

---

# 11. Service Request

Customer creates a service request.

Fields:

```text
id
customer_id
service_id
technician_id
request_number
device_name
device_brand
device_model
problem_description
address
latitude
longitude
preferred_date
preferred_time
status
estimated_price
final_price
customer_notes
technician_notes
created_at
updated_at
```

---

# 12. Service Status

Use a controlled workflow.

Statuses:

```text
pending
confirmed
technician_assigned
technician_on_the_way
diagnosing
waiting_customer_approval
repairing
completed
cancelled
```

Flow:

```text
pending
   ↓
confirmed
   ↓
technician_assigned
   ↓
technician_on_the_way
   ↓
diagnosing
   ↓
waiting_customer_approval
   ↓
repairing
   ↓
completed
```

Cancellation can happen only under appropriate conditions.

The backend must validate status transitions.

Do not allow arbitrary status changes from the client.

---

# 13. Customer Request Screen

Android and Web should provide a service request form.

Fields:

- Service
- Device name
- Brand
- Model
- Problem description
- Address
- Preferred date
- Preferred time
- Additional notes
- Photos

Example:

```text
Service
[ Laptop Screen Replacement ]

Device
[ ASUS VivoBook ]

Problem
[ Screen has horizontal lines ]

Address
[ Customer address ]

Preferred Date
[ 20 September 2026 ]

Preferred Time
[ 13:00 ]

Photos
[ + Upload Photo ]

[ Submit Request ]
```

---

# 14. Image Upload

Customers should be able to upload photos showing the problem.

Examples:

- Broken screen
- Damaged device
- Error screen
- Physical damage

Store images securely using Laravel Storage.

Database table:

```text
service_request_images

id
service_request_id
path
type
created_at
updated_at
```

Validate:

- MIME type
- Maximum file size
- Image extension

Do not allow arbitrary file uploads.

---

# 15. Technician Assignment

Admin can assign technicians manually.

Possible future feature:

Automatic technician assignment based on:

- Category
- Skills
- Availability
- Distance
- Rating

For MVP, use manual assignment.

Admin screen:

```text
Service Request
       ↓
Select Technician
       ↓
Assign
```

Technician receives the request.

---

# 16. Technician Dashboard

Technician dashboard should show:

```text
Today's Jobs
Pending Requests
Active Repairs
Completed Jobs
Estimated Earnings
```

Also show:

- Upcoming jobs
- Recent jobs
- Current active service

---

# 17. Technician Profile

Technician profile:

```text
name
email
phone
profile_photo
bio
experience_years
service_area
is_available
rating
```

Technician skills should be managed separately.

---

# 18. Technician Skills

Create:

```text
technician_skills

id
technician_id
category_id
created_at
updated_at
```

Example:

```text
Technician A
 ├── Laptop
 ├── Computer
 └── Networking
```

---

# 19. Diagnosis

After technician arrives/receives the device, they can add diagnosis.

Fields:

```text
diagnosis
repair_notes
estimated_cost
estimated_duration
```

Technician submits diagnosis.

Status becomes:

```text
waiting_customer_approval
```

Customer receives the quotation.

---

# 20. Quotation

Create a quotation system.

Table:

```text
quotations

id
service_request_id
technician_id
subtotal
service_fee
discount
total
notes
status
created_at
updated_at
```

Quotation status:

```text
pending
approved
rejected
expired
```

Customer can:

```text
Approve
Reject
```

If rejected, service request may be cancelled or returned to admin for handling.

---

# 21. Quotation Items

Create:

```text
quotation_items

id
quotation_id
description
quantity
unit_price
subtotal
created_at
updated_at
```

Example:

```text
LCD Replacement
1 × Rp 750.000

Installation
1 × Rp 150.000

Cleaning
1 × Rp 50.000

------------------
Total Rp 950.000
```

This makes the project significantly more realistic than using a single final-price field.

---

# 22. Payment

For MVP, do not integrate real payment immediately.

Support:

```text
cash
bank_transfer_mock
e_wallet_mock
```

Payment table:

```text
payments

id
service_request_id
quotation_id
amount
method
status
paid_at
reference
created_at
updated_at
```

Statuses:

```text
pending
paid
failed
refunded
```

Architecture should allow a real payment gateway to be integrated later.

---

# 23. Customer Order/Service History

Customer can view previous service requests.

Display:

```text
#AF-20260912-0001

Laptop Screen Replacement

ASUS VivoBook

Rp 950.000

Status: Completed
```

Clicking opens detailed history.

---

# 24. Service Detail Page

Display:

- Request number
- Service
- Device
- Problem
- Photos
- Address
- Schedule
- Technician
- Diagnosis
- Quotation
- Payment
- Current status
- Timeline

---

# 25. Service Timeline

Create a visual timeline.

Example:

```text
✓ Request Submitted
│
✓ Technician Assigned
│
✓ Technician On The Way
│
✓ Diagnosis
│
✓ Quotation Approved
│
● Repairing
│
○ Completed
```

Status comes from backend.

---

# 26. Rating & Review

After completion, customer can rate technician.

Rating:

```text
1–5 stars
```

Review:

```text
comment
```

Table:

```text
reviews

id
service_request_id
customer_id
technician_id
rating
comment
created_at
updated_at
```

Prevent a customer from reviewing the same completed service multiple times.

---

# 27. Notification System

Implement application notifications.

Events:

- Service request created
- Technician assigned
- Technician accepts
- Technician is on the way
- Diagnosis completed
- Quotation created
- Quotation approved
- Repair completed
- Service cancelled

For MVP:

- Laravel database notifications
- Android polling or refresh-based notifications

Future:

- Firebase Cloud Messaging

---

# 28. Address Management

Customers can store multiple addresses.

Table:

```text
addresses

id
user_id
label
recipient_name
phone
address
city
postal_code
latitude
longitude
is_default
created_at
updated_at
```

Examples:

```text
Home
Office
Other
```

---

# 29. Admin Dashboard

Dashboard should contain:

```text
Total Customers
Total Technicians
Total Service Requests
Active Services
Completed Services
Cancelled Services
Total Revenue
```

Charts:

- Service requests by day
- Revenue by month
- Most requested categories
- Technician performance

---

# 30. Admin Customer Management

Admin can:

- View customers
- Search customers
- View customer details
- View service history
- Activate/deactivate accounts where appropriate

Admin cannot view plaintext passwords.

---

# 31. Admin Technician Management

Admin can:

- Create technician
- Edit technician
- Activate/deactivate technician
- Manage skills
- View technician jobs
- View ratings
- View performance

---

# 32. Admin Service Management

Admin can manage:

### Categories

```text
Create
Read
Update
Delete
```

### Services

```text
Create
Read
Update
Delete
Activate/Deactivate
```

---

# 33. Admin Service Request Management

Admin can:

- View all requests
- Filter by status
- Search request number
- View details
- Assign technician
- Change allowed statuses
- Cancel requests
- View quotation
- View payment

---

# 34. REST API

Authentication:

```http
POST /api/register
POST /api/login
POST /api/logout
GET  /api/me
PUT  /api/profile
```

---

## Service Categories

```http
GET /api/categories
GET /api/categories/{id}
```

Admin:

```http
POST   /api/admin/categories
PUT    /api/admin/categories/{id}
DELETE /api/admin/categories/{id}
```

---

## Services

```http
GET /api/services
GET /api/services/{id}
```

Support:

```http
GET /api/services?category_id=1
GET /api/services?search=laptop
```

Admin:

```http
POST   /api/admin/services
PUT    /api/admin/services/{id}
DELETE /api/admin/services/{id}
```

---

# 35. Customer Service Request API

```http
GET  /api/service-requests
GET  /api/service-requests/{id}
POST /api/service-requests
PUT  /api/service-requests/{id}/cancel
```

Customer must only be able to access their own requests.

---

# 36. Technician API

```http
GET /api/technician/requests
GET /api/technician/requests/{id}
PUT /api/technician/requests/{id}/accept
PUT /api/technician/requests/{id}/status
POST /api/technician/requests/{id}/diagnosis
POST /api/technician/requests/{id}/quotation
```

Technicians must only access requests assigned to them.

---

# 37. Quotation API

Customer:

```http
GET /api/service-requests/{id}/quotation
PUT /api/quotations/{id}/approve
PUT /api/quotations/{id}/reject
```

Technician:

```http
POST /api/service-requests/{id}/quotation
PUT /api/quotations/{id}
```

---

# 38. Payment API

```http
GET  /api/service-requests/{id}/payment
POST /api/payments
```

Admin:

```http
GET /api/admin/payments
PUT /api/admin/payments/{id}/status
```

---

# 39. Review API

```http
POST /api/service-requests/{id}/review
GET  /api/technicians/{id}/reviews
```

---

# 40. API Response Format

Use consistent responses.

Success:

```json
{
    "success": true,
    "message": "Service request created successfully",
    "data": {}
}
```

Error:

```json
{
    "success": false,
    "message": "Validation failed",
    "errors": {
        "problem_description": [
            "The problem description field is required."
        ]
    }
}
```

Use appropriate HTTP status codes.

---

# 41. Database Structure

Required tables:

```text
users
categories
services
addresses
technician_skills
service_requests
service_request_images
quotations
quotation_items
payments
reviews
notifications
```

Potential additional tables:

```text
service_status_histories
settings
```

---

# 42. Service Status History

Create a history table.

```text
service_status_histories

id
service_request_id
status
changed_by
notes
created_at
updated_at
```

Every important status change should create a history record.

This allows the application to display:

```text
12 Sep 2026 09:20
Request submitted

12 Sep 2026 10:10
Technician assigned

12 Sep 2026 12:30
Technician on the way

12 Sep 2026 13:15
Diagnosing

12 Sep 2026 14:00
Quotation created
```

This is an important portfolio feature because it demonstrates proper audit/history design.

---

# 43. Database Relationships

Main relationships:

```text
User
 ├── hasMany Addresses
 ├── hasMany ServiceRequests
 ├── hasMany Reviews
 └── hasMany Notifications

Category
 ├── hasMany Services
 └── hasMany TechnicianSkills

Service
 ├── belongsTo Category
 └── hasMany ServiceRequests

ServiceRequest
 ├── belongsTo Customer
 ├── belongsTo Technician
 ├── belongsTo Service
 ├── hasMany Images
 ├── hasMany StatusHistories
 ├── hasOne Quotation
 ├── hasOne Payment
 └── hasOne Review

Quotation
 ├── belongsTo ServiceRequest
 ├── belongsTo Technician
 └── hasMany QuotationItems

Technician
 ├── hasMany ServiceRequests
 ├── hasMany Skills
 └── hasMany Reviews
```

---

# 44. Authentication & Authorization

Use Laravel Sanctum.

Use role-based authorization.

Roles:

```text
customer
technician
admin
```

Implement Laravel Policies for ownership checks.

Examples:

Customer:

```text
Can only view own service requests.
```

Technician:

```text
Can only access assigned requests.
```

Admin:

```text
Can access all management resources.
```

Never rely only on Android UI restrictions.

All authorization must be enforced on the backend.

---

# 45. Security Requirements

Implement:

- Password hashing
- Sanctum authentication
- Request validation
- Authorization policies
- Role middleware
- File upload validation
- Rate limiting
- CSRF protection for web
- Mass assignment protection
- Database transactions
- Secure error handling
- No sensitive data in API responses

Never trust:

- Client price
- Client role
- Client user ID
- Client service status
- Client technician ID

Validate all important business rules server-side.

---

# 46. Android Screens

Minimum customer screens:

```text
Splash
Login
Register
Home
Categories
Service List
Service Detail
Create Request
Address Selection
Request Summary
My Requests
Request Detail
Quotation
Payment
Service Tracking
Review
Profile
Notifications
```

---

# 47. Android Home

Example:

```text
Hello, User 👋

How can we help you?

[ Search service ]

Categories

[Phone] [Laptop] [TV] [Printer]

Popular Services

┌──────────────────┐
│ Laptop Repair    │
│ Starting Rp ...  │
└──────────────────┘

Active Service

┌──────────────────┐
│ #AF-20260912-001 │
│ Diagnosing       │
└──────────────────┘
```

---

# 48. Android Bottom Navigation

Use:

```text
Home
Services
Requests
Notifications
Profile
```

Cart is not required because this is a service-booking application rather than a product marketplace.

---

# 49. Android Request Detail

Display:

```text
#AF-20260912-001

Laptop Screen Replacement

ASUS VivoBook

Problem:
Screen has horizontal lines.

Technician:
John Technician

Status:
Diagnosing

Timeline:
✓ Submitted
✓ Assigned
● Diagnosing
○ Repairing
○ Completed
```

If quotation is available:

```text
Quotation

Parts       Rp 750.000
Service     Rp 150.000
Total       Rp 900.000

[ Approve ]
[ Reject ]
```

---

# 50. Web Customer Portal

Customer web should provide the same essential capabilities as Android.

Pages:

```text
/
 /login
 /register
 /services
 /services/{id}
 /requests
 /requests/create
 /requests/{id}
 /profile
 /notifications
```

The web and Android application should use the same business logic and API where practical.

---

# 51. Technician Web Portal

Pages:

```text
/technician/dashboard
/technician/requests
/technician/requests/{id}
/technician/profile
/technician/skills
/technician/earnings
```

---

# 52. Admin Routes

```text
/admin/dashboard
/admin/customers
/admin/technicians
/admin/categories
/admin/services
/admin/service-requests
/admin/quotations
/admin/payments
/admin/reviews
/admin/reports
/settings
```

Protect all routes using authentication and authorization middleware.

---

# 53. UI Design

The application should have a consistent brand identity.

Brand:

```text
Name: AnyFix Service
```

Visual direction:

- Modern
- Professional
- Clean
- Technology/service-oriented
- Trustworthy
- Mobile-first
- Responsive

Use consistent:

- Typography
- Spacing
- Buttons
- Cards
- Form controls
- Status badges
- Icons

Status colors should be consistent across Android and Web.

---

# 54. Loading / Empty / Error States

Every API screen must handle:

```text
Loading
Success
Empty
Error
```

Examples:

```text
No active service requests.

No notifications.

Unable to connect to server.
[Retry]
```

Never show an empty blank screen.

---

# 55. Offline / Network Handling

Android should gracefully handle:

- No internet
- Timeout
- Server unavailable
- Expired token
- HTTP 401
- HTTP 403
- HTTP 404
- HTTP 422
- HTTP 500

When receiving 401:

```text
Clear authentication state
↓
Redirect to Login
```

---

# 56. Image Optimization

Food-ordering style product images are not relevant here.

Instead optimize:

- Device problem images
- Technician profile photos
- Service category images

Use appropriate image compression and dimensions.

Do not upload original huge camera files unnecessarily.

---

# 57. Notifications

Implement Laravel notifications.

Notification examples:

```text
Your service request has been created.

A technician has been assigned.

Your technician is on the way.

Your quotation is ready.

Your quotation has been approved.

Your service has been completed.
```

Android should display notification list.

Future enhancement:

```text
Firebase Cloud Messaging
```

---

# 58. Dashboard Analytics

Admin dashboard should calculate real data.

Examples:

```text
Service Requests Today
Completed This Month
Revenue This Month
Active Technicians
Average Rating
```

Charts:

```text
Requests by Day
Revenue by Month
Services by Category
Technician Performance
```

---

# 59. Testing

Backend feature tests:

### Authentication

- Register
- Login
- Logout
- Invalid credentials
- Unauthorized API access

### Authorization

- Customer cannot access another customer's request
- Technician cannot access another technician's request
- Customer cannot access admin endpoints
- Technician cannot access admin endpoints

### Service Requests

- Create request
- Validate required fields
- Upload image
- Assign technician
- Update status

### Quotation

- Technician creates quotation
- Customer approves quotation
- Customer rejects quotation
- Unauthorized quotation access

### Payment

- Create payment
- Payment status
- Authorization

### Reviews

- Customer can review completed service
- Cannot review incomplete service
- Cannot submit duplicate review

---

# 60. Database Transactions

Use transactions for important operations.

Example:

Creating a service request:

```text
Validate request
 ↓
Create service request
 ↓
Store uploaded images
 ↓
Create initial status history
 ↓
Create notification
 ↓
Commit
```

Quotation:

```text
Create quotation
 ↓
Create quotation items
 ↓
Calculate total
 ↓
Create notification
 ↓
Commit
```

---

# 61. API Documentation

Document every endpoint.

For each endpoint document:

```text
Method
URL
Authentication
Role
Request parameters
Request body
Response
Validation
Possible errors
```

Example:

```text
POST /api/service-requests

Role:
customer

Request:

{
    "service_id": 1,
    "device_name": "Laptop",
    "device_brand": "ASUS",
    "device_model": "VivoBook",
    "problem_description": "Screen has horizontal lines",
    "address_id": 2,
    "preferred_date": "2026-09-20",
    "preferred_time": "13:00",
    "customer_notes": "Please call before arriving"
}
```

---

# 62. Environment Configuration

Use:

```text
.env
.env.example
```

Never commit:

```text
.env
database credentials
API secrets
production credentials
private keys
```

---

# 63. Repository Structure

Use a monorepo:

```text
anyfix-service/
│
├── backend/
│   └── Laravel
│
├── android/
│   └── Android project
│
├── docs/
│   ├── architecture/
│   ├── api/
│   ├── database/
│   └── screenshots/
│
├── README.md
└── .gitignore
```

---

# 64. Documentation

README must include:

```text
# AnyFix Service

## Overview

## Features

## Architecture

## Technology Stack

## User Roles

## Database Design

## ERD

## API Documentation

## Installation

## Backend Setup

## Android Setup

## Environment Variables

## Demo Accounts

## Screenshots

## Project Structure

## Testing

## Future Improvements
```

---

# 65. ERD

Create a proper ERD showing:

```text
users
   │
   ├── addresses
   │
   ├── service_requests
   │        │
   │        ├── service_request_images
   │        ├── service_status_histories
   │        ├── quotations
   │        │       └── quotation_items
   │        ├── payments
   │        └── reviews
   │
   └── notifications

categories
   │
   ├── services
   │
   └── technician_skills
```

The ERD should be included in the GitHub documentation.

---

# 66. Seed Data

Create realistic seed data.

Categories:

```text
Smartphone
Laptop
Computer
Printer
TV
Home Appliance
Networking
Software
```

Services:

```text
Screen Replacement
Battery Replacement
Keyboard Replacement
SSD Upgrade
Windows Installation
Laptop Cleaning
Virus Removal
Printer Repair
TV Repair
Wi-Fi Troubleshooting
```

Create:

```text
1 admin
3 technicians
5 customers
15+ services
```

Use realistic data.

---

# 67. Demo Accounts

Provide development/demo accounts.

Example:

```text
Admin
admin@example.com

Technician
technician@example.com

Customer
customer@example.com
```

Passwords must be documented only for development/demo purposes and must not be used as production credentials.

---

# 68. Development Phases

Do not implement the entire project at once.

Follow these phases.

## Phase 1 — Project Setup

Backend:

- Create Laravel project
- Configure MySQL
- Configure Sanctum
- Configure storage
- Configure API
- Configure authentication

Android:

- Create project
- Configure Kotlin
- Configure Retrofit
- Configure navigation
- Create base architecture

Web:

- Create layouts
- Configure Tailwind
- Create authentication foundation

---

## Phase 2 — Database

Create migrations/models for:

```text
users
categories
services
addresses
technician_skills
service_requests
service_request_images
quotations
quotation_items
payments
reviews
notifications
service_status_histories
```

Create relationships.

Create seeders.

---

## Phase 3 — Authentication

Implement:

```text
Register
Login
Logout
Current User
Role system
Sanctum
Policies
```

Test all roles.

---

## Phase 4 — Service Catalog

Implement:

```text
Categories
Services
Search
Filtering
Pagination
```

Create Android service browsing.

Create web service browsing.

---

## Phase 5 — Customer Service Request

Implement:

```text
Create request
Address
Schedule
Problem description
Image upload
Request history
```

Android:

```text
Create Request UI
Request Detail
Request List
```

Web:

```text
Create Request
Request List
Request Detail
```

---

## Phase 6 — Technician

Implement:

```text
Technician profile
Skills
Availability
Assigned requests
Accept request
Status update
Diagnosis
Repair notes
```

Create technician web portal and Android support if desired.

---

## Phase 7 — Quotation

Implement:

```text
Quotation
Quotation Items
Approve
Reject
Price calculation
Notifications
```

Customer can review quotation from Android/Web.

---

## Phase 8 — Payment

Implement mock payment system:

```text
Create payment
Payment status
Payment history
```

Do not integrate real payment gateway yet.

---

## Phase 9 — Admin Dashboard

Implement:

```text
Dashboard
Customers
Technicians
Categories
Services
Service Requests
Assignments
Payments
Reviews
Reports
```

---

## Phase 10 — Notifications

Implement:

```text
Database notifications
Notification list
Unread count
```

Optional later:

```text
Firebase Cloud Messaging
```

---

## Phase 11 — Rating & Review

Implement:

```text
Rating
Review
Technician average rating
Admin moderation
```

---

## Phase 12 — Testing

Implement:

- Feature tests
- Authorization tests
- Validation tests
- Request tests
- Quotation tests
- Payment tests
- Review tests

---

## Phase 13 — UI Polish

Improve:

- Responsive layout
- Android UI
- Animations
- Empty states
- Error states
- Loading states
- Status timeline
- Dashboard charts
- Form UX

---

## Phase 14 — Documentation

Create:

```text
README
ERD
Architecture diagram
API documentation
Screenshots
Installation guide
Demo credentials
Testing documentation
```

---

# 69. Future Features

Do not implement these during MVP unless explicitly requested.

Future possibilities:

- Firebase push notifications
- Google Maps integration
- Technician live location
- Real-time chat
- WebSocket
- Real payment gateway
- Midtrans
- Xendit
- WhatsApp notification
- Email notification
- Promo codes
- Subscription
- Warranty management
- Spare-part inventory
- Technician scheduling
- Automatic technician assignment
- Multi-branch support
- Multi-company support
- Customer loyalty
- AI-powered troubleshooting
- AI service recommendations
- AI estimated repair diagnosis

---

# 70. Portfolio Quality Requirements

This project must not look like a basic CRUD tutorial.

It should demonstrate real software engineering concepts:

```text
Authentication
Authorization
REST API
Role-based access
Database relationships
Transactions
Validation
File upload
Status workflow
Audit history
Quotation system
Payment abstraction
Notification system
Testing
Documentation
```

The GitHub repository should make it obvious that this is a full-stack system.

---

# 71. Definition of Done

The MVP is complete when:

### Backend

- Laravel runs successfully
- MySQL works
- Sanctum works
- Authentication works
- Role authorization works
- Service catalog works
- Service request works
- Image upload works
- Technician assignment works
- Diagnosis works
- Quotation works
- Customer approval works
- Payment mock works
- Status history works
- Review works
- Notifications work
- API documentation exists
- Tests pass

### Android

- Login works
- Register works
- Home works
- Service catalog works
- Search works
- Create service request works
- Image upload works
- Request history works
- Request detail works
- Status tracking works
- Quotation approval works
- Payment works
- Review works
- Profile works
- Notifications work

### Web

- Customer portal works
- Technician portal works
- Admin dashboard works
- Service management works
- Customer management works
- Technician management works
- Request management works
- Quotation management works
- Payment management works
- Review management works
- Dashboard statistics work

---

# 72. Agent Development Instructions

Act as a senior full-stack engineer.

Read the entire specification before coding.

Do not generate the entire project blindly in one operation.

Work incrementally.

For every phase:

1. Inspect the existing project.
2. Understand what is already implemented.
3. Do not duplicate existing functionality.
4. Plan the current phase.
5. Implement only the current phase.
6. Run relevant tests/build checks.
7. Fix errors.
8. Verify functionality.
9. Summarize changes.
10. Wait for approval before moving to a major new phase.

Prioritize:

```text
Security
↓
Data integrity
↓
Correctness
↓
Maintainability
↓
Performance
↓
UI/UX
```

Never trust client-provided:

```text
role
user_id
technician_id
price
status
payment status
```

Validate everything on the backend.

Use database transactions for multi-step business operations.

Use Laravel Policies and Middleware for authorization.

Keep controllers thin.

Use:

```text
Form Requests
Services
Policies
Resources
Repositories only when actually useful
```

Do not over-engineer the project.

Avoid unnecessary packages.

Prefer Laravel's built-in features when appropriate.

For Android:

- Keep UI separate from data access.
- Use ViewModels.
- Use repositories.
- Handle loading/error/success states.
- Store authentication securely.
- Do not hardcode API credentials.
- Do not put business logic inside UI components.

Before adding a dependency, verify that it is necessary.

---

# 73. Phase Completion Report

At the end of every development phase, report:

```text
Phase:
[Phase Name]

Completed:
- ...
- ...
- ...

Files Created:
- ...

Files Modified:
- ...

Database Changes:
- ...

API Changes:
- ...

Android Changes:
- ...

Web Changes:
- ...

Tests:
- ...

Build Status:
- ...

Known Issues:
- ...

Next Recommended Phase:
- ...
```

Do not claim a feature is complete unless it has actually been implemented and verified.

---

# 74. Final Goal

The final application should feel like a real service platform:

```text
Customer
   ↓
Android / Web
   ↓
Laravel REST API
   ↓
Business Logic
   ↓
MySQL
   ↓
Technician / Admin
```

AnyFix Service should be portfolio-ready and demonstrate the ability to build a complete application across:

```text
Android
Laravel
REST API
MySQL
Web Development
Authentication
Authorization
File Upload
Workflow Management
Payment Architecture
Notifications
Testing
Documentation
```

The project should be designed for future expansion without requiring a complete rewrite.