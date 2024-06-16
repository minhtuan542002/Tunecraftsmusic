Database Username and Password:
u23s2104_yes
-!76#-)T+eey

Database Schema:

-- roles Table
CREATE TABLE roles (
    role_id INT AUTO_INCREMENT PRIMARY KEY,
    role_name VARCHAR(255) UNIQUE NOT NULL,
    role_description TEXT
);

-- Insert predefined roles
INSERT INTO roles (role_name) VALUES ('STUDENT'), ('TEACHER'), ('ADMIN');

-- users Table
CREATE TABLE users (
    user_id INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(255) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    phone VARCHAR(15) NOT NULL,
    nonce VARCHAR(255),
    nonce_expiry DATETIME,
    first_name VARCHAR(255),
    last_name VARCHAR(255),
    role_id INT,
    note TEXT, 
    FOREIGN KEY (role_id) REFERENCES roles(role_id)
);

-- students Table (inherits from User)
CREATE TABLE students (
    student_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT UNIQUE NOT NULL,
    FOREIGN KEY (user_id) REFERENCES users(user_id)
);

-- teachers Table (inherits from User)
CREATE TABLE teachers (
    teacher_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT UNIQUE NOT NULL,
    teacher_availability JSON, -- Availability in JSON format
    FOREIGN KEY (user_id) REFERENCES users(user_id)
);

-- packages Table
CREATE TABLE packages (
    package_id INT AUTO_INCREMENT PRIMARY KEY,
    package_name VARCHAR(255) NOT NULL,
    number_of_lessons INT,
    lesson_duration_minutes INT,
    cost_dollars DECIMAL(10,2),
    description TEXT,
    is_deleted BOOLEAN DEFAULT FALSE
);

-- bookings Table
CREATE TABLE bookings (
    booking_id INT AUTO_INCREMENT PRIMARY KEY,
    student_id INT, 
    package_id INT NOT NULL,
    booking_datetime DATETIME NOT NULL,
    is_paid BOOLEAN DEFAULT FALSE,
    completed BOOLEAN DEFAULT FALSE,
    session_id TEXT, 
    note TEXT,
    FOREIGN KEY (student_id) REFERENCES students(student_id) ON DELETE CASCADE,
    FOREIGN KEY (package_id) REFERENCES packages(package_id) ON DELETE CASCADE
);

-- lessons Table
CREATE TABLE lessons (
    lesson_id INT AUTO_INCREMENT PRIMARY KEY,
    booking_id INT NOT NULL,
    teacher_id INT NOT NULL,
    lesson_start_time DATETIME NOT NULL,
    note TEXT,
    FOREIGN KEY (booking_id) REFERENCES bookings(booking_id) ON DELETE CASCADE,
    FOREIGN KEY (teacher_id) REFERENCES teachers(teacher_id)
);

-- blocker Table
CREATE TABLE blockers (
    blocker_id INT AUTO_INCREMENT PRIMARY KEY,
    teacher_id INT NOT NULL,
    start_time DATETIME NOT NULL,
    end_time DATETIME NOT NULL,
    note TEXT,
    recurring BOOLEAN DEFAULT FALSE,
    FOREIGN KEY (teacher_id) REFERENCES teachers(teacher_id) ON DELETE CASCADE
);

-- content_blocks Table
CREATE TABLE content_blocks (
    id INT AUTO_INCREMENT PRIMARY KEY,
    parent VARCHAR(128) NOT NULL,
    slug VARCHAR(128) NOT NULL,
    label VARCHAR(255) NOT NULL,
    description VARCHAR(255) NOT NULL,
    type VARCHAR(32) NOT NULL,
    value TEXT DEFAULT NULL,
    previous_value TEXT DEFAULT NULL,
    modified TIMESTAMP NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
);


INSERT INTO `content_blocks` (`id`, `parent`, `slug`, `label`, `description`, `type`, `value`, `previous_value`, `modified`) VALUES
(1, 'global', 'website-title', 'Website Title', 'Shown on the home page, as well as any tabs in the user\'s browser.', 'text', 'TuneCraft Studio', 'TuneCraft Studio1', '2024-04-08 04:24:12'),
(2, 'footer', 'address', 'Address', 'Footer Address', 'html', '<strong>Melbourne,</strong> 3000 <br>\r\n', NULL, '2024-04-21 21:40:21'),
(3, 'footer', 'contact', 'Contact', 'Footer Contact Information', 'html', '<strong>Phone:</strong> (03) 5550 7010<br>\r\n<strong>Email:</strong> contact@tunecraft.com.au<br>\r\n\r\n', NULL, '2024-04-21 21:23:48'),
(4, 'footer', 'open-hours', 'Open Hours', 'Footer Open Hours', 'html', '<strong>Mon-Sat:</strong> 10am - 6pm<br>\r\nSunday: Closed\r\n', NULL, '2024-04-21 21:40:08'),
(5, 'about', 'about-heading-1', 'About Heading 1', 'Heading for the About page.', 'text', 'Hello, I\'m Afrooz Amini', NULL, '2024-03-24 22:43:47'),
(6, 'about', 'about-text-1', 'About Text 1', 'Text content for the About page.', 'text', '\r\n                    Your violin instructor here at Tunecraftstudio. \r\n                    8 Years of teaching experience.\r\n                    Specialized in the Suzuki teaching approach and AMEB violin exam syllabus.\r\n                    I assure to provide a comprehensive learning experience for my students \r\n                    on their musical journey here at Tunecraftstudio.\r\n                ', NULL, '2024-03-24 22:43:47'),
(7, 'about', 'about-heading-image', 'About Heading Image', 'Image for the about us heading section', 'image', '/content-blocks/uploads/about-heading-image.cedeafbdb82995678344e3285f68f601.jpg', '/content-blocks/uploads/about-image-1.96ebb0596674f2748333dd6900199a01.jpg', '2024-04-08 03:40:27'),
(8, 'about', 'about-heading-2', 'About Heading Learn More', 'Heading for the \'My Work\' section on the About page.', 'text', 'My Work', NULL, '2024-03-24 22:43:47'),
(9, 'about', 'about-learn-more-image', 'about-learn-more-image', 'Learn More About Us Image', 'image', '/content-blocks/uploads/about-learn-more-image.933676a0245c9fd53a628a520ce586a3.jpg', NULL, '2024-04-28 20:08:20'),
(10, 'about', 'about-text-2', 'About Text 2', 'Text content for the \'My Work\' section on the About page.', 'text', '\r\n                    My teaching approach emphasizes personalized attention and tailored instruction, ensuring each student\r\n                    receives the support they need to thrive in a nurturing and inspiring learning environment. Specializing\r\n                    in Suzuki methodology, I adapt my teaching to suit individual student needs, offering both traditional\r\n                    violin lessons and comprehensive preparation for the AMEB examination in Australia, ensuring a\r\n                    well-rounded musical education for aspiring violinists.\r\n                ', NULL, '2024-03-24 22:43:47'),
(11, 'about', 'about-heading-3', 'About Heading Testimonials', 'Testimonials Heading.', 'text', 'Testimonials', NULL, '2024-03-24 22:43:47'),
(12, 'about', 'about-heading-4', 'About Heading Gallery', 'Gallery Heading.', 'text', 'Our Studio', NULL, '2024-03-24 22:43:47'),
(13, 'pricing', 'pricing-image-1', 'Pricing Image 1', 'Image for the 1st package.', 'image', NULL, NULL, '2024-04-28 19:34:35'),
(14, 'pricing', 'pricing-image-2', 'Pricing Image 2', 'Image for the 2nd package.', 'image', NULL, NULL, '2024-04-28 19:34:35'),
(15, 'pricing', 'pricing-image-3', 'Pricing Image 3', 'Image for the 3rd package.', 'image', NULL, NULL, '2024-04-28 19:34:35'),
(16, 'pricing', 'pricing-image-4', 'Pricing Image 4', 'Image for the 4rd package.', 'image', NULL, NULL, '2024-04-28 19:34:35');

-- content_blocks_phinxlog Table
CREATE TABLE content_blocks_phinxlog (
    version BIGINT(20) NOT NULL,
    migration_name VARCHAR(100) DEFAULT NULL,
    start_time TIMESTAMP NULL DEFAULT NULL,
    end_time TIMESTAMP NULL DEFAULT NULL,
    breakpoint TINYINT(1) NOT NULL DEFAULT 0
);

-- phinxlog Table
CREATE TABLE phinxlog (
    version BIGINT(20) NOT NULL,
    migration_name VARCHAR(100) DEFAULT NULL,
    start_time TIMESTAMP NULL DEFAULT NULL,
    end_time TIMESTAMP NULL DEFAULT NULL,
    breakpoint TINYINT(1) NOT NULL DEFAULT 0
);

-- testimonials Table
CREATE TABLE testimonials (
    testimonial_id INT AUTO_INCREMENT PRIMARY KEY,
    student_name VARCHAR(255) NOT NULL,
    testimonial_title VARCHAR(255) NOT NULL,
    testimonial_text TEXT NOT NULL,
    rating INT NOT NULL,
    image_url VARCHAR(255) NOT NULL,
    created_at TIMESTAMP NOT NULL DEFAULT current_timestamp()
);

INSERT INTO `testimonials` (`testimonial_id`, `student_name`, `testimonial_title`, `testimonial_text`, `rating`, `image_url`, `created_at`) VALUES
(1, 'Student Name', 'Testimonial Title', 'Testimonial Text', 5, '', '2024-04-23 08:14:17'),
(2, 'Michael Smith', 'AMusA Violin', 'The masterclass was intense and rewarding. I improved my skills significantly. Thanks to the instructor!', 5, '', '2024-04-23 08:14:17'),
(3, 'Sophia Williams', 'AMEB Grade 7 Violin', 'The workshop was inspiring. I enjoyed every session and gained new insights into violin technique.', 5, '', '2024-04-23 08:14:17');

-- resources Table
CREATE TABLE resources (
    resource_id INT AUTO_INCREMENT PRIMARY KEY,
    resource VARCHAR(255) NOT NULL,
    heading VARCHAR(255) NOT NULL,
    description TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

INSERT INTO `resources` (`resource_id`, `resource`, `heading`, `description`, `created_at`, `updated_at`) VALUES
(1, 'https://youtu.be/wGu_zQBa2z4', 'What is the suzuki method?', 'What the Suzuki Method is and how it differs from other traditional methods of learning an instrument including (a) proven success over the years (b) early start and parental involvement (c) emphasis on listening first as opposed to reading, (d) technique is naturally developed in the repertoire.', '2024-05-01 06:08:01', '2024-05-01 06:08:01'),
(2, 'https://youtu.be/dYfMQF0-pHU', 'Good beginner songs', 'So let\'s talk about good violin songs for beginners. The way I was started when I was a little girl; I started on the Suzuki method which is a very popular method to begin children on playing the violin.', '2024-05-01 06:08:40', '2024-05-01 06:08:40'),
(3, 'https://youtu.be/JUwGpoXO0tc', 'Open string blues play along', '\'Open String Blues\' refers to a style of playing the blues guitar that emphasises the use of open strings. In this technique, guitarists utilise the strings that are not fretted with the left hand, typically the strings tuned to the tonic chord of the song (commonly E, A, or D in standard tuning).', '2024-05-01 06:09:20', '2024-05-01 06:09:20');
