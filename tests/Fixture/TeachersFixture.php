<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * TeachersFixture
 */
class TeachersFixture extends TestFixture
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
                'teacher_id' => 1,
                'user_id' => 1,
                'teacher_availability' => 'Lorem ipsum dolor sit amet',
            ],
        ];
        parent::init();
    }
}
