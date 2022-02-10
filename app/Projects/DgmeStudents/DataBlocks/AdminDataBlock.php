<?php

namespace App\Projects\DgmeStudents\DataBlocks;

use App\Projects\DgmeStudents\Features\DataBlocks\DataBlock;
use App\Projects\DgmeStudents\Modules\ForeignStudentApplications\ForeignStudentApplication;

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
        $totalApplications=ForeignStudentApplication::count();
        $inProgressApplications=ForeignStudentApplication::whereNotIn('status',['Declined'])->count();
        //$inProgressApplication=$user->applications()->whereNotIn('status',['Declined'])->first();
        // Todo: Prepare and load data

        $this->data = [
            'applications' => [
                'total' => $totalApplications,
                'ongoing' => $inProgressApplications,
            ],
        ];
    }

    // Write Additional helper for data calculation if needed.

}