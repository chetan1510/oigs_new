<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\GemsController;
use App\Http\Controllers\RudrakshaController;
use App\Http\Controllers\DiamondController;
use App\Http\Controllers\JewelleryController;
use App\Http\Controllers\AnotherController;
use App\Http\Controllers\manageController;
use App\Http\Controllers\FrontBackController;
use App\Http\Controllers\ProductController;

Route::get('/', [UserController::class,'login'])->name("login");
Route::post('/login', [UserController::class, 'postLogin']);


Route::group(["before"=>"auth"], function(){

    Route::group(["prefix"=>"gems"], function(){
        Route::get('/',[GemsController::class,'index']);
        Route::post('/init',[GemsController::class,'init']);
        Route::get('/add/{id?}',[GemsController::class,'add']);
        Route::get('/get-gems/{id}',[GemsController::class,'getGems']);
        Route::post('/product-image',[GemsController::class,'uploadProductImage']);
        Route::get('/remove-gems-image/{id}',[GemsController::class,'removeGemsImage']);
        Route::post('/store',[GemsController::class,'store']);
        Route::get('/delete/{id}',[GemsController::class,'delete']);
        Route::get('/edit-multile-gems/{id}',[GemsController::class,'editMultileGems']);
        Route::post('/update-multiple-gems',[GemsController::class,'updateMultipleGems']);
        Route::post('/submit-multiple-gems',[GemsController::class,'submitMultipleGems']);
        Route::post('/delete-multiple-gems',[GemsController::class,'daleteMultipleGems']);
        Route::get('/print-report/{report_no}/{status}',[GemsController::class,'printReport']);
        Route::get('/get-result-data/{result_id}',[GemsController::class,'getResultData']);

    });

    Route::group(["prefix"=>"rudraksha"], function(){
        Route::get('/',[RudrakshaController::class,'index']);
        Route::post('/init',[RudrakshaController::class,'init']);
        Route::get('/add/{id?}',[RudrakshaController::class,'add']);
        Route::get('/get-rudraksha/{id}',[RudrakshaController::class,'getRudraksha']);
        Route::post('/product-image',[RudrakshaController::class,'uploadProductImage']);
        Route::get('/remove-rudraksha-image/{id}',[RudrakshaController::class,'removeRudrakshaImage']);
        Route::post('/store',[RudrakshaController::class,'store']);
        Route::get('/delete/{id}',[RudrakshaController::class,'delete']);
        Route::get('/edit-multile-rudraksha/{id}',[RudrakshaController::class,'editMultileRudraksha']);
        Route::post('/update-multiple-rudraksha',[RudrakshaController::class,'updateMultipleRudraksha']);
        Route::post('/submit-multiple-rudraksha',[RudrakshaController::class,'submitMultipleRudraksha']);
        Route::post('/delete-multiple-rudraksha',[RudrakshaController::class,'daleteMultipleRudraksha']);
        Route::get('/print-report/{report_no}/{status}',[RudrakshaController::class,'printReport']);
    });

    Route::group(["prefix"=>"diamond"], function(){
        Route::get('/',[DiamondController::class,'index']);
        Route::post('/init',[DiamondController::class,'init']);
        Route::get('/add/{id?}',[DiamondController::class,'add']);
        Route::get('/get-diamond/{id}',[DiamondController::class,'getDiamond']);
        Route::post('/product-image',[DiamondController::class,'uploadProductImage']);
        Route::get('/remove-diamond-image/{id}',[DiamondController::class,'removeDiamondImage']);
        Route::post('/store',[DiamondController::class,'store']);
        Route::get('/delete/{id}',[DiamondController::class,'delete']);
        Route::get('/edit-multile-diamond/{id}',[DiamondController::class,'editMultileDiamond']);
        Route::post('/update-multiple-diamond',[DiamondController::class,'updateMultipleDiamond']);
        Route::post('/submit-multiple-diamond',[DiamondController::class,'submitMultipleDiamond']);
        Route::post('/delete-multiple-diamond',[DiamondController::class,'daleteMultipleDiamond']);
        Route::get('/print-report/{report_no}/{status}',[DiamondController::class,'printReport']);
    });

    Route::group(["prefix"=>"jewellery"], function(){
        Route::get('/',[JewelleryController::class,'index']);
        Route::post('/init',[JewelleryController::class,'init']);
        Route::get('/add/{id?}',[JewelleryController::class,'add']);
        Route::get('/get-jewellery/{id}',[JewelleryController::class,'getJewellery']);
        Route::post('/product-image',[JewelleryController::class,'uploadProductImage']);
        Route::get('/remove-jewellery-image/{id}',[JewelleryController::class,'removeJewelleryImage']);
        Route::post('/store',[JewelleryController::class,'store']);
        Route::get('/delete/{id}',[JewelleryController::class,'delete']);
        Route::get('/edit-multile-jewellery/{id}',[JewelleryController::class,'editMultileJewellery']);
        Route::post('/update-multiple-jewellery',[JewelleryController::class,'updateMultipleJewellery']);
        Route::post('/submit-multiple-jewellery',[JewelleryController::class,'submitMultipleJewellery']);
        Route::post('/delete-multiple-jewellery',[JewelleryController::class,'daleteMultipleJewellery']);
        Route::get('/print-report/{report_no}/{status}',[JewelleryController::class,'printReport']);
    });

    Route::group(["prefix"=>"Anothers"], function(){
        Route::get('/',[AnotherController::class,'index']);
    });


    Route::group(["prefix"=>"management"], function(){
        Route::get('/customer-and-result',[manageController::class,'index']);

        Route::group(["prefix"=>"customers"], function(){
            Route::post('/customer-list',[manageController::class,'customerList']);
            Route::post('/save-customer',[manageController::class,'saveCustomer']);
            Route::get('/delete-customer/{id}',[manageController::class,'deleteCustomer']);
        });

        Route::group(["prefix"=>"results"], function(){
            Route::post('/result-list',[manageController::class,'resultList']);
            Route::post('/save-result',[manageController::class,'saveResult']);
            Route::get('/delete-result/{id}',[manageController::class,'deleteResult']);
        });

        Route::group(["prefix"=>"product-type"], function(){
            Route::post('/product-type-list',[manageController::class,'productTypeList']);
            Route::post('/save-product-type',[manageController::class,'saveProductType']);
            Route::get('/delete-product/{id}',[manageController::class,'deleteProduct']);
        });

    });

    Route::group(["prefix" => "upload"], function(){
        Route::group(["prefix" => "front-back-image"], function(){
            Route::get("/",[FrontBackController::class,'index']);
            Route::post("/upload",[FrontBackController::class,'uploadFrontBackImage']);
            Route::post("/init",[FrontBackController::class,'init']);
            Route::get("/delete/{id}",[FrontBackController::class,'delete']);
        });

        Route::group(["prefix" => "product-image"], function(){ 
            Route::get("/",[ProductController::class,'index']);
        });

        Route::group(["prefix" => "excel"], function(){
            Route::get("/",[FrontBackController::class,'uploadExcel']);
        });
    });


});
