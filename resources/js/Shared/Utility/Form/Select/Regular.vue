<template>
    <div>
        <label :for="id" class="form-label">
            {{ label }}
            <span v-if="validations.required" class="required-asterisk">*</span>
        </label>
        <select class="form-select" :class="$page.props.errors[name] ? 'is-invalid' : 'valid'" :id="name"
            :value="modelValue" v-bind="$page.props" @input="saveToStore($event)">
            <option value="" disabled>Select</option>
            <option v-for="option of selectOptions" :value="option['value']" :key="name + option['value']"
                :selected="option['value'] == modelValue">
                {{ option["label"] }}
            </option>
        </select>
        <div class="invalid-feedback" v-if="$page.props.errors[name]" v-text="$page.props.errors[name]" />
    </div>
</template>

<script>
import axios from "axios";
import { store } from "../Store.js";

export default {
    name: "RegularSelect",
    emits: ["update:modelValue"],

    props: {
        modelValue: {
            type: String,
            default: "",
        },
        options: Array,
        validations: Array | Object,
        name: String,
        id: String,
        label: String,
        source: String,
        mount: Boolean,
        watching: {
            type: String,
            default: null,
        },
    },

    computed: {
        watchParentChange() {
            if (this.watching) {
                return this.store.toWatchList[this.watching];
            }
        },
    },

    methods: {
        saveToStore(event) {
            let value = event.target.value;
            this.store.setToWatchList(this.name, value);
            this.$emit("update:modelValue", value);
        },
    },

    watch: {
        watchParentChange(newValue) {
            this.$emit("update:modelValue", null);
            if (this.source) {
                let targetUrl = `${this.source}/${newValue}`;
                axios
                    .get(targetUrl)
                    .then((response) => {
                        if (response.data.data.length == 0) {
                            this.$emit("update:modelValue", null);
                        }
                        this.selectOptions = response.data.data;
                    })
                    .catch((error) => console.log(error.message));
            }
        },
    },

    data() {
        return {
            selectOptions: this.options,
            store,
        };
    },

    mounted() {
        let targetWatchUrl = this.source;
        if (this.watching) {
            let watcherFieldValue, watcherFieldName;
            for (let key in this.$page.props.fields) {
                watcherFieldName = this.$page.props.fields[key].name;
                if (watcherFieldName == this.watching) {
                    watcherFieldValue = this.$page.props.fields[key].value
                }
            }
            targetWatchUrl = `${this.source}/${watcherFieldValue}`;
        }
        if (this.mount && this.source) {
            axios.get(targetWatchUrl).then((response) => {
                this.selectOptions = response.data.data;
            });
        }
    },
};
</script>
