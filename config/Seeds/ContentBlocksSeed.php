<?php
declare(strict_types=1);

use Migrations\AbstractSeed;

class ContentBlocksSeed extends AbstractSeed
{
    public function run(): void
    {
        $data = [
            // Global Content Blocks
            [
                "parent" => "global",
                "label" => "Website Title",
                "description" => "Shown on the home page, as well as any tabs in the user's browser.",
                "slug" => "website-title",
                "type" => "text",
                "value" => "TuneCraft Studio",
            ],
            // About Us Content Blocks
            [
                "parent" => "about",
                "label" => "About Heading 1",
                "description" => "Heading for the About page.",
                "slug" => "about-heading-1",
                "type" => "text",
                "value" => "Hello, I'm Afrooz Amini",
            ],
            [
                "parent" => "about",
                "label" => "About Text 1",
                "description" => "Text content for the About page.",
                "slug" => "about-text-1",
                "type" => "text",
                "value" => "
                    Your violin instructor here at Tunecraftstudio.
                    8 Years of teaching experience.
                    Specialized in the Suzuki teaching approach and AMEB violin exam syllabus.
                    I assure to provide a comprehensive learning experience for my students
                    on their musical journey here at Tunecraftstudio.
                ",
            ],
            [
                "parent" => "about",
                "label" => "About Heading 3",
                "description" => "Heading for the About page.",
                "slug" => "about-heading-3",
                "type" => "text",
                "value" => "Our Studio",
            ],
            [
                "parent" => "about",
                "label" => "About Image 1",
                "description" => "Image for the about us heading section",
                "slug" => "about-heading-image",
                "type" => "image",
            ],
            [
                "parent" => "about",
                "label" => "About Heading 2",
                "description" => "Heading for the 'My Work' section on the About page.",
                "slug" => "about-heading-2",
                "type" => "text",
                "value" => "My Work",
            ],
            [
                "parent" => "about",
                "label" => "About Text 2",
                "description" => "Text content for the 'My Work' section on the About page.",
                "slug" => "about-text-2",
                "type" => "text",
                "value" => "
                    My teaching approach emphasizes personalized attention and tailored instruction, ensuring each student
                    receives the support they need to thrive in a nurturing and inspiring learning environment. Specializing
                    in Suzuki methodology, I adapt my teaching to suit individual student needs, offering both traditional
                    violin lessons and comprehensive preparation for the AMEB examination in Australia, ensuring a
                    well-rounded musical education for aspiring violinists.
                ",
            ],
            [
                "parent" => "about",
                "label" => "Studio Image 1",
                "description" => "Image for the first studio image in the 'Our Studio' section.",
                "slug" => "about-image-1",
                "type" => "image",
            ],
            [
                "parent" => "about",
                "label" => "Studio Image 2",
                "description" => "Image for the second studio image in the 'Our Studio' section.",
                "slug" => "about-image-2",
                "type" => "image",
            ],
            [
                "parent" => "about",
                "label" => "Studio Image 3",
                "description" => "Image for the third studio image in the 'Our Studio' section.",
                "slug" => "about-image-3",
                "type" => "image",
            ],
        ];

        $table = $this->table("content_blocks");
        $table->insert($data)->save();
    }
}
