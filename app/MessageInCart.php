<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class MessageInOrder extends Model
{
    protected $fillable =['id_cart','message','id_employee','id_order'];
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->date_add = new \DateTime('now');
        $this->id_customer = Auth::user()->id_customer;
        $this->id_employee = 0;
        $this->id_order = 0;
        $this->private = 0;
    }
}
