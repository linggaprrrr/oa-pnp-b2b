<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');

$routes->setTranslateURIDashes(false);
$routes->set404Override();
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
// $routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Auth::homepage');
$routes->get('/features', 'Auth::features');
$routes->get('/pricing', 'Auth::pricing');
$routes->get('/about', 'Auth::about');


$routes->get('/login', 'Auth::index');

// Auth
$routes->post('/log-in', 'Auth::loginProcess');
$routes->get('/login/process', 'Auth::googleOAuth');
$routes->get('/sign-up', 'Auth::signup');
$routes->get('/forgot-password', 'Auth::forgotPassword');
$routes->post('/sign-up-process', 'Auth::signupProcess');
$routes->post('/forgot-password-process', 'Auth::forgotPasswordProcess');
$routes->get('/reset-password', 'Auth::resetPassword');
$routes->post('/reset-password', 'Auth::resetPasswordProcess');
$routes->get('/logout', 'Auth::logout');
$routes->get('/profile', 'Auth::profile'); 
$routes->get('/documentation', 'Auth::documentation'); 
$routes->post('/update-profile', 'Auth::updateProfile');
$routes->post('/update-user', 'Auth::updateUser');
$routes->post('/update-client', 'Clients::updateClient');

// Purchase Page
$routes->post('/upload-files', 'Purchase::uploadFiles');
$routes->get('/download-asin-data', 'Purchase::downloadASINData');
$routes->post('/upload-asin-file', 'Purchase::uploadASINData');
$routes->post('/upload-file','Purchase::uploadFile');
$routes->post('/upload-file2','Purchase::uploadFile2');
$routes->post('/upload-data','Purchase::addProductDetails');
$routes->post('/upload-data2','Purchase::addProductDetails2');
$routes->get('/download-file/(:any)', 'Leads::downlaodFile/$1');

$routes->post('/edit-template-files', 'Purchase::updateTemplate');
$routes->post('/upload-template-files', 'Purchase::uploadTemplateFiles');
$routes->get('/purchase/open-purchase-list/(:any)', 'Purchase::openFile/$1');
$routes->get('/purchase/open-purchased-list/', 'Order::openFile');
$routes->post('/tick-item', 'Purchase::tickItem');
$routes->get('/get-item-notes', 'Purchase::getItemNotes');
$routes->post('/save-notes', 'Purchase::saveItemNotes');
$routes->post('/save-purchase-list', 'Order::savePurchaseList');
$routes->post('/save-qty', 'Order::saveQty');
$routes->post('/save-size', 'Order::saveSize');
$routes->post('/save-staff', 'Order::saveStaff');
$routes->get('/get-purchase-item', 'Order::getItem');
$routes->post('/save-buyers', 'Order::saveBuyersItem');

$routes->get('/shipments', 'Home::shipments');
$routes->post('/shipments', 'Shipment::addToShipments');
$routes->post('/tracking-shipment', 'Shipment::trackingShipment');
$routes->post('/input-shipment', 'Shipment::inputShipment');
$routes->get('/tracking-detail', 'Shipment::getTrackingInfo');
$routes->get('/refresh-tracking', 'Shipment::updateTracking');
$routes->get('/get-shipment-info-by-item', 'Shipment::getShipmentInfoByItem');

$routes->post('/save-clients', 'Order::saveClients');
$routes->post('/save-clients-status', 'Order::saveClientStatus');
$routes->post('/save-qty-received', 'Order::saveQtyReceived');
$routes->post('/save-qty-returned', 'Order::saveQtyReturned');
$routes->post('/save-qty-assigned', 'Order::saveQtyAssigned');
$routes->post('/add-new-assign', 'Order::addNewAssign');
$routes->post('/delete-assign-data', 'Order::deleteAssignData');
$routes->get('/get-client-list', 'Order::getClientList');
$routes->get('/get-client', 'Clients::getClient');
$routes->post('/save-status-order', 'Order::saveStatusOrder');
$routes->post('/save-client-order', 'Order::saveClientOrder');
$routes->post('/save-notes-order', 'Order::saveNotesOrder');

$routes->post('/save-fnsku', 'Order::saveFNSKU');
$routes->post('/save-vendor-name', 'Order::saveVendorName');
$routes->post('/save-assigned-notes', 'Order::saveAssignedNotes');
$routes->post('/save-fba-number', 'Order::saveFBANumber');
$routes->post('/save-shipment-number', 'Order::saveShipmentNumber');
$routes->get('/export-need-to-upload', 'Order::exportNeedToUpload');
$routes->get('/export-need-to-upload/(:any)', 'Order::exportNeedToUpload/$1');
$routes->post('/save-assign-item', 'Order::saveItems');

// admin
$routes->get('/admin/users', 'Home::users');
$routes->get('/admin/master-lists', 'Home::masterListAll');
$routes->get('/get-user', 'Auth::getUser');
$routes->post('/update-subscription', 'Payments::updateSubscription');
$routes->post('/create-paypal-order', 'Payments::transaction');

// Client Page
$routes->get('/dashboard', 'Home::dashboard');
$routes->get('/leads-list', 'Home::leadsList');
$routes->get('/leads-list/downloadable', 'Home::leadsListDownloadable');
$routes->get('/selections', 'Home::selections');
$routes->get('/purchases-list', 'Home::purchasesList');
$routes->get('/master-lists', 'Home::masterLists');
$routes->get('/company-lists', 'Home::companyList');
$routes->get('/assignments', 'Home::assignments');
$routes->get('/clients', 'Home::clients');
$routes->get('/inventories', 'Home::inventories');
$routes->get('/upc-lookup', 'Home::UPCLookup');
$routes->get('/open-purchased-list', 'Order::openFile');
$routes->get('/need-to-upload', 'Home::needToUpload');
$routes->post('/add-user', 'Home::addUser');
$routes->get('/file-parameter', 'Home::fileParameter');
$routes->post('/upload-upc-files', 'API::getUPCDetails');
$routes->get('/backup-and-restore', 'Home::backuprestore');
$routes->get('/history', 'Home::history');

$routes->get('/uploader/upload-file', 'Home::leadsList');
$routes->get('/uploader/selections', 'Home::selections');
$routes->get('/uploader/file-parameter', 'Home::fileParameter');
$routes->post('/change-profit', 'Purchase::changeProfit');
$routes->post('/change-roi', 'Purchase::changeROI');
$routes->post('/change-status', 'Purchase::changeStatus');


// API
$routes->get('/get-client-api', 'Home::test2');
$routes->post('/sync-pattern', 'Purchase::syncPattern');
$routes->get('/get-pattern', 'Purchase::getPattern');
$routes->get('/test-api', 'Home::test2');
$routes->get('/test-api2', 'Home::test2');

$routes->get('/get-leads', 'Leads::index');
$routes->get('/get-leads-by-date/(:any)', 'Leads::index/$1');
$routes->get('/get-leads/(:num)', 'Leads::show/$1');
$routes->get('/get-avail-dates', 'Leads::getAvailDates');
$routes->post('/read-excel', 'Leads::readExcel');
$routes->post('/update-token-api', 'Leads::updateTokenAPI');
$routes->get('/get-token-left', 'Leads::getTokenLeft');

$routes->get('/encrypt-file', 'Files::test');
$routes->get('/download-backup/(:any)/(:any)', 'Files::downloadBackUp/$1/$2');
$routes->post('/restore-data', 'Files::restoreData');
$routes->post('/add-new-client', 'Clients::addClient');
/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
