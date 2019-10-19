<?php include("inc/header.php"); ?>
<div class="container">
    <h2>College Student DASHBOARD</h2>
    <?php echo anchor("admin/dashboard", "BACK", ['class' => 'btn btn-primary'] ); ?>
    <hr>

    <div class="row">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">Student Name</th>
                    <th scope="col">College Name</th>
                    <th scope="col">Course</th>
                    <th scope="col">EMail</th>
                    <th scope="col">Gender</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php if(count($students)): ?>
                <?php foreach($students as $student): ?>
                <tr class="table-active">
                    <td><?php echo $student->studentname; ?></td>
                    <td><?php echo $student->collegename; ?></td>
                    <td><?php echo $student->course; ?></td>
                    <td><?php echo $student->email; ?></td>
                    <td><?php echo $student->gender; ?></td>
                    <td>
                        <?php echo anchor("admin/editStudent/{$student->id}", 'Edit Student', ['class' => 'buttons']);?>
                        <?php echo anchor("admin/deleteStudent/{$student->id}", 'Delete Student', ['class' => 'buttons']);?>
                    </td>
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