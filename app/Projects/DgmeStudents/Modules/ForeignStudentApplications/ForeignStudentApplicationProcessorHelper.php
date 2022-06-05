<?php

namespace App\Projects\DgmeStudents\Modules\ForeignStudentApplications;

/** @mixin ForeignStudentApplicationProcessor $this */
trait ForeignStudentApplicationProcessorHelper
{
    /*
    |--------------------------------------------------------------------------
    | Functions for deriving immutables & allowed transitions
    |--------------------------------------------------------------------------
    */
    /* Further customize immutables and allowed value transitions*/
    // public function immutables(){return $this->immutables; }
    // public function transitions(){return $this->transitions; }

    /*
    |--------------------------------------------------------------------------
    | Other helper functions
    |--------------------------------------------------------------------------
    */
    // Todo: Other helper functions
    public function fillRelationData()
    {
        $element = $this->element;
        if ($element->dob_country_id) {
            $element->dob_country_name = $element->dobCountry->name;
        }
        if ($element->domicile_country_id) {
            $element->domicile_country_name = $element->domicileCountry->name;
        }
        if ($element->course_id) {
            $element->course_name = $element->course->name;
        }
        if ($element->application_session_id) {
            $element->application_session_name = $element->applicationSession->name;
        }

        return $this;
    }
    /*
    |--------------------------------------------------------------------------
    | Validation helper functions
    |--------------------------------------------------------------------------
    */

    // Todo: Functions for validation
    /**
     * Example code
     *
     * @return $this
     */
    public function checkName()
    {
        $element = $this->element; // Short hand variable.

        if ($element->name == 'Joker') { // Validate
            $this->error('Name can not be Joker', 'name'); // Raise error
        }

        return $this; // Return the same object for validation method chaining
    }

    /**
     * @return $this
     */
    public function checkCourseAndType()
    {
        $element = $this->element;
        $existingOngoingApplicationForCourseCount = $this->user->applications()->where('id', '!=', $element->id)
            ->where('course_id', $element->course_id)
            ->where('application_category', $element->application_category)
            ->whereNotIn('status', ['Declined'])
            ->count();
        if ($existingOngoingApplicationForCourseCount) {
            $this->error('An Application on this course '.$element->course->name.' and application category '.$element->application_category.' is all ready under processing'); // Raise error
        }

        return $this; // Return the same object for validation method chaining
    }
    /**
     * @return $this
     */
    public function setCheckBoxValueToZero()
    {
        $element = $this->element;
        $element->is_payment_verified=($element->is_payment_verified)?1:0;
        $element->is_document_verified=($element->is_document_verified)?1:0;
        $element->is_valid=($element->is_valid)?1:0;

        return $this; // Return the same object for validation method chaining
    }

    /**
     * @return $this
     */
    public function checkSAARCCountry()
    {
        $element = $this->element;
        if ($element->is_saarc == 1 && $element->domicileCountry->is_saarc != 1) {
            $this->error('Selected Country is Not Saarc', 'domicile_country_id'); // Raise error
        }

        return $this;
    }

    /**
     * @return $this
     */
    public function checkPassportAndEmail()
    {
        $element = $this->element;
        if ($element->applicant_passport_no != $element->user->passport_no) {
            $this->error('Passport should be the same as the signed up user', 'applicant_passport_no'); // Raise error
        }
        if ($element->applicant_email != $element->user->email) {
            $this->error('Email should be the same as the signed up user', 'applicant_email'); // Raise error
        }

        return $this; // Return the same object for validation method chaining
    }

    /**
     * @return $this
     */
    public function checkDocuments(): static
    {
        $element = $this->element; // Short hand variable.
        if ($element->uploads()->where('type', 'Passport')->count() < 1) {
            $this->error('Passport Has Not Been Uploaded'); // Raise error
        }
        if ($element->uploads()->where('type', 'SSC Equivalent Document')->count() < 1) {
            $this->error('SSC Equivalent Document Has Not Been Uploaded'); // Raise error
        }
        if ($element->uploads()->where('type', 'HSC Equivalent Document')->count() < 1) {
            $this->error('HSC Equivalent Document Has Not Been Uploaded'); // Raise error
        }
        if ($element->uploads()->where('type', 'Payment Document')->count() < 1) {
            $this->error('Payment Document Has Not Been Uploaded'); // Raise error
        }
        if ($element->uploads()->where('type', 'Profile Picture')->count() < 1) {
            $this->error('Profile Picture Has Not Been Uploaded'); // Raise error
        }
        if ($element->uploads()->where('type', 'Applicant Signature')->count() < 1) {
            $this->error('Applicant Signature Has Not Been Uploaded'); // Raise error
        }
        if ($element->uploads()->where('type', 'Payment Document')->count() < 1) {
            $this->error('Guardian Signature Has Not Been Uploaded'); // Raise error
        }

        return $this; // Return the same object for validation method chaining
    }

    /**
     * @return $this
     */
    public function checkExaminations(): static
    {
        $element = $this->element; // Shorthand variable.

        if ($element->applicationExaminations()->where('examination_type', 'O level')->count() < 1) {
            $this->error('O Level/Different Grading System Or Equivalent examination details has not been updated'); // Raise error
        }
        if ($element->applicationExaminations()->where('examination_type', 'A level')->count() < 1) {
            $this->error('A Level Or Equivalent examination details has not been updated'); // Raise error
        }

        return $this; // Return the same object for validation method chaining
    }

    /**
     * @return $this
     */
    public function checkLanguageProficiencies(): static
    {
        $element = $this->element; // Short hand variable.
        if ($element->applicationLanguageProfiencies()->count() < 1) {
            $this->error('Language Proficiencies has not been updated'); // Raise error
        }

        return $this; // Return the same object for validation method chaining
    }
}