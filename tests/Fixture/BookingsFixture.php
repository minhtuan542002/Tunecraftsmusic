<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * BookingsFixture
 */
class BookingsFixture extends TestFixture
{
    /**
     * Init method
     *
     * @return void
     */
    public function init(): void
    {
        $this->records = [
            [
                'booking_id' => 1,
                'student_id' => 1,
                'teacherlesson_id' => 1,
                'booking_datetime' => '2024-03-11 05:07:44',
                'is_paid' => 1,
            ],
        ];
        parent::init();
    }
}
