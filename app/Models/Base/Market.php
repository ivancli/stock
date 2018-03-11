<?php

namespace Stock\Models\Base;

use Stock\Models\Model;

/**
 * Class Market
 * @package Stock\Models\Base
 */
class Market extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['name', 'symbol', 'resource_url', 'type', 'active'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function companies()
    {
        return $this->hasMany(Company::class, 'market_id', 'id');
    }
}
