<?php
namespace App\Models;
use App\Core\Database\Model;
use App\Models\traits\Searchable;

class ShoppingList extends Model
{
    use Searchable;
    protected static $table = 'list';
}