<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Curso extends Model
{
    use LogsActivity;


    protected $table = 'cursos';

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

        return "El curso ha sido {$eventName}";
    }
}
