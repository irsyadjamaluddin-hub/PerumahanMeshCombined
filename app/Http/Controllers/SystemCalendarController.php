<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\User;
use App\Models\EventBooking;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SystemCalendarController extends Controller
{
        public $sources = [
        [
            'model'      => '\\App\\Models\\EventBooking',
            'date_field' => 'start_time',
            'date_fieldend' => 'end_time',
            'field'      => 'room_id',
            'prefix'     => '',
            'suffix'     => '',
        ],
    ];

    public $adminsources = [
        [
            'model'      => '\\App\\Models\\EventBooking',
            'date_field' => 'start_time',
            'date_fieldend' => 'end_time',
            'field'      => 'room_id',
            'prefix'     => '',
            'suffix'     => '',
            'route'      => 'adminbooking.booking.edit',
        ],
    ];

    public function index(Request $request)
    {
        $roomname = [];

        $events = [];
        // $rooms = Room::all()->pluck('label', 'id')->prepend(trans('global.pleaseSelect'), '');
        $rooms = Room::select('rooms.*')->get();
        $users = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        if($request->input('room_id') != null){

            $input = $request->all();
            $form_data = array();
            $form_data['room_id'] = $input['room_id'];

            $roomname = Room::select('rooms.*')
            ->where('rooms.id','=',$form_data['room_id'] = $input['room_id'])
            ->get();

            $roomid = $request->input('room_id');

            $roomlabel = Room::select('rooms.*')
            ->where('rooms.id','=',$roomid)
            ->first();

            foreach ($this->sources as $source) {
                $models = $source['model']::when($request->input('room_id'), function ($query) use ($request) {
                        $query->where('room_id', $request->input('room_id'));
                    })
                    ->when($request->input('user_id'), function ($query) use ($request) {
                        $query->where('user_id', $request->input('user_id'));
                    })
                    ->get();
                foreach ($models as $model) {
                    $crudFieldValue = $model->getOriginal($source['date_field']);
                    
                    $crudFieldValue_end = $model->getOriginal($source['date_fieldend']);
    
                    if (!$crudFieldValue) {
                        continue;
                    }

                    if (!$crudFieldValue_end) {
                        continue;
                    }
    
                    $events[] = [
                        'title' => trim($source['prefix'] . " " 
                            . " ".$roomlabel->label . $source['suffix']),
                        'start' => $crudFieldValue,
                    ];
                    $events[] = [
                        'title' => trim($source['prefix'] . " " 
                            . " ".$roomlabel->label . $source['suffix']),
                        'start' => $crudFieldValue_end,
                        'color' => '#E2D1F9',
                    ];
                }
    
            }
        }
        

        return view('adminbooking.calendar.calendar', compact('events', 'rooms', 'users','roomname'));

    }

    public function indexadmin(Request $request)
    {
        $roomname = [];
        $events = [];
        $rooms = Room::select('rooms.*')->get();
        $users = User::all()->pluck('name', 'ic_no')->prepend(trans('global.pleaseSelect'), '');

        if($request->input('room_id') != null){

            $input = $request->all();
            $form_data = array();
            $form_data['room_id'] = $input['room_id'];

            $roomname = Room::select('rooms.*')
            ->where('rooms.id','=',$form_data['room_id'] = $input['room_id'])
            ->get();

            $roomid = $request->input('room_id');

            $roomlabel = Room::select('rooms.*')
            ->where('rooms.id','=',$roomid)
            ->first();

            foreach ($this->adminsources as $source) {
                $models = $source['model']::when($request->input('room_id'), function ($query) use ($request) {
                        $query->where('room_id', $request->input('room_id'));
                    })
                    ->when($request->input('user_id'), function ($query) use ($request) {
                        $query->where('user_id', $request->input('user_id'));
                    })
                    ->get();
                foreach ($models as $model) {
                    $crudFieldValue = $model->getOriginal($source['date_field']);
                    
                    $crudFieldValue_end = $model->getOriginal($source['date_fieldend']);
    
                    if (!$crudFieldValue) {
                        continue;
                    }

                    if (!$crudFieldValue_end) {
                        continue;
                    }
    
                    $events[] = [
                        'title' => trim($source['prefix'] . " " . $roomlabel->label
                            . " " . $source['suffix']),
                        'start' => $crudFieldValue,
                        'url'   => route($source['route'], $model->id),
                    ];
                    $events[] = [
                        'title' => trim($source['prefix'] . " " 
                            . " ".$roomlabel->label . $source['suffix']),
                        'start' => $crudFieldValue_end,
                        'color' => '#E2D1F9',
                    ];
                }
    
            }
        }

        return view('adminbooking.calendar.calendaradmin', compact('events', 'rooms', 'users','roomname'));

    }

    public function indexmr(Request $request)
    {
        $events = [];
        $rooms = Room::all()->pluck('label', 'id')->prepend(trans('global.pleaseSelect'), '');
        $users = User::all()->pluck('name', 'ic_no')->prepend(trans('global.pleaseSelect'), '');

        foreach ($this->sources as $source) {
            $models = $source['model']::when(('Meeting Room'), function ($query) use ($request) {
                    $query->where('room_id', ('Meeting Room'));
                })
                ->when($request->input('user_id'), function ($query) use ($request) {
                    $query->where('user_id', $request->input('user_id'));
                })
                ->get();
            foreach ($models as $model) {
                $crudFieldValue = $model->getOriginal($source['date_field']);

                if (!$crudFieldValue) {
                    continue;
                }

                $events[] = [
                    'title' => trim($source['prefix'] . " " . $model->{$source['field']}
                        . " " . $source['suffix']),
                    'start' => $crudFieldValue,
                    
                ];
            }

        }

        return view('adminbooking.calendar.calendarmr', compact('events', 'rooms', 'users'));

    }

    public function indexp1(Request $request)
    {
        $events = [];
        $rooms = Room::all()->pluck('label', 'id')->prepend(trans('global.pleaseSelect'), '');
        $users = User::all()->pluck('name', 'ic_no')->prepend(trans('global.pleaseSelect'), '');

        foreach ($this->sources as $source) {
            $models = $source['model']::when(('Persidangan 1'), function ($query) use ($request) {
                    $query->where('room_id', ('Persidangan 1'));
                })
                ->when($request->input('user_id'), function ($query) use ($request) {
                    $query->where('user_id', $request->input('user_id'));
                })
                ->get();
            foreach ($models as $model) {
                $crudFieldValue = $model->getOriginal($source['date_field']);

                if (!$crudFieldValue) {
                    continue;
                }

                $events[] = [
                    'title' => trim($source['prefix'] . " " . $model->{$source['field']}
                        . " " . $source['suffix']),
                    'start' => $crudFieldValue,
                    
                ];
            }

        }

        return view('adminbooking.calendar.calendarp1', compact('events', 'rooms', 'users'));

    }

    public function indexp2(Request $request)
    {
        $events = [];
        $rooms = Room::all()->pluck('label', 'id')->prepend(trans('global.pleaseSelect'), '');
        $users = User::all()->pluck('name', 'ic_no')->prepend(trans('global.pleaseSelect'), '');

        foreach ($this->sources as $source) {
            $models = $source['model']::when(('Persidangan 2'), function ($query) use ($request) {
                    $query->where('room_id', ('Persidangan 2'));
                })
                ->when($request->input('user_id'), function ($query) use ($request) {
                    $query->where('user_id', $request->input('user_id'));
                })
                ->get();
            foreach ($models as $model) {
                $crudFieldValue = $model->getOriginal($source['date_field']);

                if (!$crudFieldValue) {
                    continue;
                }

                $events[] = [
                    'title' => trim($source['prefix'] . " " . $model->{$source['field']}
                        . " " . $source['suffix']),
                    'start' => $crudFieldValue,
                    
                ];
            }

        }

        return view('adminbooking.calendar.calendarp2', compact('events', 'rooms', 'users'));

    }

    public function indexp4(Request $request)
    {
        $events = [];
        $rooms = Room::all()->pluck('label', 'id')->prepend(trans('global.pleaseSelect'), '');
        $users = User::all()->pluck('name', 'ic_no')->prepend(trans('global.pleaseSelect'), '');

        foreach ($this->sources as $source) {
            $models = $source['model']::when(('Persidangan 4'), function ($query) use ($request) {
                    $query->where('room_id', ('Persidangan 4'));
                })
                ->when($request->input('user_id'), function ($query) use ($request) {
                    $query->where('user_id', $request->input('user_id'));
                })
                ->get();
            foreach ($models as $model) {
                $crudFieldValue = $model->getOriginal($source['date_field']);

                if (!$crudFieldValue) {
                    continue;
                }

                $events[] = [
                    'title' => trim($source['prefix'] . " " . $model->{$source['field']}
                        . " " . $source['suffix']),
                    'start' => $crudFieldValue,
                    
                ];
            }

        }

        return view('adminbooking.calendar.calendarp4', compact('events', 'rooms', 'users'));

    }

    public function indexp5(Request $request)
    {
        $events = [];
        $rooms = Room::all()->pluck('label', 'id')->prepend(trans('global.pleaseSelect'), '');
        $users = User::all()->pluck('name', 'ic_no')->prepend(trans('global.pleaseSelect'), '');

        foreach ($this->sources as $source) {
            $models = $source['model']::when(('Persidangan 5'), function ($query) use ($request) {
                    $query->where('room_id', ('Persidangan 5'));
                })
                ->when($request->input('user_id'), function ($query) use ($request) {
                    $query->where('user_id', $request->input('user_id'));
                })
                ->get();
            foreach ($models as $model) {
                $crudFieldValue = $model->getOriginal($source['date_field']);

                if (!$crudFieldValue) {
                    continue;
                }

                $events[] = [
                    'title' => trim($source['prefix'] . " " . $model->{$source['field']}
                        . " " . $source['suffix']),
                    'start' => $crudFieldValue,
                    
                ];
            }

        }

        return view('adminbooking.calendar.calendarp5', compact('events', 'rooms', 'users'));

    }

}
