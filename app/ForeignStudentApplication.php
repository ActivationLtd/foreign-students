<?php

namespace App;

/**
 * App\ForeignStudentApplication
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
 * @property \Illuminate\Support\Carbon|null $dob
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
 * @property string|null $applicant_mobile_no
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
 * @property \Illuminate\Support\Carbon|null $submitted_at
 * @property string|null $payment_transaction_id
 * @property int $is_valid
 * @property int|null $is_payment_verified
 * @property int|null $is_document_verified
 * @property string|null $status
 * @property int|null $application_session_id
 * @property string|null $application_session_name
 * @property string|null $remarks
 * @property int|null $is_active
 * @property int|null $created_by
 * @property int|null $updated_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property int|null $deleted_by
 * @property string|null $slug
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\ForeignApplicationExamination[] $applicationExaminations
 * @property-read int|null $application_examinations_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\ForeignAppLangProficiency[] $applicationLanguageProfiencies
 * @property-read int|null $application_language_profiencies_count
 * @property-read \App\ApplicationSession|null $applicationSession
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
 * @method static \Illuminate\Database\Eloquent\Builder|ForeignStudentApplication whereApplicationSessionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ForeignStudentApplication whereApplicationSessionName($value)
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
 * @method static \Illuminate\Database\Eloquent\Builder|ForeignStudentApplication whereIsDocumentVerified($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ForeignStudentApplication whereIsPaymentVerified($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ForeignStudentApplication whereIsSaarc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ForeignStudentApplication whereIsValid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ForeignStudentApplication whereLegalGuardianAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ForeignStudentApplication whereLegalGuardianName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ForeignStudentApplication whereLegalGuardianNationality($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ForeignStudentApplication whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ForeignStudentApplication whereNationality($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ForeignStudentApplication wherePaymentTransactionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ForeignStudentApplication wherePreviousApplicationFeedback($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ForeignStudentApplication whereProjectId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ForeignStudentApplication whereRemarks($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ForeignStudentApplication whereSlug($value)
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
 */
class ForeignStudentApplication extends \App\Projects\DgmeStudents\Modules\ForeignStudentApplications\ForeignStudentApplication
{
   /*--------------------------------------
   | Note : Empty class.
   | Write all logic in the relevant parent
   |---------------------------------------*/
}