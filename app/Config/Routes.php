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

$routes->get('/login', 'Auth::pnpLogin');
$routes->get('/pnp/login', 'Auth::pnpLogin');
$routes->get('/pnp/logout', 'Auth::pnpLogout');
$routes->get('/b2b/login', 'Auth::b2bLogin');
$routes->get('/b2b/logout', 'Auth::b2bLogout');

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
$routes->post('/pnp/save-masterlist-notes', 'pnp\Order::saveMasterlistNotes');
$routes->get('/pnp/get-purchase-item', 'pnp\Order::getItem');
$routes->post('/pnp/save-buyers', 'pnp\Order::saveBuyersItem');

$routes->get('/pnp/shipments', 'pnp\Home::shipments');
$routes->post('/pnp/shipments', 'pnp\Shipment::addToNTU');
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
$routes->get('/pnp/get-client', 'Clients::getClient');
$routes->post('/pnp/save-status-order', 'pnp\Order::saveStatusOrder');
$routes->post('/pnp/save-client-order', 'pnp\Order::saveClientOrder');
$routes->post('/pnp/save-notes-order', 'pnp\Order::saveNotesOrder');

$routes->post('/pnp/save-fnsku', 'pnp\Order::saveFNSKU');
$routes->post('/pnp/save-vendor-name', 'pnp\Order::saveVendorName');
$routes->post('/pnp/save-assigned-notes', 'pnp\Order::saveAssignedNotes');
$routes->post('/pnp/save-fba-number', 'pnp\Order::saveFBANumber');
$routes->post('/pnp/save-shipment-number', 'pnp\Order::saveShipmentNumber');
$routes->post('/pnp/save-dimensions', 'pnp\Order::saveBoxDimensions');
$routes->get('/pnp/export-need-to-upload', 'pnp\Order::exportNeedToUpload');
$routes->get('/pnp/export-need-to-upload/(:any)', 'pnp\Order::exportNeedToUpload/$1');
$routes->post('/pnp/save-assign-item', 'pnp\Order::saveItems');

// admin


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
$routes->get('/pnp/refunds', 'pnp\Home::refunds');
$routes->get('/pnp/export-refunds', 'pnp\API::exportRefund');
$routes->get('/pnp/export-refunds/(:any)', 'pnp\API::exportRefund/$1');
$routes->get('/pnp/chat', 'pnp\Home::chat');


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
$routes->post('/add-new-client', 'Clients::addClient');

$routes->post('/send-message', 'pnp\Messages::sendMessage');

// PnP End

// b2b Start
$routes->post('/b2b/upload-files', 'b2b\Purchase::uploadFiles');
$routes->get('/b2b/download-asin-data', 'b2b\Purchase::downloadASINData');
$routes->post('/b2b/upload-asin-file', 'b2b\Purchase::uploadASINData');
$routes->post('/b2b/upload-file','b2b\Purchase::uploadFile2');
$routes->post('/b2b/upload-file2','b2b\Purchase::uploadFile2');
$routes->post('/b2b/upload-data','b2b\Purchase::addProductDetails3');
$routes->post('/b2b/upload-data2','b2b\Purchase::addProductDetails2');
$routes->get('/b2b/download-file/(:any)', 'Leads::downlaodFile/$1');

$routes->post('/b2b/edit-template-files', 'b2b\Purchase::updateTemplate');
$routes->post('/b2b/upload-template-files', 'b2b\Purchase::uploadTemplateFiles');
$routes->get('/b2b/purchase/open-purchase-list/(:any)', 'b2b\Purchase::openFile/$1');
$routes->get('/b2b/purchase/open-purchased-list/', 'b2b\Order::openFile');
$routes->post('/b2b/tick-item', 'b2b\Purchase::tickItem');
$routes->get('/b2b/get-item-notes', 'b2b\Purchase::getItemNotes');
$routes->post('/b2b/save-notes', 'b2b\Purchase::saveItemNotes');
$routes->post('/b2b/save-purchase-list', 'b2b\Order::savePurchaseList');
$routes->post('/b2b/save-qty', 'b2b\Order::saveQty');
$routes->post('/b2b/save-size', 'b2b\Order::saveSize');
$routes->post('/b2b/save-staff', 'b2b\Order::saveStaff');
$routes->get('/b2b/get-purchase-item', 'b2b\Order::getItem');
$routes->post('/b2b/save-buyers', 'b2b\Order::saveBuyersItem');

$routes->get('/b2b/shipments', 'b2b\Home::shipments');
$routes->post('/b2b/shipments', 'b2b\Shipment::addToShipments');
$routes->post('/b2b/tracking-shipment', 'b2b\Shipment::trackingShipment');
$routes->post('/b2b/input-shipment', 'b2b\Shipment::inputShipment');
$routes->get('/b2b/tracking-detail', 'b2b\Shipment::getTrackingInfo');
$routes->get('/b2b/refresh-tracking', 'b2b\Shipment::updateTracking');
$routes->get('/b2b/get-shipment-info-by-item', 'b2b\Shipment::getShipmentInfoByItem');

$routes->post('/b2b/save-clients', 'b2b\Order::saveClients');
$routes->post('/b2b/save-clients-status', 'b2b\Order::saveClientStatus');
$routes->post('/b2b/save-qty-received', 'b2b\Order::saveQtyReceived');
$routes->post('/b2b/save-qty-returned', 'b2b\Order::saveQtyReturned');
$routes->post('/b2b/save-qty-assigned', 'b2b\Order::saveQtyAssigned');
$routes->post('/b2b/add-new-assign', 'b2b\Order::addNewAssign');
$routes->post('/b2b/delete-assign-data', 'b2b\Order::deleteAssignData');
$routes->get('/b2b/get-client-list', 'b2b\Order::getClientList');
$routes->get('/b2b/get-client', 'Clients::getClient');
$routes->post('/b2b/save-status-order', 'b2b\Order::saveStatusOrder');
$routes->post('/b2b/save-client-order', 'b2b\Order::saveClientOrder');
$routes->post('/b2b/save-notes-order', 'b2b\Order::saveNotesOrder');

$routes->post('/b2b/save-fnsku', 'b2b\Order::saveFNSKU');
$routes->post('/b2b/save-vendor-name', 'b2b\Order::saveVendorName');
$routes->post('/b2b/save-assigned-notes', 'b2b\Order::saveAssignedNotes');
$routes->post('/b2b/save-fba-number', 'b2b\Order::saveFBANumber');
$routes->post('/b2b/save-shipment-number', 'b2b\Order::saveShipmentNumber');
$routes->get('/b2b/export-need-to-upload', 'b2b\Order::exportNeedToUpload');
$routes->get('/b2b/export-need-to-upload/(:any)', 'b2b\Order::exportNeedToUpload/$1');
$routes->post('/b2b/save-assign-item', 'b2b\Order::saveItems');
$routes->get('/b2b/chat', 'b2b\Home::chat');

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

$routes->get('/get-avail-dates-b2b', 'b2b\Leads::getAvailDates');
// b2b end


// API Box
$routes->post('/add-new-box', 'pnp\Purchase::addNewBox');
$routes->post('/delete-box', 'pnp\Purchase::deleteBox');
$routes->post('/update-box-name', 'pnp\Purchase::updateBoxName');
$routes->post('/update-total-allocation', 'pnp\Purchase::updateTotalAllocation');
$routes->get('/get-all-box-name', 'pnp\API::getAllBoxName');
$routes->get('/get-lead-data', 'pnp\API::getLeadData');

$routes->post('/split-data', 'pnp\API::splitData');
$routes->post('/update-shipping-cost', 'pnp\API::updateShippingCost');
$routes->post('/update-shipping-notes', 'pnp\API::updateShippingNotes');
$routes->post('/change-buycost', 'pnp\API::changeBuyCost');

$routes->get('/admin/users', 'Home::users');
$routes->get('/admin/history', 'Home::history');
$routes->get('/admin/chat', 'Home::chat');
$routes->get('/admin/invoices', 'Home::invoices');
$routes->get('/admin/chat/(:any)', 'Home::chat/$1');
$routes->get('/admin/master-lists', 'Home::masterListAll');
$routes->get('/get-user', 'Auth::getUser');
$routes->get('/get-total-unit-client', 'Invoices::getClientTotalUnit');
$routes->post('/save-invoice', 'Invoices::saveInvoice');
$routes->get('/get-client/(:any)', 'Invoices::getClientData/$1');
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
