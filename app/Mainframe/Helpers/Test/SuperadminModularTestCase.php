<?php
/** @noinspection PhpUndefinedClassInspection */

namespace App\Mainframe\Helpers\Test;

use App\Mainframe\Features\Responder\Response;
use App\Module;

class SuperadminModularTestCase extends SuperadminTestCase
{

    /**
     * The module name that is being tested
     *
     * @var string
     */
    public $moduleName;

    /**
     * @var \App\Mainframe\Modules\Modules\Module
     */
    public $module;

    /**
     * Executes at the beginning of the class
     *
     * @return void
     */
    public static function setUpBeforeClass(): void
    {
        fwrite(STDOUT, __METHOD__."\n");
    }

    /**
     * Executes at the end of the class
     *
     * @return void
     */
    public static function tearDownAfterClass(): void
    {
        (new self())->setUp(); // Note: Need to instantiate the laravel app to access the classes

        fwrite(STDOUT, __METHOD__."\n");
        //        // Delete test entries
        //        fwrite(STDOUT, "🧹 Clean test data ... ");
        //        Division::where('name', 'LIKE', '%TEST--%')->whereNull('name')->forceDelete();
        //        fwrite(STDOUT, "Done \n");
    }

    /**
     * Set up the class. This works like constructor and run
     * before every test method
     */
    protected function setUp(): void
    {
        parent::setUp();
        $this->module = Module::byName($this->moduleName);
    }

    /*
    |--------------------------------------------------------------------------
    | Section: Helpers
    |--------------------------------------------------------------------------
    |
    | These are not actual tests rather helpers to fun the tests.
    |
    */

    /**
     * Input fields based on form order. These inputs will be used to save a new element
     * These fields should also be available in the HTML form.
     *
     * @return array
     */
    public function inputs()
    {
        return [
            'name' => $this->testPrefix,
            'is_active' => 1
        ];
    }

    /**
     * Default error message that are expected when the form is posted with no input.
     *
     * @return string[]
     */
    public function defaultErrors()
    {
        return [
            //"Failed to create new " . \Str::singular($this->module->title),
            "The name field is required.",
            "The is_active field is required."
        ];
    }

    /**
     * Value of the elemnt that are updated through test.
     *
     * @return array
     */
    public function updateValues()
    {
        $latest = $this->latest();

        return [
            'name' => 'UPDATED '.$latest->name,
        ];
    }

    /**
     * Grid column names in required order. These should be available in datatable/grid table header
     *
     * @return string[]
     */
    public function gridColumns()
    {
        return ['ID', 'Name', 'Updater', 'Updated at', 'Active'];
    }

    /**
     * Array of HTML markups created for each input. This HTML should be available in the form
     *
     * @return array
     */
    public function inputHtmlMarkupTexts()
    {
        return collect($this->inputs())->keys()
            ->map(function ($item, $key) {
                return 'id="'.$item.'"';   // Note: this produces string 'id="name"'. You may produce a different search string.
            })->all();
    }

    public function cleanTestData($table = null)
    {
        $table = $table ?: $this->module->tableName();
        // Delete test entries
        fwrite(STDOUT, "🧹 Clean test data from table : {$table} ... ");
        \DB::table($table)->where('name', 'LIKE', '%'.$this->testPrefix.'%')->orWhereNull('name')->delete();
        fwrite(STDOUT, "Done \n");

        return $this;
    }

    public function migrateLegacyData($mapper = null)
    {
        $mapper = $mapper ?: \Str::studly($this->module->name).'Mapper';
        // Load existing data
        fwrite(STDOUT, "📦 Load existing data using mapper ... ");
        \Artisan::call('hris:migrate-legacy-data '.$mapper);
        fwrite(STDOUT, "Done \n");

        return $this;
    }
    /*
    |--------------------------------------------------------------------------
    | Section: JSON based tests
    |--------------------------------------------------------------------------
    |
    */
    /**
     * User can not store invalid element
     *
     * @return \Illuminate\Foundation\Testing\TestResponse|\Illuminate\Testing\TestResponse
     */
    public function test_json_user_can_not_store_invalid_element()
    {
        # Code: Prepare URL, data etc
        $url = "/{$this->module->route_path}?ret=json";
        $input = [];

        # Code: Execute request, check status
        $this->print(self::MSG_CREATE_ELEMENT, ["POST:".$url, $input]);
        $response = $this->post($url, $input);
        $this->print(self::MSG_GOT_RESPONSE_CONTENT, [$response->getContent()]);
        $response->assertStatus(200);

        # Code: Check additional response data
        $expectation = [
            'code' => 422,
            'status' => 'fail',
            'errors' => [],
        ];
        $this->print(self::MSG_CHECK_RESPONSE_CONTAINS, [$expectation]);
        $response->assertJson($expectation);

        # Code: Additionally check error messages
        $errors = $this->getErrorsFromResponse($response);
        $this->print(self::MSG_ERRORS_FOUND, [$errors]);

        foreach ($this->defaultErrors() as $expectedError) {
            $this->assertContains($expectedError, $errors,
                self::MSG_EXPECTED_ERROR_NOT_FOUND.$expectedError."\n");
        }

        return $response;
    }

    /**
     * User can create a new element if input is valid
     *
     * @return \Illuminate\Foundation\Testing\TestResponse|\Illuminate\Testing\TestResponse
     * @noinspection PhpUndefinedClassInspection@throws \Exception
     */
    public function test_json_user_can_store_valid_element()
    {
        # Code: Prepare URL, data etc
        $url = "/{$this->module->route_path}?ret=json";
        $inputs = $this->inputs();
        $inputs_modified = array_merge(
            $inputs,
            ['redirect_success' => '#new']
        );

        # Code: Execute request, check status
        $this->print(self::MSG_CREATE_ELEMENT, ["POST:".$url, $inputs_modified]);
        $response = $this->post($url, $inputs_modified);
        $this->print(self::MSG_GOT_RESPONSE_CONTENT, [$response->getContent()]);
        $response->assertStatus(200);

        # Code: Check response
        $expectation = [
            'code' => 200,
            'status' => 'success',
            'data' => [],
        ];
        $this->print(self::MSG_CHECK_RESPONSE_CONTAINS, [$expectation]);
        $response->assertJson($expectation);

        # Code: Additionally check paylaod data
        $this->print(self::MSG_CHECK_RESPONSE_CONTAINS, [$inputs]);
        $payload = $this->getPayloadFromResponse($response);

        foreach ($inputs as $key => $value) {
            $this->assertEquals($value, $payload[$key], "Value mismatch for :$key");
        }

        return $response;
    }

    /**
     * Check duplicate fields
     *
     * @return \Illuminate\Foundation\Testing\TestResponse|\Illuminate\Testing\TestResponse
     * @noinspection PhpUndefinedClassInspection
     */
    public function test_json_user_can_not_store_duplicate_element()
    {
        # Code: Prepare URL, data etc
        $latest = $this->latest();
        $url = "/{$this->module->route_path}?ret=json";
        $input = [
            'name' => $latest->name,
        ];

        # Code: Execute request, check status
        $this->print(self::MSG_CREATE_ELEMENT, ["POST:".$url, $input]);
        $response = $this->post($url, $input);
        $this->print(self::MSG_GOT_RESPONSE_CONTENT, [$response->getContent()]);
        $response->assertStatus(200);

        # Code: Check additional response data
        $expectation = [
            'code' => Response::HTTP_UNPROCESSABLE_ENTITY,
            'status' => 'fail',
            'data' => [
                'name' => $latest->name,
            ],
            'validation_errors' => [
                'name' => ["The name has already been taken."]
            ]
        ];
        $this->print(self::MSG_CHECK_RESPONSE_CONTAINS, [$expectation]);
        $response->assertJson($expectation);

        return $response;
    }

    /**
     * User can view list of element
     *
     * @return \Illuminate\Foundation\Testing\TestResponse|\Illuminate\Testing\TestResponse
     */
    public function test_json_user_can_view_list()
    {
        # Code: Prepare URL, data etc
        $url = "/{$this->module->route_path}/list/json";

        # Code: Execute request, check status
        $this->print(self::MSG_GET_FROM, ["GET:".$url]);
        $response = $this->get($url);
        $this->print(self::MSG_GOT_RESPONSE_CONTENT, [$response->getContent()]);
        $response->assertStatus(200);

        # Code: Check additional response data
        $expectation = [
            'data' => [
                "current_page",
                "first_page_url",
                "from",
                "last_page",
                "last_page_url",
                "links" => [],
                "next_page_url",
                "path",
                "per_page",
                "prev_page_url",
                "to",
                "total",
                "items" => []
            ]
        ];
        $this->print(self::MSG_CHECK_RESPONSE_CONTAINS, [$expectation]);
        $response->assertJsonStructure($expectation);

        return $response;
    }

    /**
     * User can view element as a json object
     *
     * @return \Illuminate\Foundation\Testing\TestResponse|\Illuminate\Testing\TestResponse
     * @noinspection PhpUndefinedClassInspection
     */
    public function test_json_user_can_view_element()
    {
        # Code: Prepare URL, data etc
        $latest = $this->latest();
        $url = "/{$this->module->route_path}/$latest->id?ret=json";

        # Code: Execute request, check status
        $this->print(self::MSG_CREATE_ELEMENT, ["GET:".$url]);
        $response = $this->get($url);
        $this->print(self::MSG_GOT_RESPONSE_CONTENT, [$response->getContent()]);
        $response->assertStatus(200);

        # Code: Check additional response data
        $expectation = [
            "code" => 200,
            "status" => "success",
            "data" => $latest->toArray()
        ];

        $this->print(self::MSG_CHECK_RESPONSE_CONTAINS, [$expectation]);
        $response->assertJson($expectation);

        return $response;
    }

    /**
     * User can update an element with valid data
     *
     * @return \Illuminate\Foundation\Testing\TestResponse|\Illuminate\Testing\TestResponse
     * @noinspection PhpUndefinedClassInspection
     */
    public function test_json_user_can_update_element()
    {
        # Code: Prepare URL, data et
        $latest = $this->latest();
        $url = "/{$this->module->route_path}/$latest->id?ret=json";
        $updates = $this->updateValues();

        # Code: Execute request, check status
        $this->print(self::MSG_UPDATE_ELEMENT, ["PATCH:".$url, $updates]);
        $response = $this->patch($url, $updates);
        $this->print(self::MSG_GOT_RESPONSE_CONTENT, [$response->getContent()]);
        $response->assertStatus(200);

        # Code: Check additional response data
        $expectation = [
            'code' => 200,
            'status' => 'success',
            'data' => $updates,
        ];
        $this->print(self::MSG_CHECK_RESPONSE_CONTAINS, [$expectation]);
        $response->assertJson($expectation);

        return $response;
    }

    /**
     * User can update an element with valid data
     *
     * @return \Illuminate\Foundation\Testing\TestResponse|\Illuminate\Testing\TestResponse
     * @noinspection PhpUndefinedClassInspection
     */
    public function test_json_user_can_resave_an_element_without_changing()
    {
        # Code: Prepare URL, data etc
        $latest = $this->latest();
        $url = "/{$this->module->route_path}/$latest->id?ret=json";
        $updates = $latest->toArray();

        # Code: Execute request, check status
        $this->print(self::MSG_UPDATE_ELEMENT, ["PATCH:".$url, $updates]);
        $response = $this->patch($url, $updates);
        $this->print(self::MSG_GOT_RESPONSE_CONTENT, [$response->getContent()]);
        $response->assertStatus(200);

        # Code: Check additional response data
        $expectation = [
            'code' => 200,
            'status' => 'success',
            'data' => [],
        ];
        $this->print(self::MSG_CHECK_RESPONSE_CONTAINS, [$expectation]);
        $response->assertJson($expectation);

        return $response;
    }

    /**
     * User can delete an element
     *
     * @return \Illuminate\Foundation\Testing\TestResponse|\Illuminate\Testing\TestResponse
     */
    public function test_json_user_can_delete_element()
    {
        sleep(1); // Add delay

        # Code: Prepare URL, data etc
        $latest = $this->latest();
        $url = "/{$this->module->route_path}/$latest->id?ret=json";

        # Code: Execute request, check status
        $this->print(self::MSG_DELETE_ELEMENT, ["DELETE:".$url]);
        $response = $this->delete($url);
        $this->print(self::MSG_GOT_RESPONSE_CONTENT, [$response->getContent()]);
        $response->assertStatus(200);

        # Code: Check additional response data
        $expectation = [
            'code' => 200,
            'status' => 'success',
            'message' => "The ".\Str::singular($this->module->title)." is deleted",
            'data' => [
                'code' => $latest->code,
                'name' => $latest->name,
            ],
        ];
        $this->print(self::MSG_CHECK_RESPONSE_CONTAINS, [$expectation]);
        $response->assertJson($expectation);

        // Code: Check if it has been soft deleted.
        $this->assertDatabaseMissing($this->module->tableName(), ['id' => $latest->id, 'deleted_at' => null]);
        $this->print(self::MSG_CHECK_DB." :".$this->module->tableName()." soft deleted #".$latest->id);
        return $response;
    }

    /*
    |--------------------------------------------------------------------------
    | Section: HTML based tests
    |--------------------------------------------------------------------------
    |
    */
    public function test_user_can_see_create_form_input_fields()
    {
        # Code: Prepare URL, data etc
        $url = '/'.$this->module->route_path.'/create';

        # Code: Execute request, check status
        $this->print(self::MSG_CREATE_ELEMENT, ["GET:".$url]);
        $response = $this->followingRedirects()->get($url);
        $response->assertStatus(200);

        # Code: Check if content has following
        $contents = [
            $this->module->title
        ];
        $this->print(self::MSG_CHECK_RESPONSE_CONTAINS, [$contents]);
        foreach ($contents as $content) {
            $this->print(self::MSG_CHECK_RESPONSE_CONTAINS, [$content]);
            $response->assertSee($content); // See the module title in header
        }

        # Code: Check if content has following (In given order)
        $contents = $this->inputHtmlMarkupTexts();
        $this->print(self::MSG_CHECK_RESPONSE_CONTAINS_IN_ORDER, [$contents]);
        $response->assertSeeInOrder($contents, false);

        return $response;
    }

    /**
     * User can not store invalid element
     *
     * @return \Illuminate\Foundation\Testing\TestResponse|\Illuminate\Testing\TestResponse
     */
    public function test_user_can_not_store_invalid_element()
    {
        # Code: Prepare URL, data etc
        $url = '/'.$this->module->route_path;
        $input = [];

        # Code: Execute request, check status
        $this->print(self::MSG_CREATE_ELEMENT, ["POST:".$url, $input]);
        $response = $this->followingRedirects()->post($url, $input);
        $response->assertStatus(200);

        # Code: Check if content has following
        $contents = [
            'Fail'
        ];
        $this->print(self::MSG_CHECK_RESPONSE_CONTAINS, [$contents]);
        foreach ($contents as $content) {
            $this->print(self::MSG_CHECK_RESPONSE_CONTAINS, [$content]);
            $response->assertSee($content); // See the module title in header
        }

        # Code: Check if content has following error messages
        $errors = $this->defaultErrors();
        $this->print(self::MSG_CHECK_RESPONSE_ERROR_MESSAGES, [$errors]);
        foreach ($errors as $error) {
            $this->printLn(self::MSG_LOOKING_FOR, [$error]);
            $response->assertSee($error);
        }
        return $response;
    }

    /**
     * User can only store element that is valid
     *
     * @return \Illuminate\Foundation\Testing\TestResponse|\Illuminate\Testing\TestResponse
     * @noinspection PhpUndefinedClassInspection
     * @throws \Exception
     */
    public function test_user_can_store_valid_element()
    {
        # Code: Prepare URL, data etc
        $url = '/'.$this->module->route_path;
        $inputs_modified = array_merge(
            $this->inputs(),
            ['redirect_success' => '#new']
        );

        # Code: Execute request, check status
        $this->print(self::MSG_CREATE_ELEMENT, ["POST:".$url, $inputs_modified]);
        $response = $this->followingRedirects()->post($url, $inputs_modified);
        $response->assertStatus(200);

        # Code: Check if content has following
        foreach ($this->inputs() as $key => $value) {
            $this->printLn(self::MSG_LOOKING_FOR, $key.": ".$value);
            $response->assertSee($value);
        }

        return $response;
    }

    /**
     * User can view list of elements in index page (module grid page)
     *
     * @return \Illuminate\Foundation\Testing\TestResponse|\Illuminate\Testing\TestResponse
     */
    public function test_user_can_view_list()
    {
        # Code: Prepare URL, data etc
        $url = '/'.$this->module->route_path;

        # Code: Execute request, check status
        $this->print(self::MSG_GET_FROM, ["GET:".$url]);
        $response = $this->followingRedirects()->get($url);
        $response->assertStatus(200);

        # Code: Check if content has following
        $contents = [
            $this->module->title,
            'View advanced report with filters, excel export etc.'
        ];
        $this->print(self::MSG_CHECK_RESPONSE_CONTAINS, [$contents]);
        foreach ($contents as $content) {
            $this->print(self::MSG_CHECK_RESPONSE_CONTAINS, [$content]);
            $response->assertSee($content); // See the module title in header
        }

        # Code: Check if content has following (In given order)
        $contents = [
            'Create a new '.\Str::lower(\Str::singular($this->module->title)), // View create button
            '<i class="fa fa-plus-circle"></i>'
        ];
        $this->print(self::MSG_CHECK_RESPONSE_CONTAINS_IN_ORDER, [$contents]);
        $response->assertSeeInOrder($contents, false);

        # Code: Check if content has following (In given order)
        $contents = $this->gridColumns();
        $this->print(self::MSG_CHECK_RESPONSE_CONTAINS_IN_ORDER." (Datatable columns) ", [$contents]);
        $response->assertSeeInOrder($contents, false);

        # Code: Prepare URL, data etc
        // See data table JSON output
        $url = '/'.$this->module->route_path.'/datatable/json';

        # Code: Execute request, check status
        $this->print(self::MSG_GET_FROM, ["GET:".$url]);
        $response = $this->followingRedirects()->get($url);
        $response->assertStatus(200);

        return $response;
    }

    /**
     * User can view the element
     *
     * @return \Illuminate\Foundation\Testing\TestResponse|\Illuminate\Testing\TestResponse
     */
    public function test_user_can_view_an_element()
    {
        # Code: Prepare URL, data etc
        $latest = $this->latest();
        $url = "/{$this->module->route_path}/$latest->id";

        # Code: Execute request, check status
        $this->print(self::MSG_GET_FROM, ["GET:".$url]);
        $response = $this->followingRedirects()->get($url);
        $response->assertStatus(200);

        return $response;
    }

    /**
     * User can view edit page.
     *
     * @return \Illuminate\Foundation\Testing\TestResponse|\Illuminate\Testing\TestResponse
     */
    public function test_user_can_edit_element()
    {
        # Code: Prepare URL, data etc
        $latest = $this->latest();
        $url = "/{$this->module->route_path}/$latest->id/edit";

        # Code: Execute request, check status
        $this->print(self::MSG_GET_FROM, ["GET:".$url]);
        $response = $this->followingRedirects()->get($url);
        $response->assertStatus(200);

        # Code: Check if content has following
        $contents = [
            $this->module->title
        ];
        $this->print(self::MSG_CHECK_RESPONSE_CONTAINS, [$contents]);
        foreach ($contents as $content) {
            $this->printLn(self::MSG_CHECK_RESPONSE_CONTAINS, [$content]);
            $response->assertSee($content); // See the module title in header
        }

        # Code: Check if content has following (In given order)
        $contents = $this->inputHtmlMarkupTexts();
        $this->print(self::MSG_CHECK_RESPONSE_CONTAINS_IN_ORDER, [$contents]);
        $response->assertSeeInOrder($contents, false);

        return $response;
    }

    /**
     * User can update an element
     *
     * @return \Illuminate\Foundation\Testing\TestResponse|\Illuminate\Testing\TestResponse
     */
    public function test_user_can_update_element()
    {
        # Code: Prepare URL, data etc
        $latest = $this->latest();

        $url = "/{$this->module->route_path}/$latest->id";
        $updates = $this->updateValues();

        # Code: Execute request, check status
        $this->print(self::MSG_UPDATE_ELEMENT, ["PATCH:".$url, $updates]);
        $response = $this->followingRedirects()->patch($url, $updates);

        # Code: Check if content has following
        $contents = [
            'Success'
        ];
        $this->print(self::MSG_CHECK_RESPONSE_CONTAINS, [$contents]);
        foreach ($contents as $content) {
            $this->printLn(self::MSG_CHECK_RESPONSE_CONTAINS, [$content]);
            $response->assertSee($content); // See the module title in header
        }

        # Code: Check if content has following
        $this->print(self::MSG_CHECK_RESPONSE_CONTAINS, [$updates]);
        foreach ($updates as $key => $value) {
            $this->printLn(self::MSG_LOOKING_FOR, $key.": ".$value);
            $response->assertSee($value);
        }

        return $response;
    }

    /**
     * User can delete an element
     *
     * @return \Illuminate\Foundation\Testing\TestResponse|\Illuminate\Testing\TestResponse
     */
    public function test_user_can_delete_element()
    {
        sleep(1); // Add a bit of delay

        # Code: Prepare URL, data etc
        $latest = $this->latest();
        $url = "/{$this->module->route_path}/$latest->id?redirect_success=".route($this->module->name.'.index');

        # Code: Execute request, check status
        $this->print(self::MSG_DELETE_ELEMENT, ["DELETE:".$url]);
        $response = $this->followingRedirects()->delete($url);
        $response->assertStatus(200);

        # Code: Check if content has following
        $contents = [
            $this->module->title
        ];
        $this->print(self::MSG_CHECK_RESPONSE_CONTAINS, [$contents]);
        foreach ($contents as $content) {
            $this->printLn(self::MSG_CHECK_RESPONSE_CONTAINS, [$content]);
            $response->assertSee($content); // See the module title in header
        }

        // Code: Check if it has been soft deleted.
        $this->assertDatabaseMissing($this->module->tableName(), ['id' => $latest->id, 'deleted_at' => null]);
        $this->print(self::MSG_CHECK_DB." :".$this->module->tableName()." soft deleted #".$latest->id);
        return $response;
    }

    /**
     * User can view report
     *
     * @return \Illuminate\Foundation\Testing\TestResponse|\Illuminate\Testing\TestResponse
     */
    public function test_user_can_view_report()
    {
        # Code: Prepare URL, data etc
        $url = '/'.$this->module->route_path.'/report?submit=Run';

        # Code: Execute request, check status
        $this->print(self::MSG_GET_FROM, ["GET:".$url]);
        $response = $this->followingRedirects()->get($url);
        $response->assertStatus(200);

        # Code: Check if content has following
        $contents = [
            $this->module->title
        ];
        $this->print(self::MSG_CHECK_RESPONSE_CONTAINS, [$contents]);
        foreach ($contents as $content) {
            $this->printLn(self::MSG_CHECK_RESPONSE_CONTAINS, [$content]);
            $response->assertSee($content); // See the module title in header
        }

        return $response;
    }

}


