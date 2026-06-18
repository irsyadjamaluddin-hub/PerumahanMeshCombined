<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreEventRequest;

use App\Models\EventBooking;
use App\Models\Room;
use App\Models\Department;
use App\Models\Biodata;

use App\Services\BookingServices;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingsController extends Controller
{
    public function searchRoom(Request $request)
    {
        $rooms = null;
        if($request->filled(['start_time', 'end_time', 'capacity'])) {
            $times = [
                Carbon::parse($request->input('start_time')),
                Carbon::parse($request->input('end_time')),
            ];

            $rooms = Room::where('capacity', '>=', $request->input('capacity'))
                ->whereDoesntHave('eventsbooking', function ($query) use ($times) {
                    $query->whereBetween('start_time', $times)
                        ->orWhereBetween('end_time', $times)
                        ->orWhere(function ($query) use ($times) {
                            $query->where('start_time', '<', $times[0])
                                ->where('end_time', '>', $times[1]);
                        });
                })
                ->get();

        }

      	$icNos = Auth::user()->ic_no;

        $events = EventBooking::leftJoin('rooms','eventsbooking.room_id' , '=', 'rooms.id')
        ->select('eventsbooking.*', 'rooms.label')
        ->where('eventsbooking.user_id','=',$icNos)
        ->get();

        $userdetails = Biodata::leftJoin('emp_employment_infos','biodatas.ic_no','=','emp_employment_infos.ic_no')
        ->leftJoin('emp_contact_infos','biodatas.ic_no','=','emp_contact_infos.ic_no')
        ->where('biodatas.ic_no','=',$icNos)
        ->select('biodatas.*','emp_employment_infos.current_designation_id','emp_employment_infos.department_id','emp_contact_infos.telephone_mobile')
        ->get();

        $departments = Department::pluck('label', 'id')->all();
        
        return view('adminbooking.bookings.search', compact('rooms','events','departments','userdetails'));
    }

    public function searchRoomAdmin(Request $request)
    {
        $rooms = null;
        if($request->filled(['start_time', 'end_time', 'capacity'])) {
            $times = [
                Carbon::parse($request->input('start_time')),
                Carbon::parse($request->input('end_time')),
            ];

            $rooms = Room::where('capacity', '>=', $request->input('capacity'))
                ->whereDoesntHave('eventsbooking', function ($query) use ($times) {
                    $query->whereBetween('start_time', $times)
                        ->orWhereBetween('end_time', $times)
                        ->orWhere(function ($query) use ($times) {
                            $query->where('start_time', '<', $times[0])
                                ->where('end_time', '>', $times[1]);
                        });
                })
                ->get();

        }

		$icNos = Auth::user()->ic_no;

        $events = EventBooking::leftJoin('rooms','eventsbooking.room_id' , '=', 'rooms.id')
        ->select('eventsbooking.*', 'rooms.label')
        ->get();

        $userdetails = Biodata::leftJoin('emp_employment_infos','biodatas.ic_no','=','emp_employment_infos.ic_no')
        ->leftJoin('emp_contact_infos','biodatas.ic_no','=','emp_contact_infos.ic_no')
        ->where('biodatas.ic_no','=',$icNos)
        ->select('biodatas.*','emp_employment_infos.current_designation_id','emp_employment_infos.department_id','emp_contact_infos.telephone_mobile')
        ->get();

        $departments = Department::pluck('label', 'id')->all();

        
        return view('adminbooking.bookings.searchadmin', compact('rooms','events','departments','userdetails'));
    }

    public function bookRoom(Request $request, BookingServices $eventService)
    {
        $request->merge([
            'user_id' => Auth::user()->ic_no
        ]);

        $request->validate([
            'room_id' => 'required',
        ]);

        $room = Room::findOrFail($request->input('room_id'))
        ->select('rooms.label');

        if ($eventService->isRoomTaken($request->all())) {
            return redirect()->back()
                    ->withInput()
                    ->withErrors(['recurring_until' => 'This room is not available until the recurring date you have chosen']);
        }

       

        $event = EventBooking::create($request->all());

        if ($request->filled('recurring_until')) {
            $eventService->createRecurringEvents($request->all());
            
        }

        return redirect()->route('adminbooking.systemcalendar')->with('success_message', 'Room has been successfully booked!');
    }

    public function bookRoomAdmin(Request $request, BookingServices $eventService)
    {
        $request->merge([
            'user_id' => Auth::user()->ic_no
        ]);

        $request->validate([
            'room_id' => 'required',
        ]);

        $room = Room::findOrFail($request->input('room_id'))
        ->select('rooms.label');

        if ($eventService->isRoomTaken($request->all())) {
            return redirect()->back()
                    ->withInput()
                    ->withErrors(['recurring_until' => 'This room is not available until the recurring date you have chosen']);
        }

       

        $event = EventBooking::create($request->all());

        if ($request->filled('recurring_until')) {
            $eventService->createRecurringEvents($request->all());
            $request->deleted_at = null;
        }
        return redirect()->route('adminbooking.systemcalendaradmin')->with('success_message', 'Room has been successfully booked!');
    }
}
