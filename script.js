document.addEventListener('DOMContentLoaded', function() {
  var sideContainer = document.getElementById('sideContainer');
  sideContainer.addEventListener('click', function(event) {
    if (event.target.tagName === 'A') {
      event.preventDefault();
      var id = event.target.getAttribute('data-id');
      addToSession(id);
    }
  });
});

function addToSession(id) {
  var xhr = new XMLHttpRequest();
  xhr.onreadystatechange = function() {
    if (xhr.readyState === XMLHttpRequest.DONE) {
      if (xhr.status === 200) {
        var response = JSON.parse(xhr.responseText);
        // Do something with the response (updated cart)
        console.log(response);
      } else {
        console.error('AJAX request failed');
      }
    }
  };

  xhr.open('POST', 'execute_function.php', true);
  xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
  xhr.send('id=' + id);
}