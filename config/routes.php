<?php

$routes->get('/', function() {
  HelloWorldController::index();
});

$routes->get('/sandbox', function() {
  HelloWorldController::sandbox();
});

$routes->get('/bikes', function() {
  HelloWorldController::Bikes();
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