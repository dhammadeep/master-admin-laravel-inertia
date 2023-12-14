<template>
	<div style="margin-bottom: 0.5rem">
		<div class="input-group menuSearchForm">
			<input type="search" class="form-control" v-model="search" placeholder="Menu Search" required @input="saveToStore(search)" />
			<!-- <input type="search" class="form-control" v-model="message" placeholder="Menu Search" required @input="saveToStore($event)" /> -->
			<button type="button" @click="saveToStore(search)" class="btn btn-primary btn-sm">
				<i title="Menu Search" class="fa fa-search"></i>
			</button>
		</div>
	</div>
</template>

<script>
import { storeSearch } from "../templateStore";
export default {
	data() {
		return {
			storeSearch,
			search: "",
		};
	},
	methods: {
		saveToStore(search) {
			this.storeSearch.setSearchvalue(search);
		},
	},
};
</script>
