<?php 
namespace App\Models;

use CodeIgniter\Model;

class Modelo extends Model{
    protected $table      = 'futbolistas';
    // Uncomment below if you want add primary key
    // protected $primaryKey = 'id';
    protected $primaryKey = 'ID';
    protected $allowedFields = ['imagen','nombre','edad','posicion','dorsal'];
}