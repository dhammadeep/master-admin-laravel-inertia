import { createApp, h, Vue } from "vue";
import { createInertiaApp, Link } from "@inertiajs/inertia-vue3";

// Import Used Compenents
import DashboardDefaultLayout from "./Shared/Layouts/DashboardDefaultLayout";
import { Head } from "@inertiajs/inertia-vue3";
// End

// Import Needed Plugin
import vSelect from "vue-select";
import CKEditor from "@ckeditor/ckeditor5-vue";
import "vue-select/dist/vue-select.css";
import axios from 'axios';
import VueAxios from 'vue-axios';
import SlideUpDown from 'vue3-slide-up-down'
// End

// Initialize & Create createInertiaApp
createInertiaApp({
    resolve: async (name) => {
        let page = (await import(`./Pages/${name}`)).default;
        if (!page.layout) {
            page.layout = DashboardDefaultLayout;
        }
        return page;
    },
    setup({ el, App, props, plugin }) {
        createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(CKEditor)
            .use(VueAxios, axios)
            .component("Link", Link)
            .component("Head", Head)
            .component('slide-up-down', SlideUpDown)
            .component("v-select", vSelect)
            .mount(el);
    },

    title: (title) => title + " - CropData Technology",
});
// End
