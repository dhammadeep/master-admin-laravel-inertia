<template>
  <label :for="id" class="form-label">
    {{ label }}
    <span v-if="validations.required" class="required-asterisk">*</span>
  </label>
  <input
    type="text"
    class="form-control"
    :class="$page.props.errors[name] ? 'is-invalid' : 'valid'"
    :value="modelValue"
    v-bind="$attrs"
    @input="$emit('update:modelValue', $event.target.value)"
  />

  <div
    class="invalid-feedback"
    v-if="$page.props.errors[name]"
    v-text="$page.props.errors[name]"
  />
</template>

<script>
export default {
  name: "Text",
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
};
</script>
