<?php

namespace App\Projects\DgmeStudents\Modules\ForeignApplicationExaminations;

use App\Projects\DgmeStudents\Features\Modular\BaseModule\BaseModule;

class ForeignApplicationExamination extends BaseModule
{
    // Note: Pull in necessary traits from relevant mainframe class
    use ForeignApplicationExaminationHelper;

    protected $moduleName = 'foreign-application-examinations';
    protected $table      = 'foreign_application_examinations';
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
        'foreign_student_application_id',
        'user_id',
        'examination_id',
        'examination_name',
        'passing_year',
        'subjects',
        'certificate_id',
        'certificate_name',
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
        self::observe(ForeignApplicationExaminationObserver::class);

        // static::saving(function (ForeignApplicationExamination $element) { });
        static::creating(function (ForeignApplicationExamination $element) {
            $element->is_active=1;
        });
        // static::updating(function (ForeignApplicationExamination $element) { });
        // static::created(function (ForeignApplicationExamination $element) { });
        // static::updated(function (ForeignApplicationExamination $element) { });
        // static::saved(function (ForeignApplicationExamination $element) { });
        // static::deleting(function (ForeignApplicationExamination $element) { });
        // static::deleted(function (ForeignApplicationExamination $element) { });
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
    //
    public function user()
    {
        return $this->belongsTo(\App\User::class, 'user_id');
    }

    public function foreignApplication()
    {
        return $this->hasOne(\App\ForeignStudentApplication::class, 'id','foreign_student_application_id');
    }

    /*
    |--------------------------------------------------------------------------
    | Section: Helpers
    |--------------------------------------------------------------------------
    */
    /**
     * Alias method to get the processor
     *
     * @return ForeignApplicationExaminationProcessor
     * @noinspection SenselessProxyMethodInspection
     */
    public function processor()
    {
        return parent::processor();
    }

}
