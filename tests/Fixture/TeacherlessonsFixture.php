<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * TeacherlessonsFixture
 */
class TeacherlessonsFixture extends TestFixture
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
                'teacherlesson_id' => 1,
                'teacher_id' => 1,
                'lesson_id' => 1,
            ],
        ];
        parent::init();
    }
}
