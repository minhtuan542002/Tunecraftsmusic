<?php
/**
 * Reschedule Lesson HTML email template
 *
 * @var \App\View\AppView $this
 * @var string $first_name email recipient's first name
 * @var string $last_name email recipient's last name
 * @var string $email email recipient's email address
 * @var string $lesson_date date of the rescheduled lesson
 * @var string $lesson_time time of the rescheduled lesson
 */
?>
<div class="content">
    <!-- START CENTERED WHITE CONTAINER -->
    <table role="presentation" class="main">
        <!-- START MAIN CONTENT AREA -->
        <tr>
            <td class="wrapper">
                <table role="presentation" border="0" cellpadding="0" cellspacing="0">
                    <tr>
                        <td>
                            <h3>Rescheduled Lesson Notification</h3>
                            <p>Hi <?= h($first_name) ?>,</p>
                            <p>We hope this email finds you well. We wanted to inform you that your lesson at Tunecrafts Music has been rescheduled.</p>
                            <p>The details of your rescheduled lesson are as follows:</p>
                            <ul>
                                <li><strong>Date:</strong> <?= h($lesson_date) ?></li>
                                <li><strong>Time:</strong> <?= h($lesson_time) ?></li>
                            </ul>
                            <p>If you have any questions or concerns regarding the rescheduled lesson, please don't hesitate to contact us.</p>
                            <p>Thank you for your understanding and cooperation.</p>
                            <p>Best regards,</p>
                            <p>The Tunecrafts Music Team</p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <!-- END MAIN CONTENT AREA -->
    </table>
    <!-- END CENTERED WHITE CONTAINER -->
    <!-- START FOOTER -->
    <div class="footer">
        <table role="presentation" border="0" cellpadding="0" cellspacing="0">
            <tr>
                <td class="content-block">
                    This email is addressed to <?= $first_name ?> <?= $last_name ?> &lt;<?= $email ?>&gt;<br>
                    Please discard this email if it is not meant for you.<br>
                    <br>
                    Copyright &copy; <?= date("Y"); ?> Tunecrafts Music
                </td>
            </tr>
        </table>
    </div>
    <!-- END FOOTER -->
</div>
