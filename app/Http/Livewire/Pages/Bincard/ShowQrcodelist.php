<?php

namespace App\Http\Livewire\Pages\Bincard;

use App\Models\IMS\BinCard;
use Livewire\Component;

class ShowQrcodelist extends Component
{
    public $trueSelectedOnes;
    public $binCards;

    public function mount()
    {
        // Dummy data. Remove when done.
        // $this->trueSelectedOnes = [
        //     145 => true,
        //     146 => true,
        //     147 => true,
        //     148 => true,
        // ];

        // dd(session('trueSelectedOnes'));

        $this->binCards = BinCard::with('asset.assetCategoryCode.mainAssetCategoryCode')->get();

        // if ($this->trueSelectedOnes) {
        if (session('trueSelectedOnes') !== null) {

            // Data from Qrcodelist.php > public function confirmAndProceed()
            if(count(session('trueSelectedOnes')) > 0){
                $this->trueSelectedOnes = session('trueSelectedOnes');
            }

        } else {

            // ---------------------------------------------------------------
            // IMPORTANT!
            // ---------------------------------------------------------------
            // Forward user back to previous page if there are no selected
            // bincards. Page content depends on selection.
            // ---------------------------------------------------------------

            // ---------------------------------------------------------------
            // SUCCESS MESSAGE
            // ---------------------------------------------------------------

            $prevData = [
                'message' => 'No Bin Card Selected!',
                'description' => 'Please select the bin-card(s) first!',
            ];

            return redirect()->route('ims.qrCodeList')->with('warning', $prevData);

        }

    }

    public function render()
    {
        return view('livewire.pages.bincard.show-qrcodelist');
    }
}
