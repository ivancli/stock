<?php

namespace Stock\Models\Base;

use Stock\Models\Model;

/**
 * Class Company
 * @package Stock\Models\Base
 */
class Company extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['name', 'symbol', 'market', 'sector'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function price()
    {
        return $this->belongsTo(HistoricalPrice::class, 'latest_historical_price_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function volume()
    {
        return $this->belongsTo(HistoricalVolume::class, 'latest_historical_volume_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function marketCapital()
    {
        return $this->belongsTo(HistoricalMarketCapital::class, 'latest_historical_market_capital_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function historicalPrices()
    {
        return $this->hasMany(HistoricalPrice::class, 'company_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function historicalVolumes()
    {
        return $this->hasMany(HistoricalVolume::class, 'company_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function historicalMarketCapitals()
    {
        return $this->hasMany(HistoricalMarketCapital::class, 'company_id', 'id');
    }
}
