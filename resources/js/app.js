require("./bootstrap");

import { createApp, h } from "vue";
import { createInertiaApp } from "@inertiajs/inertia-vue3";
import { InertiaProgress } from "@inertiajs/progress";
import VueSweetalert2 from "vue-sweetalert2";
import VueMultiselect from "vue-multiselect";
import store from "./store/index.js";
import Datepicker from "vue3-date-time-picker";
import { QuillEditor } from "@vueup/vue-quill";
import { Bar } from 'vue-chartjs'
import { SetupCalendar, Calendar, DatePicker } from 'v-calendar';
import { jsPDF } from "jspdf";

const appName =
    window.document.getElementsByTagName("title")[0]?.innerText || "Laravel";

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => require(`./Pages/${name}.vue`),
    setup({ el, app, props, plugin }) {
        return createApp({ render: () => h(app, props) })
            .use(plugin)
            .use(store)
            .use(VueSweetalert2)
            .use(SetupCalendar)
            .use(jsPDF)
            .component("multiselect", VueMultiselect)
            .component("datepicker", Datepicker)
            .component("QuillEditor", QuillEditor)
            .component("Calendar", Calendar)
            .component("VDatePicker", DatePicker)
            .component("Bar", Bar)
            .mixin({ methods: { route } })
            .mount(el);
    },
});

InertiaProgress.init({ color: "#4B5563" });
