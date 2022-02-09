<?php

namespace App\Projects\DgmeStudents\Modules\ForeignAppLangProficiencies;

use App\Projects\DgmeStudents\Features\Modular\BaseModule\BaseModule;

class ForeignAppLangProficiency extends BaseModule
{
    // Note: Pull in necessary traits from relevant mainframe class
    use ForeignAppLangProficiencyHelper;

    protected $moduleName = 'foreign-app-lang-proficiencies';
    protected $table      = 'foreign_app_lang_proficiencies';
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
        self::observe(ForeignAppLangProficiencyObserver::class);

        // static::saving(function (ForeignAppLangProficiency $element) { });
        // static::creating(function (ForeignAppLangProficiency $element) { });
        // static::updating(function (ForeignAppLangProficiency $element) { });
        // static::created(function (ForeignAppLangProficiency $element) { });
        // static::updated(function (ForeignAppLangProficiency $element) { });
        // static::saved(function (ForeignAppLangProficiency $element) { });
        // static::deleting(function (ForeignAppLangProficiency $element) { });
        // static::deleted(function (ForeignAppLangProficiency $element) { });
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
     * @return ForeignAppLangProficiencyProcessor
     * @noinspection SenselessProxyMethodInspection
     */
    public function processor()
    {
        return parent::processor();
    }

}
