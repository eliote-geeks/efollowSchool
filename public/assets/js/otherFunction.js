function formatAmountCosts(input, event) {
  // Gestion de la saisie des chiffres uniquement
  if (event) {
    var charCode = (event.which) ? event.which : event.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
      return false;
    }
  }

  // Récupération de la valeur du champ input
  let valeur = input.value.replace(/\s/g, '');

  // Formatage du montant avec des espaces tous les 3 chiffres
  valeur = valeur.replace(/\B(?=(\d{3})+(?!\d))/g, " ");

  // Mise à jour de la valeur du champ input
  input.value = valeur;

  // Retourner true pour permettre la saisie
  return true;
}

const navbarIcon = document.querySelector('.navbar-icon');
const popupMenu = document.querySelector('.popup-menu');

navbarIcon.addEventListener('click', () => {
  popupMenu.classList.toggle('show');
});

const menuItems = document.querySelectorAll('.menu-item');
menuItems.forEach(item => {
  item.addEventListener('mouseenter', () => {
    item.style.setProperty('--menu-item-scale', 1.1);
  });
  item.addEventListener('mouseleave', () => {
    item.style.setProperty('--menu-item-scale', 1);
  });
});