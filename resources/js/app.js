import './bootstrap';

function buildIngredientRow(index) {
	const row = document.createElement('div');
	row.className = 'row g-2 align-items-start ingredient-row';
	row.setAttribute('data-ingredient-row', '');

	row.innerHTML = `
		<div class="col-md-5">
			<input type="text" class="form-control" name="ingredients[${index}][name]" placeholder="Ingredient name">
		</div>
		<div class="col-md-5">
			<input type="text" class="form-control" name="ingredients[${index}][quantity]" placeholder="Quantity (e.g., 2 cups)">
		</div>
		<div class="col-md-2 d-grid">
			<button type="button" class="btn btn-outline-danger js-remove-ingredient">Remove</button>
		</div>
	`;

	return row;
}

function reindexIngredientRows(rowsContainer) {
	const rows = rowsContainer.querySelectorAll('[data-ingredient-row]');

	rows.forEach((row, index) => {
		const nameInput = row.querySelector('input[name*="[name]"]');
		const quantityInput = row.querySelector('input[name*="[quantity]"]');

		if (nameInput) {
			nameInput.name = `ingredients[${index}][name]`;
		}

		if (quantityInput) {
			quantityInput.name = `ingredients[${index}][quantity]`;
		}
	});
}

function initializeIngredientForm(form) {
	const rowsContainer = form.querySelector('[data-ingredient-rows]');
	const addButton = form.querySelector('.js-add-ingredient');

	if (!rowsContainer || !addButton) {
		return;
	}

	const ensureMinimumOneRow = () => {
		const hasRows = rowsContainer.querySelector('[data-ingredient-row]');
		if (!hasRows) {
			rowsContainer.appendChild(buildIngredientRow(0));
		}
	};

	addButton.addEventListener('click', () => {
		const nextIndex = rowsContainer.querySelectorAll('[data-ingredient-row]').length;
		rowsContainer.appendChild(buildIngredientRow(nextIndex));
		reindexIngredientRows(rowsContainer);
	});

	form.addEventListener('click', (event) => {
		const removeButton = event.target.closest('.js-remove-ingredient');

		if (!removeButton) {
			return;
		}

		const row = removeButton.closest('[data-ingredient-row]');
		if (!row) {
			return;
		}

		row.remove();
		ensureMinimumOneRow();
		reindexIngredientRows(rowsContainer);
	});

	ensureMinimumOneRow();
	reindexIngredientRows(rowsContainer);
}

document.addEventListener('DOMContentLoaded', () => {
	const ingredientForms = document.querySelectorAll('[data-ingredient-form]');
	ingredientForms.forEach((form) => initializeIngredientForm(form));
});
