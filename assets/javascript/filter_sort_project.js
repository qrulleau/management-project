document.querySelectorAll('button[data-category]').forEach(function (button) {
  button.addEventListener('click', (e) => {
    let category = e.target.getAttribute('data-category');
    document.querySelectorAll('.project').forEach(function (project) {
      if (category === 'all') {
        project.classList.remove('hidden');
      } else if (category === project.id) {
        project.classList.remove('hidden');
      } else {
        project.classList.add('hidden');
      }
    });
  });
});
