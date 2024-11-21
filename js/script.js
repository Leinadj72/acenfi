console.log('ACenFi website loaded!');
function loadNews() {
  fetch('php/news.php')
    .then((response) => response.text())
    .then((data) => {
      document.getElementById('news-container').innerHTML = data;
    })
    .catch((error) => console.error('Error fetching news:', error));
}
function loadEvents() {
  fetch('php/events.php')
    .then((response) => response.text())
    .then((data) => {
      document.getElementById('events-container').innerHTML = data;
    })
    .catch((error) => console.error('Error fetching events:', error));
}
document.addEventListener('DOMContentLoaded', function () {
  loadNews();
  loadEvents();
});
