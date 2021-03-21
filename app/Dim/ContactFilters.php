<?php
namespace App\Dim ;

class ContactFilters
{
  protected $builder;
  protected $request;

public function __construct($builder,$request)
{
  $this->builder=$builder;
  $this->request=$request;
}

public function apply()
{
  foreach ($this->filters() as $filter => $value) {
    if(method_exists($this,$filter)){
      $this->$filter($value);
    }
  }
  return $this->builder;
}

public function filters()
{
  return $this->request->all();
}

public function email($value)
{
  $this->builder->where('email','like',"%$value%");

}

public function is_archive($value)
{
  $this->builder->where('is_archive',$value);

}


}
