<template>
	<div class="modal fade show" id="staticBackdropLive" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLiveLabel" aria-modal="true" role="dialog" style="display: block">
		<div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" :class="type.endsWith('.jpg') || type.endsWith('.jpeg') || type.endsWith('.png') || type.endsWith('.svg') ? 'modal-md' : 'modal-lg'">
			<div class="modal-content">
				<div class="modal-header">
					<h1 class="modal-title fs-5" id="staticBackdropLiveLabel">
						<span v-if="frame != ''">Details</span>
						<span v-else-if="type.endsWith('.jpg') || type.endsWith('.jpeg') || type.endsWith('.png') || type.endsWith('.svg')"> Thumbnail Image</span>
						<span v-else> Not supported file</span>
					</h1>
					<button type="button" class="btn-close" @click="this.$emit('close')" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					<div v-if="type.endsWith('.jpg') || type.endsWith('.jpeg') || type.endsWith('.png') || type.endsWith('.svg')">
						<img :src="src" class="img-fluid" />
					</div>

					<div v-else-if="frame != ''" v-html="frame"></div>

					<div v-else>
						<h5>This file is not supported...</h5>
						<!-- {{ src }}
						{{ type }} -->
					</div>
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
	name: "modal",
	props: {
		src: String,
		type: String,
	},
	setup(props) {
		console.log(props.type);
		let frame = "";
		if (props.type.endsWith(".docx") || props.type.endsWith(".xlsx")) {
			frame = `<iframe id="iframeDocView" src="https://view.officeapps.live.com/op/embed.aspx?src= + ` + props.src + `" width="100%" height="500" frameborder="0"> </iframe>`;
		} else if (props.type.endsWith(".pdf")) {
			frame = `<iframe id="iframeDocView" src="` + props.src + `" width="100%" height="500" frameborder="0"> </iframe>`;
		}
		return { frame };
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

.bounce-enter-active {
	animation: bounce-in 0.5s;
}
.bounce-leave-active {
	animation: bounce-in 0.5s reverse;
}
@keyframes bounce-in {
	0% {
		transform: scale(0);
	}
	50% {
		transform: scale(1.25);
	}
	100% {
		transform: scale(1);
	}
}
</style>
