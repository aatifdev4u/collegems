<?php include("inc/header.php"); ?>
<?php 
// echo '<pre>';
//         print_r($studentData);
//         echo '</pre>';
//         exit();
?>
<div class="container">
    <?php echo form_open("admin/modifyStudent/{$studentData->id}", ['class'=> 'form-horizontal']);?>
    <?php if($msg = $this->session->flashdata('message')): ?>
        <div class="row">
            <div class="col-md-6">
                <div class="alert alert-dismissible alert-success">
                    <?php echo $msg; ?>
                </div>
            </div>
        </div>
    <?php endif; ?>
    <h2>EDIT STUDENT</h2>
    <hr>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="" class="col-md-3 control-label">Student Name</label>
                <div class="col-md-9">
                    <?php echo form_input(['name' => 'studentname', 'class' => 'form-control', 
                    'placeholder' => 'Student Name', 
                    'value' => set_value('studentname', $studentData->studentname)]); ?>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <?php echo form_error('studentname', '<div class="text-danger">','</div>');?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="" class="col-md-3 control-label">College</label>
                <select class="col-lg-9" name="college_id">
                <?php if(count($colleges)): ?>
                    <option value="<?php echo $studentData->college_id;?>"><?php echo $studentData->collegename;?></option>
                    <?php foreach($colleges as $college):?>
                        <option value=<?php echo $college->college_id; ?>><?php echo $college->collegename; ?></option>
                    <?php endforeach;?>
                <?php endif;?>
                </select>
            </div>
        </div>
        <div class="col-md-6">
            <?php echo form_error('college_id', '<div class="text-danger">','</div>');?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="" class="col-md-3 control-label">Email</label>
                <div class="col-md-9">
                    <?php echo form_input(['name' => 'email', 'class' => 'form-control', 'placeholder' => 'Email', 'value' => set_value('email', $studentData->email)]); ?>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <?php echo form_error('email', '<div class="text-danger">','</div>');?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="" class="col-md-3 control-label">Gender</label>
                <select class="col-lg-9" name="gender">
                    <option value="<?php echo $studentData->gender;?>"><?php echo $studentData->gender;?></option>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                </select>
            </div>
        </div>
        <div class="col-md-6">
            <?php echo form_error('gender', '<div class="text-danger">','</div>');?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="" class="col-md-3 control-label">Course</label>
                <div class="col-md-9">
                    <?php echo form_input(['name' => 'course', 'class' => 'form-control', 'placeholder' => 'Course', 'value' => set_value('course', $studentData->course)]); ?>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <?php echo form_error('course', '<div class="text-danger">','</div>');?>
        </div>
    </div>
    
    <button type="submit" class="btn btn-primary ">UPDATE</button>
    <?php  echo anchor("admin/dashboard", "BACK", ['class' => 'btn btn-primary']);?>
    <?php echo form_close(); ?>
</div>
<?php include("inc/footer.php"); ?>