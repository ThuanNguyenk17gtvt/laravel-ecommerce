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
Route::get('logout','FrontendController@getLogout');

Route::group(['namespace'=>'user','middleware'=>'KiemtraUser'],function(){
	Route::get('/','FrontendController@gethome');


	Route::get('category/{id}','FrontendController@getcategory');
	Route::post('category/{id}','FrontendController@postcategory');

	Route::get('detail/{id}','FrontendController@getdetail');
	Route::post('detail/{id}','FrontendController@postcomment');
	Route::get('comment','FrontendController@getdeletecomment');

	Route::post('rating/{id}','FrontendController@poststar');

	Route::get('search','FrontendController@getsearch');

	Route::group(['prefix'=>'information','middleware'=>'CheckLogedOut'],function(){
		Route::get('/{id}','FrontendController@getinformation');

		Route::post('{id}','FrontendController@postinformation');
		Route::post('password/{id}','FrontendController@postpassword');
		
		Route::get('cart/{id}','FrontendController@getinformationcart');
		Route::get('cart/delete/{id}','FrontendController@getdeleteorder');

		Route::post('check_email','FrontendController@postcheck');
	});

	Route::group(['prefix'=>'cart'],function(){

		Route::get('add','CartController@getaddcart');

		Route::get('show','CartController@getshowcart');

		Route::get('delete','CartController@getdeletecart');
		Route::get('update','CartController@getUpdateCart');
	 	
	 	Route::group(['prefix'=>'complete','middleware'=>'CheckLogedOut'],function(){
	 		Route::post('/','CartController@postcomplete');
			Route::get('/','CartController@getcomplete');
	 	});
		
	});	

	Route::group(['prefix'=>'paypal','middleware'=>'CheckLogedOut'],function(){
		Route::get('/{id}','PaypalController@getPaypal');
		Route::post('/{id}','PaypalController@postPaypal');

		Route::get('pay/{id}','PaypalController@getPay');

	});
});



Route::group(['namespace'=>'LoginController','middleware'=>'CheckLogedIn'],function(){

	Route::get('login/facebook', 'LoginController@redirectToProvider');
	Route::get('login/facebook/callback', 'LoginController@handleProviderCallback');

	Route::get('login','LoginController@getLogin');
	Route::post('login','LoginController@postLogin');

	Route::get('registration','LoginController@getRegistration');
	Route::post('registration','LoginController@postRegistration');
	Route::post('check_nameid','LoginController@postname_id');
	Route::post('check_email','LoginController@postemail');

	Route::get('refresh-captcha','LoginController@refreshCaptcha');
	
	Route::get('/lay_lai_mat_khau', 'ForgotPasswordController@getFormResetPassword');
	Route::post('/lay_lai_mat_khau', 'ForgotPasswordController@sendCodeRequestPassword');
	Route::get('/nhap_ma_xac_nhan', 'ForgotPasswordController@getNhapMaXacNhan');
	Route::post('/nhap_ma_xac_nhan', 'ForgotPasswordController@sendMaXacNhan');
	Route::get('/nhap_mat_khau_moi', 'ForgotPasswordController@getNhapMatKhauMoi');
	Route::post('/nhap_mat_khau_moi', 'ForgotPasswordController@sendMatKhauMoi');


	Route::get('nhapmail','Loginerror@getnhapmail');
	Route::post('nhapma','Loginerror@postnhanma');
	Route::post('code','Loginerror@postcode');
});


Route::group(['namespace'=>'Admin','middleware'=>'KiemtraAdmin'],function(){
	Route::group(['prefix'=>'admin','middleware'=>'CheckLogedOut'],function(){
		Route::get('/','HomeController@gethome');

		Route::group(['prefix' => 'category'],function(){
			Route::get('/','CategoryController@getCategory');
			Route::post('/','CategoryController@postCategory');

			Route::get('edit/{id}','CategoryController@getEditCategory');
			Route::post('edit/{id}','CategoryController@postEditCategory');

			Route::get('delete/{id}','CategoryController@getDeleteCategory');

			Route::post('check','CategoryController@postcheckname');
			Route::post('edit/check','CategoryController@postcheckedit');
		});

		Route::group(['prefix'=>'product'],function(){
			Route::get('/{id}','ProductController@getProduct');
			Route::get('search/{id}','ProductController@getsearchProduct');


			Route::get('add/{id}','ProductController@getAddProduct');
			Route::post('add/{id}','ProductController@postAddProduct');

			Route::get('edit/{id}','ProductController@getEditProduct');
			Route::post('edit/{id}','ProductController@postEditProduct');

			Route::post('check','ProductController@posteditCheck_name');
			// Route::post('edit/check_img','ProductController@posteditcheckimg');
			 Route::post('check_edit_img','ProductController@posteditcheckimg');

			Route::get('delete/{id}','ProductController@getDeleteProduct');

			Route::post('check_id','ProductController@postcheckid');
			Route::post('check_name','ProductController@postcheckname');
			Route::post('check_img','ProductController@postcheckimg');
		});

		Route::group(['prefix'=>'member'],function(){
			Route::get('/','MemberController@getMember');
			Route::get('edit/{id}','MemberController@geteditMember');
			Route::post('edit/{id}','MemberController@posteditMember');
			Route::post('edit/password/{id}','MemberController@posteditpasswordmember');
			Route::post('edit/checkemail','MemberController@postcheckemail');
			
			Route::get('delete/{id}','MemberController@getdeleteMember');
			Route::post('add','MemberController@postaddmember');
			Route::post('check_nameid','MemberController@postname_id');
			Route::post('check_email','MemberController@postemail');
		});

		Route::group(['prefix'=>'cart'],function(){
			Route::get('/','CartController@getcart');
			Route::get('infor/{id}','CartController@getinforcart');
			Route::get('edit/{id}','CartController@geteditcart');
			Route::get('ready/{id}','CartController@getreadycart');
			Route::get('delete/{id}','CartController@getdeletecart');
			Route::get('search','CartController@getsearchcart');
		});

		Route::group(['prefix'=>'sales'],function(){
			Route::get('/','SalesController@getsales');
			Route::post('/','SalesController@postsales');
			Route::get('year','SalesController@postsalesyear');
			Route::get('date','SalesController@postsalesday');
		});

	});
	// Route::get('logout','HomeController@getLogout');

});
