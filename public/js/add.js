var loadFieldsStatus = () => {
    $(".changableFields").closest(".form-group").addClass("d-none");
    var data = {
        request: 'getDeviceType',
        data: {
            id: parseInt($("#window_deviceId").val())
        }
    };
    $.ajax({
        url: ajaxURL,
        type: "POST",
        contentType: "application/json",
        data: JSON.stringify(data),
        success: (data) => {
            if (data.success) {
                for (let i = 0; i < data.data.fields.length; i++) {
                    $("#window_" + data.data.fields[i]).val("").closest(".form-group").removeClass("d-none");
                }
            }
        }
    });
}
$(document).ready(function() {
    loadFieldsStatus();
    $(".positionField").prop("disabled", true);
    $("#window_map").change(function() {
        var disabled = $(this).val() === "";
        $(".positionField").prop("disabled", disabled);
    });
    $("#window_deviceId").change(loadFieldsStatus);
})