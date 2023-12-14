<template>

    <div class="d-flex justify-content-between">
        <label :for="id" class="form-label d-flex justify-content-between align-items-center">
            <div>{{ label }} <span v-if="validations.required" class="required-asterisk">*</span></div>
            <div type="button" v-if="uploadedFile != ''" @click="this.$emit('showModal', { uploadedFile, uploadedFileName })"><i class="fa-solid fa-image"></i></div>
        </label>

        <img :src="modelValue?modelValue:''"/>
    </div>

	<input type="file" class="form-control" :class="$page.props.errors[name] ? 'is-invalid' : 'valid'" :accept="validations.mimes" v-bind="$attrs" @input="$emit('update:modelValue', $event.target.files[0])" @change="onFileInput($event)" title="Please Select File" />
	<div class="invalid-feedback" v-if="$page.props.errors[name]" v-text="$page.props.errors[name]" />
</template>

<script>
export default {
	name: "file",
	props: {
		modelValue: {
			type: String,
			default: "",
		},
		name: String,
		id: String,
		label: String,
		validations: Array | Object,
	},
	emits: ["update:modelValue"],
	data() {
		return {
			uploadedFile: "",
			uploadedFileName: "",
		};
	},
	methods: {
		onFileInput(event) {
			var files = event.target.files;
			if (files.length > 0) {
				var filename = files[0].name;
				var extension = files[0].type;
				if (filename.includes(".jpg") || filename.includes(".jpeg") || filename.includes(".png") || filename.includes(".svg")) {
					const data = URL.createObjectURL(event.target.files[0]);
					this.uploadedFile = data;
					this.uploadedFileName = filename;
				} else {
					this.uploadedFile = "";
				}
			} else {
				this.uploadedFile = "";
			}
		},
	},
};
</script>
