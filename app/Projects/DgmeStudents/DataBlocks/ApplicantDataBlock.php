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
        $totalApplicationCount=$user->applications()->whereNotIn('status',['Declined'])->count();
        $inProgressMBBSApplicationCount=$user->applications()->where('course_id',1)->whereNotIn('status',['Declined'])->count();
        $inProgressMBBSApplication=$user->applications()->where('course_id',1)->whereNotIn('status',['Declined'])->first();
        $inProgressBDSApplicationCount=$user->applications()->where('course_id',2)->whereNotIn('status',['Declined'])->count();
        $inProgressBDSApplication=$user->applications()->where('course_id',2)->whereNotIn('status',['Declined'])->first();
        // Todo: Prepare and load data

        $this->data = [
            'applications' => [
                'total' => $totalApplicationCount,
                'ongoingMBBSNumber' => $inProgressMBBSApplicationCount,
                'ongoingMBBSApplicationId'=>($inProgressMBBSApplication)?$inProgressMBBSApplication->id:null,
                'ongoingMBBSApplicationStatus'=>($inProgressMBBSApplication)?$inProgressMBBSApplication->status:null,
                'ongoingBDSNumber' => $inProgressBDSApplicationCount,
                'ongoingBDSApplicationId'=>($inProgressBDSApplication)?$inProgressBDSApplication->id:null,
                'ongoingBDSApplicationStatus'=>($inProgressBDSApplication)?$inProgressBDSApplication->status:null
            ],
        ];
    }

    // Write Additional helper for data calculation if needed.

}