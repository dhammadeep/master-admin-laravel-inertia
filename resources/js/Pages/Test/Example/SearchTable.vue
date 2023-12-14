<template>
	<div class="formContainer">
		<div class="formTitleContainer d-flex justify-content-between align-items-center border-bottom">
			<h5 class="formTitle m-0">Search Table</h5>
		</div>
		<form @submit.prevent="Submit">
			<div class="input-group">
				<select class="form-select" v-model="form.tablename" :name="form.tablename" required>
					<option value="" disabled selected>Select Table</option>
					<option v-for="option of getOption" :key="option" :value="option">
						{{ option }}
					</option>
				</select>
				<Link :href="href + form.tablename" :class="form.tablename === '' ? 'disabled' : ''" class="btn btn-primary btn-sm">
					<i title="Search" class="fa fa-search" style="vertical-align: middle"></i>
				</Link>
			</div>
		</form>
	</div>
</template>

<script>
import axios from "axios";
import { useForm } from "@inertiajs/inertia-vue3";
export default {
	props: {
		columns: Array,
		tables: Array,
	},
	data() {
		return {
			getOption: null,
		};
	},
	setup() {
		let href = window.location.origin + "/test/table-field-generator/";
		const form = useForm({
			tablename: "",
		});
		return {
			form,
			href,
		};
	},
	async created() {
		// GET request using axios with async/await
		const response = await axios.get("/test/table-names");
		this.getOption = response.data;
	},
};
</script>
