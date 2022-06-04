<?php

namespace App\Projects\DgmeStudents\DataBlocks;

use App\Projects\DgmeStudents\Features\DataBlocks\DataBlock;
use App\Projects\DgmeStudents\Modules\ApplicationSessions\ApplicationSession;
use App\Projects\DgmeStudents\Modules\ForeignStudentApplications\ForeignStudentApplication;
use App\User;

class AdminDataBlock extends DataBlock
{
    /**
     * Load the result
     *
     * @var mixed
     */
    public $data;

    /**
     * Cache Seconds
     *
     * @var int
     */
    public $cache = 6;

    /**
     * Process the result
     */
    public function process()
    {
        $user=user();
        $draft=$submitted=null;
        $draft=ForeignStudentApplication::where('status',ForeignStudentApplication::STATUS_DRAFT)->count();
        $submitted=ForeignStudentApplication::where('status',ForeignStudentApplication::STATUS_SUBMITTED)->count();
        $total=$draft+$submitted;
        // Session
        $latestSession=ApplicationSession::latestSession();

        //User
        $totalUsers=User::count();



        $this->data = [
            'applications' => [
                'total' => $total,
                'draft' => $draft,
                'submitted' => $submitted,
                'latestSession'=>$latestSession,
                'totalUsers'=>$totalUsers,
            ],
        ];
    }

    // Write Additional helper for data calculation if needed.

}