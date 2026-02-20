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
* [ ] Booking flow (slot -> people -> details -> pay)
* [ ] Payment success/cancel pages
* [ ] Contact form
* [ ] Impressions page (site gallery)

### Booking rules

* [ ] Host creates Slots per TourVariant
* [ ] Slot has min/max participants
* [ ] Booking cutoff hours (no booking within X hours)
* [ ] Cancellation cutoff hours (refund allowed only until X hours)
* [ ] Upfront payment required (no-show = paid)

## 3) Data model

### Content

* [x] Tour
* [x] TourVariant
* [x] Media
* [x] Mediables pivot (role + sort_order) + working attach UI

### Booking/Payments (MVP)

* [ ] Slot

    * [ ] tour_variant_id
    * [ ] starts_at (datetime)
    * [ ] min_people, max_people
    * [ ] booking_cutoff_hours, cancel_cutoff_hours
    * [ ] status (active|canceled)
* [ ] Booking

    * [ ] slot_id
    * [ ] name, email, phone (optional)
    * [ ] people_count
    * [ ] unit_price_cents, total_amount_cents, currency
    * [ ] status (pending|paid|confirmed|canceled|expired|failed)
    * [ ] paid_at, confirmed_at, canceled_at (nullable datetimes)
* [ ] Payment

    * [ ] booking_id
    * [ ] provider (mollie)
    * [ ] provider_payment_id (Mollie payment id)
    * [ ] provider_status (open|paid|failed|canceled|expired|refunded)
    * [ ] amount_cents, currency
    * [ ] webhook_payload (json) optional (debug)
    * [ ] paid_at (nullable)

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

* [ ] Slot list page (per tour or variant) showing next X upcoming slots
* [ ] Booking form:

    * [ ] validate min/max people
    * [ ] enforce booking cutoff
* [ ] Create Booking (pending) + create Mollie payment
* [ ] Redirect to Mollie checkout
* [ ] Webhook updates booking/payment state
* [ ] “Thank you” page shows booking reference

## 6) Mollie payments

* [ ] Mollie API key in env
* [ ] Create payment:

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
