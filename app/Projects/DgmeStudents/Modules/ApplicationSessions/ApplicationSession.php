<?php

namespace App\Projects\DgmeStudents\Modules\ApplicationSessions;

use App\Projects\DgmeStudents\Features\Modular\BaseModule\BaseModule;

/**
 * App\Projects\DgmeStudents\Modules\ApplicationSessions\ApplicationSession
 *
 * @property int $id
 * @property string|null $uuid
 * @property int|null $project_id
 * @property int|null $tenant_id
 * @property int|null $tenant_sl
 * @property string|null $name
 * @property string|null $code
 * @property string|null $name_ext
 * @property string|null $slug
 * @property string|null $description
 * @property \Illuminate\Support\Carbon|null $starts_on
 * @property \Illuminate\Support\Carbon|null $ends_on
 * @property string|null $status
 * @property string|null $selection_completed
 * @property string|null $admission_completed
 * @property int|null $academic_session_id
 * @property int|null $is_active
 * @property int|null $created_by
 * @property int|null $updated_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property int|null $deleted_by
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Mainframe\Features\Audit\Audit[] $audits
 * @property-read int|null $audits_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Change[] $changes
 * @property-read int|null $changes_count
 * @property-read \App\User|null $creator
 * @property-read \App\Module|null $linkedModule
 * @property-read \App\Project|null $project
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Spread[] $spreads
 * @property-read int|null $spreads_count
 * @property-read \App\Tenant|null $tenant
 * @property-read \App\User|null $updater
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Upload[] $uploads
 * @property-read int|null $uploads_count
 * @method static \Illuminate\Database\Eloquent\Builder|BaseModule active()
 * @method static \Illuminate\Database\Eloquent\Builder|ApplicationSession newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ApplicationSession newQuery()
 * @method static \Illuminate\Database\Query\Builder|ApplicationSession onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|ApplicationSession query()
 * @method static \Illuminate\Database\Eloquent\Builder|ApplicationSession whereAcademicSessionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ApplicationSession whereAdmissionCompleted($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ApplicationSession whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ApplicationSession whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ApplicationSession whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ApplicationSession whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ApplicationSession whereDeletedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ApplicationSession whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ApplicationSession whereEndsOn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ApplicationSession whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ApplicationSession whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ApplicationSession whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ApplicationSession whereNameExt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ApplicationSession whereProjectId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ApplicationSession whereSelectionCompleted($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ApplicationSession whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ApplicationSession whereStartsOn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ApplicationSession whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ApplicationSession whereTenantId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ApplicationSession whereTenantSl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ApplicationSession whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ApplicationSession whereUpdatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ApplicationSession whereUuid($value)
 * @method static \Illuminate\Database\Query\Builder|ApplicationSession withTrashed()
 * @method static \Illuminate\Database\Query\Builder|ApplicationSession withoutTrashed()
 * @mixin \Eloquent
 */
class ApplicationSession extends BaseModule
{
    // Note: Pull in necessary traits from relevant mainframe class
    use ApplicationSessionHelper;

    public const YES = "Yes";
    public const NO = "No";

    public const SESSION_STATUS_OPEN = "Open";
    public const SESSION_STATUS_SCHEDULED = "Scheduled";
    public const SESSION_STATUS_CLOSED = "Closed";

    protected $moduleName = 'application-sessions';
    protected $table = 'application_sessions';
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
        'allowed_category_options',
        'allowed_is_saarc_options',
        'allowed_course_id_options',
        'allowed_country_id_options',
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
    protected $casts = [
        'allowed_category_options' => 'array',
        'allowed_is_saarc_options' => 'array',
        'allowed_course_id_options' => 'array',
        'allowed_country_id_options' => 'array',
    ];
    // protected $with = []; // Note: Should be left empty! and used only when needed : $model->append(...)!
    // protected $appends = []; // Note: Should be left empty! and used only when needed : $model->load(...)!

    /*
    |--------------------------------------------------------------------------
    | Option values
    |--------------------------------------------------------------------------
    */
    public static $statuses = [
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
