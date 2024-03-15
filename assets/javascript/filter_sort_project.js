const buttons = document.querySelectorAll('button[data-category]');

buttons.forEach(function (button) {
  button.addEventListener('click', (e) => {
    let category = e.target.getAttribute('data-category');
    document.querySelectorAll('.project').forEach(function (project) {
      if (category === 'all') {
        project.classList.remove('hidden');
        buttons.forEach(function (btn) {
          btn.classList.remove('active');
        });
        button.classList.add('active');
      } else if (category === project.id) {
        project.classList.remove('hidden');
        buttons.forEach(function (btn) {
          btn.classList.remove('active');
        });
        button.classList.add('active');
      } else {
        project.classList.add('hidden');
      }
    });
  });
});
