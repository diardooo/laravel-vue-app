<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Email extends Model
{
    protected $table = "email";
    public function hasUser()
    {
        return $this->hasMany(Customer::class, "id_customer");
    }
}
