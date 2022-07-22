<?php
 
namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Activitylog\Traits\LogsActivity;

class User extends Authenticatable implements MustVerifyEmail
{

    use LogsActivity;

	use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token','created_at', 'updated_at',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function scopeSearchByName($query, $name)
    {
        return $query->where('users.name', 'like', $name.'%');
    }


    protected static $logName = 'Permisos';
    protected static $logAttributes = ['*'];
    //protected static $logOnlyDirty = true;
 	protected static $submitEmptyLogs = false;

 	public function getDescriptionForEvent(string $eventName): string
    {
    	switch ($eventName) {
    		case "created":
    			$eventName = 'creado';
    			break;
    		case "updated":
    			$eventName = 'actualizado';
    			break;
    		case "deleted":
    			$eventName = 'eliminado';
    			break;
    		default:
    			$eventName = $eventName;
    			break;
    	}

        return "El usuario ha sido {$eventName}";
    }
}
