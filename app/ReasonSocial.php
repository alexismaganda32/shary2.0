<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class ReasonSocial extends Model
{
    //
    use LogsActivity;

	protected $table = 'reason_socials';

    protected $fillable = [
        'name', 'nota',
    ];

    protected $hidden = [
        'created_at', 'updated_at',
    ];

    public function scopeSearchByFull($query, $name)
    {
        return $query->where('name','LIKE','%'.$name.'%');
    }

    //lo nuevo


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

        return "La razon social ha sido {$eventName}";
    }
}
