<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SmsVerification extends Model
{
    //

    /**
     * SmsVerification Store
     *
     * @return json
     */
    public function store($request)
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    /**
     * SmsVerification Update Model
     *
     * @return json
     */
    public function updateModel($request)
    {
        $this->update($request->all());

	 	return $this;
    }
}
