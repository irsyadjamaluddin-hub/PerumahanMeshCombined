<?php

namespace App\Http\Livewire\Pages\StaffBoard;

use Carbon\Carbon;
use App\Models\IMS\User;
use Livewire\Component;
use App\Models\IMS\StaffBoard;
use Illuminate\Support\Facades\Auth;

class View extends Component
{
    public $dateNow;
    public $staffs;

    public $inputDate;
    public $inputMeridiem;
    public $inputMessage;

    public $currentStatus = [];

    // protected $rules = [
    //     'inputMessage' => 'required|min:6|min:2|max:100|',
    //     'inputMeridiem' => 'required|min:2|max:10',
    //     'inputDate' => 'required|min:2|max:10',
    // ];

    public function mount()
    {
        $this->dateNow = Carbon::now()->timezone('Asia/Brunei')->format('l, jS F Y');
        $this->staffs = User::with('staffBoards')->get();

        foreach($this->staffs as $staff){

            $this->currentStatus[$staff->id] = $staff->status;

        }

    }

    public function inOut($userId, $status)
    {
        // Check if user is admin or current user
        if($userId == auth()->guard('ims')->user()->id || Auth::guard('ims')->user()->hasRole('admin') ){

            if($status == "in"){

                $this->currentStatus[$userId] = "out";

                User::where('id', $userId)->update(['status' => 'out']);

            } elseif($status == "out"){

                $this->currentStatus[$userId] = "in";

                User::where('id', $userId)->update(['status' => 'in']);
            }

        } else {

            $data = [
                'position' => 'top-right',
                'type' => 'warning',
                'message' => 'Warning',
                'description' => 'You notty2.. set your own in/out status.',
            ];

            $this->dispatchBrowserEvent('toast-show', $data);

        }

    }

    public function saveMovement()
    {

        if(empty($this->inputDate)){

            $data = [
                'position' => 'top-right',
                'type' => 'warning',
                'message' => 'Warning',
                'description' => 'Please fill in the date.',
            ];

            $this->dispatchBrowserEvent('toast-show', $data);

        } elseif(empty($this->inputMeridiem)){

            $data = [
                'position' => 'top-right',
                'type' => 'warning',
                'message' => 'Warning',
                'description' => 'Please select AM or PM.',
            ];

            $this->dispatchBrowserEvent('toast-show', $data);

        } elseif(empty($this->inputMessage)){

            $data = [
                'position' => 'top-right',
                'type' => 'warning',
                'message' => 'Warning',
                'description' => 'Please fill in the Message field.',
            ];

            $this->dispatchBrowserEvent('toast-show', $data);

        } elseif(!empty($this->inputDate) && !empty($this->inputMeridiem) && !empty($this->inputMessage)) {

            //Create StaffBoard
            $createStaffBoard = StaffBoard::create([
                'message' => $this->inputMessage,
                'meridiem' => $this->inputMeridiem,
                'date' => $this->inputDate,
                'status' => 'on',
                'staff_id' => auth()->guard('ims')->user()->id,
            ]);

            $prevData = [
                'message' => 'Success',
                'description' => 'Your movement has successfully been posted!',
            ];

            return redirect()->route('ims.viewStaffBoard')->with('success', $prevData);

        }

    }

    public function removeMovement($id)
    {
        StaffBoard::where('id', $id)->update(['status' => 'off']);

        $prevData = [
            'message' => 'Success',
            'description' => 'Movement post removed!',
        ];

        return redirect()->route('ims.viewStaffBoard')->with('success', $prevData);
    }

    public function render()
    {
        return view('livewire.pages.staff-board.view');
    }
}
