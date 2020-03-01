var getAppData = response => {
    $.ajax({
        url: dataURL,
        type: 'POST',
        success: (data) => {
            response(data);
        },
        fail: () => {
            response({'success': false});
        }
    });
};
var connectionError = text => {
    $("#loading-cont").addClass("d-none");
    $("#error-cont").append("<div>" + text + "</div>");
}
$(document).ready(function() {
    getAppData(output => {
        var data = output;
        if (data.success) {
            var socket = io(data.socketServer, {query: "token=" + data.token, reconnection: false});
            socket.on('connect_error', () => {
                connectionError("Wystąpił problem z połączeniem. Spróbuj ponownie później");
            })
            socket.on('error', err => {
                connectionError(err);
            })
        }
    });
})