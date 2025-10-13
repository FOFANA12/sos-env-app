import axios from "axios";
import { useLoaderStore } from "@/js/store";
import i18n from "@/js/i18n";

// Axios instance
const axiosInstance = axios.create({
    baseURL: `${window.location.origin}`,
    withCredentials: true,
    headers: {
        Accept: "application/json",
        "X-Requested-With": "XMLHttpRequest",
    },
});

// Request interceptor
axiosInstance.interceptors.request.use(
    (config) => {
        const loaderStore = useLoaderStore();

        // Set JSON Content-Type (except FormData)
        if (config.data && !(config.data instanceof FormData)) {
            config.headers["Content-Type"] = "application/json";
        }

        // Add current locale as query param
        config.params = config.params || {};
        config.params.locale = i18n.global.locale.value;

        loaderStore.start();
        return config;
    },
    (error) => {
        useLoaderStore().stop();
        return Promise.reject(error);
    }
);

// Response interceptor
axiosInstance.interceptors.response.use(
    (response) => {
        useLoaderStore().stop();
        return response;
    },
    (error) => {
        useLoaderStore().stop();

        if (error.response?.status === 401) {
            window.location.href = 'login';
        }

        return Promise.reject(error);
    }
);

export default axiosInstance;
