<template>
	<div>
		<!-- <label for="select" class="form-label">Select Search</label>
		<v-select :options="books" label="title"></v-select>
		<br /> -->
		<label for="select" class="form-label">Multiselect Search</label>
		<v-select multiple :options="books" label="title"></v-select>
	</div>
</template>
<script>
export default {
	name: "selectSearch",
	components: {
		vSelect: window["vue-select"],
	},

	data() {
		return {
			books: [{ title: "Old Man's War" }, { title: "The Lock Artist" }, { title: "HTML5" }, { title: "Right Ho Jeeves" }, { title: "The Code of the Wooster" }, { title: "Thank You Jeeves" }],
		};
	},
};
</script>
