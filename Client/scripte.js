const btnNoir = document.getElementById('modeNoir');
const btnNormal = document.getElementById('modeNormal');
const contenu = document.getElementById('contenu');

btnNoir.addEventListener('click', () => {
  contenu.style.filter = 'grayscale(100%)';
  contenu.style.backgroundColor = '#ddd';
});

btnNormal.addEventListener('click', () => {
  contenu.style.filter = 'none';
  contenu.style.backgroundColor = '#fff';
});
