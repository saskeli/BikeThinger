<?php

$routes->get('/', function() {
  BikeController::index();
});

$routes->get('/bikes', function() {
  BikeController::index();
});

$routes->get('/bikes/:id', function($id) {
	BikeController::show($id);
});

$routes->get('/sandbox', function() {
  HelloWorldController::sandbox();
});

$routes->get('/gear', function() {
  HelloWorldController::Gear();
});

$routes->get('/components', function() {
  HelloWorldController::Components();
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