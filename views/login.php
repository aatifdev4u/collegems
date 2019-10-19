<?php include("inc/header.php"); ?>
<div class="container">
    <?php echo form_open("welcome/signIn", ['class'=> 'form-horizontal']);?>
    <?php if($msg = $this->session->flashdata('message')): ?>
        <div class="row">
            <div class="col-md-6">
                <div class="alert alert-dismissible alert-success">
                    <?php echo $msg; ?>
                </div>
            </div>
        </div>
    <?php endif; ?>
    <h2>ADMIN LOGIN</h2>
    <hr>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="" class="col-md-3 control-label">Email</label>
                <div class="col-md-9">
                    <?php echo form_input(['name' => 'email', 'class' => 'form-control', 'placeholder' => 'Email', 'value' => set_value('email')]); ?>
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
                <label for="" class="col-md-3 control-label">Password</label>
                <div class="col-md-9">
                    <?php echo form_password(['name' => 'password', 'class' => 'form-control', 'placeholder' => 'Password']); ?>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <?php echo form_error('password', '<div class="text-danger">','</div>');?>
        </div>
    </div>
    <button type="submit" class="btn btn-primary ">LOGIN</button>
    <?php  echo anchor("welcome", "BACK", ['class' => 'btn btn-primary']);?>
    <?php echo form_close(); ?>
</div>
<?php include("inc/footer.php"); ?>