document.addEventListener("DOMContentLoaded", function () {
  const slider = document.querySelector(".slider");
  const images = document.querySelectorAll(".slider-image");
  const thumbnails = document.querySelectorAll(".thumbnail");
  const prevBtn = document.querySelector(".prev");
  const nextBtn = document.querySelector(".next");
  let currentIndex = 1;
  const totalImages = images.length;

  // Initial slider position
  slider.style.transform = `translateX(-${currentIndex * 100}%)`;

  // Thumbnail update function
  function updateThumbnails(realIndex) {
    thumbnails.forEach((thumbnail) => thumbnail.classList.remove("active"));
    thumbnails[realIndex].classList.add("active");
  }

  function updateSlider(index) {
    slider.style.transition = "transform 0.5s ease";
    currentIndex = index;

    // Update real index for thumbnails
    let realIndex = currentIndex - 1;
    if (currentIndex === 0) {
      realIndex = thumbnails.length - 1; // Activate the last image thumbnail for the first fake slide
    } else if (currentIndex === totalImages - 1) {
      realIndex = 0; // Activate the first image thumbnail for the last fake slide
    }

    // Update thumbnails
    updateThumbnails(realIndex);

    // Update slider position
    if (currentIndex >= totalImages - 1) {
      // Smoothly move from the last slide to the first
      slider.style.transform = `translateX(-${currentIndex * 100}%)`;
      setTimeout(() => {
        slider.style.transition = "none";
        currentIndex = 1;
        slider.style.transform = `translateX(-${currentIndex * 100}%)`;
      }, 500);
    } else if (currentIndex <= 0) {
      // Smoothly move from the first slide to the last
      slider.style.transform = `translateX(0%)`;
      setTimeout(() => {
        slider.style.transition = "none";
        currentIndex = totalImages - 2;
        slider.style.transform = `translateX(-${currentIndex * 100}%)`;
      }, 500);
    } else {
      // Regular movement for middle slides
      slider.style.transform = `translateX(-${currentIndex * 100}%)`;
    }
  }

  // Previous button click event
  prevBtn.addEventListener("click", () => {
    updateSlider(currentIndex - 1);
  });

  // Next button click event
  nextBtn.addEventListener("click", () => {
    updateSlider(currentIndex + 1);
  });

  // Change slider image on thumbnail click
  thumbnails.forEach((thumbnail, index) => {
    thumbnail.addEventListener("click", () => {
      updateSlider(index + 1); // Move to the actual image index
    });
  });

  // Initialization - Activate the thumbnail for the first slide
  updateThumbnails(currentIndex - 1);
});

// test button
document.addEventListener("DOMContentLoaded", function () {
  // Decrease button click event
  document.querySelector(".decrease").addEventListener("click", function () {
    const input = document.querySelector(
      ".single-product .add-to-cart-wrapper .input-text"
    );
    let value = parseInt(input.value);
    if (value > 1) {
      // Set minimum value to 1
      input.value = value - 1;
    }
  });

  // Increase button click event
  document.querySelector(".increase").addEventListener("click", function () {
    const input = document.querySelector(
      ".single-product .add-to-cart-wrapper .input-text"
    );
    let value = parseInt(input.value);
    input.value = value + 1;
  });
});
