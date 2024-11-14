const accordionTitles = document.querySelectorAll('.accordion-title');
const accordionContent = document.querySelectorAll('.accordion-content');
const accordionIcons = document.querySelectorAll('.accordion-icon');

accordionTitles.forEach((title, index) => {
  title.addEventListener('click', () => {
    accordionContent[index].classList.toggle('accordion-active');
    accordionIcons[index].classList.toggle('rotate-icons');
  })
})
  

