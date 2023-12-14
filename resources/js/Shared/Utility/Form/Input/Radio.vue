<template>
  <label class="form-label">
    {{ label }}
    <span v-if="validations.required" class="required-asterisk">*</span>
  </label>
  <div
    class="d-flex flex-wrap align-items-center"
    :class="$page.props.errors[name] ? 'is-invalid' : 'valid'"
  >
    <div
      class="form-check me-3"
      v-for="(option, key) of options"
      :key="'opt_' + name + '_' + key"
    >
      <input
        type="radio"
        :name="name"
        :value="option.value"
        :id="name + '_' + key"
        :checked="option.value == modelValue"
        v-bind="$attrs"
        class="form-check-input"
        @input="$emit('update:modelValue', $event.target.value)"
      />
      <label class="form-check-label" :for="name + '_' + key">{{ option.label }}</label>
    </div>
  </div>
  <div
    class="invalid-feedback"
    v-if="$page.props.errors[name]"
    v-text="$page.props.errors[name]"
  />
</template>

<script>
export default {
  name: "Radio",
  emits: ["update:modelValue"],
  props: {
    modelValue: {
      type: String,
      default: "",
    },
    options: Array | Object,
    validations: Array | Object,
    checked:String,
    name: String,
    id: String,
    label: String,
  },
};
</script>
