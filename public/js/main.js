/**
 * Created by mostafa on 04/02/2017.
 */
$(function () {
    /**
     * Validate image and preview it
     */
    $("#inputEmpImage").change(function () {
        $("#message").empty(); // To remove the previous error message
        var file = this.files[0];
        var match = ["image/jpeg", "image/png", "image/jpg"];
        if (jQuery.inArray(file.type, match) == -1 || file.size >= 1000000) {
            $("#message").html("<p id='error'>Please Select A valid Image File</p>" + "<span id='error_message'>Only jpeg, jpg and png Images type allowed Max size is 1MB</span>");
            return false;
        }
        else {
            var reader = new FileReader();
            reader.onload = imageIsLoaded;
            reader.readAsDataURL(this.files[0]);
        }
    });
    function imageIsLoaded(e) {
        $('#image_preview').css("display", "block");
        $('#previewing').attr('src', e.target.result);
    }
});