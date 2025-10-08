import { defineStore } from "pinia";
import { ref } from "vue";
import { endpoints } from "@/js/api/endpoints";
import api from "@/js/api/axios";
import Form from "vform";

export const useAuthStore = defineStore("auth", () => {
    const isAuthenticated = ref(!!window.currentUser);
    const user = ref(window.currentUser || null);
    const form = ref(new Form({}));

    const setUser = (newUser) => {
        user.value = newUser;
        isAuthenticated.value = !!newUser;
    };

    const resetForm = () => {
        form.value.clear();
        form.value.errors.clear();
        form.value.reset();
        form.value.busy = false;
    };

    const register = async () => {
        form.value.clear();
        form.value.busy = true;

        try {
            const resp = await api.post(
                endpoints.auth.register,
                form.value.data()
            );
            return resp;
        } catch (error) {
            form.value.errors.set(error.response.data?.errors);
            throw error;
        } finally {
            form.value.busy = false;
        }
    };

    const login = async () => {
        form.value.clear();
        form.value.busy = true;

        try {
            const resp = await api.post(
                endpoints.auth.login,
                form.value.data()
            );
            setUser(resp.data.user);
            return resp;
        } catch (error) {
            form.value.errors.set(error.response.data?.errors);
            setUser(null);
            throw error;
        } finally {
            form.value.busy = false;
        }
    };

    const forgetPassword = async () => {
        form.value.clear();
        form.value.busy = true;

        try {
            const resp = await api.post(
                endpoints.auth.forgotPassword,
                form.value.data()
            );
            form.value.reset();
            form.value.clear();
            return resp;
        } catch (error) {
            form.value.errors.set(error.response.data?.errors);
            throw error;
        } finally {
            form.value.busy = false;
        }
    };

    const resetPassword = async () => {
        form.value.clear();
        form.value.busy = true;

        try {
            const resp = await api.post(
                endpoints.auth.resetPassword,
                form.value.data()
            );
            return resp;
        } catch (error) {
            form.value.errors.set(error.response.data?.errors);
            throw error;
        } finally {
            form.value.busy = false;
        }
    };

    const logout = async () => {
        try {
            const resp = await api.post(endpoints.auth.logout);
            setUser(null);
            return resp;
        } catch (error) {
            throw error;
        }
    };

    return {
        isAuthenticated,
        user,
        form,
        register,
        setUser,
        login,
        forgetPassword,
        resetPassword,
        logout,
        resetForm,
    };
});
