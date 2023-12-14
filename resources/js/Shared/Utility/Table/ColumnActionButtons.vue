<template>
	<td data-th="Action" class="text-center" style="min-width: 185px; width: 185px">
		<Link v-if="isEditabled" :href="url + '/' + [item.ID] + '/edit'" class="badge text-bg-primary" :class="colors[action]" title="Edit">
			<i class="fa-solid fa-pen-to-square"></i>
		</Link>

		<Link v-for="action of filterArr" :key="action" :href="url + '/' + action.toLowerCase()" class="badge" :class="colors[action]" :title="action" method="Post" :data="[item.ID]">
			<i :class="icons[action]"></i>
		</Link>
	</td>
</template>

<script>
export default {
	props: {
		url: String,
		item: Object,
		actions: Array,
	},
	data(props) {
		let filterArr = props.actions.filter((item) => item !== "Edit");
		let isEditabled = props.actions.includes("Edit") ? true : false;
		return {
			colors: {
				Edit: "text-bg-primary",
				Approve: "text-bg-warning",
				Finalize: "text-bg-success",
				Reject: "text-bg-danger",
			},
			icons: {
				Edit: "fa-solid fa-pen-to-square",
				Approve: "fa-solid fa-shield-halved",
				Finalize: "fa-solid fa-thumbs-up",
				Reject: "fa-solid fa-xmark",
			},
			filterArr,
			isEditabled,
		};
	},
};
</script>
