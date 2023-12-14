<template>
	<span class="badge" :class="getClass" :title="value">
		{{ value != "" ? value : "-" }}
	</span>
</template>

<script>
export default {
	props: {
		value: String,
		colors: Array | Object,
	},
	computed: {
		getClass() {
			if (this.colors[this.value] != undefined) {
				return "text-bg-" + this.colors[this.value];
			}
			return "";
		},
	},
};
</script>
