<template>
	<div class="modal fade show" id="sucessModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLiveLabel" aria-modal="true" role="dialog" style="display: block">
		<div class="modal-dialog modal-dialog-scrollable modal-md">
			<div class="modal-content">
				<div class="modal-header">
					<h1 class="modal-title fs-5" id="sucessModalLabel">{{ header }}</h1>
					<button type="button" class="btn-close" @click="this.$emit('close')" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
                    {{ body }}
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" @click="this.$emit('close')" data-bs-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>
</template>
<script>
export default {
	name: "successModal",
	props: {
		body: String,
		header: String,
	},
};
</script>

<style scoped>


.modal {
	display: block;
	backdrop-filter: blur(5px);
}
.modal-header,
.modal-body,
.modal-footer {
	color: #000000;
	background-color: #ffffff;
}
.modal-content {
	background-color: transparent;
}

.modal-header{
    background-color: green;
    color: white;
    text-transform: capitalize;
}

.btn-close {
    background: transparent url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16' fill='%23ffffff'%3e%3cpath d='M.293.293a1 1 0 0 1 1.414 0L8 6.586 14.293.293a1 1 0 1 1 1.414 1.414L9.414 8l6.293 6.293a1 1 0 0 1-1.414 1.414L8 9.414l-6.293 6.293a1 1 0 0 1-1.414-1.414L6.586 8 .293 1.707a1 1 0 0 1 0-1.414z'/%3e%3c/svg%3e") center/1em auto no-repeat;
}
.img-fluid {
	user-select: none;
	margin: 0 auto;
	display: block;
}

.v-enter-active,
.v-leave-active {
  transition: opacity 0.5s ease;
}

.v-enter-from,
.v-leave-to {
  opacity: 0;
}
</style>
