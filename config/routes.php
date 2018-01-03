<?php

$routes->get('/', function() {
  BikeController::index();
});

$routes->get('/login', function() {
  UserController::login();
});

$routes->get('/logout', function() {
  UserController::logout();
});

$routes->post('/login', function() {
  UserController::authenticate();
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

$routes->post('/gear', function() {
  GearController::store();
});

$routes->get('/gear/new', function() {
  GearController::create();
});

$routes->get('/gear/edit/:id', function($id) {
  GearController::edit($id);
});

$routes->post('/gear/delete/:id', function($id) {
  GearController::delete($id);
});

$routes->post('/gear/:id', function($id) {
  GearController::update($id);
});

$routes->get('/gear/:id', function($id) {
  GearController::show($id);
});

$routes->get('/components', function() {
  ComponentController::index();
});

$routes->post('/components', function() {
  ComponentController::store();
});

$routes->get('/component/new', function() {
  ComponentController::create();
});

$routes->get('/component/edit/:id', function($id) {
  ComponentController::edit($id);
});

$routes->post('/component/delete/:id', function($id) {
  ComponentController::delete($id);
});

$routes->post('/component/:id', function($id) {
  ComponentController::update($id);
});

$routes->get('/component/:id', function($id) {
  ComponentController::show($id);
});

$routes->get('/sandbox', function() {
  HelloWorldController::sandbox();
});
