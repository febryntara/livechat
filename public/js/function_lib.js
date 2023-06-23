function getCurrentTime() {
    var currentTime = new Date();
    var hours = currentTime.getHours();
    var minutes = currentTime.getMinutes();

    // Tambahkan leading zero jika jam atau menit kurang dari 10
    if (hours < 10) {
        hours = "0" + hours;
    }
    if (minutes < 10) {
        minutes = "0" + minutes;
    }

    var formattedTime = hours + ":" + minutes;
    return formattedTime;
}

function ajaxWrapper(
    url,
    method,
    data,
    successCallback,
    beforeSendCallback,
    errorCallback
) {
    // Inisialisasi objek XMLHttpRequest
    var xhr = new XMLHttpRequest();

    // Atur callback untuk menerima respon dari server
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4) {
            if (xhr.status === 200) {
                successCallback(xhr.responseText);
            } else {
                errorCallback(xhr.statusText);
            }
        }
    };

    // Buat request dengan method yang ditentukan
    xhr.open(method, url, true);

    // Set header untuk request
    xhr.setRequestHeader("X-Requested-With", "XMLHttpRequest");
    xhr.setRequestHeader("Content-Type", "application/json; charset=UTF-8");

    // Jalankan fungsi beforeSendCallback
    if (beforeSendCallback) {
        xhr.beforeSend = beforeSendCallback();
    }

    // Kirim data dengan method POST
    if (method.toLowerCase() === "post") {
        xhr.send(JSON.stringify(data));
    } else {
        xhr.send();
    }
}

function scrollToBottom(element_id) {
    var chatArea = document.getElementById(element_id);
    chatArea.scrollTop = chatArea.scrollHeight;
}
