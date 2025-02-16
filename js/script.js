console.log('ACenFi website loaded!');

function toggleMenu() {
  const menu = document.getElementById('menu');
  menu.classList.toggle('active');
}

document.addEventListener('DOMContentLoaded', function () {
  // Add event listener to the menu icon
  document.querySelector('.menu-icon').addEventListener('click', toggleMenu);
});

// Close menu when clicking outside
document.addEventListener('click', function (event) {
  const menu = document.getElementById('menu');
  const menuIcon = document.querySelector('.menu-icon');

  // Check if the clicked element is NOT inside the menu or menu icon
  if (!menu.contains(event.target) && !menuIcon.contains(event.target)) {
    menu.classList.remove('active'); // Close the menu
  }
});

// Toggle menu when clicking the menu icon
document.addEventListener('DOMContentLoaded', function () {
  document
    .querySelector('.menu-icon')
    .addEventListener('click', function (event) {
      event.stopPropagation(); // Prevents the menu from closing immediately when clicking the icon
      toggleMenu();
    });
});

function loadNews() {
  fetch('php/news.php')
    .then((response) => {
      if (!response.ok) {
        throw new Error(`HTTP error! status: ${response.status}`);
      }
      return response.json();
    })
    .then((news) => {
      const newsList = document.getElementById('news-list');
      newsList.innerHTML = '';

      if (news.length > 0) {
        news.forEach((item) => {
          const newsItem = document.createElement('div');
          newsItem.classList.add('news-item');

          const title = document.createElement('h3');
          title.textContent = item.title;
          newsItem.appendChild(title);

          const content = document.createElement('p');
          content.textContent = item.content;
          newsItem.appendChild(content);

          const date = document.createElement('small');
          date.textContent = new Date(item.date).toLocaleDateString();
          newsItem.appendChild(date);

          if (item.image_url) {
            // ✅ Correct
            const imagePath = `${item.image_url}`;
            console.log('News Image Path:', imagePath); // Debugging
            const image = document.createElement('img');
            image.src = item.image_url.startsWith('uploads')
              ? `/${item.image_url}`
              : item.image_url;
            image.alt = item.title;
            newsItem.appendChild(image);
          }

          newsList.appendChild(newsItem);
        });
      } else {
        newsList.innerHTML = '<p>No news available.</p>';
      }
    })
    .catch((error) => {
      console.error('Error fetching news:', error);
      const newsList = document.getElementById('news-list');
      newsList.innerHTML =
        '<p>Failed to load news. Please try again later.</p>';
    });
}

function loadEvents() {
  const eventsContainer = document.getElementById('events-container');
  eventsContainer.innerHTML = '<p>Loading events...</p>';

  fetch('php/events.php')
    .then((response) => response.json())
    .then((events) => {
      eventsContainer.innerHTML = '';

      if (events.length > 0) {
        events.forEach((event) => {
          const eventItem = document.createElement('div');
          eventItem.classList.add('event-item');

          const title = document.createElement('h3');
          title.textContent = event.title;
          eventItem.appendChild(title);

          const description = document.createElement('p');
          description.textContent = event.description;
          eventItem.appendChild(description);

          const date = document.createElement('small');
          date.textContent = new Date(event.event_date).toLocaleDateString();
          eventItem.appendChild(date);

          if (event.image_url) {
            // ✅ Correct
            const imagePath = `${event.image_url}`;
            console.log('Event Image Path:', imagePath); // Debugging
            const image = document.createElement('img');
            image.src = event.image_url.startsWith('uploads')
              ? `/${event.image_url}`
              : event.image_url;
            image.alt = event.title;
            eventItem.appendChild(image);
          }

          eventsContainer.appendChild(eventItem);
        });
      } else {
        eventsContainer.innerHTML = '<p>No events available.</p>';
      }
    })
    .catch((error) => {
      console.error('Error fetching events:', error);
      eventsContainer.innerHTML =
        '<p>Failed to load events. Please try again later.</p>';
    });
}

document.addEventListener('DOMContentLoaded', function () {
  loadNews();
  loadEvents();
});

// $(document).ready(function () {
//   if ($('.slide').length) {
//     $('.slide').slick({
//       infinite: true,
//       autoplay: true,
//       autoplaySpeed: 5000,
//       dots: true,
//       arrows: true,
//       fade: true,
//       speed: 500,
//     });
//   }
// });

// let currentSlide = 0;
// const slides = document.querySelectorAll('#hero-slider .slide img');
// const totalSlides = slides.length;

// function showNextSlide() {
//   currentSlide = (currentSlide + 1) % totalSlides;
//   const slider = document.querySelector('#hero-slider .slide');
//   slider.style.transform = `translateX(-${currentSlide * 100}%)`;
// }

// setInterval(showNextSlide, 3000);
