<div class="row">
    <div class="col-md-12">
        <h3>Create Employee</h3>
        <div class="col-md-12">
            <form id="createEmployeeForm" method="post" action="<?= URL ?>public/employees/createEmployeeSave" enctype="multipart/form-data">
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

                    <div class="map" id="create_map"></div>
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
<script
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCeiqAUR-GUSmxG7bx0d8lUQCtSYTdyEnY">
</script>
<script src="<?php echo URL; ?>/public/js/employees/create.js"></script>
