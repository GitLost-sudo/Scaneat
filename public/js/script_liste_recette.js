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

// Quand on clique sur l'image avec la classe "search_button", on affecte la classe "displaysection" à la place de "displaynone" au form avec la classe "search_bar"
const buttonSearch = document.querySelector('.search_button');
const formSearch = document.querySelector('.search_bar');
const mainSection = document.querySelector('main');

buttonSearch.addEventListener('click', () => {
    if (formSearch.classList.contains('displaynone')) {
        formSearch.classList.remove('displaynone');
        formSearch.classList.add('displaysection');
        mainSection.classList.add('display_grise');
    } else {
        formSearch.classList.remove('displaysection');
        formSearch.classList.add('displaynone');
        mainSection.classList.remove('display_grise');
    }
});