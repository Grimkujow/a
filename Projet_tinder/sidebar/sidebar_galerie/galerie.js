document.getElementById('button').addEventListener('click', function() {
  // Envoyer une requête AJAX au serveur pour définir $_SESSION['id_img']
  var xhr = new XMLHttpRequest();
  xhr.open('POST', 'set_session.php');
  xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
  xhr.onload = function() {
      if (xhr.status === 200) {
          console.log('Session variable set successfully');
      } else {
          console.log('Request failed. Status: ' + xhr.status);
      }
  };
  xhr.send('id_img=data-id'); // Remplacez YOUR_IMAGE_ID_HERE par l'ID de votre image
});

document.getElementById('image').addEventListener('click', function() {
  // Envoyer une requête AJAX au serveur pour définir $_SESSION['id_img']
  var xhr = new XMLHttpRequest();
  xhr.open('POST', 'set_session.php');
  xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
  xhr.onload = function() {
      if (xhr.status === 200) {
          console.log('Session variable set successfully');
      } else {
          console.log('Request failed. Status: ' + xhr.status);
      }
  };
  xhr.send('id_img=data-id'); // Remplacez YOUR_IMAGE_ID_HERE par l'ID de votre image
});
