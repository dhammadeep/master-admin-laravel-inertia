<template>
	<img @click="this.$emit('showModal', { value, value })" :src="value" class="thumb" />
</template>

<script>
export default {
	props: {
		value: String | Number,
	},
};
</script>

<style scoped>
.thumb {
	width: 50px;
	height: 50px;
	cursor: pointer;
	border-radius: 100%;
	background-color: white;
	border: 2px solid gray;
}
</style>
