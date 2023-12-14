<template>
	<span v-if="option == null">-</span>
	<span v-for="option in options" class="badge badge-pill text-bg-secondary" :key="'multi_badge_' + option">
		{{ option }}
	</span>
</template>

<script>
export default {
	props: {
		options: Array,
	},
};
</script>

<style scoped>
.badge {
	font-size: 9px !important;
}
</style>
