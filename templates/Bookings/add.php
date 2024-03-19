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

        <legend><?= __('Add Booking') ?></legend>
            <div class="stepwizard col-md-offset-3">
                <div class="stepwizard-row setup-panel">
                    <div class="stepwizard-step">
                        <a href="#step-1" type="button" class="btn btn-primary btn-circle">1</a>
                        <p>Choose your Packages</p>
                    </div>
                    <div class="stepwizard-step">
                        <a href="#step-2" type="button" class="btn btn-default btn-circle" disabled="disabled">2</a>
                        <p>Schedule an appointment</p>
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
                
                <?php
                    //echo $this->Form->control('customer_id', ['options' => $students]);
                    //echo $this->Form->control('booking_line.service_id', ['options' => $packages]);
                    //echo $this->Form->control('service_completed');
                ?>
            
                <div class="row setup-content" id="step-1">
                <div class="col-xs-6 col-md-offset-3">
                    <div class="col-md-12">
                    <h3> Step 1</h3>
                     <!----------------------------------------------------------->
                    <div class="Packages index content">
                    <h3><?= __('Packages') ?></h3>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th><?= $this->Paginator->sort('id', '#') ?></th>
                                    <th><?= $this->Paginator->sort('package_name', 'Packages') ?></th>
                                    <th><?= $this->Paginator->sort('description') ?></th>
                                    <th><?= $this->Paginator->sort('cost', 'Total Cost') ?></th>
                                    <th><?= $this->Paginator->sort('number_of_lessons', 'Number of Lessons') ?></th>
                                    <th><?= $this->Paginator->sort('lesson_duration_minutes', 'Duration per Lesson') ?></th>
                                    <!--<th><?= $this->Paginator->sort('discount') ?></th>
                                    <th class="actions"><?= __('Actions') ?></th>-->
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($packages as $package): ?>
                                <tr>
                                    <td><?= $this->Number->format($package->id) ?></td>
                                    <td><?= h($package->package_name) ?></td>
                                    <td><?= h($package->description) ?></td>
                                    <td><?= $this->Number->currency($package->cost, 'AUD'); ?></td>
                                    <td><?= $package->number_of_lessons === null ? 'None' : $this->Number->format($package->number_of_lessons) . " lessons" ?></td>
                                    <td><?= $package->lesson_duration_minutes === null ? 'No durations' : $this->Number->format($package->lesson_duration_minutes) . " min" ?></td>
                                    <!--<td><?= $this->Number->format($package->discount) ?></td>-->
                                    <td class="actions">
                                        <?php
                                            echo $this->Form->checkbox('package_id', [
                                                'value' => $package->id, 
                                                'required' => true, 
                                                'class'=>'btn-check', 
                                                'id'=>"btn-check-outlined" . $package->id,
                                                'time-duration'=>$package->lesson_duration_minutes,
                                                'cost'=>$package->cost,
                                                'package'=>$package->package_name,
                                                'description'=>$package->description,
                                                'packageId'=>$package->$package_id,
                                            ]);
                                        ?>
                                        <label class= "btn btn-outline-primary" for=<?php echo "btn-check-outlined" . $package->id ?> id=<?php echo "btn-check-label" . $package->id ?>>Add</label>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="paginator">
                        <?php //echo $this->Paginator->params()['pageCount']; ?>
                        <?php if($this->Paginator->params()['pageCount']>1): ?>
                        <ul class="pagination d-flex justify-content-around">
                            <?= $this->Paginator->first('<< ' . __('first')) ?>
                            <?= $this->Paginator->prev('< ' . __('previous')) ?>
                            <?= $this->Paginator->numbers() ?>
                            <?= $this->Paginator->next(__('next') . ' >') ?>
                            <?= $this->Paginator->last(__('last') . ' >>') ?>
                        </ul>
                        <?php endif; ?>
                        <p><?= $this->Paginator->counter(__('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')) ?></p>
                    </div>
                </div>
                <?php
                //echo $this->Form->control('booking_lines.service_ids', ['type' => 'select', 'multiple' => true,
                //    'options' => $packages,]);
                ?>

                    <!--
                    <div class="form-group">
                        <label class="control-label">First Name</label>
                        <input maxlength="100" type="text" required="required" class="form-control" placeholder="Enter First Name">
                    </div>
                    <div class="form-group">
                        <label class="control-label">Last Name</label>
                        <input maxlength="100" type="text" required="required" class="form-control" placeholder="Enter Last Name">
                    </div>
                    <div class="form-group">
                        <label class="control-label">Address</label>
                        <textarea required="required" class="form-control" placeholder="Enter your address"></textarea>
                    </div>
                    -->
                    <button class="btn btn-primary nextBtn btn-lg pull-right first" type="button">Next</button>
                    </div>
                </div>
                </div>
                <div class="row setup-content" id="step-2">
                    <div class="col-xs-6 col-md-offset-3">
                        <div class="col-md-12">
                        <h3> Step 2</h3>
                        <h3>Schedule your first lesson</h3>
                        <p>Tell us about your prefered start date (We may contact you to change due to schedule conflicts)</p> 
                        <br>
                        <?php
                            echo $this->Form->control('booking.lesson.1.lesson_start_time', [
                                'label' => [
                                    'text' => 'Your requirements'
                                ],
                                'required' => "required", 
                                'class'=>'form-control',
                                'min' => date('Y-m-d', strtotime("+3 days")) . 'T09:00',
                                'step'=>'15',
                            ]);
                        ?>
                        <br>
                        <br>
                        <!--
                        <div class="form-group">
                            <label class="control-label">Company Name</label>
                            <input maxlength="200" type="text" required="required" class="form-control" placeholder="Enter Company Name">
                        </div>
                        <div class="form-group">
                            <label class="control-label">Company Address</label>
                            <input maxlength="200" type="text" required="required" class="form-control" placeholder="Enter Company Address">
                        </div>
                        -->
                        <button class="btn btn-primary prevBtn btn-lg pull-left" type="button">Previous</button>
                        <?php if(!$loggedIn && $stage==0): ?>
                            <?= $this->Form->button(__('Next'), ['class'=>"btn btn-primary nextBtn btn-lg pull-right"]) ?>
                        <?php else : ?>
                            <button class="btn btn-primary nextBtn btn-lg pull-right" type="button">Next</button>
                        <?php endif; ?>
                    </div>
                </div>
                </div>
                <div class="row setup-content" id="step-3">
                    <div class="col-xs-6 col-md-offset-3">
                        <div class="col-md-12">
                            <h3> Step 3</h3>
                            <?php if($loggedIn): ?>
                                <h3> Confirm your account information</h3>
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
                                        <th><?= __('Date Of Birth:    ') ?></th>
                                        <td><?= h($user->date_of_birth) ?></td>
                                    </tr>
                                </table>
                            <?php else : ?>
                                <h3> Please log in or sign up to continue</h3>
                                <?= $this->Html->link('Log In', ['controller' => 'Auth', 'action' => 'login'], ['class'=> 'btn btn-primary']); ?>
                                <?= $this->Html->link('Sign up', ['controller' => 'Auth', 'action' => 'register'], ['class'=> 'btn btn-primary']);  ?>
                                
                                <br>
                                <br>
                            <?php endif; ?>
                            <button class="btn btn-primary prevBtn btn-lg pull-left" type="button">Previous</button>
                            <?php if($loggedIn){
                                echo '<button class="btn btn-primary nextBtn btn-lg pull-right third" type="button">Next</button>';
                            }?>
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
                                    <h4>Your choosen Packages</h4>
                                    <div class="service-summary">
                                        
                                    </div>                    
                                    <h5>Your total cost: <b id='total-price'></b></h5>
                                </div>
                                <a href="#step-1" type="button" class="btn btn-primary btn-circle" onclick="$('div.setup-panel div a').eq(0).trigger('click');" >Edit</a>
                            </div>

                            <br>
                            <br>
                            <div class="info-quad d-flex justify-content-between">
                                <div>
                                    <h4>Your selected date</h4>
                                    <div class="choosen-datetime">
                                        
                                    </div>                    
                                    <h5>Expected session time: <b id='total-time'></b></h5>
                                </div>
                                <a href="#step-2" type="button" class="btn btn-primary btn-circle" onclick="$('div.setup-panel div a').eq(1).trigger('click');">Edit</a>
                            </div>

                            <br>
                            <br>
                            <?php if($loggedIn): ?>
                                <div class="info-quad">
                                <h4> Contact information</h4>
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
                            <?php endif; ?>
                            <button class="btn btn-primary prevBtn btn-lg pull-left" type="button" style='margin-top: 10px'>Previous</button>
                                            
                            <?= $this->Form->button(__('Submit'), ['class'=>"btn btn-success btn-lg pull-right", 'style'=>'margin-top: 10px']) ?>
                            
                        </div>
                    </div>
                </div>
            </fieldset>
            <?= $this->Form->end() ?>

        <!-- End Reservation Form -->

    </div>
</section><!-- End Book A Table Section -->

<style>
body {
    margin-top:40px;
}
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
</style>

<?php if($stage==2): ?>
    <script>
        $(document).ready(function () {
            <?php foreach ($booking->booking_lines as $line): ?>
                $('#btn-check-outlined<?= $line->service_id ?>').attr( 'checked', true );
                //console.log( $('#btn-check-outlined<?= $line->service_id ?>').data( 'id' ));
            <?php endforeach; ?>
            $('#start-datetime').attr('value', '<?= $booking->start_datetime->format("Y-m-d\TH:i:s")?>');
            //$('.stepwizard-row.setup-panel').attr('stage', '3');
            $('.nextBtn').eq(0).trigger('click');
            $('.nextBtn').eq(1).trigger('click');

        });
    </script>
<?php endif; ?>
<script>
    $(document).ready(function () {
        $('input.btn-check').click(function(){
            if($(this).is(':checked')){
                $('#btn-check-label'+$(this).attr("serviceId")).text( "Added");
            }
            else{
                $('#btn-check-label'+$(this).attr("serviceId")).text( "Add");
            }
            var checkbox= $("input.btn-check");
            for(var i=0; i<checkbox.length; i++){
                if (checkbox.eq(i).is(':checked') && checkbox.eq(i).attr('id') != $(this).attr('id')) {
                    $('#btn-check-label'+checkbox.eq(i).attr("serviceId")).text( "Add");
                    
                }
                
            }
            $(this).attr( 'checked', true )
        });

        var checkbox= $("input.btn-check");
        for(var i=0; i<checkbox.length; i++){
            if (checkbox.eq(i).is(':checked')) {
                $('#btn-check-label'+checkbox.eq(i).attr("serviceId")).text( "Added");
                //console.log(i);
            }
            
        }
    });
</script>
<?= $this->Html->script('process-steps.js') ?>