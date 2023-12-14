import { reactive } from "vue";

export const store = reactive({
    toWatchList: [],
    setToWatchList(key, value) {
        this.toWatchList[key] = value;
    },
});
