<?php
namespace App\Core\Database\Contracts;

interface DatabaseInterface
{
    // public function create();
    public function find(int $id, string $table);
    // public function update();
    // public function delete();
}