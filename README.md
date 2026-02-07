# Eindhoven Cycling Tours — Booking MVP

Laravel-based booking platform for Eindhoven Cycling Tours.
Focus: simple public booking flow + admin tooling + upfront payments.

## Stack
- Laravel (PHP 8.2+)
- MySQL/MariaDB
- Blade + Tailwind (or simple CSS)
- Filament (admin panel)
- Stripe Checkout + Webhooks (payments)
- SMTP (emails)
- Storage: public disk for uploads (post-MVP: optimization)

## MVP Features
Public:
- Tours overview + tour detail pages
- Variants (duration/pricing)
- Slot availability listing
- Booking flow (select slot → people → checkout)
- Stripe payment success/cancel pages
- Contact form + basic gallery page
- Impressions page

Admin (Filament):
- CRUD Tours / Variants / Slots
- Media library + attach images (cover/gallery/site_gallery)
- Booking overview + filters (confirmed/canceled/pending)

## Domain Rules (MVP)
- Slots belong to a Tour Variant (date/time + capacity)
- Booking cutoff (no bookings within X hours of start)
- Cancellation cutoff (refund policy, MVP: manual)
- Upfront payment required; booking becomes confirmed after payment webhook

## Local Setup
```bash
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate --seed
php artisan serve
````

## Stripe Setup (local)

Required env vars:

* STRIPE_KEY=
* STRIPE_SECRET=
* STRIPE_WEBHOOK_SECRET=

See: docs/stripe.md

## Docs

* System design: docs/architecture.md
* Domain model & rules: docs/domain.md
* Stripe integration: docs/stripe.md
* Deployment checklist: docs/deployment.md
* Ops runbook: docs/runbook.md

## Roadmap

MVP:

* End-to-end booking flow with Stripe confirmations
* Admin tooling (Filament) for tours, slots, bookings, media

Post-MVP:

* Calendar month view
* Self-service cancellation + automatic refunds (before cutoff)
* Discount codes
* Multi-language EN/NL
* Image optimization

````

