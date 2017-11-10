/**
 * Created by mostafa on 04/02/2017.
 */
var view_map;
var edit_map;
var init_pos = new google.maps.LatLng(30.0444, 31.2357);

/**
 * Create View Modal Map
 */
function initViewMap() {
    view_map = new google.maps.Map(document.getElementById('view_map'), {
        zoom: 18,
        center: init_pos
    });
    view_marker = new google.maps.Marker({
        map: view_map
    });
}
/**
 * Lazy load google map
 * Fix Modal Map Issues
 */
google.maps.event.addDomListener(window, 'load', initViewMap);
google.maps.event.addDomListener(window, "resize", resizingViewMap());
$('#viewEmployeeDataModal').on('shown.bs.modal', function () {
    resizeViewMap();
});
function resizeViewMap() {
    if (typeof view_map == "undefined") return;
    setTimeout(function () {
        resizingViewMap();
    }, 400);
}

function resizingViewMap() {
    if (typeof view_map == "undefined") return;
    var center = view_map.getCenter();
    google.maps.event.trigger(view_map, "resize");
    view_map.setCenter(center);
}

function updateViewMapLoc(lat, lang) {
    var pos = new google.maps.LatLng(parseFloat(lat), parseFloat(lang));
    view_map.setCenter(pos);
    view_marker.setPosition(pos);

}

/**
 * Create Edit Modal Map
 */
function initEditMap() {
    edit_geocoder = new google.maps.Geocoder();
    edit_map = new google.maps.Map(document.getElementById('edit_map'), {
        zoom: 18,
        center: init_pos
    });
    edit_marker = new google.maps.Marker({
        map: edit_map
    });
    edit_marker.bindTo('position', edit_map, 'center');

    google.maps.event.addListener(edit_map, 'dragend', function () {
        geocodePosition(edit_marker.getPosition());
    });
}
function geocodePosition(pos) {
    edit_geocoder.geocode({
        latLng: pos
    }, function (responses) {
        if (responses && responses.length > 0) {
            updateMarkerAddress(responses[0].formatted_address, pos.lat(), pos.lng());
        } else {
            updateMarkerAddress('Cannot determine address at this location.');
        }
    });
}
function updateMarkerAddress(full_address, lat, lng) {
    $('#editEmployeeDataModal').find('#inputEmpAddress').val(full_address);
    $('#editEmployeeDataModal').find('#inputEmpLat').val(lat);
    $('#editEmployeeDataModal').find('#inputEmpLng').val(lng);
}
/**
 * Lazy load google map
 * Fix Modal Map Issues
 */
google.maps.event.addDomListener(window, 'load', initEditMap);
google.maps.event.addDomListener(window, "resize", resizingEditMap());
$('#editEmployeeDataModal').on('shown.bs.modal', function () {
    resizeEditMap();
});
function resizeEditMap() {
    if (typeof edit_map == "undefined") return;
    setTimeout(function () {
        resizingEditMap();
    }, 400);
}

function resizingEditMap() {
    if (typeof edit_map == "undefined") return;
    var center = edit_map.getCenter();
    google.maps.event.trigger(edit_map, "resize");
    edit_map.setCenter(center);
}

function updateEditMapLoc(lat, lang) {
    var pos = new google.maps.LatLng(parseFloat(lat), parseFloat(lang));
    edit_map.setCenter(pos);
    edit_marker.setPosition(pos);

}

var current_employee = null;
/**
 * @param employee_id
 * Get Employee data if it is not binded in current_employee object
 * limit server request for Employee data
 */
function bindCurrentEmployeeData(employee_id) {
    if (employee_id && (current_employee == null || employee_id != current_employee.id)) {
        $.ajax({
            url: $('#getEmployeeDataUrl').val() + employee_id,
        }).done(function (employee_data) {
            if (employee_data != 'false') {
                current_employee = jQuery.parseJSON(employee_data);
                updateViewEmployeeModal();
                updateEditEmployeeModal();
            }
        });
    } else {
        updateViewEmployeeModal();
        updateEditEmployeeModal();
    }
}
/**
 * update View Modal Content
 */
function updateViewEmployeeModal() {
    var image_url = $('#baseUrl').val();
    $('#viewEmployeeDataModal').find('.emp_name').html(current_employee.name);
    $('#viewEmployeeDataModal').find('.emp_address').html(current_employee.address);

    if (current_employee.image && current_employee.image != null) {
        $('#viewEmployeeDataModal').find('.emp_image').attr('src', (image_url + current_employee.image));
    }
    updateViewMapLoc(current_employee.lat, current_employee.lng);
}
/**
 * update Edit Modal inputs
 */
function updateEditEmployeeModal() {
    var image_url = $('#baseUrl').val();
    $('#editEmployeeDataModal').find('#inputEmpName').val(current_employee.name);
    $('#editEmployeeDataModal').find('#inputEmpAddress').val(current_employee.address);
    $('#editEmployeeDataModal').find('#inputEmpLat').val(current_employee.lat);
    $('#editEmployeeDataModal').find('#inputEmpLng').val(current_employee.lng);
    if (current_employee.image && current_employee.image != null) {
        $('#editEmployeeDataModal').find('.emp_image').attr('src', (image_url + current_employee.image));
    }
    updateEditMapLoc(current_employee.lat, current_employee.lng);
}
/**
 * update Employee Tr Content
 */
function updateEmployeeTr(id) {
    var image_url = $('#baseUrl').val();
    $('#employee_tr_' + id).find('.emp_name_td').html(current_employee.name);
    $('#employee_tr_' + id).find('.emp_address_td').html(current_employee.address);
    if (current_employee.image && current_employee.image != null) {
        $('#employee_tr_' + id).find('.emp_image_td img').attr('src', (image_url + current_employee.image));
    }
}
$(function () {
    var emp_id = '';
    $(".view_employee_data").click(function () {
        $('#viewEmployeeDataModal').modal('show');
        bindCurrentEmployeeData($(this).data('emp-id'));
    });

    $(".edit_employee_data").click(function () {
        $('#editEmployeeDataModal').modal('show');
        emp_id = $(this).data('emp-id');
        bindCurrentEmployeeData($(this).data('emp-id'));
    });

    $("#editEmployeeForm").submit(function (e) {
        e.preventDefault();
        var formData = new FormData($(this)[0]);
        $.ajax({
            url: $('#editEmployeeForm').attr('action') + '/' + emp_id,
            method: "POST",
            data: formData,
            contentType: false,
            processData: false,

        }).done(function (employee_data) {
            if (employee_data != 'false') {
                current_employee = jQuery.parseJSON(employee_data);
                updateEditEmployeeModal();
                updateEmployeeTr(current_employee.id);
                $('#editEmployeeDataModal').modal('hide');
            }
        });
    });
});