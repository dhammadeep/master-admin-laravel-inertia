import { reactive } from "vue";

export const storeSearch = reactive({
    searchValue: '',
    setSearchvalue(value) {
        this.searchValue = value;
    },
});


export const templateMode = reactive({
    templateModeValue: '',
    setTemplateModeValue(value) {
        this.templateModeValue = value;
    },
});
