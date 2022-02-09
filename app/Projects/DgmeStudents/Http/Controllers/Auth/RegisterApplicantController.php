<?php /** @noinspection ALL */

namespace App\Projects\DgmeStudents\Http\Controllers\Auth;

use App\Group;

use App\Projects\DgmeStudents\Http\Controllers\Auth\RegisterTenantController as MfRegisterTenantController;
use App\Projects\DgmeStudents\Notifications\Auth\VerifyEmail;
use Illuminate\Auth\Events\Registered;
use Validator;
use App\Tenant;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterApplicantController extends MfRegisterTenantController
{

    /** @var string */
    protected $form = 'projects.dgme-students.auth.register-applicant';

    /**
     * If not group is specified then user will be registered to this default group;
     *
     * @var string
     */
    protected $defaultGroupName = User::APPLICANT_USER_GROUP;

    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response
     */
    public function register(Request $request)
    {

        $this->attemptRegistration();

        $this->redirectTo = route('login');
        if (!$this->user) { // Redirect to register page if failed
            $this->redirectTo = route('register.applicant');
        }

        return $this->load($this->user)->dispatch();

    }

    /**
     * Process input for registration.
     *
     * @return $this
     */
    public function attemptRegistration()
    {
        // Validate
        $validator = Validator::make(request()->all(), [
            'first_name' => 'required',
            'last_name' => 'required',
            'country_id' => 'required',
            'email' => 'required|email|unique:users,email',
            'passport_no' => 'required|alpha_num|unique:users,passport_no',
            'password' => User::PASSWORD_VALIDATION_RULE,
        ]);

        if ($validator->fails()) {
            $this->mergeValidatorErrors($validator);

            return $this;
        }

        // Validation success. Now create tenant
        //$this->tenant = $this->createTenant();
        // if (!$this->tenant) {
        //     $this->fail('Applicant creation failed');
        //
        //     return $this;
        // }

        // Create user
        $this->user = $this->createUser();
        if (!$this->user) {
            $this->fail('User creation failed');
            //Tenant::where('id', $this->tenant->id)->forceDelete();
            return $this;
        }

        $this->success('Verify your email and log in.');
        $this->registered(request(), $this->user);

        // $this->user->update(['tenant_id' => $this->tenant->id]);

        return $this;

    }

    /**
     * Create a tenant
     *
     * @return \App\Tenant
     */
    public function createTenant()
    {
        return Tenant::create([
            'name' => request('tenant_name'),
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @return \App\User
     */
    protected function createUser()
    {
        return User::create([
            'first_name'=> request('first_name'),
            'last_name' => request('last_name'),
            'full_name' => request('first_name').' '.request('last_name'),
            'email'     => request('email'),
            'passport_no'     => request('passport_no'),
            'password'  => Hash::make(request('password')),
            'group_ids' => User::APPLICANT_USER_GROUP_ID,
            'is_active' => 1,
            //'tenant_id' => $this->tenant->id,
        ]);
    }

    /**
     * The user has been successfully registered.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  User  $user
     * @return mixed
     */
    protected function registered(Request $request, $user)
    {
        event(new Registered($user));
        $user->notifyNow(new VerifyEmail());
    }

}