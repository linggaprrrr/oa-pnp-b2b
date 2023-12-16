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


$routes->get('/pnp/login', 'Auth::pnpLogin');
$routes->get('/b2b/login', 'Auth::b2bLogin');

// Auth
$routes->post('/pnp/log-in', 'Auth::pnpLoginProcess');
$routes->post('/b2b/log-in', 'Auth::b2bLoginProcess');
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

// PnP Start

// Purchase Page
$routes->post('/pnp/upload-files', 'pnp\Purchase::uploadFiles');
$routes->get('/pnp/download-asin-data', 'pnp\Purchase::downloadASINData');
$routes->post('/pnp/upload-asin-file', 'pnp\Purchase::uploadASINData');
$routes->post('/pnp/upload-file','pnp\Purchase::uploadFile');
$routes->post('/pnp/upload-file2','pnp\Purchase::uploadFile2');
$routes->post('/pnp/upload-data','pnp\Purchase::addProductDetails');
$routes->post('/pnp/upload-data2','pnp\Purchase::addProductDetails2');
$routes->get('/pnp/download-file/(:any)', 'pnp\Leads::downlaodFile/$1');

$routes->post('/pnp/edit-template-files', 'pnp\Purchase::updateTemplate');
$routes->post('/pnp/upload-template-files', 'pnp\Purchase::uploadTemplateFiles');
$routes->get('/pnp/purchase/open-purchase-list/(:any)', 'pnp\Purchase::openFile/$1');
$routes->get('/pnp/purchase/open-purchased-list/', 'pnp\Order::openFile');
$routes->post('/pnp/tick-item', 'pnp\Purchase::tickItem');
$routes->get('/pnp/get-item-notes', 'pnp\Purchase::getItemNotes');
$routes->post('/pnp/save-notes', 'pnp\Purchase::saveItemNotes');
$routes->post('/pnp/save-purchase-list', 'pnp\Order::savePurchaseList');
$routes->post('/pnp/save-qty', 'pnp\Order::saveQty');
$routes->post('/pnp/save-size', 'pnp\Order::saveSize');
$routes->post('/pnp/save-staff', 'pnp\Order::saveStaff');
$routes->get('/pnp/get-purchase-item', 'pnp\Order::getItem');
$routes->post('/pnp/save-buyers', 'pnp\Order::saveBuyersItem');

$routes->get('/pnp/shipments', 'pnp\Home::shipments');
$routes->post('/pnp/shipments', 'pnp\Shipment::addToShipments');
$routes->post('/pnp/tracking-shipment', 'pnp\Shipment::trackingShipment');
$routes->post('/pnp/input-shipment', 'pnp\Shipment::inputShipment');
$routes->get('/pnp/tracking-detail', 'pnp\Shipment::getTrackingInfo');
$routes->get('/pnp/refresh-tracking', 'pnp\Shipment::updateTracking');
$routes->get('/pnp/get-shipment-info-by-item', 'pnp\Shipment::getShipmentInfoByItem');

$routes->post('/pnp/save-clients', 'pnp\Order::saveClients');
$routes->post('/pnp/save-clients-status', 'pnp\Order::saveClientStatus');
$routes->post('/pnp/save-qty-received', 'pnp\Order::saveQtyReceived');
$routes->post('/pnp/save-qty-returned', 'pnp\Order::saveQtyReturned');
$routes->post('/pnp/save-qty-assigned', 'pnp\Order::saveQtyAssigned');
$routes->post('/pnp/add-new-assign', 'pnp\Order::addNewAssign');
$routes->post('/pnp/delete-assign-data', 'pnp\Order::deleteAssignData');
$routes->get('/pnp/get-client-list', 'pnp\Order::getClientList');
$routes->get('/pnp/get-client', 'pnp\Clients::getClient');
$routes->post('/pnp/save-status-order', 'pnp\Order::saveStatusOrder');
$routes->post('/pnp/save-client-order', 'pnp\Order::saveClientOrder');
$routes->post('/pnp/save-notes-order', 'pnp\Order::saveNotesOrder');

$routes->post('/pnp/save-fnsku', 'pnp\Order::saveFNSKU');
$routes->post('/pnp/save-vendor-name', 'pnp\Order::saveVendorName');
$routes->post('/pnp/save-assigned-notes', 'pnp\Order::saveAssignedNotes');
$routes->post('/pnp/save-fba-number', 'pnp\Order::saveFBANumber');
$routes->post('/pnp/save-shipment-number', 'pnp\Order::saveShipmentNumber');
$routes->get('/pnp/export-need-to-upload', 'pnp\Order::exportNeedToUpload');
$routes->get('/pnp/export-need-to-upload/(:any)', 'pnp\Order::exportNeedToUpload/$1');
$routes->post('/pnp/save-assign-item', 'pnp\Order::saveItems');

// admin
$routes->get('/pnp/admin/users', 'pnp\Home::users');
$routes->get('/pnp/admin/master-lists', 'pnp\Home::masterListAll');
$routes->get('/pnp/get-user', 'Auth::getUser');
$routes->post('/pnp/update-subscription', 'pnp\Payments::updateSubscription');
$routes->post('/pnp/create-paypal-order', 'pnp\Payments::transaction');

// Client Page
$routes->get('/pnp/dashboard', 'pnp\Home::dashboard');
$routes->get('/pnp/leads-list', 'pnp\Home::leadsList');
$routes->get('/pnp/leads-list/downloadable', 'pnp\Home::leadsListDownloadable');
$routes->get('/pnp/selections', 'pnp\Home::selections');
$routes->get('/pnp/purchases-list', 'pnp\Home::purchasesList');
$routes->get('/pnp/master-lists', 'pnp\Home::masterLists');
$routes->get('/pnp/company-lists', 'pnp\Home::companyList');
$routes->get('/pnp/assignments', 'pnp\Home::assignments');
$routes->get('/pnp/clients', 'pnp\Home::clients');
$routes->get('/pnp/inventories', 'pnp\Home::inventories');
$routes->get('/pnp/upc-lookup', 'pnp\Home::UPCLookup');
$routes->get('/pnp/open-purchased-list', 'pnp\Order::openFile');
$routes->get('/pnp/need-to-upload', 'pnp\Home::needToUpload');
$routes->post('/pnp/add-user', 'pnp\Home::addUser');
$routes->get('/pnp/file-parameter', 'pnp\Home::fileParameter');
$routes->post('/pnp/upload-upc-files', 'pnp\API::getUPCDetails');
$routes->get('/pnp/backup-and-restore', 'pnp\Home::backuprestore');
$routes->get('/pnp/history', 'pnp\Home::history');

$routes->get('/pnp/uploader/upload-file', 'pnp\Home::leadsList');
$routes->get('/pnp/uploader/selections', 'pnp\Home::selections');
$routes->get('/pnp/uploader/file-parameter', 'pnp\Home::fileParameter');
$routes->post('/pnp/change-profit', 'pnp\Purchase::changeProfit');
$routes->post('/pnp/change-roi', 'pnp\Purchase::changeROI');
$routes->post('/pnp/change-status', 'pnp\Purchase::changeStatus');

// API
$routes->get('/get-client-api', 'pnp\Home::test2');
$routes->post('/sync-pattern', 'pnp\Purchase::syncPattern');
$routes->get('/get-pattern', 'pnp\Purchase::getPattern');
$routes->get('/test-api', 'pnp\Home::test2');
$routes->get('/test-api2', 'pnp\Home::test2');

$routes->get('/get-leads', 'pnp\Leads::index');
$routes->get('/get-leads-by-date/(:any)', 'pnp\Leads::index/$1');
$routes->get('/get-leads/(:num)', 'pnp\Leads::show/$1');
$routes->get('/get-avail-dates', 'pnp\Leads::getAvailDates');
$routes->post('/read-excel', 'pnp\Leads::readExcel');
$routes->post('/update-token-api', 'pnp\Leads::updateTokenAPI');
$routes->get('/get-token-left', 'pnp\Leads::getTokenLeft');

$routes->get('/encrypt-file', 'pnp\Files::test');
$routes->get('/download-backup/(:any)/(:any)', 'pnp\Files::downloadBackUp/$1/$2');
$routes->post('/restore-data', 'pnp\Files::restoreData');
$routes->post('/add-new-client', 'pnp\Clients::addClient');

// PnP End

// b2b Start
$routes->post('/b2b/upload-files', 'Purchase::uploadFiles');
$routes->get('/b2b/download-asin-data', 'Purchase::downloadASINData');
$routes->post('/b2b/upload-asin-file', 'Purchase::uploadASINData');
$routes->post('/b2b/upload-file','Purchase::uploadFile2');
$routes->post('/b2b/upload-file2','Purchase::uploadFile2');
$routes->post('/b2b/upload-data','Purchase::addProductDetails3');
$routes->post('/b2b/upload-data2','Purchase::addProductDetails2');
$routes->get('/b2b/download-file/(:any)', 'Leads::downlaodFile/$1');

$routes->post('/b2b/edit-template-files', 'Purchase::updateTemplate');
$routes->post('/b2b/upload-template-files', 'Purchase::uploadTemplateFiles');
$routes->get('/b2b/purchase/open-purchase-list/(:any)', 'Purchase::openFile/$1');
$routes->get('/b2b/purchase/open-purchased-list/', 'Order::openFile');
$routes->post('/b2b/tick-item', 'Purchase::tickItem');
$routes->get('/b2b/get-item-notes', 'Purchase::getItemNotes');
$routes->post('/b2b/save-notes', 'Purchase::saveItemNotes');
$routes->post('/b2b/save-purchase-list', 'Order::savePurchaseList');
$routes->post('/b2b/save-qty', 'Order::saveQty');
$routes->post('/b2b/save-size', 'Order::saveSize');
$routes->post('/b2b/save-staff', 'Order::saveStaff');
$routes->get('/b2b/get-purchase-item', 'Order::getItem');
$routes->post('/b2b/save-buyers', 'Order::saveBuyersItem');

$routes->get('/b2b/shipments', 'b2b\Home::shipments');
$routes->post('/b2b/shipments', 'Shipment::addToShipments');
$routes->post('/b2b/tracking-shipment', 'Shipment::trackingShipment');
$routes->post('/b2b/input-shipment', 'Shipment::inputShipment');
$routes->get('/b2b/tracking-detail', 'Shipment::getTrackingInfo');
$routes->get('/b2b/refresh-tracking', 'Shipment::updateTracking');
$routes->get('/b2b/get-shipment-info-by-item', 'Shipment::getShipmentInfoByItem');

$routes->post('/b2b/save-clients', 'Order::saveClients');
$routes->post('/b2b/save-clients-status', 'Order::saveClientStatus');
$routes->post('/b2b/save-qty-received', 'Order::saveQtyReceived');
$routes->post('/b2b/save-qty-returned', 'Order::saveQtyReturned');
$routes->post('/b2b/save-qty-assigned', 'Order::saveQtyAssigned');
$routes->post('/b2b/add-new-assign', 'Order::addNewAssign');
$routes->post('/b2b/delete-assign-data', 'Order::deleteAssignData');
$routes->get('/b2b/get-client-list', 'Order::getClientList');
$routes->get('/b2b/get-client', 'Clients::getClient');
$routes->post('/b2b/save-status-order', 'Order::saveStatusOrder');
$routes->post('/b2b/save-client-order', 'Order::saveClientOrder');
$routes->post('/b2b/save-notes-order', 'Order::saveNotesOrder');

$routes->post('/b2b/save-fnsku', 'Order::saveFNSKU');
$routes->post('/b2b/save-vendor-name', 'Order::saveVendorName');
$routes->post('/b2b/save-assigned-notes', 'Order::saveAssignedNotes');
$routes->post('/b2b/save-fba-number', 'Order::saveFBANumber');
$routes->post('/b2b/save-shipment-number', 'Order::saveShipmentNumber');
$routes->get('/b2b/export-need-to-upload', 'Order::exportNeedToUpload');
$routes->get('/b2b/export-need-to-upload/(:any)', 'Order::exportNeedToUpload/$1');
$routes->post('/b2b/save-assign-item', 'Order::saveItems');

// admin
$routes->get('/b2b/admin/users', 'b2b\Home::users');
$routes->get('/b2b/admin/master-lists', 'b2b\Home::masterListAll');
$routes->get('/b2b/get-user', 'Auth::getUser');
$routes->post('/b2b/update-subscription', 'Payments::updateSubscription');
$routes->post('/b2b/create-paypal-order', 'Payments::transaction');

// Client Page
$routes->get('/b2b/dashboard', 'b2b\Home::dashboard');
$routes->get('/b2b/leads-list', 'b2b\Home::leadsList');
$routes->get('/b2b/leads-list/downloadable', 'b2b\Home::leadsListDownloadable');
$routes->get('/b2b/selections', 'b2b\Home::selections');
$routes->get('/b2b/purchases-list', 'b2b\Home::purchasesList');
$routes->get('/b2b/master-lists', 'b2b\Home::masterLists');
$routes->get('/b2b/company-lists', 'b2b\Home::companyList');
$routes->get('/b2b/assignments', 'b2b\Home::assignments');
$routes->get('/b2b/clients', 'b2b\Home::clients');
$routes->get('/b2b/inventories', 'b2b\Home::inventories');
$routes->get('/b2b/upc-lookup', 'b2b\Home::UPCLookup');
$routes->get('/b2b/open-purchased-list', 'Order::openFile');
$routes->get('/b2b/need-to-upload', 'b2b\Home::needToUpload');
$routes->post('/b2b/add-user', 'b2b\Home::addUser');
$routes->get('/b2b/file-parameter', 'b2b\Home::fileParameter');
$routes->post('/b2b/upload-upc-files', 'API::getUPCDetails');
$routes->get('/b2b/backup-and-restore', 'b2b\Home::backuprestore');
$routes->get('/b2b/cc-user', 'b2b\Home::CCUser');
$routes->get('/b2b/history', 'b2b\Home::history');

$routes->get('/b2b/uploader/upload-file', 'b2b\Home::leadsList');
$routes->get('/b2b/uploader/selections', 'b2b\Home::selections');
$routes->get('/b2b/uploader/file-parameter', 'b2b\Home::fileParameter');
$routes->post('/b2b/change-profit', 'Purchase::changeProfit');
$routes->post('/b2b/change-roi', 'Purchase::changeROI');
$routes->post('/b2b/change-status', 'Purchase::changeStatus');

// b2b end


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
