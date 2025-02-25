# InnolabAMS

> **A Cloud-based Admission Management System for Elementary and Junior High School Institutions**

## Vision

InnolabAMS transforms traditional admission processes into streamlined, data-driven workflows. We eliminate manual errors, reduce processing time, and provide actionable insights through analytics.

## Project Overview

|  Feature   |  Description  |
|------------|---------------|
| **Cloud Infrastructure** | Built on AWS for reliability and scalability |
| **Analytics Engine** | Power BI integration for comprehensive reporting |
| **Multi-tenant Architecture** | Supporting multiple school deployments |
| **SaaS Model** | Cost-effective, subscription-based access |
| **Laravel Foundation** | Modern framework for robust applications |

## Core Modules

### 📋 Application Management
Centralized portal for processing student applications with document verification, status tracking, and automated notifications.

### 🔍 Inquiry Handling
Manage prospective student inquiries with organized response workflows and conversion tracking.

### 🏆 Scholarship Processing
Streamlined scholarship application review with customizable criteria and automated award management.

### 📊 Analytics Dashboard
Real-time insights into admission trends, conversion rates, and performance metrics for data-driven decisions.

### 👤 User Administration
Role-based access control for administrators and staff with comprehensive security policies.

## Technology Architecture

```ascii
┌───────────────────┐     ┌───────────────────┐     ┌───────────────────┐
│   Presentation    │     │     Business      │     │       Data        │
│       Layer       │◄────┤       Layer       │◄────┤       Layer       │
└───────────────────┘     └───────────────────┘     └───────────────────┘
     │                           │                          │
     ▼                           ▼                          ▼
┌─────────────┐          ┌─────────────┐             ┌─────────────┐
│  Tailwind   │          │   Laravel   │             │    MySQL    │
│  Alpine.js  │          │  Services   │             │  Migrations │
│    Blade    │          │ Controllers │             │    Models   │
└─────────────┘          └─────────────┘             └─────────────┘
```

## Development Team

Team INNOLAB from Asia Pacific College:
* **James Albert David** - *Project Leader & Full Stack Developer*
* **Reycel John Emmanuel Carcueva** - *Full Stack Developer*
* **Reejay Salinas** - *Full Stack Developer*
* **Althea Noelle Sarmiento** - *Database Engineer & Full Stack Developer*

## Installation Guide

### Prerequisites
* Docker and Docker Compose
* Git

### Setup Instructions

1. **Clone the repository**
   ```bash
   git clone https://github.com/APC-SoCIT/APC-2024-2025-T1-05-Admission-Management-System
   cd InnolabAMS
   ```

2. **Start Docker containers**
   ```bash
   docker compose up -d --build  
   docker compose exec phpmyadmin chmod 777 /sessions
   ```

3. **Configure Permissions**
   ```bash
   docker exec php bash
   chown -R www-data:www-data /var/www/storage/ /var/www/boostrap/cache
   chmod -R 775 /var/www/storage /var/www/boostrap/cache
   composer setup  
   php artisan config:clear
   exit
   ```

4. **Setup database and mail**
   ```bash
   docker compose exec php bash 
   php artisan migrate:refresh
   php artisan db:seed --class=Roleseeder
   php artisan config:clear
   exit
   ```

5. **Configure email settings and modify your .env file with following mail settings:**
   ```bash
   MAIL_MAILER=smtp 
   MAIL_HOST=smtp.gmail.com
   MAIL_PORT=465
   MAIL_USERNAME=innolabdevelopers@gmail.com
   MAIL_PASSWORD=sgwmfhizwchayyim
   MAIL_ENCRYPTION=ssl
   MAIL_FROM_ADDRESS="innolabdevelopers@gmail.com"
   MAIL_FROM_NAME="${APP_NAME}"
   ```

### Default Accounts

Use these seeded accounts to access the system:

| Role | Email | Password |
|------|-------|----------|
| Admin | admin@example.com | password |
| Staff | staff@example.com | password |
| Applicant | applicant@example.com | password |

## Security Implementation

* Data Privacy Act (RA 10173) compliant
* Role-based access control matrix
* Two-factor authentication support
* Data encryption in transit and at rest
* Comprehensive audit logs

## Project Roadmap

| Phase | Timeframe | Focus Areas |
|-------|-----------|-------------|
| 1 | Q2 2024 | Core system architecture, user management, basic workflows |
| 2 | Q3 2024 | Application processing, document management, notifications |
| 3 | Q4 2024 | Analytics integration, reporting modules, dashboards |
| 4 | Q1 2025 | Multi-tenancy, SaaS deployment, system optimization |

## License

Educational project developed at Asia Pacific College, 2024-2025.


   


