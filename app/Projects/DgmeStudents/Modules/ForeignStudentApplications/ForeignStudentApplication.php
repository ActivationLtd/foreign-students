<?php

namespace App\Projects\DgmeStudents\Modules\ForeignStudentApplications;

use App\Projects\DgmeStudents\Features\Modular\BaseModule\BaseModule;

class ForeignStudentApplication extends BaseModule
{
    // Note: Pull in necessary traits from relevant mainframe class
    use ForeignStudentApplicationHelper;

    protected $moduleName = 'foreign-student-applications';
    protected $table      = 'foreign_student_applications';

    public const STATUS_DRAFT                 = 'Draft';
    public const STATUS_SUBMITTED             = 'Submitted';
    public const STATUS_PAYMENT_VERIFICATION  = 'Payment Verified';
    public const STATUS_DOCUMENT_VERIFICATION = 'Document Verified';

    public const FINANCE_MODE_OWN_FUND        = 'Own funds';
    public const FINANCE_MODE_CANDIDATE_GOVT  = 'Scholarship awarded by candidates\'s own Government';
    public const FINANCE_MODE_BANGLADESH_GOVT = 'Scholarship to be awarded by Bangladeshi Government';
    public const FINANCE_MODE_OTHER           = 'Other';

    public const OPTION_YES = 1;
    public const OPTION_NO  = 0;

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
        'user_id',
        'applicant_name',
        'applicant_father_name',
        'applicant_mother_name',
        'communication_address',
        'dob',
        'dob_country_id',
        'dob_country_name',
        'dob_address',
        'domicile_country_id',
        'domicile_country_name',
        'domicile_address',
        'nationality',
        'applicant_passport_no',
        'applicant_passport_issue_date',
        'applicant_passport_expiry_date',
        'applicant_email',
        'applicant_mobile_no',
        'legal_guardian_name',
        'legal_guardian_nationality',
        'legal_guardian_address',
        'emergency_contact_bangladesh_name',
        'emergency_contact_bangladesh_address',
        'emergency_contact_domicile_name',
        'emergency_contact_domicile_address',
        'has_previous_application',
        'previous_application_feedback',
        'course_id',
        'course_name',
        'financing_mode',
        'finance_mode_other',
        'status',
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
    public static $statuses     = [
        ForeignStudentApplication::STATUS_DRAFT,
        ForeignStudentApplication::STATUS_SUBMITTED,
        ForeignStudentApplication::STATUS_PAYMENT_VERIFICATION,
        ForeignStudentApplication::STATUS_DOCUMENT_VERIFICATION,
    ];
    public static $fundingModes = [
        ForeignStudentApplication::FINANCE_MODE_OWN_FUND,
        ForeignStudentApplication::FINANCE_MODE_CANDIDATE_GOVT,
        ForeignStudentApplication::FINANCE_MODE_BANGLADESH_GOVT,
        ForeignStudentApplication::FINANCE_MODE_OTHER,
    ];
    public static $optionsYesNo = [
        ForeignStudentApplication::OPTION_YES => 'Yes',
        ForeignStudentApplication::OPTION_NO => 'No',
    ];

    /*
    |--------------------------------------------------------------------------
    | Boot method and model events.
    |--------------------------------------------------------------------------
    */
    protected static function boot()
    {
        parent::boot();
        self::observe(ForeignStudentApplicationObserver::class);

        // static::saving(function (ForeignStudentApplication $element) { });
        static::creating(function (ForeignStudentApplication $element) {
            $element->status = ForeignStudentApplication::STATUS_DRAFT;
            $element->user_id = user()->id;
            $element->is_active = 1;
        });
        // static::updating(function (ForeignStudentApplication $element) { });
        // static::created(function (ForeignStudentApplication $element) { });
        // static::updated(function (ForeignStudentApplication $element) { });
        // static::saved(function (ForeignStudentApplication $element) { });
        // static::deleting(function (ForeignStudentApplication $element) { });
        // static::deleted(function (ForeignStudentApplication $element) { });
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
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(\App\User::class, 'user_id');
    }

    public function applicationEducationalQualifications()
    {
        return $this->hasMany(\App\ApplicationEducationalQualification::class, 'application_id');
    }

    public function applicationLanguageProfiencies()
    {
        return $this->hasMany(\App\ApplicationLanguageProficiency::class, 'application_id');
    }
    /*
    |--------------------------------------------------------------------------
    | Section: Helpers
    |--------------------------------------------------------------------------
    */
    /**
     * Alias method to get the processor
     *
     * @return ForeignStudentApplicationProcessor
     * @noinspection SenselessProxyMethodInspection
     */
    public function processor()
    {
        return parent::processor();
    }

}
