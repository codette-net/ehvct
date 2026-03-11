
# TODO — Eindhoven Cycling Tours (Laravel + Filament + Mollie) MVP

## 0) Repo + baseline

* [x] Create Laravel app + Git repo
* [x] Configure .env: APP_URL, DB, timezone (Europe/Amsterdam), locale (en)
* [x] Storage: public disk + `storage:link`
* [x] Filament assets publishing working (no vendor view overrides)

## 1) Stack overview (README)

* [x] Laravel (PHP 8.2+)
* [x] DB: MySQL/MariaDB
* [x] Frontend: Blade + Tailwind v3 + daisyUI
* [x] Admin: Filament Panel (single operator)
* [x] Payments: Mollie Checkout + Webhooks
* [x] Mail: SMTP (Postmark/Mailgun/SES or simple SMTP)
* [ ] Cron/queue: MVP can run sync, later queue + cron cleanup

## 2) Public site
- [x] Tours overview (cards)
    - [x] cover image
    - [x] "starting from" (min variant price)
- [x] Tour detail:
    - [x] variants list
    - [x] upcoming slots per variant
    - [x] booking CTA -> booking form
- [x] Booking flow (slot -> people -> details -> Mollie -> return)
- [x] Payment success page
- [ ] Payment cancel/fail page (nice UX)
- [x] Contact page + contact form
- [ ] Impressions page (site gallery)

### Booking rules

* [x] Host creates Slots per TourVariant
* [x] Slot has min/max participants
* [x] Booking cutoff hours (no booking within X hours)
* [x] Cancellation cutoff hours (refund allowed only until X hours)
* [x] Upfront payment required (no-show = paid)

## 3) Data model

### Content

* [x] Tour
* [x] TourVariant
* [x] Media
* [x] Mediables pivot (role + sort_order) + working attach UI
* 

### Booking/Payments (MVP)

* [x] Slot

    * [x] tour_variant_id
    * [x] starts_at (datetime)
    * [x] min_people, max_people
    * [x] booking_cutoff_hours, cancel_cutoff_hours
    * [x] status (active|canceled)
* [x] Booking

    * [x] slot_id
    * [x] name, email, phone (optional)
    * [x] people_count
    * [x] unit_price_cents, total_amount_cents, currency
    * [x] status (pending|paid|confirmed|canceled|expired|failed)
    * [x] paid_at, confirmed_at, canceled_at (nullable datetimes)
* [x] Payment

    * [x] booking_id
    * [x] provider (mollie)
    * [x] provider_payment_id (Mollie payment id)
    * [x] provider_status (open|paid|failed|canceled|expired|refunded)
    * [x] amount_cents, currency
    * [x] webhook_payload (json) optional (debug)
    * [x] paid_at (nullable)

## 4) Admin/CMS (Filament)

* [x] MediaResource (upload + fields)
* [x] TourResource
* [x] Variants relation manager
* [x] Media attach relation manager
* [x] Slots

    * [x] SlotsRelationManager (CRUD starts_at, capacity, cutoffs, status)
    * [x] Occupancy display: confirmed seats / max
* [ ] BookingResource

    * [x] list + filters (pending/paid/confirmed/canceled/expired)
    * [x] show: customer + slot + payment status
    * [x] actions: cancel (manual), mark as refunded (MVP note), resend email (optional)
    * [x] Admin cancel action sends email to customer + logs reason
* [ ] PaymentResource (optional)

    * [ ] mostly read-only, link to booking, show Mollie id/status

## 5) Public booking flow

* [x] Slot list page (per tour or variant) showing next X upcoming slots
* [x] Booking form:

    * [x] validate min/max people
    * [x] enforce booking cutoff
* [x] Create Booking (pending) + create Mollie payment
* [x] Redirect to Mollie checkout
* [x] Webhook updates booking/payment state
* [x] “Thank you” page shows booking reference

## 6) Mollie payments

* [x] Mollie API key in env
* [x] Webhook endpoint reachable on preview/prod
* [x] CSRF excluded for /webhooks/mollie
* [x] Webhook updates Payment + Booking state
* [x] Create payment:

    * [x] amount = people_count * price_per_person
    * [x] metadata includes booking_id
    * [x] redirectUrl = success route with booking reference
    * [x] webhookUrl = webhook route

    * [x] Idempotency guard (no double email / no double confirm)
    * [ ] Pending cleanup job (expire pending older than N minutes) + cron

## 7) Emails (MVP)
- [x] Booking confirmation email on confirmed
- [x] Admin notification email on confirmed
- [x] Improve email template (HTML + clean text fallback)
- [ ] Add booking policy snippet (cutoff times)
- [ ] Add “Manage booking” section (cancel request link)

## 8) Cancellation (MVP)
- [x] Cancel request page (reference link)
- [x] Signed cancel link (temporarySignedRoute)
- [ ] Cutoff rules shown + enforced
- [x] Admin gets cancel request email
- [ ] (Optional) store cancel_request row in DB

## 9) Reliability / security

* [ ] Prevent overbooking (transaction + row locking on slot)
* [ ] Rate limit booking + webhook
* [ ] Logs for webhook + payment transitions
* [ ] Backups

---

## 10) Testing checklist
- [x] Paid -> confirmed via webhook
- [x] Webhook retry does not duplicate emails
- [ ] Checkout canceled -> booking canceled/failed
- [ ] Expired -> booking expired
- [ ] Concurrent booking doesn’t exceed capacity
- [ ] Booking cutoff blocks booking
- [ ] Cancel cutoff messaging correct

## 11) Nice-to-haves (post-MVP)
- [ ] Proper calendar month UI
- [ ] Self-service cancel link (before cutoff) + automated refund
- [ ] Reschedule booking
- [ ] Discount codes
- [ ] Multi-language EN/NL
- [ ] iCal/Google Calendar links
- [ ] Image optimization + thumbnails
