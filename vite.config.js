import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";
import vue from "@vitejs/plugin-vue";
import path from "path";
import AutoImport from "unplugin-auto-import/vite";

export default defineConfig({
    plugins: [
        laravel({
            input: ["resources/css/app.css", "resources/js/app.js"],
            refresh: true,
        }),
        AutoImport({
            eslintrc: {
                enabled: true,
                filepath: "./.eslintrc-auto-import.json",
            },
            imports: ["vue", "pinia", "vue-i18n"],
            vueTemplate: true,
        }),
        vue(),
    ],
    resolve: {
        alias: {
            "@": path.resolve(__dirname, "resources"),
            vue: "vue/dist/vue.esm-bundler.js",
        },
    },
    server: {
        host: "127.0.0.1",
        port: "8000",
    },
});
