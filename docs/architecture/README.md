# AnyFix Architecture

Dokumentasi arsitektur platform AnyFix Service.
Arsitektur multi-tier:
- Customer & Technician Web Portal (Laravel Blade + Tailwind CSS + Alpine.js)
- Laravel REST API Backend (Laravel Sanctum, Policies, Form Requests)
- MySQL Database
- Android Application (Retrofit, MVVM, Coroutines - terpisah)
