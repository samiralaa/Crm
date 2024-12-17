<?php

namespace App\Http\Controllers\Calender;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class FullCalenderController extends Controller
{
    public function index()
    {
        // Fetch all events to display on the calendar
        $events = Event::all();

        return view('crm.calendar.fullcalender', ['events' => $events]);
    }

    public function store(Request $request)
    {
        // Validate the request
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'start' => 'required|date',
            'end' => 'required|date',
        ]);

        // Calculate the duration in hours
        $start = Carbon::parse($validated['start']);
        $end = Carbon::parse($validated['end']);
        $duration = $end->diffInHours($start);  // Duration in hours

        // Create a new event
        $booking = Event::create([
            'title' => $validated['title'],
            'start' => $validated['start'],
            'end' => $validated['end'],
            'duration' => $duration, // Store the duration
        ]);

        $color = null;

        if ($booking->title == 'Test') {
            $color = '#924ACE'; // You can customize the color based on the event title or any condition
        }

        return response()->json([
            'id' => $booking->id,
            'start' => $booking->start,
            'end' => $booking->end,
            'title' => $booking->title,
            'color' => $color ? $color : '',
            'duration' => $booking->duration, // Return the duration
        ]);
    }
    public function update(Request $request, $id)
    {
        $booking = Event::find($id);
        if (!$booking) {
            return response()->json([
                'error' => 'Unable to locate the event',
            ], 404);
        }

        // Validate the update request
        $validated = $request->validate([
            'start' => 'required|date',
            'end' => 'required|date',
        ]);

        // Update the event
        $booking->update([
            'start' => $validated['start'],
            'end' => $validated['end'],
        ]);

        return response()->json('Event updated');
    }

    public function destroy($id)
    {
        $booking = Event::find($id);
        if (!$booking) {
            return response()->json([
                'error' => 'Unable to locate the event',
            ], 404);
        }

        $booking->delete();
        return response()->json(['success' => 'Event deleted']);
    }
}
