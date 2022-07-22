<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Assistance extends Model
{
    use LogsActivity;

    protected $table = 'assistances'; 
    protected $fillable = [
        'name', 'mobile', 
    ];


    protected $hidden = [
        'created_at', 'updated_at',
    ];

    public function scopeSearchByName($query, $name)
    {
        return $query->where('instructores.name', 'like', '%'.$name.'%')
        ->orwhere('cursos.name', 'like', '%'.$name.'%');
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

        return "La asistencia ha sido {$eventName}";
    }
}
