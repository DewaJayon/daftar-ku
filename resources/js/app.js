import "../css/app.css";
import "../css/styles.css";
import "./bootstrap";
import "./app-template";

import { createInertiaApp } from "@inertiajs/vue3";
import { resolvePageComponent } from "laravel-vite-plugin/inertia-helpers";
import { createApp, h } from "vue";
import { ZiggyVue } from "../../vendor/tightenco/ziggy";

import DataTablesLib from "datatables.net-bs5";
import DataTable from "datatables.net-vue3";
DataTable.use(DataTablesLib);

import VueApexCharts from "vue3-apexcharts";

const appName = import.meta.env.VITE_APP_NAME || "Laravel";

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) =>
        resolvePageComponent(
            `./Pages/${name}.vue`,
            import.meta.glob("./Pages/**/*.vue")
        ),
    setup({ el, App, props, plugin }) {
        return createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(ZiggyVue)
            .use(VueApexCharts)
            .component("DataTable", DataTable)
            .mount(el);
    },
    progress: {
        color: "#4B5563",
    },
});
