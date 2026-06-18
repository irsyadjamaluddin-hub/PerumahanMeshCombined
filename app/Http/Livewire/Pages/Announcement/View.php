<?php

namespace App\Http\Livewire\Pages\Announcement;

use App\Models\IMS\Vendor;
use Livewire\Component;
use App\Models\IMS\Announcement;
use Livewire\WithPagination;

class View extends Component
{
    use WithPagination;

    public $message;

    public function mount()
    {
    }

    public function paginationView()
    {
        return 'livewire.components.custom-pagination';
    }

    public function deleteAnnouncement($id)
    {
        $announcement = Announcement::find($id);
        $announcement->delete();

        // Forward user to same page + toast
        $prevData = [
            'message' => 'Success',
            'description' => 'Announcement successfully deleted!',
        ];

        return redirect()->route('ims.viewAnnouncements')->with('success', $prevData);
    }

    public function createAnnouncement()
    {
        $ann = new Announcement;
        $ann->message = $this->message;
        $ann->created_by = auth()->guard('ims')->user()->id;
        $ann->save();

        // Forward user to same page + toast
        $prevData = [
            'message' => 'Success',
            'description' => 'New announcement successfully created!',
        ];

        return redirect()->route('ims.viewAnnouncements')->with('success', $prevData);
    }

    public function render()
    {
        $announcements = Announcement::with('user')->paginate(10);

        return view('livewire.pages.announcement.view', [
            'announcements' => $announcements,
        ]);

    }
}
