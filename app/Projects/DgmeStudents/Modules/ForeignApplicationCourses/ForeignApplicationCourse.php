<?php

namespace App\Projects\DgmeStudents\Modules\ForeignApplicationCourses;

use App\Projects\DgmeStudents\Features\Modular\BaseModule\BaseModule;

class ForeignApplicationCourse extends BaseModule
{
    // Note: Pull in necessary traits from relevant mainframe class
    use ForeignApplicationCourseHelper;

    protected $moduleName = 'foreign-application-courses';
    protected $table      = 'foreign_application_courses';
    /*
    |--------------------------------------------------------------------------
    | Properties
    |--------------------------------------------------------------------------
    */
    protected $fillable = [
        'project_id',
        'tenant_id',
        'uuid',
        'name',
        'is_active',
    ];

    // protected $guarded = [];
    // protected $dates = ['created_at', 'updated_at', 'deleted_at'];
    // protected $casts = [];
    // protected $with = [];
    // protected $appends = [];

    /*
    |--------------------------------------------------------------------------
    | Option values
    |--------------------------------------------------------------------------
    */
    // public static $types = [];

    /*
    |--------------------------------------------------------------------------
    | Boot method and model events.
    |--------------------------------------------------------------------------
    */
    protected static function boot()
    {
        parent::boot();
        self::observe(ForeignApplicationCourseObserver::class);

        // static::saving(function (ForeignApplicationCourse $element) { });
        // static::creating(function (ForeignApplicationCourse $element) { });
        // static::updating(function (ForeignApplicationCourse $element) { });
        // static::created(function (ForeignApplicationCourse $element) { });
        // static::updated(function (ForeignApplicationCourse $element) { });
        // static::saved(function (ForeignApplicationCourse $element) { });
        // static::deleting(function (ForeignApplicationCourse $element) { });
        // static::deleted(function (ForeignApplicationCourse $element) { });
    }

    /*
    |--------------------------------------------------------------------------
    | Section: Query scopes + Dynamic scopes
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | Section: Accessors
    |--------------------------------------------------------------------------
    */
    // public function getFirstNameAttribute($value) { return ucfirst($value); }

    /*
    |--------------------------------------------------------------------------
    | Section: Mutators
    |--------------------------------------------------------------------------
    */
    // public function setFirstNameAttribute($value) { $this->attributes['first_name'] = strtolower($value); }

    /*
    |--------------------------------------------------------------------------
    | Section: Attributes
    |--------------------------------------------------------------------------
    */
    // public function getUrlAttribute(){return asset($this->path); }

    /*
    |--------------------------------------------------------------------------
    | Section: Relations
    |--------------------------------------------------------------------------
    */
    // public function updater() { return $this->belongsTo(\App\User::class, 'updated_by'); }

    /*
    |--------------------------------------------------------------------------
    | Section: Helpers
    |--------------------------------------------------------------------------
    */
    /**
     * Alias method to get the processor
     *
     * @return ForeignApplicationCourseProcessor
     * @noinspection SenselessProxyMethodInspection
     */
    public function processor()
    {
        return parent::processor();
    }

}
