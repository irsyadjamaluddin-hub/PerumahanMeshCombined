<?php

namespace App\Http\Livewire\Pages\Notification;

use Livewire\Component;
use App\Models\IMS\UserRole;
use App\Models\IMS\Notification;

class View extends Component
{
    public $notifications;
    public $userRoles;

    public function mount()
    {
        $this->userRoles = UserRole::all();

        $roleIds = [];

        foreach ($this->userRoles->where('user_id', auth()->guard('ims')->user()->id) as $userRole){
            $roleIds[] = $userRole->role_id;
        }

        $this->notifications = Notification::all()
            ->whereIn('receiver_role_id', $roleIds)
            ->whereIn('receiver_id', auth()->guard('ims')->user()->id)
            ->sortByDesc('created_at')
            // ->sortBy(function ($notification) {
            //     return $notification->read === 'no' ? 0 : 1;
            // })
            ->take(10);
    }

    public function singleRead($id)
    {

        $notification = Notification::where('id', $id)->first();

        Notification::where('id', $id)->where('read', 'no')->update(['read' => 'yes']);

        // Refresh the notifications after updating
        $this->notifications = Notification::all();

        $reference_id = Notification::where('id', $id)->first()->reference_id;

        if($notification->reference_type == "request_for_siv"){

            return redirect()->route('ims.processRequestSiv', [
                'id' => $reference_id
            ]);

        } elseif($notification->reference_type == "siv") {

            return redirect()->route('ims.processSiv', [
                'id' => $reference_id
            ]);

        } elseif($notification->reference_type == "siv-download") {

            return redirect()->route('ims.showPdf', [
                'id' => $reference_id
            ]);

        } elseif($notification->reference_type == "pre-penyerahan") {

            return redirect()->route('ims.showPenyerahan', [
                'id' => $reference_id
            ]);

        }
    }

    public function render()
    {
        return view('livewire.pages.notification.view');
    }
}
