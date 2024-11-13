document.addEventListener("DOMContentLoaded", () => {
  console.log("hey");

  const toggleButton = document.querySelector(".toggle-comments");
  const commentsContent = document.querySelector(".comments-accordion");

  toggleButton.addEventListener("click", () => {
    commentsContent.classList.toggle("show");
    toggleButton.textContent = commentsContent.classList.contains("show")
      ? "close ▴"
      : "open ▾";
  });
});
