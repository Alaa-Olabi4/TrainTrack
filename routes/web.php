<?php

use App\Http\Controllers\ReportController;
use Illuminate\Support\Facades\Route;
use App\Events\SendNotification;

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
    return view('emails.forget',compact('code'));
    // return response()->json(['message'=>'Welcome Alaa !']);
});

Route::get('notification', function () {
    return view('notification');
});

Route::post('SystemReport', [ReportController::class, 'SystemReport']);

Route::get('new',function(){
    return view('emails.newInquiry')->with(['inquiryUrl'=>'www']);
});
Route::get('reminder',function(){
    return view('emails.reminder')->with(['inquiryUrl'=>'www']);
});
Route::get('replied',function(){
    return view('emails.repliedInquiry')->with(['inquiryUrl'=>'www']);
});
Route::get('submit',function(){
    return view('emails.submitInquiry')->with(['inquiryUrl'=>'www']);
});