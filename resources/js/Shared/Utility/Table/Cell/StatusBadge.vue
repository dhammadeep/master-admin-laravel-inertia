<template>
	<span class="badge" :class="getContext" :title="value">
		{{ value != "" ? value : "-" }}
	</span>
</template>

<script>
export default {
	props: {
		value: String,
	},
	computed: {
		getContext() {
			if (this.value == "Active") {
				return "text-bg-primary";
			} else if (this.value == "Rejected") {
				return "text-bg-danger";
			} else {
				return "text-bg-secondary";
			}
		},
	},
};
</script>
