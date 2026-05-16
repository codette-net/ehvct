<?php

namespace App\Http\Controllers;

use App\Models\Slot;
use App\Models\Tour;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactMail;

class ContactController extends Controller
{
    public function show(Request $request)
    {
        $tour = $request->filled('tour')
            ? Tour::find($request->integer('tour')) : null;

        $slot = $request->filled('slot')
            ? Slot::with('variant.tour')->find($request->integer('slot')) : null;
        return view('pages.contact', compact('tour', 'slot'));

    }

    public function submit(Request $request)
    {
        $data = $request->validate($this->contactValidationRules());

        $data['tour_context'] = $this->resolveTourContext($data);

        $adminEmail = config('mail.admin_notify') ?: env('ADMIN_NOTIFY_EMAIL');

        Mail::to($adminEmail)->send(new ContactMail($data));

        return back()->with(
            'success',
            'Your message has been sent. We will get back to you as soon as possible.'
        );
    }

    private function contactValidationRules(): array
    {
        return [
            'name' => ['required', 'string', 'max:120'],
            'phone' => ['nullable', 'string', 'max:40'],
            'email' => ['required', 'email'],
            'subject' => ['nullable', 'string', 'max:120'],
            'message' => ['required', 'string', 'max:2000'],
            'company' => ['nullable', 'max:0'],
            'tour_id' => ['nullable', 'exists:tours,id'],
            'slot_id' => ['nullable', 'exists:slots,id'],
        ];
    }

    private function resolveTourContext(array $data): ?string
    {
        if (!empty($data['slot_id'])) {
            return $this->resolveSlotTourContext((int)$data['slot_id']);
        }

        if (!empty($data['tour_id'])) {
            return $this->resolveTourTitleContext((int)$data['tour_id']);
        }

        return null;
    }

    private function resolveSlotTourContext(int $slotId): ?string
    {
        $slot = \App\Models\Slot::with('variant.tour')->find($slotId);

        if (!$slot || !$slot->variant || !$slot->variant->tour) {
            return null;
        }

        return implode(' | ', [
            $slot->variant->tour->title,
            $slot->variant->label,
            $slot->starts_at->format('D d M Y, H:i'),
        ]);
    }

    private function resolveTourTitleContext(int $tourId): ?string
    {
        return \App\Models\Tour::find($tourId)?->title;
    }

}
