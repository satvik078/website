document.addEventListener('DOMContentLoaded', function() {
    const courseButton = document.getElementById('courseButton');
    const courseOptions = document.getElementById('courseOptions');
    const enrolledCourse = document.getElementById('enrolledCourse');

    courseButton.addEventListener('click', function(event) {
      event.stopPropagation(); // Preventing event from bubbling up and triggering window click listener
      courseOptions.classList.toggle('show');
    });

    window.addEventListener('click', function(event) {
      if (!event.target.matches('#courseButton')) {
        if (courseOptions.classList.contains('show')) {
          courseOptions.classList.remove('show');
        }
      }
    });

    // Get the current page URL
    const currentPageUrl = window.location.href;
    const urlParts = currentPageUrl.split('/');
    const currentPage = urlParts[urlParts.length - 1].split('.')[0].toLowerCase(); 

    
    if (currentPage === 'cse')
     {
        courseButton.textContent = 'CSE';
         enrolledCourse.textContent = 'Computer Science And Engineering';
     } 
    else if (currentPage === 'ece') 
    {
        courseButton.textContent = 'ECE';
        enrolledCourse.textContent = 'Electronics And Communication Engineering';
    }
  });


  document.addEventListener('DOMContentLoaded', function() {
    const searchIcon = document.getElementById('searchIcon');
    const searchInput = document.getElementById('searchInput');
  
    searchIcon.addEventListener('click', function() {
      searchInput.style.display = 'inline-block'; 
      searchInput.focus(); 
    });
  
    
    window.addEventListener('click', function(event) {
      if (event.target !== searchIcon && event.target !== searchInput) {
        searchInput.style.display = 'none'; 
        searchInput.value = ''; 
      }
    });
  });

  function editName() {
    const nameInput = document.getElementById('nameInput');
    nameInput.focus();
  }