<?php

namespace App\Http\Livewire\Pages\Ledger;

use Carbon\Carbon;
use App\Models\IMS\Srv;
use Livewire\Component;
use App\Models\IMS\User;
use App\Models\IMS\Asset;
use App\Models\IMS\Store;
use App\Rules\UniqueDoNo;
use App\Rules\UniquePoNo;
use App\Models\IMS\Vendor;
use App\Rules\UniqueSrvNo;
// use App\Models\IMS\QuantityUnit;
use App\Models\IMS\BinCard;
use App\Models\IMS\Invoice;
use App\Models\IMS\AssetEntry;
use App\Rules\UniqueInvoiceNo;
use App\Models\IMS\AssetStatus;
use App\Models\IMS\BinCardEntry;
use App\Models\IMS\DeliveryOrder;
use App\Models\IMS\LejarSimpanan;
use App\Models\IMS\PurchaseOrder;
use Illuminate\Support\Facades\Auth;
use App\Models\IMS\AssetCategoryCode;
use App\Models\IMS\AssetEntrySetItem;
use App\Models\IMS\LejarSimpananEntry;

class Create extends Component
{
    // Contact Person or Staff
    public $searchStaffInput;
    public $searchStaffResults;

    // MainAsset
    // public $mainAssetName;
    public $searchMainAssetResults;

    // Store
    public $stores;

    // Vendor
    public $searchVendorInput;
    public $searchVendorResults;
    public $vendorExists;

    // Asset Details
    public $mainAssetId;
    public $mainAssetName;
    public $mainAssetCategoryCode;
    public $mainAssetQuantity;
    // public $mainAssetQuantityUnit;
    public $mainAssetUnitPrice;
    public $mainAssetInputs = [0 => 1];
    public $mainAssetCounter = 1;

    public $mainAssetSearchQueryInputs = [0 => null];
    public $mainAssetSearchQueryCounter = 1;
    public $mainAssetSearchResults;

    public $selectedMainAssetIds = [0 => null];

    // Sub-Assets
    public $subAssetInputs = [0 => 1];
    public $subAssetCounter = 0;

    // Subasset's MOERefs
    public $subAssetMoeRefs = [0 => []];

    public $viewAllSubAsset = [0 => false];
    public $viewAllSubAssetCounter = 0;
    public $serialNo;

    // public $quantityUnits;
    public $assetCategoryCodes;

    // SetItems
    public $subAssetSetItems = [0 => null];
    // public $viewSubAssetSetItems = [0 => false];
    public $subAssetSetItemCounter = 0;
    // Prevent user from entering infinite number, due to subAsset number generated based on quantity input. e.g: 1000+ will make system crash
    public $maxQuantity = 11;

    // Ledger Code
    public $ledgerCode;

    // MOE Reference
    public $moeRef;

    // Purchase Order (PO)
    public $poNo;
    public $poDate;
    public $poQuotationNo;
    public $poContactPerson;

    // Invoice
    public $invoiceNo;
    public $invoiceIssuanceDate;

    // Delivery Order
    public $doNo;
    public $doIssuanceDate;

    public $doSignerId;
    public $doSignerInput;
    public $doSignerInputMessage;
    public $doSignerResults;
    public $doSigningDate;

    // Store Receipt Voucher (SRV)
    public $srvNo;
    public $srvSignatureDate;

    // Vendor
    // public $vendorName;
    public $vendorPhoneNo;
    public $vendorEmail;
    public $vendorAddress;
    public $searchVendorInputMessage;

    // Store Location
    public $storeLocationFloor;

    // Contact Person
    public $contactPersonId;
    public $contactPersonMessage;

    // Remarks
    public $remarks;

    public $testDump;

    public $toastMessage;
    public $toastDescription;

    public $financialYear;

    public function mount()
    {
        // $this->financialYear = "2023";

        // Ledger Code Default Value
        $this->ledgerCode = "MOE/ICT/" . "[FIN-YEAR]" . "/[PO-NUMBER]";
        $this->ledgerCode = str_replace(' ', '', $this->ledgerCode);

        $this->vendorExists = false;

        $this->assetCategoryCodes = AssetCategoryCode::where('deleted', 'no')->get();

        $this->storeLocationFloor = 1;

    }

    public function warningToast($prevData)
    {
        $data = [
            'position' => 'top-right',
            'type' => 'warning',
            'message' => $prevData['message'],
            'description' => $prevData['description'],
        ];

        $this->dispatchBrowserEvent('toast-show', $data);
    }

    public function updatedFinancialYear() {

        // Change financial year according to input
        if(isset($this->financialYear)){

            if(isset($this->poNo)){

                $this->ledgerCode = "MOE/ICT/" . $this->financialYear . "/" . strtoupper ($this->poNo);

                // Update Sub-Assets' PO No.
                if(isset($this->subAssetMoeRefs)){

                    foreach($this->subAssetMoeRefs as $subAssetMoeRefKey => $subAssetMoeRefValues){

                        $i = 1;

                        foreach ($subAssetMoeRefValues as $subAssetMoeRefValueKey => $subAssetMoeRefValueValue ) {

                            // Check The Key's Position In The Array, for Bracketed Number in MOE Ref
                            // e.g MOE Ref = MOE/ICT/2024/LABORISVELITREICI/C2/(1)/01-05;
                            $position = array_search($subAssetMoeRefKey, array_keys($this->subAssetInputs)) + 1;
                            $newTotal = count($this->subAssetMoeRefs[$subAssetMoeRefKey]);
                            $categoryCodeRecord = $this->assetCategoryCodes->where('id', $this->mainAssetCategoryCode[$subAssetMoeRefKey])->first();

                            if ($categoryCodeRecord) {

                                $categoryCode = $categoryCodeRecord->code;

                                $moeRefValue = $this->ledgerCode . "/" . $categoryCode . "/(" . $position . ")/" . sprintf("%02d", $i) . "-" . sprintf("%02d", $newTotal) ;
                                $this->subAssetMoeRefs[$subAssetMoeRefKey][$subAssetMoeRefValueKey][0] = $moeRefValue;
                                $i++;

                            }

                        }
                    }

                }

                // Update Sub-Asset Set-Item's PO No.
                if(isset($this->subAssetMoeRefs)){

                    foreach($this->subAssetMoeRefs as $subAssetMoeRefKey => $subAssetMoeRefValues){

                        foreach ($subAssetMoeRefValues as $subAssetMoeRefValueKey => $subAssetMoeRefValueValue ) {

                            // Get the Index and Total from SubAsset's MOE Ref. e.g (MOE/XXX/XX/01-03)
                            $subAssetMoeRef = $subAssetMoeRefValueValue[0];
                            $value = basename($subAssetMoeRef);
                            $value = explode('/', $value);
                            $indexAndTotal = end($value);

                            foreach($this->subAssetSetItems[$subAssetMoeRefKey][$subAssetMoeRefValueKey] as $subAssetItemKey => $subAssetItemValues){

                                // CategoryCode
                                // $subAssetItemValues[1];

                                if($subAssetItemValues[1] !== "") {

                                    $categoryCodeRecord = $this->assetCategoryCodes->where('id', $subAssetItemValues[1])->first();

                                    if ($categoryCodeRecord) {

                                        $categoryCode = $categoryCodeRecord->code;
                                        $moeRefValue = $this->ledgerCode . "/" . $categoryCode . "/" . $indexAndTotal;
                                        $this->subAssetSetItems[$subAssetMoeRefKey][$subAssetMoeRefValueKey][$subAssetItemKey][2] = $moeRefValue;

                                    }

                                }

                            }

                        }
                    }
                }

            } else {

                $this->ledgerCode = "MOE/ICT/" . $this->financialYear . "/[PO-NUMBER]";

                // Update Sub-Assets' PO No.
                if(isset($this->subAssetMoeRefs)){

                    foreach($this->subAssetMoeRefs as $subAssetMoeRefKey => $subAssetMoeRefValues){

                        $i = 1;

                        foreach ($subAssetMoeRefValues as $subAssetMoeRefValueKey => $subAssetMoeRefValueValue ) {

                            // Check The Key's Position In The Array, for Bracketed Number in MOE Ref
                            // e.g MOE Ref = MOE/ICT/2024/LABORISVELITREICI/C2/(1)/01-05;
                            $position = array_search($subAssetMoeRefKey, array_keys($this->subAssetInputs)) + 1;
                            $newTotal = count($this->subAssetMoeRefs[$subAssetMoeRefKey]);
                            $categoryCodeRecord = $this->assetCategoryCodes->where('id', $this->mainAssetCategoryCode[$subAssetMoeRefKey])->first();

                            if ($categoryCodeRecord) {

                                $categoryCode = $categoryCodeRecord->code;

                                $moeRefValue = $this->ledgerCode . "/" . $categoryCode . "/(" . $position . ")/" . sprintf("%02d", $i) . "-" . sprintf("%02d", $newTotal) ;
                                $this->subAssetMoeRefs[$subAssetMoeRefKey][$subAssetMoeRefValueKey][0] = $moeRefValue;
                                $i++;

                            }

                        }
                    }

                }

                // Update Sub-Asset Set-Item's PO No.
                if(isset($this->subAssetMoeRefs)){

                    foreach($this->subAssetMoeRefs as $subAssetMoeRefKey => $subAssetMoeRefValues){

                        foreach ($subAssetMoeRefValues as $subAssetMoeRefValueKey => $subAssetMoeRefValueValue ) {

                            // Get the Index and Total from SubAsset's MOE Ref. e.g (MOE/XXX/XX/01-03)
                            $subAssetMoeRef = $subAssetMoeRefValueValue[0];
                            $value = basename($subAssetMoeRef);
                            $value = explode('/', $value);
                            $indexAndTotal = end($value);

                            foreach($this->subAssetSetItems[$subAssetMoeRefKey][$subAssetMoeRefValueKey] as $subAssetItemKey => $subAssetItemValues){

                                // CategoryCode
                                // $subAssetItemValues[1];

                                if($subAssetItemValues[1] !== "") {

                                    $categoryCodeRecord = $this->assetCategoryCodes->where('id', $subAssetItemValues[1])->first();

                                    if ($categoryCodeRecord) {

                                        $categoryCode = $categoryCodeRecord->code;
                                        $moeRefValue = $this->ledgerCode . "/" . $categoryCode . "/" . $indexAndTotal;
                                        $this->subAssetSetItems[$subAssetMoeRefKey][$subAssetMoeRefValueKey][$subAssetItemKey][2] = $moeRefValue;

                                    }

                                }

                            }

                        }
                    }
                }

            }

        } else {

            if(isset($this->poNo)){

                $this->ledgerCode = "MOE/ICT/" . "[FIN-YEAR]" . "/" . strtoupper ($this->poNo);

                // Update Sub-Assets' PO No.
                if(isset($this->subAssetMoeRefs)){

                    foreach($this->subAssetMoeRefs as $subAssetMoeRefKey => $subAssetMoeRefValues){

                        $i = 1;

                        foreach ($subAssetMoeRefValues as $subAssetMoeRefValueKey => $subAssetMoeRefValueValue ) {

                            // Check The Key's Position In The Array, for Bracketed Number in MOE Ref
                            // e.g MOE Ref = MOE/ICT/2024/LABORISVELITREICI/C2/(1)/01-05;
                            $position = array_search($subAssetMoeRefKey, array_keys($this->subAssetInputs)) + 1;
                            $newTotal = count($this->subAssetMoeRefs[$subAssetMoeRefKey]);
                            $categoryCodeRecord = $this->assetCategoryCodes->where('id', $this->mainAssetCategoryCode[$subAssetMoeRefKey])->first();

                            if ($categoryCodeRecord) {

                                $categoryCode = $categoryCodeRecord->code;

                                $moeRefValue = $this->ledgerCode . "/" . $categoryCode . "/(" . $position . ")/" . sprintf("%02d", $i) . "-" . sprintf("%02d", $newTotal) ;
                                $this->subAssetMoeRefs[$subAssetMoeRefKey][$subAssetMoeRefValueKey][0] = $moeRefValue;
                                $i++;

                            }

                        }
                    }

                }

                // Update Sub-Asset Set-Item's PO No.
                if(isset($this->subAssetMoeRefs)){

                    foreach($this->subAssetMoeRefs as $subAssetMoeRefKey => $subAssetMoeRefValues){

                        foreach ($subAssetMoeRefValues as $subAssetMoeRefValueKey => $subAssetMoeRefValueValue ) {

                            // Get the Index and Total from SubAsset's MOE Ref. e.g (MOE/XXX/XX/01-03)
                            $subAssetMoeRef = $subAssetMoeRefValueValue[0];
                            $value = basename($subAssetMoeRef);
                            $value = explode('/', $value);
                            $indexAndTotal = end($value);

                            foreach($this->subAssetSetItems[$subAssetMoeRefKey][$subAssetMoeRefValueKey] as $subAssetItemKey => $subAssetItemValues){

                                // CategoryCode
                                // $subAssetItemValues[1];

                                if($subAssetItemValues[1] !== "") {

                                    $categoryCodeRecord = $this->assetCategoryCodes->where('id', $subAssetItemValues[1])->first();

                                    if ($categoryCodeRecord) {

                                        $categoryCode = $categoryCodeRecord->code;
                                        $moeRefValue = $this->ledgerCode . "/" . $categoryCode . "/" . $indexAndTotal;
                                        $this->subAssetSetItems[$subAssetMoeRefKey][$subAssetMoeRefValueKey][$subAssetItemKey][2] = $moeRefValue;

                                    }

                                }

                            }

                        }
                    }
                }

            } else {

                $this->ledgerCode = "MOE/ICT/" . "[FIN-YEAR]" . "/[PO-NUMBER]";

                // Update Sub-Assets' PO No.
                if(isset($this->subAssetMoeRefs)){

                    foreach($this->subAssetMoeRefs as $subAssetMoeRefKey => $subAssetMoeRefValues){

                        $i = 1;

                        foreach ($subAssetMoeRefValues as $subAssetMoeRefValueKey => $subAssetMoeRefValueValue ) {

                            // Check The Key's Position In The Array, for Bracketed Number in MOE Ref
                            // e.g MOE Ref = MOE/ICT/2024/LABORISVELITREICI/C2/(1)/01-05;
                            $position = array_search($subAssetMoeRefKey, array_keys($this->subAssetInputs)) + 1;
                            $newTotal = count($this->subAssetMoeRefs[$subAssetMoeRefKey]);
                            $categoryCodeRecord = $this->assetCategoryCodes->where('id', $this->mainAssetCategoryCode[$subAssetMoeRefKey])->first();

                            if ($categoryCodeRecord) {

                                $categoryCode = $categoryCodeRecord->code;

                                $moeRefValue = $this->ledgerCode . "/" . $categoryCode . "/(" . $position . ")/" . sprintf("%02d", $i) . "-" . sprintf("%02d", $newTotal) ;
                                $this->subAssetMoeRefs[$subAssetMoeRefKey][$subAssetMoeRefValueKey][0] = $moeRefValue;
                                $i++;

                            }

                        }
                    }

                }

                // Update Sub-Asset Set-Item's PO No.
                if(isset($this->subAssetMoeRefs)){

                    foreach($this->subAssetMoeRefs as $subAssetMoeRefKey => $subAssetMoeRefValues){

                        foreach ($subAssetMoeRefValues as $subAssetMoeRefValueKey => $subAssetMoeRefValueValue ) {

                            // Get the Index and Total from SubAsset's MOE Ref. e.g (MOE/XXX/XX/01-03)
                            $subAssetMoeRef = $subAssetMoeRefValueValue[0];
                            $value = basename($subAssetMoeRef);
                            $value = explode('/', $value);
                            $indexAndTotal = end($value);

                            foreach($this->subAssetSetItems[$subAssetMoeRefKey][$subAssetMoeRefValueKey] as $subAssetItemKey => $subAssetItemValues){

                                // CategoryCode
                                // $subAssetItemValues[1];

                                if($subAssetItemValues[1] !== "") {

                                    $categoryCodeRecord = $this->assetCategoryCodes->where('id', $subAssetItemValues[1])->first();

                                    if ($categoryCodeRecord) {

                                        $categoryCode = $categoryCodeRecord->code;
                                        $moeRefValue = $this->ledgerCode . "/" . $categoryCode . "/" . $indexAndTotal;
                                        $this->subAssetSetItems[$subAssetMoeRefKey][$subAssetMoeRefValueKey][$subAssetItemKey][2] = $moeRefValue;

                                    }

                                }

                            }

                        }
                    }
                }

            }

        }

        // Remove spaces from ledgercode
        $this->ledgerCode = str_replace(' ', '', $this->ledgerCode);

    }

    // Update LedgerCode when PO No. is updated
    public function updatedPoNo() {

        if(isset($this->poNo)){

            if(isset($this->financialYear)){

                $this->ledgerCode = "MOE/ICT/" . $this->financialYear . "/" . strtoupper ($this->poNo);

                // Change Sub-Assets' PO No.
                if(isset($this->subAssetMoeRefs)){

                    foreach($this->subAssetMoeRefs as $subAssetMoeRefKey => $subAssetMoeRefValues){

                        $i = 1;

                        foreach ($subAssetMoeRefValues as $subAssetMoeRefValueKey => $subAssetMoeRefValueValue ) {

                            // Check The Key's Position In The Array, for Bracketed Number in MOE Ref
                            $position = array_search($subAssetMoeRefKey, array_keys($this->subAssetInputs)) + 1;
                            $newTotal = count($this->subAssetMoeRefs[$subAssetMoeRefKey]);
                            $categoryCodeRecord = $this->assetCategoryCodes->where('id', $this->mainAssetCategoryCode[$subAssetMoeRefKey])->first();

                            if ($categoryCodeRecord) {

                                $categoryCode = $categoryCodeRecord->code;

                                $moeRefValue = $this->ledgerCode . "/" . $categoryCode . "/(" . $position . ")/" . sprintf("%02d", $i) . "-" . sprintf("%02d", $newTotal) ;
                                $this->subAssetMoeRefs[$subAssetMoeRefKey][$subAssetMoeRefValueKey][0] = $moeRefValue;
                                $i++;

                            }

                        }
                    }

                }

                // Change Sub-Asset Set-Item's PO No.
                if(isset($this->subAssetMoeRefs)){

                    foreach($this->subAssetMoeRefs as $subAssetMoeRefKey => $subAssetMoeRefValues){

                        foreach ($subAssetMoeRefValues as $subAssetMoeRefValueKey => $subAssetMoeRefValueValue ) {

                            // Get the Index and Total from SubAsset's MOE Ref. e.g (MOE/XXX/XX/01-03)
                            $subAssetMoeRef = $subAssetMoeRefValueValue[0];
                            $value = basename($subAssetMoeRef);
                            $value = explode('/', $value);
                            $indexAndTotal = end($value);

                            foreach($this->subAssetSetItems[$subAssetMoeRefKey][$subAssetMoeRefValueKey] as $subAssetItemKey => $subAssetItemValues){

                                // CategoryCode
                                // $subAssetItemValues[1];

                                if($subAssetItemValues[1] !== "") {

                                    $categoryCodeRecord = $this->assetCategoryCodes->where('id', $subAssetItemValues[1])->first();

                                    if ($categoryCodeRecord) {

                                        $categoryCode = $categoryCodeRecord->code;
                                        $moeRefValue = $this->ledgerCode . "/" . $categoryCode . "/" . $indexAndTotal;
                                        $this->subAssetSetItems[$subAssetMoeRefKey][$subAssetMoeRefValueKey][$subAssetItemKey][2] = $moeRefValue;

                                    }

                                }

                            }

                        }
                    }
                }

            } else {

                $this->ledgerCode = "MOE/ICT/" . "[FIN-YEAR]" . "/" . strtoupper ($this->poNo);

                // Change Sub-Assets' PO No.
                if(isset($this->subAssetMoeRefs)){

                    foreach($this->subAssetMoeRefs as $subAssetMoeRefKey => $subAssetMoeRefValues){

                        $i = 1;

                        foreach ($subAssetMoeRefValues as $subAssetMoeRefValueKey => $subAssetMoeRefValueValue ) {

                            // Check The Key's Position In The Array, for Bracketed Number in MOE Ref
                            $position = array_search($subAssetMoeRefKey, array_keys($this->subAssetInputs)) + 1;
                            $newTotal = count($this->subAssetMoeRefs[$subAssetMoeRefKey]);
                            $categoryCodeRecord = $this->assetCategoryCodes->where('id', $this->mainAssetCategoryCode[$subAssetMoeRefKey])->first();

                            if ($categoryCodeRecord) {

                                $categoryCode = $categoryCodeRecord->code;

                                $moeRefValue = $this->ledgerCode . "/" . $categoryCode . "/(" . $position . ")/" . sprintf("%02d", $i) . "-" . sprintf("%02d", $newTotal) ;
                                $this->subAssetMoeRefs[$subAssetMoeRefKey][$subAssetMoeRefValueKey][0] = $moeRefValue;
                                $i++;

                            }

                        }
                    }

                }

                // Change Sub-Asset Set-Item's PO No.
                if(isset($this->subAssetMoeRefs)){

                    foreach($this->subAssetMoeRefs as $subAssetMoeRefKey => $subAssetMoeRefValues){

                        foreach ($subAssetMoeRefValues as $subAssetMoeRefValueKey => $subAssetMoeRefValueValue ) {

                            // Get the Index and Total from SubAsset's MOE Ref. e.g (MOE/XXX/XX/01-03)
                            $subAssetMoeRef = $subAssetMoeRefValueValue[0];
                            $value = basename($subAssetMoeRef);
                            $value = explode('/', $value);
                            $indexAndTotal = end($value);

                            foreach($this->subAssetSetItems[$subAssetMoeRefKey][$subAssetMoeRefValueKey] as $subAssetItemKey => $subAssetItemValues){

                                // CategoryCode
                                // $subAssetItemValues[1];

                                if($subAssetItemValues[1] !== "") {

                                    $categoryCodeRecord = $this->assetCategoryCodes->where('id', $subAssetItemValues[1])->first();

                                    if ($categoryCodeRecord) {

                                        $categoryCode = $categoryCodeRecord->code;
                                        $moeRefValue = $this->ledgerCode . "/" . $categoryCode . "/" . $indexAndTotal;
                                        $this->subAssetSetItems[$subAssetMoeRefKey][$subAssetMoeRefValueKey][$subAssetItemKey][2] = $moeRefValue;

                                    }

                                }

                            }

                        }
                    }
                }

            }

        } else {

            if(isset($this->financialYear)){

                $this->ledgerCode = "MOE/ICT/" . $this->financialYear . "/" . "[PO-NUMBER]";

                // Change Sub-Assets' PO No.
                if(isset($this->subAssetMoeRefs)){

                    foreach($this->subAssetMoeRefs as $subAssetMoeRefKey => $subAssetMoeRefValues){

                        $i = 1;

                        foreach ($subAssetMoeRefValues as $subAssetMoeRefValueKey => $subAssetMoeRefValueValue ) {

                            // Check The Key's Position In The Array, for Bracketed Number in MOE Ref
                            $position = array_search($subAssetMoeRefKey, array_keys($this->subAssetInputs)) + 1;
                            $newTotal = count($this->subAssetMoeRefs[$subAssetMoeRefKey]);
                            $categoryCodeRecord = $this->assetCategoryCodes->where('id', $this->mainAssetCategoryCode[$subAssetMoeRefKey])->first();

                            if ($categoryCodeRecord) {

                                $categoryCode = $categoryCodeRecord->code;

                                $moeRefValue = $this->ledgerCode . "/" . $categoryCode . "/(" . $position . ")/" . sprintf("%02d", $i) . "-" . sprintf("%02d", $newTotal) ;
                                $this->subAssetMoeRefs[$subAssetMoeRefKey][$subAssetMoeRefValueKey][0] = $moeRefValue;
                                $i++;

                            }

                        }
                    }

                }

                // Change Sub-Asset Set-Item's PO No.
                if(isset($this->subAssetMoeRefs)){

                    foreach($this->subAssetMoeRefs as $subAssetMoeRefKey => $subAssetMoeRefValues){

                        foreach ($subAssetMoeRefValues as $subAssetMoeRefValueKey => $subAssetMoeRefValueValue ) {

                            // Get the Index and Total from SubAsset's MOE Ref. e.g (MOE/XXX/XX/01-03)
                            $subAssetMoeRef = $subAssetMoeRefValueValue[0];
                            $value = basename($subAssetMoeRef);
                            $value = explode('/', $value);
                            $indexAndTotal = end($value);

                            foreach($this->subAssetSetItems[$subAssetMoeRefKey][$subAssetMoeRefValueKey] as $subAssetItemKey => $subAssetItemValues){

                                // CategoryCode
                                // $subAssetItemValues[1];

                                if($subAssetItemValues[1] !== "") {

                                    $categoryCodeRecord = $this->assetCategoryCodes->where('id', $subAssetItemValues[1])->first();

                                    if ($categoryCodeRecord) {

                                        $categoryCode = $categoryCodeRecord->code;
                                        $moeRefValue = $this->ledgerCode . "/" . $categoryCode . "/" . $indexAndTotal;
                                        $this->subAssetSetItems[$subAssetMoeRefKey][$subAssetMoeRefValueKey][$subAssetItemKey][2] = $moeRefValue;

                                    }

                                }

                            }

                        }
                    }
                }

            } else {

                $this->ledgerCode = "MOE/ICT/" . "[FIN-YEAR]" . "/ [PO-NUMBER]" ;

                // Change Sub-Assets' PO No.
                if(isset($this->subAssetMoeRefs)){

                    foreach($this->subAssetMoeRefs as $subAssetMoeRefKey => $subAssetMoeRefValues){

                        $i = 1;

                        foreach ($subAssetMoeRefValues as $subAssetMoeRefValueKey => $subAssetMoeRefValueValue ) {

                            // Check The Key's Position In The Array, for Bracketed Number in MOE Ref
                            $position = array_search($subAssetMoeRefKey, array_keys($this->subAssetInputs)) + 1;
                            $newTotal = count($this->subAssetMoeRefs[$subAssetMoeRefKey]);
                            $categoryCodeRecord = $this->assetCategoryCodes->where('id', $this->mainAssetCategoryCode[$subAssetMoeRefKey])->first();

                            if ($categoryCodeRecord) {

                                $categoryCode = $categoryCodeRecord->code;

                                $moeRefValue = $this->ledgerCode . "/" . $categoryCode . "/(" . $position . ")/" . sprintf("%02d", $i) . "-" . sprintf("%02d", $newTotal) ;
                                $this->subAssetMoeRefs[$subAssetMoeRefKey][$subAssetMoeRefValueKey][0] = $moeRefValue;
                                $i++;

                            }

                        }
                    }

                }

                // Change Sub-Asset Set-Item's PO No.
                if(isset($this->subAssetMoeRefs)){

                    foreach($this->subAssetMoeRefs as $subAssetMoeRefKey => $subAssetMoeRefValues){

                        foreach ($subAssetMoeRefValues as $subAssetMoeRefValueKey => $subAssetMoeRefValueValue ) {

                            // Get the Index and Total from SubAsset's MOE Ref. e.g (MOE/XXX/XX/01-03)
                            $subAssetMoeRef = $subAssetMoeRefValueValue[0];
                            $value = basename($subAssetMoeRef);
                            $value = explode('/', $value);
                            $indexAndTotal = end($value);

                            foreach($this->subAssetSetItems[$subAssetMoeRefKey][$subAssetMoeRefValueKey] as $subAssetItemKey => $subAssetItemValues){

                                // CategoryCode
                                // $subAssetItemValues[1];

                                if($subAssetItemValues[1] !== "") {

                                    $categoryCodeRecord = $this->assetCategoryCodes->where('id', $subAssetItemValues[1])->first();

                                    if ($categoryCodeRecord) {

                                        $categoryCode = $categoryCodeRecord->code;
                                        $moeRefValue = $this->ledgerCode . "/" . $categoryCode . "/" . $indexAndTotal;
                                        $this->subAssetSetItems[$subAssetMoeRefKey][$subAssetMoeRefValueKey][$subAssetItemKey][2] = $moeRefValue;

                                    }

                                }

                            }

                        }
                    }
                }

            }

            $this->ledgerCode = "MOE/ICT/" . date("Y") . "/ [PO-NUMBER]" ;

        }

        // Remove spaces from ledgercode
        $this->ledgerCode = str_replace(' ', '', $this->ledgerCode);

    }

    public function moeRef($id){

        $categoryCodeRecord = $this->assetCategoryCodes->where('id', $id)->first();

        if ($categoryCodeRecord) {

            $categoryCode = $categoryCodeRecord->code;
            $moeRefValue = $this->ledgerCode . "/" . $categoryCode;
            return $moeRefValue;

        }

    }

    public function subAssetMoeRef($categoryCodeId, $key){

        $categoryCodeRecord = $this->assetCategoryCodes->where('id', $categoryCodeId)->first();

        if ($categoryCodeRecord) {

            $categoryCode = $categoryCodeRecord->code;

            $total = $this->mainAssetQuantity[$key];

            for ($i = 1; $i <= $total; $i++){
                $moeRefValue = $this->ledgerCode . "/" . $categoryCode . "/" . $i . "-" . $total ;
                array_push($this->subAssetMoeRefs[$key], $moeRefValue);
            }

        }

        // return $moeRefValue;

        // Sub-asset count
        // 1. Count the quantity of sub-asset, this will be total
        // 2. foreach (counted value), kira dari satu sampai total
        // 3. two digit. e.g: 01, 02, 03
        // 4. make exception for three digit. to be safe, buat minimal 2 digits
    }

    // --------------------------------------------------------------------------------
    // Staff
    // --------------------------------------------------------------------------------

    public function searchStaff()
    {
        $explodedName = explode(" ", $this->searchStaffInput);
        $users = User::query();

        foreach ($explodedName as $name) {
            $users->orWhere(function ($query) use ($name) {
                $query->where('full_name', 'like', "%$name%")->get()->take(10);
            });
        }

        $this->searchStaffResults = $users->get();

    }

    public function selectStaff($id, $name)
    {
        $this->contactPersonMessage = null;
        $this->contactPersonId = $id;
        $this->searchStaffInput = ucwords($name);
    }

    public function removeStaff()
    {
        $this->contactPersonId = null;
        $this->searchStaffInput = "";
    }

    // Show error message when user haven't selected from dropdown and goes out of input's focus
    public function searchStaffInputLostFocus()
    {
        // Contact Person > Name - Error Message
        $this->contactPersonMessage = null;

        if($this->contactPersonId == null){
            $this->contactPersonMessage = "Please search and select one staff.";
        }
    }

    // --------------------------------------------------------------------------------
    // DO Signer
    // --------------------------------------------------------------------------------

    public function searchDoSigner()
    {
        $explodedName = explode(" ", $this->doSignerInput);
        $users = User::query();

        foreach ($explodedName as $name) {
            $users->orWhere(function ($query) use ($name) {
                $query->where('full_name', 'like', "%$name%")->get()->take(10);
            });
        }

        $this->doSignerResults = $users->get();

    }

    public function selectDoSigner($id, $name)
    {
        $this->doSignerInputMessage = null;
        $this->doSignerId = $id;
        $this->doSignerInput = ucwords($name);
    }

    public function removeDoSigner()
    {
        $this->doSignerId = null;
        $this->doSignerInput = "";
    }

    // Show error message when user haven't selected from dropdown and goes out of input's focus
    public function doSignerInputLostFocus()
    {
        // DO Signer > Name - Error Message
        $this->doSignerInputMessage = null;

        if($this->doSignerId == null){
            $this->doSignerInputMessage = "Please search and select one staff.";
        }
    }

    // --------------------------------------------------------------------------------
    // Vendor
    // --------------------------------------------------------------------------------

    public function searchVendor()
    {
        $explodedName = explode(" ", $this->searchVendorInput);
        $vendors = Vendor::query();

        foreach ($explodedName as $name) {
            $vendors->orWhere(function ($query) use ($name) {
                $query->where('name', 'like', "%$name%")->get()->take(10);
            });
        }

        $this->searchVendorResults = $vendors->get();

    }

    public function selectVendor($id, $name)
    {
        $this->vendorExists = true;
        $this->searchVendorInput = ucwords($name);
    }

    public function removeVendor()
    {
        $this->vendorExists = false;
        $this->searchVendorInput = "";
    }

    // --------------------------------------------------------------------------------
    // Main Asset
    // --------------------------------------------------------------------------------

    public function addMainAsset()
    {
        // Item Type A: MOE/ICT/2022/SF01A-000020321/C2/(1)/1-30
        // Item Type B: MOE/ICT/2022/SF01A-000020321/C2/(2)/1-30

        $this->mainAssetCounter = $this->mainAssetCounter + 1;
        array_push($this->mainAssetInputs, $this->mainAssetCounter);
        array_push($this->mainAssetSearchQueryInputs, null);
        array_push($this->subAssetInputs, $this->mainAssetCounter);
        array_push($this->subAssetSetItems, null);
        array_push($this->subAssetMoeRefs, []);

        $defaultValue = false;
        array_push($this->viewAllSubAsset, $defaultValue);

        // array_push($this->viewSubAssetSetItems, $defaultValue);

        array_push($this->selectedMainAssetIds, null);

        // ---------------------------------------------------------------
        // Idea
        // ---------------------------------------------------------------
        //
        // Pakai nested array untuk tau sub asset n main asset relation
        // SubAssetInputsArray[
        //     0 => 1,
        //     1 => array:2 [
        //         0 => 1,
        //         1 => 2,
        //     ],
        // ]
        //
        // ---------------------------------------------------------------
    }

    public function removeMainAsset($key, $value)
    {

        // dd($key . " - " . $value);

        unset($this->mainAssetInputs[$key]);
        unset($this->mainAssetSearchQueryInputs[$key]);

        // Fields
        unset($this->mainAssetName[$key]);
        unset($this->mainAssetCategoryCode[$key]);
        unset($this->mainAssetQuantity[$key]);

        unset($this->mainAssetUnitPrice[$key]);
        unset($this->selectedMainAssetIds[$key]);

        unset($this->subAssetSetItems[$key]);
        unset($this->subAssetMoeRefs[$key]);
        unset($this->viewAllSubAsset[$key]);
        unset($this->subAssetInputs[$key]);

    }

    private function resetMainAssetField(){

        $this->mainAssetName = '';
        $this->mainAssetCategoryCode = '';
        $this->mainAssetQuantity = '';
        // $this->mainAssetQuantityUnit = '';
        $this->mainAssetUnitPrice = '';

    }

    public function searchMainAsset($key)
    {
        // dd($key . " " . $name);
        // dd($this->mainAssetName[$key] .$key);

        $this->mainAssetSearchQueryInputs[$key] = $this->mainAssetName[$key];
        $explodedName = explode(" ", $this->mainAssetName[$key]);
        $assets = Asset::query();

        foreach ($explodedName as $name) {
            $assets->orWhere(function ($query) use ($name) {
                $query->where('name', 'like', "%$name%")->get()->take(10);
            });
        }

        $this->mainAssetSearchResults = $assets->get();

    }

    public function selectMainAsset($id, $name, $key)
    {
        $this->mainAssetId = $id;
        $this->mainAssetName[$key] = ucwords($name);
        $this->mainAssetSearchQueryInputs[$key] = ucwords($name);

        // Set/auto-fill category code from database
        $categoryCodeId = Asset::where('id', $this->mainAssetId)->first()->asset_category_code_id;
        // dd($categoryCodeId);
        $this->mainAssetCategoryCode[$key] = $categoryCodeId;

        // dd($this->selectedMainAssetIds[$key]);

        // Update Main Asset ID it into the selected main asset ids array (for )
        $this->selectedMainAssetIds[$key] = (int)$this->mainAssetId;
    }

    public function clearMainAsset($key)
    {
        // $this->contactPersonId = null;
        $this->mainAssetName[$key] = null;
        $this->mainAssetCategoryCode[$key] = null;
        $this->selectedMainAssetIds[$key] = null;
    }

    public function idToCategoryCodeConverter($id)
    {
        $categoryCodeRecord = $this->assetCategoryCodes->where('id', $id)->first();

        if ($categoryCodeRecord) {

            $categoryCode = $categoryCodeRecord->code;

            return $categoryCode;

        }
    }

    public function changeMainAssetCategoryCode($key)
    {
        // Sub Asset MOERefs
        if(!empty($this->mainAssetCategoryCode[$key])){

            $categoryCodeRecord = $this->assetCategoryCodes->where('id', $this->mainAssetCategoryCode[$key])->first();

            if ($categoryCodeRecord) {
                $categoryCode = $categoryCodeRecord->code;

                if(isset($this->mainAssetQuantity[$key])){

                    $total = $this->mainAssetQuantity[$key];

                    // Check The Key's Position In The Array, for Bracketed Number in MOE Ref
                    $position = array_search($key, array_keys($this->subAssetInputs)) + 1;

                    // Sprintf() = two digit transformer. e.g: 01,02,03
                    // To change the value of empty(" ") to MOERef code.
                    for ($i = 1; $i <= $total; $i++){

                        $moeRefValue = $this->ledgerCode . "/" . $categoryCode . "/(" . $position . ")/" . sprintf("%02d", $i) . "-" . sprintf("%02d", $total) ;
                        $this->subAssetMoeRefs[$key][$i-1][0] = $moeRefValue;

                    }

                }
            }

        }

    }

    // --------------------------------------------------------------------------------
    // Sub Asset
    // --------------------------------------------------------------------------------

    public function viewSubAsset($key)
    {

        if($this->viewAllSubAsset[$key] == false){
            $this->viewAllSubAsset[$key] = true;
        } else {
            $this->viewAllSubAsset[$key] = false;
        }

    }

    // Triggered When Main-Asset's Quantity is Changed
    public function addSubAsset($key , $value)
    {
        // dd($key . "---" . $value);

        // $myArray = array_slice($myArray, 0, -3);

        if(!empty($this->mainAssetQuantity[$key])){

            // Sub Asset Inputs
            $this->subAssetInputs[$key] = [];

            // Sub Asset Set Items
            $this->subAssetSetItems[$key] = [];

            // Reset Sub Asset MOERef, for when user edits the quantity.
            $this->subAssetMoeRefs[$key] = [];

            $quantity = $this->mainAssetQuantity[$key];

            if($quantity < $this->maxQuantity){

                for ($i = 1; $i <= $quantity; $i++) {

                    // Sub Asset Inputs
                    array_push($this->subAssetInputs[$key], '');

                    // Sub Asset MOERef
                    array_push($this->subAssetMoeRefs[$key], [0 => "", 1 => ""]);

                    // Sub Asset SetItems
                    array_push($this->subAssetSetItems[$key], [0 => [0 => "", 1 => "", 2 => "", 3 => ""]]);
                    // array_push($this->viewSubAssetSetItems[$key], false);

                    // 0 is for Name
                    // I is for OLD Category Code
                    // 2 is for MOE Ref
                    // 3 is for Serial No
                    // 4 is for NEW Category Code
                }


                 // Sub Asset MOERefs
                if(!empty($this->mainAssetCategoryCode[$key])){

                    $categoryCodeRecord = $this->assetCategoryCodes->where('id', $this->mainAssetCategoryCode[$key])->first();

                    if ($categoryCodeRecord) {

                        $categoryCode = $categoryCodeRecord->code;

                        $total = $this->mainAssetQuantity[$key];

                        // Check The Key's Position In The Array, for Bracketed Number in MOE Ref
                        $position = array_search($key, array_keys($this->subAssetInputs)) + 1;

                        // Sprintf() = two digit transformer. e.g: 01,02,03
                        // To change the value of empty(" ") to MOERef code.
                        for ($i = 1; $i <= $total; $i++){

                            $moeRefValue = $this->ledgerCode . "/" . $categoryCode . "/(" . $position . ")/" . sprintf("%02d", $i) . "-" . sprintf("%02d", $total) ;
                            $this->subAssetMoeRefs[$key][$i-1][0] = $moeRefValue;

                        }

                    }

                }

            } else {

                $quantity = 0;
                $this->mainAssetQuantity[$key] = $quantity;

            }

        }

    }

    public function removeSubAsset($mainKey, $subKey)
    {
        // dd("ok");
        // dd($mainKey . " ===== " . $subKey);
        // Remove/unset the key-value pair from array
        unset($this->subAssetInputs[$mainKey][$subKey]);
        unset($this->serialNo[$mainKey][$subKey]);
        // unset($this->viewSubAssetSetItems[$mainKey][$subKey]);

        // Deduct MainAssetQuantity input value by 1
        $this->mainAssetQuantity[$mainKey] = $this->mainAssetQuantity[$mainKey]-1;
        unset($this->subAssetMoeRefs[$mainKey][$subKey]);

        unset($this->subAssetSetItems[$mainKey][$subKey]);

        $newTotal = count($this->subAssetMoeRefs[$mainKey]);

        // Change the value of MOERef with updated count (XX-XX. e.g 01-10)
        // $this->subAssetMoeRefs[$mainKey][$subKey][0] = "";

        $categoryCodeRecord = $this->assetCategoryCodes->where('id', $this->mainAssetCategoryCode[$mainKey])->first();

        if ($categoryCodeRecord) {

            $categoryCode = $categoryCodeRecord->code;

            $i = 1;

            // Check The Key's Position In The Array, for Bracketed Number in MOE Ref
            $position = array_search($mainKey, array_keys($this->subAssetInputs)) + 1;

            // dd($this->mainAssetQuantity[$mainKey]);
            foreach($this->subAssetMoeRefs[$mainKey] as $subAssetMoeRefKey => $subAssetMoeRefValue){

                $moeRefValue = $this->ledgerCode . "/" . $categoryCode . "/(" . $position . ")/" . sprintf("%02d", $i) . "-" . sprintf("%02d", $newTotal) ;
                $this->subAssetMoeRefs[$mainKey][$subAssetMoeRefKey][0] = $moeRefValue;
                $i++;

            }
        }

        // Reset MainAssetCategoryCode array and reinsert with new count
        // if(!empty($this->mainAssetCategoryCode[$mainKey])){

        //     $categoryCode = $this->assetCategoryCodes->where('id', $this->mainAssetCategoryCode[$mainKey])->first()->code;

        //     $total = $this->mainAssetQuantity[$mainKey];

        //     for ($i = 1; $i <= $total; $i++){
        //         $moeRefValue = $this->ledgerCode . "/" . $categoryCode . "/" . sprintf("%02d", $i) . "-" . sprintf("%02d", $total) ;
        //         $this->subAssetMoeRefs[$mainKey][$i-1][0] = $moeRefValue;
        //     }
        // }

    }

    public function addSubAssetSetItem($firstKey, $secondKey, $thirdKey)
    {
        // Turn into array
        // $this->subAssetSetItems[1][2] = [];

        // Insert in array
        array_push($this->subAssetSetItems[$firstKey][$secondKey], [0 => "", 1 => "", 2 => "", 3 => ""]);

        // for ($i = 1; $i <= 4; $i++) {
        //     // Sub Asset SetItems
        //     array_push($this->subAssetSetItems[$firstKey][$secondKey][$thirdKey], '');
        // }

    }

    // Triggered When Sub-Asset Set Item's Category Code is Edited.
    public function updateSubAssetSetItems($firstKey, $secondKey, $thirdKey)
    {
        // Remake category code based on existing data
        // If sub asset's serial number is filled, let set item be clickable (vice versa)
        // If set item's category code is changed, update the set item's moe ref.
        // Let set item's moe ref be empty at start.

        if(!empty($this->subAssetSetItems[$firstKey][$secondKey][$thirdKey][1])){

            // Sub Asset's MOE Ref
            // $this->subAssetMoeRefs[$firstKey][$secondKey][0];

            // Sub-Asset Set Item Category Code
            // $this->subAssetSetItems[$firstKey][$secondKey][$thirdKey][1];

            // Get The Index and Total at the end of MOE Ref string. e.g (XXX/XXX/XXX/01-04)
            $subAssetMoeRef = $this->subAssetMoeRefs[$firstKey][$secondKey][0];
            $value = basename($subAssetMoeRef);
            $value = explode('/', $value);
            $indexAndTotal = end($value);

            // Check The Key's Position In The Array, for Bracketed Number in MOE Ref
            $position = array_search($firstKey, array_keys($this->subAssetInputs)) + 1;

            // Rewrite Sub-Asset Set-Item's Category Code
            $categoryCodeRecord = $this->assetCategoryCodes->where('id', $this->subAssetSetItems[$firstKey][$secondKey][$thirdKey][1])->first();

            if ($categoryCodeRecord) {

                $categoryCode = $categoryCodeRecord->code;

                $moeRefValue = $this->ledgerCode . "/" . $categoryCode . "/(" . $position . ")/" . $indexAndTotal;
                $this->subAssetSetItems[$firstKey][$secondKey][$thirdKey][2] = $moeRefValue;
            }

            // 0 is for Name
            // I is for Category Code
            // 2 is for MOE Ref
            // 3 is for Serial No
        }



    }

    public function removeSubAssetSetItem($firstKey, $secondKey, $thirdKey)
    {
        // $this->subAssetSetItems[$firstKey][$secondKey][$thirdKey] = "";
        unset($this->subAssetSetItems[$firstKey][$secondKey][$thirdKey]);
        // $this->viewSubAssetSetItems[$firstKey][$secondKey][$thirdKey] = false;
    }

    public function addSetItem()
    {
        // Turn null into array
        // $this->subAssetSetItems[1][2] = [];

        // Insert in array
        // array_push($this->subAssetSetItems[0][1], '');

        // dd($this->subAssetSetItems[3]);
    }

    // --------------------------------------------------------------------------------
    // Store
    // --------------------------------------------------------------------------------

    public function store()
    {
        // dd('done');

        dd($this->name);

        $validatedDate = $this->validate(

            // Validation
            [
                'name.0' => 'required',
                'email.0' => 'required',
                // 'name.*' => 'required',
                // 'email.*' => 'required',
            ],

            // Message
            [
                'name.0.required' => 'name field is required',
                'email.0.required' => 'email field is required',
                // 'name.*.required' => 'name field is required',
                // 'email.*.required' => 'email field is required',
            ]
        );

        if(!empty($this->inputs)){

            foreach ($this->inputs as $key => $value) {


                dump($this->name[$key]);

                // Testink::create([
                //     'name' => $this->name[$key],
                //     'email' => $this->email[$key]
                // ]);

            }

            dd('done');

        }

        $this->mainAssetInputs = [];

        $this->resetMainAssetField();

        dd('done');
    }

    // --------------------------------------------------------------------------------
    // Buttons
    // --------------------------------------------------------------------------------

    public function saveAndSubmit()
    {
        // --------------------------------------------------------------------------------
        // CHECK IF SERIAL NO. IS FILLED
        // --------------------------------------------------------------------------------

        // Is there any serial no. that is unfilled?
        $serialNoUnfilled = "no";

        foreach($this->subAssetSetItems as $mainAssetKey => $subAssetSetItemsValues){

            // ------------------------------------------------------------------------------------------------------------------------------
            // This code is used to fix the error in VSCode Intelliphense for $subAssetSetItemsValues. Not a bug in code.
            // ------------------------------------------------------------------------------------------------------------------------------
            /**
             * @var object $subAssetSetItemsValues
             */
            // ------------------------------------------------------------------------------------------------------------------------------

            if($subAssetSetItemsValues !== null){

                foreach($subAssetSetItemsValues as $subAssetKey => $subAssetSetItemsValuesValues){

                    $mainAssetQuantity = $this->mainAssetQuantity[$mainAssetKey];
                    $mainAssetUnitPrice = $this->mainAssetUnitPrice[$mainAssetKey];

                    if(!isset($this->subAssetMoeRefs[$mainAssetKey][$subAssetKey][1]) || empty($this->subAssetMoeRefs[$mainAssetKey][$subAssetKey][1])){

                        $serialNoUnfilled = "yes";

                    }

                }

            }

        }

        if($serialNoUnfilled == "no"){

            $userId = Auth::guard('ims')->user()->id;
            $dateTimeNow = Carbon::now('Asia/Brunei')->toDateTimeString();

            // --------------------------------------------------------------------------------
            // SEARCHABLE FIELDS ERROR MESSAGE
            // --------------------------------------------------------------------------------
            // Note: The Message Set Here Will Only Be Shown After Validation.
            // Purchase Order > Contact Person - Error Message
            // --------------------------------------------------------------------------------

            $this->contactPersonMessage = null;

            if($this->contactPersonId == null){
                $this->contactPersonMessage = "Please search and select one staff.";
            }

            // DO Signer > Name - Error Message
            $this->doSignerInputMessage = null;

            if($this->doSignerId == null){
                $this->doSignerInputMessage = "Please search and select one staff.";
            }

            // Vendor > Name - Error Message
            $this->searchVendorInputMessage = null;

            if($this->searchVendorInput == null){
                $this->searchVendorInputMessage = "Please search and select one vendor.";
            }

            // --------------------------------------------------------------------------------
            // IF VENDOR EXISTS (SEARCHED AND SELECTED)
            // --------------------------------------------------------------------------------

            if($this->vendorExists == true){

                // ----------------------------------------------------
                // Warning Toast Message
                // ----------------------------------------------------

                if(
                    $this->poNo == null ||
                    $this->poDate == null ||
                    $this->poQuotationNo == null ||
                    $this->contactPersonId == null ||
                    $this->invoiceNo == null ||
                    $this->invoiceIssuanceDate == null ||
                    $this->doNo == null ||
                    $this->doIssuanceDate == null ||
                    $this->doSignerId == null ||
                    $this->doSigningDate == null ||
                    $this->srvNo == null ||
                    $this->srvSignatureDate == null ||
                    $this->storeLocationFloor == null ||
                    $this->searchVendorInput == null
                ){

                    $prevData = [
                        'message' => 'Warning',
                        'description' => 'Please fill in the required fields!',
                    ];

                    $this->warningToast($prevData);
                }

                $validatedData = $this->validate([

                    // Purchase Order
                    'poNo' => ['required', new UniquePoNo('ims', 'purchase_orders')],
                    'poDate' => 'required|date',
                    'poQuotationNo' => '',
                    'contactPersonId' => 'required',

                    // Invoice
                    'invoiceNo' => ['required', new UniqueInvoiceNo('ims', 'invoices')],
                    'invoiceIssuanceDate' => 'required',

                    // Delivery Order
                    'doNo' => ['required', new UniqueDoNo('ims', 'delivery_orders')],
                    'doIssuanceDate' => 'required',
                    'doSignerId' => 'required',
                    'doSigningDate' => 'required',

                    // SRV
                    'srvNo' => 'required|unique:srvs,srv_no',
                    'srvSignatureDate' => 'required',

                    // Floor
                    'storeLocationFloor' => 'required',

                    // Optional Remarks
                    'remarks' => 'max:1000',

                    // Vendor
                    'searchVendorInput' => 'required',

                ]);

                // ---------------------------------------------------------------
                // Save Data to Table: Purchase_Orders
                // ---------------------------------------------------------------

                $purchaseOrder = new PurchaseOrder;
                $purchaseOrder->po_no = $validatedData['poNo'];
                $purchaseOrder->po_date = $validatedData['poDate'];
                $purchaseOrder->quotation_no = $validatedData['poQuotationNo'];
                $purchaseOrder->contact_person_id = $validatedData['contactPersonId'];
                $purchaseOrder->save();

                // ---------------------------------------------------------------
                // Save Data to Table: Delivery_Orders
                // ---------------------------------------------------------------

                $deliveryOrder = new DeliveryOrder;
                $deliveryOrder->do_no = $validatedData['doNo'];
                $deliveryOrder->do_issuance_date = $validatedData['doIssuanceDate'];
                $deliveryOrder->do_signer = $this->doSignerId;
                $deliveryOrder->do_signing_date = $validatedData['doSigningDate'];
                $deliveryOrder->save();

                // ---------------------------------------------------------------
                // Save Data to Table: Invoice
                // ---------------------------------------------------------------

                $invoice = new Invoice;
                $invoice->invoice_no = $validatedData['invoiceNo'];
                $invoice->invoice_issuance_date = $validatedData['invoiceIssuanceDate'];
                $invoice->save();

                // ---------------------------------------------------------------
                // Save Data to Table: Srvs
                // ---------------------------------------------------------------

                $srv = new Srv;
                $srv->srv_no = $validatedData['srvNo'];
                $srv->srv_signature_date = $validatedData['srvSignatureDate'];
                $srv->save();

                // ---------------------------------------------------------------
                // Save Data to Table: Lejar_Simpanans
                // ---------------------------------------------------------------

                $vendorId = Vendor::where('name', $this->searchVendorInput)->first()->id;

                $lejarSimpanan = new LejarSimpanan;
                $lejarSimpanan->moe_reference = $this->ledgerCode;
                $lejarSimpanan->vendor_id = $vendorId;
                $lejarSimpanan->purchase_order_id = $purchaseOrder->id;
                $lejarSimpanan->delivery_order_id = $deliveryOrder->id;
                $lejarSimpanan->invoice_id = $invoice->id;
                // $lejarSimpanan->remarks = $validatedData['remarks'];
                $lejarSimpanan->srv_id = $srv->id;
                $lejarSimpanan->created_by = auth()->guard('ims')->user()->id;
                $lejarSimpanan->save();

                // ------------------------------------------------------------------------------------------------------------------------------
                // STOCK LEDGER DETAILS
                // ------------------------------------------------------------------------------------------------------------------------------

                // ------------------------------------------------------------------------------------------------------------------------------
                // NOTE
                // ------------------------------------------------------------------------------------------------------------------------------
                // Pakai [$this->subAssetSetItems] pasal ia ada complete indexing/structure
                // KEY CAN BE USED FOR INDEXING MAIN ASSET
                // ------------------------------------------------------------------------------------------------------------------------------

                // dd(count($this->subAssetSetItems));

                foreach($this->subAssetSetItems as $mainAssetKey => $subAssetSetItemsValues){

                    // ------------------------------------------------------------------------------------------------------------------------------
                    // MAIN ASSET
                    // ------------------------------------------------------------------------------------------------------------------------------

                    // ------------------------------------------------------------------------------------------------------------------------------
                    // NOTES
                    // ------------------------------------------------------------------------------------------------------------------------------
                    // For main-asset, user can type in manually or search existing asset in database.
                    // CODE BELOW is to save data when user type in MANUALLY.
                    // Type in manually = Add new Asset = Add new BinCard = Add new BinCardEntry. If not, no need add new Asset.
                    // ------------------------------------------------------------------------------------------------------------------------------

                    if($this->selectedMainAssetIds[$mainAssetKey] == null){

                        // ---------------------------------------------------------------
                        // USER TYPE IN NEW ASSET MANUALLY
                        // ---------------------------------------------------------------

                        $mainAssetName = $this->mainAssetName[$mainAssetKey];
                        $mainAssetCategoryCode = $this->mainAssetCategoryCode[$mainAssetKey];
                        $mainAssetQuantity = $this->mainAssetQuantity[$mainAssetKey];
                        $mainAssetUnitPrice = $this->mainAssetUnitPrice[$mainAssetKey];

                        // ------------------------------------------------------------------------------------------------------------------------------
                        // Save Data to Table: Asset
                        // ------------------------------------------------------------------------------------------------------------------------------
                        $asset = new Asset;
                        $asset->name = $mainAssetName;
                        $asset->asset_type_id = 1;
                        $asset->initial_quantity = $mainAssetQuantity;
                        $asset->asset_category_code_id = $mainAssetCategoryCode;
                        $asset->save();

                        // ---------------------------------------------------------------
                        // CHECK IF THERE ARE ANY BINCARD IN DATABASE - FOR BIN NO
                        // ---------------------------------------------------------------

                        $binCardCount = BinCard::count();

                        if($binCardCount > 0){

                            $latestBinNo = BinCard::latest('id')->pluck('bin_no')->first();
                            preg_match('/BIN(\w)(\d{3})/', $latestBinNo, $matches);
                            $letter = $matches[1];
                            $number = $matches[2];

                            if($number < 999){

                                $number++;
                                $newNumber = str_pad($number, 3, '0', STR_PAD_LEFT);
                                $binNo = "BIN" . $letter . $newNumber;

                            } else {

                                $letter++;
                                $number = 1;
                                $newNumber = str_pad($number, 3, '0', STR_PAD_LEFT);
                                $binNo = "BIN" . $letter . $newNumber;

                            }

                        } else {

                            $binNo = "BINA001";

                        }

                        // ---------------------------------------------------------------
                        // Save Data to Table: Bin_Cards
                        // ---------------------------------------------------------------

                        $binCard = new BinCard();
                        $binCard->bin_no = $binNo;
                        $binCard->store_id = $validatedData['storeLocationFloor'];
                        $binCard->asset_id = $asset->id;
                        $binCard->vocb_no = "tbc";
                        $binCard->qr_code = "test";
                        $binCard->save();

                        // ---------------------------------------------------------------
                        // Save Data to Table: Bin_Card_Entries
                        // ---------------------------------------------------------------

                        $binCardEntry = new BinCardEntry;
                        $binCardEntry->bin_card_id = $binCard->id;
                        $binCardEntry->user_type = "vendor";
                        $binCardEntry->user_id = $vendorId;
                        $binCardEntry->in_quantity = $mainAssetQuantity;
                        $binCardEntry->balance_quantity = $mainAssetQuantity;
                        $binCardEntry->officer_in_charge_id = $userId;
                        $binCardEntry->remarks = $validatedData['remarks'];
                        $binCardEntry->reference_type = "lejar-simpanan";
                        $binCardEntry->reference_id = $lejarSimpanan->id;
                        $binCardEntry->save();

                    } else {

                        // ---------------------------------------------------------------
                        // SEARCH AND SELECT EXISTING ASSET FROM DROPDOWN
                        // ---------------------------------------------------------------

                        $mainAssetName = $this->mainAssetName[$mainAssetKey];
                        $mainAssetCategoryCode = $this->mainAssetCategoryCode[$mainAssetKey];
                        $mainAssetQuantity = $this->mainAssetQuantity[$mainAssetKey];
                        $mainAssetUnitPrice = $this->mainAssetUnitPrice[$mainAssetKey];

                        $mainAssetId = $this->selectedMainAssetIds[$mainAssetKey];

                        // ---------------------------------------------------------------
                        // CHECK IF BIN CARD EXISTS
                        // ---------------------------------------------------------------

                        $binCardExists = BinCard::where('asset_id', $mainAssetId)->exists();

                        // ---------------------------------------------------------------
                        // IF BIN CARD EXISTS, ADD BIN CARD ENTRY
                        // ---------------------------------------------------------------

                        if($binCardExists){

                            $binCardId = BinCard::where('asset_id', $mainAssetId)->first()->id;

                            // ---------------------------------------------------------------
                            // Save Data to Table: Bin_Card_Entries
                            // ---------------------------------------------------------------

                            $latestBalanceQuantity = BinCardEntry::where('bin_card_id', $binCardId)->latest('id')->value('balance_quantity');

                            $binCardEntry = new BinCardEntry;
                            $binCardEntry->bin_card_id = $binCardId;
                            // $binCardEntry->date = $dateTimeNow;
                            $binCardEntry->user_type = "vendor";
                            $binCardEntry->user_id = $vendorId;
                            $binCardEntry->in_quantity = $mainAssetQuantity;
                            $binCardEntry->balance_quantity = $latestBalanceQuantity + $mainAssetQuantity;
                            $binCardEntry->officer_in_charge_id = $userId;
                            $binCardEntry->remarks = $validatedData['remarks'];
                            $binCardEntry->reference_type = "lejar-simpanan";
                            $binCardEntry->reference_id = $lejarSimpanan->id;
                            $binCardEntry->save();

                        } else {

                            // ---------------------------------------------------------------
                            // CHECK IF THERE ARE ANY BINCARD IN DATABASE - FOR BIN NO
                            // ---------------------------------------------------------------

                            $binCardCount = BinCard::count();

                            if($binCardCount > 0){

                                $latestBinNo = BinCard::latest('id')->pluck('bin_no')->first();
                                preg_match('/BIN(\w)(\d{3})/', $latestBinNo, $matches);
                                $letter = $matches[1];
                                $number = $matches[2];

                                if($number < 999){

                                    $number++;
                                    $newNumber = str_pad($number, 3, '0', STR_PAD_LEFT);
                                    $binNo = "BIN" . $letter . $newNumber;

                                } else {

                                    $letter++;
                                    $number = 1;
                                    $newNumber = str_pad($number, 3, '0', STR_PAD_LEFT);
                                    $binNo = "BIN" . $letter . $newNumber;

                                }

                            } else {

                                $binNo = "BINA001";

                            }

                            // ---------------------------------------------------------------
                            // Save Data to Table: Bin_Cards
                            // ---------------------------------------------------------------

                            $binCard = new BinCard();
                            $binCard->bin_no = $binNo;
                            $binCard->store_id = $validatedData['storeLocationFloor'];
                            $binCard->asset_id = $mainAssetId;
                            $binCard->vocb_no = "tbc";
                            $binCard->qr_code = "test";
                            $binCard->save();

                            // ---------------------------------------------------------------
                            // Save Data to Table: Bin_Card_Entries
                            // ---------------------------------------------------------------

                            $binCardEntry = new BinCardEntry;
                            $binCardEntry->bin_card_id = $binCard->id;
                            // $binCardEntry->date = $dateTimeNow;
                            $binCardEntry->user_type = "vendor";
                            $binCardEntry->user_id = $vendorId;
                            $binCardEntry->in_quantity = $mainAssetQuantity;
                            $binCardEntry->balance_quantity = $mainAssetQuantity;
                            $binCardEntry->officer_in_charge_id = $userId;
                            $binCardEntry->remarks = $validatedData['remarks'];
                            $binCardEntry->reference_type = "lejar-simpanan";
                            $binCardEntry->reference_id = $lejarSimpanan->id;
                            $binCardEntry->save();

                        }

                    }

                    // ------------------------------------------------------------------------------------------------------------------------------
                    // SUB ASSET
                    // ------------------------------------------------------------------------------------------------------------------------------

                    // ------------------------------------------------------------------------------------------------------------------------------
                    // This code is used to fix the error in VSCode Intelliphense for $subAssetSetItemsValues. Not a bug in code.
                    // ------------------------------------------------------------------------------------------------------------------------------
                    /**
                     * @var object $subAssetSetItemsValues
                     */
                    // ------------------------------------------------------------------------------------------------------------------------------

                    // ---------------------------------------------------------------
                    // KEY CAN BE USED FOR INDEXING SUB-ASSET
                    // ---------------------------------------------------------------

                    foreach($subAssetSetItemsValues as $subAssetKey => $subAssetSetItemsValuesValues){

                        $mainAssetQuantity = $this->mainAssetQuantity[$mainAssetKey];
                        $mainAssetUnitPrice = $this->mainAssetUnitPrice[$mainAssetKey];

                        if(isset($this->subAssetMoeRefs[$mainAssetKey][$subAssetKey][0]) && !empty($this->subAssetMoeRefs[$mainAssetKey][$subAssetKey][0])){

                            $subAssetMoeRef = $this->subAssetMoeRefs[$mainAssetKey][$subAssetKey][0];

                        } else {

                            $prevData = [
                                'message' => 'Warning',
                                'description' => 'Please fill in the Serial No. of AssetName!',
                            ];

                            $this->warningToast($prevData);

                        }

                        $subAssetSerialNo = $this->subAssetMoeRefs[$mainAssetKey][$subAssetKey][1];

                        // ---------------------------------------------------------------
                        // If User Search and Select Existing MainAsset
                        // ---------------------------------------------------------------

                        if($this->selectedMainAssetIds[$mainAssetKey] !== null){

                            $mainAssetId = $this->selectedMainAssetIds[$mainAssetKey];

                            // ---------------------------------------------------------------
                            // Save Data to Table: Asset Entries
                            // ---------------------------------------------------------------

                            $assetEntry = new AssetEntry;
                            $assetEntry->asset_id = $mainAssetId;
                            $assetEntry->serial_no = $subAssetSerialNo;
                            $assetEntry->moe_reference = str_replace(' ', '', $subAssetMoeRef);
                            $assetEntry->asset_status_id = 1;
                            $assetEntry->unit_price = $mainAssetUnitPrice;
                            // $assetEntry->srv_id = $srv->id;
                            $assetEntry->save();

                            // ---------------------------------------------------------------
                            // Save Data to Table: Lejar_Simpanan_Entries
                            // ---------------------------------------------------------------

                            $lejarSimpananEntry = new LejarSimpananEntry();
                            $lejarSimpananEntry->lejar_simpanan_id = $lejarSimpanan->id;
                            $lejarSimpananEntry->asset_entry_id = $assetEntry->id;
                            $lejarSimpananEntry->save();

                        } else {

                            // ---------------------------------------------------------------
                            // Save Data to Table: Asset Entries
                            // ---------------------------------------------------------------

                            $assetEntry = new AssetEntry;
                            $assetEntry->asset_id = $asset->id;
                            $assetEntry->serial_no = $subAssetSerialNo;
                            $assetEntry->moe_reference = str_replace(' ', '', $subAssetMoeRef);
                            $assetEntry->asset_status_id = 1;
                            $assetEntry->unit_price = $mainAssetUnitPrice;
                            // $assetEntry->srv_id = $srv->id;
                            $assetEntry->save();

                            // ---------------------------------------------------------------
                            // Save Data to Table: Lejar_Simpanan_Entries
                            // ---------------------------------------------------------------

                            $lejarSimpananEntry = new LejarSimpananEntry();
                            $lejarSimpananEntry->lejar_simpanan_id = $lejarSimpanan->id;
                            $lejarSimpananEntry->asset_entry_id = $assetEntry->id;
                            $lejarSimpananEntry->save();

                        }

                        // ---------------------------------------------------------------
                        // KEY CAN BE USED FOR INDEXING SUB-ASSET SET-ITEMS
                        // ---------------------------------------------------------------

                        foreach($subAssetSetItemsValuesValues as $subAssetSetItemKey => $subAssetSetItemsValuesValuesValues){

                            // ------------------------------------------------------------------------------------------------------------------------------
                            // SET ITEM
                            // ------------------------------------------------------------------------------------------------------------------------------

                            // ------------------------------------------------------------------------------------------------------------------------------
                            // SET ITEM DDs
                            // ------------------------------------------------------------------------------------------------------------------------------
                            // dd($this->subAssetSetItems);
                            // dd($this->subAssetSetItems[0][1][2]);
                            // dd($this->subAssetSetItems[$mainAssetKey][$subAssetKey][$subAssetSetItemKey]);
                            // dd($this->subAssetSetItems[$mainAssetKey][$subAssetKey][$subAssetSetItemKey][3]);
                            // ------------------------------------------------------------------------------------------------------------------------------

                            // ---------------------------------------------------------------
                            // SET ITEM ARRAY GUIDE => ($this->subAssetSetItems)
                            // ---------------------------------------------------------------
                            // 0 => Name
                            // 1 => Category Code
                            // 2 => MOE Ref
                            // 3 => Serial No
                            // ---------------------------------------------------------------

                            $subAssetSetItemName = $this->subAssetSetItems[$mainAssetKey][$subAssetKey][$subAssetSetItemKey][0];
                            $subAssetSetItemCategoryCode = $this->subAssetSetItems[$mainAssetKey][$subAssetKey][$subAssetSetItemKey][1];
                            $subAssetSetItemMoeRef = $this->subAssetSetItems[$mainAssetKey][$subAssetKey][$subAssetSetItemKey][2];
                            $subAssetSetItemSerialNo = $this->subAssetSetItems[$mainAssetKey][$subAssetKey][$subAssetSetItemKey][3];

                            // ---------------------------------------------------------------
                            // Check If SubAsset SetItem Is Filled
                            // ---------------------------------------------------------------

                            if(($subAssetSetItemName !== "") && ($subAssetSetItemCategoryCode !== "") && ($subAssetSetItemMoeRef !== "") && ($subAssetSetItemSerialNo !== ""))
                            {
                                // ---------------------------------------------------------------
                                // Save Data to Table: Asset Entry Set Item
                                // ---------------------------------------------------------------

                                $assetEntrySetItem = new AssetEntrySetItem;
                                $assetEntrySetItem->asset_entry_id = $assetEntry->id;
                                $assetEntrySetItem->name = $subAssetSetItemName;
                                $assetEntrySetItem->moe_reference = $subAssetSetItemMoeRef;
                                $assetEntrySetItem->serial_no = $subAssetSetItemSerialNo;
                                $assetEntrySetItem->asset_category_code_id = (int) $subAssetSetItemCategoryCode;
                                $assetEntrySetItem->save();

                            }

                        }

                    }

                }

                // ---------------------------------------------------------------
                // END OF FUNCTION
                // ---------------------------------------------------------------

                $prevData = [
                    'message' => 'Success',
                    'description' => 'Stock Ledger form submitted successfully!',
                ];

                return redirect()->route('ims.viewLedger')->with('success', $prevData);

            } else {

                // --------------------------------------------------------------------------------
                // IF VENDOR DOESNT EXISTS IN DB (ENTER MANUAL)
                // --------------------------------------------------------------------------------

                // ---------------------------------------------------------------
                // Warning Toast Message
                // ---------------------------------------------------------------

                if(
                    $this->poNo == null ||
                    $this->poDate == null ||
                    $this->poQuotationNo == null ||
                    $this->contactPersonId == null ||

                    $this->invoiceNo == null ||
                    $this->invoiceIssuanceDate == null ||

                    $this->doNo == null ||
                    $this->doIssuanceDate == null ||
                    $this->doSignerId == null ||
                    $this->doSigningDate == null ||

                    $this->srvNo == null ||
                    $this->srvSignatureDate == null ||

                    $this->storeLocationFloor == null ||

                    $this->searchVendorInput == null ||
                    $this->vendorPhoneNo == null ||
                    $this->vendorEmail == null ||
                    $this->vendorAddress == null

                ){

                    $prevData = [
                        'message' => 'Warning',
                        'description' => 'Please fill in the required fields!',
                    ];

                    $this->warningToast($prevData);
                }

                $validatedData = $this->validate([

                    // Purchase Order
                    'poNo' => ['required', new UniquePoNo('ims', 'purchase_orders')],
                    'poDate' => 'required|date',
                    'poQuotationNo' => '',
                    'contactPersonId' => 'required',

                    // Invoice
                    'invoiceNo' => ['required', new UniqueInvoiceNo('ims', 'invoices')],
                    'invoiceIssuanceDate' => 'required',

                    // Delivery Order
                    'doNo' => ['required', new UniqueDoNo('ims', 'delivery_orders')],
                    'doIssuanceDate' => 'required',
                    'doSignerId' => 'required',
                    'doSigningDate' => 'required',

                    // SRV
                    'srvNo' => ['required', new UniqueSrvNo('ims', 'srvs')],
                    'srvSignatureDate' => 'required',

                    // Floor
                    'storeLocationFloor' => 'required',

                    // Remarks
                    'remarks' => 'max:1000',

                    // Vendor
                    'searchVendorInput' => 'required',
                    'vendorPhoneNo' => 'required',
                    'vendorEmail' => 'required',
                    'vendorAddress' => 'required',

                ]);

                // ---------------------------------------------------------------
                // Save Data to Table: Purchase_Orders
                // ---------------------------------------------------------------

                $purchaseOrder = new PurchaseOrder;
                $purchaseOrder->po_no = $validatedData['poNo'];
                $purchaseOrder->po_date = $validatedData['poDate'];
                $purchaseOrder->quotation_no = $validatedData['poQuotationNo'];
                $purchaseOrder->contact_person_id = $validatedData['contactPersonId'];
                $purchaseOrder->save();

                // ---------------------------------------------------------------
                // Save Data to Table: Delivery_Orders
                // ---------------------------------------------------------------

                $deliveryOrder = new DeliveryOrder;
                $deliveryOrder->do_no = $validatedData['doNo'];
                $deliveryOrder->do_issuance_date = $validatedData['doIssuanceDate'];
                $deliveryOrder->do_signer = $this->doSignerId;
                $deliveryOrder->do_signing_date = $validatedData['doSigningDate'];
                $deliveryOrder->save();

                // ---------------------------------------------------------------
                // Save Data to Table: Invoice
                // ---------------------------------------------------------------

                $invoice = new Invoice;
                $invoice->invoice_no = $validatedData['invoiceNo'];
                $invoice->invoice_issuance_date = $validatedData['invoiceIssuanceDate'];
                $invoice->save();

                // ---------------------------------------------------------------
                // Save Data to Table: Vendor
                // ---------------------------------------------------------------

                $vendor = new Vendor;
                $vendor->name = $validatedData['searchVendorInput'];
                $vendor->address = $validatedData['vendorAddress'];
                $vendor->tel_no = $validatedData['vendorPhoneNo'];
                $vendor->email = $validatedData['vendorEmail'];
                $vendor->save();

                // ---------------------------------------------------------------
                // Save Data to Table: Srvs
                // ---------------------------------------------------------------

                $srv = new Srv;
                $srv->srv_no = $validatedData['srvNo'];
                $srv->srv_signature_date = $validatedData['srvSignatureDate'];
                $srv->save();

                // ---------------------------------------------------------------
                // Save Data to Table: Lejar_Simpanans
                // ---------------------------------------------------------------

                $lejarSimpanan = new LejarSimpanan;
                $lejarSimpanan->moe_reference = $this->ledgerCode;
                $lejarSimpanan->vendor_id = $vendor->id;
                $lejarSimpanan->purchase_order_id = $purchaseOrder->id;
                $lejarSimpanan->delivery_order_id = $deliveryOrder->id;
                $lejarSimpanan->invoice_id = $invoice->id;
                $lejarSimpanan->srv_id = $srv->id;
                $lejarSimpanan->created_by = auth()->guard('ims')->user()->id;
                $lejarSimpanan->save();

                // ------------------------------------------------------------------------------------------------------------------------------
                // STOCK LEDGER DETAILS
                // ------------------------------------------------------------------------------------------------------------------------------

                // ------------------------------------------------------------------------------------------------------------------------------
                // NOTES
                // ------------------------------------------------------------------------------------------------------------------------------
                // KEY CAN BE USED FOR INDEXING MAIN ASSET
                // ------------------------------------------------------------------------------------------------------------------------------

                foreach($this->subAssetSetItems as $mainAssetKey => $subAssetSetItemsValues){

                    // ------------------------------------------------------------------------------------------------------------------------------
                    // MAIN ASSET
                    // ------------------------------------------------------------------------------------------------------------------------------

                    // ------------------------------------------------------------------------------------------------------------------------------
                    // IF USER TYPE IN MAIN ASSET MANUALLY
                    // ------------------------------------------------------------------------------------------------------------------------------

                    if($this->selectedMainAssetIds[$mainAssetKey] == null){

                        // ---------------------------------------------------------------
                        // USER TYPE IN NEW ASSET MANUALLY
                        // ---------------------------------------------------------------

                        $mainAssetName = $this->mainAssetName[$mainAssetKey];
                        $mainAssetCategoryCode = $this->mainAssetCategoryCode[$mainAssetKey];
                        $mainAssetQuantity = $this->mainAssetQuantity[$mainAssetKey];
                        $mainAssetUnitPrice = $this->mainAssetUnitPrice[$mainAssetKey];

                        // ------------------------------------------------------------------------------------------------------------------------------
                        // Save Data to Table: Asset
                        // ------------------------------------------------------------------------------------------------------------------------------

                        $asset = new Asset;
                        $asset->name = $mainAssetName;
                        $asset->asset_type_id = 1;
                        $asset->initial_quantity = $mainAssetQuantity;
                        $asset->asset_category_code_id = $mainAssetCategoryCode;
                        $asset->save();

                        // ---------------------------------------------------------------
                        // CHECK IF THERE ARE ANY BINCARD IN DATABASE - FOR BIN NO
                        // ---------------------------------------------------------------

                        $binCardCount = BinCard::count();

                        if($binCardCount > 0){

                            $latestBinNo = BinCard::latest('id')->pluck('bin_no')->first();
                            preg_match('/BIN(\w)(\d{3})/', $latestBinNo, $matches);
                            $letter = $matches[1];
                            $number = $matches[2];

                            if($number < 999){

                                $number++;
                                $newNumber = str_pad($number, 3, '0', STR_PAD_LEFT);
                                $binNo = "BIN" . $letter . $newNumber;

                            } else {

                                $letter++;
                                $number = 1;
                                $newNumber = str_pad($number, 3, '0', STR_PAD_LEFT);
                                $binNo = "BIN" . $letter . $newNumber;

                            }

                        } else {

                            $binNo = "BINA001";

                        }

                        // ---------------------------------------------------------------
                        // Save Data to Table: Bin_Cards
                        // ---------------------------------------------------------------

                        $binCard = new BinCard();
                        $binCard->bin_no = $binNo;
                        $binCard->store_id = $validatedData['storeLocationFloor'];
                        $binCard->asset_id = $asset->id;
                        $binCard->vocb_no = "tbc";
                        $binCard->qr_code = "test";
                        $binCard->save();

                        // ---------------------------------------------------------------
                        // Save Data to Table: Bin_Card_Entries
                        // ---------------------------------------------------------------

                        $binCardEntry = new BinCardEntry;
                        $binCardEntry->bin_card_id = $binCard->id;
                        // $binCardEntry->date = $dateTimeNow;
                        $binCardEntry->user_type = "vendor";
                        $binCardEntry->user_id = $vendor->id;
                        $binCardEntry->in_quantity = $mainAssetQuantity;
                        $binCardEntry->balance_quantity = $mainAssetQuantity;
                        $binCardEntry->officer_in_charge_id = $userId;
                        $binCardEntry->remarks = $validatedData['remarks'];
                        $binCardEntry->reference_type = "lejar-simpanan";
                        $binCardEntry->reference_id = $lejarSimpanan->id;
                        $binCardEntry->save();

                    } else {

                        // ---------------------------------------------------------------
                        // SEARCH AND SELECT EXISTING ASSET FROM DROPDOWN
                        // ---------------------------------------------------------------

                        $mainAssetName = $this->mainAssetName[$mainAssetKey];
                        $mainAssetCategoryCode = $this->mainAssetCategoryCode[$mainAssetKey];
                        $mainAssetQuantity = $this->mainAssetQuantity[$mainAssetKey];
                        $mainAssetUnitPrice = $this->mainAssetUnitPrice[$mainAssetKey];

                        $mainAssetId = $this->selectedMainAssetIds[$mainAssetKey];

                        // ---------------------------------------------------------------
                        // CHECK IF BIN CARD EXISTS
                        // ---------------------------------------------------------------

                        $binCardExists = BinCard::where('asset_id', $mainAssetId)->exists();

                        // ---------------------------------------------------------------
                        // IF BIN CARD EXISTS, ADD BIN CARD ENTRY
                        // ---------------------------------------------------------------

                        if($binCardExists){

                            $binCardId = BinCard::where('asset_id', $mainAssetId)->first()->id;

                            $latestBalanceQuantity = BinCardEntry::where('bin_card_id', $binCardId)->latest('id')->value('balance_quantity');

                            // ---------------------------------------------------------------
                            // Save Data to Table: Bin_Card_Entries
                            // ---------------------------------------------------------------

                            $binCardEntry = new BinCardEntry;
                            $binCardEntry->bin_card_id = $binCardId;
                            // $binCardEntry->date = $dateTimeNow;
                            $binCardEntry->user_type = "vendor";
                            $binCardEntry->user_id = $vendor->id;
                            $binCardEntry->in_quantity = $mainAssetQuantity;
                            $binCardEntry->balance_quantity = $latestBalanceQuantity + $mainAssetQuantity;
                            $binCardEntry->officer_in_charge_id = $userId;
                            $binCardEntry->remarks = $validatedData['remarks'];
                            $binCardEntry->reference_type = "lejar-simpanan";
                            $binCardEntry->reference_id = $lejarSimpanan->id;
                            $binCardEntry->save();

                        } else {

                            // ---------------------------------------------------------------
                            // CHECK IF THERE ARE ANY BINCARD IN DATABASE - FOR BIN NO
                            // ---------------------------------------------------------------

                            $binCardCount = BinCard::count();

                            if($binCardCount > 0){

                                $latestBinNo = BinCard::latest('id')->pluck('bin_no')->first();
                                preg_match('/BIN(\w)(\d{3})/', $latestBinNo, $matches);
                                $letter = $matches[1];
                                $number = $matches[2];

                                if($number < 999){

                                    $number++;
                                    $newNumber = str_pad($number, 3, '0', STR_PAD_LEFT);
                                    $binNo = "BIN" . $letter . $newNumber;

                                } else {

                                    $letter++;
                                    $number = 1;
                                    $newNumber = str_pad($number, 3, '0', STR_PAD_LEFT);
                                    $binNo = "BIN" . $letter . $newNumber;

                                }

                            } else {

                                $binNo = "BINA001";

                            }

                            // ---------------------------------------------------------------
                            // Save Data to Table: Bin_Cards
                            // ---------------------------------------------------------------

                            $binCard = new BinCard();
                            $binCard->bin_no = $binNo;
                            $binCard->store_id = $validatedData['storeLocationFloor'];
                            $binCard->asset_id = $mainAssetId;
                            $binCard->vocb_no = "tbc";
                            $binCard->qr_code = "test";
                            $binCard->save();


                            // ---------------------------------------------------------------
                            // Save Data to Table: Bin_Card_Entries
                            // ---------------------------------------------------------------

                            $binCardId = BinCard::where('asset_id', $mainAssetId)->first()->id;
                            $latestBalanceQuantity = BinCardEntry::where('bin_card_id', $binCardId)->latest('id')->value('balance_quantity');

                            $binCardEntry = new BinCardEntry;
                            $binCardEntry->bin_card_id = $binCard->id;
                            // $binCardEntry->date = $dateTimeNow;
                            $binCardEntry->user_type = "vendor";
                            $binCardEntry->user_id = $vendor->id;
                            $binCardEntry->in_quantity = $mainAssetQuantity;
                            $binCardEntry->balance_quantity = $latestBalanceQuantity + $mainAssetQuantity;
                            $binCardEntry->officer_in_charge_id = $userId;
                            $binCardEntry->remarks = $validatedData['remarks'];
                            $binCardEntry->reference_type = "lejar-simpanan";
                            $binCardEntry->reference_id = $lejarSimpanan->id;
                            $binCardEntry->save();

                        }

                    }

                    // ------------------------------------------------------------------------------------------------------------------------------
                    // SUB ASSET
                    // ------------------------------------------------------------------------------------------------------------------------------

                    // ------------------------------------------------------------------------------------------------------------------------------
                    // This code is used to fix the error in VSCode Intelliphense for $subAssetSetItemsValues. Not a bug in code.
                    // ------------------------------------------------------------------------------------------------------------------------------
                    /**
                     * @var object $subAssetSetItemsValues
                     */
                    // ------------------------------------------------------------------------------------------------------------------------------
                    // dd($subAssetSetItemsValues);

                    // ---------------------------------------------------------------
                    // KEY CAN BE USED FOR INDEXING SUB-ASSET
                    // ---------------------------------------------------------------

                    foreach($subAssetSetItemsValues as $subAssetKey => $subAssetSetItemsValuesValues){

                        $mainAssetQuantity = $this->mainAssetQuantity[$mainAssetKey];
                        $mainAssetUnitPrice = $this->mainAssetUnitPrice[$mainAssetKey];

                        $subAssetMoeRef = $this->subAssetMoeRefs[$mainAssetKey][$subAssetKey][0];
                        $subAssetSerialNo = $this->subAssetMoeRefs[$mainAssetKey][$subAssetKey][1];

                        // ---------------------------------------------------------------
                        // If User Search and Select Existing MainAsset
                        // ---------------------------------------------------------------

                        if($this->selectedMainAssetIds[$mainAssetKey] !== null){

                            $mainAssetId = $this->selectedMainAssetIds[$mainAssetKey];

                            // ---------------------------------------------------------------
                            // Save Data to Table: Asset Entries
                            // ---------------------------------------------------------------

                            $assetEntry = new AssetEntry;
                            $assetEntry->asset_id = $mainAssetId;
                            $assetEntry->serial_no = $subAssetSerialNo;
                            $assetEntry->moe_reference = $subAssetMoeRef;
                            $assetEntry->asset_status_id = 1;
                            $assetEntry->unit_price = $mainAssetUnitPrice;
                            // $assetEntry->srv_id = $srv->id;
                            $assetEntry->save();

                            // ---------------------------------------------------------------
                            // Save Data to Table: Lejar_Simpanan_Entries
                            // ---------------------------------------------------------------

                            $lejarSimpananEntry = new LejarSimpananEntry();
                            $lejarSimpananEntry->lejar_simpanan_id = $lejarSimpanan->id;
                            $lejarSimpananEntry->asset_entry_id = $assetEntry->id;
                            $lejarSimpananEntry->save();

                        } else {

                            // ---------------------------------------------------------------
                            // Save Data to Table: Asset Entries
                            // ---------------------------------------------------------------

                            $assetEntry = new AssetEntry;
                            $assetEntry->asset_id = $asset->id;
                            $assetEntry->serial_no = $subAssetSerialNo;
                            $assetEntry->moe_reference = $subAssetMoeRef;
                            $assetEntry->asset_status_id = 1;
                            $assetEntry->unit_price = $mainAssetUnitPrice;
                            // $assetEntry->srv_id = $srv->id;
                            $assetEntry->save();

                            // ---------------------------------------------------------------
                            // Save Data to Table: Lejar_Simpanan_Entries
                            // ---------------------------------------------------------------

                            $lejarSimpananEntry = new LejarSimpananEntry();
                            $lejarSimpananEntry->lejar_simpanan_id = $lejarSimpanan->id;
                            $lejarSimpananEntry->asset_entry_id = $assetEntry->id;
                            $lejarSimpananEntry->save();

                        }

                        // ---------------------------------------------------------------
                        // CHECK IF SUBASSET SETITEMS FIELDS ARE FILLED
                        // ---------------------------------------------------------------

                        // ---------------------------------------------------------------
                        // KEY CAN BE USED FOR INDEXING SUBASSET SETITEMS
                        // ---------------------------------------------------------------

                        foreach($subAssetSetItemsValuesValues as $subAssetSetItemKey => $subAssetSetItemsValuesValuesValues){

                            // ------------------------------------------------------------------------------------------------------------------------------
                            // SET ITEM
                            // ------------------------------------------------------------------------------------------------------------------------------

                            // ------------------------------------------------------------------------------------------------------------------------------
                            // SET ITEM DDs
                            // ------------------------------------------------------------------------------------------------------------------------------
                            // dd($this->subAssetSetItems);
                            // dd($this->subAssetSetItems[0][1][2]);
                            // dd($this->subAssetSetItems[$mainAssetKey][$subAssetKey][$subAssetSetItemKey]);
                            // dd($this->subAssetSetItems[$mainAssetKey][$subAssetKey][$subAssetSetItemKey][3]);
                            // ------------------------------------------------------------------------------------------------------------------------------

                            // ---------------------------------------------------------------
                            // SET ITEM ARRAY GUIDE => ($this->subAssetSetItems)
                            // ---------------------------------------------------------------
                            // 0 => Name
                            // 1 => Category Code
                            // 2 => MOE Ref
                            // 3 => Serial No
                            // ---------------------------------------------------------------

                            $subAssetSetItemName = $this->subAssetSetItems[$mainAssetKey][$subAssetKey][$subAssetSetItemKey][0];
                            $subAssetSetItemCategoryCode = $this->subAssetSetItems[$mainAssetKey][$subAssetKey][$subAssetSetItemKey][1];
                            $subAssetSetItemMoeRef = $this->subAssetSetItems[$mainAssetKey][$subAssetKey][$subAssetSetItemKey][2];
                            $subAssetSetItemSerialNo = $this->subAssetSetItems[$mainAssetKey][$subAssetKey][$subAssetSetItemKey][3];

                            // ---------------------------------------------------------------
                            // Check If SubAsset SetItem Is Filled
                            // ---------------------------------------------------------------

                            if(($subAssetSetItemName !== "") && ($subAssetSetItemCategoryCode !== "") && ($subAssetSetItemMoeRef !== "") && ($subAssetSetItemSerialNo !== ""))
                            {
                                // ---------------------------------------------------------------
                                // Save Data to Table: Asset Entry Set Item
                                // ---------------------------------------------------------------

                                $assetEntrySetItem = new AssetEntrySetItem;
                                $assetEntrySetItem->asset_entry_id = $assetEntry->id;
                                $assetEntrySetItem->name = $subAssetSetItemName;
                                $assetEntrySetItem->moe_reference = $subAssetSetItemMoeRef;
                                $assetEntrySetItem->serial_no = $subAssetSetItemSerialNo;
                                $assetEntrySetItem->asset_category_code_id = (int) $subAssetSetItemCategoryCode;
                                $assetEntrySetItem->save();

                            }

                        }

                    }

                }

                // ---------------------------------------------------------------
                // END OF FUNCTION
                // ---------------------------------------------------------------

                // ---------------------------------------------------------------
                // SUCCESS MESSAGE
                // ---------------------------------------------------------------

                $prevData = [
                    'message' => 'Success',
                    'description' => 'Stock Ledger form submitted successfully!',
                ];

                return redirect()->route('ims.viewLedger')->with('success', $prevData);

            }

        } else {

            $prevData = [
                'message' => 'Warning',
                'description' => 'Please fill in the Serial Numbers of Stock Ledgers!',
            ];

            $this->warningToast($prevData);

        }

    }

    // MAIN ASSET 2 = 1 EXISTING (APPLE) + 1 NEW
    // NEW MAIN ASSET = 3 SUBASSET = 2 + 1 + 3 SASI
    // EXISTING MAIN ASSET = 2 SUBASSET = 3 + 1 SASI


    public function save()
    {
    }



    // --------------------------------------------------------------------------------
    // Render
    // --------------------------------------------------------------------------------

    public function render()
    {

        $this->stores = Store::all();

        return view('livewire.pages.ledger.create', [
            // 'staffs' => $this->searchStaffResults,
        ]);

    }


    // --------------------------------------------------------------------------------
    // How to make a 2-leveled nested array
    // --------------------------------------------------------------------------------
    //
    // 1. public $subAssetMoeRefs = [0 => []];
    // 2. array_push() in addMainAsset() and addSubAsset()
    //      2.5. addMainAsset() for 1st level. addSubAsset() for 2nd level.
    // 3. dump array in view to make life easier
    //
    // --------------------------------------------------------------------------------

}
