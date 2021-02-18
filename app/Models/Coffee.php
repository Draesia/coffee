<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Coffee extends Model
{
    /**
     * Options relationship
     * 
     * @return BelongsToMany
     */
    public function options() : BelongsToMany
    {
        return $this->belongsToMany('App\Models\Option', 'coffee_options');
    }
}
