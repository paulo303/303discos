<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PackageStatus extends Model
{
    use HasFactory;

    protected $table = 'packages_status';
    protected $fillable = ['name'];

    public function packages()
    {
        return $this->hasMany(Package::class);
    }
}
