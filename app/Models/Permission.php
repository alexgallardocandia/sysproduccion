<?php

namespace App\Models;

use Laratrust\Models\LaratrustPermission;

class Permission extends LaratrustPermission
{
    public $guarded = [];
    public function role()
    {
        return $this->belongsTo('App\Models\Role');
    } 

	public function users() 
	{
    	return $this->belongsToMany('App\Models\User');
	}

	public function roles()
    {
        return $this->belongsToMany('App\Models\Role');
    } 
}
