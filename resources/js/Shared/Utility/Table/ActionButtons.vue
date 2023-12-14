<template>
	<div class="col-auto p-0 actionBtns">
		<button type="button" :class="isDisabled" @click="confirmApprove" class="btn btn-primary">
			<i class="fa-solid fa-shield-halved"></i>
			<span class="desktop">Approve</span>
		</button>
		<button type="button" :class="isDisabled" @click="confirmReject" class="btn btn-danger">
			<i class="fa-solid fa-xmark"></i>
			<span class="desktop">Reject</span>
		</button>
		<button type="button" :class="isDisabled" @click="confirmFinalize" class="btn btn-success">
			<i class="fa-solid fa-thumbs-up"></i>
			<span class="desktop">Finalize</span>
		</button>
	</div>
</template>

<script>
import axios from "axios";

export default {
	props: {
		dataList: Array,
		url: String,
	},
	data() {
		return {
			dataList: this.dataList,
			url: this.url,
		};
	},
	methods: {
		confirmApprove: function () {
			let confirm = window.confirm("Do you really want to Approve");
			if (confirm) {
				let targetUrl = this.url + "/approve";
				axios
					.post(targetUrl, this.dataList)
					.then((response) => {
						// console.log(response);
						// alert("Approve All");
						this.$inertia.get(this.url);
					})
					.catch((error) => console.log(error.message));
			}
		},

		confirmReject: function () {
			let confirm = window.confirm("Do you really want to Reject");
			if (confirm) {
				let targetUrl = this.url + "/reject";
				axios
					.post(targetUrl, this.dataList)
					.then((response) => {
						// console.log(response);
						// alert("Reject All");
						this.$inertia.get(this.url);
					})
					.catch((error) => console.log(error.message));
			}
		},

		confirmFinalize: function () {
			let confirm = window.confirm("Do you really want to Finalize");
			if (confirm) {
				let targetUrl = this.url + "/finalize";
				axios
					.post(targetUrl, this.dataList)
					.then((response) => {
						// console.log(response);
						// alert("Finalize All");
						this.$inertia.get(this.url);
					})
					.catch((error) => console.log(error.message));
			}
		},
	},
	computed: {
		isDisabled() {
			return this.dataList.length === 0 ? "disabled" : "";
		},
	},
};
</script>
