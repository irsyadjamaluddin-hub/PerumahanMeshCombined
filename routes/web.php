<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Input;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\VerifyController;
use App\Http\Controllers\AnnouncementController;
use App\Mail\MailtrapExample;
use Illuminate\Support\Facades\Mail;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Support\Facades\Auth;
use \Illuminate\Http\Request;
use App\Http\Controllers\StagingController;
use App\Http\Controllers\InventoryController;

use App\Http\Controllers\StaffReportController;
use App\Http\Controllers\PemegangJawatanController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\StatusJawatanController;
use App\Http\Controllers\EminitController;
use App\Http\Controllers\StatusRumahController;
use App\Http\Controllers\SPISKPIController;
use Illuminate\Support\Facades\Crypt;

// ------------------------------------------------------------------------
// INVENTORY MANAGEMENT SYSTEM (IMS)
// ------------------------------------------------------------------------
// ADDED BY AZB @ 16/07/24
// ------------------------------------------------------------------------

use App\Http\Controllers\SivPdf;
use App\Http\Livewire\Pages\Login;
use App\Http\Livewire\Pages\LoginV2;
use App\Http\Controllers\Auth\Logout as IMSLogout;
use App\Http\Controllers\DevopsAdminEmailController;
use App\Http\Controllers\DevopsRequestController;
use App\Http\Controllers\SupportCenterController;

use App\Http\Controllers\ProcessEmail;
use App\Http\Livewire\Pages\Dashboard;
use App\Http\Livewire\Pages\Siv\Process;
use App\Http\Livewire\Pages\Siv\SavePdf;
use App\Http\Livewire\Pages\Siv\ShowPdf;
use App\Http\Livewire\Pages\User\Profile;
use App\Http\Livewire\Pages\Bincard\Qrcodelist;
use App\Http\Livewire\Pages\Ledger\ShowRequest;
use App\Http\Livewire\Pages\Ledger\ViewRequest;
use App\Http\Livewire\Pages\Siv\Show as ShowSiv;
use App\Http\Livewire\Pages\Siv\View as ViewSiv;
use App\Http\Livewire\Pages\Ledger\ProcessRequest;
use App\Http\Livewire\Pages\User\View as ViewUser;
use App\Http\Livewire\Pages\Bincard\ShowQrcodelist;
use App\Http\Livewire\Pages\Siv\Create as CreateSiv;
use App\Http\Livewire\Pages\Ledger\Show as ShowLedger;
use App\Http\Livewire\Pages\Ledger\View as ViewLedger;
use App\Http\Livewire\Pages\Siv\Process as ProcessSiv;
use App\Http\Livewire\Pages\User\Create as CreateUser;
use App\Http\Livewire\Pages\User\Update as UpdateUser;
use App\Http\Livewire\Pages\Vendor\View as ViewVendor;
use App\Http\Livewire\Pages\Penyerahan\ReceiverProcess;
use App\Http\Livewire\Pages\Bincard\Show as ShowBinCard;
use App\Http\Livewire\Pages\Bincard\View as ViewBinCard;
use App\Http\Livewire\Pages\Ledger\Create as CreateLedger;
use App\Http\Livewire\Pages\Receiver\View as ViewReceiver;
use App\Http\Livewire\Pages\Bukudaftar\Show as ShowBukuDaftar;
use App\Http\Livewire\Pages\Bukudaftar\View as ViewBukuDaftar;
use App\Http\Livewire\Pages\Penyerahan\Show as ShowPenyerahan;
use App\Http\Livewire\Pages\Penyerahan\View as ViewPenyerahan;
use App\Http\Livewire\Pages\Siv\ShowRequest as ShowRequestSiv;
use App\Http\Livewire\Pages\Siv\ViewRequest as ViewRequestSiv;
use App\Http\Livewire\Pages\StaffBoard\View as ViewStaffBoard;
use App\Http\Livewire\Pages\Statistics\View as ViewStatistics;
use App\Http\Livewire\Pages\Announcement\View as ViewAnnouncement;
use App\Http\Livewire\Pages\Bukudaftar\Create as CreateBukuDaftar;
use App\Http\Livewire\Pages\Notification\View as ViewNotification;
use App\Http\Livewire\Pages\Siv\CreateRequest as CreateRequestSiv;
use App\Http\Livewire\Pages\Penyerahan\Process as ProcessPenyerahan;
use App\Http\Livewire\Pages\Siv\ProcessRequest as ProcessRequestSiv;
use App\Http\Livewire\Pages\StoreInventory\View as ViewStoreInventory;
use App\Http\Livewire\Pages\AssetCategoryCode\View as ViewAssetCategoryCode;

// Staging Area
Route::get('/stag/login' , [App\Http\Controllers\StagingController::class, 'loginIndex'])->name('loginIndex');
Route::post('/stag/login/submit' , [App\Http\Controllers\StagingController::class, 'loginSubmit'])->name('loginSubmit');

Route::get('/stag/reg' , [App\Http\Controllers\StagingController::class, 'regIndex'])->name('regIndex');
Route::post('/stag/reg/store' , [App\Http\Controllers\StagingController::class, 'regSubmit'])->name('regSubmit');

Route::get('/stag/approve/{encryptedId}' , [App\Http\Controllers\StagingController::class, 'stagApprove'])->name('stagApprove');
Route::post('/stag/approve/update' , [App\Http\Controllers\StagingController::class, 'stagApproveUpdate'])->name('stagApproveUpdate');

Route::get('/stag/emailOne/send' , [App\Http\Controllers\StagingController::class, 'emailOneSend'])->name('emailOneSend');
Route::get('/stag/emailOne/show' , [App\Http\Controllers\StagingController::class, 'emailOneShow'])->name('emailOneShow');

Route::get('/stag/emailTwo/send' , [App\Http\Controllers\StagingController::class, 'emailTwoSend'])->name('emailTwoSend');
Route::get('/stag/emailTwo/show' , [App\Http\Controllers\StagingController::class, 'emailTwoShow'])->name('emailTwoShow');

Route::get('/stag/landing' , [App\Http\Controllers\StagingController::class, 'newLanding'])->name('newLanding');



// Route::get('/approververify/{encryptedId}', 'RegisterVerifyController@approveverify')
//     ->name('approververify');

// Route::post('/update', 'RegisterVerifyController@update')
// ->name('registerverify.registerverify.update')
// ->where('id', '[0-9]+');


Route::get('/storage/{filePath}',[App\Http\Controllers\FilesController::class,'downloadFile'])->where('filePath','.*');     
Route::post('/tests/uploads',[App\Http\Controllers\FilesController::class,'uploadFile']);
// ------------------------------------------------------------------------
// IMS [END]
// ------------------------------------------------------------------------


// ------------------------------------------------------------------------
// INVENTORY MANAGEMENT SYSTEM (IMS)
// ------------------------------------------------------------------------
// ADDED BY AZB @ 16/07/24
// ------------------------------------------------------------------------

Route::prefix('ims')->group(function () {

    // --------------------------------------------------------------------
    //  UnAuthenticated
    // --------------------------------------------------------------------

    Route::group(['middleware' => ['stranger']], function(){

        Route::get('/', [Login::class, '__invoke'])->name('ims.login');

    });

    // --------------------------------------------------------------------
    //  Authenticated
    // --------------------------------------------------------------------

    Route::middleware('auth:ims')->group(function () {

        // --------------------------------------------------------------------
        //  Others
        // --------------------------------------------------------------------

            Route::get('/dashboard', [Dashboard::class, '__invoke'])->name('ims.dashboard');
            Route::post('/ims-logout', [IMSLogout::class, 'logout'])->name('ims.logout');
            Route::get('/user/profile', [Profile::class, '__invoke'])->name('ims.myProfile');

            Route::get('/statistics/view', [ViewStatistics::class, '__invoke'])->name('ims.viewStatistics');
            Route::get('/announcement/view', [ViewAnnouncement::class, '__invoke'])->name('ims.viewAnnouncements');

        // --------------------------------------------------------------------
        //  User
        // --------------------------------------------------------------------

            Route::group(['middleware' => ['admin']], function(){

                Route::get('/user/create', [CreateUser::class, '__invoke'])->name('ims.createUser');
                Route::get('/user/view', [ViewUser::class, '__invoke'])->name('ims.viewUser');
                Route::get('/user/update/{id}', [UpdateUser::class, '__invoke'])->name('ims.updateUser');

            });

        // --------------------------------------------------------------------
        //  Ledger
        // --------------------------------------------------------------------

            Route::get('/ledger/view', [ViewLedger::class, '__invoke'])->name('ims.viewLedger');

            Route::group(['middleware' => ['storekeeper']], function(){
                Route::get('/ledger/create', [CreateLedger::class, '__invoke'])->name('ims.createLedger');
            });

            Route::get('/ledger/show/{id}', [ShowLedger::class, '__invoke'])->name('ims.showLedger');

            Route::get('/ledger/view-request', [ViewRequest::class, '__invoke'])->name('ims.viewLedgerRequest');

            Route::get('/ledger/show-request/{id}', [ShowRequest::class, '__invoke'])->name('ims.showLedgerRequest');
            Route::get('/ledger/process-request/{id}', [ProcessRequest::class, '__invoke'])->name('ims.processLedgerRequest');


        // --------------------------------------------------------------------
        //  Staff Board
        // --------------------------------------------------------------------

            Route::get('/staffboard/view', [ViewStaffBoard::class, '__invoke'])->name('ims.viewStaffBoard');

        // --------------------------------------------------------------------
        //  Buku Daftar
        // --------------------------------------------------------------------

            Route::get('/bukudaftar/view', [ViewBukuDaftar::class, '__invoke'])->name('ims.viewBukuDaftar');

            Route::group(['middleware' => ['storekeeper']], function(){
                Route::get('/bukudaftar/create', [CreateBukuDaftar::class, '__invoke'])->name('ims.createBukuDaftar');
            });

            Route::get('/bukudaftar/show/{id}', [ShowBukuDaftar::class, '__invoke'])->name('ims.showBukuDaftar');

        // --------------------------------------------------------------------
        //  SIV
        // --------------------------------------------------------------------

            Route::get('/siv/view', [ViewSiv::class, '__invoke'])->name('ims.viewSiv');
            Route::get('/siv/create', [CreateSiv::class, '__invoke'])->name('ims.createSiv');
            Route::get('/siv/show/{id}', [ShowSiv::class, '__invoke'])->name('ims.showSiv');
            Route::get('/siv/process/{id}', [ProcessSiv::class, '__invoke'])->name('ims.processSiv');

            Route::get('/siv/request/view', [ViewRequestSiv::class, '__invoke'])->name('ims.viewRequestSiv');
            Route::get('/siv/request/show/{id}', [ShowRequestSiv::class, '__invoke'])->name('ims.showRequestSiv');
            Route::get('/siv/request/process/{id}', [ProcessRequestSiv::class, '__invoke'])->name('ims.processRequestSiv');
            Route::group(['middleware' => ['technical-team']], function(){
                Route::get('/siv/request/create', [CreateRequestSiv::class, '__invoke'])->name('ims.createRequestSiv');
            });

            Route::get('/siv/showpdf/{id}', [ShowPdf::class, '__invoke'])->name('ims.showPdf');

            Route::get('/siv/savepdf/{id}', [SavePdf::class, '__invoke'])->name('ims.savePdf');


        // --------------------------------------------------------------------
        //  Bin Cards
        // --------------------------------------------------------------------

            Route::get('/bincard/view', [ViewBinCard::class, '__invoke'])->name('ims.viewBinCard');
            Route::get('/bincard/show/{id}', [ShowBinCard::class, '__invoke'])->name('ims.showBinCard');
            Route::get('/bincard/qrcodelist', [Qrcodelist::class, '__invoke'])->name('ims.qrCodeList');
            Route::get('/bincard/qrcodelist/show', [ShowQrcodelist::class, '__invoke'])->name('ims.showQrCodeList');

        // --------------------------------------------------------------------
        //  Store Inventory
        // --------------------------------------------------------------------

        Route::get('/store-inventory/view', [ViewStoreInventory::class, '__invoke'])->name('ims.viewStoreInventory');

        // --------------------------------------------------------------------
        //  Notifications
        // --------------------------------------------------------------------

        Route::get('/notifications/view', [ViewNotification::class, '__invoke'])->name('ims.viewNotification');

        // --------------------------------------------------------------------
        //  Penyerahan
        // --------------------------------------------------------------------

        Route::get('/penyerahan/view', [ViewPenyerahan::class, '__invoke'])->name('ims.ViewPenyerahan');
        Route::get('/penyerahan/show/{id}', [ShowPenyerahan::class, '__invoke'])->name('ims.showPenyerahan');
        Route::get('/penyerahan/process/{id}', [ProcessPenyerahan::class, '__invoke'])->name('ims.processPenyerahan');

        Route::view('/emel', 'emails/receiverCopyOfBorangPenyerahan');

        // --------------------------------------------------------------------
        //  Vendor
        // --------------------------------------------------------------------

        Route::get('/vendor/view', [ViewVendor::class, '__invoke'])->name('ims.viewVendor');

        // --------------------------------------------------------------------
        //  Receiver
        // --------------------------------------------------------------------

        Route::get('/receiver/view', [ViewReceiver::class, '__invoke'])->name('ims.viewReceiver');

        // --------------------------------------------------------------------
        //  Receiver
        // --------------------------------------------------------------------

        Route::get('/assetCategoryCode/view', [ViewAssetCategoryCode::class, '__invoke'])->name('ims.viewAssetCategoryCode');

        // --------------------------------------------------------------------
        //  Test
        // --------------------------------------------------------------------

        Route::get('/email', function () {
            return view('emails.test');
        });

    });

});

// ------------------------------------------------------------------------
// IMS [END]
// ------------------------------------------------------------------------



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/db-test', function () {
    try {
        DB::connection('ease')->getPdo();
        return 'Database connection is successful!';
    } catch (\Exception $e) {
        return 'Database connection failed: ' . $e->getMessage();
    }
});

Route::get('mbrs/{slug}', 'UrlMaskingController@redirect')->where('slug', '.*');

Route::get('export/excel', 'SKController@exportToExcel')->name('export.excel');
Route::get('export/pdf', 'SKController@exportToPdf')->name('export.pdf');

//Banner

Route::get('/maintenancepage','UsersController@maintenance')
     ->name('maintenance.page');

Route::group(
     [
     'prefix' => 'banners',
     ], function () {

     Route::get('/index', 'BannerController@index')
          ->name('bn.banner.index')
          ->middleware('checkRole:ROLE_SUPERADMIN');

     
     Route::post('/store','BannerController@store')
          ->name('bn.banner.store');

     Route::delete('/{bns}/delete','BannerController@delete')
          ->name('bn.banner.delete')
          ->where('id', '[0-9]+');
          
     });

// soalanbiskita

Route::get('/tanyamoebn', 'SoalanbiskitaController@isisoalanbiskita')
->name('soalanbiskita');

//remarks in index cdd inventory
use App\Http\Controllers\CddInventoryController;

Route::put('/cddinventory/{id}/update-remarks', [CddInventoryController::class, 'updateRemarks'])
    ->name('cddinventory.cddinventory.updateRemarks');

Route::put('/cddinventory/unit/{id}/update-remarks', [CddInventoryController::class, 'updateRemarksUnit'])
    ->name('cddinventory.cddinventory.updateRemarksUnit');

Route::group(
     [
     'prefix' => 'tanyamoebn',
     ], function () {

          Route::get('/indexadmin', 'SoalanbiskitaController@indexadmin')
          ->name('soalanbiskita.soalanbiskita.indexadmin')
          ->middleware('checkRole:ROLE_SUPERADMIN|ROLE_TANYAMOEBN');


          Route::get('/index', 'SoalanbiskitaController@index')
          ->name('soalanbiskita.soalanbiskita.index');

          
          Route::get('/jabatanlist', 'SoalanbiskitaController@jabatanlist')
          ->name('soalanbiskita.soalanbiskita.jabatanlist');

          Route::get('/{jl}/editdept','SoalanbiskitaController@editdept')
          ->name('soalanbiskita.soalanbiskita.editdept')
          ->where('id', '[0-9]+');

     Route::get('/{sb}/show','SoalanbiskitaController@show')
          ->name('soalanbiskita.soalanbiskita.show')
          ->where('id', '[0-9]+');

          Route::post('/updatedept', 'SoalanbiskitaController@updatedept')
          ->name('soalanbiskita.soalanbiskita.updatedept')
          ->where('id', '[0-9]+');

          Route::get('/editperkara', 'SoalanbiskitaController@editperkara')
          ->name('soalanbiskita.soalanbiskita.editperkara');

          
          Route::post('/storeperkara', 'SoalanbiskitaController@storeperkara')
          ->name('soalanbiskita.soalanbiskita.storeperkara');

          Route::post('storeperkaraic/{id}', 'SoalanbiskitaController@storeperkaraic')
          ->name('soalanbiskita.soalanbiskita.storeperkaraic')
          ->where('id', '[0-9]+');

          Route::get('/editperkara', 'SoalanbiskitaController@editperkara')
          ->name('soalanbiskita.soalanbiskita.editperkara');

          Route::get('{ep}/editperkaraic', 'SoalanbiskitaController@editperkaraic')
          ->name('soalanbiskita.soalanbiskita.editperkaraic')
          ->where('id', '[0-9]+');


          Route::delete('{tanya}/destroyperkara', 'SoalanbiskitaController@destroyperkara')
               ->name('soalanbiskita.soalanbiskita.destroyperkara')
               ->where('id', '[0-9]+');

          Route::post('/store', 'SoalanbiskitaController@store')
          ->name('soalanbiskita.soalanbiskita.store');

          Route::delete('/sb/{sb}','SoalanbiskitaController@destroy')
          ->name('soalanbiskita.soalanbiskita.destroy')
          ->where('id', '[0-9]+');

          // Route::get('/soalanbiskita/{sb}/tindakan', 'SoalanbiskitaController@tindakan')->name('soalanbiskita.soalanbiskita.tindakan');
          Route::post('/soalanbiskita/updatetindakans', 'SoalanbiskitaController@updatetindakan')
          ->name('soalanbiskita.soalanbiskita.tindakan');
Route::post('/soalanbiskita/updatetindakansuser', 'SoalanbiskitaController@updatetindakanuser')
          ->name('soalanbiskita.soalanbiskita.tindakanuser');
          Route::get('/soalanbiskita/{sb}/selesai', 'SoalanbiskitaController@selesai')->name('soalanbiskita.soalanbiskita.selesai');
     });


Route::get('/Perasmian', function() {
     return view('perasmian');
});

Route::get('/perasmiannext', function() {
     return view('perasmiannext');
});

Route::get('/sk', 'SKController@isiborang')
->name('slipkehadiran');

//SK Page
Route::group(
     [
     'prefix' => 'sk',
     ], function () {

          Route::get('/indexadmin', 'SKController@indexadmin')
          ->name('sk.slipkedatangan.indexadmin');

          Route::get('/showslip/{skperkara}', 'SKController@showslip')
          ->name('sk.slipkedatangan.showslip')
          ->where('id', '[0-9]+');

          Route::post('/showslip/{skperkara}', 'SKController@updateslip')
          ->name('sk.slipkedatangan.updateslip')
          ->where('id', '[0-9]+');

          Route::get('/createevent', 'SKController@createevent')
          ->name('sk.slipkedatangan.createevent');

          Route::post('/store', 'SKController@store')
          ->name('sk.slipkedatangan.store');

          

          Route::post('/storeperkara', 'SKController@storeperkara')
          ->name('sk.slipkedatangan.storeperkara');

          Route::delete('{skp}/deleteperkarask', 'SKController@destroyperkara')
               ->name('sk.slipkedatangan.destroy')
               ->where('id', '[0-9]+');
     
     });

// SK Raya 2025 Page
Route::get('/sk-raya2025', 'SKRaya2025Controller@isiborang')
->name('slipkehadiran.raya2025');
Route::group(
     [
     'prefix' => 'sk-raya2025',
     ], function () {
          Route::post('/store', 'SKRaya2025Controller@store')
          ->name('sk.slipkedatangan.raya2025.store');
     
     });

//SSMRequests
use App\Http\Controllers\SSMRequestController;

Route::prefix('ssmrequests')->group(function () {
    // Current records (≤ 1 month old)
    Route::get('/', [SSMRequestController::class, 'indexall'])->name('ssmrequests.indexall');

    // Archived records (> 1 month old)
    Route::get('/archived', [SSMRequestController::class, 'archived'])->name('ssmrequests.archived');
});


 //Ekma add 13dec23
Route::get('/borangaduanssm', 'SSMRequestController@openform')
->name('ssmrequest'); 

Route::get('/borangaduanssm/statusrujukan', 'SSMRequestController@statusopenform')
->name('statusssmrequest');
Route::get('/borangaduanssm', 'SSMRequestController@openform')
->name('ssmrequest'); 

Route::get('/borangaduanssm/statusrujukan', 'SSMRequestController@statusopenform')
->name('statusssmrequest');

Route::group(
     [
          'prefix' => 'ssmrequests',
     ],
     function () {

          Route::get('/', 'SSMRequestController@index')
               ->name('ssmrequests.ssmrequest.index');

          Route::get('/indexall', 'SSMRequestController@indexall')
               ->name('ssmrequests.ssmrequest.indexall')
               ->middleware('checkRole:ROLE_SSM|ROLE_SUPERADMIN|ROLE_ADUANSSM');

          Route::get('/indexallsearch', 'SSMRequestController@indexallsearch')
               ->name('indexallsearch');

               

          Route::get('/indexpermohonan', 'SSMRequestController@indexpermohonan')
               ->name('ssmrequests.ssmrequest.indexpermohonan')
               ->middleware('checkRole:ROLE_SSM|ROLE_SUPERADMIN');


          Route::get('/indexstaffpermohonan', 'SSMRequestController@indexstaffpermohonan')
               ->name('ssmrequests.ssmrequest.indexstaffpermohonan');

          Route::get('/{ssm}/show', 'SSMRequestController@show')
               ->name('ssmrequests.ssmrequest.show');


          Route::get('/create', 'SSMRequestController@create')
               ->name('ssmrequests.ssmrequest.create');

          Route::get('/createpermohonan', 'SSMRequestController@createpermohonan')
               ->name('ssmrequests.ssmrequest.createpermohonan');


          Route::post('/store', 'SSMRequestController@store')
               ->name('ssmrequests.ssmrequest.store');

               // ekma add here

           Route::post('/storepermohonan', 'SSMRequestController@storepermohonan')
               ->name('ssmrequests.ssmrequest.storepermohonan');

          Route::post('/storebakicuti', 'SSMRequestController@storebakicuti')
               ->name('ssmrequests.ssmrequest.storebakicuti');

          Route::post('/storepertukaranic', 'SSMRequestController@storepertukaranic')
               ->name('ssmrequests.ssmrequest.storepertukaranic');

          Route::post('/storeapproval', 'SSMRequestController@storeapproval')
               ->name('ssmrequests.ssmrequest.storeapproval');

          Route::post('/storedc', 'SSMRequestController@storedc')
               ->name('ssmrequests.ssmrequest.storedc');

          Route::post('/storeot', 'SSMRequestController@storeot')
               ->name('ssmrequests.ssmrequest.storeot');

          Route::post('/storeps', 'SSMRequestController@storeps')
               ->name('ssmrequests.ssmrequest.storeps');

          Route::post('/storepe', 'SSMRequestController@storepe')
               ->name('ssmrequests.ssmrequest.storepe');

          // Added by Amal 'Izzah (PB)
          Route::post('/storeapprovalform', 'SSMRequestController@storeapprovalopenform')
               ->name('ssmrequests.ssmrequest.storeapprovalopenform');


          Route::post('/storedcform', 'SSMRequestController@storedcopenform')
               ->name('ssmrequests.ssmrequest.storedcopenform');
          

          Route::post('/storepsform', 'SSMRequestController@storepsopenform')
               ->name('ssmrequests.ssmrequest.storepsopenform');
 

          Route::post('/storepeform', 'SSMRequestController@storepeopenform')
               ->name('ssmrequests.ssmrequest.storepeopenform');

          Route::post('/storeotform', 'SSMRequestController@storeotopenform')
               ->name('ssmrequests.ssmrequest.storeotopenform');

          // END Izzah


          Route::get('/{ssmsrq}/editadminpermohonan', 'SSMRequestController@editadminpermohonan')
               ->name('ssmrequests.ssmrequest.editadminpermohonan')
               ->where('id', '[0-9]+');

          Route::get('/{ssmsrq}/editadminbakicuti', 'SSMRequestController@editadminbakicuti')
               ->name('ssmrequests.ssmrequest.editadminbakicuti')
               ->where('id', '[0-9]+');

          Route::get('/{ssmsrq}/editadminpertukaranic', 'SSMRequestController@editadminpertukaranic')
               ->name('ssmrequests.ssmrequest.editadminpertukaranic')
               ->where('id', '[0-9]+');

          Route::get('/{ssmsrq}/editadminapproval', 'SSMRequestController@editadminapproval')
               ->name('ssmrequests.ssmrequest.editadminapproval')
               ->where('id', '[0-9]+');

          Route::get('/{ssmsrq}/editadmindc', 'SSMRequestController@editadmindc')
               ->name('ssmrequests.ssmrequest.editadmindc')
               ->where('id', '[0-9]+');

          Route::get('/{ssmsrq}/editadminpassword', 'SSMRequestController@editadminpassword')
               ->name('ssmrequests.ssmrequest.editadminpassword')
               ->where('id', '[0-9]+');

          Route::get('/{ssmsrq}/editadminperanan', 'SSMRequestController@editadminperanan')
               ->name('ssmrequests.ssmrequest.editadminperanan')
               ->where('id', '[0-9]+');

          Route::get('/{ssmsrq}/editadminother', 'SSMRequestController@editadminother')
               ->name('ssmrequests.ssmrequest.editadminother')
               ->where('id', '[0-9]+');

          Route::post('/updateadminpermohonan', 'SSMRequestController@updateadminpermohonan')
               ->name('ssmrequests.ssmrequest.updateadminpermohonan')
               ->where('id', '[0-9]+');

          Route::post('/updatestatusadminpermohonan', 'SSMRequestController@updatestatusadminpermohonan')
               ->name('ssmrequests.ssmrequest.updatestatusadminpermohonan')
               ->where('id', '[0-9]+');

          Route::post('/updatestatusdispatchpermohonan', 'SSMRequestController@updatestatusdispatchpermohonan')
               ->name('ssmrequests.ssmrequest.updatestatusdispatchpermohonan')
               ->where('id', '[0-9]+');

          Route::post('/updateadminbakicuti', 'SSMRequestController@updateadminbakicuti')
               ->name('ssmrequests.ssmrequest.updateadminbakicuti')
               ->where('id', '[0-9]+');

          Route::post('/updateadminpertukaranic', 'SSMRequestController@updateadminpertukaranic')
               ->name('ssmrequests.ssmrequest.updateadminpertukaranic')
               ->where('id', '[0-9]+');

          Route::post('/updateadminapproval', 'SSMRequestController@updateadminapproval')
               ->name('ssmrequests.ssmrequest.updateadminapproval')
               ->where('id', '[0-9]+');

          Route::post('/updateadmindc', 'SSMRequestController@updateadmindc')
               ->name('ssmrequests.ssmrequest.updateadmindc')
               ->where('id', '[0-9]+');

          Route::post('/updateadminpassword', 'SSMRequestController@updateadminpassword')
               ->name('ssmrequests.ssmrequest.updateadminpassword')
               ->where('id', '[0-9]+');

          Route::post('/updateadminperanan', 'SSMRequestController@updateadminperanan')
          ->name('ssmrequests.ssmrequest.updateadminperanan')
          ->where('id', '[0-9]+');

          Route::post('/updateadminother', 'SSMRequestController@updateadminother')
          ->name('ssmrequests.ssmrequest.updateadminother')
          ->where('id', '[0-9]+');

               // end ekma touch


                // ekma add 21dec23

           Route::get('/ssmkod', 'SSMRequestController@ssmkod')
               ->name('ssmrequests.ssmrequest.ssmkod');

          Route::post('/storessmkod', 'SSMRequestController@storessmkod')
               ->name('ssmrequests.ssmrequest.storessmkod');

           Route::delete('/ssmkoddelete/{dis}', 'SSMRequestController@destroyssmkod')
               ->name('ssmrequests.ssmrequest.destroyssmkod')
               ->where('id', '[0-9]+');

          // end ekma add 21dec23

           Route::get('/{pm}/editstaffpermohonan', 'SSMRequestController@editstaffpermohonan')
               ->name('ssmrequests.ssmrequest.editstaffpermohonan')
               ->where('id', '[0-9]+');

          Route::get('/{pm}/editstaffaction', 'SSMRequestController@editstaffaction')
               ->name('ssmrequests.ssmrequest.editstaffaction')
               ->where('id', '[0-9]+');

          Route::post('/updatestaffpermohonan', 'SSMRequestController@updatestaffpermohonan')
               ->name('ssmrequests.ssmrequest.updatestaffpermohonan')
               ->where('id', '[0-9]+');

          Route::post('/updatestaffpermohonanstatus', 'SSMRequestController@updatestaffpermohonanstatus')
               ->name('ssmrequests.ssmrequest.updatestaffpermohonanstatus')
               ->where('id', '[0-9]+');

          Route::delete('/destroypermohonanicno/{pm}', 'SSMRequestController@destroypermohonanicno')
               ->name('ssmrequests.ssmrequest.destroypermohonanicno')
               ->where('id', '[0-9]+');

               // end ekma add


          Route::post('/updateadmin', 'SSMRequestController@updateadmin')
               ->name('ssmrequests.ssmrequest.updateadmin')
               ->where('id', '[0-9]+');


          Route::get('/{ssmsrq}/editadmin', 'SSMRequestController@editadmin')
               ->name('ssmrequests.ssmrequest.editadmin')
               ->where('id', '[0-9]+');

               // ekma add destroy 8 jan 2024

          Route::delete('{ssmsrq}/deleteapproval', 'SSMRequestController@destroyapproval')
               ->name('ssmrequests.ssmrequest.destroyapproval')
               ->where('id', '[0-9]+');

          Route::delete('{ssmsrq}/deletecuti', 'SSMRequestController@destroydc')
               ->name('ssmrequests.ssmrequest.destroydc')
               ->where('id', '[0-9]+');

          Route::delete('{ssmsrq}/deleteperanan', 'SSMRequestController@destroyperanan')
               ->name('ssmrequests.ssmrequest.destroyperanan')
               ->where('id', '[0-9]+');

          Route::delete('{ssmsrq}/deletepassword', 'SSMRequestController@destroypassword')
               ->name('ssmrequests.ssmrequest.destroypassword')
               ->where('id', '[0-9]+');

           Route::delete('{ssmsrq}/deletebakicuti', 'SSMRequestController@destroybakicuti')
               ->name('ssmrequests.ssmrequest.destroybakicuti')
               ->where('id', '[0-9]+');

          Route::delete('{ssmsrq}/deletepertukaranic', 'SSMRequestController@destroypertukaranic')
               ->name('ssmrequests.ssmrequest.destroypertukaranic')
               ->where('id', '[0-9]+');

          Route::delete('{ssmsrq}/deleteother', 'SSMRequestController@destroyother')
               ->name('ssmrequests.ssmrequest.destroyother')
               ->where('id', '[0-9]+');

               //Zharif add 28/5/24
          Route::get('/indexpermohonan/indexstafftasks', 'SSMRequestController@indexstafftasks')
               ->name('ssmrequests.ssmrequest.indexstafftasks');
     
          //Zharif add 17/1/24
          Route::get('/indexpermohonan/jenispermohonan', 'SSMRequestController@indexjenispermohonan')
               ->name('ssmrequests.ssmrequest.indexjenispermohonan');

          Route::get('/createpermohonansalinan', 'SSMRequestController@createpermohonansalinan')
               ->name('ssmrequests.ssmrequest.createpermohonansalinan');

          Route::get('/indexpermohonan/jenispermohonan/editjenispermohonan/{id}', 'SSMRequestController@editjenispermohonan')
               ->name('ssmrequests.ssmrequest.editjenispermohonan');

          Route::get('/{id}/editstaffsalinan', 'SSMRequestController@editstaffsalinan')
               ->name('ssmrequests.ssmrequest.editstaffsalinan')
               ->where('id', '[0-9]+');

          Route::post('/updatestaffsalinan', 'SSMRequestController@updatestaffsalinan')
               ->name('ssmrequests.ssmrequest.updatestaffsalinan')
               ->where('id', '[0-9]+');

          Route::post('/indexpermohonan/jenispermohonan/editjenispermohonan/update', 'SSMRequestController@updatejenispermohonan')
               ->name('ssmrequests.ssmrequest.updatejenispermohonan');

          Route::post('/indexpermohonan/jenispermohonan/storejenispermohonan', 'SSMRequestController@storejenispermohonan')
               ->name('ssmrequests.ssmrequest.storejenispermohonan');

          Route::post('/storepermohonansalinan', 'SSMRequestController@storepermohonansalinan')
               ->name('ssmrequests.ssmrequest.storepermohonansalinan');

          Route::delete('/indexpermohonan/jenispermohonan/{ssmsrq}/deletejenispermohonan', 'SSMRequestController@destroyjenispermohonan')
               ->name('ssmrequests.ssmrequest.destroyjenispermohonan')
               ->where('id', '[0-9]+');
               
          Route::delete('/indexpermohonan/{ssmsrq}/deletepermohonan', 'SSMRequestController@destroypermohonan')
               ->name('ssmrequests.ssmrequest.destroypermohonan')
               ->where('id', '[0-9]+');

          Route::delete('/destroypermohonansalinanicno/{id}', 'SSMRequestController@destroypermohonansalinanicno')
               ->name('ssmrequests.ssmrequest.destroypermohonansalinanicno')
               ->where('id', '[0-9]+');

          Route::delete('/indexstaffpermohonan/{ssmsrq}/deletepermohonansalinan', 'SSMRequestController@destroypermohonansalinan')
               ->name('ssmrequests.ssmrequest.destroypermohonansalinan')
               ->where('id', '[0-9]+');
     }
);

Route::group(
     [
     'prefix' => 'ssmtatatertib',
     ], function () {
          //SSM Tatatertib - Fira (24/1)
          Route::get('/indextatatertib', 'SSMTatatertibController@indextatatertib')
               ->name('ssmtatatertib.ssmrequest.indextatatertib');

          Route::get('/createtatatertib', 'SSMTatatertibController@createtatatertib')
               ->name('ssmtatatertib.ssmrequest.createtatatertib');

          Route::post('/storetatatertib', 'SSMTatatertibController@storetatatertib')
               ->name('ssmtatatertib.ssmrequest.storetatatertib');

          Route::get('/{ssmsrq}/editadmintatatertib', 'SSMTatatertibController@editadmintatatertib')
               ->name('ssmtatatertib.ssmrequest.editadmintatatertib')
               ->where('ssmsrq', '[0-9]+');
      
          Route::delete('/indextatatertib/{ssmsrq}/deletetatatertib', 'SSMTatatertibController@destroytatatertib')
               ->name('ssmtatatertib.ssmrequest.destroytatatertib')
               ->where('id', '[0-9]+');

          Route::post('/updateadmintatatertib', 'SSMTatatertibController@updateadmintatatertib')
               ->name('ssmtatatertib.ssmrequest.updateadmintatatertib')
               ->where('id', '[0-9]+');

          Route::post('/updatestatusadmintatatertib', 'SSMTatatertibController@updatestatusadmintatatertib')
               ->name('ssmtatatertib.ssmrequest.updatestatusadmintatatertib')
               ->where('id', '[0-9]+');

          Route::post('/indextatatertib/editadmintatatertib/update', 'SSMTatatertibController@updatetatatertibcatatan')
               ->name('ssmtatatertib.ssmrequest.updatetatatertibcatatan');
                  
          Route::post('/storeCatatan', 'SSMTatatertibController@storeCatatan')
               ->name('ssmtatatertib.ssmrequest.storeCatatan');

          Route::post('/updateCatatan/{id}', 'SSMTatatertibController@updateCatatan')
               ->name('ssmtatatertib.ssmrequest.updateCatatan');

          Route::delete('/destroyCatatan/{id}', 'SSMTatatertibController@destroyCatatan')
               ->name('ssmtatatertib.ssmrequest.destroyCatatan')
               ->where('id', '[0-9]+');      

          Route::post('/checkIcNo', 'SSMTatatertibController@checkIcNo')
               ->name('ssmtatatertib.ssmrequest.checkIcNo');
     });

//PPS Visitor Dashboard
Route::get('/ppsvisitor', 'PPSReportController@ppsvisitor')->name ('ppsvisitor')->middleware('verified');

//PPS Public Report
Route::get('/PusatPerkhidmatanSetempatReport', 'PPSPublicController@publicgraph')
               ->name('pps.pps.public');

Route::get('/PusatPerkhidmatanSetempat', 'PPSPublicController@showLockPage')
               ->name('pps.pps.showLockPage');

Route::post('/PusatPerkhidmatanSetempatLogin', 'PPSPublicController@publicgraphpost')
               ->name('pps.pps.post');

// JawatanKosngReport 14/08/2023 @Ekma

Route::get('/jawatankosongreport', 'JawatanKosongReportController@jawatankosongreport')->name ('jawatankosongreport')->middleware('verified');


//PPS Visitor Page
Route::group(
     [
          'prefix' => 'pps'],
          
          function () {
               Route::get('/', 'PPSVisitorController@index')
               ->name('pps.pps.index')
               ->middleware('checkRole:ROLE_SUPERADMIN');

               
               Route::get('/{pps}/editpps', 'PPSVisitorController@editpps')
               ->name('pps.pps.editpps')
               ->where('id', '[0-9]+')
               ->middleware('checkRole:ROLE_SUPERADMIN');

           
               Route::get('/addpps/{counter}', 'PPSVisitorController@addpps')
               ->name('pps.pps.addpps')
               ->middleware('checkRole:ROLE_SUPERADMIN');

 
               Route::post('/storepps', 'PPSVisitorController@storepps')
               ->name('pps.pps.storepps')
               ->middleware('checkRole:ROLE_SUPERADMIN');


               // Define the updatepps route
               Route::post('/updatepps', 'PPSVisitorController@updatepps')
               ->name('pps.pps.updatepps')
               ->middleware('checkRole:ROLE_SUPERADMIN');

 });

Route::get('/feedbackOSC', function () {
     return view('feedbacks');
});

//Feedback Page
Route::group(
     [
     'prefix' => 'feedbacks',
     ], function () {
          
          // Route::get('/', 'FeedbackController@index')
          //     ->name('feedbacks.feedback.index');

          Route::get('/indexadmin', 'FeedbackController@indexadmin')
          ->name('feedbacks.feedback.indexadmin')
          ->middleware('checkRole:ROLE_SUPERADMIN|ROLE_FEEDBACKS');


          Route::get('/{fb}/showadmin', 'FeedbackController@showadmin')
          ->name('feedbacks.feedback.showadmin')
          ->where('id', '[0-9]+');

          
               

          // Route::get('/fb', 'FeedbackController@fb')
          //     ->name('feedbacks.feedback.fb');


          Route::post('/store', 'FeedbackController@store')
          ->name('feedbacks.feedback.store');  
     
     });

     Route::get('/pdt', 'BorangController@isiborang')
     ->name('isiborang');
     
     //Borang Page
     Route::group(
          [
               'prefix' => 'borang',
          ], function () {
     
               Route::get('/indexadmin', 'BorangController@indexadmin')
                    ->name('borang.borangs.indexadmin')
                    ->middleware('checkRole:ROLE_SUPERADMIN');

     
               Route::post('/store', 'BorangController@store')
                    ->name('borang.borangs.store');
     
               Route::get('/{borang}/showadmin', 'BorangController@showadmin')
                    ->name('borang.borangs.showadmin')
                    ->where('id', '[0-9]+');
          
               
          });

   // DEVOPS REQUEST

     Route::controller(DevopsRequestController::class)->group(function() {
          Route::get('/devops-request/indexadmin', 'DevopsRequestController@indexadmin')->name('devops-request.indexadmin');
          Route::get('/drf', 'DevopsRequestController@create')->name('devops-request.addrequest');
          Route::post('/devops-request/store', 'DevopsRequestController@store')->name('devops-request.store');
          Route::get('/devops-request/download-template', 'DevopsRequestController@downloadTemplate')->name('devops-request.download-template');
          Route::get('/devops-request/{devopsRequest}/editadmin', 'DevopsRequestController@editadmin')->name('devops-request.editadmin');
          // Route::get('/devops-request/{devopsRequest}/document-download', 'DevopsRequestController@downloadDocument')->name('devops-request.document-download');
          Route::get('/devops-request/{drfDocument}/download-document', 'DevopsRequestController@downloadUploadedFile')->name('devops-request.uploadedfile-download');

          Route::post('/devops-request/{devopsRequest}/updateadmin', 'DevopsRequestController@updateadmin')->name('devops-request.updateadmin');
     });

     Route::controller(DevopsAdminEmailController::class)->group(function() {
          Route::get('/devops-request/admin-emails', 'DevopsAdminEmailController@emailIndex')->name('devops-request.admin-emails');
          Route::post('/devops-request/store-emails', 'DevopsAdminEmailController@storeAdminEmail')->name('devops-request.store-emails');
          Route::delete('/devops-request/delete-email/{devopsAdminEmail}', 'DevopsAdminEmailController@destroyEmail')->name('devops-request.delete-emails');
     });

     Route::post('/devops-request/{drfRemark}/delete', 'DrfRemarkController@destroy')->name('devops-request.delete-remark');
     
     // DEVOPS REQUEST END

          //NEW UMMI 22/08/2025

          // Custom route for /dsd
          Route::get('/dsd', [SupportCenterController::class, 'create'])->name('support-center.create');

          Route::prefix('support-center')->name('support-center.')->group(function () {
              // Requests
              Route::get('', [SupportCenterController::class, 'index'])->name('index');           // list
             
              Route::post('', [SupportCenterController::class, 'store'])->name('store');          // save
              Route::get('{id}/edit', [SupportCenterController::class, 'edit'])
                  ->whereNumber('id')->name('edit');                                              // admin edit
              Route::match(['put','patch'], '{id}', [SupportCenterController::class, 'update'])
                  ->whereNumber('id')->name('update');                                            // update status
          
              // Attachments
              Route::get('attachments/{id}/download', [SupportCenterController::class, 'downloadDocument'])
                  ->whereNumber('id')->name('attachments.download');
          
              // Remarks
              Route::delete('remarks/{id}', [SupportCenterController::class, 'deleteRemark'])
                  ->whereNumber('id')->name('remarks.delete');
          
              // Admin Emails
              Route::get('admin-emails', [SupportCenterController::class, 'adminEmails'])
                  ->name('admin-emails.index');
              Route::post('admin-emails', [SupportCenterController::class, 'storeAdminEmails'])
                  ->name('admin-emails.store');
              Route::delete('admin-emails/{adminEmail}', [SupportCenterController::class, 'deleteAdminEmail'])
                  ->whereNumber('adminEmail')->name('admin-emails.delete');
          });
          
//GenAI
use App\Http\Controllers\GenAIController;

// Public QR path (exact file name; DO NOT put the real PDF in /public)
Route::get('/GenAIGuidanceforEducationHandbook(English).pdf', [GenAIController::class, 'handle'])
    ->name('genai.handle');

// Dashboard + stats
Route::get('/genai_report', [GenAIController::class, 'report'])->name('genai.report');
Route::get('/genai_stats',  [GenAIController::class, 'stats'])->name('genai.stats');
Route::get('/genai/public', [GenAIController::class, 'publicProxy'])->name('genai.public');



          
           // e-minit

           Route::get('/adminsettings/adminsettingsdashboard', 'AdminSettingsController@adminsettingsdashboard')
           ->name('adminsettings.adminsettingsdashboard');

           Route::get('/adminsettings/editjenis', 'AdminSettingsController@editjenis')
           ->name('adminsettings.editjenis');

           Route::post('/adminsettings/store1', 'AdminSettingsController@store1')
           ->name('adminsettings.store1');

           Route::delete('/adminsettings/jenis/{id}', 'AdminSettingsController@destroyeditjenis')
           ->name('adminsettings.destroyeditjenis')
           ->where('id', '[0-9]+');

           Route::get('/adminsettings/editjenistindakan', 'AdminSettingsController@editjenistindakan')
           ->name('adminsettings.editjenistindakan');

           Route::post('/adminsettings/store2', 'AdminSettingsController@store2')
           ->name('adminsettings.store2');

           Route::delete('/adminsettings/jenistindakan/{id}', 'AdminSettingsController@destroyeditjenistindakan')
           ->name('adminsettings.destroyeditjenistindakan')
           ->where('id', '[0-9]+');

           Route::get('/adminsettings/edittindakandiperlukan', 'AdminSettingsController@edittindakandiperlukan')
           ->name('adminsettings.edittindakandiperlukan');

           Route::post('/adminsettings/store3', 'AdminSettingsController@store3')
           ->name('adminsettings.store3');

           Route::delete('/adminsettings/tindakandiperlukan/{id}', 'AdminSettingsController@destroyedittindakandiperlukan')
           ->name('adminsettings.destroyedittindakandiperlukan')
           ->where('id', '[0-9]+');

           Route::get('/adminsettings/edituntukperhatian', 'AdminSettingsController@edituntukperhatian')
           ->name('adminsettings.edituntukperhatian');

           Route::post('/adminsettings/store4', 'AdminSettingsController@store4')
           ->name('adminsettings.store4');

           Route::delete('/adminsettings/edituntukperhatian/{id}', 'AdminSettingsController@destroyedituntukperhatian')
           ->name('adminsettings.destroyedituntukperhatian')
           ->where('id', '[0-9]+');

          //  adminpushnnotification
          Route::delete('/adminsettings/adminnotificationpush/{id}', 'AdminSettingsController@destroyadminnotificationpush')
          ->name('adminsettings.destroyadminnotificationpush')
          ->where('id', '[0-9]+');

          Route::get('/adminsettings/adminnotificationpush', 'AdminSettingsController@adminnotificationpush')
          ->name('adminsettings.adminnotificationpush');

          Route::post('/adminsettings/storeadminnotificationpush', 'AdminSettingsController@storeadminnotificationpush')
          ->name('adminsettings.storeadminnotificationpush');

           // web.php
               Route::get('/ememo/view/{filename}', [EminitController::class, 'viewDocument'])->name('ememo.view');

               Route::get('/eminit/file/{filename}', [EminitController::class, 'viewFile'])
               ->name('eminit.view.file');

               Route::get('/eminit/tindakan/{filename}', [EminitController::class, 'viewTindakanFile'])->name('eminit.view.tindakan');
              

           Route::group(
                [
                     'prefix' => 'e-minit',
                ],
                function () {

                     Route::get('/', 'EminitController@indexeminit')
                          ->name('eminit.eminit.indexeminit');

                     Route::get('/indexeminitadmin', 'EminitController@indexeminitadmin')
                          ->name('eminit.eminit.indexeminitadmin');

                     Route::get('/indexeminitaction', 'EminitController@indexeminitaction')
                          ->name('eminit.eminit.indexeminitaction');

                
                     Route::get('/createeminit', 'EminitController@createeminit')
                          ->name('eminit.eminit.createeminit');

                     Route::get('/{eminit}/editeminit', 'EminitController@editeminit')
                          ->name('eminit.eminit.editeminit')
                          ->where('id', '[0-9]+');

                     Route::get('/{eminit}/editeminitadmin', 'EminitController@editeminitadmin')
                          ->name('eminit.eminit.editeminitadmin')
                          ->where('id', '[0-9]+');
                          
                     Route::get('/{eminitaction}/editeminitaction', 'EminitController@editeminitaction')
                     ->name('eminit.eminit.editeminitaction')
                     ->where('id', '[0-9]+');

                     Route::put('/{eminitaction}/updateeminitaction', 'EminitController@updateeminitaction')
                     ->name('eminit.eminit.updateeminitaction')
                     ->where('id', '[0-9]+');



                     Route::post('/storeeminit', 'EminitController@storeeminit')
                          ->name('eminit.eminit.storeeminit');

                     Route::put('/{eminit}/updateeminit', 'EminitController@updateeminit')
                          ->name('eminit.eminit.updateeminit');

                     Route::put('/{eminit}/updateadmin', [EminitController::class, 'updateadmin'])->name('updateadmin')
                          ->where('id', '[0-9]+');

                     Route::post('/storeeminitadmin', 'EminitController@storeeminitadmin')
                          ->name('eminit.eminit.storeeminitadmin');

                     Route::put('/{eminit}/updateeminitadmin', 'EminitController@updateeminitadmin')
                          ->name('eminit.eminit.updateeminitadmin');

                     Route::delete('/{eminit}/destroy', 'EminitController@destroy')
                          ->name('eminit.eminit.destroy')
                          ->where('id', '[0-9]+');

                   

                     Route::post('/storeeminitaction', 'EminitController@storeeminitaction')
                          ->name('eminit.eminit.storeeminitaction');

                     Route::get('/{eminit}/vieweminitadmin', 'EminitController@vieweminitadmin')
                          ->name('eminit.eminit.vieweminitadmin')
                          ->where('id', '[0-9]+');

                     Route::get('/{eminit}/vieweminitaction', 'EminitController@vieweminitaction')
                          ->name('eminit.eminit.vieweminitaction')
                          ->where('id', '[0-9]+');

                
                }

           );
           
 // end e-minit


Route::group(
     [
          'prefix' => 'dispatchs',
     ],
     function () {

          Route::get('/', 'DispatchController@index')
               ->name('dispatchs.dis.index');

          Route::get('/indexadmin', 'DispatchController@indexadmin')
               ->name('dispatchs.dis.indexadmin');

          Route::get('/indexup', 'DispatchController@indexup')
               ->name('dispatchs.dis.indexup');

          Route::get('/indextindakan', 'DispatchController@indextindakan')
               ->name('dispatchs.dis.indextindakan');

     Route::get('/indexcorrespondence', 'DispatchController@indexcorrespondence')
     ->name('dispatchs.dis.indexcorrespondence');

          Route::get('/dispatchs/{dis}/terima', 'DispatchController@terima')->name('dispatchs.dis.terima');
          Route::get('/dispatchs/{dis}/terimaup', 'DispatchController@terimaup')->name('dispatchs.dis.terimaup');
          Route::get('/dispatchs/{dis}/terimamemo', 'DispatchController@terimamemo')->name('dispatchs.dis.terimamemo');
          Route::get('/dispatchs/{dis}/terimamemo1', 'DispatchController@terimamemo1')->name('dispatchs.dis.terimamemo1');


          Route::get('/create', 'DispatchController@create')
               ->name('dispatchs.dis.create');


          Route::get('/createmec', 'DispatchController@createmec')
               ->name('dispatchs.dis.createmec');

          Route::post('/store', 'DispatchController@store')
               ->name('dispatchs.dis.store');


          Route::post('/store2', 'DispatchController@store2')
               ->name('dispatchs.dis.store2');


          Route::post('/storemec', 'DispatchController@storemec')
               ->name('dispatchs.dis.storemec');

     Route::post('/storeuntukperhatian', 'DispatchController@storeuntukperhatian')->name(
          'dispatchs.dis.storeuntukperhatian'
     );


          Route::get('/{dis}/edit', 'DispatchController@edit')
               ->name('dispatchs.dis.edit')
               ->where('id', '[0-9]+');

               Route::get('/{dis}/editcorrespondence', 'DispatchController@editcorrespondence')
               ->name('dispatchs.dis.editcorrespondence')
               ->where('id', '[0-9]+');


          Route::get('/editadmin/{dis}', 'DispatchController@editadmin')
               ->name('dispatchs.dis.editadmin')
               ->where('id', '[0-9]+');

          Route::get('/editflowmec/{dis}', 'DispatchController@editflowmec')
          ->name('dispatchs.dis.editflowmec')
          ->where('id', '[0-9]+');

          Route::get('/editflowcorrespondence/{dis}', 'DispatchController@editflowcorrespondence')
          ->name('dispatchs.dis.editflowcorrespondence')
          ->where('id', '[0-9]+');

          Route::post('/updateflowmec', 'DispatchController@updateflowmec')
               ->name('dispatchs.dis.updateflowmec')
               ->where('id', '[0-9]+');

          Route::post('/{dis}/update', 'DispatchController@update')
               ->name('dispatchs.dis.update')
               ->where('id', '[0-9]+');

          Route::post('/updateadmin', 'DispatchController@updateadmin')
               ->name('dispatchs.dis.updateadmin')
               ->where('id', '[0-9]+');


          Route::post('/{dis}/updatecorrespondence', 'DispatchController@updatecorrespondence')
          ->name('dispatchs.dis.updatecorrespondence')
          ->where('id', '[0-9]+');


          Route::post('/updatetindakan', 'DispatchController@updatetindakan')
               ->name('dispatchs.dis.updatetindakan')
               ->where('id', '[0-9]+');

          Route::get('/{dis}/edittindakan', 'DispatchController@edittindakan')
               ->name('dispatchs.dis.edittindakan')
               ->where('id', '[0-9]+');

          Route::get('/pegawaiT', 'DispatchController@pegawaiT')
               ->name('dispatchs.dis.pegawaiT');

          Route::get('/kakitangan', 'DispatchController@kakitangan')
               ->name('dispatchs.dis.kakitangan');


          Route::get('/{dis}/show', 'DispatchController@show')
               ->name('dispatchs.dis.show')
               ->where('id', '[0-9]+');


          Route::get('/{dis}/showadmin', 'DispatchController@showadmin')
               ->name('dispatchs.dis.showadmin')
               ->where('id', '[0-9]+');

          Route::get('/{dis}/showtindakan', 'DispatchController@showtindakan')
               ->name('dispatchs.dis.showtindakan')
               ->where('id', '[0-9]+');


          Route::get('/{dis}/showcorrespondence', 'DispatchController@showcorrespondence')
          ->name('dispatchs.dis.showcorrespondence')
          ->where('id', '[0-9]+');



          Route::delete('/dispatchindex/{dis}', 'DispatchController@destroy')
               ->name('dispatchs.dis.destroy')
               ->where('id', '[0-9]+');

          Route::delete('/dispatchindexadmin/{dis}', 'DispatchController@destroyadmin')
               ->name('dispatchs.dis.destroyadmin')
               ->where('id', '[0-9]+');

          Route::delete('/dispatchindextindakan/{dis}', 'DispatchController@destroytindakan')
               ->name('dispatchs.dis.destroytindakan')
               ->where('id', '[0-9]+');

          Route::delete('/dispatchindexcorrespondence/{dis}', 'DispatchController@destroycorrespondence')
          ->name('dispatchs.dis.destroycorrespondence')
          ->where('id', '[0-9]+');

          Route::get('/dispatchfileadmin', 'DispatchController@destroyfile')
               ->name('dispatchs.dis.destroyfile')
               ->where('id', '[0-9]+');

          Route::delete('/dispatchmecuser/{dis}', 'DispatchController@destroymecuser')
               ->name('dispatchs.dis.destroymecuser')
               ->where('id', '[0-9]+');


          Route::get('/createmec', 'DispatchController@createmec')
               ->name('dispatchs.dis.createmec');

          Route::get('/mecuser', 'DispatchController@mecuser')
               ->name('dispatchs.dis.mecuser');

               Route::get('/untukperhatian', 'DispatchController@untukperhatian')->name(
          'dispatchs.dis.untukperhatian'
     );




          Route::delete(
               '/dispatchuntukperhatian/{dis}',
               'DispatchController@destroyuntukperhatian'
          )
               ->name('dispatchs.dis.destroyuntukperhatian')
               ->where('id', '[0-9]+');
     }



);

Route::group(
[
     'prefix' => 'competency',
],
function () {
     Route::get(
          '/supervisorcompetency',
          'CompetencyController@supervisorcompetency'
     )->name('competency.competency.supervisorcompetency');

     Route::get(
          '/createindividualcompetency',
          'CompetencyController@createindividualcompetency'
     )->name('competency.competency.createindividualcompetency');

     Route::get('/HRDListCompetency', 'CompetencyController@HRDListCompetency')
     ->name('competency.competency.HRDListCompetency');

     Route::get('/{com}/HRDViewIndividual', 'CompetencyController@HRDViewIndividual')
          ->name('competencies.competencie.HRDViewIndividual')
          ->where('id', '[0-9]+');        

     Route::get('/HRDDashboard', 'CompetencyController@HRDDashboard')
     ->name('competency.competency.HRDDashboard');

     Route::get(
          '/indexadmincompetency',
          'CompetencyController@indexadmincompetency'
     )->name('competency.competency.indexadmincompetency');

     Route::get(
          '/indexcompetency',
          'CompetencyController@indexcompetency'
     )->name('competency.competency.indexcompetency');

     Route::get(
          '/indexsupervisorcompetency',
          'CompetencyController@indexsupervisorcompetency'
     )->name('competency.competency.indexsupervisorcompetency');

     Route::get('/{com}/editcompetencysearch', 'CompetencyController@search')
          ->name('competency.competency.editcompetencysearch')
          ->where('id', '[0-9]+');

     Route::get(
          '/{com}/editcompetency',
          'CompetencyController@editcompetency'
     )
          ->name('competencies.competencie.editcompetency')
          ->where('id', '[0-9]+');

     Route::post(
          '/updatecompetency',
          'CompetencyController@updatecompetency'
     )
          ->name('competency.competency.updatecompetency')
          ->where('id', '[0-9]+');

     Route::post(
          '/updateadmincompetency',
          'CompetencyController@updateadmincompetency'
     )
          ->name('competency.competency.updateadmincompetency')
          ->where('id', '[0-9]+');

     Route::post(
          '/updatesupervisorcompetency',
          'CompetencyController@updatesupervisorcompetency')
          ->name('competency.competency.updatesupervisorcompetency')
          ->where('id', '[0-9]+');


          Route::post(
               '/updatereassessmentcompetency',
               'CompetencyController@updatereassessmentcompetency')
               ->name('competency.competency.updatereassessmentcompetency')
               ->where('id', '[0-9]+');

          Route::get('/{com}/supportdocument','CompetencyController@supportdocument')
          ->name('competencies.competencie.supportdocument')
          ->where('id', '[0-9]+');

          Route::get('/{com}/supportdocumentsupv','CompetencyController@supportdocumentsupv')
          ->name('competencies.competencie.supportdocumentsupv')
          ->where('id', '[0-9]+');

          Route::post('/supportdocumentstore', 'CompetencyController@supportdocumentstore')->name(
               'competencies.competencie.supportdocumentstore'
          );

     

     Route::post('/admincompetencystore','CompetencyController@admincompetencystore')
     ->name('competencies.competencie.admincompetencystore');

     Route::get(
          '/{com}/editadmincompetency',
          'CompetencyController@editadmincompetency'
     )
          ->name('competencies.competencie.editadmincompetency')
          ->where('id', '[0-9]+');

     Route::get(
          '/{com}/editsupervisorcompetency',
          'CompetencyController@editsupervisorcompetency'
     )
          ->name('competencies.competencie.editsupervisorcompetency')
          ->where('id', '[0-9]+');


          Route::get(
               '/{com}/editreassessmentcompetency',
               'CompetencyController@editreassessmentcompetency'
          )
               ->name('competencies.competencie.editreassessmentcompetency')
               ->where('id', '[0-9]+');


     Route::get('/{com}/collabratorcompetency','CompetencyController@collabrator')
          ->name('competencies.competencie.collabrator')
          ->where('id', '[0-9]+');

          Route::get('/{com}/individualchart', 'CompetencyController@individualchart')
          ->name('competencies.competencie.individualchart')
          ->where('id', '[0-9]+');

     Route::delete(
          '/deletecompetency/{com}',
          'CompetencyController@destroycompetency'
     )
          ->name('competencies.competencie.destroycompetency')
          ->where('id', '[0-9]+');

     Route::delete('/deleteadmincompetency/{com}','CompetencyController@destroyadmincompetency')
          ->name('competencies.competencie.destroyadmincompetency')
          ->where('id', '[0-9]+');

     Route::delete('/deletesupervisorcompetency/{com}','CompetencyController@destroysupervisorcompetency')
          ->name('competencies.competencie.destroysupervisorcompetency')
          ->where('id', '[0-9]+');

          Route::get('/deletecompetencyfile/{com}','CompetencyController@destroycompetencyfile')
          ->name('competency.competency.destroycompetencyfile')
          ->where('id', '[0-9]+');


     Route::get('/deletecompetencycompdahrd/{com}','CompetencyController@destroycompdahrd')
               ->name('competency.competency.destroycompdahrd')
               ->where('id', '[0-9]+');

     Route::get('/deletecompetencycompdaot/{com}','CompetencyController@destroycompdaot')
               ->name('competency.competency.destroycompdaot')
               ->where('id', '[0-9]+');

     Route::get('/deletecompetencycompdahrm/{com}','CompetencyController@destroycompdahrm')
               ->name('competency.competency.destroycompdahrm')
               ->where('id', '[0-9]+');

     Route::get('/deletecompetencycompdafinmaw/{com}','CompetencyController@destroycompdafinmaw')
               ->name('competency.competency.destroycompdafinmaw')
               ->where('id', '[0-9]+');

     Route::get('/deletecompetencycompdafsm/{com}','CompetencyController@destroycompdafsm')
               ->name('competency.competency.destroycompdafsm')
               ->where('id', '[0-9]+');

     Route::get('/deletecompetencycompdaresearch/{com}','CompetencyController@destroycompdaresearch')
               ->name('competency.competency.destroycompdaresearch')
               ->where('id', '[0-9]+');

     Route::get('/deletecompetencycompdafinam/{com}','CompetencyController@destroycompdafinam')
               ->name('competency.competency.destroycompdafinam')
               ->where('id', '[0-9]+');

     Route::get('/deletecompetencycompdahse/{com}','CompetencyController@destroycompdahse')
               ->name('competency.competency.destroycompdahse')
               ->where('id', '[0-9]+');

     Route::get('/deletecompetencycompdafinhse/{com}','CompetencyController@destroycompdafinhse')
               ->name('competency.competency.destroycompdafinhse')
               ->where('id', '[0-9]+');


     Route::get('/deletecompetencycompdahseak/{com}','CompetencyController@destroycompdahseak')
               ->name('competency.competency.destroycompdahseak')
               ->where('id', '[0-9]+');

     Route::get('/deletecompetencycompdafinak/{com}','CompetencyController@destroycompdafinak')
               ->name('competency.competency.destroycompdafinak')
               ->where('id', '[0-9]+');

     Route::get('/deletecompetencycompdatrans/{com}','CompetencyController@destroycompdatrans')
               ->name('competency.competency.destroycompdatrans')
               ->where('id', '[0-9]+');



               Route::get('/deletecompetencycompjpkhassecc/{com}','CompetencyController@destroycompjpkhassecc')
               ->name('competency.competency.destroycompjpkhassecc')
               ->where('id', '[0-9]+');
               
     Route::get('/deletecompetencycompjpkhassefc/{com}','CompetencyController@destroycompjpkhassefc')
               ->name('competency.competency.destroycompjpkhassefc')
               ->where('id', '[0-9]+');                 

     Route::get('/deletecompetencycompjpkhasqa/{com}','CompetencyController@destroycompjpkhasqa')
               ->name('competency.competency.destroycompjpkhasqa')
               ->where('id', '[0-9]+');                 

     Route::get('/deletecompetencycompccdpr/{com}','CompetencyController@destroycompccdpr')
               ->name('competency.competency.destroycompccdpr')
               ->where('id', '[0-9]+');                 

     Route::get('/deletecompetencycompdictitin/{com}','CompetencyController@compdictitin')
               ->name('competency.competency.destroycompdictitin')
               ->where('id', '[0-9]+');                 

     Route::get('/deletecompetencycompdictitsm/{com}','CompetencyController@compdictitsm')
               ->name('competency.competency.destroycompdictitsm')
               ->where('id', '[0-9]+');                 

     Route::get('/deletecompetencycompdictito/{com}','CompetencyController@compdictito')
               ->name('competency.competency.destroycompdictito')
               ->where('id', '[0-9]+');                 

     Route::get('/deletecompetencycompdictits/{com}','CompetencyController@compdictits')
               ->name('competency.competency.destroycompdictits')
               ->where('id', '[0-9]+');                 

     Route::get('/deletecompetencycompmkpkqa/{com}','CompetencyController@compmkpkqa')
               ->name('competency.competency.destroycompmkpkqa')
               ->where('id', '[0-9]+');                 

     Route::get('/deletecompetencycompmkpkcsm/{com}','CompetencyController@compmkpkcsm')
               ->name('competency.competency.destroycompmkpkcsm')
               ->where('id', '[0-9]+');                 

     Route::get('/deletecompetencycompmkpkdm/{com}','CompetencyController@compmkpkdm')
               ->name('competency.competency.destroycompmkpkdm')
               ->where('id', '[0-9]+');                 

     Route::get('/deletecompetencycompmkpkhr/{com}','CompetencyController@compmkpkhr')
               ->name('competency.competency.destroycompmkpkhr')
               ->where('id', '[0-9]+');                 

     Route::get('/deletecompetencycompmkpkas/{com}','CompetencyController@compmkpkas')
               ->name('competency.competency.destroycompmkpkas')
               ->where('id', '[0-9]+');                 

     Route::get('/deletecompetencycompjppee/{com}','CompetencyController@compjppee')
               ->name('competency.competency.destroycompjppee')
               ->where('id', '[0-9]+');                 

     Route::get('/deletecompetencycompjppeem/{com}','CompetencyController@compjppeem')
               ->name('competency.competency.destroycompjppeem')
               ->where('id', '[0-9]+');                 

     Route::get('/deletecompetencycompjppefmmaw/{com}','CompetencyController@compjppefmmaw')
               ->name('competency.competency.destroycompjppefmmaw')
               ->where('id', '[0-9]+');                 

     Route::get('/deletecompetencycompjppehrda/{com}','CompetencyController@compjppehrda')
               ->name('competency.competency.destroycompjppehrda')
               ->where('id', '[0-9]+');                 


     Route::get('/adminIndividualcompetency', 'CompetencyController@adminIndividualcompetency')
     ->name('competency.competency.adminIndividualcompetency');

     Route::get(
          '/adminIndividualcompetencysearchIC',
          'CompetencyController@adminsearchIC'
     )->name('competency.competency.adminindividualcompetencysearchIC');

     Route::get(
          '/{com}/collabratorcompetencysearchIC',
          'CompetencyController@collabratorsearchIC'
     )
          ->name('competency.competency.collabratorcompetencysearch')
          ->where('id', '[0-9]+');

     Route::post(
          '/collabratorcompetencystore',
          'CompetencyController@collabratorcompetencystore'
     )->name('competencies.competencie.collabratorcompetencystore');
}
);


Route::get('/verify', function () {
     return view('verify');
});

Route::get('/download', function () {
     return view('download.index');
});


Route::get('/', function () {
return view('welcome');
});

Route::get('/services', function() {
     return view('services');
});

Route::get('/terms', function() {
     return view('terms');
});

Route::get('/ssmtatacara', function() {
     return view('ssmtatacara');
});

// Route::get('/pingat', function() {
//      return view('pingat');
// });

// Route::get('/haji', function() {
//      return view('haji');
// });

// Route::get('/pingat2021', function() {
//      return view('pingat2021');
// });


Auth::routes();
Auth::routes(['verify' => true]);
Route::get('/home', 'HomeController@index')->name ('home')->middleware('verified');
Route::get('/homereport', 'HomeReportController@homereport')->name ('homereport')->middleware('verified');
Route::get('/artreport', 'ARTReportController@artreport')->name ('artreport')->middleware('verified');

Route::get('/dkreport', 'DatakehadiranreportController@dkreport')->name ('dkreport')->middleware('verified','checkRole:ROLE_SUPERADMIN');

Route::get('/servicesdashboard', 'ServicesDashboardController@servicesdashboard')->name ('servicesdashboard')->middleware('verified');
Route::get('/admindashboard', 'AdminDashboardController@admindashboard')->name ('admindashboard')->middleware('verified');
Route::get('/superadmindashboard', 'AdminDashboardController@superadmindashboard')->name ('superadmindashboard')->middleware('verified', 'checkRole:ROLE_SUPERADMIN');

Route::get('/JPKKreport', 'CCAReportController@ccareport')->name ('ccareport')->middleware('verified');
Route::get('/onsdashboard', 'OnsdashboardController@onsdashboard')->name ('onsdashboard')->middleware('verified');

//PDMS Start
Route::get('/pdmshome', 'HomeController@pdmsindex')->name ('pdmshome')->middleware('verified','checkRole:ROLE_SUPERADMIN|ROLE_PDMS_ADMIN|ROLE_PDMS_SERVICE|ROLE_PDMS_CUTI');
Route::get('/pdmsservicesdashboard', 'ServicesDashboardController@pdmsservicesdashboard')->name ('pdmsservicesdashboard')->middleware('verified');
//PDMS End


Route::post('/logout', 'Auth\LoginController@logout')->name('logout');
Route::get('/logout', 'Auth\LoginController@logout');

Route::get('verify/{id}', 'VerifyController@verify');


Route::group(['prefix'=>'profile',],function(){


     Route::get('/change-password','ProfileController@change_password')->name('change_password');
     Route::post('/update-password','ProfileController@update_password')->name('update_password');  
});




/**
Route::get('/send-mail', function () {

Mail::to('alhafiz.hamidi@moe.gov.bn')->send(new MailtrapExample());

return 'A message has been sent to Mailtrap!';

});
**/

Route::get('/changePassword','HomeController@showChangePasswordForm')->name('changePasswordForm');
Route::post('/changePassword','HomeController@changePassword')->name('changePassword');
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/admin', 'AdminController@index')->name('admin');
Route::get('/hod', 'HodController@index')->name('hod');
Route::get('/maw', 'MawController@index')->name('maw');
Route::get('/mawSecond', 'MawSecondController@index')->name('mawSecond');
Route::get('/da', 'DaController@index')->name('da');
Route::get('/endorser', 'EndorserController@index')->name('endorser');
Route::get('/mawendorser', 'MawEndorserController@index')->name('mawendorser');
Route::get('/claimant', 'ClaimantController@index')->name('claimant');

//Acting Page
Route::group(
     [
     'prefix' => 'actings',
     ], function () {
          
          Route::get('/', 'ActingController@index')
          ->name('actings.acting.index')
          ->middleware('checkRole:ROLE_SUPERADMIN|ROLE_ACT');
          

          Route::get('/p', 'ActingController@indexP')
          ->name('actings.acting.indexP');

          Route::get('/create', 'ActingController@create')
          ->name('actings.acting.create');

          Route::get('/search', 'ActingController@search')
          ->name('actings.acting.search');

          Route::get('/{act}/edit','ActingController@edit')
          ->name('actings.acting.edit')
          ->where('id', '[0-9]+');

          Route::get('/{act}/editP','ActingController@editP')
          ->name('actings.acting.editP')
          ->where('id', '[0-9]+');

          Route::post('/store', 'ActingController@store')
          ->name('actings.acting.store');

          Route::get('/searchIC', 'ActingController@searchIC')
          ->name('actings.acting.searchIC');

          Route::post('/update', 'ActingController@update')
          ->name('actings.acting.update') 
          ->where('id', '[0-9]+');

          Route::post('/updateP', 'ActingController@updateP')
          ->name('actings.acting.updateP') 
          ->where('id', '[0-9]+');

          Route::delete('/act/{act}','ActingController@destroy')
          ->name('actings.acting.destroy')
          ->where('id', '[0-9]+');

     
     });


     //Cutis Page
Route::group(
     [
     'prefix' => 'cutis',
     ], function () {
          
          Route::get('/', 'CutiController@index')
          ->name('cutis.cuti.index')
          ->middleware('checkRole:ROLE_SUPERADMIN|ROLE_CUTI');


          Route::get('/p', 'CutiController@indexP')
          ->name('cutis.cuti.indexP');

          Route::get('/create', 'CutiController@create')
          ->name('cutis.cuti.create')
          ->middleware('checkRole:ROLE_SUPERADMIN|ROLE_CUTI');


          Route::get('/search', 'CutiController@search')
          ->name('cutis.cuti.search')
          ->middleware('checkRole:ROLE_SUPERADMIN|ROLE_CUTI');


          Route::get('/{act}/edit','CutiController@edit')
          ->name('cutis.cuti.edit')
          ->where('id', '[0-9]+')
          ->middleware('checkRole:ROLE_SUPERADMIN|ROLE_CUTI');


          Route::get('/{act}/editP','CutiController@editP')
          ->name('cutis.cuti.editP')
          ->where('id', '[0-9]+');

          Route::post('/store', 'CutiController@store')
          ->name('cutis.cuti.store');

          Route::get('/searchIC', 'CutiController@searchIC')
          ->name('cutis.cuti.searchIC')
          ->middleware('checkRole:ROLE_SUPERADMIN|ROLE_CUTI');


          Route::post('/update', 'CutiController@update')
          ->name('cutis.cuti.update') 
          ->where('id', '[0-9]+')
          ->middleware('checkRole:ROLE_SUPERADMIN|ROLE_CUTI');


          Route::post('/updateP', 'CutiController@updateP')
          ->name('cutis.cuti.updateP') 
          ->where('id', '[0-9]+');

          Route::delete('/act/{act}','CutiController@destroy')
          ->name('cutis.cuti.destroy')
          ->where('id', '[0-9]+');

     
     });


//Bersara Page
Route::group(
     [
     'prefix' => 'bersaras',
     ], function () {
          
          Route::get('/', 'BersaraController@index')
          ->name('bersaras.bersara.index')
          ->middleware('checkRole:ROLE_SUPERADMIN|ROLE_BERSARA');


          Route::get('/p', 'BersaraController@indexP')
          ->name('bersaras.bersara.indexP');

          Route::get('/create', 'BersaraController@create')
          ->name('bersaras.bersara.create');

          Route::get('/search', 'BersaraController@search')
          ->name('bersaras.bersara.search');

          Route::get('/{act}/edit','BersaraController@edit')
          ->name('bersaras.bersara.edit')
          ->where('id', '[0-9]+')
          ->middleware('checkRole:ROLE_SUPERADMIN|ROLE_BERSARA');


          Route::get('/{act}/editP','BersaraController@editP')
          ->name('bersaras.bersara.editP')
          ->where('id', '[0-9]+');

          Route::post('/store', 'BersaraController@store')
          ->name('bersaras.bersara.store');

          Route::get('/searchIC', 'BersaraController@searchIC')
          ->name('bersaras.bersara.searchIC');

          Route::post('/update', 'BersaraController@update')
          ->name('bersaras.bersara.update') 
          ->where('id', '[0-9]+')
          ->middleware('checkRole:ROLE_SUPERADMIN|ROLE_BERSARA');


          Route::post('/updateP', 'BersaraController@updateP')
          ->name('bersaras.bersara.updateP') 
          ->where('id', '[0-9]+');

          Route::delete('/act/{act}','BersaraController@destroy')
          ->name('bersaras.bersara.destroy')
          ->where('id', '[0-9]+');

     
     });
     


// //ART Page
Route::group(
     [
     'prefix' => 'arts',
     ], function () {
          
     Route::get('/', 'ARTController@index')
          ->name('arts.art.index');

     Route::get('/all', 'ARTController@indexAll')
          ->name('arts.art.indexAll')
          ->middleware('checkRole:ROLE_SUPERADMIN|ROLE_ART_FOCAL');


     Route::get('/create', 'ARTController@create')
          ->name('arts.art.create');

     Route::get('/createAll', 'ARTController@createAll')
          ->name('arts.art.createAll')
          ->middleware('checkRole:ROLE_SUPERADMIN|ROLE_ART_FOCAL');


     Route::post('/store', 'ARTController@store')
          ->name('arts.art.store');

     Route::post('/storeAll', 'ARTController@storeAll')
          ->name('arts.art.storeAll');

     Route::post('/search', 'ARTController@search')
          ->name('arts.art.search')
          ->middleware('checkRole:ROLE_SUPERADMIN|ROLE_ART_FOCAL');


     Route::post('/searchDept', 'ARTController@searchDept')
          ->name('arts.art.searchDept')
          ->middleware('checkRole:ROLE_SUPERADMIN|ROLE_ART_FOCAL');


     Route::post('/searchDeptAdmin', 'ARTController@searchDeptAdmin')
           ->name('arts.art.searchDeptAdmin')
          ->middleware('checkRole:ROLE_SUPERADMIN|ROLE_ART_FOCAL');


     Route::post('/searchName', 'ARTController@searchName')
               ->name('arts.art.searchName')
          ->middleware('checkRole:ROLE_SUPERADMIN|ROLE_ART_FOCAL');


     Route::post('/searchICNo', 'ARTController@searchICNo')
               ->name('arts.art.searchICNo')
          ->middleware('checkRole:ROLE_SUPERADMIN|ROLE_ART_FOCAL');


     Route::post('/searchPlace', 'ARTController@searchPlace')
               ->name('arts.art.searchPlace');

     Route::post('/searchResult', 'ARTController@searchResult')
               ->name('arts.art.searchResult')
          ->middleware('checkRole:ROLE_SUPERADMIN|ROLE_ART_FOCAL');


     Route::post('/searchDate', 'ARTController@searchDate')
               ->name('arts.art.searchDate');

     Route::get('/{art}/edit','ARTController@edit')
          ->name('arts.art.edit')
          ->where('id', '[0-9]+');

     Route::get('/{art}/editAll','ARTController@editAll')
          ->name('arts.art.editAll')
          ->where('id', '[0-9]+')
          ->middleware('checkRole:ROLE_SUPERADMIN|ROLE_ART_FOCAL');


     Route::post('/update', 'ARTController@update')
          ->name('arts.art.update') 
          ->where('id', '[0-9]+');

     Route::post('/updateAll', 'ARTController@updateAll')
          ->name('arts.art.updateAll') 
          ->where('id', '[0-9]+')
          ->middleware('checkRole:ROLE_SUPERADMIN|ROLE_ART_FOCAL');


     Route::delete('/art/{art}','ARTController@destroy')
          ->name('arts.art.destroy')
          ->where('id', '[0-9]+');

     Route::delete('/artAll/{art}','ARTController@destroyAll')
          ->name('arts.art.destroyAll')
          ->where('id', '[0-9]+')
          ->middleware('checkRole:ROLE_SUPERADMIN|ROLE_ART_FOCAL');


     Route::get('/searchIC', 'ARTController@searchIC')
          ->name('arts.art.searchIC')
          ->middleware('checkRole:ROLE_SUPERADMIN|ROLE_ART_FOCAL');


     Route::get('/{art}/viewAll', 'ARTController@viewAll')
               ->name('arts.art.viewAll')
          ->middleware('checkRole:ROLE_SUPERADMIN|ROLE_ART_FOCAL');

               
          
          
     });

//Biodatas Page

Route::group(
          [
          'prefix' => 'biodatas',
          ], function () {
               
               Route::get('/', 'BiodatasController@index')
               ->name('biodatas.biodata.index');
                    
               Route::get('/show/{biodata}','BiodatasController@show')
               ->name('biodatas.biodata.show')
               ->where('id', '[0-9]+');
                    
               Route::get('/create','BiodatasController@create')
               ->name('biodatas.biodata.create');	
                    
               Route::post('/', 'BiodatasController@store')
               ->name('biodatas.biodata.store');
                    
               Route::get('/{biodata}/edit','BiodatasController@edit')
               ->name('biodatas.biodata.edit')
               ->where('id', '[0-9]+');

               Route::put('biodata/update/{ic_no}', 'BiodatasController@update')
               ->name('biodatas.biodata.update');
                    
               Route::delete('/biodata/{ic_no}','BiodatasController@destroy')
               ->name('biodatas.biodata.destroy')
               ->where('id', '[0-9]+');
               
          });
          




Route::group(
[
'prefix' => 'departments',
], function () {

Route::get('/', 'DepartmentsController@index')
     ->name('departments.department.index');

Route::get('/create','DepartmentsController@create')
     ->name('departments.department.create');

Route::get('/show/{department}','DepartmentsController@show')
     ->name('departments.department.show')
     ->where('id', '[0-9]+');

Route::get('/{department}/edit','DepartmentsController@edit')
     ->name('departments.department.edit')
     ->where('id', '[0-9]+');

Route::post('/', 'DepartmentsController@store')
     ->name('departments.department.store');
               
Route::put('department/{department}', 'DepartmentsController@update')
     ->name('departments.department.update')
     ->where('id', '[0-9]+');

Route::delete('/department/{department}','DepartmentsController@destroy')
     ->name('departments.department.destroy')
     ->where('id', '[0-9]+');

});

Route::group(
     [
     'prefix' => 'achievements',
     ], function () {	
               
          Route::post('/{id}', 'AchievementsController@store')
          ->name('achievements.achievement.store')
          ->where('id', '[0-9]+');
     });

Route::group(
     [
     'prefix' => 'performances',
     ], function () {	
               
          Route::post('/{id}', 'PerformancesController@store')
          ->name('performances.performance.store')
          ->where('id', '[0-9]+');
          
          Route::delete('/performance/{perf}','PerformancesController@destroy')
               ->name('performances.performance.destroy')
               ->where('id', '[0-9]+');
     });
     
     Route::group(
          [
               'prefix' => 'medals',
          ], function () {
          
               Route::post('/{id}', 'MedalsController@store')
                    ->name('medals.medal.store')
                    ->where('id', '[0-9]+');
               
               Route::delete('/medal/{medal}','MedalsController@destroy')
                    ->name('medals.medal.destroy')
                    ->where('id', '[0-9]+');
          });

Route::group(
     [
          'prefix' => 'certificates',
     ], function () {
               
          Route::post('/{id}', 'CertificatesController@store')
               ->name('certificates.certificate.store')
               ->where('id', '[0-9]+');

          Route::delete('/certificate/{cert}','CertificatesController@destroy')
               ->name('certificates.certificate.destroy')
               ->where('id', '[0-9]+');
          
          Route::post('/{id}', 'CertificatesController@update')
          ->name('certificates.certificate.update') 
          ->where('id', '[0-9]+');
          
     });

Route::group(
     [
          'prefix' => 'exams',
     ], function () {
               
          Route::post('/{id}', 'ExamsController@store')
               ->name('exams.exam.store')
               ->where('id', '[0-9]+');

          Route::delete('/exam/{exam}','ExamsController@destroy')
          ->name('exams.exam.destroy')
          ->where('id', '[0-9]+');

          Route::post('/{id}', 'ExamsController@update')
          ->name('exams.exam.update') 
          ->where('id', '[0-9]+');
          
     });

Route::group(
     [
          'prefix' => 'programmes',
     ], function () {
               
          Route::post('/{id}', 'ProgrammesController@store')
               ->name('programmes.programme.store')
               ->where('id', '[0-9]+');

          Route::delete('/programme/{prog}','ProgrammesController@destroy')
          ->name('programmes.programme.destroy')
          ->where('id', '[0-9]+');

          Route::post('/{id}', 'ProgrammesController@update')
          ->name('programmes.programme.update') 
          ->where('id', '[0-9]+');
          
     });

Route::group(
     [
          'prefix' => 'paperworks',
     ], function () {
               
          Route::post('/{id}', 'PaperworksController@store')
               ->name('paperworks.paperwork.store')
               ->where('id', '[0-9]+');
          
          Route::delete('/paperwork/{ppwork}','PaperworksController@destroy')
               ->name('paperworks.paperwork.destroy')
               ->where('id', '[0-9]+');

          Route::post('/{id}', 'PaperworksController@update')
               ->name('paperworks.paperwork.update') 
               ->where('id', '[0-9]+');
          
     });

Route::group(
     [
          'prefix' => 'courses',
     ], function () {
               
          Route::post('/{id}', 'CoursesController@store')
               ->name('courseworks.coursework.store')
               ->where('id', '[0-9]+');
          
          Route::delete('/coursework/{course}','CoursesController@destroy')
               ->name('courseworks.coursework.destroy')
               ->where('id', '[0-9]+');

          Route::post('/{id}', 'CoursesController@update')
               ->name('courseworks.coursework.update') 
               ->where('id', '[0-9]+');
          
     });

Route::group(
[
'prefix' => 'roles',
], function () {

Route::get('/', 'RolesController@index')
     ->name('roles.role.index');
     
Route::get('/create','RolesController@create')
     ->name('roles.role.create');

Route::get('/show/{role}','RolesController@show')
     ->name('roles.role.show')
     ->where('id', '[0-9]+');

Route::get('/{role}/edit','RolesController@edit')
     ->name('roles.role.edit')
     ->where('id', '[0-9]+');

Route::post('/', 'RolesController@store')
     ->name('roles.role.store');
               
Route::put('role/{role}', 'RolesController@update')
     ->name('roles.role.update')
     ->where('id', '[0-9]+');

Route::delete('/role/{role}','RolesController@destroy')
     ->name('roles.role.destroy')
     ->where('id', '[0-9]+');

     
});

Route::group(
[
'prefix' => 'role_users',
], function () {

Route::get('/', 'RoleUsersController@index')
     ->name('role_users.role_user.index');

//Zharif Add Role - 21/2/24
Route::get('/role', 'RoleUsersController@roleindex')
     ->name('role_users.role_user.roleindex');

Route::get('/role/edit/{id}', 'RoleUsersController@roleedit')
     ->name('role_users.role_user.roleedit')
     ->where('id', '[0-9]+');

Route::post('/role/store', 'RoleUsersController@rolestore')
     ->name('role_users.role_user.rolestore');

Route::post('/role/update', 'RoleUsersController@roleupdate')
     ->name('role_users.role_user.roleupdate');

Route::delete('/role/destroy/{id}','RoleUsersController@roledestroy')
     ->name('role_users.role_user.roledestroy')
     ->where('id', '[0-9]+');
//End

Route::get('/create','RoleUsersController@create')
     ->name('role_users.role_user.create');

Route::get('/show/{roleUser}','RoleUsersController@show')
     ->name('role_users.role_user.show')
     ->where('id', '[0-9]+');

Route::get('/{newroles}/editformredesign','RoleUsersController@edit')
     ->name('role_users.role_user.formredesign')
     ->where('id', '[0-9]+')
     ->middleware('encryptDecryptId');

Route::post('/', 'RoleUsersController@store')
     ->name('role_users.role_user.store');
               
Route::put('role_user/{User}', 'RoleUsersController@update')
     ->name('role_users.role_user.update')
     ->where('id', '[0-9]+');
     
     Route::post('/updatenew', 'RoleUsersController@updatenew')   
     ->name('role_users.role_user.updatenew')
     ->where('id', '[0-9]+');

Route::post('/role_user/{User}','RoleUsersController@destroy')
     ->name('role_users.role_user.destroy')
     ->where('id', '[0-9]+');

     Route::get('/search', 'RoleUsersController@search')
     ->name('role_users.role_user.search');

     Route::get('/create2', 'RoleUsersController@create2')
     ->name('role_users.role_user.create2');


});

Route::group(
[
'prefix' => 'users',
], function () {

Route::get('/', 'UsersController@index')
     ->name('users.user.index')
     ->middleware('checkRole:ROLE_SUPERADMIN');
     

Route::get('/create','UsersController@create')
     ->name('users.user.create');

Route::get('/show/{user}','UsersController@show')
     ->name('users.user.show')
     ->where('id', '[0-9]+');

Route::get('/{user}/edit','UsersController@edit')
     ->name('users.user.edit')
     ->where('id', '[0-9]+');

Route::post('/', 'UsersController@store')
     ->name('users.user.store');
               
Route::put('user/{user}', 'UsersController@update')
     ->name('users.user.update')
     ->where('id', '[0-9]+');

Route::get('/users/{user}/approve', 'UsersController@approve')->name('users.user.approve');

// Route::get('/users/{user}/approvemt', 'UsersController@approvemeshteam')->name('users.user.approvemeshteam');

Route::get('/users/{user}/approvemt', 'UsersController@approvemt')->name('users.user.approvemt');

         Route::post('/approvemeshteam/{id}', 'UsersController@approvemeshteam')
                     ->name('users.user.approvemeshteam')
                     ->withoutMiddleware(['auth']);

Route::get('/users/{user}/reversereject', 'UsersController@reversereject')->name('users.user.reversereject');

Route::delete('/user/{user}','UsersController@destroy')
     ->name('users.user.destroy')
     ->where('id', '[0-9]+');

Route::get('/search', 'UsersController@search')
     ->name('users.user.search');

     Route::get('/user/email','UsersController@demail')
     ->name('users.user.email.demail');

     Route::post('/user/email', 'UsersController@demailstore')
     ->name('users.user.email.demailstore');

     Route::delete('/user/{adminEmail}/email','UsersController@demaildestroy')
     ->name('users.user.email.demaildestroy')
     ->whereNumber('adminEmail');
});

Route::group(
     [
     'prefix' => 'profileusers',
     ], function () {
     
     Route::get('/', 'ProfileusersController@index')
          ->name('profileusers.profileuser.index')
          ->middleware('checkRole:ROLE_SUPERADMIN');
          
     
     Route::get('/create','ProfileusersController@create')
          ->name('profileusers.profileuser.create');
     
     Route::get('/show/{user}','ProfileusersController@show')
          ->name('profileusers.profileuser.show')
          ->where('id', '[0-9]+');
     
     Route::get('/{user}/edit','ProfileusersController@edit')
          ->name('profileusers.profileuser.edit')
          ->where('id', '[0-9]+');
     
     Route::post('/', 'ProfileusersController@store')
          ->name('profileusers.profileuser.store');
                    
     Route::put('user/{user}', 'ProfileusersController@update')
          ->name('profileusers.profileuser.update')
          ->where('id', '[0-9]+');
     
     Route::delete('/user/{user}','ProfileusersController@destroy')
          ->name('profileusers.profileuser.destroy')
          ->where('id', '[0-9]+');
     
          
          Route::get('/search', 'ProfileusersController@search')
          ->name('profileusers.profileuser.search');
     
     });

Route::group(
[
'prefix' => 'units',
], function () {

Route::get('/', 'UnitsController@index')
     ->name('units.unit.index');

Route::get('/create','UnitsController@create')
     ->name('units.unit.create');

Route::get('/show/{unit}','UnitsController@show')
     ->name('units.unit.show')
     ->where('id', '[0-9]+');

Route::get('/{unit}/edit','UnitsController@edit')
     ->name('units.unit.edit')
     ->where('id', '[0-9]+');

Route::post('/', 'UnitsController@store')
     ->name('units.unit.store');
               
Route::put('unit/{unit}', 'UnitsController@update')
     ->name('units.unit.update')
     ->where('id', '[0-9]+');

Route::delete('/unit/{unit}','UnitsController@destroy')
     ->name('units.unit.destroy')
     ->where('id', '[0-9]+');

});




//SKB Page
Route::group(
     [
          'prefix' => 'skbs',
     ],
     function () {

          Route::get('/', 'QOController@index')
               ->name('skbs.skb.index');

          Route::get('/admin', 'QOController@indexadmin')
               ->name('skbs.skb.indexadmin');

          Route::get('/create', 'QOController@create')
               ->name('skbs.skb.create');

          Route::post('/store', 'QOController@store')
               ->name('skbs.skb.store');

          Route::delete('/skb/{art}', 'QOController@destroy')
               ->name('skbs.skb.destroy')
               ->where('id', '[0-9]+');

          Route::get('/{skb}/edit', 'QOController@edit')
               ->name('skbs.skb.edit')
               ->where('id', '[0-9]+');

          Route::get('/{skb}/editadmin', 'QOController@editadmin')
               ->name('skbs.skb.editadmin')
               ->where('id', '[0-9]+');

          Route::get('/{skb}/show', 'QOController@show')
               ->name('skbs.skb.show')
               ->where('id', '[0-9]+');

     Route::get('/1/verify', 'QOController@verify')
               ->name('skbs.skb.verify')
               ->where('id', '[0-9]+');

          Route::get('/{skb}/showadmin', 'QOController@showadmin')
               ->name('skbs.skb.showadmin')
               ->where('id', '[0-9]+');

          Route::post('/update', 'QOController@update')
               ->name('skbs.skb.update')
               ->where('id', '[0-9]+');

          Route::post('/updateadmin', 'QOController@updateadmin')
               ->name('skbs.skb.updateadmin')
               ->where('id', '[0-9]+');

          Route::get('/{skb}/downloadPDF', 'QOController@downloadPDF')
               ->name('skbs.skb.viewpdf')
               ->where('id', '[0-9]+');

          Route::get('/{skb}/downloadadminPDF', 'QOController@downloadadminPDF')
               ->name('skbs.skb.viewpdfadmin')
               ->where('id', '[0-9]+');
     }

);

//Perjawatans Page


//Perjawatans Page


Route::group(
     [
          'prefix' => 'perjawatan',
     ],
     function () {

          Route::get('/', 'PerjawatanController@index')
               ->name('perjawatan.perjawatan.index')
               ->middleware('checkRole:ROLE_SUPERADMIN|ROLE_PERJAWATAN');


          Route::get('/p', 'PerjawatanController@indexP')
               ->name('perjawatan.perjawatan.indexP');

          Route::get('/create', 'PerjawatanController@create')
               ->name('perjawatan.perjawatan.create');


          Route::get('/createdocs', 'PerjawatandocumentsController@create')
               ->name('perjawatan.perjawatan.createdocs');

          Route::get('/search', 'PerjawatanController@search')
               ->name('perjawatan.perjawatan.search');

          Route::get('/{id}/edit', 'PerjawatanController@edit')
               ->name('perjawatan.perjawatan.edit')
               ->where('id', '[0-9]+')
               ->middleware('checkRole:ROLE_SUPERADMIN|ROLE_PERJAWATAN');


          Route::get('/{act}/editP', 'PerjawatanController@editP')
               ->name('perjawatan.perjawatan.editP')
               ->where('id', '[0-9]+');

          Route::get('/{biodata}/show', 'PerjawatanController@show')
               ->name('perjawatan.perjawatan.show')
               ->where('id', '[0-9]+');

          Route::post('/store', 'PerjawatanController@store')
               ->name('perjawatan.perjawatan.store');

          Route::get('/searchIC', 'PerjawatanController@searchIC')
               ->name('perjawatan.perjawatan.searchIC');

          Route::post('/update', 'PerjawatanController@update')
               ->name('perjawatan.perjawatan.update')
               ->where('id', '[0-9]+');

          Route::post('/updateP', 'PerjawatanController@updateP')
               ->name('perjawatan.perjawatan.updateP')
               ->where('id', '[0-9]+');

          Route::delete('/perjawatan/{perjawatan}', 'PerjawatanController@destroy')
               ->name('perjawatan.perjawatan.destroy')
               ->where('id', '[0-9]+');
     }
);

Route::group(
     [
          'prefix' => 'documents',
     ],
     function () {



          // Route::get('/createdocs', 'PerjawatandocumentsController@create')
          //      ->name('documents.createdoc.create');


          Route::post('/{id}', 'PerjawatandocumentsController@store')
               ->name('documents.document.store')
               ->where('id', '[0-9]+');
     }




);

//SSM Page
Route::group(
     [
          'prefix' => 'ssms',
          
     ],
     function () {

          Route::get('/', 'SSMController@index')
               ->name('ssms.ssm.index');

          Route::get('/indexall', 'SSMController@indexall')
               ->name('ssms.ssm.indexall')
               ->middleware('checkRole:ROLE_SSM|ROLE_SUPERADMIN');

          Route::get('/show', 'SSMController@show')
               ->name('ssms.ssm.show');


          Route::get('/create', 'SSMController@create')
               ->name('ssms.ssm.create');

          Route::get('/{ssm}/editadmin', 'SSMController@editadmin')
               ->name('ssms.ssm.editadmin')
               ->where('id', '[0-9]+')
               ->middleware('checkRole:ROLE_SSM|ROLE_SUPERADMIN');

          Route::get('/{ssm}/edituser', 'SSMController@edituser')
               ->name('ssms.ssm.edituser')
               ->where('id', '[0-9]+')
               ->middleware('encryptDecryptId');
          
          // ---------------------------------------------------------------------------------
          // Staging @ Troubleshooting
          // ---------------------------------------------------------------------------------

          Route::get('/staging/{ssm}/edituser', 'StagingController@editUser')
               // ->name('ssms.ssm.edituser.staging')
               // ->where('id', '[0-9]+');
               ->middleware('encryptDecryptId');

          Route::get('/staging/create', 'StagingController@createUser');
               // ->name('ssms.ssm.create');

          Route::put('/staging/ssm/update', 'StagingController@update')
               ->name('ssms.ssm.update.staging');

          Route::post('/staging/ssm/updateuser', 'StagingController@updateuser')
               ->name('ssms.ssm.updateuser.staging')
               ->where('id', '[0-9]+');

          // ---------------------------------------------------------------------------------

           Route::get('/{ssm}/editoneuser', 'SSMController@editoneuser')
               ->name('ssms.ssm.editoneuser')
               ->where('id', '[0-9]+');

          Route::put('ssm/update', 'SSMController@update')
               ->name('ssms.ssm.update');

          Route::post('ssm/updateuser', 'SSMController@updateuser')
               ->name('ssms.ssm.updateuser')
               ->where('id', '[0-9]+');


          Route::post('/updateadmin', 'SSMController@updateadmin')
               ->name('ssms.ssm.updateadmin')
               ->where('id', '[0-9]+')
               ->middleware('checkRole:ROLE_SSM|ROLE_SUPERADMIN');


          Route::get('/{ssm}/showadmin', 'SSMController@showadmin')
               ->name('ssms.ssm.showadmin')
               ->where('id', '[0-9]+')
               ->middleware('checkRole:ROLE_SSM|ROLE_SUPERADMIN');

          Route::delete('/ssm/{ssm}', 'SSMController@destroy')
               ->name('ssms.ssm.destroy')
               ->where('id', '[0-9]+');


          Route::delete('/ssmAll/{ssm}', 'SSMController@destroy')
               ->name('ssms.ssm.destroyAll')
               ->where('id', '[0-9]+');


     }



);

//Permohonan Page
Route::group(
     [
          'prefix' => 'permohonans',
     ],
     function () {

          Route::get('/', 'PermohonanController@index')
               ->name('permohonans.permohonan.index');

          Route::get('/admin', 'PermohonanController@indexadmin')
               ->name('permohonans.permohonan.indexadmin');

          Route::get('/create', 'PermohonanController@create')
               ->name('permohonans.permohonan.create');

          Route::get('/{pjk}/show', 'PermohonanController@show')
               ->name('permohonans.permohonan.show')
               ->where('id', '[0-9]+');


          Route::get('/{pjk}/showadmin', 'PermohonanController@showadmin')
               ->name('permohonans.permohonan.showadmin')
               ->where('id', '[0-9]+');

          Route::post('/updateadmin', 'PermohonanController@updateadmin')
               ->name('permohonans.permohonan.updateadmin')
               ->where('id', '[0-9]+');

          Route::post('/store', 'PermohonanController@store')
               ->name('permohonans.permohonan.store');

          Route::delete('/permohonan/{pjk}', 'PermohonanController@destroy')
               ->name('permohonans.permohonan.destroy')
               ->where('id', '[0-9]+');

          Route::delete('/permohonanadmin/{pjk}', 'PermohonanController@destroyadmin')
               ->name('permohonans.permohonan.destroyadmin')
               ->where('id', '[0-9]+');

          Route::get('/{pjk}/edit', 'PermohonanController@edit')
               ->name('permohonans.permohonan.edit')
               ->where('id', '[0-9]+');

          Route::post('/update', 'PermohonanController@update')
               ->name('permohonans.permohonan.update')
               ->where('id', '[0-9]+');

          Route::get('/{pjk}/editadmin', 'PermohonanController@editadmin')
               ->name('permohonans.permohonan.editadmin')
               ->where('id', '[0-9]+');
     }

);

//CCA
Route::group(
     [
          'prefix' => 'cca',
     ],
     function () {

          Route::get('/', 'CCAController@index')
               ->name('cca.cca.index');

               Route::get('/all', 'CCAController@indexAll')
               ->name('cca.cca.indexAll')
               ->middleware('checkRole:ROLE_SUPERADMIN|ROLE_CCA_ADMIN|ROLE_CCA_FOCAL');


          Route::get('/admin', 'CCAController@indexadmin')
               ->name('cca.cca.indexadmin')
               ->middleware('checkRole:ROLE_SUPERADMIN|ROLE_CCA_ADMIN|ROLE_CCA_FOCAL');


          Route::get('/create', 'CCAController@create')
               ->name('cca.cca.create')
               ->middleware('checkRole:ROLE_SUPERADMIN|ROLE_CCA_ADMIN|ROLE_CCA_FOCAL');


          Route::get('/{cca}/show', 'CCAController@show')
               ->name('cca.cca.show')
               ->where('id', '[0-9]+');

          Route::get('/{cca}/dashboard', 'CCAController@dashboard')
               ->name('cca.cca.dashboard')
               ->where('id', '[0-9]+');

          Route::get('/{cca}/showadmin', 'CCAController@showadmin')
               ->name('cca.cca.showadmin')
               ->where('id', '[0-9]+')
               ->middleware('checkRole:ROLE_SUPERADMIN|ROLE_CCA_ADMIN|ROLE_CCA_FOCAL');


               Route::post('/update', 'CCAController@update')
               ->name('cca.cca.update')
               ->where('id', '[0-9]+');

          Route::post('/updateadmin', 'CCAController@updateadmin')
               ->name('cca.cca.updateadmin')
               ->where('id', '[0-9]+')
               ->middleware('checkRole:ROLE_SUPERADMIN|ROLE_CCA_ADMIN|ROLE_CCA_FOCAL');


               Route::post('/updateafocal', 'CCAController@updatefocal')
               ->name('cca.cca.updatefocal')
               ->where('id', '[0-9]+');


          Route::post('/store', 'CCAController@store')
               ->name('cca.cca.store');

          Route::delete('/cca/{cca}', 'CCAController@destroy')
               ->name('cca.cca.destroy')
               ->where('id', '[0-9]+');

          Route::delete('/ccaadmin/{cca}', 'CCAController@destroyadmin')
               ->name('cca.cca.destroyadmin')
               ->where('id', '[0-9]+')
               ->middleware('checkRole:ROLE_SUPERADMIN|ROLE_CCA_ADMIN|ROLE_CCA_FOCAL');


          Route::delete('/ccafocal/{cca}', 'CCAController@destroyfocal')
               ->name('cca.cca.destroyfocal')
               ->where('id', '[0-9]+')
               ->middleware('checkRole:ROLE_SUPERADMIN|ROLE_CCA_ADMIN|ROLE_CCA_FOCAL');



          Route::post('/senaraikelabcca/{cca}', 'CCAController@destroysenarai')
               ->name('cca.cca.destroysenarai')
               ->where('id', '[0-9]+');
               



          Route::post('/senaraikelabccaadmin/{cca}', 'CCAController@destroysenaraiadmin')
               ->name('cca.cca.destroysenaraiadmin')
               ->where('id', '[0-9]+')
               ->middleware('checkRole:ROLE_SUPERADMIN|ROLE_CCA_ADMIN|ROLE_CCA_FOCAL');



          Route::post('/senaraikelabccafocal/{cca}', 'CCAController@destroysenaraifocal')
               ->name('cca.cca.destroysenaraifocal')
               ->where('id', '[0-9]+');



          Route::get('/{cca}/edit', 'CCAController@edit')
               ->name('cca.cca.edit')
               ->where('id', '[0-9]+');

     

          Route::get('/{cca}/editadmin', 'CCAController@editadmin')
               ->name('cca.cca.editadmin')
               ->where('id', '[0-9]+')
               ->middleware('checkRole:ROLE_SUPERADMIN|ROLE_CCA_ADMIN|ROLE_CCA_FOCAL');


               
          Route::get('/{cca}/editfocal', 'CCAController@editfocal')
               ->name('cca.cca.editfocal')
               ->where('id', '[0-9]+')
               ->middleware('checkRole:ROLE_SUPERADMIN|ROLE_CCA_ADMIN|ROLE_CCA_FOCAL');


          Route::get('/tambahkelab', 'CCAController@tambahkelab')
               ->name('cca.cca.tambahkelab')
               ->middleware('checkRole:ROLE_SUPERADMIN|ROLE_CCA_ADMIN|ROLE_CCA_FOCAL');


          Route::post('/storetambahkelab', 'CCAController@storetambahkelab')
               ->name('cca.cca.storetambahkelab')
               ->middleware('checkRole:ROLE_SUPERADMIN|ROLE_CCA_ADMIN|ROLE_CCA_FOCAL');


          Route::delete('/destroytambahkelab', 'CCAController@destroytambahkelab')
               ->name('cca.cca.destroytambahkelab')
               ->middleware('checkRole:ROLE_SUPERADMIN|ROLE_CCA_ADMIN|ROLE_CCA_FOCAL');

     }

);

//Bookings Page


Route::group(
     [
          'prefix' => 'bookings',
     ],
     function () {

          
               
          Route::get('/', 'BookingController@home')
               ->name('bookings.booking.home');

          Route::get('/createR', 'BookingController@createR')
               ->name('bookings.booking.createR');

          Route::post('/store', 'BookingController@store')
               ->name('bookings.booking.store');

          Route::get('/{id}/update', 'BookingController@update')
               ->name('bookings.booking.update');
          
          //Booking Meeting Room

          Route::get('/r', 'BookingController@indexR')
               ->name('bookings.booking.indexR');

          Route::get('/radmin', 'BookingController@indexRadmin')
               ->name('bookings.booking.indexRadmin');
          
          Route::get('/bookings/{booking}/verify', 'BookingController@verify')
               ->name('bookings.booking.verify');

          Route::delete('/{id}/updateMR', 'BookingController@updateMR')
               ->name('bookings.booking.destroy')
               ->where('id', '[0-9]+');
          
          Route::post('/storeMR', 'BookingController@storeMR')
               ->name('bookings.booking.storeMR');

          
     
     }
);

//Meeting Room Calendar
Route::group(
     [
     'prefix' => 'meetingroomsystem'
     ],
     function () {

     Route::resource('rooms', 'RoomsController');

     Route::get('rooms', 'RoomsController@index')
          ->name('adminbooking.rooms.index');

     Route::get('add-room', 'RoomsController@create')
          ->name('adminbooking.rooms.create');

     Route::get('/{room}/show-room', 'RoomsController@show')
          ->name('adminbooking.rooms.show')
          ->where('id', '[0-9]+');

     Route::get('/{room}/edit-room', 'RoomsController@edit')
          ->name('adminbooking.rooms.edit')
          ->where('id', '[0-9]+');
     
     Route::delete('{room}/delete-room', 'RoomsController@destroy')
          ->name('adminbooking.rooms.destroy')
          ->where('id', '[0-9]+');

     Route::post('createroom', 'RoomsController@store')
          ->name('adminbooking.rooms.store');

     Route::post('/updateroom', 'RoomsController@update')
          ->name('adminbooking.rooms.update');

     // Events    
     Route::resource('events', 'EventsController');

     Route::get('booking', 'EventsController@index')
          ->name('adminbooking.booking.index');

     Route::get('booking/create', 'EventsController@create')
          ->name('adminbooking.booking.create');

     Route::get('{event}/edit-booking', 'EventsController@edit')
          ->name('adminbooking.booking.edit')
          ->where('id', '[0-9]+');
     
     Route::get('{event}/show-booking', 'EventsController@show')
          ->name('adminbooking.booking.show')
          ->where('id', '[0-9]+');
     
     Route::delete('{event}/delete-booking', 'EventsController@destroy')
          ->name('adminbooking.booking.destroy')
          ->where('id', '[0-9]+');

Route::delete('{event}/cancel-booking', 'EventsController@destroyuser')
          ->name('adminbooking.booking.destroyuser')
          ->where('id', '[0-9]+');

     Route::post('/updatebooking', 'EventsController@update')
          ->name('adminbooking.booking.update')
          ->where('id', '[0-9]+');

     Route::post('booking/store', 'EventsController@store')
          ->name('adminbooking.booking.store');
     
     Route::get('bookingadmin', 'EventsController@indexadmin')
          ->name('adminbooking.booking.indexadmin');

     Route::get('booking/createadmin', 'EventsController@createadmin')
          ->name('adminbooking.booking.createadmin');
     
     Route::get('{event}/show-bookingadmin', 'EventsController@showadmin')
          ->name('adminbooking.booking.showadmin')
          ->where('id', '[0-9]+');
     
     Route::post('booking/storeadmin', 'EventsController@storeadmin')
          ->name('adminbooking.booking.storeadmin');

     Route::get('{event}/edit-booking-search', 'EventsController@editsearch')
          ->name('adminbooking.booking.editsearch')
          ->where('id', '[0-9]+');     

     Route::post('/updatebookingsearch', 'EventsController@updatesearch')
          ->name('adminbooking.booking.updatesearch')
          ->where('id', '[0-9]+');

     
     
     //end of Event

     Route::get('system-calendar', 'SystemCalendarController@index')->name('adminbooking.systemcalendar');
     Route::get('system-calendar-indexp1', 'SystemCalendarController@indexp1')->name('adminbooking.systemcalendarindexp1');
     Route::get('system-calendar-indexp2', 'SystemCalendarController@indexp2')->name('adminbooking.systemcalendarindexp2');
     Route::get('system-calendar-indexp4', 'SystemCalendarController@indexp4')->name('adminbooking.systemcalendarindexp4');
     Route::get('system-calendar-indexp5', 'SystemCalendarController@indexp5')->name('adminbooking.systemcalendarindexp5');
     Route::get('system-calendar-indexmr', 'SystemCalendarController@indexmr')->name('adminbooking.systemcalendarindexmr');

     Route::get('system-calendar-admin', 'SystemCalendarController@indexadmin')->name('adminbooking.systemcalendaradmin');
     
     Route::get('search-room', 'BookingsController@searchRoom')->name('adminbooking.searchroom');
     Route::get('search-room-admin', 'BookingsController@searchRoomAdmin')->name('adminbooking.searchroomadmin');

     Route::post('book-room', 'BookingsController@bookRoom')->name('bookRoom');
     Route::post('book-room-admin', 'BookingsController@bookRoomAdmin')->name('bookRoomAdmin');
     
     Route::get('my-credits', 'BalanceController@index')->name('balance.index');
     Route::post('add-balance', 'BalanceController@add')->name('balance.add');

     Route::resource('transactions', 'TransactionsController')->only(['index']);

});
//Employee Movement

//Emovement Page


Route::group(
     [
          'prefix' => 'emovement',
     ],
     function () {


          Route::get('/', 'EmovementController@index')
               ->name('emovements.emovement.index')
               ->middleware('checkRole:ROLE_SUPERADMIN|ROLE_EMOVEMENT');

          
          Route::get('/edit{employment}','EmovementController@edit')
               ->name('emovements.emovement.edit')
               ->where('id', '[0-9]+')
               ->middleware('checkRole:ROLE_SUPERADMIN|ROLE_EMOVEMENT');

          Route::get('/view{employmentview}', 'EmovementController@view')
               ->name('emovements.emovement.view')
               ->where('id', '[0-9]+')
               ->middleware('checkRole:ROLE_SUPERADMIN|ROLE_EMOVEMENT');

          
          Route::post('/updateEM', 'EmovementController@updateEM')
               ->name('emovements.emovement.updateEM')
               ->middleware('checkRole:ROLE_SUPERADMIN|ROLE_EMOVEMENT');


          
     }
);

Route::group(
     [
          'prefix' => 'onlinenotification',
     ],
     function () {

          //Admin View

          Route::get('/', 'OnlineNotificationService@index')
               ->name('onlinenotifications.onlinenotification.index')
               ->middleware('checkRole:ROLE_SUPERADMIN|ROLE_ONS_ADMIN');

               
          Route::get('/create','OnlineNotificationService@form')
               ->name('onlinenotifications.onlinenotification.form')
               ->middleware('checkRole:ROLE_SUPERADMIN|ROLE_ONS_ADMIN');

          
          Route::post('/save', 'OnlineNotificationService@save')
               ->name('onlinenotifications.onlinenotification.save');
               
          Route::get('/viewadmin{adminview}', 'OnlineNotificationService@adminview')
               ->name('onlinenotifications.onlinenotification.adminview')
               ->where('id', '[0-9]+')
               ->middleware('checkRole:ROLE_SUPERADMIN|ROLE_ONS_ADMIN');


          Route::delete('/destroy{adminview}', 'OnlineNotificationService@destroy')
               ->name('onlinenotifications.onlinenotification.destroy')
               ->where('id', '[0-9]+');

          Route::get('/Result', 'OnlineNotificationService@searchons')
               ->name('onlinenotifications.onlinenotification.sendons');

          //User View
          
          Route::get('/indexuser','OnlineNotificationService@indexuser')
               ->name('onlinenotifications.onlinenotification.indexuser')
               ->middleware('checkRole:ROLE_ONS_USER|ROLE_SUPERADMIN');
          
          Route::post('/send', 'OnlineNotificationService@send')
               ->name('onlinenotifications.onlinenotification.send');
             

          
          Route::get('/viewuser{userview}', 'OnlineNotificationService@view')
               ->name('onlinenotifications.onlinenotification.userview')
               ->where('id', '[0-9]+')
               ->middleware('checkRole:ROLE_ONS_USER|ROLE_SUPERADMIN');


     }
);
//Soalan Taklimat Start (27/04/23)
Route::get('/Q&A', 'SoalanTaklimatController@index')
->name('Q&A');

//SK Page
Route::group(
     [
     'prefix' => 'st',
     // 'middleware'=> ['checkRole: ROLE_SUPERADMIN|ROLE_QUESTION&ANSWER']
     ], function () {

          Route::get('/indexadmin', 'SoalanTaklimatController@indexadmin')
          ->name('st.soalantaklimat.indexadmin')
          ->middleware('checkRole:ROLE_SUPERADMIN|ROLE_QUESTION&ANSWER');

          Route::post('/store', 'SoalanTaklimatController@store')
          ->name('st.soalantaklimat.store');

          Route::get('/{st}/showadmin', 'SoalanTaklimatController@showadmin')
               ->name('st.soalantaklimat.showadmin')
               ->where('id', '[0-9]+')
               ->middleware('checkRole:ROLE_SUPERADMIN|ROLE_QUESTION&ANSWER');

          
          Route::delete('{st}/deletesoalan', 'SoalanTaklimatController@destroy')
               ->name('st.soalantaklimat.destroy')
               ->where('id', '[0-9]+')
               ->middleware('checkRole:ROLE_SUPERADMIN|ROLE_QUESTION&ANSWER');


          Route::delete('{pst}/deleteperkara', 'SoalanTaklimatController@destroyperkara')
               ->name('pst.soalantaklimat.destroy')
               ->where('id', '[0-9]+')
               ->middleware('checkRole:ROLE_SUPERADMIN|ROLE_QUESTION&ANSWER');


          Route::post('/perkarastore', 'SoalanTaklimatController@storeperkara')
               ->name('st.soalantaklimat.storeperkara')
               ->middleware('checkRole:ROLE_SUPERADMIN|ROLE_QUESTION&ANSWER');


     
     });
//Soalan Taklimat End (27/04/23)

//   Postup (13/06/2023)

Route::get('/postup', 'PostupController@postupform')
->name('postup1');


Route::group(
     [
          'prefix' => 'postup',
     ],
     function () {


          Route::get('/indexadmin', 'PostupController@indexadmin')
          ->name('postup.postup.indexadmin');

          Route::post('/store', 'PostupController@store')
               ->name('postup.postup.store');

          Route::delete('{postup}/delete', 'PostupController@destroy')
          ->name('postup.postup.destroy')
          ->where('id', '[0-9]+');
               

     });

//Announcement Start
Route::group(
     [
          'prefix' => 'announcement',
     ],
     function () {
          Route::get('/announcement', 'AnnouncementController@announcementindex')
               ->name('announcement.announcementindex');

          Route::get('/announcement-admin', 'AnnouncementController@announcementadmin')
               ->name('announcement.announcementadmin');

          Route::get('/announcement-admin/create', 'AnnouncementController@announcementadmincreate')
               ->name('announcement.announcementadmin-create');

          Route::post('/announcement-admin', 'AnnouncementController@announcementstore')
               ->name('announcement.store');


         Route::get('/announcement-admin/edit/{created_at}','AnnouncementController@announcementedit')
               ->name('announcement.announcementadmin-edit');

          Route::put('/announcement-admin/{created_at}', 'AnnouncementController@announcementupdate')
               ->name('announcement.update');


          Route::delete('/announcement-admin/{created_at}', [AnnouncementController::class, 'announcementdestroy'])
               ->name('announcement.destroy');

          Route::delete('/notification-admin/{notification}', 'AnnouncementController@notificationdestroy')
               ->name('notification.destroy')
               ->where('id', '[0-9]+');

          Route::delete('/notification-admin-ease/{id}', 'AnnouncementController@notificationdestroyEASE')
               ->name('notification.destroyEASE');

          Route::post('/subscribe', 'AnnouncementController@subscribeannouncement')->name('subscribeannouncement');
          Route::post('/unsubscribe', 'AnnouncementController@unsubscribeannouncement')->name('unsubscribeannouncement');

          Route::post('/notification/toggle', [AnnouncementController::class, 'toggleNotification'])->name('notification.toggle');
          Route::post('/notification/toggleEase', [AnnouncementController::class, 'toggleNotificationEase'])->name('notification.toggleEase');
     });

//News Start
Route::group(
     [
          'prefix' => 'news',
     ],
     function () {
          Route::get('/news-index', 'NewsController@newsindex')
               ->name('news.newsindex');

          Route::get('/news-admin', 'NewsController@newsadmin')
               ->name('news.newsadmin')
               ->middleware('checkRole:ROLE_SUPERADMIN|ROLE_NEWS');


          Route::get('/news-admin/create', 'NewsController@newsadmincreate')
               ->name('news.newsadmin-create')
               ->middleware('checkRole:ROLE_SUPERADMIN|ROLE_NEWS');


          Route::post('/news-admin', 'NewsController@newsstore')
               ->name('news.store')
               ->middleware('checkRole:ROLE_SUPERADMIN|ROLE_NEWS');


          Route::get('/news-admin/edit/{news}','NewsController@newsedit')
               ->name('news.newsadmin-edit')
               ->where('id', '[0-9]+')
               ->middleware('checkRole:ROLE_SUPERADMIN|ROLE_NEWS');


          Route::put('/news-admin/{news}', 'NewsController@newsupdate')
               ->name('news.update')
               ->where('id', '[0-9]+')
               ->middleware('checkRole:ROLE_SUPERADMIN|ROLE_NEWS');


          Route::delete('/news-admin/{newst}', 'NewsController@newsdestroy')
               ->name('news.destroy')
               ->where('id', '[0-9]+')
               ->middleware('checkRole:ROLE_SUPERADMIN|ROLE_NEWS');

     });
//News End

// JawatanKosong 17/7/2023
Route::group(
     [
     'prefix' => 'jawatankosong',
     ], function () {
          
          Route::get('/', 'JawatanKosongController@indexadmin')
          ->name('jawatankosong.jawatankosong.indexadmin');

          //     Route::get('/{dept_id}', 'JawatankosongController@indexadmin');
          
          Route::get('/{deptid}/indexdept', 'JawatanKosongController@indexdept')
          ->name('jawatankosong.jawatankosong.indexdept')
          ->where('id', '[0-9]+');

          Route::get('/index', 'JawatanKosongController@index')
          ->name('jawatankosong.jawatankosong.index');

          Route::get('jawatankosong/indexdept/{id}', 'JawatanKosongController@indexdept')->name('jawatankosong.indexdept');

          Route::get('/jawatankosong/createadmin/{id}', 'JawatanKosongController@createadmin')
          ->name('jawatankosong.jawatankosong.createadmin');

               Route::get('/create', 'JawatanKosongController@create')
          ->name('jawatankosong.jawatankosong.create');

          Route::post('/store', 'JawatanKosongController@store')
          ->name('jawatankosong.jawatankosong.store');

          Route::post('/storecreate', 'JawatanKosongController@storecreate')
          ->name('jawatankosong.jawatankosong.storecreate');

          Route::get('/{deptid}/editdept', 'JawatanKosongController@editdept')
          ->name('jawatankosong.jawatankosong.editdept')
          ->where('id', '[0-9]+');

               Route::post('/updatedept', 'JawatanKosongController@updatedept')
          ->name('jawatankosong.jawatankosong.updatedept') 
          ->where('id', '[0-9]+');

          Route::get('/{jk}/edit', 'JawatanKosongController@edit')
          ->name('jawatankosong.jawatankosong.edit')
          ->where('id', '[0-9]+');

          Route::post('/update', 'JawatanKosongController@update')
          ->name('jawatankosong.jawatankosong.update') 
          ->where('id', '[0-9]+');

          //     start for jawatanlist 8/8/2023

          Route::get('/senaraijawatan', 'JawatanKosongController@senaraijawatan')
          ->name('jawatankosong.jawatankosong.senaraijawatan');

               
          Route::post('/storejawatan', 'JawatanKosongController@storejawatan')
          ->name('jawatankosong.jawatankosong.storejawatan');

          Route::delete('{id}/destroyjawatan', 'JawatanKosongController@destroyjawatan')
               ->name('jawatankosong.jawatankosong.destroyjawatan')
               ->where('id', '[0-9]+');

          Route::get('/{id}/editsenaraijawatan', 'JawatanKosongController@editSenaraiJawatan')
               ->name('jawatankosong.jawatankosong.editsenaraijawatan');


          Route::put('/{id}/updatesenaraijawatan', 'JawatanKosongController@updateSenaraiJawatan')
               ->name('jawatankosong.jawatankosong.updatesenaraijawatan');
     
     });

// Prestasi 14/08/2023 Ekma
     Route::group(
          [
               'prefix' => 'prestasi',
          ],
          function () {
     
               Route::get('/', 'PrestasiController@index')
                    ->name('prestasi.prestasi.index');
     
               Route::get('/indexadmin', 'PrestasiController@indexadmin')
                    ->name('prestasi.prestasi.indexadmin')
                    ->middleware('checkRole:ROLE_SUPERADMIN|ROLE_PRESTASI');

     
               Route::get('/create', 'PrestasiController@create')
                    ->name('prestasi.prestasi.create');
     
               Route::post('/store', 'PrestasiController@store')
                    ->name('prestasi.prestasi.store');
     
               Route::get('/{ps}/edit', 'PrestasiController@edit')
                    ->name('prestasi.prestasi.edit')
                    ->where('id', '[0-9]+');
     
               Route::get('/editadmin/{p}', 'PrestasiController@editadmin')
                    ->name('prestasi.prestasi.editadmin')
                    ->where('id', '[0-9]+')
                    ->middleware('checkRole:ROLE_SUPERADMIN|ROLE_PRESTASI');

     
               Route::post('/{p}/update', 'PrestasiController@update')
                    ->name('prestasi.prestasi.update')
                    ->where('id', '[0-9]+');
               
     
               Route::post('/updateadmin', 'PrestasiController@updateadmin')
                    ->name('prestasi.prestasi.updateadmin')
                    ->where('id', '[0-9]+')
                    ->middleware('checkRole:ROLE_SUPERADMIN|ROLE_PRESTASI');



          Route::delete('{prestasi}/delete', 'PrestasiController@destroy')
          ->name('prestasi.prestasi.destroy')
          ->where('id', '[0-9]+');

               });

//Inventory Start

     Route::group(
     [
          'prefix' => 'inventory',
     ],
     function () {

          Route::get('/datakeramaian', 'InventoryController@datakeramaianindex')
               ->name('inventory.datakeramaianindex');

          Route::get('/datakeramaian/{id}/edit', 'InventoryController@datakeramaianedit')
               ->name('inventory.datakeramaianedit')
               ->where('id', '[0-9]+');

          Route::post('/datakeramaian/{id}/edit', 'InventoryController@datakeramaianupdate')
               ->name('inventory.datakeramaianupdate')
               ->where('id', '[0-9]+');

          });
         


// Permohonan Role 5/10/23 ekma
     Route::get('/borangpermohonanperanan', 'PermohonanroleController@permohonanroleform')
     ->name('permohonanrole');
     
     Route::group(
          [
          'prefix' => 'permohonanperanan',
          ], function () {

               Route::get('/indexadmin', 'PermohonanroleController@indexadmin')
               ->name('permohonanrole.permohonanrole.indexadmin')
               ->middleware('checkRole:ROLE_SUPERADMIN|ROLE_PERMOHONAN');


               Route::post('/store', 'PermohonanroleController@store')
               ->name('permohonanrole.permohonanrole.store');

               Route::get('/editadmin/{pr}', 'PermohonanroleController@editadmin')
               ->name('permohonanrole.permohonanrole.editadmin')
               ->where('id', '[0-9]+');

               Route::post('/updateadmin', 'PermohonanroleController@updateadmin')
               ->name('permohonanrole.permohonanrole.updateadmin')
               ->where('id', '[0-9]+');

               Route::post('/storeperanan', 'PermohonanroleController@storeperanan')
               ->name('permohonanrole.permohonanrole.storeperanan');

               Route::delete('{pr}/delete', 'PermohonanroleController@destroy')
               ->name('permohonanrole.permohonanrole.destroy')
               ->where('id', '[0-9]+');

               Route::delete('{pr}/deleteperanan', 'PermohonanroleController@destroyperanan')
                    ->name('permohonanrole.permohonanrole.destroyperanan')
                    ->where('id', '[0-9]+');

               Route::get('/peranan/{pr}/approve', 'PermohonanroleController@approve')->name('permohonanrole.permohonanrole.approve');
               Route::get('/peranan/{pr}/rejecy', 'PermohonanroleController@reject')->name('permohonanrole.permohonanrole.reject');
          });
// Permohonan Ends

// SuspendedCompany 06/11/2023 Zharif
     Route::group(
          [
               'prefix' => 'msc',
          ],
          function () {
               Route::get('/index', 'SuspendedCompanyController@index')
                    ->name('msc.mscindex');

               Route::get('/admin-index', 'SuspendedCompanyController@admin')
                    ->name('msc.mscadmin')
                     ->middleware('checkRole:ROLE_SUPERADMIN|ROLE_TEGAHAN');


               Route::get('/create', 'SuspendedCompanyController@mscform')
                    ->name('msc.mscform')
                    ->middleware('checkRole:ROLE_SUPERADMIN|ROLE_TEGAHAN');


               Route::post('/store', 'SuspendedCompanyController@store')
                    ->name('msc.store');

               Route::delete('{msc}/delete', 'SuspendedCompanyController@destroy')
                    ->name('msc.destroy')
                    ->where('id', '[0-9]+');

               Route::get('export/excel', 'SuspendedCompanyController@exportToExcel')
                    ->name('msc.excel');
          });
//SuspendedCompany END

// 05/12/23  Event qr code Ekma
     Route::get('/moeeventscanqrcode', function () {
          return view('moeeventscan');
          });
          
     Route::get('moeeventscanqrcode/{event_id}/', 'MoeeventController@scanqrcode');

     //  qrcode after participant scan
     
     // Original:
     Route::get('eventqrcode/{event_id}/{participant_id}', 'MoeeventController@eventqrcode')->name('eventqrcode');

          
     //admin eventqrcode
     Route::get('eventqrcode/{id}', 'MoeeventController@eventqrcodeadmin')
               ->name('eventqrcodeadmin')
               ->middleware(['check.qrcode.access']);
           

     // event registration form
     Route::get('/moeevent', 'MoeeventController@openform')
          ->name('moeevent');

     //Added by Amal 'Izzah (PB)

     //Rating form
     Route::get('/ratingopenform', 'MoeeventController@ratingopenform')
          ->name('ratingopenform');

     Route::get('rateqrcode/{event_id}', 'MoeeventController@generateRateQrCode')
          ->name('rateqrcode');

     Route::get('/rating/{event_id}', 'MoeeventController@rating')
          ->name('rating');

     //wani 25012024
     Route::get('/download-qr-code-pdf/{id}', 'MoeeventController@downloadQrCodePdf')
          ->name('downloadQrCodePdf');

     Route::get('/downloadQrCodePng/{id}', 'MoeeventController@downloadQrCodePng')
          ->name('downloadQrCodePng');

     Route::get('/show-qr-code/{id}', 'MoeeventController@showQrCodeImage')
          ->name('showQrCodeImage');

     Route::get('/linkurlscan', 'MoeeventController@moeeventlink')
               ->name('moeeventlink')
               ->middleware('check.qrcode.access');

     Route::group(
          [
          'prefix' => 'moeevent',
          ], function () {

               

               Route::post('/store', 'MoeeventController@store')
                         ->name('moeevent.moeevent.store');

               //Added by Amal 'Izzah (PB)                                
               Route::post('/moeevent/storeRate/{event_id}', 'MoeeventController@storeRate')
                              ->name('moeevent.moeevent.storeRate');

               Route::post('/storeRateopenform', 'MoeeventController@storeRateopenform')
                    ->name('moeevent.moeevent.storeRateopenform');

               Route::get('/createevent', 'MoeeventController@createevent')
                    ->name('moeevent.moeevent.createevent');

               Route::post('/storeevent', 'MoeeventController@storeevent')
                    ->name('moeevent.moeevent.storeevent');

               Route::get('/{me}/editadmin', 'MoeeventController@editadmin')
                    ->name('moeevent.moeevent.editadmin')
                    ->where('id', '[0-9]+');

               Route::get('/{me}/participant', 'MoeeventController@approveparticipant')
                    ->name('moeevent.moeevent.approveparticipant')
                    ->where('id', '[0-9]+');

               Route::get('/moeevent/{me}/participant', 'MoeeventController@attended')->name('moeevent.moeevent.attended');
               
               Route::get('/moeevent/{me}/participantresubmit', 'MoeeventController@resubmitattendant')->name('moeevent.moeevent.resubmitattendant');
          
                    
               Route::get('/indexadmin', 'MoeeventController@indexadmin')
                    ->name('moeevent.moeevent.indexadmin')
                    ->middleware('checkRole:ROLE_SUPERADMIN|ROLE_MOEEVENT');


               Route::post('/updateadmin', 'MoeeventController@updateadmin')
                    ->name('moeevent.moeevent.updateadmin')
                    ->where('id', '[0-9]+');

               Route::delete('/destroymoeevent/{id}', 'MoeeventController@destroymoeevent')
                    ->name('moeevent.moeevent.destroymoeevent')
                    ->where('id', '[0-9]+');

               Route::get('/moeevent/{me}/approve', 'MoeeventController@approve')->name('moeevent.moeevent.approve');

               Route::get('/moeevent/{me}/reject', 'MoeeventController@reject')->name('moeevent.moeevent.reject');

               Route::get('/{me}/showevent', 'MoeeventController@showevent')
                    ->name('moeevent.moeevent.showevent')
                    ->where('id', '[0-9]+');

               Route::post('/{me}/showevent/updateregistereduser', 'MoeeventController@updateregistereduser')
                    ->name('moeevent.moeevent.updateregistereduser')
                    ->where('id', '[0-9]+');

               Route::get('/{me}/moeeventscanqrcode', 'MoeeventController@scanqrcode')
                    ->name('moeevent.moeevent.scanqrcode')
                    ->where('id', '[0-9]+');

               Route::get('/{me}/dashboard', 'MoeeventController@dashboard')
                    ->name('moeevent.moeevent.dashboard')
                    ->where('id', '[0-9]+');

               // Added by Amal 'Izzah (PB)
               Route::get('/{me}/ratinglist', 'MoeeventController@showrating')
                    ->name('moeevent.moeevent.showrating')
                    ->where('me', '[0-9]+');

               //Export to excel - Fira
               Route::get('/export-to-excel/{id}', 'MoeeventController@exportToExcel')
                    ->name('export.to.excel');
                    
               Route::get('/{id}/ratinglist/export-to-excel/', 'MoeeventController@exportToExcelRatingList')
                    ->name('export.to.excelratinglist');

               Route::get('/{id}/ratinglist/export-to-excel2/', 'MoeeventController@exportToExcelRatingList2')
                    ->name('export.to.excelratinglist2');

               Route::delete('{me}/destroyregisterlist', 'MoeeventController@destroyregisterlist')
                    ->name('moeevent.moeevent.destroyregisterlist')
                    ->where('id', '[0-9]+');    

               Route::get('/linkurlsearch', 'MoeeventController@search')
                         ->name('moeevent.moeevent.search');

               
               // start event qrcode
               Route::get('/indexevent', 'SKController@indexevent')
                    ->name('sk.slipkedatangan.indexevent');

               Route::post('/updateevent', 'SKController@updateevent')
                    ->name('sk.slipkedatangan.updateevent')
                    ->where('id', '[0-9]+');

               Route::delete('{skp}/deleteevent', 'SKController@destroyevent')
                    ->name('sk.slipkedatangan.destroyevent')
                    ->where('id', '[0-9]+'); 



                    

                                              
          });

// adding cddinventory 29jan24 : Ekma
// CddinventoryController 26/8/2023
Route::get('/borangpenerimaanbarangold/{id}', 'CddinventoryController@isiborangpenerimaan')->name('inventorybook');
          
Route::get('/borangpenerimaanbarang/{id}', 'CddinventoryController@isiborangpenerimaan')->name('inventorypenerimaanbuku');

Route::get('/inventorybbk/export', 'CddinventoryController@exportToExcel')->name('inventorybbk.exportToExcel');
Route::post('/cddinventory/query/submit', [\App\Http\Controllers\CddinventoryController::class, 'submitQuery'])
    ->name('cddinventory.cddinventory.submitQuery');





    Route::group(
     [
         'prefix' => 'inventory',
     ],
     function () {
 
         Route::get('/', 'CddinventoryController@index')
             ->name('cddinventory.cddinventory.index');
 
         Route::get('/indexadmin', 'CddinventoryController@indexadmin')
             ->name('cddinventory.cddinventory.indexadmin');
 
         Route::get('/indexsebutharga', 'CddinventoryController@indexsebutharga')
             ->name('cddinventory.cddinventory.indexsebutharga');
 
         Route::get('/fetch-info/{isbn}', [CddinventoryController::class, 'fetchInfo'])->name('fetch-info');
 
         Route::get('/get-user-by-ic', [CddinventoryController::class, 'getUserByIc'])->name('get.user.by.ic');

         Route::get('/create', 'CddinventoryController@create')
             ->name('cddinventory.cddinventory.create');
 
         Route::get('/createsebutharga', 'CddinventoryController@createsebuthargaform')
             ->name('cddinventory.cddinventory.createsebutharga');
 
         Route::get('/createunit', 'CddinventoryController@createunit')
             ->name('cddinventory.cddinventory.createunit');
 
         Route::post('/store', 'CddinventoryController@store')
             ->name('cddinventory.cddinventory.store');
 
         Route::post('/storepenerimaan', 'CddinventoryController@storepenerimaan')
             ->name('cddinventory.cddinventory.storepenerimaan');
         Route::post('notify-amendments/{id}', 'CddinventoryController@notifyAmendments')
             ->name('cddinventory.notifyAmendments');
         Route::delete('{in}/destroy', 'CddinventoryController@destroy')
             ->name('cddinventory.cddinventory.destroy')
             ->where('id', '[0-9]+');
       
         Route::get('/{in}/edit', 'CddinventoryController@edit')
             ->name('cddinventory.cddinventory.edit')
             ->where('id', '[0-9]+');
 
         Route::get('/{in}/editunit', 'CddinventoryController@editunit')
             ->name('cddinventory.cddinventory.editunit')
             ->where('id', '[0-9]+');
 
         Route::get('/{in}/editadmin', 'CddinventoryController@editadmin')
             ->name('cddinventory.cddinventory.editadmin')
             ->where('id', '[0-9]+');
 
         Route::get('/{in}/editadminunit', 'CddinventoryController@editadminunit')
             ->name('cddinventory.cddinventory.editadminunit')
             ->where('id', '[0-9]+');
 
         Route::get('/{in}/editsebutharga', 'CddinventoryController@editsebutharga')
             ->name('cddinventory.cddinventory.editsebutharga')
             ->where('id', '[0-9]+');
 
         Route::get('/{in}/editcddinfo', 'CddinventoryController@editcddinfo')
             ->name('cddinventory.cddinventory.editcddinfo')
             ->where('id', '[0-9]+');
 
         Route::get('/{in}/editcddinfoadmin', [CddinventoryController::class, 'editcddinfoadmin']
 )
             ->name('cddinventory.cddinventory.editcddinfoadmin')
             ->where('id', '[0-9]+');
 
         Route::post('/updatesebutharga', 'CddinventoryController@updatesebutharga')
             ->name('cddinventory.cddinventory.updatesebutharga')
             ->where('id', '[0-9]+');
 
         Route::post('/updatesebutharganew', 'CddinventoryController@updatesebutharganew')
             ->name('cddinventory.cddinventory.updatesebutharganew')
             ->where('id', '[0-9]+');
 
         Route::post('/update', 'CddinventoryController@update')
             ->name('cddinventory.cddinventory.update')
             ->where('id', '[0-9]+');
 
         Route::post('/updateadmin', 'CddinventoryController@updateadmin')
             ->name('cddinventory.cddinventory.updateadmin')
             ->where('id', '[0-9]+');
 
         Route::post('/updateadminunit', 'CddinventoryController@updateadminunit')
             ->name('cddinventory.cddinventory.updateadminunit')
             ->where('id', '[0-9]+');
 
         Route::post('/updateinfo', 'CddinventoryController@updateinfo')
             ->name('cddinventory.cddinventory.updateinfo')
             ->where('id', '[0-9]+');
 
         Route::post('/updateccdinfoadmin', 'CddinventoryController@updatecddinfoadmin')
             ->name('cddinventory.cddinventory.updatecddinfoadmin')
             ->where('id', '[0-9]+');
 
         Route::get('/{in}/borangpengeluaran', 'CddinventoryController@borangpengeluaran')
             ->name('cddinventory.cddinventory.borangpengeluaran')
             ->where('id', '[0-9]+');
 
         Route::post('/storebp', 'CddinventoryController@storebp')
             ->name('cddinventory.cddinventory.storebp')
             ->where('id', '[0-9]+');
 
         Route::post('/storesebutharga', 'CddinventoryController@storesebutharga')
             ->name('cddinventory.cddinventory.storesebutharga')
             ->where('id', '[0-9]+');
 
         Route::post('/updatebp', 'CddinventoryController@updatebp')
             ->name('cddinventory.cddinventory.updatebp')
             ->where('id', '[0-9]+');
 
         Route::get('/{in}/bpform', 'CddinventoryController@bpform')
             ->name('cddinventory.cddinventory.bpform')
             ->where('id', '[0-9]+');
 
         Route::post('storeicnumber/{id}', 'CddinventoryController@storeicnumber')
             ->name('cddinventory.cddinventory.storeicnumber')
             ->where('id', '[0-9]+');
 
         Route::get('{in}/addicnumber', 'CddinventoryController@addicnumber')
             ->name('cddinventory.cddinventory.addicnumber')
             ->where('id', '[0-9]+');
         
          Route::get('/downloadallrecordspdf', 'CddinventoryController@downloadAllRecordsPdf')
          ->name('cddinventory.cddinventory.downloadallrecordspdf');

         Route::get('/download-pdfs-zip', 'CddinventoryController@downloadPdfsAsZip')->name('download.pdfs.zip');
 
         Route::get('/download-pdfs', [CddinventoryController::class, 'downloadPdfs'])->name('download.pdfs');
 
         Route::get('/{in}/generatepdf', 'CddinventoryController@generatePDF')
             ->where('id', '[0-9]+')
             ->name('generate.pdf');
 
         Route::delete('/deletesebutharga/{id}', 'CddinventoryController@destroysebutharga')
             ->where('id', '[0-9]+')
             ->name('cddinventory.cddinventory.destroysebutharga');
             
            
         // sebutharga
 
         Route::get('/sendemail/{in}', 'CddinventoryController@emailvendorsebutharga')->name('cddinventory.cddinventory.emailvendor');
          
         // create book
 
         Route::get('/createbook', 'CddinventoryController@createbook')
             ->name('cddinventory.cddinventory.createbook');
 
         Route::post('/storebook', 'CddinventoryController@storebook')
             ->name('cddinventory.cddinventory.storebook');
 
         Route::get('/{in}/book', 'CddinventoryController@editbook')
             ->name('cddinventory.cddinventory.editbook')
             ->where('id', '[0-9]+');
 
         Route::post('/updatebook', 'CddinventoryController@updatebook')
             ->name('cddinventory.cddinventory.updatebook');
 
         Route::get('/indexbook', 'CddinventoryController@indexbook')
             ->name('cddinventory.cddinventory.indexbook');
 
         Route::delete('/deletebook/{id}', 'CddinventoryController@destroybook')
             ->name('cddinventory.cddinventory.destroybook');
 
         Route::get('/createbooksubject', 'CddinventoryController@createbooksubject')
             ->name('cddinventory.cddinventory.createbooksubject');
 
         Route::post('/storebooksubject', 'CddinventoryController@storebooksubject')
             ->name('cddinventory.cddinventory.storebooksubject');
 
         Route::get('/{id}/subjectbook', 'CddinventoryController@editbooksubject')
             ->name('cddinventory.cddinventory.editbooksubject')
             ->where('id', '[0-9]+');
 
         Route::post('/updatebooksubject', 'CddinventoryController@updatebooksubject')
             ->name('cddinventory.cddinventory.updatebooksubject');
 
         Route::delete('/deletebooksubject/{id}', 'CddinventoryController@destroybooksubject')
             ->name('cddinventory.cddinventory.destroybooksubject');
 
         //Baucer
         Route::get('/createbaucer', 'CddinventoryController@createbaucer')
             ->name('cddinventory.baucer.createbaucer');
 
         Route::post('/storebaucer', 'CddinventoryController@storebaucer')
             ->name('cddinventory.baucer.storebaucer');
 
         Route::get('/{rujukan_srv}/editbaucer', 'CddinventoryController@editbaucer')
             ->name('cddinventory.baucer.editbaucer')
             ->where('id', '[0-9]+');
 
         Route::post('/updatebaucer/{rujukan_srv}', 'CddinventoryController@updatebaucer')
             ->name('cddinventory.baucer.updatebaucer')
             ->where('id', '[0-9]+');
 
         Route::get('/{rujukan_srv}/showbaucer', 'CddinventoryController@showbaucer')
             ->name('cddinventory.baucer.showbaucer')
             ->where('id', '[0-9]+');
 
         Route::delete('/destroy/{rujukan_srv}', 'CddinventoryController@destroybaucer')
             ->name('cddinventory.baucer.destroy')
             ->where('id', '[0-9]+');
 
         //Guru Besar Section
         Route::get('/indexgurubesarpengetua', 'CddinventoryController@indexgbpg')
             ->name('cddinventory.indexgbpg');
 
         Route::post('/StoreGuruBesarPengetua', 'CddinventoryController@storegbpg')
             ->name('cddinventory.storegbpg');
 
         Route::post('/UpdateGuruBesarPengetua', 'CddinventoryController@updategbpg')
             ->name('cddinventory.updategbpg');
 
         Route::delete('GuruBesarPengetua/destroy/{id}', 'CddinventoryController@destroygbpg')
             ->name('cddinventory.destroygbpg')
             ->where('id', '[0-9]+');
 
         // routes/web.php
         Route::get('/get-kgp-nama/{nama_sch}', 'CddinventoryController@getKgpNama')->name('getKgpNama');
 
         Route::get('/cddinventory/query/{id}', [CddInventoryController::class, 'query'])->name('cddinventory.query');
 
  
 
          Route::get('/inventory/{id}/editcddinfoadmin', [CddinventoryController::class, 'editcddinfoadmin'])
          ->name('cddinventory.editcddinfoadmin');

          Route::get('/{inventory_id}/notify', [CddinventoryController::class, 'notify'])
          ->name('cddinventory.notify');
     

          Route::post('/inventory/{inventory_id}/send-notification', [CddinventoryController::class, 'sendNotification'])
          ->name('cddinventory.sendNotification');

          Route::get('/inventory-notification/{id}', [CddInventoryController::class, 'showNotification'])
          ->name('cddinventory.notification');
 
 
     }
 );
 

 use App\Http\Controllers\Admin\PpkController;

 Route::prefix('admin')->group(function () {
     // Show list of PPKs
     Route::get('/ppk', [PpkController::class, 'index'])->name('admin.ppk.index');
 
     // Store new PPK via AJAX/form
     Route::post('/ppk', [PpkController::class, 'store'])->name('admin.ppk.store');
 
     // Delete PPK via AJAX
     Route::delete('/ppk/{id}', [PpkController::class, 'destroyPpk'])->name('admin.ppk.destroyPpk');

 });
// end cdd inventory
// 05/12/23  Event qr code Ekma

// fsm new
Route::group(
    [
         'prefix' => 'fsm',
    ],
    function () {

        Route::get('/index', 'FileSystemController@index')
              ->name('fsm.fsm.index');

        Route::get('/createfsm', 'FileSystemController@createfsm')
              ->name('fsm.fsm.createfsm');

        Route::post('/store', 'FileSystemController@storefsm')
              ->name('fsm.fsm.storefsm')
              ->where('id', '[0-9]+');

        Route::post('/addDocumentsfsm/{folderId}', 'FileSystemController@addDocumentsfsm')
        ->name('fsm.fsm.addDocumentsfsm')
        ->where('id', '[0-9]+');


         Route::get('fsm/editfsm{id}', 'FileSystemController@editfsm')
              ->name('fsm.fsm.editfsm')
              ->where('id', '[0-9]+');

        Route::delete('fsm/{id}', 'FileSystemController@destroy')
              ->name('fsm.destroy');

        Route::delete('/deletefile/{id}', 'FileSystemController@destroyfile')
              ->name('fsm.fsm.destroyfile');

        // display accessfsm
        Route::post('fsm/grant-access/{folderId}', 'FileSystemController@grantAccess')
              ->name('fsm.accessfsm');

        // store accessfsm
        Route::post('fsm/store-accessfsm/{folderId}', 'FileSystemController@storeAccess')
              ->name('fsm.storeAccessfsm');

        // Add a route for displaying shared folders
        Route::get('/sharedfolders', 'FileSystemController@showSharedFolders')
              ->name('fsm.sharedfolders');

        Route::get('fsm/show-access-users/{folderId}', 'FileSystemController@showAccessUsers')
              ->name('fsm.showAccessUsers');

        Route::post('fsm/revoke-access/{folderId}/{icNo}', 'FileSystemController@revokeAccess')
              ->name('fsm.revokeAccess');

        Route::get('/{folderName}/{filename}', 'FileSystemController@serveFile')
              ->name('fsm.serveFile');
    }
);

//PDMS 15/11/2023 Zharif
     Route::group(
          [
               'prefix' => 'PDMS',

          ],
          function () {

               //Page view
               Route::get('/index', 'PDMSController@index')
                    ->name('pdms.index')
                    ->middleware('checkRole:ROLE_SUPERADMIN|ROLE_PDMS_ADMIN');


               Route::get('/serviceindex', 'PDMSController@serviceindex')
                    ->name('pdms.serviceindex')
                    ->middleware('checkRole:ROLE_SUPERADMIN|ROLE_PDMS_SERVICE');

               Route::get('/cutiindex', 'PDMSController@cutiindex')
                    ->name('pdms.cutiindex')
                    ->middleware('checkRole:ROLE_SUPERADMIN|ROLE_PDMS_CUTI');


               Route::get('/index/viewall', 'PDMSController@viewall')
                    ->name('pdms.viewall')
                    ->middleware('checkRole:ROLE_SUPERADMIN|ROLE_PDMS_ADMIN');


               Route::get('/index/viewfilestatement/', 'PDMSController@viewpenyata')
                    ->name('pdms.viewpenyata')
                    ->middleware('checkRole:ROLE_SUPERADMIN|ROLE_PDMS_ADMIN');


               Route::get('/createprofile', 'PDMSController@indexcreateprofile')
                    ->name('pdms.createprofileform')
                    ->middleware('checkRole:ROLE_SUPERADMIN|ROLE_PDMS_ADMIN');


               //CRUD Functions
               Route::post('/createprofile/store', 'PDMSController@storeprofile')
                    ->name('pdms.storeprofile')
                    ->middleware('checkRole:ROLE_SUPERADMIN|ROLE_PDMS_ADMIN');


               //search function
               Route::post('/searchbyname', 'PDMSController@searchbyname')
                    ->name('pdms.searchbyname')
                    ->middleware('checkRole:ROLE_SUPERADMIN|ROLE_PDMS_ADMIN');


               Route::post('/searchbyic', 'PDMSController@searchbyic')
                    ->name('pdms.searchbyic')
                    ->middleware('checkRole:ROLE_SUPERADMIN|ROLE_PDMS_ADMIN');


               Route::post('/servicesearchbyic', 'PDMSController@servicesearchbyic')
                    ->name('pdms.servicesearchbyic')
                    ->middleware('checkRole:ROLE_SUPERADMIN|ROLE_PDMS_SERVICE');
                    

               Route::post('/cutisearchbyic', 'PDMSController@cutisearchbyic')
                    ->name('pdms.cutisearchbyic')
                    ->middleware('checkRole:ROLE_SUPERADMIN|ROLE_PDMS_CUTI');


               Route::post('/index/showbyname', 'PDMSController@showbyname')
                    ->name('pdms.showbyname')
                    ->middleware('checkRole:ROLE_SUPERADMIN|ROLE_PDMS_ADMIN');


               //Page view with variables
               Route::get('/indexbyic/{no_ic}', 'PDMSController@indexfilebyic')
                    ->name('pdms.indexfilebyic')
                    ->middleware('checkRole:ROLE_SUPERADMIN|ROLE_PDMS_ADMIN');


               Route::get('/serviceindexbyic/{no_ic}', 'PDMSController@serviceindexfilebyic')
                    ->name('pdms.serviceindexfilebyic')
                    ->middleware('checkRole:ROLE_SUPERADMIN|ROLE_PDMS_SERVICE');
               

               Route::get('/cutiindexbyic/{no_ic}', 'PDMSController@cutiindexfilebyic')
                    ->name('pdms.cutiindexfilebyic')
                    ->middleware('checkRole:ROLE_SUPERADMIN|ROLE_PDMS_CUTI');


               Route::get('/indexbyname/{name}', 'PDMSController@indexfilebyname')
                    ->name('pdms.indexfilebyname')
                    ->middleware('checkRole:ROLE_SUPERADMIN|ROLE_PDMS_ADMIN');


               Route::get('/view/{name}', 'PDMSController@viewname')
                    ->name('pdms.viewname')
                    ->middleware('checkRole:ROLE_SUPERADMIN|ROLE_PDMS_ADMIN');

               
               Route::get('/indexbyic/{no_ic}/editprofileform', 'PDMSController@indexeditprofile')
                    ->name('pdms.editprofileform')
                    ->middleware('checkRole:ROLE_SUPERADMIN|ROLE_PDMS_ADMIN');


               Route::get('/indexbyname/{name}/editprofileformbyname', 'PDMSController@indexeditprofilebyname')
                    ->name('pdms.editprofileformbyname')
                    ->middleware('checkRole:ROLE_SUPERADMIN|ROLE_PDMS_ADMIN');


               Route::get('/indexbyic/{no_ic}/createserviceform', 'PDMSController@indexcreateservice')
                    ->name('pdms.createserviceform')
                    ->middleware('checkRole:ROLE_SUPERADMIN|ROLE_PDMS_ADMIN,ROLE_SERVICE');
                    ;

               Route::get('/serviceindexbyic/{no_ic}/createserviceform', 'PDMSController@serviceindexcreateservice')
                    ->name('pdms.servicecreateserviceform')
                    ->middleware('checkRole:ROLE_SUPERADMIN|ROLE_PDMS_SERVICE,ROLE_PDMS_ADMIN');


               Route::get('/indexbyic/{no_ic}/print/service-form', 'PDMSController@printserviceform')
                    ->name('pdms.print.serviceform')
                    ->middleware('checkRole:ROLE_SUPERADMIN|ROLE_PDMS_SERVICE');


               Route::get('/indexbyname/{name}/print/service-form', 'PDMSController@printserviceformbyname')
                    ->name('pdms.print.serviceformbyname')
                    ->middleware('checkRole:ROLE_SUPERADMIN|ROLE_PDMS_SERVICE');


               Route::get('/indexbyic/{no_ic}/print/cuti-form', 'PDMSController@printcutiform')
                    ->name('pdms.print.cutiform')
                    ->middleware('checkRole:ROLE_SUPERADMIN|ROLE_PDMS_CUTI');


               Route::get('/indexbyname/{name}/print/cuti-form', 'PDMSController@printcutiformbyname')
                    ->name('pdms.print.cutiformbyname')
                    ->middleware('checkRole:ROLE_SUPERADMIN|ROLE_PDMS_CUTI');


               Route::get('/indexbyic/{no_ic}/editserviceform/{id_rekod}', 'PDMSController@indexeditservice')
                    ->name('pdms.editserviceform')
                    ->middleware('checkRole:ROLE_SUPERADMIN|ROLE_PDMS_SERVICE');
                    

               Route::get('/serviceindexbyic/{no_ic}/editserviceform/{id_rekod}', 'PDMSController@serviceindexeditservice')
                    ->name('pdms.serviceeditserviceform')
                    ->middleware('checkRole:ROLE_SUPERADMIN|ROLE_PDMS_SERVICE');


               Route::get('/indexbyic/{no_ic}/createleaveform', 'PDMSController@indexcreateleave')
                    ->name('pdms.createleaveform')
                    ->middleware('checkRole:ROLE_SUPERADMIN|ROLE_PDMS_CUTI');


               Route::get('/cutiindexbyic/{no_ic}/createleaveform', 'PDMSController@cutiindexcreateleave')
                    ->name('pdms.cuticreateleaveform')
                    ->middleware('checkRole:ROLE_SUPERADMIN|ROLE_PDMS_CUTI');


               Route::get('/indexbyic/{no_ic}/editleaveform/{id_rekod}', 'PDMSController@indexeditleave')
                    ->name('pdms.editleaveform')
                    ->middleware('checkRole:ROLE_SUPERADMIN|ROLE_PDMS_CUTI');


               Route::get('/cutiindexbyic/{no_ic}/editleaveform/{id_rekod}', 'PDMSController@cutiindexeditleave')
                    ->name('pdms.cutieditleaveform')
                    ->middleware('checkRole:ROLE_SUPERADMIN|ROLE_PDMS_CUTI');


               Route::get('/indexbyic/{no_ic}/createstatementform', 'PDMSController@indexcreatestatement')
                    ->name('pdms.createstatementform')
                    ->middleware('checkRole:ROLE_SUPERADMIN|ROLE_PDMS_ADMIN');


               Route::get('/indexbyic/{no_ic}/editstatementform', 'PDMSController@indexeditstatement')
                    ->name('pdms.editstatementform')
                    ->middleware('checkRole:ROLE_SUPERADMIN|ROLE_PDMS_ADMIN');


               //Function with variables
                //Profile
               Route::post('/indexbyic/{no_ic}/editserviceform/update', 'PDMSController@updateprofileform')
                    ->name('pdms.updateprofileform')
                    ->middleware('checkRole:ROLE_SUPERADMIN|ROLE_PDMS_ADMIN|ROLE_PDMS_SERVICE');

               
               Route::post('/indexbyname/{name}/editserviceform/update', 'PDMSController@updateprofileformbyname')
                    ->name('pdms.updateprofileformbyname')
                    ->middleware('checkRole:ROLE_SUPERADMIN|ROLE_PDMS_ADMIN|ROLE_PDMS_SERVICE');

                //Service
               Route::post('/indexbyic/{no_ic}/createserviceform/store', 'PDMSController@storeserviceform')
                    ->name('pdms.storeserviceform')
                    ->middleware('checkRole:ROLE_SUPERADMIN|ROLE_PDMS_ADMIN|ROLE_PDMS_SERVICE');


               Route::post('/serviceindexbyic/{no_ic}/createserviceform/store', 'PDMSController@servicestoreserviceform')
                    ->name('pdms.servicestoreserviceform')
                    ->middleware('checkRole:ROLE_SUPERADMIN|ROLE_PDMS_ADMIN|ROLE_PDMS_SERVICE');


               Route::post('/indexbyic/{no_ic}/editserviceform/{id_rekod}/update', 'PDMSController@updateserviceform')
                    ->name('pdms.updateserviceform')
                    ->middleware('checkRole:ROLE_SUPERADMIN|ROLE_PDMS_ADMIN|ROLE_PDMS_SERVICE');


               Route::post('/serviceindexbyic/{no_ic}/editserviceform/{id_rekod}/update', 'PDMSController@serviceupdateserviceform')
                    ->name('pdms.serviceupdateserviceform')
                    ->middleware('checkRole:ROLE_SUPERADMIN|ROLE_PDMS_ADMIN|ROLE_PDMS_SERVICE');


               Route::delete('/indexbyic/deleterecord/{no_ic}/{id_rekod}', 'PDMSController@destroyservicerecord')
                    ->name('pdms.deleteserviceform')
                    ->middleware('checkRole:ROLE_SUPERADMIN|ROLE_PDMS_ADMIN|ROLE_PDMS_SERVICE');


               Route::delete('/serviceindexbyic/deleterecord/{no_ic}/{id_rekod}', 'PDMSController@servicedestroyservicerecord')
                    ->name('pdms.servicedeleteserviceform')
                    ->middleware('checkRole:ROLE_SUPERADMIN|ROLE_PDMS_ADMIN|ROLE_PDMS_SERVICE');

                //Leave
               Route::post('/indexbyic/{no_ic}/createleaveform/store', 'PDMSController@cutistoreleaveform')
                    ->name('pdms.cutistoreleaveform')
                    ->middleware('checkRole:ROLE_SUPERADMIN|ROLE_PDMS_CUTI');


               Route::post('/cutiindexbyic/{no_ic}/createleaveform/store', 'PDMSController@storeleaveform')
                    ->name('pdms.storeleaveform')
                    ->middleware('checkRole:ROLE_SUPERADMIN|ROLE_PDMS_CUTI');


               Route::post('/indexbyic/{no_ic}/editleaveform/{id_rekod}/update', 'PDMSController@updateleaveform')
                    ->name('pdms.updateleaveform')
                    ->middleware('checkRole:ROLE_SUPERADMIN|ROLE_PDMS_CUTI');


               Route::post('/cutiindexbyic/{no_ic}/editleaveform/{id_rekod}/update', 'PDMSController@cutiupdateleaveform')
                    ->name('pdms.cutiupdateleaveform')
                    ->middleware('checkRole:ROLE_SUPERADMIN|ROLE_PDMS_CUTI');


               Route::delete('/indexbyic/deleteleaveform/{no_ic}/{id_rekod}', 'PDMSController@destroyleaverecord')
                    ->name('pdms.deleteleaveform')
                    ->middleware('checkRole:ROLE_SUPERADMIN|ROLE_PDMS_CUTI');


               Route::delete('/cutiindexbyic/deleteleaveform/{no_ic}/{id_rekod}', 'PDMSController@cutidestroyleaverecord')
                    ->name('pdms.cutideleteleaveform')
                    ->middleware('checkRole:ROLE_SUPERADMIN|ROLE_PDMS_CUTI');

               //Statement
               Route::post('/indexbyic/{no_ic}/createstatementform/store', 'PDMSController@storestatementform')
                    ->name('pdms.storestatementform')
                    ->middleware('checkRole:ROLE_SUPERADMIN|ROLE_PDMS_ADMIN');

               
               Route::post('/indexbyic/{no_ic}/editstatementform/update', 'PDMSController@updatestatementform')
                    ->name('pdms.updatestatementform')
                    ->middleware('checkRole:ROLE_SUPERADMIN|ROLE_PDMS_ADMIN');


               Route::delete('/indexbyic/{no_ic}/deletestatementform', 'PDMSController@destroystatementrecord')
                    ->name('pdms.deletestatementform')
                    ->middleware('checkRole:ROLE_SUPERADMIN|ROLE_PDMS_ADMIN');


               // View All
               Route::delete('/index/viewall/delete/{id}/{no_ic?}', 'PDMSController@destroyprofilerecord')
                    ->name('pdms.deleteprofileform')
                    ->middleware('checkRole:ROLE_SUPERADMIN|ROLE_PDMS_ADMIN');

          });
//PDMS End


//start datakehadiran UPLOADED 16APR24

Route::group(
     [
          'prefix' => 'datakehadiran',
     ],
     function () {

          Route::get('/index', 'DatakehadiranController@index')
          ->name('datakehadiran.datakehadiran.index');

     
          Route::get('/indexadmin', 'DatakehadiranController@indexadmin')
               ->name('datakehadiran.datakehadiran.indexadmin')
               ->middleware('checkRole:ROLE_SUPERADMIN|ROLE_DATAKEHADIRAN');


          Route::get('/indexpegawai', 'DatakehadiranController@indexpegawai')
          ->name('datakehadiran.datakehadiran.indexpegawai')
          ->middleware('checkRole:ROLE_SUPERADMIN|ROLE_DATAKEHADIRAN');


          Route::get('/indexuniform', 'DatakehadiranController@indexuniform')
               ->name('datakehadiran.datakehadiran.indexuniform')
               ->middleware('checkRole:ROLE_SUPERADMIN|ROLE_DATAKEHADIRAN');


          Route::get('/indexhadrah', 'DatakehadiranController@indexhadrah')
               ->name('datakehadiran.datakehadiran.indexhadrah')
               ->middleware('checkRole:ROLE_SUPERADMIN|ROLE_DATAKEHADIRAN');


               Route::get('/indexadminsearch', 'DatakehadiranController@searchdatakehadiran')
               ->name('indexadminsearch')
               ->middleware('checkRole:ROLE_SUPERADMIN|ROLE_DATAKEHADIRAN');


                 Route::get('/indexsearch', 'DatakehadiranController@searchindexdatakehadiran')
               ->name('indexsearch');


          Route::get('/{dk}/editadmin', 'DatakehadiranController@editadmin')
               ->name('datakehadiran.datakehadiran.editadmin')
               ->where('id', '[0-9]+')
               ->middleware('checkRole:ROLE_SUPERADMIN|ROLE_DATAKEHADIRAN');


               
          Route::get('/{dk}/edit', 'DatakehadiranController@edit')
          ->name('datakehadiran.datakehadiran.edit')
          ->where('id', '[0-9]+');

          Route::post('/updateadmin', 'DatakehadiranController@updateadmin')
               ->name('datakehadiran.datakehadiran.updateadmin')
               ->where('id', '[0-9]+');

               Route::post('/update', 'DatakehadiranController@update')
               ->name('datakehadiran.datakehadiran.update')
               ->where('id', '[0-9]+');

          Route::get('/indexlist', 'DatakehadiranController@indexlist')
               ->name('datakehadiran.datakehadiran.indexlist')
               ->middleware('checkRole:ROLE_SUPERADMIN|ROLE_DATAKEHADIRAN');



          Route::get('/{dk}/editlist', 'DatakehadiranController@editlist')
               ->name('datakehadiran.datakehadiran.editlist')
               ->where('id', '[0-9]+')
               ->middleware('checkRole:ROLE_SUPERADMIN|ROLE_DATAKEHADIRAN');


          Route::post('storeicnumber/{id}', 'DatakehadiranController@storeicnumber')
                   ->name('datakehadiran.datakehadiran.storeicnumber')
               ->where('id', '[0-9]+');
               
          Route::get('/updatehadir/{dk}', 'DatakehadiranController@hadir')->name('datakehadiran.datakehadiran.updatehadir');
          Route::get('updatetidakhadir/{dk}', 'DatakehadiranController@tidakhadir')->name('datakehadiran.datakehadiran.updatetidakhadir');

          Route::get('/exportdatakehadiran-to-excel', 'DatakehadiranController@exportdatakehadiranToExcel')->name('exportdatakehadiran.excel');

          Route::get('/exportschoollist-to-excel', 'DatakehadiranController@exportschoolstat')->name('exportschoolstat.excel');


          Route::get('/export-excel-by-school', 'DatakehadiranController@exportExcelBySchool')
                ->name('export.excel.by.school');

          Route::get('/export-excel-by-uniform', 'DatakehadiranController@exportExcelByUniform')
                ->name('export.excel.by.uniform');

                 Route::get('/export-excel-by-hadrah', 'DatakehadiranController@exportExcelByHadrah')
                ->name('export.excel.by.hadrah');

                 Route::get('/export-excel-by-pegawai', 'DatakehadiranController@exportExcelBypegawai')
                ->name('export.excel.by.pegawai');

          Route::get('/createadmin', 'DatakehadiranController@createadmin')
                ->name('datakehadiran.datakehadiran.createadmin')
               ->middleware('checkRole:ROLE_SUPERADMIN|ROLE_DATAKEHADIRAN');


          Route::get('/createuniform', 'DatakehadiranController@createuniform')
                ->name('datakehadiran.datakehadiran.createuniform')
               ->middleware('checkRole:ROLE_SUPERADMIN|ROLE_DATAKEHADIRAN');


          Route::get('/createhadrah', 'DatakehadiranController@createhadrah')
                ->name('datakehadiran.datakehadiran.createhadrah')
               ->middleware('checkRole:ROLE_SUPERADMIN|ROLE_DATAKEHADIRAN');



          Route::post('/storeadmin', 'DatakehadiranController@storecreate')
                ->name('datakehadiran.datakehadiran.storecreate');

          Route::get('/create', 'DatakehadiranController@create')
                ->name('datakehadiran.datakehadiran.create');

          Route::post('/storein', 'DatakehadiranController@storein')
                ->name('datakehadiran.datakehadiran.storein');

          Route::post('/storeuniform', 'DatakehadiranController@storecreateparticipate')
                ->name('datakehadiran.datakehadiran.storecreateparticipate');

          Route::post('/storehadrah', 'DatakehadiranController@storehadrah')
                ->name('datakehadiran.datakehadiran.storehadrah');

          Route::delete('/destroyadminsearch/{id}', 'DatakehadiranController@destroyadminsearch')
                ->name('datakehadiran.datakehadiran.destroyadminsearch')
                ->where('id', '[0-9]+');

          Route::delete('/destroyadmin/{id}', 'DatakehadiranController@destroyadmin')
                ->name('datakehadiran.datakehadiran.destroyadmin')
                ->where('id', '[0-9]+');

           Route::delete('/destroy/{id}', 'DatakehadiranController@destroy')
                ->name('datakehadiran.datakehadiran.destroy')
                ->where('id', '[0-9]+');

          Route::delete('/destroyuniform/{id}', 'DatakehadiranController@destroyuniform')
                ->name('datakehadiran.datakehadiran.destroyuniform')
                ->where('id', '[0-9]+');

          Route::delete('/destroyhadrah/{id}', 'DatakehadiranController@destroyhadrah')
                ->name('datakehadiran.datakehadiran.destroyhadrah')
                ->where('id', '[0-9]+');

      
     }
);
//end datakehadiran

//TaskTracking Start
Route::group(
    [
        'prefix' => 'tasktracking',
    ],
    function () {
            Route::get('/index', 'TaskTrackingController@indextask')
                ->name('tasktracking.indextasktracking');

        //Staff Kod Start
            Route::get('/staffkod', 'TaskTrackingController@staffkod')
                ->name('tasktracking.staffkod');

            Route::post('/staffkod/store', 'TaskTrackingController@storestaffkod')
                ->name('tasktracking.storestaffkod');

            Route::delete('/staffkod/{dis}', 'TaskTrackingController@destroystaffkod')
                ->name('tasktracking.destroystaffkod')
                ->where('id', '[0-9]+');
        //Staff Kod Ends

        //Status Tindakan Start
            Route::get('/statustindakan/index', 'TaskTrackingController@statustindakan')
                ->name('tasktracking.statustindakan');

            Route::post('/statustindakan/storestatus', 'TaskTrackingController@storestatus')
                ->name('tasktracking.storestatus');

            Route::delete('/statustindakan/destroystatus/{ssmsrq}', 'TaskTrackingController@destroystatus')
                ->name('tasktracking.destroystatus')
                ->where('id', '[0-9]+');

            Route::get('/statustindakan/editstatus/{id}', 'TaskTrackingController@editstatus')
                ->name('tasktracking.editstatus');

            Route::post('/statustindakan/editstatus/update', 'TaskTrackingController@updatestatus')
                ->name('tasktracking.updatestatus');

            Route::post('/statustindakan/storetindakan', 'TaskTrackingController@storetindakan')
                ->name('tasktracking.storetindakan');

            Route::delete('/statustindakan/destroytindakan/{ssmsrq}', 'TaskTrackingController@destroytindakan')
                ->name('tasktracking.destroytindakan')
                ->where('id', '[0-9]+');

            Route::get('/statustindakan/edittindakan/{id}', 'TaskTrackingController@edittindakan')
                ->name('tasktracking.edittindakan');

            Route::post('/statustindakan/edittindakan/update', 'TaskTrackingController@updatetindakan')
                ->name('tasktracking.updatetindakan');
        //Status Tindakan End

        //Status Update Start
            Route::post('/updatetaskstatus', 'TaskTrackingController@updatetaskstatus')
                ->name('tasktracking.updatetaskstatus')
                ->where('id', '[0-9]+');
        //Update Status End

        //Create Task Start
            Route::get('/createtask/internal', 'TaskTrackingController@createtaskinternal')
                ->name('tasktracking.createtaskinternal');

            Route::get('/createtask/external', 'TaskTrackingController@createtaskexternal')
                ->name('tasktracking.createtaskexternal');

            Route::post('/store', 'TaskTrackingController@storetask')
                ->name('tasktracking.storetask');
        //Create Task End

        //Edit Task Start
            Route::get('/index/taskgiven/{ref_id}/edit', 'TaskTrackingController@edittaskgiven')
            ->name('tasktracking.edittaskgiven');

            Route::post('/index/taskgiven/{ref_id}/edit/update', 'TaskTrackingController@updatetaskuser')
                    ->name('tasktracking.updatetaskuser');

            Route::get('/index/taskcreated/{id}/edit', 'TaskTrackingController@edittaskcreated')
                    ->name('tasktracking.edittaskcreated');

            Route::post('/index/taskcreated/{id}/edit/update', 'TaskTrackingController@updatetaskcreated')
                    ->name('tasktracking.updatetaskcreated')
                    ->where('id', '[0-9]+');
        //Edit Task End

          //MainTask

          Route::get('/index/taskgiven/{id}/editmain', 'TaskTrackingController@editmaintask')
               ->name('tasktracking.editmaintask');
    });
// TaskTracking End

//Attendance
Route::group(
     [
          'prefix' => 'Attendance',
     ],
     function () {

          //Student View

          Route::get('/Students', 'AttendanceController@indexstudent')
               ->name('attendance.attendances.indexstudent');
               
          Route::get('/Students/create','AttendanceController@formstudent')
               ->name('attendance.attendances.formstudent');
          
          Route::post('/Students/store', 'AttendanceController@storestudent')
               ->name('attendance.attendances.storestudent');

          Route::post('/Students/update', 'AttendanceController@updatestudent')
               ->name('attendance.attendances.updatestudent');
               
          Route::get('/Students/edit{attendsts}', 'AttendanceController@editstudent')
               ->name('attendance.attendances.editstudent')
               ->where('id', '[0-9]+');

          Route::delete('/Students/destroy{attendsts}', 'AttendanceController@destroystudent')
               ->name('attendance.attendances.destroystudent')
               ->where('id', '[0-9]+');

          Route::get('/Students/Result', 'AttendanceController@searchstudent')
               ->name('attendance.attendances.searchstudent');

          //Pengawas View

          Route::get('/Staff', 'AttendanceController@indexstaff')
               ->name('attendance.attendances.indexstaff');
               
          Route::get('/Staff/create','AttendanceController@formstaff')
               ->name('attendance.attendances.formstaff');
          
          Route::post('/Staff/store', 'AttendanceController@storestaff')
               ->name('attendance.attendances.storestaff');

          Route::post('/Staff/update', 'AttendanceController@updatestaff')
               ->name('attendance.attendances.updatestaff');
               
          Route::get('/Staff/edit{attendsfs}', 'AttendanceController@editstaff')
               ->name('attendance.attendances.editstaff')
               ->where('id', '[0-9]+');

          Route::delete('/Staff/destroy{attendsfs}', 'AttendanceController@destroystaff')
               ->name('attendance.attendances.destroystaff')
               ->where('id', '[0-9]+');

          Route::get('/Staff/Result', 'AttendanceController@searchstaff')
               ->name('attendance.attendances.searchstaff');

          //Event View

          Route::get('/Event', 'AttendanceController@indexevent')
               ->name('attendance.attendances.indexevent');
          
          Route::post('/Event/store', 'AttendanceController@storeevent')
               ->name('attendance.attendances.storeevent');

          Route::delete('/Event/destroy{events}', 'AttendanceController@destroyevent')
               ->name('attendance.attendances.destroyevent')
               ->where('id', '[0-9]+');

          Route::get('/Event/download-qr-code-pdf/{id}', 'AttendanceController@downloadQrCodePdf')
               ->name('downloadQrCodePdfEvent');

          Route::get('/Event/Chosen{events}', 'AttendanceController@indexchosen')
               ->name('attendance.attendances.indexchosen');
     
          Route::get('/Event/Chosen/export-to-excel{id}', 'AttendanceController@exportToExcel')
               ->name('attendance.export.excel');

          Route::get('/Event/Chosen/Add{events}', 'AttendanceController@formchosen')
               ->name('attendance.attendances.formchosen');

          Route::post('/Event/Chosen/AddUser', 'AttendanceController@formchosenstore')
               ->name('attendance.attendances.formchosenstore');
               
          Route::delete('/Event/Chosen/destroy{attendusers}', 'AttendanceController@destroychosen')
               ->name('attendance.attendances.destroychosen')
               ->where('id', '[0-9]+');

          Route::get('/Event/SearchChosen', 'AttendanceController@searchchosen')
               ->name('attendance.attendances.searchchosen');

          Route::get('/Event/Chosen/Candidate/{id}', 'AttendanceController@editchosen')
               ->name('attendance.attendances.editchosen');

          Route::post('/Event/Chosen/Candidate/Update', 'AttendanceController@updatechosen')
               ->name('attendance.attendances.updatechosen');
          //Public Link View

          Route::post('/GeneralResult/Login', 'AttendanceController@generallogin')
               ->name('attendance.attendances.generallogin');

          Route::get('/GeneralSearch', 'AttendanceController@generalsearch')
               ->name('attendance.attendances.generalsearch');

          Route::post('/GeneralResult', 'AttendanceController@generalresult')
               ->name('attendance.attendances.generalresult');

          Route::post('/GeneralResult/Hadir', 'AttendanceController@hadirupdate')
               ->name('attendance.attendances.hadirupdate');

          Route::post('/GeneralResult/HadirRefresh', 'AttendanceController@hadirrefresh')
               ->name('attendance.attendances.hadirrefresh');

          Route::get('/GeneralResult/searchlist', 'AttendanceController@searchlist')
               ->name('attendance.attendances.searchlist');

          //LAPORAN
          Route::get('/Public/Laporan/{encryptedPart}', 'AttendanceController@laporan')
               ->name('attendance.attendances.laporan');

          Route::get('/Public/Laporan/Event/{name}', 'AttendanceController@laporanevent')
               ->name('attendance.attendances.laporanevent');

          Route::get('/Public/Laporan/EventDynamic/{name}', 'AttendanceController@dynamiclaporanevent')
               ->name('attendance.attendances.dynamiclaporanevent');

          //QR CODE

          Route::get('//{name}', 'AttendanceController@qrcodeevent')
               ->name('attendance.attendances.qrcodeevent');

          Route::post('/StoreData', 'AttendanceController@qrcodeeventstore')
               ->name('attendance.attendances.qrcodeeventstore');          
               
     }
);

//HRMD (RR)

//SSM Penilai Page
Route::group(
     [
          'prefix' => 'ssmspenilai',
     ],
     function () {

          Route::get('/', 'SsmPenilaiController@index')
               ->name('ssms.penilai.index')
               ->middleware('checkRole:ROLE_SSM|ROLE_SUPERADMIN|ROLE_SUPERADMIN');


          Route::get('/form', 'SsmPenilaiController@form')
               ->name('ssms.penilai.create');

          Route::post('/form/store', 'SsmPenilaiController@store')
               ->name('ssms.penilai.store');

          Route::post('/form/status', 'SsmPenilaiController@status')
               ->name('ssms.penilai.status');

          Route::post('/{id}/update', 'SsmPenilaiController@update')
               ->name('ssms.penilai.update')
               ->where('id', '[0-9]+');
     }
);

//Baki Cuti
Route::group(
     [
          'prefix' => 'BakiCuti',
     ],
     function () {

          //Student View

          Route::get('/Index', 'BakiCutiController@index')
               ->name('bakicuti.bakicutis.index');
               
          Route::get('/form','BakiCutiController@form')
               ->name('bakicuti.bakicutis.form');
          
          Route::post('/store', 'BakiCutiController@store')
               ->name('bakicuti.bakicutis.store');

          Route::post('/update', 'BakiCutiController@update')
               ->name('bakicuti.bakicutis.update');
               
          Route::get('/view{bcs}', 'BakiCutiController@view')
               ->name('bakicuti.bakicutis.view')
               ->where('id', '[0-9]+');

          Route::delete('/destroy{bcs}', 'BakiCutiController@destroy')
               ->name('bakicuti.bakicutis.destroy')
               ->where('id', '[0-9]+');

          Route::get('/Admin', 'BakiCutiController@indexadmin')
               ->name('bakicuti.bakicutis.indexadmin')
               ->middleware('checkRole:ROLE_SUPERADMIN|ROLE_BAKI_CUTI');

          
          Route::post('/Admin/updateadmin', 'BakiCutiController@updateadmin')
               ->name('bakicuti.bakicutis.updateadmin');     
     }
);

//Personnel ID

Route::group(
     [
          'prefix' => 'PersonnelID',
     ],
     function () {

          //Student View

          Route::get('/', 'PersonnelIDController@index')
          ->name('personnelid.personnelids.index')
          ->middleware('checkRole:ROLE_SUPERADMIN');

               
          Route::get('/Search','PersonnelIDController@searchpersonnel')
               ->name('personnelid.personnelids.search');

          Route::post('/Update','PersonnelIDController@update')
               ->name('personnelid.personnelids.update');
     }
);

//12.09.2024 EJ - Register Verify
// event registration form
Route::get('/registerlink', 'RegisterVerifyController@registerlink')
    ->name('registerform')
    ->withoutMiddleware(['auth']);

Route::get('/approververify/{encryptedId}', 'RegisterVerifyController@approveverify')
    ->name('approververify');

    Route::get('/meshverify/{encryptedId}', 'UsersController@approvedbymesh')
    ->name('meshverify')
    ->withoutMiddleware(['auth']);

Route::group(
     [
     'prefix' => 'registerlink',
     ], function () {

         Route::post('/store', 'RegisterVerifyController@store')
                     ->name('registerverify.registerverify.store');

         Route::post('/update', 'RegisterVerifyController@update')
                     ->name('registerverify.registerverify.update')
                     ->where('id', '[0-9]+');

                 });

//   21.11.2024 Ekma
// new reset password
Route::get('/resetpassword', 'ResetpasswordController@resetpassword')
->name('resetpassword');

Route::get('/confirmpassword/{encryptedId}', 'ResetpasswordController@confirmpassword')
->name('confirmpassword')
->where('id', '[0-9]+');


Route::group(
     [
     'prefix' => 'resetpassword',
     ], function () {

         Route::post('/sendlink', 'ResetpasswordController@sendlink')
                     ->name('resetpassword.resetpassword.sendlink');

        Route::post('/updatepassword', 'ResetpasswordController@updateconfirmpassword')
                     ->name('resetpassword.resetpassword.updateconfirmpassword');

       
                 });
// end reset password


// start perumahan live nov25
Route::group(
     [
          'prefix' => 'daperumahan',
     ],
     function () {

          Route::get('/indexpenghuni', 'DAPerumahanController@indexpenghuni')
          ->name('daperumahan.daperumahan.indexpenghuni');

          Route::get('/editpenghuni/{id}', 'DAPerumahanController@editpenghuni')
          ->name('daperumahan.daperumahan.editpenghuni')->where('id', '[0-9]+');

          Route::put('/updatepenghuni/{dapenghuni}', 'DAPerumahanController@updatepenghuni')
          ->name('daperumahan.daperumahan.updatepenghuni');

          Route::get('/indexpemilik', 'DAPerumahanController@indexpemilik')
          ->name('daperumahan.daperumahan.indexpemilik');

          Route::get('/createpemilik', 'DAPerumahanController@createpemilik')
          ->name('daperumahan.daperumahan.createpemilik');

          Route::post('/storepemilik', 'DAPerumahanController@storepemilik')
          ->name('daperumahan.daperumahan.storepemilik');

          Route::get('/showpemilik/{id}', 'DAPerumahanController@showpemilik')
          ->name('daperumahan.daperumahan.showpemilik');

          Route::get('/editpemilik/{id}', 'DAPerumahanController@editpemilik')
          ->name('daperumahan.daperumahan.editpemilik')->where('id', '[0-9]+');

          Route::put('/updatepemilik/{dapemilik}', 'DAPerumahanController@updatepemilik')
          ->name('daperumahan.daperumahan.updatepemilik');

          Route::get('/indexiq', 'DAPerumahanController@indexiq')
          ->name('daperumahan.daperumahan.indexiq');

          Route::get('/editiq/{id}', 'DAPerumahanController@editiq')
          ->name('daperumahan.daperumahan.editiq')->where('id', '[0-9]+');

          Route::put('/updateiq/{daiq}', 'DAPerumahanController@updateiq')
          ->name('daperumahan.daperumahan.updateiq');

          Route::get('/indexpenghuniiq', 'DAPerumahanController@indexpenghuniiq')
          ->name('daperumahan.daperumahan.indexpenghuniiq');

          Route::get('/editpenghuniiq/{id}', 'DAPerumahanController@editpenghuniiq')
          ->name('daperumahan.daperumahan.editpenghuniiq')->where('id', '[0-9]+');

          Route::put('/updatepenghuniiq/{dapenghuniiq}', 'DAPerumahanController@updatepenghuniiq')
          ->name('daperumahan.daperumahan.updatepenghuniiq');
     
          Route::get('/indexmenunggu', 'DAPerumahanController@indexmenunggu')
          ->name('daperumahan.daperumahan.indexmenunggu');

          Route::get('/indexperumahan', 'DAPerumahanController@indexperumahan')
          ->name('daperumahan.daperumahan.indexperumahan');

          Route::get('/indexrsbaharu', 'DAPerumahanController@indexrsbaharu')
          ->name('daperumahan.daperumahan.indexrsbaharu');

          Route::get('/indexrskosong', 'DAPerumahanController@indexrskosong')
          ->name('daperumahan.daperumahan.indexrskosong');

          Route::get('/indexiqkosong', 'DAPerumahanController@indexiqkosong')
          ->name('daperumahan.daperumahan.indexiqkosong');

          Route::get('/indexarkib', 'DAPerumahanController@indexarkib')
          ->name('daperumahan.daperumahan.indexarkib');

          Route::get('/createmenunggu', 'DAPerumahanController@createmenunggu')
          ->name('daperumahan.daperumahan.createmenunggu');

          Route::post('/storemenunggu', 'DAPerumahanController@storemenunggu')
          ->name('daperumahan.daperumahan.storemenunggu');

          Route::get('/editmenunggu/{id}', 'DAPerumahanController@editmenunggu')
          ->name('daperumahan.daperumahan.editmenunggu')->where('id', '[0-9]+');

          Route::put('/updatemenunggu/{damenunggu}', 'DAPerumahanController@updatemenunggu')
          ->name('daperumahan.daperumahan.updatemenunggu');

     // Status Rumah Routes Start
     Route::get('/status-rumah', 'StatusRumahController@index')->name('status.index');
     Route::post('/status-rumah', 'StatusRumahController@store')->name('status.store');
     Route::delete('/status-rumah/{id}', 'StatusRumahController@destroy')->name('status.destroy');
     // Status Rumah Routes End



          }
     );

// end perumahan live nov25

// Combined Report Dashboard (Recommended - All 6 diagrams on one page)
Route::get('/reports/staff-dashboard', [StaffReportController::class, 'combinedReport'])
    ->name('reports.combinedReport');
// --------------------------------------------
// Pemegang Jawatan (PJ) Routes
// --------------------------------------------
Route::prefix('pemegang-jawatan')->name('pj.')->group(function () {
     
     // Landing page
     Route::get('/HRIDS-landing-page', [PemegangJawatanController::class, 'landingpage'])
     ->middleware(['auth','role:ROLE_HRIDS,ROLE_SUPERADMIN'])
     ->name('landingpage');
     
     // Main index
     Route::get('/', [PemegangJawatanController::class, 'index'])->name('index');
     
     // Export routes
     Route::get('/teachers/export', [TeacherController::class, 'export'])->name('teachers.export');
     Route::get('/spj/export', [PemegangJawatanController::class, 'export'])->name('spj.export');
     
     // Staff lists
     Route::get('/teaching', [PemegangJawatanController::class, 'teachingList'])->name('teaching.list');
     Route::get('/non-teaching', [PemegangJawatanController::class, 'index'])->name('show.list');
     
     // --------------------------------------------
     // Teaching Staff Routes
     // --------------------------------------------
     Route::prefix('teaching')->name('teaching.')->group(function () {
         // Show teaching profile
         Route::get('/showTeaching/{ic}', [PemegangJawatanController::class, 'showTeaching'])
             ->where('ic', '.*')
             ->name('show');
         
         // Teaching Jawatan
         Route::get('/jawatan', [PemegangJawatanController::class, 'indexJawatan'])->name('jawatan');
     });
     
     // --------------------------------------------
     // Non-Teaching Staff Routes
     // --------------------------------------------
     Route::prefix('non-teaching')->name('nonteaching.')->group(function () {
         
         // ==========================================
         // NEW: Non-Teaching Jawatan Management Routes
         // ==========================================
         
         // Main jawatan listing page
         Route::get('/jawatan', [PemegangJawatanController::class, 'indexJawatan'])
             ->name('jawatan');
         
         // Status Jawatan - Lama Report
         Route::get('/jawatan/status-lama', [PemegangJawatanController::class, 'statusJawatanLama'])
             ->name('jawatan.status.lama');
         
         // Create new jawatan record (show form)
         Route::get('/jawatan/create', [PemegangJawatanController::class, 'createJawatanRecord'])
             ->name('jawatan.create');
         
         // Store new jawatan record
         Route::post('/jawatan/create', [PemegangJawatanController::class, 'storeJawatanRecord'])
             ->name('jawatan.store.record');
         
         // Edit jawatan record (show form)
         Route::get('/jawatan/edit/{kod_jawatan}', [PemegangJawatanController::class, 'editJawatanRecord'])
             ->name('jawatan.edit');
         
         // Update jawatan record
         Route::put('/jawatan/update/{kod_jawatan}', [PemegangJawatanController::class, 'updateJawatanRecord'])
             ->name('jawatan.update');
         
         // Delete entire jawatan record
         Route::delete('/jawatan/delete/record/{kod_jawatan}', [PemegangJawatanController::class, 'deleteJawatanRecord'])
             ->name('jawatan.delete.record');
         
         // Store new staff entries (add staff to jawatan)
         Route::post('/jawatan/store', [PemegangJawatanController::class, 'storeJawatanStaff'])
             ->name('jawatan.store');
         
         // Delete staff from jawatan
         Route::delete('/jawatan/delete/{id}', [PemegangJawatanController::class, 'deleteJawatanStaff'])
             ->name('jawatan.delete');
         
         // ==========================================
         // End of New Jawatan Routes
         // ==========================================
     });
     
     // Show non-teaching profile
     Route::get('/show/{id}', [PemegangJawatanController::class, 'show'])->name('show');
     
     // Non-teaching save routes
     Route::put('/{id}/save-peribadi', [PemegangJawatanController::class, 'savePeribadi'])->name('save.peribadi');
     Route::put('/{id}/save-pekerjaan', [PemegangJawatanController::class, 'savePekerjaan'])->name('save.pekerjaan');
     Route::put('/{id}/save-jawatan', [PemegangJawatanController::class, 'saveJawatan'])->name('save.jawatan');
     Route::put('/{id}/save-melapor', [PemegangJawatanController::class, 'saveMelapor'])->name('save.melapor');
     Route::put('/{id}/save-kelulusan', [PemegangJawatanController::class, 'saveKelulusan'])->name('save.kelulusan');
     Route::put('/{id}/save-budget', [PemegangJawatanController::class, 'saveBudget'])->name('save.budget');
     Route::put('/{id}/save-kenaikan', [PemegangJawatanController::class, 'saveKenaikan'])->name('save.kenaikan');
     Route::put('/{id}/save-cuti', [PemegangJawatanController::class, 'saveCuti'])->name('save.cuti');
     Route::put('/{id}/save-bersara', [PemegangJawatanController::class, 'saveBersara'])->name('save.bersara');
     Route::put('/{id}/save-spg', [PemegangJawatanController::class, 'saveSPG'])->name('save.spg');
     Route::post('/{id}/save-prestasi', [PemegangJawatanController::class, 'savePrestasi'])->name('save.prestasi');
     Route::post('/{id}/save-anugerah', [PemegangJawatanController::class, 'saveAnugerah'])->name('save.anugerah');
     
     // Kursus routes
     Route::post('/kursus/store/{id}', [PemegangJawatanController::class, 'store'])->name('kursus.store');
     Route::delete('/{id}/kursus/delete', [PemegangJawatanController::class, 'destroy'])->name('kursus.destroy');
 });
 
 // --------------------------------------------
 // Teacher-specific Routes (using noKadPintar)
 // --------------------------------------------
 Route::prefix('teacher')->name('pj.')->group(function () {
     Route::put('/{noKadPintar}/save-profile', [TeacherController::class, 'saveProfile'])->name('saveProfile');
     Route::put('/{noKadPintar}/save-peribadi', [TeacherController::class, 'savePeribadiTeach'])->name('savePeribadiTeach');
     Route::put('/{noKadPintar}/save-prestasi-gaji', [TeacherController::class, 'savePrestasiGaji'])->name('savePrestasiGaji');
     Route::put('/{noKadPintar}/save-cuti', [TeacherController::class, 'saveCuti'])->name('saveCuti');
     Route::put('/{noKadPintar}/save-penyambungan', [TeacherController::class, 'savePenyambungan'])->name('savePenyambungan');
     Route::put('/{noKadPintar}/save-tempat-bertugas', [TeacherController::class, 'saveTempatBertugas'])->name('saveTempatBertugas');
     Route::put('/{noKadPintar}/save-kursus', [TeacherController::class, 'saveKursus'])->name('saveKursus');
     Route::put('/{noKadPintar}/save-kelulusan', [TeacherController::class, 'saveKelulusan'])->name('saveKelulusan');
     Route::put('/{noKadPintar}/save-history-jawatan', [TeacherController::class, 'saveHistoryJawatan'])->name('saveHistoryJawatan');
     Route::put('/{noKadPintar}/save-bersara', [TeacherController::class, 'saveBersara'])->name('saveBersara');
     Route::put('/{noKadPintar}/save-lain-lain-hal', [TeacherController::class, 'saveLainLainHal'])->name('saveLainLainHal');
 });

 // --------------------------------------------
 // Prestasi Route (standalone)
 // --------------------------------------------
 Route::post('/prestasi/save', [PemegangJawatanController::class, 'savePrestasi'])->name('prestasi.save');
 
// --------------------------------------------
// Jawatan Routes
// --------------------------------------------
// Status Jawatan Routes

// Redirect old URL to new create route
Route::get('/jawatan/status-jawatan/create', function () {
     return redirect()->route('status-jawatan.create');
 })->name('status-jawatan.old-create'); // ✅ Changed name to avoid conflict
 
 // Show create form (blank form for new record)
 Route::get('/status-jawatan/create', [StatusJawatanController::class, 'create'])
     ->name('status-jawatan.create');
 
 // Route to show a specific record by Kod_Jawatan
 Route::get('/status-jawatan/{kod_jawatan?}', [StatusJawatanController::class, 'show'])
     ->name('status-jawatan.show');
 
 // Route to update a record
 Route::put('/status-jawatan/{kod_jawatan}', [StatusJawatanController::class, 'update'])
     ->name('status-jawatan.update');
 
 // Route to store a new record
 Route::post('/status-jawatan', [StatusJawatanController::class, 'store'])
     ->name('status-jawatan.store');
 
 // Delete record
 Route::delete('/status-jawatan/{kod_jawatan}', [StatusJawatanController::class, 'destroy'])
     ->name('status-jawatan.destroy');
 
 // Route for search functionality
 Route::get('/status-jawatan-search', [StatusJawatanController::class, 'search'])
     ->name('status-jawatan.search');
 
 // Status Jawatan Routes End

 Route::group(
     [
          'prefix' => 'spis',
     ],
     function () {

          Route::get('/', 'SPISController@index')
          ->name('spis.index');

          Route::get('/pelan', 'SPISController@indexPelan')
          ->name('spis.pelan.index');

          Route::get('/kpi/create', 'SPISController@create')
          ->name('kpi.create');

          Route::get('/kpi/{id}/edit', 'SPISController@edit')
          ->name('kpi.edit');

          Route::put('/kpi/{id}', 'SPISController@update')
          ->name('kpi.update');

          Route::delete('/kpi/{id}', 'SPISController@destroy')
          ->name('kpi.destroy');

          Route::post('/kpi/store', 'SPISController@store')
          ->name('kpi.store');

          Route::post('/kpi/{id}/submit', 'SPISController@submit')
          ->name('kpi.submit');

          Route::post('/kpi/{id}/approve', 'SPISController@approve')
          ->name('kpi.approve');

          Route::post('/kpi/{id}/reject', 'SPISController@reject')
          ->name('kpi.reject');

          Route::get('/admin/kpis', 'SPISController@indexAdmin')
          ->name('kpi.admin');

          Route::get('/kpi/{id}/edit-approved', 'SPISController@editApproved')
          ->name('kpi.edit.approved');

          Route::put('/kpi/{id}', 'SPISController@updateApproved')
          ->name('kpi.update');
     }
     );
            
// Linkup 14/10/2023 Zharif | MAKE SURE THIS IS PLACED AT THE BOTTOM OF THE PAGE
     Route::group(
          [
               'prefix' => 'moelink',
          ],
          function () {
               Route::get('/index', 'LinkupController@index')
                    ->name('linkup.index');

                    Route::get('/indexsadmin', 'LinkupController@indexsadmin')
                    ->name('linkup.indexsadmin');

               Route::post('/store', 'LinkupController@store')
                    ->name('linkup.store');

               Route::delete('{linkup}/delete', 'LinkupController@destroy')
                    ->name('linkup.destroy')
                    ->where('id', '[0-9]+');
          });
               Route::get('/{filename}', 'LinkupController@serveFile')
                    ->where('filename', '.*')
                    ->name('linkup.serve');
//Linkup Ends | MAKE SURE THIS IS PLACED AT THE BOTTOM OF THE PAGE
