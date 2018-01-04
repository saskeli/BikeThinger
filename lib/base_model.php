<?php

  class BaseModel{
    public function __construct($attributes = null){
      foreach($attributes as $attribute => $value){
        if(property_exists($this, $attribute)){
          $this->{$attribute} = $value;
        }
      }
    }

    public function errors(){
      $validator = new Valitron\Validator(array(
        'user_id' => $this->name,
        'distance' => $this->distance,
        'name' => $this->name,
        'model' => $this->model,
        'link' => $this->link,
        'year' => $this->year,
        'description' => $this->description));
      $validator->rule('required', ['name', 'distance']);
      $validator->rule('required', ['model', 'link', 'year', 'description'], true);
      $validator->rule('lengthMax', 'name', 50);
      $validator->rule('lengthMax', ['model', 'link', 'description'], 400);
      $validator->rule('numeric', 'distance');
      $validator->rule('integer', 'year');
      $validator->rule('url', 'link');
      $validator->rule('min', 'distance', 0);
      $valid = $validator->validate();
      $err = $validator->errors();
      $errors = array();
      foreach ($err as $param => $earr) {
        foreach ($earr as $index => $issue) {
          $errors[] = $issue;
        }
      }
      return $errors;
    }

  }
