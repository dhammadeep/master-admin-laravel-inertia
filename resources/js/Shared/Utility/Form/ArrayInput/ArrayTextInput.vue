<template>
    <div class="row">
        <div class="col-6" v-for="item of data.fieldArray">
            <label class="form-label">
                {{ item.label }}
            </label>
            <input
                type="text"
                class="form-control"
                v-bind="$attrs"
                @input="$emit('update:modelValue', $event.target.value)"
            />
        </div>
    </div>
</template>

<script>
export default {
    name: "ArrayTextInput",
    props: {
        modelValue: {
            type: String,
            default: "",
        },

        data: Array | Object,
        // name: String,
        // id: String,
        // label: String,
        // validations: Array | Object,
    },
    emits: ["update:modelValue"],
};
</script>
