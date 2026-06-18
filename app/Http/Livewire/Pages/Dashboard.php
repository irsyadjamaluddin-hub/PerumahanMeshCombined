<?php

namespace App\Http\Livewire\Pages;

use Livewire\Component;
use App\Models\IMS\AssetEntry;
use App\Models\IMS\Announcement;
use App\Models\IMS\Notification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class Dashboard extends Component
{
    public $notifications;
    public $availableAssetEntries;
    public $instockItemsWorth;
    public $issuedAssetEntries;
    public $announcements;

    public $files;

    public function mount()
    {
        $this->notifications = Notification::with('sender','receiver')->latest()->take(20)->get();

        $this->availableAssetEntries = AssetEntry::where('asset_status_id', 1)->get();
        $this->issuedAssetEntries = AssetEntry::where('asset_status_id', 4)->get();

        $this->instockItemsWorth = $this->availableAssetEntries->sum(function ($entry) {
            return $entry->unit_price;
        });

        $this->announcements = Announcement::all();

        // Path to the 'hd' folder
        $folderPath = public_path('ims-imgs/hd');

        // Get all files in the folder
        $this->files = File::files($folderPath);
    }

    public function render()
    {
        return view('livewire.pages.dashboard');
    }
}
