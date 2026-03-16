@extends('layouts.app')
@section('title','Booking & Cancellation Policy')

@section('content')
    <section class="min-h-[90vh] landscape:min-h-[80vw] max-w-[1280px] mx-auto pt-24">

        <header class="text-center p-4">
            <h1 class="text-5xl mb-4">Eindhoven Cycling Tours</h1>
            <h2 class="text-3xl mb-2">Booking & Cancellation Policy</h2>
            <small>Last updated: March 2026</small>
        </header>

        <article class="my-12 text-lg p-4 max-w-[800px] mx-auto space-y-8 bg-base-100/80 rounded-lg shadow-lg">

            <section>
                <h3 class="font-bold text-2xl mb-2">1. General</h3>
                <p>
                    Eindhoven Cycling Tours offers guided cycling tours in and around Eindhoven.
                    By booking a tour through our website or through direct contact (email, phone, or messaging),
                    you agree to these booking terms and conditions.
                </p>
            </section>


            <section>
                <h3 class="font-bold text-2xl mb-2">2. Booking</h3>

                <p class="mb-4">
                    A booking is confirmed once payment has been successfully completed.
                    After booking you will receive a confirmation email containing:
                </p>

                <ul class="list-disc list-inside mb-4">
                    <li>Tour name</li>
                    <li>Date and time</li>
                    <li>Meeting location</li>
                    <li>Number of participants</li>
                    <li>Booking reference</li>
                </ul>

                <p>
                    Please check the details in your confirmation email carefully.
                </p>
            </section>


            <section>
                <h3 class="font-bold text-2xl mb-2">3. Payment</h3>

                <p>
                    All tours must be paid in advance through the booking system available on our website.
                    Prices are shown in euros (€) and include VAT where applicable.
                </p>
            </section>


            <section>
                <h3 class="font-bold text-2xl mb-2">4. Participation</h3>

                <p class="mb-4">
                    Participants are responsible for ensuring they are physically able to join the cycling tour.
                </p>

                <p class="mb-2">Participants must:</p>

                <ul class="list-disc list-inside mb-4">
                    <li>Follow the guide’s instructions</li>
                    <li>Comply with Dutch traffic rules</li>
                    <li>Ride safely and responsibly</li>
                </ul>

                <p>
                    Participation is at your own risk.
                </p>
            </section>


            <section>
                <h3 class="font-bold text-2xl mb-2">5. Bike requirements</h3>

                <p class="mb-4">
                    Participants may bring their own bicycle.
                </p>

                <p class="mb-4">
                    If you do not have a bike, we recommend renting one through our partner:
                </p>

                <p class="mb-4">
                    <a href="https://velorent.nl" target="_blank" class="link">
                        Velorent – Eindhoven
                    </a>
                </p>

                <p>
                    Rental bikes must be arranged directly with the rental provider.
                </p>
            </section>


            <section>
                <h3 class="font-bold text-2xl mb-2">6. Minimum and maximum group size</h3>

                <p class="mb-4">
                    Tours may have minimum and maximum group sizes.
                </p>

                <p class="mb-4">
                    If the minimum number of participants is not reached,
                    Eindhoven Cycling Tours may reschedule or cancel the tour.
                </p>

                <p>In this case participants will receive:</p>

                <ul class="list-disc list-inside">
                    <li>A full refund, or</li>
                    <li>The option to move the booking to another date.</li>
                </ul>
            </section>


            <section>
                <h3 class="font-bold text-2xl mb-2">7. Cancellation by participant</h3>

                <p class="mb-4">
                    You may cancel your booking at any time before the tour starts.
                    Cancellation fees may apply depending on the timing of the cancellation.
                </p>

                <p class="mb-4">
                    Our standard cancellation policy:
                </p>

                <div class="overflow-x-auto">
                    <table class="table table-zebra">
                        <thead>
                        <tr>
                            <th>Time before tour</th>
                            <th>Refund</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>More than 48 hours</td>
                            <td>Full refund</td>
                        </tr>
                        <tr>
                            <td>24 – 48 hours</td>
                            <td>50% refund</td>
                        </tr>
                        <tr>
                            <td>Less than 24 hours</td>
                            <td>No refund</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </section>


            <section>
                <h3 class="font-bold text-2xl mb-2">8. Cancellation by Eindhoven Cycling Tours</h3>

                <p class="mb-4">
                    We may cancel a tour due to:
                </p>

                <ul class="list-disc list-inside mb-4">
                    <li>Unsafe weather conditions</li>
                    <li>Safety concerns</li>
                    <li>Guide illness</li>
                    <li>Insufficient participants</li>
                </ul>

                <p class="mb-4">
                    If we cancel the tour you will receive:
                </p>

                <ul class="list-disc list-inside mb-4">
                    <li>A full refund, or</li>
                    <li>The option to reschedule.</li>
                </ul>

                <p>
                    Refunds will be processed within 14 days.
                </p>
            </section>


            <section>
                <h3 class="font-bold text-2xl mb-2">9. Exceptional circumstances</h3>

                <p>
                    If a tour cannot take place due to circumstances outside anyone’s control
                    (for example extreme weather or government restrictions),
                    the tour may be rescheduled or cancelled without additional fees.
                </p>
            </section>


            <section>
                <h3 class="font-bold text-2xl mb-2">10. Liability</h3>

                <p class="mb-4">
                    Eindhoven Cycling Tours is not liable for:
                </p>

                <ul class="list-disc list-inside mb-4">
                    <li>Personal injury</li>
                    <li>Damage to personal property</li>
                    <li>Accidents caused by participants or third parties</li>
                </ul>

                <p>
                    Participants are responsible for their own travel and accident insurance.
                </p>
            </section>


            <section>
                <h3 class="font-bold text-2xl mb-2">11. Photography</h3>

                <p class="mb-4">
                    Photos may occasionally be taken during tours for promotional purposes
                    (website or social media).
                </p>

                <p>
                    If you prefer not to appear in photographs,
                    please inform the guide before the tour starts.
                </p>
            </section>


            <section>
                <h3 class="font-bold text-2xl mb-2">12. Contact</h3>

                <p>
                    For questions about bookings or cancellations, please contact:
                </p>

                <p class="mt-2">
                    <strong>Eindhoven Cycling Tours</strong><br>
                    Website: www.ehvct.com
                    <br>
                    Email: info@ehvct.com
                    <br>
                    Or use the <a href="{{ route('contact.show')  }}" class="link">contact form</a>

                </p>
            </section>

        </article>
    </section>
@endsection
