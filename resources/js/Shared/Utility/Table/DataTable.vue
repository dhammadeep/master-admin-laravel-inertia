<template>
	<div class="m-0 row justify-content-center align-items-start mb-3">
		<!--Table search-->
		<Search :columns="data.columns" :url="url" :filters="filters" />
		<!--End-->

		<!--Selected table row actions-->
		<ActionButtons :dataList="checkedList" :url="url" />
		<!--End-->
	</div>
	<div class="table-responsive">
		<table class="table table-bordered table-dark">
			<thead>
				<tr>
					<th>
						<input type="checkbox" class="form-check-input" @click="checkedAll" v-model="allChecked" />
					</th>
					<th v-for="header in getColumns" :key="header.name">
						{{ header.label }}
					</th>
					<th class="text-center">Action</th>
				</tr>
			</thead>
			<tbody v-if="hasTableData">
				<tr v-for="item in data.data" :key="item.ID" :class="{'rejected':  item.Status== 'Rejected'}">
					<td data-th="Checkbox" class="text-center" width="35" >
						<input type="checkbox" v-model="checkedList" @click="checked" :value="item.ID" class="form-check-input" :id="item.ID" />
					</td>
					<TableCell v-for="header in data.columns" :key="header.name + item.ID" :header="header" :data="item" @showModal="showModal($event)" />
					<ColumnActionButtons :url="url" :item="item" :actions="actions" />
				</tr>
			</tbody>
			<tbody class="noRecordBody" v-else>
				<tr>
					<td align="center" colspan="30">No Records Found</td>
				</tr>
			</tbody>
		</table>
	</div>

	<!--Popup Modal-->
	<Transition name="bounce">
		<Modal v-if="isModalVisible" @close="closeModal" :src="modalSrc" :type="modalSrc" />
	</Transition>
	<!--End-->

	<!--Table Pagination-->
	<Pagination :links="data.meta.links" />
	<!--End-->
</template>

<script>
import Search from "./Search";
import ActionButtons from "./ActionButtons";
import ColumnActionButtons from "./ColumnActionButtons";
import Pagination from "./Pagination";
import TableCell from "./TableCell";
import Modal from "../Modal/ModalView";

export default {
	components: {
		Search,
		ActionButtons,
		Pagination,
		TableCell,
		ColumnActionButtons,
		Modal,
	},
	data() {
		return {
			allChecked: false,
			checkedList: [],
			isModalVisible: false,
			modalSrc: "",
		};
	},
	props: {
		data: Object,
		url: String,
		filters: Object,
		actions: Array,
	},
	methods: {
		check: function (e) {
			if (e.target.checked == true) {
				e.target.parentNode.parentNode.classList.add("selected");
			} else {
				e.target.parentNode.parentNode.classList.remove("selected");
			}
		},

		checkedAll: function () {
			this.checkedList = [];
			if (!this.allChecked) {
				for (let id in this.data.data) {
					this.checkedList.push(this.data.data[id].ID);
				}
			}
		},

		checked: function () {
			this.allChecked = false;
		},

		showModal: function (event) {
			this.isModalVisible = true;
			this.modalSrc = event["value"];
		},
		closeModal: function () {
			this.isModalVisible = false;
		},
	},
	computed: {
		hasTableData() {
			return this.data.data.length;
		},
		getColumns() {
			return this.data.columns.filter(function (item) {
				return item.tableComponent != undefined;
			});
		},
	},
};
</script>


<style scoped>
.rejected td{
    background-color:rgb(33 5 5);
}

.rejected:hover td{
    background-color:rgb(33 5 5);
    color: inherit;
}
</style>
