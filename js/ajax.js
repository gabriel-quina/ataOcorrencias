"use strict";

document.getElementById("ajaxBtn").addEventListener("click", showData);

function ajax(method, url, callback, data) {
  let xhr = new XMLHttpRequest();
  xhr.open(method, url, true);
  xhr.setRequestHeader('content-type', 'application/x-www-form-urlencoded');

  xhr.onreadystatechange = function () {
    let done = 4;
    let ok = 200;
    if (xhr.readyState === done && xhr.status === ok) {
      callback(xhr.responseText);
      document.querySelector("body").innerHTML = 'Success: ' + xhr.responseText; // 'This is the returned text.'
    } else {
      console.log('Error: ' + xhr.status); // 'An error occurred during the request.
    }
  }

  xhr.send(data);
}

function showData() {
  let url = '/index.php';

  ajax('GET', url, function (res) {
    document.getElementsByName("body").innerHTML = res;
  });

}