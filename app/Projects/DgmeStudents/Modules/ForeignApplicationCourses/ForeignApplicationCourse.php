<?php

namespace App\Projects\DgmeStudents\Modules\ForeignApplicationCourses;

use App\Projects\DgmeStudents\Features\Modular\BaseModule\BaseModule;

/**
 * App\Projects\DgmeStudents\Modules\ForeignApplicationCourses\ForeignApplicationCourse
 *
 * @property int $id
 * @property string|null $uuid
 * @property int|null $project_id
 * @property int|null $tenant_id
 * @property string|null $name
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
 * @method static \Illuminate\Database\Eloquent\Builder|ForeignApplicationCourse newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ForeignApplicationCourse newQuery()
 * @method static \Illuminate\Database\Query\Builder|ForeignApplicationCourse onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|ForeignApplicationCourse query()
 * @method static \Illuminate\Database\Eloquent\Builder|ForeignApplicationCourse whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ForeignApplicationCourse whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ForeignApplicationCourse whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ForeignApplicationCourse whereDeletedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ForeignApplicationCourse whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ForeignApplicationCourse whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ForeignApplicationCourse whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ForeignApplicationCourse whereProjectId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ForeignApplicationCourse whereTenantId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ForeignApplicationCourse whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ForeignApplicationCourse whereUpdatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ForeignApplicationCourse whereUuid($value)
 * @method static \Illuminate\Database\Query\Builder|ForeignApplicationCourse withTrashed()
 * @method static \Illuminate\Database\Query\Builder|ForeignApplicationCourse withoutTrashed()
 * @mixin \Eloquent
 */
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
        static::creating(function (ForeignApplicationCourse $element) {
            $element->is_active=1;
        });
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
