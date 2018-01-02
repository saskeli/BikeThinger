<?php

$routes->get('/', function() {
  BikeController::index();
});

$routes->get('/bikes', function() {
  BikeController::index();
});

$routes->post('/bikes', function() {
  BikeController::store();
});

$routes->get('/bike/new', function() {
  BikeController::create();
});

$routes->get('/bike/edit/:id', function($id) {
  BikeController::edit($id);
});

$routes->post('/bike/delete/:id', function($id) {
  BikeController::delete($id);
});

$routes->get('/bike/:id', function($id) {
  BikeController::show($id);
});

$routes->post('/bike/:id', function($id) {
  BikeController::update($id);
});

$routes->get('/gear', function() {
  GearController::index();
});

$routes->get('/gear/:id', function($id) {
  GearController::show($id);
});

$routes->get('/components', function() {
  ComponentController::index();
});

$routes->get('/component/:id', function($id) {
  ComponentController::show($id);
});

$routes-> get('/login', function() {
  HelloWorldController::Login();
});

$routes-> get('/edit', function() {
  HelloWorldController::Edit();
});

$routes-> get('/details', function() {
  HelloWorldController::Details();
});

$routes->get('/sandbox', function() {
  HelloWorldController::sandbox();
});
