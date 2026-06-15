# Covenant

Covenant is a Laravel and Blade contract lifecycle management platform for storing agreements, tracking renewal dates, monitoring contract expiry, managing contract categories and organizing contractual documents from a clean dashboard.

The project is designed as a focused business software MVP. It demonstrates Laravel authentication, Blade UI, CRUD workflows, file uploads, validation, Eloquent relationships, dashboard metrics, lifecycle logic, responsive layouts and shared-hosting-friendly deployment.

---

## Features

### Authentication

- User registration
- User login
- Password reset
- Password confirmation
- Email verification views
- Profile update
- Password update
- Account deletion
- Custom Covenant-styled auth screens
- Custom Covenant-styled settings page

### Contract Management

- Create contracts
- View contracts
- Edit contracts
- Delete contracts
- Upload contract documents
- Replace uploaded contract documents
- Delete stored files when contracts are deleted
- View contract details
- Download attached contract documents

### Contract Tracking

- Contract title
- Counterparty
- Category
- Contract value
- Start date
- End date
- Renewal date
- Description
- Attached document
- Automatic lifecycle status

### Lifecycle Status

Covenant automatically calculates contract status from the contract end date:

- `Active` — contract is valid and not close to expiry
- `Expiring` — contract ends within 30 days
- `Expired` — contract end date has passed

### Renewal Tracking

- Renewal countdown badges
- Renewal status on contract detail pages
- Upcoming renewals dashboard section

Examples:

```txt
Renews today
Renews tomorrow
Renews in 14 days
Renewal passed 8 days ago
No renewal date