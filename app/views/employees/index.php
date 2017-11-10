<div class="row">
    <div class="col-lg-12">
        <h3>Employees</h3>
        <a href="<?= URL ?>public/employees/createEmployee" class="btn btn-default">Create Employee</a>

        <div class="table-responsive">
            <table id="employeeList" class="table table-bordered">
                <thead>
                <tr>
                    <th>
                        #
                    </th>
                    <th>
                        Image
                    </th>
                    <th>
                        Name
                    </th>
                    <th>
                        Address
                    </th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($data['employees'] as $key => $employee) : ?>
                    <tr id="employee_tr_<?= $employee['id'] ?>">
                        <td><?= $key + 1 ?></td>
                        <?php if (empty($employee['image'])) {
                            $employee['image'] = URL . "public/img/noimage.png";
                        } ?>
                        <td class="emp_image_td"><img src="<?= URL . $employee['image'] ?>"></td>
                        <td class="emp_name_td"><?= $employee['name'] ?></td>
                        <td class="emp_address_td"><?= $employee['address'] ?></td>
                        <td>
                            <a class="action_btn view_employee_data" href="#"
                               data-emp-id="<?= $employee['id'] ?>">View</a>
                            <a class="action_btn edit_employee_data" href="#"
                               data-emp-id="<?= $employee['id'] ?>">Edit</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
    <input type="hidden" id="getEmployeeDataUrl" value="<?php echo URL ?>public/employees/getEmployeeData/"/>
    <input type="hidden" id="baseUrl" value="<?php echo URL ?>"/>

    <div class="modal fade" id="viewEmployeeDataModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">View Employee</h4>
                </div>
                <div class="modal-body">
                    <div>
                        <p class="">Name</p>

                        <p class="data emp_name"></p>
                    </div>
                    <div>
                        <p class="">Address</p>

                        <p class="data emp_address"></p>

                        <div class="map" id="view_map"></div>
                    </div>
                    <p class="label">Image</p>
                    <img src="<?= URL ?>public/img/noimage.png" class="data emp_image">
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="editEmployeeDataModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Edit Employee</h4>
                </div>
                <div class="modal-body">
                    <form id="editEmployeeForm" method="post" action="<?= URL ?>public/employees/editEmployeeData"
                          enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="inputEmpName">Name</label>
                            <input type="text" name="name" class="form-control" id="inputEmpName" placeholder="Name">
                        </div>
                        <div class="form-group">
                            <label for="inputEmpAddress">Address</label>
                            <input type="text" name="address" class="form-control" id="inputEmpAddress"
                                   placeholder="Address">
                            <input type="hidden" name='lat' id="inputEmpLat">
                            <input type="hidden" name='lng' id="inputEmpLng">

                            <div class="map" id="edit_map"></div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmpImage">Image</label>
                            <input type="file" id="inputEmpImage" name="image">

                            <p id="message"></p>

                            <div id="image_preview">
                                <img id="previewing" class="emp_image" src="<?= URL ?>public/img/noimage.png"/>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-default">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCeiqAUR-GUSmxG7bx0d8lUQCtSYTdyEnY">
</script>
<script src="<?php echo URL; ?>/public/js/employees/list.js"></script>

