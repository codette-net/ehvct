# TODO — Eindhoven Cycling Tours (Laravel + Filament + Stripe) MVP

## 0) Repo + baseline
- [x] Create Laravel app + Git repo
- [x] Configure .env: APP_URL, DB, MAIL, QUEUE, timezone (Europe/Amsterdam), locale (en)
- [x] Add basic error logging + env separation (local/staging/prod)

## 1) Stack overview (for README)
- [ ] Laravel (PHP 8.2+)
- [ ] DB: MySQL/MariaDB
- [ ] Frontend: Blade + Tailwind (or simple CSS)
- [ ] Admin: Filament Panel
- [ ] Payments: Stripe Checkout + Webhooks
- [ ] Mail: SMTP (simple provider)
- [ ] Storage: public disk (uploads), later optimize images (post-MVP)
- [ ] Cron for cleanup jobs + queue worker (or sync queue for MVP)

## 2) MVP scope (features)
### Public site
- [ ] Home page (hero + CTA "Book a tour")
- [ ] Tours overview (list)
- [ ] Tour detail:
  - [ ] description, highlights, meeting point, included items
  - [ ] images (cover + gallery)
  - [ ] variants (durations/prices)
  - [ ] booking calendar/list of available slots
- [ ] Booking flow (slot -> people -> checkout)
- [ ] Payment success/cancel pages
- [ ] Contact page + contact form
- [ ] Impressions/Gallery page (site gallery using Media)

## 2b) Blog (MVP)

### Goal
- Share cycling-related stories, routes, nature highlights, and inspiration
- Keep the website fresh and engaging
- Support SEO and recurring visitors

### MVP approach
- Simple blog with articles managed in the admin
- In early development, some articles may be hardcoded
- For MVP delivery, blog must be fully manageable via CMS

### Features
- [ ] Blog overview page (list of articles)
- [ ] Blog detail page
- [ ] Admin can create/edit/delete articles
- [ ] Publish date + draft/published status
- [ ] Featured image per article
- [ ] Short excerpt for overview
- [ ] Basic SEO fields (title, description)
- [ ] Articles reusable later for homepage highlights

### Content model (minimal)
- [ ] Post: title, slug, excerpt, content, status, published_at
- [ ] Optional: cover image (Media)


### Booking rules (core)
- [ ] Host creates Slots (dates/times) per TourVariant
- [ ] Slot has min/max participants
- [ ] Booking cutoff (e.g. cannot book within X hours of start)
- [ ] Cancellation cutoff (e.g. refunds allowed only until X hours before)
- [ ] Upfront payment required (no-show = paid)

## 3) Data model (minimal)
### Content
- [ ] Tour: title, slug, description, highlights, meeting_point, is_active
- [ ] TourVariant: tour_id, label (e.g. "2 hours"), duration_minutes, price_per_person_cents, currency
- [ ] Media: file_path, title (opt), alt (required), caption (opt), credits (opt)
- [ ] Mediables pivot (polymorcd phic):
  - [ ] media_id, mediable_type, mediable_id
  - [ ] role (cover|gallery|site_gallery), sort_order

### Booking/Payments
- [ ] Slot: variant_id, starts_at, min_people, max_people, booking_cutoff_hours, cancel_cutoff_hours, status
- [ ] Booking: slot_id, name, email, phone (opt), people_count, total_amount_cents, currency, status (pending|confirmed|canceled|expired)
- [ ] Payment: booking_id, stripe_session_id, stripe_payment_intent_id, status (pending|paid|failed|refunded)

## 4) Admin/CMS (Filament)
- [ ] Install Filament Panel + admin auth (single operator)
- [ ] MediaResource:
  - [ ] upload image
  - [ ] alt required, caption/credits optional
  - [ ] list + search + preview
- [ ] TourResource:
  - [ ] fields: title/slug/desc/highlights/meeting point/active
  - [ ] relation manager: Variants
  - [ ] relation manager: Images (Media attach + role + ordering)
- [ ] Variant relation manager:
  - [ ] create/edit duration + price
  - [ ] relation manager: Slots
- [ ] Slot management:
  - [ ] quick-create slots (date/time, capacity, cutoffs)
  - [ ] occupancy display (confirmed seats / max)
- [ ] BookingResource:
  - [ ] list upcoming + filters (paid/confirmed/canceled)
  - [ ] detail view read-only-ish
  - [ ] actions: cancel (manual), refund note (MVP), resend email (optional)
- [ ] Settings (optional MVP):
  - [ ] contact email/phone
  - [ ] default meeting point
  - [ ] social links

## 5) Booking flow (public)
- [ ] Availability listing (simple first):
  - [ ] show next X upcoming slots per tour variant
  - [ ] optional month view later
- [ ] Booking form (slot + people_count + customer details)
- [ ] Create Booking as pending + create Stripe Checkout Session
- [ ] Redirect to Stripe Checkout
- [ ] Stripe webhook verifies payment -> Booking confirmed + seats locked in
- [ ] Expire pending bookings older than N minutes -> status expired (release hold)

## 6) Payments (Stripe)
- [ ] Stripe keys + webhook secret in env
- [ ] Checkout Session:
  - [ ] line item = people_count * price_per_person
  - [ ] include booking_id in metadata
- [ ] Webhook endpoint:
  - [ ] verify signature
  - [ ] handle checkout.session.completed -> mark paid/confirmed
  - [ ] store session_id + payment_intent_id
- [ ] Refund workflow (MVP manual in admin):
  - [ ] check cancellation cutoff
  - [ ] call Stripe refund API (post-MVP if needed)

## 7) Emails (MVP)
- [ ] Confirmation email (on confirmed booking):
  - [ ] date/time, meeting point, #people, contact info, policy
- [ ] Admin notification email on new confirmed booking

## 8) Policy + pages + UX
- [ ] Terms + cancellation/no-show policy (clear cutoff rules)
- [ ] Privacy policy (basic)
- [ ] Payment error states: sold out, slot closed, payment canceled/failed

## 9) Security + reliability
- [ ] Prevent overbooking:
  - [ ] DB transaction + row lock on Slot when creating booking/hold
- [ ] Rate limit booking + contact form
- [ ] Logs for webhook processing and payment state changes
- [ ] Backups

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
