<?php

namespace App\Projects\DgmeStudents\Modules\ForeignStudentApplications;

use App\Projects\DgmeStudents\Features\Modular\BaseModule\BaseModule;

/**
 * App\Projects\DgmeStudents\Modules\ForeignStudentApplications\ForeignStudentApplication
 *
 * @property int $id
 * @property string|null $uuid
 * @property int|null $project_id
 * @property int|null $tenant_id
 * @property string|null $name
 * @property int|null $user_id
 * @property string|null $applicant_name
 * @property string|null $applicant_father_name
 * @property string|null $applicant_mother_name
 * @property string|null $communication_address
 * @property string|null $dob
 * @property int|null $dob_country_id
 * @property string|null $dob_country_name
 * @property string|null $dob_address
 * @property int|null $domicile_country_id
 * @property string|null $domicile_country_name
 * @property string|null $domicile_address
 * @property string|null $nationality
 * @property string|null $applicant_passport_no
 * @property string|null $applicant_passport_issue_date
 * @property string|null $applicant_passport_expiry_date
 * @property string|null $applicant_email
 * @property int|null $applicant_mobile_no
 * @property string|null $legal_guardian_name
 * @property string|null $legal_guardian_nationality
 * @property string|null $legal_guardian_address
 * @property string|null $emergency_contact_bangladesh_name
 * @property string|null $emergency_contact_bangladesh_address
 * @property string|null $emergency_contact_domicile_name
 * @property string|null $emergency_contact_domicile_address
 * @property int|null $has_previous_application
 * @property string|null $previous_application_feedback
 * @property int|null $course_id
 * @property string|null $course_name
 * @property string|null $application_category
 * @property int|null $is_saarc
 * @property string|null $financing_mode
 * @property string|null $finance_mode_other
 * @property string|null $submitted_at
 * @property string|null $payment_transaction_id
 * @property string|null $status
 * @property int|null $is_active
 * @property int|null $created_by
 * @property int|null $updated_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property int|null $deleted_by
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\ForeignApplicationExamination[] $applicationExaminations
 * @property-read int|null $application_examinations_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\ForeignAppLangProficiency[] $applicationLanguageProfiencies
 * @property-read int|null $application_language_profiencies_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Mainframe\Features\Audit\Audit[] $audits
 * @property-read int|null $audits_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Change[] $changes
 * @property-read int|null $changes_count
 * @property-read \App\ForeignApplicationCourse|null $course
 * @property-read \App\User|null $creator
 * @property-read \App\Country|null $dobCountry
 * @property-read \App\Country|null $domicileCountry
 * @property-read \App\Module|null $linkedModule
 * @property-read \App\Project|null $project
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Spread[] $spreads
 * @property-read int|null $spreads_count
 * @property-read \App\Tenant|null $tenant
 * @property-read \App\User|null $updater
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Upload[] $uploads
 * @property-read int|null $uploads_count
 * @property-read \App\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|BaseModule active()
 * @method static \Illuminate\Database\Eloquent\Builder|ForeignStudentApplication newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ForeignStudentApplication newQuery()
 * @method static \Illuminate\Database\Query\Builder|ForeignStudentApplication onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|ForeignStudentApplication query()
 * @method static \Illuminate\Database\Eloquent\Builder|ForeignStudentApplication whereApplicantEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ForeignStudentApplication whereApplicantFatherName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ForeignStudentApplication whereApplicantMobileNo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ForeignStudentApplication whereApplicantMotherName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ForeignStudentApplication whereApplicantName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ForeignStudentApplication whereApplicantPassportExpiryDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ForeignStudentApplication whereApplicantPassportIssueDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ForeignStudentApplication whereApplicantPassportNo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ForeignStudentApplication whereApplicationCategory($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ForeignStudentApplication whereCommunicationAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ForeignStudentApplication whereCourseId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ForeignStudentApplication whereCourseName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ForeignStudentApplication whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ForeignStudentApplication whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ForeignStudentApplication whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ForeignStudentApplication whereDeletedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ForeignStudentApplication whereDob($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ForeignStudentApplication whereDobAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ForeignStudentApplication whereDobCountryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ForeignStudentApplication whereDobCountryName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ForeignStudentApplication whereDomicileAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ForeignStudentApplication whereDomicileCountryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ForeignStudentApplication whereDomicileCountryName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ForeignStudentApplication whereEmergencyContactBangladeshAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ForeignStudentApplication whereEmergencyContactBangladeshName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ForeignStudentApplication whereEmergencyContactDomicileAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ForeignStudentApplication whereEmergencyContactDomicileName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ForeignStudentApplication whereFinanceModeOther($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ForeignStudentApplication whereFinancingMode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ForeignStudentApplication whereHasPreviousApplication($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ForeignStudentApplication whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ForeignStudentApplication whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ForeignStudentApplication whereIsSaarc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ForeignStudentApplication whereLegalGuardianAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ForeignStudentApplication whereLegalGuardianName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ForeignStudentApplication whereLegalGuardianNationality($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ForeignStudentApplication whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ForeignStudentApplication whereNationality($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ForeignStudentApplication wherePaymentTransactionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ForeignStudentApplication wherePreviousApplicationFeedback($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ForeignStudentApplication whereProjectId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ForeignStudentApplication whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ForeignStudentApplication whereSubmittedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ForeignStudentApplication whereTenantId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ForeignStudentApplication whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ForeignStudentApplication whereUpdatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ForeignStudentApplication whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ForeignStudentApplication whereUuid($value)
 * @method static \Illuminate\Database\Query\Builder|ForeignStudentApplication withTrashed()
 * @method static \Illuminate\Database\Query\Builder|ForeignStudentApplication withoutTrashed()
 * @mixin \Eloquent
 * @property int $is_valid
 * @property int|null $is_payment_verified
 * @property int|null $is_document_verified
 * @property int|null $application_session_id
 * @property string|null $application_session_name
 * @property string|null $remarks
 * @property string|null $slug
 * @property-read \App\ApplicationSession|null $applicationSession
 * @method static \Illuminate\Database\Eloquent\Builder|ForeignStudentApplication whereApplicationSessionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ForeignStudentApplication whereApplicationSessionName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ForeignStudentApplication whereIsDocumentVerified($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ForeignStudentApplication whereIsPaymentVerified($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ForeignStudentApplication whereIsValid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ForeignStudentApplication whereRemarks($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ForeignStudentApplication whereSlug($value)
 */
class ForeignStudentApplication extends BaseModule
{
    // Note: Pull in necessary traits from relevant mainframe class
    use ForeignStudentApplicationHelper;

    protected $moduleName = 'foreign-student-applications';
    protected $table      = 'foreign_student_applications';

    public const STATUS_DRAFT                 = 'Draft';
    public const STATUS_SUBMITTED             = 'Submitted';
    public const STATUS_DECLINED              = 'Declined';
    public const STATUS_ACCEPTED              = 'Accepted';

    public const FINANCE_MODE_OWN_FUND        = 'Own funds';
    public const FINANCE_MODE_CANDIDATE_GOVT  = 'Scholarship awarded by candidates\'s own Government';
    public const FINANCE_MODE_BANGLADESH_GOVT = 'Scholarship to be awarded by Bangladeshi Government';
    public const FINANCE_MODE_OTHER           = 'Other';

    public const OPTION_YES = 1;
    public const OPTION_NO  = 0;

    public const OPTION_GOVERNMENT = 'Government';
    public const OPTION_PRIVATE    = 'Private';

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
        //'user_id',
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
        'application_category',
        'is_saarc',
        'financing_mode',
        'finance_mode_other',
        'status',
        'application_session_id',
        'remarks',
        //'application_session_name',
        //'submitted_at',
        'is_valid',
        'is_payment_verified',
        'is_document_verified',
        'payment_transaction_id',
        'is_active',
    ];

    // protected $guarded = [];
    protected $dates = ['created_at', 'updated_at', 'deleted_at','submitted_at','dob'];
    // protected $casts = [];
    // protected $with = [];
    // protected $appends = [];


    /*
    |--------------------------------------------------------------------------
    | Option values
    |--------------------------------------------------------------------------
    */
    // public static $types = [];
    public static $statuses                = [
        ForeignStudentApplication::STATUS_DRAFT,
        ForeignStudentApplication::STATUS_SUBMITTED,
        ForeignStudentApplication::STATUS_ACCEPTED,
        ForeignStudentApplication::STATUS_DECLINED,
    ];
    public static $applicantStatuses       = [
        ForeignStudentApplication::STATUS_DRAFT,
        ForeignStudentApplication::STATUS_SUBMITTED,

    ];
    public static $adminStatuses           = [
        ForeignStudentApplication::STATUS_SUBMITTED,
        ForeignStudentApplication::STATUS_ACCEPTED,
        ForeignStudentApplication::STATUS_DECLINED,
    ];
    public static $fundingModes            = [
        ForeignStudentApplication::FINANCE_MODE_OWN_FUND,
        ForeignStudentApplication::FINANCE_MODE_CANDIDATE_GOVT,
        ForeignStudentApplication::FINANCE_MODE_BANGLADESH_GOVT,
        ForeignStudentApplication::FINANCE_MODE_OTHER,
    ];
    public static $optionsYesNo            = [
        ForeignStudentApplication::OPTION_YES => 'Yes',
        ForeignStudentApplication::OPTION_NO => 'No',
    ];
    public static $optionsGovernmentPublic = [
        ForeignStudentApplication::OPTION_GOVERNMENT,
        ForeignStudentApplication::OPTION_PRIVATE,
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

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\User::class, 'user_id');
    }

    public function dobCountry(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Country::class, 'dob_country_id');
    }

    public function domicileCountry(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Country::class, 'domicile_country_id');
    }

    public function course(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\ForeignApplicationCourse::class, 'course_id');
    }

    public function applicationExaminations(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(\App\ForeignApplicationExamination::class, 'foreign_student_application_id');
    }

    public function applicationLanguageProfiencies(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(\App\ForeignAppLangProficiency::class, 'foreign_student_application_id');
    }

    public function applicationSession(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\ApplicationSession::class);
    }
    public function profilePic()
    {
        return $this->uploads()->where('type',\App\Upload::TYPE_PROFILE_PIC)->first();
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
