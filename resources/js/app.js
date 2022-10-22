import { createApp, h } from "vue";
import DefaultLayout from "~/layouts/default.vue";
import { InertiaProgress } from "@inertiajs/progress";
import { createInertiaApp } from "@inertiajs/inertia-vue3";
import { ZiggyVue } from "../../vendor/tightenco/ziggy/dist/vue.m";
import { resolvePageComponent } from "laravel-vite-plugin/inertia-helpers";

// toast notification
import VueToast from "vue-toast-notification";
import "vue-toast-notification/dist/theme-sugar.css";

// my own package
import Modal from "~/plugins/@rizkhal/modal";
import Inertable from "~/plugins/@rizkhal/inertable-vue";

createInertiaApp({
  resolve: async (name) => {
    const page = await resolvePageComponent(`./pages/${name}.vue`, import.meta.glob("./pages/**/*.vue"));

    if (page.default.layout === undefined) {
      page.default.layout = DefaultLayout;
    }

    return page;
  },
  setup({ el, app, props, plugin }) {
    createApp({ render: () => h(app, props) })
      .use(plugin)
      .use(Modal)
      .use(Inertable)
      .use(ZiggyVue, Ziggy)
      .use(VueToast)
      .mount(el);
  },
});

InertiaProgress.init({ color: "#4B5563" });
