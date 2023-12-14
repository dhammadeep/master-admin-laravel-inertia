<template>
	<TableField v-if="columns.length !== 0" :columns="columns" />
	<SearchTable v-else />
</template>

<script>
import SearchTable from "./SearchTable";
import TableField from "./TableField";

export default {
	components: {
		SearchTable,
		TableField,
	},
	props: {
		columns: Array,
	},
};
</script>
