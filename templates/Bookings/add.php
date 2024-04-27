<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Booking $booking
 * @var \Cake\Collection\CollectionInterface|string[] $students
 */
$this->Form->setTemplates(['FormTemplates'=>'Default']);

?>
<?= $this->Html->script('process-steps.js') ?>
<section id="book-a-lesson" class="book-a-lesson section-bg">
    <div class="container" data-aos="fade-up">

        <div class="section-header">
            <h2>Book A Lesson</h2>
            <p>Book <span>Your Lesson</span> With Us</p>
        </div>

        <div class="row g-0">
            <div class="stepwizard col-md-offset-3">
                <div class="stepwizard-row setup-panel">
                    <div class="stepwizard-step">
                        <a href="#step-1" type="button" class="btn btn-primary btn-circle">1</a>
                        <p>Choose your Packages</p>
                    </div>
                    <div class="stepwizard-step">
                        <a href="#step-2" type="button" class="btn btn-default btn-circle" disabled="disabled">2</a>
                        <p>Schedule </p>
                    </div>
                    <div class="stepwizard-step">
                        <a href="#step-3" type="button" class="btn btn-default btn-circle" disabled="disabled">3</a>
                        <p>Confirm your account</p>
                    </div>
                    <div class="stepwizard-step">
                        <a href="#step-4" type="button" class="btn btn-default btn-circle" disabled="disabled">4</a>
                        <p>Finish your booking</p>
                    </div>
                </div>
            </div>

            <?= $this->Form->create($booking) ?>
            <fieldset>

                <div class="row setup-content" id="step-1">
                    <div class="col-xs-6 col-md-offset-3">
                        <div class="col-md-12">
                            <h3> Step 1</h3>
                            <!----------------------------------------------------------->
                            <div class="Packages index content">
                                <h3><?= __('Packages') ?></h3>
                                <div class="table-responsive-sm">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th><?= $this->Paginator->sort('package_name', 'Package') ?></th>
                                                <th><?= $this->Paginator->sort('description') ?></th>
                                                <th><?= $this->Paginator->sort('cost', 'Cost (AUD)') ?></th>
                                                <th><?= $this->Paginator->sort('number_of_lessons', 'No. Lessons') ?></th>
                                                <th><?= $this->Paginator->sort('lesson_duration_minutes', 'Lesson Duration') ?></th>
                                                <th class="actions"><?= __('Select One') ?></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                //This is to fool cakePHP into accepting package_id as a form field
                                                echo $this->Form->control('package_id', ['options' => $packages, 'empty' => true,
                                                'id'=>'dummy',
                                                'label'=>false,
                                                ]);

                                                foreach ($packages as $package):
                                            ?>
                                            <tr id=<?= "package-line-" . $package->package_id ?> class="">
                                                <td><?= h($package->package_name) ?></td>
                                                <td class="col-sm-6"><?= h($package->description) ?></td>
                                                <td><?= $package->cost_dollars === '0.00' ? 'Free' : ('$' . $package->cost_dollars); ?></td>
                                                <td><?= $package->number_of_lessons === null ? 'Nil' : $this->Number->format($package->number_of_lessons) ?></td>
                                                <td><?= $package->lesson_duration_minutes === null ? 'No duration' : $this->Number->format($package->lesson_duration_minutes) . " Minutes" ?></td>
                                                <td class="actions">
                                                    <?php
                                                        //Actual value of package_id -> the input name will be changed later in the script
                                                        echo $this->Form->checkbox('package_choice.' . $package->package_id, [
                                                            'value' => $package->package_id,
                                                            'class'=>'btn-check',
                                                            'id'=>"btn-check-outlined" . $package->package_id,
                                                            'time-duration'=>$package->lesson_duration_minutes,
                                                            'numberLesson'=>$package->number_of_lessons,
                                                            'cost'=>$package->cost_dollars,
                                                            'package'=>$package->package_name,
                                                            'description'=>$package->description,
                                                            'packageId'=>$package->package_id,
                                                        ]);

                                                    ?>
                                                    <label class= "btn btn-outline-primary" for=<?php echo "btn-check-outlined" . $package->package_id ?>
                                                        id=<?php echo "btn-check-label" . $package->package_id ?>>- Select -</label>
                                                </td>
                                            </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>

                                <div class="d-flex justify-content-end">
                                    <button class="btn btn-primary nextBtn btn-lg pull-right first" type="button">Next</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row setup-content" id="step-2">
                    <div class="col-xs-6 col-md-offset-3">
                        <div class="col-md-12">
                            <h3> Step 2</h3>
                            <h3>Schedule your first lesson</h3>
                            <p>Tell us about your prefered start date</p>
                            <p>(We may contact you to change due to schedule conflicts)</p>
                            <br>
                            <?php
                                echo $this->Form->control('lessons.0.lesson_start_time', [
                                    'label' => [
                                        'text' => 'Your prefered date'
                                    ],
                                    'type' => 'datetime-local',
                                    'required' => "required",
                                    'class'=>'form-control',
                                    'min' => date('Y-m-d', strtotime("+3 days")) . 'T09:00',
                                    'step' => 900,
                                ]);
                                echo $this->Form->control('note', [
                                    'label' => [
                                        'text' => 'Anything you want to tell us?'
                                    ],
                                    'type' => 'textarea',
                                    'rows' => '4',
                                    'class'=>'form-control',
                                ]);
                            ?>
                            <br>
                            <br>
                            <div class="d-flex justify-content-between">
                                <button class="btn btn-primary prevBtn btn-lg pull-left" type="button">Previous</button>
                                <?php if(!$loggedIn && $stage==0): ?>
                                    <?= $this->Form->button(__('Next'), ['class'=>"btn btn-primary nextBtn btn-lg pull-right"]) ?>
                                <?php else : ?>
                                    <button class="btn btn-primary nextBtn btn-lg pull-right" type="button">Next</button>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row setup-content" id="step-3">
                    <div class="col-xs-6 col-md-offset-3">
                        <div class="col-md-12">
                            <h3> Step 3</h3>
                            <?php if($loggedIn): ?>
                                <h3> Confirm your account information</h3>
                                <table class="table table-borderless package-sumary">
                                    <tr>
                                        <th><?= __('First Name:    ') ?></th>
                                        <td><?= h($user->first_name) ?></td>
                                    </tr>
                                    <tr>
                                        <th><?= __('Last Name:    ') ?></th>
                                        <td><?= h($user->last_name) ?></td>
                                    </tr>
                                    <tr>
                                        <th><?= __('Phone:    ') ?></th>
                                        <td><?= h($user->phone) ?></td>
                                    </tr>
                                    <!-- <tr>
                                        <th><?= __('Date Of Birth:    ') ?></th>
                                        <td><?= h($user->date_of_birth) ?></td>
                                    </tr> -->
                                </table>
                            <?php else : ?>
                                <h3> Please log in or sign up to continue</h3>
                                <?= $this->Html->link('Log In', ['controller' => 'Auth', 'action' => 'login'], ['class'=> 'btn btn-primary']); ?>
                                <?= $this->Html->link('Sign up', ['controller' => 'Auth', 'action' => 'register'], ['class'=> 'btn btn-primary']);  ?>

                                <br>
                                <br>
                            <?php endif; ?>
                            <div class="d-flex justify-content-between">
                                <button class="btn btn-primary prevBtn btn-lg pull-left" type="button">Previous</button>
                                <?php if($loggedIn){
                                    echo '<button class="btn btn-primary nextBtn btn-lg pull-right third" type="button">Next</button>';
                                }?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row setup-content" id="step-4">
                    <div class="col-xs-6 col-md-offset-3">
                        <div class="col-md-12">
                            <h3> Step 4</h3>
                            <h3> Complete your booking</h3>
                            <div class="info-quad d-flex justify-content-between">
                                <div>
                                    <h4>Your chosen Packages</h4>
                                    <div class="table">
                                        <table class="table table-borderless package-summary">
                                            <tr>
                                                <th><?= __('Package:    ') ?></th>
                                                <td id="chosen-package"></td>
                                            </tr>
                                            <tr>
                                                <th><?= __('Number of lessons:    ') ?></th>
                                                <td id="chosen-lesson-number"></td>
                                            </tr>
                                            <tr>
                                                <th><?= __('Duration each lesson:    ') ?></th>
                                                <td id="chosen-duration"></td>
                                            </tr>
                                            <tr>
                                                <th><?= __('Your total payment:    ') ?></th>
                                                <td  id="total-cost"></td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                                <a href="#step-1" type="button" class="btn btn-primary btn-circle" onclick="$('div.setup-panel div a').eq(0).trigger('click');" >Edit</a>
                            </div>

                            <br>
                            <br>
                            <div class="info-quad d-flex justify-content-between">
                                <div>
                                    <h4>Your selected date</h4>
                                    <div class="chosen-datetime">

                                    </div>
                                    <h4>Your note to us: </h4>
                                    <p id='your-note'></p>
                                </div>
                                <a href="#step-2" type="button" class="btn btn-primary btn-circle" onclick="$('div.setup-panel div a').eq(1).trigger('click');">Edit</a>
                            </div>

                            <br>
                            <br>
                            <?php if($loggedIn): ?>
                                <div class="info-quad">
                                    <h4> Contact information</h4>
                                    <div class="table-responsive">
                                        <table class="table table-borderless">
                                            <tr>
                                                <th><?= __('First Name:    ') ?></th>
                                                <td><?= h($user->first_name) ?></td>
                                            </tr>
                                            <tr>
                                                <th><?= __('Last Name:    ') ?></th>
                                                <td><?= h($user->last_name) ?></td>
                                            </tr>
                                            <tr>
                                                <th><?= __('Phone:    ') ?></th>
                                                <td><?= h($user->phone) ?></td>
                                            </tr>
                                            <tr>
                                                <th><?= __('Email:    ') ?></th>
                                                <td><?= h($user->email) ?></td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            <?php endif; ?>

                            <br>
                            <br>
                            <div class="info-quad d-flex justify-content-between">
                                <div>
                                    <h4>How to pay:</h4>
                                    <p>Payments will be handled in studio at your first class</p>
                                </div>
                            </div>
                            <div class="d-flex justify-content-between">
                                <button class="btn btn-primary prevBtn btn-lg pull-left" type="button" style='margin-top: 10px'>Previous</button>

                                <?= $this->Form->button(__('Submit'), ['class'=>"btn btn-success btn-lg pull-right", 'style'=>'margin-top: 10px']) ?>
                            </div>
                        </div>
                    </div>
                </div>
            </fieldset>
            <?= $this->Form->end() ?>
        </div><!-- End Reservation Form -->
    </div>
</section><!-- End Book A Table Section -->

<style>
.stepwizard-step button {
    background-color: white;
}
.stepwizard-step p {
    margin-top: 10px;
}
.stepwizard-row {
    display: table-row;
}
.stepwizard {
    display: table;
    width: 100%;
    position: relative;
}
.stepwizard-step .btn[disabled] {
    opacity: 1 !important;
    filter: alpha(opacity=100) !important;
    --bs-btn-bg: #e0e0e0;
}
.stepwizard-row:before {
    top: 25px;
    bottom: 0;
    position: absolute;
    content: " ";
    width: 100%;
    height: 1px;
    background-color: #ccc;
    z-order: 0;
}
.stepwizard-step {
    display: table-cell;
    text-align: center;
    position: relative;
}
.btn-circle {
    width: 50px;
    height: 50px;
    text-align: center;
    padding: 10px 0;
    font-size: 20px;
    line-height: 1.428571429;
    border-radius: 25px;
}
.has-error input{
   border-width: 3px;
   border-color: red !important;
}
.has-error input:after{
   content:"Please add a valid date";
   color: red;
}

h4.error-message{
    color: red;
}
.btn-default {
    --bs-btn-bg: white;
}

.info-quad {
    padding: 12px;
    border-radius: 10px;
    border-width: thin;
    border-style: solid;
    border-color: black;
}

tbody tr.highlight td {
    background-color: #c5eafa;
}

.table-borderless tr td, .table-borderless tr th{
    background-color: #eee;
}

.actions {
    min-width: 110px;
}
</style>

<?php if($stage==2): ?>
    <script>
        $(document).ready(function () {
            $('#btn-check-outlined<?= $booking->package_id ?>').attr( 'checked', true );
            $('#btn-check-label<?= $booking->package_id ?>').text( "Selected");
            $('#btn-check-outlined<?= $booking->package_id ?>').attr("name","package_id");
            $("#package-line-<?= $booking->package_id ?>").addClass("highlight")
            $('#lessons-0-lesson-start-time').attr('value', '<?= $booking->booking_datetime->format("Y-m-d\TH:i:s")?>');
            $('#note').attr('value', '<?= $booking->note?>');
            //$('.stepwizard-row.setup-panel').attr('stage', '3');
            $('.nextBtn').eq(0).trigger('click');
            $('.nextBtn').eq(1).trigger('click');

        });
    </script>
<?php endif; ?>
<script>
    $(document).ready(function () {
        $('#dummy').hide();
        $('#step-1').trigger('click');
        $('select option:eq(1)').attr('selected', 'selected');
        $('input.btn-check').click(function(){
            var checkbox= $("input.btn-check");
            for(var i=0; i<checkbox.length; i++){
                if (checkbox.eq(i).is(':checked') && checkbox.eq(i).attr('id') != $(this).attr('id')) {
                    $('#btn-check-label'+checkbox.eq(i).attr("packageId")).text( "- Select -");
                    checkbox.eq(i).attr("name","package_choice["+ checkbox.eq(i).attr("packageId") +"]");
                    $("#package-line-"+checkbox.eq(i).attr("packageId")).removeClass("highlight")
                    checkbox.eq(i).attr( 'checked', false );
                    //console.log(i);
                }
                if (checkbox.eq(i).is(':checked'))console.log(i);
            }
            if($(this).is(':checked')){
                $('#btn-check-label'+$(this).attr("packageId")).text("Selected");
                $(this).attr("name","package_id");
                $("#package-line-"+$(this).attr("packageId")).addClass("highlight")
                //console.log("D");
            }
            else{
                $('#btn-check-label'+$(this).attr("packageId")).text("- Select -");
                $(this).attr("name","package_choice["+ $(this).attr("packageId") +"]");
                $("#package-line-"+$(this).attr("packageId")).removeClass("highlight")
            }
        });
    });
</script>
<?= $this->Html->script('process-steps.js') ?>
