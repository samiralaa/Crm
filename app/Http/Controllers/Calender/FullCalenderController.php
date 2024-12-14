<?php
namespace App\Http\Controllers\Calender;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Event;
use Illuminate\Http\JsonResponse;

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

        // Create a new event
        $booking = Event::create([
            'title' => $validated['title'],
            'start' => $validated['start'],
            'end' => $validated['end'],
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
