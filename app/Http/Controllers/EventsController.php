<?php

namespace App\Http\Controllers;

use App\Models\EventBooking;
use App\Models\Room;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyEventRequest;
use App\Http\Requests\StoreEventRequest;
use App\Http\Requests\UpdateEventRequest;
use App\Services\EventServices;
use Carbon\Carbon;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EventsController extends Controller
{
    public function index()
    {
        
        $icNos = Auth::user()->ic_no;

        $events = EventBooking::leftJoin('rooms','eventsbooking.room_id' , '=', 'rooms.id')
        ->where('user_id','=', $icNos)
        ->select('eventsbooking.*', 'rooms.label')  
        ->get();

        return view('adminbooking.booking.index', compact('events'));
    }

    public function indexadmin()
    {
        
        // abort_if(Gate::denies('event_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $events = EventBooking::leftJoin('rooms','eventsbooking.room_id' , '=', 'rooms.id')
        ->select('eventsbooking.*', 'rooms.label')
        ->get();

        return view('adminbooking.booking.indexadmin', compact('events'));
    }

    public function create()
    {
        // abort_if(Gate::denies('event_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        // $rooms = Room::all()->pluck('label', 'id')->prepend(trans('global.pleaseSelect'), '');

        $users = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $rooms = Room::pluck('label','id')->all();

        return view('adminbooking.booking.create', compact('rooms', 'users'));
    }

    public function createadmin()
    {
        // abort_if(Gate::denies('event_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        // $rooms = Room::all()->pluck('label', 'id')->prepend(trans('global.pleaseSelect'), '');

        $users = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $rooms = Room::pluck('label','id')->all();

        return view('adminbooking.booking.createadmin', compact('rooms', 'users'));
    }

    public function storeadmin(Request $request, EventServices $eventService)
    {
        if ($eventService->isRoomTaken($request->all())) {
            return redirect()->back()
                    ->withInput($request->input())
                    ->withErrors('This room is not available at the time you have chosen');
        }

        $event = new EventBooking;

        $nothing = null;
        $currentdate = Carbon::today();
        $icNos = Auth::user()->ic_no;

        $event->title = $request->title;
        $event->name = $request->name;
        $event->room_id = $request->room_id;
        $event->user_id = $icNos;
        $event->end_time = $request->end_time;
        $event->start_time = $request->start_time;
        $event->description = $request->description;
        $event->jawatan = $request->jawatan;
        $event->dept = $request->dept;
        $event->tel_no = $request->tel_no;
        $event->agenda = $request->agenda;
        $event->anjuran = $request->anjuran;
        $event->pengerusi = $request->pengerusi;
        $event->created_at = $currentdate;
        $event->updated_at = $currentdate;
        $event->deleted_at = $nothing; 
        // Save 'Online Notification' data
        $event->save();

        if ($request->filled('recurring_until')) {
            $eventService->createRecurringEvents($request->all());
        }

        return redirect()->route('adminbooking.booking.indexadmin');

    }


    public function store(Request $request, EventServices $eventService)
    {
        if ($eventService->isRoomTaken($request->all())) {
            return redirect()->back()
                    ->withInput($request->input())
                    ->withErrors('This room is not available at the time you have chosen');
        }

        $event = new EventBooking;

        $nothing = null;
        $currentdate = Carbon::today();
        $icNos = Auth::user()->ic_no;

        $event->title = $request->title;
        $event->name = $request->name;
        $event->room_id = $request->room_id;
        $event->user_id = $icNos;
        $event->end_time = $request->end_time;
        $event->start_time = $request->start_time;
        $event->description = $request->description;
        $event->jawatan = $request->jawatan;
        $event->dept = $request->dept;
        $event->tel_no = $request->tel_no;
        $event->agenda = $request->agenda;
        $event->anjuran = $request->anjuran;
        $event->pengerusi = $request->pengerusi;
        $event->created_at = $currentdate;
        $event->updated_at = $currentdate;
        $event->deleted_at = $nothing; 

        $event->save();

        if ($request->filled('recurring_until')) {
            $eventService->createRecurringEvents($request->all());
        }

        return redirect()->route('adminbooking.booking.index');

    }

    public function edit($id)
    {

        $event = EventBooking::leftJoin('rooms','eventsbooking.room_id' , '=', 'rooms.id')
        ->where('eventsbooking.id', '=', $id)
        ->select('eventsbooking.*', 'rooms.label')
        ->get();

        $rooms = Room::select('rooms.*')->get();

        return view('adminbooking.booking.edit', compact('rooms','event'));
    }

    public function editsearch($id)
    {

        $event = EventBooking::leftJoin('rooms','eventsbooking.room_id' , '=', 'rooms.id')
        ->where('eventsbooking.id', '=', $id)
        ->select('eventsbooking.*', 'rooms.label')
        ->get();

        $rooms = Room::select('rooms.*')->get();

        return view('adminbooking.booking.editsearch', compact('rooms','event'));
    }

    public function update(Request $request)
    {

        $now = Carbon::today();
        $nothing = null;

        $event =  EventBooking::select('eventsbooking.*')
            ->where('id', $request->id)
            ->update([
                'name'         =>      $request->name,
                'title'      =>      $request->title,
                'room_id'      =>      $request->room_id,
                'description'      =>      $request->description,
                'jawatan'      =>      $request->jawatan,
                'tel_no'      =>      $request->tel_no,
                'agenda'      =>      $request->agenda,
                'anjuran'      =>      $request->anjuran,
                'pengerusi'      =>      $request->pengerusi,
                'dept'      =>      $request->dept,
                'deleted_at' => $nothing,
                'updated_at' => $now

            ]);

        return redirect()->route('adminbooking.booking.indexadmin')
        ->with('success_message', 'Data has successfully updated!');

    }

    public function updatesearch(Request $request)
    {

        $now = Carbon::today();

        $nothing = null;

        $event =  EventBooking::select('eventsbooking.*')
            ->where('id', $request->id)
            ->update([
                'name'         =>      $request->name,
                'title'      =>      $request->title,
                'room_id'      =>      $request->room_id,
                'description'      =>      $request->description,
                'jawatan'      =>      $request->jawatan,
                'tel_no'      =>      $request->tel_no,
                'agenda'      =>      $request->agenda,
                'anjuran'      =>      $request->anjuran,
                'pengerusi'      =>      $request->pengerusi,
                'dept'      =>      $request->dept,
                'deleted_at' => $request->deleted_at = null,
                'updated_at' => $now

            ]);

        return redirect()->route('adminbooking.systemcalendaradmin')
        ->with('success_message', 'Data has successfully updated!');

    }

    public function show($id)
    {
        // abort_if(Gate::denies('event_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $event = EventBooking::all()
            ->where('id','=', $id);

        $eventroom = EventBooking::leftJoin('rooms','eventsbooking.room_id' , '=', 'rooms.id')
          ->where('eventsbooking.id', '=', $id)
          ->select('eventsbooking.*', 'rooms.label')
          ->get();

        return view('adminbooking.booking.show', compact('event','eventroom'));
    }

    public function showadmin($id)
    {
        // abort_if(Gate::denies('event_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $event = EventBooking::all()
            ->where('id','=', $id);

        $eventroom = EventBooking::leftJoin('rooms','eventsbooking.room_id' , '=', 'rooms.id')
          ->where('eventsbooking.id', '=', $id)
          ->select('eventsbooking.*', 'rooms.label')
          ->get();

        return view('adminbooking.booking.showadmin', compact('event','eventroom'));
    }

    public function destroy($id)
    {
        try {

            $event = EventBooking::where('id','=', $id)->delete();

            return redirect()->route('adminbooking.booking.indexadmin')
                ->with('success_message', 'Event was successfully deleted!');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request!']);
        }
    }
    
    public function destroyuser($id)
    {
        try {

            $event = EventBooking::where('id','=', $id)->delete();

            return redirect()->route('adminbooking.searchroom')
                ->with('success_message', 'Booking was successfully deleted!');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request!']);
        }
    }

}
