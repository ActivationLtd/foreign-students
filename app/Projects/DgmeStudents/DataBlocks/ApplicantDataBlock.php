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

        $inProgressGovApplicationCount = $user->applications()->whereNotIn('status', ['Declined'])
            ->where('application_category', 'Government')->count();

        $inProgressPvtApplicationCount = $user->applications()->whereNotIn('status', ['Declined'])
            ->where('application_category', 'Private')->count();

        // Todo: Prepare and load data

        $this->data = [
            'applications' => [
                'total' => $totalApplicationCount,
                'gov' => $inProgressGovApplicationCount,
                'private' => $inProgressPvtApplicationCount,
            ],
        ];
    }

    // Write Additional helper for data calculation if needed.

}