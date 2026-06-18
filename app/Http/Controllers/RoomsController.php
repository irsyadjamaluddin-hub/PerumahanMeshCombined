<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyRoomRequest;
use App\Http\Requests\StoreRoomRequest;
use App\Http\Requests\UpdateRoomRequest;
use App\Models\Room;
use Gate;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoomsController extends Controller
{
    public function index()
    {
        // abort_if(Gate::denies('room_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $rooms = Room::select('rooms.*')
            ->orderBy('updated_at', 'DESC') 
            ->get();

        return view('adminbooking.rooms.index', compact('rooms'));
    }

    public function create()
    {
        // abort_if(Gate::denies('room_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('adminbooking.rooms.create');
    }

    public function store(Request $request)
    {

        $currentdate = Carbon::today();
        $room = new Room;
        
        $room->label = $request->label;
        $room->capacity = $request->capacity;
        $room->description = $request->description;
        $room->created_at = $currentdate;
        $room->updated_at = $currentdate;
        $room->deleted_at = null;
        $room->save();
        

        return redirect()->route('adminbooking.rooms.index');

    }

    public function edit($id)
    {
        
        $room = Room::all()
        ->where('id', '=', $id);

        return view('adminbooking.rooms.edit', compact('room'));
    }
    
    public function show($id)
    {
     
        $room = Room::all()->where('id', '=', $id);

        return view('adminbooking.rooms.show', compact('room'));
    }

    public function update(Request $request)
    {

        $now = Carbon::today();
        $nothing = null;

        $room =  Room::select('rooms.*')
            ->where('id', $request->id)
            ->update([
                'label'         =>      $request->label,
                'capacity'      =>      $request->capacity,
                'description'      =>      $request->description,
                'deleted_at' => $nothing,
                'updated_at' => $now

            ]);

        return redirect()->route('adminbooking.rooms.index')
        ->with('success_message', 'Data has successfully updated!');

    }

    public function destroy($id)
    {
        try {

            $room = Room::where('id', $id)->delete();

            return redirect()->route('adminbooking.rooms.index')
                ->with('success_message', 'Room was successfully deleted!');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request!']);
        }
    }
}
