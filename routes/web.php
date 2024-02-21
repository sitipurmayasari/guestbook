<?php

use App\Http\Controllers\PartisipanController;
use App\Http\Controllers\SignaturePadController;
use App\Http\Livewire\ManageUser;
use App\Http\Livewire\Dashboards;
use App\Http\Livewire\Master\Kategoris;
use App\Http\Livewire\Master\Units;
use App\Http\Livewire\Meeting\Agenda;
use App\Http\Livewire\Meeting\Participants;
use App\Http\Livewire\Meeting\QrRead;
use App\Http\Livewire\Visitors\ReadVisitors;
use App\Http\Livewire\Visitors\CreateVisitors;
use App\Http\Livewire\Visitors\DetailVisitors;
use App\Http\Livewire\Report\ReportPengunjung;

Route::redirect('/', 'login');
Route::get('/partisipan/{slug}', [PartisipanController::class,'index'])->name('partisipan');
Route::get('/meeting/participants/{id}', Participants::class)->name('participants');

Route::post('/partisipan/{slug}/upload', [PartisipanController::class,'upload'])->name('partisipan.upload');


Route::group(['middleware' => ['auth:sanctum','verified']], function () {
    Route::fallback(function() {
        return view('pages/utility/404');
    });

    Route::get('/dashboard', Dashboards::class)->name('dashboard');
    Route::get('/home', Dashboards::class)->name('home');

    Route::get('/master/kategori',Kategoris::class)->name('kategori');

    Route::get('/master/unit',Units::class)->name('unit');

    Route::get('/manage-user',ManageUser::class)->name('manage-user');

    Route::get('/meeting/agenda',Agenda::class)->name('agenda');
    Route::get('/meeting/agenda/qr/{slug}',QrRead::class)->name('agenda.qr');
    Route::get('/meeting/agenda/pdf', [Agenda::class,'print'])->name('pdf.agenda');

    Route::get('/visitors', ReadVisitors::class)->name('visitors');
    Route::get('/visitors/create', CreateVisitors::class)->name('visitors.create');
    Route::get('/visitors/edit/{id}', CreateVisitors::class)->name('visitors.edit');
    Route::get('/visitors/detail/{id}', DetailVisitors::class)->name('visitors.detail');

    Route::get('/report/pengunjung', ReportPengunjung::class)->name('report');
    Route::get('/report/pengunjung/pdf', [ReportPengunjung::class,'print'])->name('pdf.pengunjung');
   
});
