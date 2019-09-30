<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{

    public function getTableColumns() {
        return $this
            ->getConnection()
            ->getSchemaBuilder()
            ->getColumnListing($this->getTable());
    }
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'name', 'category', 'members_amount', 'age_oldest_member',
    ];

}
