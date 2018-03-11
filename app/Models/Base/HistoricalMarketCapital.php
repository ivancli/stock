<?php

namespace Stock\Models\Base;

use Stock\Models\Model;

/**
 * Class HistoricalMarketCapital
 * @package Stock\Models\Base
 */
class HistoricalMarketCapital extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['amount'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id', 'id');
    }
}
