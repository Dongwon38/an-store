document.addEventListener("DOMContentLoaded", function () {
  const slider = document.querySelector(".slider");
  const images = document.querySelectorAll(".slider-image");
  const thumbnails = document.querySelectorAll(".thumbnail");
  const prevBtn = document.querySelector(".prev");
  const nextBtn = document.querySelector(".next");
  let currentIndex = 1; // 슬라이더 시작 인덱스 (가짜 슬라이드를 고려하여 첫 번째 이미지로)
  const totalImages = images.length;

  // 슬라이더 초기 위치 설정
  slider.style.transform = `translateX(-${currentIndex * 100}%)`;

  // 썸네일 업데이트 함수
  function updateThumbnails(realIndex) {
    thumbnails.forEach((thumbnail) => thumbnail.classList.remove("active"));
    thumbnails[realIndex].classList.add("active");
  }

  function updateSlider(index) {
    slider.style.transition = "transform 0.5s ease";
    currentIndex = index;

    // 실제 인덱스를 썸네일에 업데이트
    let realIndex = currentIndex - 1;
    if (currentIndex === 0) {
      realIndex = thumbnails.length - 1; // 첫 번째 가짜 슬라이드에서 마지막 이미지 썸네일을 활성화
    } else if (currentIndex === totalImages - 1) {
      realIndex = 0; // 마지막 가짜 슬라이드에서 첫 번째 이미지 썸네일을 활성화
    }

    // 썸네일 업데이트
    updateThumbnails(realIndex);

    // 슬라이더 위치 업데이트
    if (currentIndex >= totalImages - 1) {
      // 마지막 슬라이드에서 첫 번째로 부드럽게 이동
      slider.style.transform = `translateX(-${currentIndex * 100}%)`;
      setTimeout(() => {
        slider.style.transition = "none";
        currentIndex = 1;
        slider.style.transform = `translateX(-${currentIndex * 100}%)`;
      }, 500);
    } else if (currentIndex <= 0) {
      // 첫 번째 슬라이드에서 마지막으로 부드럽게 이동
      slider.style.transform = `translateX(0%)`;
      setTimeout(() => {
        slider.style.transition = "none";
        currentIndex = totalImages - 2;
        slider.style.transform = `translateX(-${currentIndex * 100}%)`;
      }, 500);
    } else {
      // 중간 슬라이드에서는 정상적인 이동
      slider.style.transform = `translateX(-${currentIndex * 100}%)`;
    }
  }

  // 이전 버튼 클릭 이벤트
  prevBtn.addEventListener("click", () => {
    updateSlider(currentIndex - 1);
  });

  // 다음 버튼 클릭 이벤트
  nextBtn.addEventListener("click", () => {
    updateSlider(currentIndex + 1);
  });

  // 썸네일 클릭 시 슬라이더 이미지 변경
  thumbnails.forEach((thumbnail, index) => {
    thumbnail.addEventListener("click", () => {
      updateSlider(index + 1); // 실제 이미지 인덱스로 이동
    });
  });

  // 초기화 - 첫 번째 슬라이드의 썸네일을 활성화
  updateThumbnails(currentIndex - 1);
});
