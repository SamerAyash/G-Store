<?php

use App\User;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::middleware(['auth:api','admin:admin'])->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => 'admin', 'namespace' => 'Admin'], function() {
    Route::get('/buyers','UserController@getBuyers');
    Route::delete('/buyers/{id}','UserController@destroy');
    Route::patch('/buyers/{id}','UserController@updateBuyer');
    /////////////////////////////////////////////////////////////////
    Route::get('/sellers','UserController@getSellers');
    Route::patch('/sellers/{id}','UserController@updateSeller');
    Route::delete('/sellers/{id}','UserController@destroy');
    /////////////////////////////////////////////////////////////////
    Route::get('/supervisors','AdminController@getSupervisors');
    Route::post('/supervisors','AdminController@storeSupervisor');
    Route::patch('/supervisors/{id}','AdminController@updateSupervisor');
    Route::delete('/supervisors/{id}','AdminController@destroy');
    /////////////////////////////////////////////////////////////////
    Route::get('/delivery','AdminController@getDelivery');
    Route::post('/delivery','AdminController@storeDelivery');
    Route::patch('/delivery/{id}','AdminController@updateDelivery');
    Route::delete('/delivery/{id}','AdminController@destroy');
    /// ////////////////////////////////////////////////////////////
    Route::get('/requests','RequestsTable@getRequests');
    Route::patch('/requests/{id}','RequestsTable@updateRequests');
    Route::delete('/requests/{id}','RequestsTable@deleteRequests');
    //////////////////////////////////////////////////////////////
    Route::get('/outProducts','ProductController@outProducts');
    Route::patch('/outProductsU/{id}','ProductController@updateProduct');
    Route::delete('/outProductsD/{id}','ProductController@deleteProduct');
    Route::get('/get-product/{id}','ProductController@getProduct');
    ////////////////////////////////////////////////////////////////
    Route::post('/offers','ProductController@offers');
    Route::delete('/offers/{id}','ProductController@deleteOffer');
    Route::put('/offers/{id}','ProductController@updateOffer');
});

Route::post('create-payment', function () {
    $apiContext = new \PayPal\Rest\ApiContext(
        new \PayPal\Auth\OAuthTokenCredential(
            'AQVeSApsbEp9NEYYVlZKfn5stRmAJR3uPt9v_tb7e2SL8T3lbFH4MurZZsuYiLyMb-IYkkrIPn3oNNvc',     // ClientID
            'ECsBNqT5htmJUqU907mYwF40bqjP1El08AatLAaEjsXMLfFnFuGomIKNPJoz4YYQ8j7a6IbtTDlewE1T'      // ClientSecret
        )
    );

    $payer = new \PayPal\Api\Payer();
    $payer->setPaymentMethod("paypal");

    $item1 = new \PayPal\Api\Item();
    $item1->setName('Ground Coffee 40 oz')
        ->setCurrency('USD')
        ->setQuantity(1)
        ->setSku("123123") // Similar to `item_number` in Classic API
        ->setPrice(7.5);
    $item2 = new \PayPal\Api\Item();
    $item2->setName('Granola bars')
        ->setCurrency('USD')
        ->setQuantity(5)
        ->setSku("321321") // Similar to `item_number` in Classic API
        ->setPrice(2);

    $itemList = new \PayPal\Api\ItemList();
    $itemList->setItems(array($item1, $item2));

    $details = new \PayPal\Api\Details();
    $details->setShipping(1.2)
        ->setTax(1.3)
        ->setSubtotal(17.50);

    $amount = new \PayPal\Api\Amount();
    $amount->setCurrency("USD")
        ->setTotal(20)
        ->setDetails($details);

    $transaction = new \PayPal\Api\Transaction();
    $transaction->setAmount($amount)
        ->setItemList($itemList)
        ->setDescription("Payment description")
        ->setInvoiceNumber(uniqid());

    $redirectUrls = new \PayPal\Api\RedirectUrls();
    $redirectUrls->setReturnUrl("http://laravel-paypal-example.test")
        ->setCancelUrl("http://laravel-paypal-example.test");

    // Add NO SHIPPING OPTION
    $inputFields = new \PayPal\Api\InputFields();
    $inputFields->setNoShipping(1);

    $webProfile = new \PayPal\Api\WebProfile();
    $webProfile->setName('test' . uniqid())->setInputFields($inputFields);

    $webProfileId = $webProfile->create($apiContext)->getId();

    $payment = new \PayPal\Api\Payment();
    $payment->setExperienceProfileId($webProfileId); // no shipping
    $payment->setIntent("sale")
        ->setPayer($payer)
        ->setRedirectUrls($redirectUrls)
        ->setTransactions(array($transaction));

    try {
        $payment->create($apiContext);
    } catch (Exception $ex) {
        echo $ex;
        exit(1);
    }

    return $payment;
});

Route::post('execute-payment', function (Request $request) {
    $apiContext = new \PayPal\Rest\ApiContext(
        new \PayPal\Auth\OAuthTokenCredential(
            'AQVeSApsbEp9NEYYVlZKfn5stRmAJR3uPt9v_tb7e2SL8T3lbFH4MurZZsuYiLyMb-IYkkrIPn3oNNvc',     // ClientID
            'ECsBNqT5htmJUqU907mYwF40bqjP1El08AatLAaEjsXMLfFnFuGomIKNPJoz4YYQ8j7a6IbtTDlewE1T'      // ClientSecret
        )
    );

    $paymentId = $request->paymentID;
    $payment = \PayPal\Api\Payment::get($paymentId, $apiContext);

    $execution = new \PayPal\Api\PaymentExecution();
    $execution->setPayerId($request->payerID);

    // $transaction = new Transaction();
    // $amount = new Amount();
    // $details = new Details();

    // $details->setShipping(2.2)
    //     ->setTax(1.3)
    //     ->setSubtotal(17.50);

    // $amount->setCurrency('USD');
    // $amount->setTotal(21);
    // $amount->setDetails($details);
    // $transaction->setAmount($amount);

    // $execution->addTransaction($transaction);

    try {
        $result = $payment->execute($execution, $apiContext);
    } catch (Exception $ex) {
        echo $ex;
        exit(1);
    }

    return $result;
});
////////////////////////////////////////////////////


