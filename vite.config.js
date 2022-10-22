import { defineConfig } from "vite";
import vue from "@vitejs/plugin-vue";
import laravel from "laravel-vite-plugin";

export default defineConfig({
  plugins: [vue(), laravel(["resources/js/app.js", "resources/sass/app.scss"])],
  resolve: {
    alias: {
      "~": "/resources/js",
    },
  },
});
