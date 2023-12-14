<template>
	<!-- <HeaderSection1 :data="data" :title="title" @toggleMode="$emit('toggleMode')" @toggleSidebar="$emit('toggleSidebar')" /> -->
	<slot />
</template>

<script>
import HeaderSection1 from "../Header/HeaderSection1.vue";
export default {
	components: {
		HeaderSection1,
	},
	props: {
		url: String,
		title: String,
		type: String,
		data: Object,
	},
};
</script>
