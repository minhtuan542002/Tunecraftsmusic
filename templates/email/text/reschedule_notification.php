<?php
/**
 * @var string $studentName Student's name
 * @var string $newLessonDateTime New lesson date and time
 * @var int $lessonDuration Lesson duration in minutes
 * @var string $teacherName Teacher's full name
 * @var int $bookingId Booking ID
 * @var string $bookingPackage Booking package name
 * @var string $bookingPaymentStatus Booking payment status
 */

header('Content-Type: text/plain; charset=UTF-8');
?>
Lesson Rescheduled
==========

Dear <?= $studentName ?>,

Your lesson has been successfully rescheduled to the following date and time:

New Lesson Date and Time: <?= $newLessonDateTime ?>

Lesson Duration: <?= $lessonDuration ?> minutes

Teacher: <?= $teacherName ?>

Booking ID: <?= $bookingId ?>

Booking Package: <?= $bookingPackage ?>

Booking Payment Status: <?= $bookingPaymentStatus ?>


==========
This email is addressed to <?= $studentName ?>.
Please discard this email if it is not meant for you.

Thank you.
