<?php

namespace App\Http\Controllers;

use PDF;
use App\Models\Siv;
use Illuminate\Http\Request;

class SivPdf extends Controller
{

    // ---------------------------------------------------------------------------------
    // Note:
    // ---------------------------------------------------------------------------------
    // Why use normal controller? because DomPdf does not work in LiveWire
    // ---------------------------------------------------------------------------------

    public function generatePDF (Request $request)
    {
        $id = $request->id;

        $siv = Siv::where('id', $id)->with('sivAssetEntries', 'receiver.receiverLocation')->first();

        $data = [
            'id' => $id,
            'reference_for_request' => $siv->reference_for_request,
            'request_date' => $siv->request_date,
            'siv_no' => $siv->siv_no,
            'deploy_to' => $siv->deploy_to,
        ];

        // $pdf = PDF::loadView('pages.siv-pdf', $data);

        // Name of file if user clicks 'Save'
        // return $pdf->stream( $siv->siv_no . '.pdf');

    }

}
