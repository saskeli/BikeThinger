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
      $validator->rule('lengthMax', 'name', 50);
      $validator->rule('numeric', 'distance');
      $validator->rule('min', 'distance', 0);
      if ($this->model) {
        $validator->rule('required', 'model');
        $validator->rule('lengthMax', 'model', 400);
      }
      if ($this->link) {
        $validator->rule('required', 'link', true);
        $validator->rule('lengthMax', 'link', 400);
        $validator->rule('url', 'link');
      }
      if ($this->year) {
        $validator->rule('required', 'year', true);
        $validator->rule('integer', 'year');
      }
      if ($this->year) {
        $validator->rule('required', 'description', true);
        $validator->rule('lengthMax', 'description', 400);
      }
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
