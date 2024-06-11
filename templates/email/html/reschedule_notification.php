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
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lesson Rescheduled</title>
</head>
<body>
    <div style="margin: 0 auto; max-width: 600px;">
        <h2 style="text-align: center;">Lesson Rescheduled</h2>
        <p>Dear <?= $studentName ?>,</p>

        <p>Your lesson has been successfully rescheduled to the following date and time:</p>
        <p><strong>New Lesson Date and Time:</strong> <?= $newLessonDateTime ?></p>
        <p><strong>Lesson Duration:</strong> <?= $lessonDuration ?> minutes</p>
        <p><strong>Teacher:</strong> <?= $teacherName ?></p>
        <p><strong>Booking ID:</strong> <?= $bookingId ?></p>
        <p><strong>Booking Package:</strong> <?= $bookingPackage ?></p>
        <p><strong>Booking Payment Status:</strong> <?= $bookingPaymentStatus ?></p>

        <p style="text-align: center; margin-top: 30px;">This email is addressed to <?= $studentName ?>. Please discard this email if it is not meant for you.</p>

        <hr style="margin-top: 30px;">

        <p style="text-align: center;">Copyright &copy; <?= date("Y"); ?> Tunecrafts Music</p>
    </div>
</body>
</html>
