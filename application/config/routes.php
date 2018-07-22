<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
 | -------------------------------------------------------------------------
 | URI ROUTING
 | -------------------------------------------------------------------------
 | This file lets you re-map URI requests to specific controller functions.
 |
 | Typically there is a one-to-one relationship between a URL string
 | and its corresponding controller class/method. The segments in a
 | URL normally follow this pattern:
 |
 |	example.com/class/method/id/
 |
 | In some instances, however, you may want to remap this relationship
 | so that a different class/function is called than the one
 | corresponding to the URL.
 |
 | Please see the user guide for complete details:
 |
 |	http://codeigniter.com/user_guide/general/routing.html
 |
 | -------------------------------------------------------------------------
 | RESERVED ROUTES
 | -------------------------------------------------------------------------
 |
 | There are three reserved routes:
 |
 |	$route['default_controller'] = 'welcome';
 |
 | This route indicates which controller class should be loaded if the
 | URI contains no data. In the above example, the "welcome" class
 | would be loaded.
 |
 |	$route['404_override'] = 'errors/page_missing';
 |
 | This route will tell the Router which controller/method to use if those
 | provided in the URL cannot be matched to a valid route.
 |
 |	$route['translate_uri_dashes'] = FALSE;
 |
 | This is not exactly a route, but allows you to automatically route
 | controller and method names that contain dashes. '-' isn't a valid
 | class or method name character, so it requires translation.
 | When you set this option to TRUE, it will replace ALL dashes in the
 | controller and method URI segments.
 |
 | Examples:	my-controller/index	-> my_controller/index
 |		my-controller/my-method	-> my_controller/my_method
 */
$route['default_controller'] = 'frontend/Home';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

/* *********** API ROUTES ************ */
$route ['api/auth/login.(:any)'] = 'api/users/Api/login/$1';
$route ['api/auth/signup.(:any)'] = 'api/users/Api/signup/$1';
$route ['api/auth/otp/verify.(:any)'] = 'api/users/Api/verifyotp/$1';
$route ['api/rest/login/detail.(:any)'] = 'api/auth/Api/loginDetail/$1';
$route ['api/auth/forgetpassword.(:any)'] = 'api/users/Api/forgetpassword/$1';
$route ['api/auth/newpassword.(:any)'] = 'api/users/Api/newpassword/$1';
$route ['api/auth/changepassword.(:any)'] = 'api/users/Api/changepassword/$1';
$route ['api/user/profile/update.(:any)'] = 'api/users/Api/updateprofile/$1';
$route ['api/user/profile.(:any)'] = 'api/users/Api/profile/$1';
$route ['api/user/orders.(:any)'] = 'api/users/Api/orders/$1';
$route ['api/user/address/update.(:any)'] = 'api/users/Api/updateaddress/$1';
$route ['api/user/address/add.(:any)'] = 'api/users/Api/addaddress/$1';
$route ['api/user/address.(:any)'] = 'api/users/Api/address/$1';




/* *********** Frontend Routes ********* */
$route['signup'] = 'frontend/Login/signup';
$route['signup/sendverificationemail'] = 'frontend/Login/sendVerificationEmail';
$route['signup/sendverificationsms'] = 'frontend/Login/sendVerificationSms';
$route['signup/isemailverified'] = 'frontend/Login/isEmailVerified';
$route['signup/verifymobile'] = 'frontend/Login/verifyMobileOtp';
$route['signup/verifyemail/([a-zA-Z0-9]+)'] = 'frontend/Login/verifyEmail/$1';
$route['userlogin'] = 'frontend/Login/login';
$route['logout'] = 'frontend/Login/logout';

/* login signup page section */
$route['login'] = 'frontend/Login/loginDisplay';
$route['register'] = 'frontend/Login/register';
$route['unable-to-login'] = 'frontend/Login/unabletologin';
$route['forgot-password'] = 'frontend/Login/forgotpassword';
$route['forgot-customer-ID'] = 'frontend/Login/forgotCustomerId';
$route['enter-customer-ID'] = 'frontend/Login/enterCustomerId';
$route['confirm-OTP'] = 'frontend/Login/confirmOTP';
$route['confirm-PIN'] = 'frontend/Login/confirmPIN';
$route['security-question'] = 'frontend/Login/loginSecurityQuestion';
$route['OTP-Confirmation-message'] = 'frontend/Login/OTPConfirmationMessage';
$route['set-new-password'] = 'frontend/Login/setNewPassword';
$route['password-reset-successfull'] = 'frontend/Login/resetPasswordSuccessfull';
$route['welcome-message'] = 'frontend/Login/welcomeMessage';
$route['unauthorized-access'] = 'frontend/Login/accessErrorMessage';
$route['suspended-account'] = 'frontend/Login/suspendedAccount';

/* login signup page section */



/* main Pages*/
$route['buynow'] = 'frontend/Product';
$route['features'] = 'frontend/Home/features';
$route['installation'] = 'frontend/Home/installation';
$route['story'] = 'frontend/Home/story';
$route['support'] = 'frontend/Home/support';
$route['account'] = 'frontend/Home/account';
/* main Pages*/
/* footer section */
$route['careers'] = 'frontend/Home/careers';
$route['press'] = 'frontend/Home/press';
$route['blog'] = 'frontend/Home/blog';
$route['legal'] = 'frontend/Home/legal';
$route['contact-us'] = 'frontend/Home/contact';
$route['become-a-partner'] = 'frontend/Home/become_a_partner';
$route['contact-us'] = 'frontend/Home/contact';
/* footer section */
/* careers */
$route['careers/software-developer'] = 'frontend/Pages/software_developer';
$route['careers/software-engineer'] = 'frontend/Pages/software_engineer';
/* careers ends*/
/* support section */
$route['support/getting-started'] = 'frontend/Pages/getting';
$route['support/installation'] = 'frontend/Pages/software_developer';
$route['support/software-developer'] = 'frontend/Pages/software_developer';
/* support section ends */
/* legal section */
$route['legal/property-policy'] = 'frontend/Pages/propertypolicy';
$route['legal/termsandconditions'] = 'frontend/Pages/terms';
$route['legal/agreements'] = 'frontend/Pages/license';
$route['legal/sales-policy'] = 'frontend/Pages/salepolicy';
$route['legal/terms-of-use'] = 'frontend/Pages/termsofuse';
$route['legal/privacy-policy'] = 'frontend/Pages/privacypolicy';
/* legal section ends */
/*getting started ask a question*/
$route['ask-a-question'] = 'frontend/Pages/askaquestion';
$route['smart-devices'] = 'frontend/Pages/smartdevices';
/*getting started ask a question*/
/* search section */
$route['search'] = 'frontend/Pages/search';
/* search section */
/* Buy now */
$route['product/([0-9]+)'] = 'frontend/Product/productdetails/$1';
$route['purchase-flow'] = 'frontend/Product/purchaseflow';
$route['product/checkpincode'] = 'frontend/Product/checkpincode';
$route['applycoupon'] = 'frontend/Cart/applyCoupon';
$route['applykarmapoint'] = 'frontend/Cart/applyKarmaPoint';
$route['order/checkout'] = 'frontend/Cart/checkout';
$route['order/placed/([a-zA-Z0-9]+)'] = 'frontend/Cart/thankYou/$1';

/*  ***********  cart functionality  *********  */
$route['additemtocart'] = 'frontend/Cart/addProductToCart';
$route['removeitemfromcart'] = 'frontend/Cart/removeProductFromCart';
$route['deleteitemfromcart'] = 'frontend/Cart/deleteProductFromCart';
$route['getcartcount'] = 'frontend/Cart/getCartCount';

/*  ***********  Checkout functionality  *********  */
$route['addnewaddress'] = 'frontend/Login/addNewAddress';
$route['getusersavedaddress/([0-9]+)'] = 'frontend/Product/getusersavedaddress/$1';
$route['getsaveaddressById/([0-9]+)'] = 'frontend/Product/getsaveaddressById/$1';
$route['giftee/validate'] = 'frontend/Cart/validateGiftee';
$route['order/otp/send'] = 'frontend/Cart/sendOrderOtp';
$route['order/otp/resend'] = 'frontend/Cart/resendOrderOtp';
$route['order/otp/confirm'] = 'frontend/Cart/confirmOrderOtp';

/*
 $route['ordernow'] = 'frontend/home/ordernow';
 $route['products'] = 'frontend/product';
 $route['additemtocart'] = 'frontend/menu/addItemToCart';
 $route['removeitemfromcart'] = 'frontend/menu/removeItemFromCart';
 $route['additemtocart/checkout'] = 'frontend/menu/addItemToCartCheckout';
 $route['removeitemfromcart/checkout'] = 'frontend/menu/removeItemFromCartCheckout';
 $route['removeallitems/([0-9]+)'] = 'frontend/menu/clearCart/$1';
 $route['getcartcount'] = 'frontend/menu/getCartCount';
 $route['placeorder/([a-zA-Z]+)'] = 'frontend/menu/checkoutOrder/$1';
 $route['privacy-policy'] = 'frontend/home/privacyPolicy';
 $route['terms-condition'] = 'frontend/home/termsConditions';
 $route['faq'] = 'frontend/home/faq';
 $route['signup'] = 'frontend/Login/UserRegistration';
 $route['login'] = 'frontend/Login/login';
 $route['logout'] = 'frontend/Login/logout';
 $route['user/profile'] = 'frontend/Login/userProfile';
 $route['user/address'] = 'frontend/Login/userAddress';
 $route['user/address/edit/([0-9]+)'] = 'frontend/Login/getAddressByAddressId/$1';
 $route['user/address/update'] = 'frontend/Login/updateAddress';
 $route['user/orders'] = 'frontend/Login/userOrder';
 $route['user/profile/edit'] = 'frontend/Login/editProfile';
 $route['user/profile/update'] = 'frontend/Login/updateUserProfile';
 $route['user/profile/password/new'] = 'frontend/Login/newPassword';
 $route['user/profile/password/update'] = 'frontend/Login/changePwd';
 $route['user/wallet'] = 'frontend/Login/userWallet';
 $route['verifyotp/([0-9]+)/([0-9]+)'] = 'frontend/Login/otpMatch/$1/$2';
 $route['addnewaddress'] = 'frontend/Login/addNewAddress';
 $route['checkdeliveryarea'] = 'frontend/Menu/checkDeliveryArea';
 $route['saveorder'] = 'frontend/Menu/placeOrder';
 $route['thankyou/([a-zA-Z0-9]+)'] = 'frontend/Menu/checkoutResponse/$1';
 $route['payment_response'] = 'frontend/Menu/getPaymentResponse';
 $route['applycoupon'] = 'frontend/Menu/checkCoupon/$1';
 $route['restaurant/del_timing'] = 'frontend/Menu/getRestDeliveryTime';
 $route['reviews'] = 'frontend/Home/reviews';
 $route['review/save'] = 'frontend/Home/saveReview';
 $route['app/aboutus'] = 'frontend/Home/aboutusapp';
 $route['contactus'] = 'frontend/Home/contactus';
 $route['aboutus'] = 'frontend/Home/aboutus';
 $route['whyspoonbell'] = 'frontend/Home/whyspoonbell';
 $route['offers'] = 'frontend/Home/offers';
 $route['resetpassword'] = 'frontend/Login/resetPassword';
 $route['addenquiry'] = 'frontend/Home/addEnquiry';
 */

/* *********** Backend Routes ********** */
$route['admin'] = 'backend/login';
$route['admin/dashboard'] = 'backend/login/dashboard';
$route['admin/logout'] = 'backend/login/logout';
$route['admin/login'] = 'backend/login/adminlogin';
$route['admin/users'] = 'backend/Login/userList';
$route['admin/login/assignrole'] = 'backend/Login/assignRole';
$route['admin/login/turnonof'] = 'backend/Login/turnonof';
$route['admin/general/citylist'] = 'backend/Setting/getCityList';
$route['admin/general/newcity'] = 'backend/Setting/newCity';
$route['admin/general/addcity'] = 'backend/Setting/addCity';
$route['admin/general/editcity/([0-9]+)'] = 'backend/Setting/editCity/$1';
$route['admin/general/updatecity'] = 'backend/Setting/updateCity';
$route['admin/general/turnoncity/([0-9]+)'] = 'backend/Setting/turnOnCity/$1';
$route['admin/general/turnoffcity/([0-9]+)'] = 'backend/Setting/turnOffCity/$1';
//$route['admin/general/localitylist/([0-9]+)'] = 'backend/Setting/getLocalityList/$1';
$route['admin/general/localitylist'] = 'backend/Setting/getLocalityList';
$route['admin/general/newlocality'] = 'backend/Setting/newLocality';
$route['admin/general/addlocality'] = 'backend/Setting/addLocality';
$route['admin/general/editlocality/([0-9]+)'] = 'backend/Setting/editLocality/$1';
$route['admin/general/updatelocality'] = 'backend/Setting/updateLocality';
$route['admin/general/turnonlocality/([0-9]+)'] = 'backend/Setting/turnOnLocality/$1';
$route['admin/general/turnofflocality/([0-9]+)'] = 'backend/Setting/turnOffLocality/$1';
$route['admin/general/localities'] = 'backend/Setting/getLocality';
$route['admin/general/city/zones'] = 'backend/Setting/getZones';
$route['admin/general/zone/localities'] = 'backend/Setting/getZoneLocality';
$route['admin/general/cuisinelist'] = 'backend/Setting/getCuisineList';
$route['admin/general/newcuisine'] = 'backend/Setting/newCuisine';
$route['admin/general/addcuisine'] = 'backend/Setting/addCuisine';
$route['admin/general/editcuisine/([0-9]+)'] = 'backend/Setting/editCuisine/$1';
$route['admin/general/updatecuisine'] = 'backend/Setting/updateCuisine';
$route['admin/general/deletecuisine/([0-9]+)'] = 'backend/Setting/deleteCuisine/$1';
$route['admin/general/reasonlist'] = 'backend/Setting/getReasonList';
$route['admin/general/newreason'] = 'backend/Setting/newReason';
$route['admin/general/addreason'] = 'backend/Setting/addReason';
$route['admin/general/editreason/([0-9]+)'] = 'backend/Setting/editReason/$1';
$route['admin/general/updatereason'] = 'backend/Setting/updateReason';
$route['admin/general/deletereason/([0-9]+)'] = 'backend/Setting/deleteReason/$1';

/* **************************** Vendor ***********************************/
$route['admin/vendor/list'] = 'backend/Vendor';
$route['admin/vendor/new'] = 'backend/Vendor/newRestaurant';
$route['admin/vendor/add'] = 'backend/Vendor/addRestaurant';
$route['admin/vendor/edit/([0-9]+)'] = 'backend/Vendor/editRestaurant/$1';
$route['admin/vendor/updatebasic'] = 'backend/Vendor/updateRestaurantBasicInfo';
$route['admin/vendor/updatebilling'] = 'backend/Vendor/updateRestaurantBillingInfo';
$route['admin/vendor/verify/([0-9]+)'] = 'backend/Vendor/verifyRestaurant/$1';
$route['admin/vendor/madelive/([0-9]+)'] = 'backend/Vendor/makeRestaurantLive/$1';
$route['admin/vendor/getgeofance/([0-9]+)'] = 'backend/Vendor/getgeofance/$1';
$route['admin/vendor/promoteList'] = 'backend/Vendor/promoteRestaurantList';
$route['admin/vendor/promote'] = 'backend/Vendor/promote';
$route['admin/vendor/promoteUpdate'] = 'backend/Vendor/promoteUpdate';
$route['admin/vendor/turnonpromotedresto'] = 'backend/Vendor/turnonPromotedResto';
$route['admin/vendor/turnoffpromotedresto'] = 'backend/Vendor/turnoffPromotedResto';
$route['admin/vendor/searchpromotedrestaurant'] = 'backend/Vendor/searchPromotedRestro';
$route['admin/vendor/turnoffresto'] = 'backend/Vendor/turnOffResto';
$route['admin/vendor/turnonresto'] = 'backend/Vendor/turnOnResto';

$route['admin/menu/list'] = 'backend/Menu';
$route['admin/menu/search'] = 'backend/Menu/searchMenu';
//$route['admin/menu/upload/([0-9]+)'] = 'backend/Menu/uploadMenu/$1';

$route['admin/menu/update/([0-9]+)'] = 'backend/Menu/updateMenu/$1';
$route['admin/menu/importupdate'] = 'backend/Menu/importUpdate';
$route['admin/menu/publish'] = 'backend/Menu/publish_menu';
$route['admin/menu/download/([0-9]+)'] = 'backend/Menu/download/$1';
$route['admin/menu/edit/([0-9]+)'] = 'backend/Menu/editMenu/$1';
$route['admin/menu/editsortorder'] = 'backend/Menu/editMenuSortOrder';
$route['admin/menu/items/new_menu'] = 'backend/Items/newMenu';
$route['admin/menu/items/add_menu'] = 'backend/Items/addMenu';
$route['admin/menu/items/update_menu'] = 'backend/Items/updateMenu';
$route['admin/menu/items/addcategory'] = 'backend/Items/addCategory';
$route['admin/menu/items/editcategory'] = 'backend/Items/updateCategory';
$route['admin/menu/items/editcategoryimage'] = 'backend/Items/editCategoryImage';
$route['admin/menu/items/updatecategoryimage'] = 'backend/Items/updateCategoryImage';
$route['admin/menu/options/newoption/([0-9]+)/([0-9]+)/(:any)'] = 'backend/Options/newOption/$1/$2/$3';
$route['admin/menu/options/addoptions'] = 'backend/Options/addOption';
$route['admin/menu/options/edititemoption/([0-9]+)/([0-9]+)/(:any)'] = 'backend/Options/editOption/$1/$2/$3';
$route['admin/menu/options/updateoption'] = 'backend/Options/updateOption';
$route['admin/menu/options/downloadoption/([0-9]+)/([0-9]+)'] = 'backend/Options/downloadOptions/$1/$2';
$route['admin/menu/items/viewuploadform'] = 'backend/Options/uploadPopup';
$route['admin/menu/items/uploadoption'] = 'backend/Options/uploadOptions';
$route['admin/coupon/list'] = 'backend/Coupan';
$route['admin/coupon/newCoupon'] ='backend/coupan/addCoupon';
$route['admin/coupon/addcoupon']='backend/Coupan/add';
$route['admin/general/getRestro'] = 'backend/Coupon/getRestro';
$route['admin/coupon/update/([0-9]+)']='backend/Coupan/updateCoupon/$1';
$route['admin/coupon/update/updateCoupon']='backend/Coupan/update';
$route['admin/general/restro'] = 'backend/Setting/getRestro';
$route['admin/general/getrestaurantbyarea'] = 'backend/Setting/getRestaurantByArea';
$route['admin/coupan/turnoffcoupon/([0-9]+)']='backend/coupan/turnoffcoupon/$1';
$route['admin/coupan/turnoncoupon/([0-9]+)']='backend/coupan/turnoncoupon/$1';
$route['admin/coupon/deletevendor/([0-9]+)']='backend/coupan/deleteVendor/$1';
$route['admin/coupan/statusoncoupon/([0-9]+)']='backend/coupan/statusoncoupon/$1';
$route['admin/coupan/statusoffcoupon/([0-9]+)']='backend/coupan/statusoffcoupon/$1';
$route['admin/billing/dashboard'] = 'backend/Billing'; //shinee 14 april
$route['admin/billing/addconfig/([0-9]+)'] = 'backend/Billing/addConfig/$1';
$route['admin/billing/servicetaxlist'] = 'backend/Billing/getServiceTaxList';
$route['admin/billing/newservicetax'] = 'backend/Billing/newServiceTax';
$route['admin/billing/addservicetax'] = 'backend/Billing/addServiceTax';
$route['admin/billing/editservicetax/([0-9]+)'] = 'backend/Billing/editServiceTax/$1';
$route['admin/billing/updservicetax'] = 'backend/Billing/updateServiceTax';
$route['admin/billing/addrestcommission'] = 'backend/Billing/addRestCommission';
$route['admin/billing/commissionlist/([0-9]+)'] = 'backend/Billing/getRestCommissionList/$1';
$route['admin/billing/getrestcommission/([0-9]+)'] = 'backend/Billing/getRestCommission/$1';
$route['admin/billing/saverestbillingitem'] = 'backend/Billing/saveRestBillingItem';
$route['admin/billing/restbillingitemlist/([0-9]+)'] = 'backend/Billing/getRestBillingItemList/$1';
$route['admin/billing/getrestbillingitem/([0-9]+)'] = 'backend/Billing/getRestBillingItem/$1';
$route['admin/billing/updaterestcommission'] = 'backend/Billing/updateRestCommission';

$route['admin/billing/billingheadlist'] = 'backend/Billing/getBillingHeadList';
$route['admin/billing/newbillinghead'] = 'backend/Billing/newBillingHead';
$route['admin/billing/addbillinghead'] = 'backend/Billing/addBillingHead';
$route['admin/billing/editbillinghead/([0-9]+)'] = 'backend/Billing/editBillingHead/$1';
$route['admin/billing/updbillinghead'] = 'backend/Billing/updateBillingHead';
$route['admin/billing/billingsubheadlist'] = 'backend/Billing/getBillingSubHeadList';
$route['admin/billing/newbillingsubhead'] = 'backend/Billing/newBillingSubHead';
$route['admin/billing/addbillingsubhead'] = 'backend/Billing/addBillingSubHead';
$route['admin/billing/editbillingsubhead/([0-9]+)'] = 'backend/Billing/editBillingSubHead/$1';
$route['admin/billing/updbillingsubhead'] = 'backend/Billing/updateBillingSubHead';
$route['admin/billing/billingsubheadlistbycat'] = 'backend/Billing/getBillingSubHeadsByCat';
$route['admin/invoicing/getcustominvoicerestaurants'] = 'backend/Invoicing/getCustomInvoiceRestaurants';
$route['admin/invoicing/generatecustominvoice'] = 'backend/Invoicing/generatecustominvoice';
$route['admin/invoicing/sendinvoiceemail'] = 'backend/Invoicing/sendInvoiceEmail';
$route['admin/brand/list']='backend/Brand';
$route['admin/brand/new']='backend/Brand/newBrand';
$route['admin/brand/addbrand']='backend/Brand/addBrand';
$route['admin/brand/activeBrand']='backend/Brand/activeBrand';
$route['admin/brand/deactiveBrand']='backend/Brand/deactiveBrand';
$route['admin/brand/update/([0-9]+)']='backend/Brand/updateBrand/$1';
$route['admin/brand/update/save']='backend/Brand/updateSave';
$route['admin/brand/getallrest']='backend/Brand/getAllRest';
$route['admin/brand/getallcusine']='backend/Brand/getAllcusineList';
$route['admin/brand/getcitylist']='backend/Brand/getCityList';
$route['admin/coupon/turnonhasdeal']='backend/coupan/turnOnRestDeal';
$route['admin/coupon/turnoffhasdeal']='backend/coupan/turnOffRestDeal';
$route['admin/billing/generateinvoicebyrest"']='backend/Invoicing/generateInvoiceByRestaurant';
$route['admin/test'] = 'backend/Order/test';
$route['admin/customerlist']='backend/Report';
$route['admin/report/user']='backend/Report/searchUser';
$route['admin/report/ordervsarea']='backend/Report/ordervsArea';
$route['admin/report/searchordervsarea']='backend/Report/searchOrdervsArea';
$route['admin/report/paidvscod']='backend/Report/paidvsCOD';
$route['admin/report/searchpaidvscod']='backend/Report/searchPaidvsCOD';
$route['admin/report/successfullvsfail']='backend/Report/successfullvsFail';
$route['admin/report/searchsuccessfullvsfail']='backend/Report/searchSuccessfullvsFail';
$route['admin/report/deliveryvstakeaway']='backend/Report/deliveryvsTakeaway';
$route['admin/report/searchdeliveryvstakeaway']='backend/Report/searchDeliveryvsTakeaway';
$route['admin/report/restaurantsvsorder']='backend/Report/restaurantsvsOrders';
$route['admin/report/searchrestaurantsvsorder']='backend/Report/searchRestaurantsvsOrders';
$route['admin/invoicing/getinvoicerestaurants'] = 'backend/Invoicing/getInvoiceRestaurants';
$route['admin/invoicing/generateinvoice'] = 'backend/Invoicing/generateInvoice';
$route['admin/invoicing/sendinvoiceemail'] = 'backend/Invoicing/sendInvoiceEmail';
$route['admin/report/bannerreport']='backend/Report/bannerReport';
$route['admin/report/searchbannerreport']='backend/Report/searchBannerReport';
$route['admin/report/subscribereport']='backend/Report/subscribeReport';
$route['admin/banner/zonelist'] = 'backend/banner/zoneList';
$route['admin/banner/addzone'] = 'backend/banner/addZone';
$route['admin/banner/newzone'] = 'backend/banner/newZone';
$route['admin/banner/editzone/([0-9]+)'] = 'backend/banner/editZone/$1';
$route['admin/banner/updatezone'] = 'backend/banner/updateZone';
$route['admin/banner/assignzonearea'] = 'backend/banner/assignZoneAreas';
$route['admin/banner/bannerlist'] = 'backend/banner/bannerList';
$route['admin/banner/addbanner'] = 'backend/banner/addBanner';
$route['admin/banner/newbanner'] = 'backend/banner/newBanner';
$route['admin/banner/updatebanner'] = 'backend/banner/updateBanner';
$route['admin/banner/editpromotedbanner/updatepromotedbanner'] = 'backend/banner/updatePromotedBanner';
$route['admin/banner/editbanner/([0-9]+)'] = 'backend/banner/editBanner/$1';
$route['admin/banner/promotebanner'] = 'backend/banner/promotedBannerList';
$route['admin/banner/newpromotebanner'] = 'backend/banner/promoteBanner';
$route['admin/banner/addpromotebanner'] = 'backend/banner/addPromoteBanner';
$route['admin/banner/getzonebycityid'] = 'backend/banner/getZoneByCityId';
$route['admin/banner/getareanotinzone'] = 'backend/banner/getAreaNotInZone';
$route['admin/banner/addassignzonearea'] = 'backend/banner/addAssignZoneArea';
$route['admin/banner/getrestbycityid'] = 'backend/banner/getRestByCityId';
$route['admin/banner/searchpromotedbanner'] = 'backend/banner/searchPromotedBanner';
$route['admin/banner/editpromotedbanner/([0-9]+)'] = 'backend/banner/editPromotedBanner/$1';
$route['admin/banner/turnonzone/([0-9]+)'] = 'backend/banner/turnOnZone/$1';
$route['admin/banner/turnofzone/([0-9]+)'] = 'backend/banner/turnOfZone/$1';
$route['admin/banner/turnonbanner/([0-9]+)'] = 'backend/banner/turnOnBanner/$1';
$route['admin/banner/turnofbanner/([0-9]+)'] = 'backend/banner/turnOfBanner/$1';
$route['admin/banner/editpromotedbanner'] = 'backend/banner/editPromotedBanner';
$route['admin/banner/getpromotedbannerdetailbyrest/([0-9]+)'] = 'backend/banner/getPromotedBannerDetailByRest/$1';
$route['admin/banner/updatepromotedbanner'] = 'backend/banner/updatePromotedBanner';
$route['admin/banner/deletareafromzone/([0-9]+)'] = 'backend/banner/deletAreaFromZone/$1';
$route['admin/banner/showbanner'] = 'backend/banner/showBanner';
$route['admin/offer/offerlist'] = 'backend/Offer';
$route['admin/offer/addoffer'] = 'backend/Offer/addOffer';
$route['admin/offer/saveoffer'] = 'backend/Offer/saveOffer';
$route['admin/offer/editoffer/([0-9]+)'] = 'backend/Offer/EditOffer/$1';
$route['admin/offer/editoffer/updateoffer'] = 'backend/Offer/UpdateOffer';
$route['admin/offer/turnonoffer/([0-9]+)'] = 'backend/Offer/turnOnOffer/$1';
$route['admin/offer/turnofoffer/([0-9]+)'] = 'backend/Offer/turnOfOffer/$1';
$route['admin/offer/deleteoffer/([0-9]+)'] = 'backend/Offer/deleteOffer/$1';
$route['admin/restaurantoffers'] = 'backend/RestaurantOffer';
$route['admin/restaurantoffers/new'] = 'backend/RestaurantOffer/newOffer';
$route['admin/restaurantoffers/add'] = 'backend/RestaurantOffer/addOffer';
$route['admin/restaurantoffers/edit/([0-9]+)'] = 'backend/RestaurantOffer/editOffer/$1';
$route['admin/restaurantoffers/update'] = 'backend/RestaurantOffer/updateOffer';
$route['admin/restaurantoffers/turnonoffer/([0-9]+)'] = 'backend/RestaurantOffer/turnOnOffer/$1';
$route['admin/restaurantoffers/turnofoffer/([0-9]+)'] = 'backend/RestaurantOffer/turnOfOffer/$1';
$route['admin/restaurantoffers/delete/([0-9+]+)'] = 'backend/RestaurantOffer/deleteOffer/$1';
$route['admin/restaurantoffers/getzonebycityid'] = 'backend/RestaurantOffer/getZoneByCityId';
$route['admin/restaurantoffers/getrestaurantbyzoneid'] = 'backend/RestaurantOffer/getRestaurantByZoneId';
$route['admin/banner/searchbanner'] = 'backend/banner/searchBanner';
$route['admin/job'] = 'backend/Job';
$route['admin/job/condidate/([0-9]+)'] = 'backend/Job/candidate/$1';
$route['admin/job/newjob'] = 'backend/Job/newJob';
$route['admin/job/editjob/([0-9+]+)'] = 'backend/Job/editJob/$1';
$route['admin/job/addjob'] = 'backend/Job/addJob';
$route['admin/job/editjob/update'] = 'backend/Job/updateJob';
$route['admin/job/turnonjob/([0-9+]+)'] = 'backend/Job/turnOnJob/$1';
$route['admin/job/turnofjob/([0-9+]+)'] = 'backend/Job/turnOfJob/$1';
$route['admin/job/deletejob/([0-9+]+)'] = 'backend/Job/deleteJob/$1';
$route['joblisting/apply'] = 'backend/Job/apply';
$route['admin/restaurant/clients'] = 'backend/Restaurant/restClients';
$route['admin/restaurant/newclient'] = 'backend/Restaurant/newClient';
$route['admin/restaurant/editclient/([0-9]+)'] = 'backend/Restaurant/editClient/$1';
$route['admin/restaurant/addclient'] = 'backend/Restaurant/addClient';
$route['admin/restaurant/updateclient'] = 'backend/Restaurant/updateClient';
$route['admin/restaurant/turnonclient/([0-9]+)'] = 'backend/Restaurant/turnOnClient/$1';
$route['admin/restaurant/turnoffclient/([0-9]+)'] = 'backend/Restaurant/turnOffClient/$1';
$route['admin/order/clientorders'] = 'backend/Order/clientOrders';
$route['admin/order/client_order_detail/([0-9]+)'] = 'backend/Order/clientOrderDetail/$1';
$route['admin/order/client/orderaccept/([0-9]+)'] = 'backend/Order/acceptClientOrder/$1';
$route['admin/order/client/orderreject/([0-9]+)'] = 'backend/Order/rejectClientOrder/$1';
$route['admin/order/client/neworder'] = 'backend/Order/newOrder';
$route['admin/order/client/addorder'] = 'backend/Order/addOrder';
$route['admin/restaurant/rest_detail/([0-9]+)'] = 'backend/Restaurant/restaurant_detail/$1';
$route['admin/report/viewrestdelorders'] = 'backend/Report/getRestDeliveryStats';
$route['admin/schedulepromoted'] = 'backend/Restaurant/updateAllPromotedRestaurants';

$route['admin/general/tickets'] = 'backend/setting/tickets';
$route['admin/general/ticket/new'] = 'backend/setting/newTicket';
$route['admin/general/ticket/edit/([0-9]+)'] = 'backend/setting/editTicket/$1';
$route['admin/general/ticket/add'] = 'backend/setting/addTicket';
$route['admin/general/ticket/update'] = 'backend/setting/updateTicket';

$route['admin/user/bymobile'] = 'backend/setting/getUserByMobile';
$route['admin/user/byemail'] = 'backend/setting/getUserByEmail';
$route['admin/user/byname'] = 'backend/setting/getUserByName';
$route['admin/user/detail/([0-9]+)'] = 'backend/setting/userDetail/$1';

/*
 $route['admin/product'] = 'backend/Product';
 $route['admin/category/new'] = 'backend/Product/newCategory';
 $route['admin/category/add'] = 'backend/Product/addCategory';
 $route['admin/category/list'] = 'backend/Product/getCategoryList';
 $route['admin/category/edit/([0-9]+)'] = 'backend/Product/editCategory/$1';
 $route['admin/category/update'] = 'backend/Product/updateCategory';
 $route['admin/subcategory/new'] = 'backend/Product/newSubCategory';
 $route['admin/subcategory/add'] = 'backend/Product/addSubCategory';
 $route['admin/subcategory/list/([0-9]+)'] = 'backend/Product/getSubCategoryList/$1';
 $route['admin/subcategory/edit/([0-9]+)'] = 'backend/Product/editSubCategory/$1';
 $route['admin/subcategory/update'] = 'backend/Product/updateSubCategory'; */

$route['admin/product'] = 'backend/Product';
$route['admin/category/new'] = 'backend/Attribute/newCategory';
$route['admin/category/add'] = 'backend/Attribute/addCategory';
$route['admin/category/list'] = 'backend/Attribute/getCategoryList';
$route['admin/category/edit/([0-9]+)'] = 'backend/Attribute/editCategory/$1';
$route['admin/category/update'] = 'backend/Attribute/updateCategory';
$route['admin/subcategory/new'] = 'backend/Attribute/newSubCategory';
$route['admin/subcategory/add'] = 'backend/Attribute/addSubCategory';
$route['admin/subcategory/list/([0-9]+)'] = 'backend/Product/getSubCategoryList/$1';
$route['admin/subcategory/edit/([0-9]+)'] = 'backend/Product/editSubCategory/$1';
$route['admin/subcategory/update'] = 'backend/Product/updateSubCategory';

// Added By Suraj

$route['admin/attribute_group/list'] = 'backend/Attribute';
$route['admin/attribute_group/new'] = 'backend/Attribute/newAttributeGroup';
$route['admin/attribute_group/add'] = 'backend/Attribute/addAttributeGroup';
$route['admin/attribute_group/edit/([0-9]+)'] = 'backend/Attribute/editAttributeGroup/$1';
$route['admin/attribute_group/update'] = 'backend/Attribute/updateAttributeGroup';
$route['admin/attribute_group/delete/([0-9]+)'] = 'backend/Attribute/deleteAttributeGroup/$1';

$route['admin/attribute/list'] = 'backend/Attribute/listAttribute';
$route['admin/attribute/new'] = 'backend/Attribute/newAttribute';
$route['admin/attribute/add'] = 'backend/Attribute/addAttribute';
$route['admin/attribute/edit/([0-9]+)'] = 'backend/Attribute/editAttribute/$1';
$route['admin/attribute/update'] = 'backend/Attribute/updateAttribute';
$route['admin/attribute/delete/([0-9]+)'] = 'backend/Attribute/deleteAttribute/$1';

$route['admin/productAttribute'] = 'backend/Attribute/productAttribute';
$route['admin/product/new'] = 'backend/Product';
$route['admin/product/add'] = 'backend/Product/addProduct';
$route['admin/product/list'] = 'backend/Product/productList';
$route['admin/product/upload/([0-9]+)'] = 'backend/Product/uploadMenu/$1';
$route['admin/product/import'] = 'backend/Product/import';
$route['admin/product/edit/([0-9]+)'] = 'backend/Product/productEdit/$1';
$route['admin/product/editcustom/([0-9]+)'] = 'backend/Product/customEdit/$1';
$route['admin/product/update'] = 'backend/Product/updateProduct';
$route['admin/product/component/delete'] = 'backend/Product/deleteComponent';

/* ****************************** Lead Management *********************** */
$route['admin/lead/new']   =  'backend/LeadManagement/leadForm';
$route['admin/lead/add']   =  'backend/LeadManagement/addLead';
$route['admin/leads']   =  'backend/LeadManagement';
$route['admin/lead/edit/([0-9]+)']   =  'backend/LeadManagement/editLead/$1';
$route['admin/lead/update/([0-9]+)']   =  'backend/LeadManagement/updateLead/$1';
$route['admin/lead/view/([0-9]+)']   =  'backend/LeadManagement/viewLead/$1';
$route['admin/lead/comment']   =  'backend/LeadManagement/commentLead';
$route['admin/lead/comment/update']   =  'backend/LeadManagement/updateCommentLead';
$route['admin/lead/comment/delete']   =  'backend/LeadManagement/deleteCommentLead';
$route['admin/lead/assign/executive']   =  'backend/LeadManagement/assignLead';
$route['admin/lead/change/status']   =  'backend/LeadManagement/changeStatusLead';
$route['admin/lead/change/priority']   =  'backend/LeadManagement/changePriority';
$route['admin/lead/history/([0-9]+)']   =  'backend/LeadManagement/leadHistory/$1';
$route['admin/lead/status/history/([0-9]+)']   =  'backend/LeadManagement/statusHistory/$1';
$route['admin/lead/priority/history/([0-9]+)']   =  'backend/LeadManagement/priorityHistory/$1';

/* ********************** Add Admin **************************** */
$route['admin/user/add']   =  'backend/LeadManagement/addAdminUser';
$route['admin/user/new']   =  'backend/LeadManagement/newAdminUser';
$route['admin/user/edit/([0-9]+)']   =  'backend/LeadManagement/editAdminUser/$1';
$route['admin/user/update']   =  'backend/LeadManagement/updateAdminUser';

/* ********************  Add Status ************************* */
$route['admin/status/new']   =  'backend/LeadManagement/newStatus';
$route['admin/status/add']   =  'backend/LeadManagement/addStatus';
$route['admin/status/edit/([0-9]+)']   =  'backend/LeadManagement/editStatus/$1';
$route['admin/status/update']   =  'backend/LeadManagement/updateStatus';

/* **************************** Property *************************** */
$route['admin/property/size/new']   =  'backend/LeadManagement/newPropertySize';
$route['admin/property/size/add']   =  'backend/LeadManagement/addPropertySize';
$route['admin/property/size/edit/([0-9]+)']   =  'backend/LeadManagement/editPropertySize/$1';
$route['admin/property/size/update']   =  'backend/LeadManagement/updatePropertySize';

/* **************************** Sources *************************** */
$route['admin/source/new']   =  'backend/LeadManagement/newSource';
$route['admin/source/add']   =  'backend/LeadManagement/addSource';
$route['admin/source/edit/([0-9]+)']   =  'backend/LeadManagement/editSource/$1';
$route['admin/source/update']   =  'backend/LeadManagement/updateSource';

/* ********************  Add UFOID ************************* */
$route['admin/ufoid']   =  'backend/UFOID';
$route['admin/ufoid/new']   =  'backend/UFOID/newUFOID';
$route['admin/ufoid/add']   =  'backend/UFOID/addUFOID';
$route['admin/ufoid/edit/([0-9]+)']   = 'backend/UFOID/editUFOID/$1';
$route['admin/ufoid/update']   =  'backend/UFOID/updateUFOID';
$route['admin/available/ufo'] =  'backend/UFOID/availableUFO';

/* ************************* Order Management ************************ */
$route['admin/order'] = 'backend/Order/allOrders';
$route['admin/order/pendingorders'] = 'backend/Order/pendingOrders';
$route['admin/order/completedorders'] = 'backend/Order/completedOrders';
$route['admin/order/editform'] = 'backend/Order/editform';
$route['admin/order/view_details/([0-9]+)'] = 'backend/Order/orderDetail/$1';
$route['admin/order/cancelledorders'] = 'backend/Order/cancelledOrders';
$route['admin/order/pendingpaymentorders'] = 'backend/Order/pendingPaymentOrders';
$route['admin/order/failedpaymentorders'] = 'backend/Order/paymentFailedOrders';
$route['admin/order/advanceorders'] = 'backend/Order/advanceOrders';
$route['admin/order/managedelorders'] = 'backend/Order/delOrders';
$route['admin/order/searchorders'] = 'backend/Order/searchOrders';
$route['admin/order/search'] = 'backend/Order/search';
$route['admin/order/place/([0-9]+)'] = 'backend/Order/placeOrder/$1';
$route['admin/order/cancel/([0-9]+)'] = 'backend/Order/cancelOrder/$1';
$route['admin/order/dashboard'] = 'backend/Order';
$route['admin/order/is_rest_first_order/([0-9]+)'] = 'backend/Order/isRestaurantFirstOrder/$1';
$route['admin/order/is_user_first_order/([0-9]+)'] = 'backend/Order/isUserFirstOrder/$1';
//$route['admin/order/neworder'] = 'backend/Order/newOrder';
$route['admin/order/updateorderstatus/([0-9]+)'] = 'backend/Order/updateOrderStatus/$1';
$route['admin/order/invoice/generate/([0-9]+)'] = 'backend/Order/generateInvoice/$1';
$route['admin/order/invoice/([0-9]+)'] = 'backend/Order/invoice/$1';




$route['admin/order/create/([0-9]+)']   =  'backend/UFOID/createOrderByLeadId/$1';
$route['admin/order/neworder']   =  'backend/UFOID/createOrder';
$route['admin/order/add']   =  'backend/UFOID/addOrder';
$route['admin/ufoid/new']   =  'backend/UFOID/newUFOID';
$route['admin/ufoid/add']   =  'backend/UFOID/addUFOID';
$route['admin/ufoid/edit/([0-9]+)']   = 'backend/UFOID/editUFOID/$1';
$route['admin/ufoid/update']   =  'backend/UFOID/updateUFOID';



//-------------------- Added by Tushar --------------------------
$route['admin/manufacture/list'] = 'backend/Vendor/manufactureList';
$route['admin/manufacture/new'] = 'backend/Vendor/manufactureNew';
$route['admin/manufacture/add'] = 'backend/Vendor/addManufacture';
$route['admin/manufacture/edit/([0-9]+)'] = 'backend/Vendor/manufactureEdit/$1';
$route['admin/manufacture/update'] = 'backend/Vendor/updateManufacture';

// ------------------ Websocket and API's for Phynart -------------

$route['admin/phynart/api/get']   =  'backend/LeadManagement/apicall';

//--------------------- Added by Pankaj -------------------------------
/****************************Adding clent from backend ******************/
$route['admin/customer/add'] = 'backend/Customers/addCustomer';
$route['admin/customer/new'] = 'backend/Customers/newCustomer';
$route['admin/customer'] = 'backend/Customers/customerList';
$route['admin/customer/edit/([0-9]+)'] = 'backend/Customers/editCustomer/$1';
$route['admin/customer/update']   =  'backend/Customers/updateCustomer';

/******************** Adding clent's order from backend *****************/
$route['admin/customer/order/new'] = 'backend/Customers/newCustomerOrder';
$route['admin/customer/order/([0-9]+)'] = 'backend/Customers/getaddress/$1';
$route['admin/customer/address/add'] = 'backend/Customers/addNewAddress';
$route['admin/customer/categories'] = 'backend/Customers/getProductsByCategory';
$route['admin/customer/products'] = 'backend/Customers/getProductsByIds';
$route['admin/customer/order/add'] = 'backend/Customers/addCustomerOrder';
$route['admin/customer/order'] = 'backend/Customers/orderList';

