<?php

namespace App\Projects\DgmeStudents\DataBlocks;

use App\Projects\DgmeStudents\Features\DataBlocks\DataBlock;

class ApplicantDataBlock extends DataBlock
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
        $totalApplications=$user->applications()->count();
        $inProgressApplications=$user->applications()->whereNotIn('status',['Declined'])->count();
        $inProgressApplication=$user->applications()->whereNotIn('status',['Declined'])->first();
        // Todo: Prepare and load data

        $this->data = [
            'applications' => [
                'total' => $totalApplications,
                'ongoing' => $inProgressApplications,
                'ongoingApplicationId'=>($inProgressApplication)?$inProgressApplication->id:null,
                'ongoingApplicationStatus'=>($inProgressApplication)?$inProgressApplication->status:null
            ],
        ];
    }

    // Write Additional helper for data calculation if needed.

}