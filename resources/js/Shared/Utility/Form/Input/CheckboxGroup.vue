<template>
	<label v-if="label" :for="id" class="form-label">
		{{ label }}
		<span v-if="isRequired" class="required-asterisk">*</span>
	</label>
	<div class="row m-0 flex-wrap align-items-center fieldContainer">
		<Checkbox :id="id" :name="name" :value="'' + option.value" :label="option.label" :validations="validations" :key="name + '_' + option.value" :checked="value.includes(option.value)" v-for="option in options" @update:checked="isChecked(option.value, $event)" />
	</div>
</template>
<script>
import axios from "axios";
import { ref, onMounted } from "vue";
import { defineAsyncComponent } from "vue";

const Checkbox = defineAsyncComponent(() => import("./Checkbox"));

export default {
	name: "CheckboxGroup",
	emits: ["update:value"],
	components: {
		Checkbox,
	},
	props: {
		value: {
			type: Array,
			default: [],
			required: true,
		},
		options: {
			type: Array,
			required: true,
		},
		id: String,
		name: String,
		label: String,
		source: String,
		validations: Array | Object,
	},
	computed: {
		isRequired() {
			if (this.validations != undefined) {
				return this.validations.required;
			}
		},
	},
	setup(props, context) {
		const options = ref(props.options);

		const getAllOptions = async () => {
			await axios.get(props.source).then((response) => (options.value = response.data.data));
		};

		const isChecked = (optionVal, checked) => {
			// copy the value Array to avoid mutating props
			let updatedValue = [...props.value];

			// remove name if checked, else add name
			if (checked) {
				updatedValue.push(optionVal);
			} else {
				updatedValue.splice(updatedValue.indexOf(optionVal), 1);
			}

			// emit the updated value
			context.emit("update:value", updatedValue);
		};

		onMounted(() => {
			if (props.source != null) {
				getAllOptions();
			}
		});

		return {
			isChecked,
			options,
		};
	},
};
</script>
