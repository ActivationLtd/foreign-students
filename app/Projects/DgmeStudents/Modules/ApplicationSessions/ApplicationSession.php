<?php

namespace App\Projects\DgmeStudents\Modules\ApplicationSessions;

use App\Projects\DgmeStudents\Features\Modular\BaseModule\BaseModule;

class ApplicationSession extends BaseModule
{
    // Note: Pull in necessary traits from relevant mainframe class
    use ApplicationSessionHelper;

    public const YES = "Yes";
    public const NO  = "No";

    public const SESSION_STATUS_OPEN      = "Open";
    public const SESSION_STATUS_SCHEDULED = "Scheduled";
    public const SESSION_STATUS_CLOSED    = "Closed";

    protected $moduleName = 'application-sessions';
    protected $table      = 'application_sessions';
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
        //'code',
        'description',
        'starts_on',
        'ends_on',
        'status',
        'selection_completed',
        'admission_completed',
        'academic_session_id',
        'is_active',
    ];

    // protected $guarded = [];
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
        'starts_on',
        'ends_on',
    ];
    // protected $casts = [];
    // protected $with = []; // Note: Should be left empty! and used only when needed : $model->append(...)!
    // protected $appends = []; // Note: Should be left empty! and used only when needed : $model->load(...)!

    /*
    |--------------------------------------------------------------------------
    | Option values
    |--------------------------------------------------------------------------
    */
    public static $statuses    = [
        self::SESSION_STATUS_OPEN,
        self::SESSION_STATUS_SCHEDULED,
        self::SESSION_STATUS_CLOSED,
    ];
    public static $YesNoFields = [
        self::YES,
        self::NO,
    ];

    /*
    |--------------------------------------------------------------------------
    | Boot method and model events.
    |--------------------------------------------------------------------------
    */
    protected static function boot()
    {
        parent::boot();
        self::observe(ApplicationSessionObserver::class);

        // static::saving(function (ApplicationSession $element) { });
        // static::creating(function (ApplicationSession $element) { });
        // static::updating(function (ApplicationSession $element) { });
        // static::created(function (ApplicationSession $element) { });
        // static::updated(function (ApplicationSession $element) { });
        // static::saved(function (ApplicationSession $element) { });
        // static::deleting(function (ApplicationSession $element) { });
        // static::deleted(function (ApplicationSession $element) { });
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
     * @return ApplicationSessionProcessor
     * @noinspection SenselessProxyMethodInspection
     */
    public function processor()
    {
        return parent::processor();
    }

}
