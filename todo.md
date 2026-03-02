Here’s an updated **TODO** (switching to **Mollie** and reflecting what you’ve already finished), plus a **concrete next-steps plan** to build the booking + payment models/resources.

---

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
* [ ] Payments: Mollie Checkout + Webhooks
* [ ] Mail: SMTP (Postmark/Mailgun/SES or simple SMTP)
* [ ] Cron/queue: MVP can run sync, later queue + cron cleanup

## 2) MVP scope

### Public site

* [x] Basic layout + nav
* [ ] Tours overview (list)
* [ ] Tour detail:

    * [ ] cover + gallery images
    * [ ] variants (duration/prices)
    * [ ] upcoming availability (slots list)
* [x] Booking flow (slot -> people -> details -> pay)
* [ ] Payment success/cancel pages
* [ ] Contact form
* [ ] Impressions page (site gallery)

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
* [ ] Slots under TourVariant:

    * [ ] SlotsRelationManager (CRUD starts_at, capacity, cutoffs, status)
    * [ ] Occupancy display: confirmed seats / max
* [ ] BookingResource

    * [ ] list + filters (pending/paid/confirmed/canceled/expired)
    * [ ] show: customer + slot + payment status
    * [ ] actions: cancel (manual), mark as refunded (MVP note), resend email (optional)
* [ ] PaymentResource (optional)

    * [ ] mostly read-only, link to booking, show Mollie id/status

## 5) Public booking flow

* [x] Slot list page (per tour or variant) showing next X upcoming slots
* [x] Booking form:

    * [x] validate min/max people
    * [x] enforce booking cutoff
* [x] Create Booking (pending) + create Mollie payment
* [x] Redirect to Mollie checkout
* [ ] Webhook updates booking/payment state
* [x] “Thank you” page shows booking reference

## 6) Mollie payments

* [x] Mollie API key in env
* [x] Create payment:

    * [ ] amount = people_count * price_per_person
    * [ ] metadata includes booking_id
    * [ ] redirectUrl = success route with booking reference
    * [ ] webhookUrl = webhook route
* [ ] Webhook handler:

    * [ ] fetch payment from Mollie (don’t trust request blindly)
    * [ ] update Payment + Booking status
    * [ ] on paid: confirm booking + lock seats
* [ ] Expire pending bookings (cron):

    * [ ] pending > N minutes -> expired (release seat hold if implemented)

## 7) Emails (MVP)

* [ ] Booking confirmation (after paid/confirmed)
* [ ] Admin notification on new confirmed booking

## 8) Policies + pages

* [ ] Cancellation/no-show policy page
* [ ] Privacy policy
* [ ] Terms

## 9) Reliability / security

* [ ] Prevent overbooking (transaction + row locking on slot)
* [ ] Rate limit booking + webhook
* [ ] Logs for webhook + payment transitions
* [ ] Backups

---

## 10) Testing checklist
- [ ] Successful booking: paid -> confirmed + email
- [ ] Checkout canceled: booking stays pending -> expires -> seats released
- [ ] Concurrent booking attempts do not exceed capacity
- [ ] Booking cutoff works
- [ ] Admin can CRUD tours/variants/slots/media easily

## 11) Nice-to-haves (post-MVP)
- [ ] Proper calendar month UI
- [ ] Self-service cancel link (before cutoff) + automated refund
- [ ] Reschedule booking
- [ ] Discount codes
- [ ] Multi-language EN/NL
- [ ] iCal/Google Calendar links
- [ ] Image optimization + thumbnails
