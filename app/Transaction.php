<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $guarded = array();
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'transactions';

    /**
     * The database primary key value.
     *
     * @var string
     */
    protected $primaryKey = 'id';


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function Users() {
        return $this->belongsToMany('App\User','user_transaction');
    }

}
