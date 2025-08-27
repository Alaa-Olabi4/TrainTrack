<?php

use App\Http\Controllers\ReportController;
use Illuminate\Support\Facades\Route;
use App\Events\SendNotification;
use OpenSpout\Common\Entity\Style\Border;
use OpenSpout\Common\Entity\Style\BorderPart;
use Rap2hpoutre\FastExcel\FastExcel;
use OpenSpout\Common\Entity\Style\Style;
use App\Models\Report;
use Illuminate\Support\Facades\Request;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    // return view('welcome');
    return view('apidocs');
});

Route::get('/apidocs', function () {
    return view('apidocs');
});

Route::get('test', function () {

    // $pusher = new Pusher\Pusher(
    //     "7e128d7214eddf18c6d0",
    //     "36b32569fb0299435f99",
    //     "1442095",
    //     array('cluster' => 'ap2')
    // );

    // $pusher->trigger('user-3', 'my-event', array('message' => 'hello Nour'));
    // // $pusher->trigger('my-channel', 'my-event', array('message' => 'hello world!!'));

    // // event(new SendNotification(3, "test"));
    // return response()->json(['message' => 'Notification has been sent successfully !']);

    // dd("test");
    $code = "7105";
    return view('emails.forget', compact('code'));
    // return response()->json(['message'=>'Welcome Alaa !']);
});

Route::get('notification', function () {
    return view('notification');
});

Route::get('SystemReport', [ReportController::class, 'SystemReportExcel']);

Route::get('new', function () {
    return view('emails.newInquiry')->with(['inquiryUrl' => 'www']);
});
Route::get('reminder', function () {
    return view('emails.reminder')->with(['inquiryUrl' => 'www']);
});
Route::get('replied', function () {
    return view('emails.repliedInquiry')->with(['inquiryUrl' => 'www']);
});
Route::get('submit', function () {
    return view('emails.submitInquiry')->with(['inquiryUrl' => 'www']);
});



// Route::get('excel', function () {

//     // dd('test');
//     // $request = Request(['start_date' => '2025-08-01', 'end_date' => '2025-08-31']);
//     $request = Request();
//     // $request->merge(['start_date' => '2025-08-01', 'end_date' => '2025-08-31']);
//     // dd($request);
//     // $data = ReportController::SystemReport($request);
//     // $data = ReportController::categoryReport($request);
//     // $data = json_decode(ReportController::SystemReport($request));
//     // dd($data);
//     // $data = [$data];
//     // dd($data);


//     $border = new Border(new BorderPart('left'), new BorderPart('right'), new BorderPart('top'), new BorderPart('bottom'));

//     $header_style = (new Style())
//         ->setFontSize(15)
//         ->setShouldWrapText()

//         ->setCellAlignment('center')
//         ->setCellVerticalAlignment('center')

//         ->setBorder($border)

//         ->setFontBold()
//         ->setBackgroundColor("EDEDED");


//     $rows_style = (new Style())
//         ->setFontSize(15)
//         ->setShouldWrapText()

//         ->setCellAlignment('center')
//         ->setCellVerticalAlignment('center')

//         ->setBorder($border);

//     // Report::create([
//     //     'created_by' => auth()->user()->id,
//     //     'type' => 'SystemReport',
//     //     'content' => 'SystemReport'
//     // ]);


//     // return (new FastExcel($data))
//     //     ->headerStyle($header_style)
//     //     ->rowsStyle($rows_style)
//     //     ->download(time() . 'categoryReport.xlsx', function ($val) {
//     //     // ->download(time() . 'systemReport.xlsx', function ($val) {
//     //         return [

//     //             'category_id'        => $val['category_id'],
//     //             'category_name'      => $val['category_name'],
//     //             'total_inquiries'    => $val['total_inquiries'],
//     //             'opened_inquiries'   => $val['opened_inquiries'],
//     //             'closed_inquiries'   => $val['closed_inquiries'],
//     //             'pending_inquiries'  => $val['pending_inquiries'],
//     //             'reopened_inquiries' => $val['reopened_inquiries'],
//     //             'avg_closing'        => $val['avg_closing'],


//     //             // "users_count" => $val['users_count'],
//     //             // "active_users_count" => $val['active_users_count'],
//     //             // "trainers_count" => $val['trainers_count'],
//     //             // "active_trainers_count" => $val['active_trainers_count'],
//     //             // "sections_count" => $val['sections_count'],
//     //             // "categories_count" => $val['categories_count'],
//     //             // "inquiries_count" => $val['inquiries_count'],
//     //             // "closed_inquiries_count" => $val['closed_inquiries_count'],
//     //             // "opened_inquiries_count" => $val['opened_inquiries_count'],
//     //             // "pending_inquiries_count" => $val['pending_inquiries_count'],
//     //             // "reopened_inquiries_count" => $val['reopened_inquiries_count'],
//     //             // "avg_closing" => $val['avg_closing'],
//     //         ];
//     //     });
// });

// Route::get('excell', function () {
//     $request = Request();
//     $request->merge(['start_date'=>'2025-08-01','end_date'=>'2025-08-31']);
//     $data = json_decode(ReportController::SystemReport($request)->content());

//     $border = new Border(new BorderPart('left'), new BorderPart('right'), new BorderPart('top'), new BorderPart('bottom'));

//     $header_style = (new Style())
//         ->setFontSize(15)
//         ->setShouldWrapText()

//         ->setCellAlignment('center')
//         ->setCellVerticalAlignment('center')

//         ->setBorder($border)

//         ->setFontBold()
//         ->setBackgroundColor("EDEDED");


//     $rows_style = (new Style())
//         ->setFontSize(15)
//         ->setShouldWrapText()

//         ->setCellAlignment('center')
//         ->setCellVerticalAlignment('center')

//         ->setBorder($border);

//     // Report::create([
//     //     'created_by' => auth()->user()->id,
//     //     'type' => 'SystemReport',
//     //     'content' => 'SystemReport'
//     // ]);


//     return (new FastExcel([$data]))
//         ->headerStyle($header_style)
//         ->rowsStyle($rows_style)
//         ->download(time() . 'systemReport.xlsx', function ($val) {
//             return [
//                 "users_count" => $val->users_count,
//                 "active_users_count" => $val->active_users_count,
//                 "trainers_count" => $val->trainers_count,
//                 "active_trainers_count" => $val->active_trainers_count,
//                 "sections_count" => $val->sections_count,
//                 "categories_count" => $val->categories_count,
//                 "inquiries_count" => $val->inquiries_count,
//                 "closed_inquiries_count" => $val->closed_inquiries_count,
//                 "opened_inquiries_count" => $val->opened_inquiries_count,
//                 "pending_inquiries_count" => $val->pending_inquiries_count,
//                 "reopened_inquiries_count" => $val->reopened_inquiries_count,
//                 "avg_closing" => $val->avg_closing,
//             ];
//         });
// });
