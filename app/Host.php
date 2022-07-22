<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Host extends Model
{
    use LogsActivity;

	protected $table = 'hosts'; 
    protected $fillable = [
        'name', 'surnameP', 'surnameM','NC', 'house', 'mobile', 'CE', 'email', 'NSS',
    ];

    protected $hidden = [
        'created_at', 'updated_at',
    ];

    public function scopeSearchByName($query, $name)
    {
        return $query->where('hosts.name', 'like','%'.$name.'%')
        ->orwhere('NC', 'like','%'.$name.'%')
        ->orwhere('departments.name', 'like','%'.$name.'%')
        ->orwhere('puestos.name', 'like','%'.$name.'%');
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

        return "El anfitrion ha sido {$eventName}";
    }
}
