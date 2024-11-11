console.log('Hello World!');

const accordionTitles = document.querySelectorAll('.accordion-title');
const accordionContent = document.querySelectorAll('.accordion-content');

accordionTitles.forEach((title, index) => {
    title.addEventListener("click", function () {
      console.log("clicked");
  
      this.classList.toggle("active");
  
      const content = accordionContent[index];
  
      accordionContent.forEach((panel, i) => {
        if (i !== index) {
          panel.style.display = "none";
          accordionTitles[i].classList.remove("active");
        }
      });
  
      if (content.style.display === "block") {
        content.style.display = "none";
      } else {
        content.style.display = "block";
      }
    });
  });


  

