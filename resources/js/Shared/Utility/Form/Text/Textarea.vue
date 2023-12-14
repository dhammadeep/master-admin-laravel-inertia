<template>
  <div class="col-12 mb-3">
    <label :for="id" class="form-label">
      {{ label }}
      <span v-if="validations.required" class="required-asterisk">*</span>
    </label>
    <textarea
      class="form-control"
      :class="$page.props.errors[name] ? 'is-invalid' : 'valid'"
      :value="modelValue"
      v-bind="$attrs"
      @change="$emit('update:modelValue', $event.target.value)"
      title="Please enter your description"
      placeholder="Please enter your description"
      @input="resize()"
      ref="Textarea"
    ></textarea>
    <div
      class="invalid-feedback"
      v-if="$page.props.errors[name]"
      v-text="$page.props.errors[name]"
    />
  </div>
</template>
<script>
export default {
  name: "text-area",
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
  methods: {
    resize() {
      let element = this.$refs["Textarea"];

      element.style.height = "18px";
      element.style.height = element.scrollHeight + "px";
    },
  },
};
</script>
