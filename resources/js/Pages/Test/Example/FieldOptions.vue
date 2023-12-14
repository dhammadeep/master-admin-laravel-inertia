<template>
	<div class="input-group mb-2">
		<input type="text" class="form-control" :disabled="column.disabled" :name="`${column.COLUMN_NAME}[options][${index - 1}][value]`" placeholder="Value" />
		<input type="text" class="form-control" :disabled="column.disabled" :name="`${column.COLUMN_NAME}[options][${index - 1}][label]`" placeholder="Label" />
		<select class="form-select" :disabled="column.disabled" :name="`${column.COLUMN_NAME}[options][${index - 1}][color]`">
			<option disabled="" value="" selected>Select</option>
			<option value="primary">Primary</option>
			<option value="secondary">Secondary</option>
			<option value="success">Success</option>
			<option value="info">Info</option>
			<option value="warning">Warning</option>
			<option value="danger">Danger</option>
		</select>
	</div>
</template>
<script>
export default {
	name: "FieldOptions",
	props: {
		column: Array | Object,
		index: Number,
		disabled: Boolean,
	},
};
</script>
