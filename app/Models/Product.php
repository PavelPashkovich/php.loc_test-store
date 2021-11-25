<?php

namespace App\Models;


class Product extends BaseModel
{
    protected static $fillable = ['name', 'description', 'img'];
}