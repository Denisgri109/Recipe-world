<script>
document.addEventListener('DOMContentLoaded', function () {

    // ── Dynamic Ingredient Add / Remove ──
    document.querySelectorAll('[data-ingredient-form]').forEach(function (formSection) {
        const rowsContainer = formSection.querySelector('[data-ingredient-rows]');
        const addBtn = formSection.querySelector('.js-add-ingredient');

        if (addBtn && rowsContainer) {
            addBtn.addEventListener('click', function () {
                const rows = rowsContainer.querySelectorAll('[data-ingredient-row]');
                const newIndex = rows.length;
                const row = document.createElement('div');
                row.className = 'row g-2 align-items-start ingredient-row';
                row.setAttribute('data-ingredient-row', '');
                row.innerHTML =
                    '<div class="col-md-5">' +
                        '<input type="text" class="form-control" name="ingredients[' + newIndex + '][name]" placeholder="Ingredient name">' +
                    '</div>' +
                    '<div class="col-md-5">' +
                        '<input type="text" class="form-control" name="ingredients[' + newIndex + '][quantity]" placeholder="Quantity (e.g., 2 cups)">' +
                    '</div>' +
                    '<div class="col-md-2 d-grid">' +
                        '<button type="button" class="btn btn-outline-danger js-remove-ingredient">Remove</button>' +
                    '</div>';
                rowsContainer.appendChild(row);
            });
        }

        // Event delegation for remove buttons
        if (rowsContainer) {
            rowsContainer.addEventListener('click', function (e) {
                if (e.target.classList.contains('js-remove-ingredient')) {
                    const row = e.target.closest('[data-ingredient-row]');
                    if (rowsContainer.querySelectorAll('[data-ingredient-row]').length > 1) {
                        row.remove();
                    } else {
                        // Clear the last row instead of removing it
                        row.querySelectorAll('input').forEach(function (input) { input.value = ''; });
                    }
                }
            });
        }
    });

    // ── Client-Side Form Validation ──
    const recipeForm = document.querySelector('form[action*="recipes"]');

    if (recipeForm) {
        recipeForm.addEventListener('submit', function (e) {
            let errors = [];
            let firstInvalid = null;

            // Clear previous JS validation states
            recipeForm.querySelectorAll('.is-invalid-js').forEach(function (el) {
                el.classList.remove('is-invalid-js', 'is-invalid');
            });
            recipeForm.querySelectorAll('.js-error-msg').forEach(function (el) {
                el.remove();
            });

            // Helper: mark a field invalid
            function markInvalid(field, message) {
                field.classList.add('is-invalid', 'is-invalid-js');
                const feedback = document.createElement('div');
                feedback.className = 'invalid-feedback js-error-msg';
                feedback.textContent = message;
                field.parentNode.appendChild(feedback);
                if (!firstInvalid) firstInvalid = field;
                errors.push(message);
            }

            // --- Title ---
            const title = recipeForm.querySelector('#title');
            if (title && title.value.trim().length === 0) {
                markInvalid(title, 'Recipe title is required.');
            } else if (title && title.value.trim().length > 255) {
                markInvalid(title, 'Title must be 255 characters or fewer.');
            }

            // --- Description ---
            const description = recipeForm.querySelector('#description');
            if (description && description.value.trim().length === 0) {
                markInvalid(description, 'A description is required.');
            }

            // --- Instructions ---
            const instructions = recipeForm.querySelector('#instructions');
            if (instructions && instructions.value.trim().length === 0) {
                markInvalid(instructions, 'Cooking instructions are required.');
            }

            // --- Difficulty ---
            const difficulty = recipeForm.querySelector('#difficulty');
            if (difficulty && (!difficulty.value || difficulty.value === '')) {
                markInvalid(difficulty, 'Please select a difficulty level.');
            }

            // --- Prep / Cook time (must be positive numbers) ---
            const prepTime = recipeForm.querySelector('#prep_time');
            if (prepTime && prepTime.value !== '' && (isNaN(prepTime.value) || Number(prepTime.value) < 0)) {
                markInvalid(prepTime, 'Prep time must be 0 or more minutes.');
            }

            const cookTime = recipeForm.querySelector('#cook_time');
            if (cookTime && cookTime.value !== '' && (isNaN(cookTime.value) || Number(cookTime.value) < 0)) {
                markInvalid(cookTime, 'Cook time must be 0 or more minutes.');
            }

            // --- Servings ---
            const servings = recipeForm.querySelector('#servings');
            if (servings && servings.value !== '' && (isNaN(servings.value) || Number(servings.value) < 1)) {
                markInvalid(servings, 'Servings must be at least 1.');
            }

            // --- Image file validation ---
            const imageInput = recipeForm.querySelector('#image_path');
            if (imageInput && imageInput.files && imageInput.files.length > 0) {
                const file = imageInput.files[0];
                const allowedTypes = ['image/jpeg', 'image/png', 'image/jpg', 'image/gif'];
                const maxSize = 2 * 1024 * 1024; // 2 MB

                if (!allowedTypes.includes(file.type)) {
                    markInvalid(imageInput, 'Image must be a JPEG, PNG, JPG, or GIF file.');
                } else if (file.size > maxSize) {
                    markInvalid(imageInput, 'Image must be smaller than 2 MB.');
                }
            }

            // --- Ingredient rows: warn if a name is missing but quantity is filled ---
            recipeForm.querySelectorAll('[data-ingredient-row]').forEach(function (row) {
                const nameInput = row.querySelector('input[name*="[name]"]');
                const qtyInput = row.querySelector('input[name*="[quantity]"]');
                if (nameInput && qtyInput) {
                    if (nameInput.value.trim() === '' && qtyInput.value.trim() !== '') {
                        markInvalid(nameInput, 'Enter an ingredient name or remove this row.');
                    }
                }
            });

            // If there are errors, prevent submission and scroll to first error
            if (errors.length > 0) {
                e.preventDefault();
                if (firstInvalid) {
                    firstInvalid.scrollIntoView({ behavior: 'smooth', block: 'center' });
                    firstInvalid.focus();
                }
            }
        });
    }
});
</script>
