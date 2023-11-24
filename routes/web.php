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

//JUST ADD '->defaults("group", "Settings")' IF YOU WANT TO GROUP A NAV IN A DROPDOWN

Route::get('/', "WelcomeController@index")->name("/");
Route::get('/event-details', "WelcomeController@event")->name("welcome.event");
Route::get('/verify/{crypt}', "WelcomeController@verify")->name("welcome.verify");
Route::get('/showID', "WelcomeController@showID")->name("welcome.showID");

Route::get('/test', "WelcomeController@test");

Route::get('/phpinfo', function(){
   phpinfo();
});

$cname = "api";
Route::group([
        'as' => "$cname.",
        'prefix' => "$cname/"
    ], function () use($cname){
        Route::get("get", ucfirst($cname) . "Controller@get")->name('get');
        Route::post("store", ucfirst($cname) . "Controller@store")->name('store');
        Route::get("verify", ucfirst($cname) . "Controller@verify")->name('verify');
        Route::post("update", ucfirst($cname) . "Controller@update")->name('update');
    }
);

Route::group([
        'middleware' => 'auth',
    ], function() {
        // Route::get('/', "DashboardController@index")->name('dashboard');


        Route::get('/dashboard', 'DashboardController@index')
            ->defaults('sidebar', 1)
            ->defaults('icon', 'fas fa-list')
            ->defaults('name', 'Dashboard')
            ->defaults('roles', array('Admin'))
            ->name('dashboard')
            ->defaults('href', '/dashboard');

        // USER ROUTES
        $cname = "user";
        Route::group([
                'as' => "$cname.",
                'prefix' => "$cname/"
            ], function () use($cname){

                Route::get("/", ucfirst($cname) . "Controller@index")
                    ->defaults("sidebar", 1)
                    ->defaults("icon", "fas fa-users")
                    ->defaults("name", ucfirst($cname) . "s")
                    ->defaults("roles", array("Super Admin"))
                    // ->defaults("group", "Settings")
                    ->name($cname)
                    ->defaults("href", "/$cname");

                Route::get("get/", ucfirst($cname) . "Controller@get")->name('get');
                Route::post("store/", ucfirst($cname) . "Controller@store")->name('store');
                Route::post("restore/", ucfirst($cname) . "Controller@restore")->name('restore');
                Route::post("delete/", ucfirst($cname) . "Controller@delete")->name('delete');
                Route::post("update/", ucfirst($cname) . "Controller@update")->name('update');
                Route::post("updatePassword/", ucfirst($cname) . "Controller@updatePassword")->name('updatePassword');
            }
        );

        // THEME ROUTES
        $cname = "theme";
        Route::group([
                'as' => "$cname.",
                'prefix' => "$cname/"
            ], function () use($cname){
                Route::get("get/", ucfirst($cname) . "Controller@get")->name('get');
                Route::post("update/", ucfirst($cname) . "Controller@update")->name('update');
            }
        );

        // EVENT ROUTES
        $cname = "event";
        Route::group([
                'as' => "$cname.",
                'prefix' => "$cname/"
            ], function () use($cname){

                Route::get("/", ucfirst($cname) . "Controller@index")
                    ->defaults("sidebar", 1)
                    ->defaults("icon", "fas fa-calendar-days")
                    ->defaults("name", ucfirst($cname) . "s")
                    ->defaults("roles", array("Admin"))
                    // ->defaults("group", "Settings")
                    ->name($cname)
                    ->defaults("href", "/$cname");

                Route::get("get/", ucfirst($cname) . "Controller@get")->name('get');
                Route::post("store/", ucfirst($cname) . "Controller@store")->name('store');
                Route::post("delete/", ucfirst($cname) . "Controller@delete")->name('delete');
                Route::post("update/", ucfirst($cname) . "Controller@update")->name('update');
                Route::post("uploadImages/", ucfirst($cname) . "Controller@uploadImages")->name('uploadImages');
                Route::post("uploadTicketImage/", ucfirst($cname) . "Controller@uploadTicketImage")->name('uploadTicketImage');
                Route::post("uploadIDLayout/", ucfirst($cname) . "Controller@uploadIDLayout")->name('uploadIDLayout');
            }
        );

        // EVENT ROUTES
        $cname = "ticket";
        Route::group([
                'as' => "$cname.",
                'prefix' => "$cname/"
            ], function () use($cname){
                Route::get("get/", ucfirst($cname) . "Controller@get")->name('get');
                Route::post("store/", ucfirst($cname) . "Controller@store")->name('store');
                Route::post("delete/", ucfirst($cname) . "Controller@delete")->name('delete');
                Route::post("update/", ucfirst($cname) . "Controller@update")->name('update');
            }
        );

        // EVENT ROUTES
        $cname = "transaction";
        Route::group([
                'as' => "$cname.",
                'prefix' => "$cname/"
            ], function () use($cname){

                Route::get("/list/{id}", ucfirst($cname) . "Controller@index")->name($cname);

                Route::get("get/", ucfirst($cname) . "Controller@get")->name('get');
                Route::post("store/", ucfirst($cname) . "Controller@store")->name('store');
                Route::post("update/", ucfirst($cname) . "Controller@update")->name('update');
            }
        );

        // EVENT ROUTES
        $cname = "log";
        Route::group([
                'as' => "$cname.",
                'prefix' => "$cname/"
            ], function () use($cname){

                Route::get("/", ucfirst($cname) . "Controller@index")
                    ->defaults("sidebar", 1)
                    ->defaults("icon", "fas fa-history")
                    ->defaults("name", ucfirst($cname) . "s")
                    ->defaults("roles", array("Admin"))
                    // ->defaults("group", "Settings")
                    ->name($cname)
                    ->defaults("href", "/$cname");
            }
        );

        // DATATABLES
        $cname = "datatable";
        Route::group([
                'as' => "$cname.",
                'prefix' => "$cname/"
            ], function () use($cname){

                Route::get("user", ucfirst($cname) . "Controller@user")->name('user');
                Route::get("event", ucfirst($cname) . "Controller@event")->name('event');
                Route::get("log", ucfirst($cname) . "Controller@log")->name('log');
                Route::get("transaction", ucfirst($cname) . "Controller@transaction")->name('transaction');
            }
        );
    }
);

require __DIR__.'/auth.php';