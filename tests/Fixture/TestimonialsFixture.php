<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * TestimonialsFixture
 */
class TestimonialsFixture extends TestFixture
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
                'id' => 1,
                'student_name' => 'Lorem ipsum dolor sit amet',
                'testimonial_title' => 'Lorem ipsum dolor sit amet',
                'testimonial_text' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
                'rating' => 1,
                'image_url' => 'Lorem ipsum dolor sit amet',
                'created_at' => 1713861209,
            ],
        ];
        parent::init();
    }
}
