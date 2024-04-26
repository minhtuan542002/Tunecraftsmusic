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
            // Home Content Blocks
            [
                "parent" => "home",
                "label" => "Home Page Content",
                "description" => "The main content shown in the centre of the home page.",
                "slug" => "home-content",
                "type" => "text",
                "value" => "
                    Ready to amplify your violin skills? Join us now for an unforgettable journey of musical growth!
                ",
            ],
            [
                "parent" => "home",
                "label" => "Home Page Image",
                "description" => "Image shown on the right of the home page.",
                "slug" => "home-image",
                "type" => "image",
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
            // Pricing Content Blocks
            [
                "parent" => "pricing",
                "label" => "Pricing Heading 1",
                "description" => "Heading for the 1st pricing section.",
                "slug" => "pricing-heading-1",
                "type" => "text",
                "value" => "30 Minute Lesson",
            ],
            [
                "parent" => "pricing",
                "label" => "Pricing Price 1",
                "description" => "Price content for the 1st pricing section.",
                "slug" => "pricing-price-1",
                "type" => "text",
                "value" => "
                $50
                ",
            ],
            [
                "parent" => "pricing",
                "label" => "Pricing Text 1",
                "description" => "Price content for the 1st pricing section.",
                "slug" => "pricing-text-1",
                "type" => "text",
                "value" => "
                    Wanting to start your violin journey but have a busy schedule? Book our 30 minute weekly class to get started without having to move your schedule around.
                ",
            ],
            [
                "parent" => "pricing",
                "label" => "Pricing Heading 2",
                "description" => "Heading for the 2nd pricing section.",
                "slug" => "pricing-heading-2",
                "type" => "text",
                "value" => "45 Minute Lesson",
            ],
            [
                "parent" => "pricing",
                "label" => "Pricing Price 2",
                "description" => "Price content for the 2nd pricing section.",
                "slug" => "pricing-price-2",
                "type" => "text",
                "value" => "
                $65
                ",
            ],
            [
                "parent" => "pricing",
                "label" => "Pricing Text 2",
                "description" => "Text content for the 2nd pricing section.",
                "slug" => "pricing-text-2",
                "type" => "text",
                "value" => "
                    This lesson type provides a balanced duration for comprehensive learning without feeling too rushed. Our 45 minute weekly lesson are a good way to take your journey to the next level.
                ",
            ],
            [
                "parent" => "pricing",
                "label" => "Pricing Heading 3",
                "description" => "Heading for the 3rd pricing section.",
                "slug" => "pricing-heading-3",
                "type" => "text",
                "value" => "60 Minute Lesson",
            ],
            [
                "parent" => "pricing",
                "label" => "Pricing Price 3",
                "description" => "Price content for the 3rd pricing section.",
                "slug" => "pricing-price-3",
                "type" => "text",
                "value" => "
                $75
                ",
            ],
            [
                "parent" => "pricing",
                "label" => "Text 3",
                "description" => "Text content for the 3rd pricing section.",
                "slug" => "pricing-text-3",
                "type" => "text",
                "value" => "
                    This is perfect for anyone seeking an in-depth learning experience with ample time for practice and exploration. Our 60 minute weekly lessons allow you to immerse yourself and really hone in on bringing out your inner musician!
                ",
            ],
            [
                "parent" => "pricing",
                "label" => "Pricing Image 1",
                "description" => "Image for the 1st pricing section.",
                "slug" => "pricing-image-1",
                "type" => "image",
            ],
            [
                "parent" => "pricing",
                "label" => "Pricing Image 2",
                "description" => "Image for the 2nd pricing section.",
                "slug" => "pricing-image-2",
                "type" => "image",
            ],
            [
                "parent" => "pricing",
                "label" => "Pricing Image 3",
                "description" => "Image for the 3rd pricing section.",
                "slug" => "pricing-image-3",
                "type" => "image",
            ],
            // Learning resources data
            [
                "parent" => "learning_resources",
                "label" => "Learning Resource 1",
                "description" => "Learning resource for 1st section.",
                "slug" => "learning-resource-1",
                "type" => "text",
                "value" => "https://www.youtube.com/embed/wGu_zQBa2z4"
            ], [
                "parent" => "learning_resources",
                "label" => "Learning Resource 2",
                "description" => "Learning resource for 2st section.",
                "slug" => "learning-resource-2",
                "type" => "text",
                "value" => "https://www.youtube.com/embed/dYfMQF0-pHU"
            ], [
                "parent" => "learning_resources",
                "label" => "Learning Resource 3",
                "description" => "Learning resource for 3rd section.",
                "slug" => "learning-resource-3",
                "type" => "text",
                "value" => "https://www.youtube.com/embed/JUwGpoXO0tc"
            ],
            // Learning resource Headings
            [
                "parent" => "learning_resources",
                "label" => "Learning Heading 1",
                "description" => "Learning heading for 1st section.",
                "slug" => "learning-heading-1",
                "type" => "text",
                "value" => "Heading 1"
            ], [
                "parent" => "learning_resources",
                "label" => "Learning Heading 2",
                "description" => "Learning heading for 2nd section.",
                "slug" => "learning-heading-2",
                "type" => "text",
                "value" => "Heading 2"
            ], [
                "parent" => "learning_resources",
                "label" => "Learning Heading 3",
                "description" => "Learning heading for 3rd section.",
                "slug" => "learning-heading-3",
                "type" => "text",
                "value" => "Heading 3"
            ],

            // Learning resource descriptions
            [
                "parent" => "learning_resources",
                "label" => "Learning Description 1",
                "description" => "Learning description for 1st section.",
                "slug" => "learning-description-1",
                "type" => "text",
                "value" => "Description 1"
            ], [
                "parent" => "learning_resources",
                "label" => "Learning Description 2",
                "description" => "Learning description for 2nd section.",
                "slug" => "learning-description-2",
                "type" => "text",
                "value" => "Description 2"
            ], [
                "parent" => "learning_resources",
                "label" => "Learning Description 3",
                "description" => "Learning description for 3rd section.",
                "slug" => "learning-description-3",
                "type" => "text",
                "value" => "Description 3"
            ],

        ];

        $table = $this->table("content_blocks");
        $table->insert($data)->save();
    }
}
