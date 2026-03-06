@php
    $tour = $booking->slot->variant->tour;
    $variant = $booking->slot->variant;
@endphp
    <!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width">
</head>
<body style="margin:0;padding:0;background:#f5f7fb;font-family:Arial,Helvetica,sans-serif;color:#111;">
<table role="presentation" width="100%" cellspacing="0" cellpadding="0" style="background:#f5f7fb;padding:24px 12px;">
    <tr>
        <td align="center">
            <table role="presentation" width="600" cellspacing="0" cellpadding="0" style="max-width:600px;background:#ffffff;border:1px solid #e6eaf2;border-radius:10px;overflow:hidden;">
                <tr>
                    <td style="padding:18px 22px;background:#eef2ff;border-bottom:1px solid #e6eaf2;">
                        <div style="font-weight:700;letter-spacing:0.06em;">EHVCT</div>
                    </td>
                </tr>

                <tr>
                    <td style="padding:22px;">
                        <h1 style="margin:0 0 10px 0;font-size:22px;line-height:1.3;">Booking confirmed for :</h1>
                        <p style="margin:0 0 16px 0;color:#374151;">{{ $booking->name }}</p>

                        <table role="presentation" width="100%" cellspacing="0" cellpadding="0" style="border-collapse:collapse;margin:14px 0 8px 0;">
                            <tr>
                                <td style="padding:10px 0;color:#6b7280;width:160px;">Reference</td>
                                <td style="padding:10px 0;font-weight:700;font-family:ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, 'Liberation Mono', 'Courier New', monospace;">{{ $booking->reference }}</td>
                            </tr>
                            <tr>
                                <td style="padding:10px 0;color:#6b7280;">Tour</td>
                                <td style="padding:10px 0;">{{ $tour->title }} — {{ $variant->label }}</td>
                            </tr>
                            <tr>
                                <td style="padding:10px 0;color:#6b7280;">Date & time</td>
                                <td style="padding:10px 0;">{{ $booking->slot->starts_at->format('D d M Y, H:i') }}</td>
                            </tr>
                            <tr>
                                <td style="padding:10px 0;color:#6b7280;">People</td>
                                <td style="padding:10px 0;">{{ $booking->people_count }}</td>
                            </tr>
                            <tr>
                                <td style="padding:10px 0;color:#6b7280;">Total paid</td>
                                <td style="padding:10px 0;font-weight:700;">€{{ number_format($booking->total_amount_cents / 100, 2) }}</td>
                            </tr>

                        </table>

                        <hr style="border:none;border-top:1px solid #e6eaf2;margin:18px 0;">
                    </td>
                </tr>

                <tr>
                    <td style="padding:14px 22px;border-top:1px solid #e6eaf2;color:#6b7280;font-size:12px;background:#fafbff;">
                        © {{ date('Y') }} {{ config('app.name') }}. All rights reserved.
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>
</body>
</html>
