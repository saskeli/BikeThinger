<?php

$routes->get('/', function() {
  HelloWorldController::index();
});

$routes->get('/sandbox', function() {
  HelloWorldController::sandbox();
});

$routes->get('/bikes', function() {
  BikeController::index();
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