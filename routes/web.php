<?php

use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\AdminController;
// use App\Http\Controllers\GuruController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\DashboardAdminController;
use App\Http\Controllers\Admin\DataMuridController;
use App\Http\Controllers\Admin\DataGuruController;
use App\Http\Controllers\Admin\DataNilaiController;
use App\Http\Controllers\Admin\AbsenController;
use App\Http\Controllers\Admin\JadwalController;
use App\Http\Controllers\Admin\PpdbController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Guru\DashboardGuruController;
use App\Http\Controllers\Guru\DataMuridController as DataMurid;
use App\Http\Controllers\Guru\DataGuruController as DataGuru;
use App\Http\Controllers\Guru\DataNilaiController as DataNilai;
use App\Http\Controllers\Guru\AbsenController as Absen;
use App\Http\Controllers\Guru\JadwalController as Jadwal;
use App\Http\Controllers\Guru\ProfileController as Profile;
use App\Http\Controllers\Murid\AbsenController as AbsenMurid;
use App\Http\Controllers\Murid\JadwalController as JadwalMurid;
use App\Http\Controllers\Murid\ProfileController as ProfilelMurid;
use App\Http\Controllers\PpdbController as Ppdb;
use App\Http\Controllers\PaymentController;
    

    Route::controller(Ppdb::class)->group(function(){
        Route::get('/pendaftaran-siswa', 'index')->name('siswa');
        Route::post('/pendaftaran-siswa', 'buatdata');
    });
    Route::controller(AuthController::class)->group(function(){
        
        Route::get('/login', 'showLoginForm' )->name('login');
        Route::get('/register','showRegistrationForm')->name('regis');
        
        Route::post('/register', 'register');
        Route::post('/login', 'login' );
        
        Route::get('/logout', 'logout' )->name('logout');
        
    });

    Route::middleware(['auth', 'role:Calon Siswa'])->group(function () {
    Route::prefix('/calon-murid')->group(function (){
        Route::controller(Ppdb::class)->group(function(){
                Route::get('/dashboard','dashboard')->name('calon.dashboard');
                Route::post('/uploadBukti','uploadBuktiTf')->name('calon.uploadBuktiTf');
            });
        });
    });

    Route::middleware(['auth', 'role:Murid'])->group(function () {
        Route::prefix('/murid')->group(function (){
            Route::controller(AbsenMurid::class)->group(function(){
                Route::get('/absen', 'index')->name('murid.absen');
                Route::post('/absen/update', 'updateabsen')->name('murid.updateabsen');
            });
            Route::controller(JadwalMurid::class)->group(function(){
                Route::get('/jadwal', 'index')->name('murid.jadwal');
            });
            Route::controller(ProfilelMurid::class)->group(function(){
                Route::get('/profiles', 'index')->name('murid.profile');
                Route::post('/profiles','update')->name('murid.updateprofiles');
                Route::post('/ganti-password','changePassword')->name('murid.changePassword');
            });
        });
    });
    Route::middleware(['auth', 'role:Guru'])->group(function () {
        Route::prefix('/guru')->group(function (){
            Route::controller(DashboardGuruController::class)->group(function(){
                Route::get('/dashboard','index')->name('guru.dashboard');
            });
            Route::controller(DataMurid::class)->group(function(){
                Route::get('/murid', 'index')->name('guru.murid');
            });
            Route::controller(DataNilai::class)->group(function(){
                Route::get('/nilai', 'index')->name('guru.nilai');
                Route::post('/nilai', 'buatdata')->name('guru.buatnilai');
                Route::post('/nilai/update/{id}', 'update')->name('guru.updatenilai');
                Route::post('/nilai/delete/{id}', 'hapus')->name('guru.deletenilai');
            });
            Route::controller(Absen::class)->group(function(){
                Route::get('/absen', 'index')->name('guru.absen');
                Route::post('/absen', 'buatabsen')->name('guru.buatabsen');
                Route::post('/melakukan-absen', 'updateabsen')->name('guru.updateabsen');
                Route::post('/absen/delete/{id}', 'hapus')->name('guru.deleteabsen');
            });
            Route::controller(Jadwal::class)->group(function(){
                Route::get('/jadwal', 'index')->name('guru.jadwal');
            });
            Route::controller(Profile::class)->group(function(){
                Route::get('/profiles','index')->name('guru.profiles');
                Route::post('/profiles','update')->name('guru.updateprofiles');
                Route::post('/ganti-password','changePassword')->name('guru.changePassword');
                Route::post('/ganti-profil','updateProfilePic')->name('guru.updateProfilePic');
            });
        });
    });

    Route::middleware(['auth', 'role:Admin'])->group(function () {
        Route::prefix('/admin')->group(function (){
            Route::controller(DashboardAdminController::class)->group(function(){
                Route::get('/dashboard', 'index')->name('admin.dashboard');
            });
            Route::controller(DataMuridController::class)->group(function(){
                Route::get('/murid', 'index')->name('admin.murid');
                Route::post('/murid', 'buatdata')->name('admin.buatmurid');
                Route::post('/murid/update/{id}', 'update')->name('admin.updatemurid');
                Route::post('/murid/delete/{id}', 'hapus')->name('admin.deletemurid');
            });
            Route::controller(DataGuruController::class)->group(function(){
                Route::get('/guru', 'index')->name('admin.guru');
                Route::post('/guru', 'buatdata')->name('admin.buatguru');
                Route::post('/guru/update/{id}', 'update')->name('admin.updateguru');
                Route::post('/guru/delete/{id}', 'hapus')->name('admin.deleteguru');
            });
            Route::controller(DataNilaiController::class)->group(function(){
                Route::get('/nilai', 'index')->name('admin.nilai');
                Route::post('/nilai', 'buatdata')->name('admin.buatnilai');
                Route::post('/nilai/update/{id}', 'update')->name('admin.updatenilai');
                Route::post('/nilai/delete/{id}', 'hapus')->name('admin.deletenilai');
            });
            Route::controller(AbsenController::class)->group(function(){
                Route::get('/absen', 'index')->name('admin.absen');
                Route::post('/absen', 'buatabsen')->name('admin.buatabsen');
                Route::post('/absen/delete/{id}', 'hapus')->name('admin.deleteabsen');
            });
            Route::controller(JadwalController::class)->group(function(){
                Route::get('/jadwal', 'index')->name('admin.jadwal');
                Route::post('/jadwal', 'buatdata')->name('admin.buatjadwal');
                Route::post('/jadwal/update/{id}', 'update')->name('admin.updatejadwal');
                Route::post('/jadwal/delete/{id}', 'hapus')->name('admin.deletejadwal');
                Route::post('/jadwal/createmapel', 'createmapel')->name('admin.createmapel');
                Route::post('/jadwal/deletemapel/{id}', 'deletemapel')->name('admin.deletemapel');
                Route::post('/jadwal/createkelas', 'createkelas')->name('admin.createkelas');
                Route::post('/jadwal/deletekelas/{id}', 'deletekelas')->name('admin.deletekelas');
            });
            Route::controller(PpdbController::class)->group(function (){
                Route::get('/ppdb', 'index')->name('admin.ppdb');
                Route::get('/detail-calon-peserta-didik/{id}', 'show')->name('admin.show');
                Route::delete('/hapus-calon-peserta-didik/{id}', 'destroy')->name('admin.hapus');
                Route::post('/terima-calon-peserta-didik/{id}', 'terima')->name('admin.terima');
                Route::post('/tolak-calon-peserta-didik/{id}', 'tolak')->name('admin.tolak');
            });
            Route::controller(ProfileController::class)->group(function(){
                Route::get('/profiles','index')->name('admin.profiles');
                Route::post('/profiles','update')->name('admin.updateprofiles');
                Route::post('/ganti-password','changePassword')->name('admin.changePassword');
                Route::post('/ganti-profiles','updateProfilePic')->name('admin.updateProfilePic');
            });
        });
});

Route::get('/',[AuthController::class,'login']);

