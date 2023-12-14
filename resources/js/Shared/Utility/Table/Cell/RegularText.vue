<template>

    <div v-html="value != '' ? value : '-'"></div>
</template>

<script>
export default {
	props: {
		value: String | Number,
	},
};
</script>
