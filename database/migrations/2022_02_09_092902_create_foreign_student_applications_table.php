<?php
/** @noinspection DuplicatedCode */

use App\Module;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Str;
use Symfony\Component\Console\Output\ConsoleOutput;

class CreateForeignStudentApplicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        // Note: Skip if the table exists
        if (Schema::hasTable('foreign_student_applications')) {
            return;
        }

        /*---------------------------------
        | Create the table
        |---------------------------------*/
        Schema::create('foreign_student_applications', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('uuid', 64)->nullable()->default(null);
            $table->unsignedInteger('project_id')->nullable()->default(null);
            $table->unsignedInteger('tenant_id')->nullable()->default(null);
            $table->string('name', 512)->nullable()->default(null);

            /******* Custom columns **********/
            // Todo: Add module specific fields and denormalized fields. In computing, denormalization is the process of
            //  improving the read performance of a database, at the expense of losing some write performance,
            //  by adding redundant copies of data or by grouping it.

            $table->unsignedInteger('user_id')->nullable()->default(null);
            $table->string('applicant_name', 255)->nullable()->default(null);
            $table->string('applicant_father_name', 255)->nullable()->default(null);
            $table->string('applicant_mother_name', 255)->nullable()->default(null);
            $table->text('communication_address')->nullable()->default(null);

            $table->date('dob')->nullable()->default(null);
            $table->unsignedInteger('dob_country_id')->nullable()->default(null);
            $table->string('dob_country_name',255)->nullable()->default(null);
            $table->text('dob_address')->nullable()->default(null);

            $table->unsignedInteger('domicile_country_id')->nullable()->default(null);
            $table->string('domicile_country_name',255)->nullable()->default(null);
            $table->text('domicile_address')->nullable()->default(null);

            $table->string('nationality',100)->nullable()->default(null);
            $table->string('applicant_passport_no',100)->nullable()->default(null);
            $table->datetime('applicant_passport_issue_date')->nullable()->default(null);
            $table->datetime('applicant_passport_expiry_date')->nullable()->default(null);

            $table->string('applicant_email',255)->nullable()->default(null);
            $table->integer('applicant_mobile_no')->nullable()->default(null);

            $table->string('legal_guardian_name',255)->nullable()->default(null);
            $table->string('legal_guardian_nationality',255)->nullable()->default(null);
            $table->text('legal_guardian_address')->nullable()->default(null);

            $table->string('emergency_contact_bangladesh_name',255)->nullable()->default(null);
            $table->text('emergency_contact_bangladesh_address')->nullable()->default(null);

            $table->string('emergency_contact_domicile_name',255)->nullable()->default(null);
            $table->text('emergency_contact_domicile_address')->nullable()->default(null);

            $table->tinyInteger('has_previous_application')->nullable()->default(0);
            $table->text('previous_application_feedback')->nullable()->default(null);

            $table->unsignedInteger('course_id')->nullable()->default(null);
            $table->string('course_name',255)->nullable()->default(null);

            $table->string('financing_mode',255)->nullable()->default(null);
            //$table->text('field')->nullable()->default(null);
            /*********************************/

            $table->tinyInteger('is_active')->nullable()->default(1);
            $table->unsignedInteger('created_by')->nullable()->default(null);
            $table->unsignedInteger('updated_by')->nullable()->default(null);
            $table->timestamps();
            $table->softDeletes();
            $table->unsignedInteger('deleted_by')->nullable()->default(null);
        });

        /*---------------------------------
        | Update modules table
        |---------------------------------*/
        $name = 'foreign-student-applications';

        $module = Module::firstOrNew(['name' => $name]);

        $module->title = str_replace('-', ' ', ucfirst($name));        // Todo: Give a human friendly name
        $module->module_group_id = 1;                                                 // Todo: Are you sure you want to put this in default module-group
        $module->description = 'Manage '.Str::plural($module->title); // Todo: human friendly name.
        $module->module_table = 'foreign_student_applications';
        $module->route_path = 'foreign-student-applications';
        $module->route_name = 'foreign-student-applications';
        $module->class_directory = 'app/Projects/DgmeStudents/Modules/ForeignStudentApplications';
        $module->namespace = '\App\Projects\DgmeStudents\Modules\ForeignStudentApplications';
        $module->model = '\App\Projects\DgmeStudents\Modules\ForeignStudentApplications\ForeignStudentApplication';
        $module->policy = '\App\Projects\DgmeStudents\Modules\ForeignStudentApplications\ForeignStudentApplicationPolicy';
        $module->processor = '\App\Projects\DgmeStudents\Modules\ForeignStudentApplications\ForeignStudentApplicationProcessor';
        $module->controller = '\App\Projects\DgmeStudents\Modules\ForeignStudentApplications\ForeignStudentApplicationController';
        $module->view_directory = 'projects.dgme-students.modules.foreign-student-applications';
        $module->icon_css = 'fa fa-ellipsis-v';
        $module->is_visible = 1;
        $module->is_active = 1;
        $module->created_by = 1;

        $module->save();

        /*---------------------------------
        | Run following set of artisan commands
        |---------------------------------*/
        $output = new ConsoleOutput();
        $commands = [
            'cache:clear',
            'route:clear',
            'mainframe:create-root-models',
            // 'ide-helper:model -W'
        ];
        foreach ($commands as $command) {
            $output->writeLn('php artisan '.$command);
            Artisan::call($command);
        }

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('foreign_student_applications');
    }
}
