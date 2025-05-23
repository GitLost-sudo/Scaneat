// Quand on clique sur le bouton avec la classe "filtres_button", on affecte la classe "displaysection" à la place de "displaynone"
const buttonFiltres = document.querySelector('.filtres_button');
const sectionFiltres = document.querySelector('.section_filtres');
buttonFiltres.addEventListener('click', () => {
    if (sectionFiltres.classList.contains('displaynone')) {
        sectionFiltres.classList.remove('displaynone');
        sectionFiltres.classList.add('displaysection');
    } else {
        sectionFiltres.classList.remove('displaysection');
        sectionFiltres.classList.add('displaynone');
    }
});