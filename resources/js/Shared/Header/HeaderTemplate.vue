<template>
	<HeaderSection1 :data="data" :title="title" @toggleMode="$emit('toggleMode')" @toggleSidebar="$emit('toggleSidebar')" />
	<HeaderSection2 :url="url" :type="type" />
</template>

<script>
import HeaderSection2 from "./HeaderSection2.vue";
import HeaderSection1 from "./HeaderSection1.vue";
export default {
	components: {
		HeaderSection1,
		HeaderSection2,
	},
	props: {
		url: String,
		type: String,
		title: String,
		data: Object,
	},
};
</script>
