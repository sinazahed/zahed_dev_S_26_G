<?php
namespace App\Models\traits;

trait Searchable
{
    public function like(array $columns , string $text)
    {
        $model = get_class($this);
        return $model::search($columns,$text);
    }
    
}