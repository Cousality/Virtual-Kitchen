document.addEventListener("DOMContentLoaded", function () {
  const checkboxes = document.querySelectorAll('input[name="meal"]');
  const recipeCards = document.querySelectorAll(".recipe-card");

  // Add event listener to each checkbox
  checkboxes.forEach((checkbox) => {
    checkbox.addEventListener("change", filterRecipes);
  });

  function filterRecipes() {
    const selectedMeals = Array.from(checkboxes)
      .filter((checkbox) => checkbox.checked)
      .map((checkbox) => checkbox.value);

    // Show all recipes if no filters are selected
    if (selectedMeals.length === 0) {
      recipeCards.forEach((card) => {
        card.style.display = "block";
      });
      return;
    }

    // Filter recipes based on selected meal types
    recipeCards.forEach((card) => {
      const mealType = card.dataset.meal;
      if (selectedMeals.includes(mealType)) {
        card.style.display = "block";
      } else {
        card.style.display = "none";
      }
    });
  }

  // Add animation class
  recipeCards.forEach((card) => {
    card.classList.add("filter-transition");
  });
});
