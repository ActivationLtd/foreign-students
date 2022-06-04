<?php
/** @noinspection DuplicatedCode */

use App\Module;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Str;
use Symfony\Component\Console\Output\ConsoleOutput;

class CreateForeignApplicationExaminationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        // Note: Skip if the table exists
        if (Schema::hasTable('foreign_application_examinations')) {
            return;
        }

        /*---------------------------------
        | Create the table
        |---------------------------------*/
        Schema::create('foreign_application_examinations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('uuid', 64)->nullable()->default(null);
            $table->unsignedInteger('project_id')->nullable()->default(null);
            $table->unsignedInteger('tenant_id')->nullable()->default(null);
            $table->string('name', 512)->nullable()->default(null);

            /******* Custom columns **********/
            // Todo: Add module specific fields and denormalized fields. In computing, denormalization is the process of
            //  improving the read performance of a database, at the expense of losing some write performance,
            //  by adding redundant copies of data or by grouping it.
            $table->unsignedInteger('foreign_student_application_id')->nullable()->default(null);
            $table->unsignedInteger('user_id')->nullable()->default(null);
            $table->unsignedInteger('examination_id')->nullable()->default(null);
            $table->string('examination_name', 255)->nullable()->default(null);
            $table->integer('passing_year')->nullable()->default(null);
            $table->text('subjects')->nullable()->default(null);
            $table->unsignedInteger('certificate_id')->nullable()->default(null);
            $table->string('certificate_name')->nullable()->default(null);
            //$table->string('title', 100)->nullable()->default(null);
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
        $name = 'foreign-application-examinations';

        $module = Module::firstOrNew(['name' => $name]);

        $module->title = str_replace('-', ' ', ucfirst($name));        // Todo: Give a human friendly name
        $module->module_group_id = 1;                                                 // Todo: Are you sure you want to put this in default module-group
        $module->description = 'Manage '.Str::plural($module->title); // Todo: human friendly name.
        $module->module_table = 'foreign_application_examinations';
        $module->route_path = 'foreign-application-examinations';
        $module->route_name = 'foreign-application-examinations';
        $module->class_directory = 'app/Projects/DgmeStudents/Modules/ForeignApplicationExaminations';
        $module->namespace = '\App\Projects\DgmeStudents\Modules\ForeignApplicationExaminations';
        $module->model = '\App\Projects\DgmeStudents\Modules\ForeignApplicationExaminations\ForeignApplicationExamination';
        $module->policy = '\App\Projects\DgmeStudents\Modules\ForeignApplicationExaminations\ForeignApplicationExaminationPolicy';
        $module->processor = '\App\Projects\DgmeStudents\Modules\ForeignApplicationExaminations\ForeignApplicationExaminationProcessor';
        $module->controller = '\App\Projects\DgmeStudents\Modules\ForeignApplicationExaminations\ForeignApplicationExaminationController';
        $module->view_directory = 'projects.dgme-students.modules.foreign-application-examinations';
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
        Schema::dropIfExists('foreign_application_examinations');
    }
}
