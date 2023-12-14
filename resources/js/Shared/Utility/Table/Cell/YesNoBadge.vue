<template>
	<span class="badge" :class="getClass" :title="value">
		{{ value != "" ? value : "-" }}
	</span>
</template>

<script>
export default {
	props: {
		value: String,
		options: Array,
	},
	computed: {
		getClass() {
			if (this.value == "Yes") {
				return "text-bg-success";
			} else {
				return "text-bg-danger";
			}
		},
	},
};
</script>
