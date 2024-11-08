const subNavigationButton = document.querySelectorAll(".sub-category");
const products = document.querySelectorAll("li.product");

let selectedCategory = "all";

// click event for each button
subNavigationButton.forEach((button) => {
  button.addEventListener("click", (e) => {
    selectedCategory = e.target.value;
    filterProducts();
    updateCurrentCategory();
  });
});

// filter function to update displaying products
function filterProducts() {
  products.forEach((product) => {
    let matchesCategory =
      selectedCategory === "all" ||
      product.classList.contains("product_cat-" + selectedCategory);

    if (matchesCategory) {
      product.classList.remove("display-none");
      product.classList.add("display-block");
    } else {
      product.classList.add("display-none");
      product.classList.remove("display-block");
    }
  });
}

// update activated button CSS
function updateCurrentCategory() {
  subNavigationButton.forEach((button) => {
    const category = button.value;
    if (selectedCategory == category) {
      button.classList.add("sub-nav-activated");
    } else {
      button.classList.remove("sub-nav-activated");
    }
  });
}
