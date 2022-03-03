require("./bootstrap");

import { createApp, h } from "vue";
import { createInertiaApp } from "@inertiajs/inertia-vue3";
import { InertiaProgress } from "@inertiajs/progress";
import VueSweetalert2 from "vue-sweetalert2";
import VueMultiselect from "vue-multiselect";
import store from "./store/index.js";
import Datepicker from "vue3-date-time-picker";
import { QuillEditor } from "@vueup/vue-quill";

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
            .component("multiselect", VueMultiselect)
            .component("datepicker", Datepicker)
            .component("QuillEditor", QuillEditor)
            .mixin({ methods: { route } })
            .mount(el);
    },
});

InertiaProgress.init({ color: "#4B5563" });
