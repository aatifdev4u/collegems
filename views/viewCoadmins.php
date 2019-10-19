<?php include("inc/header.php"); ?>
<div class="container">
    <h2>CO ADMIN DASHBOARD</h2>
    <?php $username = $this->session->userdata('username'); ?>
    <h3>Welcome <?php echo $username; ?></h3>
    <hr>

    <div class="row">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Collge Name</th>
                    <th scope="col">User Name</th>
                    <th scope="col">EMail</th>
                    <th scope="col">Gender</th>
                    <th scope="col">Branch</th>
                </tr>
            </thead>
            <tbody>
                <?php if(count($coadmins)): ?>
                <?php foreach($coadmins as $coadmin): ?>
                <tr class="table-active">
                    <td><?php echo $coadmin->user_id; ?></td>
                    <td><?php echo $coadmin->collegename; ?></td>
                    <td><?php echo $coadmin->username; ?></td>
                    <td><?php echo $coadmin->email; ?></td>
                    <td><?php echo $coadmin->gender; ?></td>
                    <td><?php echo $coadmin->branch; ?></td>
                </tr>
                <?php endforeach; ?>
                <?php else: ?>
                    <tr><td>No Records Found</td></tr>
            <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
<?php include("inc/footer.php"); ?>