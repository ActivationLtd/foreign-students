<?php

namespace App\Projects\DgmeStudents\Commands;

use App\ApplicationSession;
use Illuminate\Console\Command;

class UpdateSessionStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:update-session-status';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Automatically update session status based on starts_on:ends_on';

    /**
     * Execute the console command.
     * Invoice invoice
     *
     * @return mixed
     */
    public function handle()
    {
        ApplicationSession::where('starts_on', '<=', now())->where('ends_on', '>', now())->update(['status' => ApplicationSession::SESSION_STATUS_OPEN, 'is_active' => 1]);
        ApplicationSession::where('starts_on', '<', now())->where('ends_on', '<', now())->update(['status' => ApplicationSession::SESSION_STATUS_CLOSED]);
        ApplicationSession::where('starts_on', '>', now())->where('ends_on', '>', now())->update(['status' => ApplicationSession::SESSION_STATUS_SCHEDULED]);
    }
}