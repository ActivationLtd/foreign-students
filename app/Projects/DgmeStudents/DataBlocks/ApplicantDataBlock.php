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
        $user = user();
        $totalApplicationCount = $user->applications()->whereNotIn('status', ['Declined'])->count();


        $inProgressGovernmentMBBSApplicationCount = $user->applications()->where('course_id', 1)->whereNotIn('status', ['Declined'])
            ->where('application_category', 'Government')->count();
        $inProgressGovermentBDSApplicationCount = $user->applications()->where('course_id', 2)->whereNotIn('status', ['Declined'])
            ->where('application_category', 'Government')->count();

        $inProgressPrivateMBBSApplicationCount = $user->applications()->where('course_id', 1)->whereNotIn('status', ['Declined'])
            ->where('application_category', 'Private')->count();
        $inProgressPrivateBDSApplicationCount = $user->applications()->where('course_id', 2)->whereNotIn('status', ['Declined'])
            ->where('application_category', 'Private')->count();

        $showGovernmentApplicationCreateButton = true;
        if ($inProgressGovernmentMBBSApplicationCount == 1 && $inProgressGovermentBDSApplicationCount == 1) {
            $showGovernmentApplicationCreateButton = false;
        }
        $showPvtApplicationCreateButton = true;
        if ($inProgressPrivateMBBSApplicationCount == 1 && $inProgressPrivateBDSApplicationCount == 1) {
            $showPvtApplicationCreateButton = false;
        }
        // Todo: Prepare and load data

        $this->data = [
            'applications' => [
                'total' => $totalApplicationCount,
                'gov' => $inProgressGovernmentMBBSApplicationCount + $inProgressGovermentBDSApplicationCount,
                'private' => $inProgressPrivateMBBSApplicationCount + $inProgressPrivateBDSApplicationCount,
                'showGovtApplicationCreateButton' => $showGovernmentApplicationCreateButton,
                'showPvtApplicationCreateButton' => $showPvtApplicationCreateButton,
            ],
        ];
    }

    // Write Additional helper for data calculation if needed.

}