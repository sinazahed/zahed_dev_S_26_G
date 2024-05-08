<?php
namespace App\Models;
use App\Core\Database\Model;
use App\Models\traits\Login;

class User extends Model
{
    use Login;
    protected static $table = 'user';
}