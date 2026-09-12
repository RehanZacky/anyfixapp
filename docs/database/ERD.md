# AnyFix Service — Entity Relationship Diagram (ERD)

Dokumentasi rancangan relasi database AnyFix Service Platform (MySQL).

## Diagram Relasi (Mermaid ERD)

```mermaid
erDiagram
    users ||--o{ addresses : "has many"
    users ||--o{ technician_skills : "has many (technician)"
    users ||--o{ service_requests : "creates (customer)"
    users ||--o{ service_requests : "assigned to (technician)"
    users ||--o{ quotations : "creates (technician)"
    users ||--o{ reviews : "writes (customer)"
    users ||--o{ reviews : "receives (technician)"
    users ||--o{ service_status_histories : "changes status"

    categories ||--o{ services : "contains"
    categories ||--o{ technician_skills : "assigned to"

    services ||--o{ service_requests : "requested for"

    addresses ||--o{ service_requests : "service location"

    service_requests ||--o{ service_request_images : "has photos"
    service_requests ||--o{ service_status_histories : "tracks timeline"
    service_requests ||--o| quotations : "has quotation"
    service_requests ||--o| payments : "has payment"
    service_requests ||--o| reviews : "has review"

    quotations ||--o{ quotation_items : "itemized breakdown"
    quotations ||--o| payments : "settles"

    users {
        bigint id PK
        string name
        string email UK
        string password
        enum role "customer, technician, admin"
        string phone
        string profile_photo
        text bio
        int experience_years
        string service_area
        boolean is_available
        boolean is_active
        decimal rating
        datetime created_at
    }

    categories {
        bigint id PK
        string name
        string slug UK
        text description
        string icon
        boolean is_active
    }

    services {
        bigint id PK
        bigint category_id FK
        string name
        string slug UK
        text description
        decimal base_price
        string estimated_duration
        boolean is_active
    }

    addresses {
        bigint id PK
        bigint user_id FK
        string label
        string recipient_name
        string phone
        text address
        string city
        string postal_code
        decimal latitude
        decimal longitude
        boolean is_default
    }

    service_requests {
        bigint id PK
        string request_number UK
        bigint customer_id FK
        bigint service_id FK
        bigint technician_id FK
        bigint address_id FK
        string device_name
        string device_brand
        string device_model
        text problem_description
        text address
        date preferred_date
        string preferred_time
        enum status "pending, confirmed, technician_assigned, technician_on_the_way, diagnosing, waiting_customer_approval, repairing, completed, cancelled"
        decimal estimated_price
        decimal final_price
    }

    quotations {
        bigint id PK
        bigint service_request_id FK
        bigint technician_id FK
        decimal subtotal
        decimal service_fee
        decimal discount
        decimal total
        enum status "pending, approved, rejected, expired"
    }

    quotation_items {
        bigint id PK
        bigint quotation_id FK
        string description
        int quantity
        decimal unit_price
        decimal subtotal
    }

    payments {
        bigint id PK
        bigint service_request_id FK
        bigint quotation_id FK
        decimal amount
        enum method "cash, bank_transfer_mock, e_wallet_mock"
        enum status "pending, paid, failed, refunded"
        string reference
        datetime paid_at
    }

    reviews {
        bigint id PK
        bigint service_request_id UK_FK
        bigint customer_id FK
        bigint technician_id FK
        tinyint rating "1-5"
        text comment
    }

    service_status_histories {
        bigint id PK
        bigint service_request_id FK
        string status
        bigint changed_by FK
        text notes
    }
```
