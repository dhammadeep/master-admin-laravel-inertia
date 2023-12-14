<template>
	<div class="form-check me-3">
		<input type="checkbox" :checked="checked" :id="name + '_' + value" class="form-check-input" @input="(event) => $emit('update:checked', event.target.checked)" />
		<label :for="name + '_' + value" class="form-check-label">
			{{ label }}
		</label>
	</div>
</template>

<script>
export default {
	props: {
		label: String,
		value: {
			type: String,
			default: "chk",
		},
		checked: Boolean,
		name: String,
	},
};
</script>
