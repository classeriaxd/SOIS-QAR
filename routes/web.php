<?php

use Illuminate\Support\Facades\Route;

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
// NOTES 
// GET BEFORE POST

Route::get('/', function () {
    return view('welcome');
});
// halep me organize this shit ples
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('auth');

// Bloodhound Routes (TypeAheadJS)
    Route::get('/e/find{event?}', [App\Http\Controllers\EventsController::class, 'findEvent']);

// User Notification Routes
    Route::post('/u/notification/{notification_id}', [App\Http\Controllers\NotificationsController::class, 'markAsRead'])->where(['notification_id' => '^[0-9]*$'])->middleware('auth');
    Route::post('/u/notifications/all', [App\Http\Controllers\NotificationsController::class, 'markAllAsRead'])->middleware('auth')->name('notifications.markAllAsRead');
    Route::get('/u/notifications', [App\Http\Controllers\NotificationsController::class, 'show'])->middleware('auth')->name('notifications.show');

// EVENT DOCUMENT UPLOADS
    Route::delete('/e/documents/upload/revert', [App\Http\Controllers\EventDocumentsController::class, 'undoUpload'])->middleware('auth');
    Route::post('/e/documents/upload', [App\Http\Controllers\EventDocumentsController::class, 'upload'])->middleware('auth');

// Accomplishment Reports
    Route::group(['middleware' => 'auth'], function () {
        // Show and Review of Accomplishment report
        Route::group([
                'as' => 'accomplishmentReport.',
                'prefix' => '/e/report/{accomplishmentReportUUID}',
                'where' => ['accomplishmentReportUUID' => '^[a-zA-Z0-9-]{36}$'],
            ], 
            function () {
                Route::post('/review/finalize', [App\Http\Controllers\AccomplishmentReportsController::class, 'finalizeReview'])->name('finalizeReview');
                Route::get('/review', [App\Http\Controllers\AccomplishmentReportsController::class, 'review'])->name('review');
                Route::get('/{newAccomplishmentReport?}', [App\Http\Controllers\AccomplishmentReportsController::class, 'show'])->name('show');
            }
        );
        // Accomplishment Reports
        Route::group([
                'as' => 'accomplishmentreports.',
                'prefix' => '/e/reports'], 
            function () {
                Route::post('/create/finalize', [App\Http\Controllers\AccomplishmentReportsController::class, 'finalizeReport'])->name('finalizeReport');
                Route::post('/create/checklist', [App\Http\Controllers\AccomplishmentReportsController::class, 'showChecklist'])->name('showChecklist');
                Route::get('/create', [App\Http\Controllers\AccomplishmentReportsController::class, 'create'])->name('create');
                Route::get('', [App\Http\Controllers\AccomplishmentReportsController::class, 'index'])->name('index');

                // Fallback for POST-only Routes
                Route::any('/create/checklist', function () {
                    abort(404);
                });
                Route::any('/create/finalize', function () {
                    abort(404);
                });
            }
        );
    });
    
    


// Events
    Route::group(['middleware' => 'auth'], function () {
        // Events
        Route::group([
                'as' => 'event.',
                'prefix' => '/e'], 
            function () {
                Route::get('/create', [App\Http\Controllers\EventsController::class, 'create'])->name('create');
                Route::get('/{event_slug}/edit', [App\Http\Controllers\EventsController::class, 'edit'])->where(['event_slug' => '^[a-zA-Z0-9-_]{2,255}$']);
                Route::patch('/{event_slug}', [App\Http\Controllers\EventsController::class, 'update'])->where(['event_slug' => '^[a-zA-Z0-9-_]{2,255}$']);
                Route::delete('/{event_slug}', [App\Http\Controllers\EventsController::class, 'destroy'])->where(['event_slug' => '^[a-zA-Z0-9-_]{2,255}$'])->name('destroy');
                Route::get('/{event_slug}/{newEvent?}', [App\Http\Controllers\EventsController::class, 'show'])->where(['event_slug' => '^[a-zA-Z0-9-_]{2,255}$'])->name('show');
                Route::get('', [App\Http\Controllers\EventsController::class, 'index'])->name('index');
                Route::post('', [App\Http\Controllers\EventsController::class, 'store']);
            }
        );
    });
    
// EVENT DOCUMENTS
    Route::delete('/e/{event_slug}/document/{document_id}', [App\Http\Controllers\EventDocumentsController::class, 'destroy'])->where(['event_slug' => '^[a-zA-Z0-9-_]{2,255}$', 'document_id' => '^[0-9]*$'])->middleware('auth')->name('event_documents.destroy');
    Route::get('/e/{event_slug}/document/{document_id}/download', [App\Http\Controllers\EventDocumentsController::class, 'downloadDocument'])->where(['event_slug' => '^[a-zA-Z0-9-_]{2,255}$', 'document_id' => '^[0-9]*$'])->middleware('auth')->name('event_documents.download');
    Route::get('/e/{event_slug}/documents/download', [App\Http\Controllers\EventDocumentsController::class, 'downloadAllDocument'])->where(['event_slug' => '^[a-zA-Z0-9-_]{2,255}$'])->middleware('auth')->name('event_documents.downloadAll');
    Route::get('/e/{event_slug}/documents', [App\Http\Controllers\EventDocumentsController::class, 'index'])->where(['event_slug' => '^[a-zA-Z0-9-_]{2,255}$'])->middleware('auth')->name('event_documents.index');
    Route::post('/e/{event_slug}/documents', [App\Http\Controllers\EventDocumentsController::class, 'store'])->where(['event_slug' => '^[a-zA-Z0-9-_]{2,255}$'])->middleware('auth')->name('event_documents.store');
    Route::get('/e/{event_slug}/documents/create', [App\Http\Controllers\EventDocumentsController::class, 'create'])->where(['event_slug' => '^[a-zA-Z0-9-_]{2,255}$'])->middleware('auth')->name('event_documents.create');


// EVENT IMAGES

    Route::get('/e/{event_slug}/images/{eventImage_slug}/edit', [App\Http\Controllers\EventImagesController::class, 'edit'])->where(['event_slug' => '^[a-zA-Z0-9-_]{2,255}$', 'eventImage_slug' => '^[a-zA-Z0-9-_]{2,255}$',])->middleware('auth');
    Route::get('/e/{event_slug}/images/create', [App\Http\Controllers\EventImagesController::class, 'create'])->where(['event_slug' => '^[a-zA-Z0-9-_]{2,255}$'])->middleware('auth');
    Route::get('/e/{event_slug}/images/{eventImage_slug}', [App\Http\Controllers\EventImagesController::class, 'show'])->where(['event_slug' => '^[a-zA-Z0-9-_]{2,255}$'])->middleware('auth');
    Route::patch('/e/{event_slug}/images/{eventImage_slug}', [App\Http\Controllers\EventImagesController::class, 'update'])->where(['event_slug' => '^[a-zA-Z0-9-_]{2,255}$', 'eventImage_slug' => '^[a-zA-Z0-9-_]{2,255}$',])->middleware('auth');
    Route::delete('/e/{event_slug}/images/{eventImage_slug}', [App\Http\Controllers\EventImagesController::class, 'destroy'])->name('eventImage.destroy')->where(['event_slug' => '^[a-zA-Z0-9-_]{2,255}$', 'eventImage_slug' => '^[a-zA-Z0-9-_]{2,255}$',])->middleware('auth');
    Route::get('/e/{event_slug}/images', [App\Http\Controllers\EventImagesController::class, 'index'])->where(['event_slug' => '^[a-zA-Z0-9-_]{2,255}$'])->middleware('auth');
    Route::post('/e/{event_slug}/images', [App\Http\Controllers\EventImagesController::class, 'store'])->where(['event_slug' => '^[a-zA-Z0-9-_]{2,255}$'])->middleware('auth');

//Notice
    // Route::get('/n/{notice_uuid}', [App\Http\Controllers\MeetingNoticesController::class, 'show'])->where(['notice_uuid' => '^[a-zA-Z0-9-]{36}$'])->middleware('auth')->name('meetingNotice.show');
    // Route::get('/n/{notice_uuid}/edit', [App\Http\Controllers\MeetingNoticesController::class, 'edit'])->where(['notice_uuid' => '^[a-zA-Z0-9-]{36}$'])->middleware('auth');//->name('show');
    // Route::patch('/n/{notice_uuid}', [App\Http\Controllers\MeetingNoticesController::class, 'update'])->where(['notice_uuid' => '^[a-zA-Z0-9-]{36}$'])->middleware('auth');
    // Route::delete('/n/{notice_uuid}', [App\Http\Controllers\MeetingNoticesController::class, 'destroy'])->where(['notice_uuid' => '^[a-zA-Z0-9-]{36}$'])->middleware('auth');
    // Route::get('/n', [App\Http\Controllers\MeetingNoticesController::class, 'index'])->name('meetingnotices.index')->middleware('auth');
    // Route::get('/n/create', [App\Http\Controllers\MeetingNoticesController::class, 'create'])->middleware('auth');
    // Route::post('/n', [App\Http\Controllers\MeetingNoticesController::class, 'store'])->middleware('auth');

    // Route::get('/o/documents/create', [App\Http\Controllers\DocumentManagementController::class, 'create'])->middleware('auth');
    // Route::post('/o/documents', [App\Http\Controllers\DocumentManagementController::class, 'store'])->middleware('auth');

// Student Accomplishments
    Route::delete('/s/accomplishments/upload/revert', [App\Http\Controllers\StudentAccomplishmentsController::class, 'undoUpload'])->middleware('auth');
    Route::get('/s/accomplishment/{accomplishment_uuid}/final', [App\Http\Controllers\StudentAccomplishmentsController::class, 'finalReview'])->where(['accomplishment_uuid' => '^[a-zA-Z0-9-]{36}$'])->middleware('auth')->name('student_accomplishment.finalReview');
    Route::post('/s/accomplishment/{accomplishment_uuid}/final', [App\Http\Controllers\StudentAccomplishmentsController::class, 'approveSubmission'])->where(['accomplishment_uuid' => '^[a-zA-Z0-9-]{36}$'])->middleware('auth')->name('student_accomplishment.approveSubmission');
    Route::get('/s/accomplishment/{accomplishmentUUID}/review', [App\Http\Controllers\StudentAccomplishmentsController::class, 'initialReview'])->where(['accomplishmentUUID' => '^[a-zA-Z0-9-]{36}$'])->middleware('auth')->name('student_accomplishment.review');

    Route::post('/s/accomplishment/{accomplishment_uuid}', [App\Http\Controllers\StudentAccomplishmentsController::class, 'getSubmissionDecision'])->where(['accomplishment_uuid' => '^[a-zA-Z0-9-]{36}$'])->middleware('auth')->name('student_accomplishment.submissionDecision');

    Route::get('/s/accomplishment/{accomplishmentUUID}/{newAccomplishment?}', [App\Http\Controllers\StudentAccomplishmentsController::class, 'show'])->where(['accomplishmentUUID' => '^[a-zA-Z0-9-]{36}$'])->middleware('auth')->name('student_accomplishment.show');
    Route::get('/s/accomplishments/create', [App\Http\Controllers\StudentAccomplishmentsController::class, 'create'])->middleware('auth');
    Route::post('/s/accomplishments/upload', [App\Http\Controllers\StudentAccomplishmentsController::class, 'upload'])->middleware('auth');
    Route::get('/s/accomplishments', [App\Http\Controllers\StudentAccomplishmentsController::class, 'index'])->middleware('auth')->name('student_accomplishment.index');
    Route::post('/s/accomplishments', [App\Http\Controllers\StudentAccomplishmentsController::class, 'store'])->middleware('auth');

