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
$routes->get('/', 'Auth::index');
$routes->get('/login', 'Auth::index');

// Auth
$routes->post('/log-in', 'Auth::loginProcess');
$routes->get('/logout', 'Auth::logout');
$routes->get('/profile', 'Auth::profile'); 
$routes->get('/documentation', 'Auth::documentation'); 
$routes->post('/update-profile', 'Auth::updateProfile');
$routes->post('/update-user', 'Auth::updateUser');

// Purchase Page
$routes->get('/home-test', 'Purchase::index');
$routes->get('/purchase/dashboard', 'Home::purchase');
$routes->get('/purchase/leads-list', 'Home::leadsList');
$routes->get('/purchase/selections', 'Home::selections');
$routes->get('/purchase/selections/(:any)', 'Home::selections/$1');
$routes->get('/purchase/purchases-list', 'Home::purchasesList');
$routes->get('/purchase/file-parameter', 'Home::fileParameter');
$routes->get('/purchase/history', 'Home::history');

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

$routes->get('/admin/shipments', 'Home::shipments');
$routes->post('/shipments', 'Shipment::addToShipments');
$routes->post('/tracking-shipment', 'Shipment::trackingShipment');
$routes->post('/input-shipment', 'Shipment::inputShipment');
$routes->get('/tracking-detail', 'Shipment::getTrackingInfo');
$routes->get('/refresh-tracking', 'Shipment::updateTracking');
$routes->get('/get-shipment-info-by-item', 'Shipment::getShipmentInfoByItem');


// Warehouse Page
$routes->get('/warehouse/dashboard', 'Home::warehouse');
$routes->get('/warehouse/master-lists', 'Home::masterLists');
$routes->get('/warehouse/company-lists', 'Home::companyList');
$routes->get('/warehouse/assignments', 'Home::assignments');
$routes->get('/warehouse/inventories', 'Home::inventories');
$routes->get('/warehouse/need-to-upload', 'Home::needToUpload');
$routes->get('/warehouse/history', 'Home::history');

$routes->get('/warehouse/open-master-list', 'Order::openMasterFile');
$routes->post('/save-clients', 'Order::saveClients');
$routes->post('/save-clients-status', 'Order::saveClientStatus');
$routes->post('/save-qty-received', 'Order::saveQtyReceived');
$routes->post('/save-qty-returned', 'Order::saveQtyReturned');
$routes->post('/save-qty-assigned', 'Order::saveQtyAssigned');
$routes->post('/add-new-assign', 'Order::addNewAssign');
$routes->post('/delete-assign-data', 'Order::deleteAssignData');
$routes->get('/get-client-list', 'Order::getClientList');
$routes->get('/get-client', 'Auth::getClient');
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


// Admin Page
$routes->get('/admin/dashboard', 'Home::dashboard');
$routes->get('/admin/leads-list', 'Home::leadsList');
$routes->get('/admin/leads-list/downloadable', 'Home::leadsListDownloadable');
$routes->get('/admin/selections', 'Home::selections');
$routes->get('/admin/purchases-list', 'Home::purchasesList');
$routes->get('/admin/master-lists', 'Home::masterLists');
$routes->get('/admin/company-lists', 'Home::companyList');
$routes->get('/admin/assignments', 'Home::assignments');
$routes->get('/admin/inventories', 'Home::inventories');
$routes->get('/admin/upc-lookup', 'Home::UPCLookup');
$routes->get('/admin/open-purchased-list/', 'Order::openFile');
$routes->get('/admin/need-to-upload', 'Home::needToUpload');
$routes->get('/admin/users', 'Home::users');
$routes->post('/add-user', 'Home::addUser');
$routes->get('/admin/file-parameter', 'Home::fileParameter');
$routes->post('/upload-upc-files', 'API::getUPCDetails');
$routes->get('/admin/history', 'Home::history');


// API
$routes->get('/get-client-api', 'Home::test2');
$routes->post('/sync-pattern', 'Purchase::syncPattern');
$routes->get('/get-pattern', 'Purchase::getPattern');
$routes->get('/test-api', 'Home::test2');
$routes->get('/test-api2', 'Home::test2');

$routes->get('/get-leads', 'Leads::index');
$routes->get('/get-leads/(:num)', 'Leads::show/$1');
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