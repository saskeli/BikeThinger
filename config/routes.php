<?php

  $routes->get('/', function() {
    HelloWorldController::index();
  });

  $routes->get('/sandbox', function() {
    HelloWorldController::sandbox();
  });
