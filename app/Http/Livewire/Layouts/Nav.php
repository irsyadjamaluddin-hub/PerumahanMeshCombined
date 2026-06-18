<?php

namespace App\Http\Livewire\Layouts;

use App\Models\IMS\Siv;
use App\Models\IMS\Asset;
use App\Models\IMS\BinCard;
use Livewire\Component;
use App\Models\IMS\UserRole;
use App\Models\IMS\AssetEntry;
use App\Models\IMS\BukuDaftar;
use App\Models\IMS\Notification;
use Illuminate\Http\Request;
use App\Models\IMS\LejarSimpanan;
use App\Models\IMS\BorangPenyerahans;
use App\Models\IMS\MajlisBersamaRakyat;
use Illuminate\Support\Facades\Auth;

class Nav extends Component
{
    public $notifications;
    public $userRoles;

    public $finalQuery;
    public $searchInput;
    public $searchResults;

    public $borangPenyerahans;
    public $stockLedgers;
    public $assetEntries;
    public $bukuDaftars;
    public $binCards;
    public $sivs;

    public $majlisBersamaRakyats;
    public $userHasSearched;

    public $selectedFilters = [];

    public function mount()
    {
        $this->userRoles = UserRole::all();
        $this->notifications = Notification::all();

        $this->selectedFilters = [
            // "borangPenyerahan",
            // "siv",
            // "binCard",
            // "asset",
            "stockLedger",
            "bukuDaftar",
        ];

        $this->userHasSearched = false;
    }

    // Logic:
        // user can select multiple option
        // user can remove options
        // user can select all option
        // user can remove option

        // If user select one option, insert into array.
        // Same for remove.

        // foreach array-items, set '$this->optionNameStatus as true'
        // Set if($this->optionNameStatus) for each search items in search()

    public function selectFilter($option)
    {
        if (!in_array($option, $this->selectedFilters)) {

            // Insert value into array
            array_push($this->selectedFilters, $option);

            $this->search();

        } else {

            // Search key via value
            $index = array_search($option, $this->selectedFilters);

            // Remove from array
            if ($index !== false) {
                unset($this->selectedFilters[$index]);
            }

            $this->removeFilter($option);

        }
    }

    public function selectAllFilter()
    {
        $this->selectedFilters = [];
        $this->selectedFilters = [
            "borangPenyerahan",
            "siv",
            "binCard",
            "asset",
            "stockLedger",
            "bukuDaftar",
        ];

        $this->search();
    }

    public function removeFilter($option)
    {
        $index = array_search($option, $this->selectedFilters);

        if ($index !== false) {
            unset($this->selectedFilters[$index]);
        }

        // Clear data based on option removed
        if($option == 'borangPenyerahan'){
            $this->borangPenyerahans = null;
        }

        elseif ($option == 'siv') {
            $this->sivs = null;
        }

        elseif ($option == 'binCard') {
            $this->binCards = null;
        }

        elseif ($option == 'asset') {
            $this->assetEntries = null;
        }

        elseif ($option == 'stockLedger') {
            $this->stockLedgers = null;
        }

        elseif ($option == 'bukuDaftar') {
            $this->bukuDaftars = null;
        }

    }

    public function clearFilter()
    {
        $this->selectedFilters = [];

        // Set search results as null
        $this->borangPenyerahans = null;
        $this->sivs = null;
        $this->binCards = null;
        $this->assetEntries = null;
        $this->stockLedgers = null;
        $this->bukuDaftars = null;


    }

    public function singleRead($id)
    {

        // Bug: Kalau katik notification ia nda mark as 'read'. (FIXED) (ISSUE? SortBy filtered too early.)
        // Bug: Kalau form sudah ber-process, forward 'toast': "form already processed" and mark as read. Dont bring to 'process' page.

        // How to check if form already processed?
        // Check signed or not

        $notification = Notification::where('id', $id)->first();

        Notification::where('id', $id)->where('read', 'no')->update(['read' => 'yes']);

        // Refresh the notifications after updating
        $this->notifications = Notification::all();

        $reference_id = $notification->reference_id;

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

    public function readAll()
    {
        // dd(Notification::where('receiver_id', auth()->guard('ims')->user()->id)->where('read', 'no')->get());
        Notification::where('receiver_id', auth()->guard('ims')->user()->id)->where('read', 'no')->update(['read' => 'yes']);

        // Refresh the notifications after updating
        $this->notifications = Notification::all();
    }

    public function search()
    {
        $this->userHasSearched = true;

        // Search Bar
        if (isset($this->searchInput)) {

            $explodedKeyWord = explode(" ", $this->searchInput);

            foreach ($explodedKeyWord as $keyWord) {

                // "borangPenyerahan",
                // "siv",
                // "binCard",
                // "asset",
                // "stockLedger",
                // "bukuDaftar",

                if (in_array('borangPenyerahan', $this->selectedFilters)){
                    $this->borangPenyerahans = BorangPenyerahans::with('siv')
                        ->where('bp_no', 'like', "%$keyWord%")
                        ->take(5)
                        ->get();
                }

                if (in_array('siv', $this->selectedFilters)){
                    $this->sivs = Siv::
                            // where('siv_no', 'like', "%$keyWord%")
                            // ->orWhere('reference_for_request', 'like', "%$keyWord%")
                            where(function ($query) use ($keyWord) {
                                $query->where('siv_no', 'like', "%$keyWord%")
                                    ->orWhere('reference_for_request', 'like', "%$keyWord%")
                                    ->orWhereHas('internalUser', function ($queryOne) use ($keyWord) {
                                        $queryOne->where('full_name', 'like', "%$keyWord%");
                                    })
                                    ->orWhereHas('externalUser', function ($queryTwo) use ($keyWord) {
                                        $queryTwo->where('name', 'like', "%$keyWord%");
                                    });
                            })
                            ->take(5)
                            ->get();
                }

                if (in_array('binCard', $this->selectedFilters)){
                    $this->binCards = BinCard::where('bin_no', 'like', "%$keyWord%")
                            ->orWhereHas('asset', function ($query) use ($keyWord) {
                                $query->where('name', 'like', "%$keyWord%");
                            })
                            ->take(5)
                            ->get();
                }

                if (in_array('asset', $this->selectedFilters)){
                    $this->assetEntries = AssetEntry::with('asset')
                            ->whereHas('asset', function ($query) use ($keyWord) {
                                $query->where(function ($subQuery) use ($keyWord) {
                                    $subQuery->where('name', 'like', "%$keyWord%")
                                        ->orWhere('moe_reference', 'like', "%$keyWord%");
                                });
                            })
                            ->take(5)
                            ->get();
                }

                if (in_array('stockLedger', $this->selectedFilters)){
                    $this->stockLedgers = LejarSimpanan::where('moe_reference', 'like', "%$keyWord%")
                            ->orWhereHas('deliveryOrder', function ($query) use ($keyWord) {
                                $query->where('do_no', 'like', "%$keyWord%");
                            })
                            ->orWhereHas('vendor', function ($query) use ($keyWord) {
                                $query->where('name', 'like', "%$keyWord%");
                            })
                            ->take(5)
                            ->get();
                }

                if (in_array('bukuDaftar', $this->selectedFilters)){
                    $this->bukuDaftars = BukuDaftar::where('moe_reference', 'like', "%$keyWord%")
                            ->orWhereHas('deliveryOrder', function ($query) use ($keyWord) {
                                $query->where('do_no', 'like', "%$keyWord%");
                            })
                            ->orWhereHas('vendor', function ($query) use ($keyWord) {
                                $query->where('name', 'like', "%$keyWord%");
                            })
                            ->take(5)
                            ->get();
                }

            }

        }
    }

    public function clearSearch()
    {
        $this->searchInput = null;
        $this->searchResults = null;
    }

    public function viewAll()
    {
        return redirect()->route('ims.viewNotification');
    }

    public function render()
    {
        return view('livewire.layouts.nav');
    }
}
