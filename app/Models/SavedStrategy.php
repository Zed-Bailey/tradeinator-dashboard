<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SavedStrategy extends Model
{
    use HasFactory;
    protected $table = "SavedStrategies";
    protected $primaryKey = "SavedStrategyId";

}
