var getAppData = response => {
    $.ajax({
        url: dataURL,
        type: 'POST',
        success: response,
        fail: () => {
            response({'success': false});
        }
    });
},
setWindow = (id, state) => {
    let correctClass = ["no_connection", "closed", "opened"],
    dom = $(".window[data-id=" + id + "]");
    for (i in correctClass) {
        dom.removeClass(correctClass[i]);
    }
    dom.addClass(correctClass[state]);
    dom.children("div").addClass("d-none");
    dom.children("div." + correctClass[state]).removeClass("d-none");
},
connectionError = text => {
    $("#loading-cont").addClass("d-none");
    $("#error-cont").append("<div>" + text + "</div>");
};
$(document).ready(function() {
    getAppData(output => {
        var data = output;
        if (data.success) {
            socket = io(data.socketServer, {query: "token=" + data.token, reconnection: false});
            socket.on('connect_error', () => {
                connectionError("Wystąpił problem z połączeniem. Spróbuj ponownie później");
            });
            socket.on('error', err => {
                connectionError(err);
            });
            socket.on('connect', () => {
                var windows = [];
                $(".window").each(function() {
                    windows.push($(this)[0].dataset.id);
                });
                socket.emit('getData', {windows: windows});
                $(".app-loader").removeClass("d-flex").addClass("d-none");
                $(".app").removeClass("d-none");
            });
            socket.on('data', data => {
                console.log(data);
                for (i in data.windows) {
                    setWindow(data.windows[i].id, data.windows[i].state);
                }
            });
        }
    });
    $(".close_window").click(function() {
        if (socket.connected) {
            let windowId = $(this).closest(".window")[0].dataset.id;
            socket.emit('windowControl', {type: 'close', id: windowId});
        }
    });
    $(".open_window").click(function() {
        if (socket.connected) {
            let windowId = $(this).closest(".window")[0].dataset.id;
            socket.emit('windowControl', {type: 'open', id: windowId});
        }
    });
})