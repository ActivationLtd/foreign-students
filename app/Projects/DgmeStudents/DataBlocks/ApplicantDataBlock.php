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
        $mbbsQuery = $user->applications()->where('course_id', 1)->whereNotIn('status', ['Declined']);
        $mbbsQueryGovernmentCount= clone $mbbsQuery;
        $mbbsQueryGovernment= clone $mbbsQuery;
        $mbbsQueryPrivateCount= clone $mbbsQuery;
        $mbbsQueryPrivate= clone $mbbsQuery;
        $bdsQuery = $user->applications()->where('course_id', 2)->whereNotIn('status', ['Declined']);
        $bdsQueryGovernmentCount= clone $bdsQuery;
        $bdsQueryGovernment= clone $bdsQuery;
        $bdsQueryPrivateCount= clone $bdsQuery;
        $bdsQueryPrivate= clone $bdsQuery;
        $inProgressGovernmentMBBSApplicationCount = $mbbsQueryGovernmentCount->where('application_category', 'Government')->count();
        $inProgressGovernmentMBBSApplication = $mbbsQueryGovernment->where('application_category', 'Government')->first();
        $inProgressPrivateMBBSApplicationCount = $mbbsQueryPrivateCount->where('application_category', 'Private')->count();
        $inProgressPrivateMBBSApplication = $mbbsQueryPrivate->where('application_category', 'Private')->first();

        $inProgressGovermentBDSApplicationCount = $bdsQueryGovernmentCount->where('application_category', 'Government')->count();
        $inProgressGovernmentBDSApplication = $bdsQueryGovernment->where('application_category', 'Government')->first();

        $inProgressPrivateBDSApplicationCount = $bdsQueryPrivateCount->where('application_category', 'Private')->count();

        $inProgressPrivateBDSApplication = $bdsQueryPrivate->where('application_category', 'Private')->first();

        // Todo: Prepare and load data

        $this->data = [
            'applications' => [
                'total' => $totalApplicationCount,
                'ongoingGovernmentMBBSNumber' => $inProgressGovernmentMBBSApplicationCount,
                'ongoingPrivateMBBSNumber' => $inProgressPrivateMBBSApplicationCount,
                'ongoingGovernmentMBBSApplicationId' => ($inProgressGovernmentMBBSApplication) ? $inProgressGovernmentMBBSApplication->id : null,
                'ongoingGovernmentMBBSApplicationStatus' => ($inProgressGovernmentMBBSApplication) ? $inProgressGovernmentMBBSApplication->status : null,
                'ongoingPrivateMBBSApplicationId' => ($inProgressPrivateMBBSApplication) ? $inProgressPrivateMBBSApplication->id : null,
                'ongoingPrivateMBBSApplicationStatus' => ($inProgressPrivateMBBSApplication) ? $inProgressPrivateMBBSApplication->status : null,
                'ongoingGovernmentBDSNumber' => $inProgressGovermentBDSApplicationCount,
                'ongoingPrivateBDSNumber' => $inProgressPrivateBDSApplicationCount,
                'ongoingGovernmentBDSApplicationId' => ($inProgressGovernmentBDSApplication) ? $inProgressGovernmentBDSApplication->id : null,
                'ongoingGovernmentBDSApplicationStatus' => ($inProgressGovernmentBDSApplication) ? $inProgressGovernmentBDSApplication->status : null,
                'ongoingPrivateBDSApplicationId' => ($inProgressPrivateBDSApplication) ? $inProgressPrivateBDSApplication->id : null,
                'ongoingPrivateBDSApplicationStatus' => ($inProgressPrivateBDSApplication) ? $inProgressPrivateBDSApplication->status : null,
            ],
        ];
    }

    // Write Additional helper for data calculation if needed.

}