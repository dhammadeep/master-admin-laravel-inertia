<template>
	<td :style="centerAlign" :data-th="header.label">
		<RegularText v-if="header.tableComponent == 'RegularText'" :value="getFieldValue" />
		<ThumbImage v-else-if="header.tableComponent == 'ThumbImage'" :value="getFieldValue" @showModal="this.$emit('showModal', $event)" />
		<StatusBadge v-else-if="header.tableComponent == 'StatusBadge'" :value="getFieldValue" />
		<YesNoBadge v-else-if="header.tableComponent == 'YesNoBadge'" :value="getFieldValue" />
		<MultiBadge v-else-if="header.tableComponent == 'MultiBadge'" :options="getFieldValue" />
		<OptionBadge v-else-if="header.tableComponent == 'OptionBadge'" :value="getFieldValue" :colors="header.colors" />
		<span v-else>-</span>
	</td>
</template>

<script>
import RegularText from "./Cell/RegularText";
import ThumbImage from "./Cell/ThumbImage";
import StatusBadge from "./Cell/StatusBadge";
import YesNoBadge from "./Cell/YesNoBadge";
import OptionBadge from "./Cell/OptionBadge";
import MultiBadge from "./Cell/MultiBadge";

export default {
	components: {
		RegularText,
		ThumbImage,
		StatusBadge,
		YesNoBadge,
		OptionBadge,
		MultiBadge,
	},
	props: {
		header: Object,
		data: Object,
	},
	data() {
		return {
			isModalVisible: false,
			modalSrc: "",
		};
	},
	computed: {
		getFieldValue() {
			if (this.data[this.header.name] != undefined) {
				return this.data[this.header.name];
			}
		},
		centerAlign() {
			if (this.header.tableComponent == "StatusBadge") {
				return { "text-align": "center", width: "70px" };
			} else if (this.header.tableComponent == "YesNoBadge") {
				return { "text-align": "center", width: "50px" };
			}
		},
	},
};
</script>
