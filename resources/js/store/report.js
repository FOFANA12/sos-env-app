import { defineStore } from "pinia";
import { endpoints } from "@/js/api/endpoints";
import api from "@/js/api/axios";
import Form from "vform";

export const useReportStore = defineStore("report", () => {
    const reports = ref([]);
    const regions = ref([]);
    const departments = ref([]);
    const neighborhoods = ref([]);
    const statuses = ref([]);
    const viewModes = ref([]);

    const form = ref(
        new Form({
            region: null,
            department: null,
            neighborhood: null,
            title: "",
            description: "",
            address: null,
            image: null,
            image_url: null,
            delete_image: null,
            status: "pending",
            photos: [],
            location: { lat: null, lng: null },
        })
    );

    const serverParams = reactive({
        pageIndex: 0,
        pageSize: 50,
        sortBy: "id",
        sortOrder: "desc",
        searchTerm: "",
        region: null,
        department: null,
        neighborhood: null,
        status: null,
        viewMode: null,
    });

    const meta = ref({
        current_page: 1,
        per_page: 50,
        total: 0,
        last_page: 1,
        from: 0,
        to: 0,
    });

    const getAll = async ({
        pageIndex = serverParams.pageIndex,
        pageSize = serverParams.pageSize,
        sortBy = serverParams.sortBy,
        sortOrder = serverParams.sortOrder,
        searchTerm = serverParams.searchTerm,
        region = serverParams.region,
        department = serverParams.department,
        neighborhood = serverParams.neighborhood,
        status = serverParams.status,
        viewMode = serverParams.viewMode,
    } = {}) => {
        reports.value = [];

        Object.assign(serverParams, {
            pageIndex,
            pageSize,
            sortBy,
            sortOrder,
            searchTerm,
            region,
            department,
            neighborhood,
            status,
            viewMode,
        });

        const params = {
            page: pageIndex + 1,
            perPage: pageSize,
            sortBy,
            sortOrder,
            searchTerm,
            region,
            department,
            neighborhood,
            status,
            viewMode,
        };

        const { data } = await api.get(endpoints.report.getAll, { params });
        reports.value = data.data;
        meta.value = data.meta;
    };

    const find = async (id, mode = "edit") => {
        try {
            const response = await api.get(endpoints.report.find(id, mode));
            Object.assign(form.value, response.data.report);
            return response.data;
        } catch (error) {
            if (error?.response?.data) throw error.response.data;
            throw { message: "Unable to fetch report." };
        }
    };

    const create = async () => {
        form.value.clear();
        form.value.busy = true;
        try {
            const formData = new FormData();
            for (const [key, value] of Object.entries(form.value.data())) {
                if (value == null) continue;

                if (key === "location" && value.lat && value.lng) {
                    formData.append("latitude", value.lat);
                    formData.append("longitude", value.lng);
                    continue;
                }

                if (value instanceof File) {
                    formData.append(key, value);
                    continue;
                }

                if (Array.isArray(value)) {
                    if (key === "photos") {
                        value.forEach((photo, i) => {
                            if (photo.file instanceof File) {
                                formData.append(`photos[${i}]`, photo.file);
                            } else if (photo.url) {
                                formData.append(`photos[${i}]`, photo.url);
                            }
                        });
                    } else {
                        formData.append(key, JSON.stringify(value));
                    }
                    continue;
                }

                formData.append(key, value);
            }

            const response = await api.post(endpoints.report.create, formData, {
                headers: { "Content-Type": "multipart/form-data" },
            });

            return response.data;
        } catch (error) {
            form.value.errors.set(error.response?.data?.errors || {});
            if (error?.response?.data) throw error.response.data;
            throw { message: "Failed to create report." };
        } finally {
            form.value.busy = false;
        }
    };

    const update = async (id) => {
        form.value.clear();
        form.value.busy = true;
        try {
            const formData = new FormData();
            for (const [key, value] of Object.entries(form.value.data())) {
                if (value == null) continue;

                if (value instanceof File) {
                    formData.append(key, value);
                } else if (Array.isArray(value)) {
                    formData.append(key, JSON.stringify(value));
                } else {
                    formData.append(key, value);
                }
            }

            formData.append("_method", "PUT");

            const response = await api.post(
                endpoints.report.update(id),
                formData,
                {
                    headers: {
                        "Content-Type": "multipart/form-data",
                    },
                }
            );

            resetForm();
            Object.assign(form.value, response.data.user);

            return response.data;
        } catch (error) {
            form.value.errors.set(error.response?.data?.errors || {});
            if (error?.response?.data) throw error.response.data;
            throw { message: "Failed to update report." };
        } finally {
            form.value.busy = false;
        }
    };

    const destroy = async (id) => {
        try {
            const response = await api.post(endpoints.report.destroy, { ids: [id] });
            return response.data;
        } catch (error) {
            if (error?.response?.data) throw error.response.data;
            throw { message: "Failed to delete users." };
        }
    };

    const requirements = async () => {
        regions.value = [];
        departments.value = [];
        neighborhoods.value = [];
        statuses.value = [];
        viewModes.value = [];

        try {
            const { data } = await api.get(endpoints.report.requirements);
            regions.value = data.regions;
            departments.value = data.departments;
            neighborhoods.value = data.neighborhoods;
            statuses.value = data.statuses;
            viewModes.value = data.view_modes;

            return data;
        } catch (error) {
            throw { message: "Failed to load requirements." };
        }
    };

    const resetForm = () => {
        form.value.clear();
        form.value.errors.clear();
        form.value.reset();
        form.value.busy = false;
    };

    const resetServerParams = () => {
        Object.assign(serverParams, {
            pageIndex: 0,
            pageSize: 50,
            sortBy: "id",
            sortOrder: "desc",
            searchTerm: "",
        });

        meta.value = {
            current_page: 1,
            per_page: 50,
            total: 0,
            last_page: 1,
            from: 0,
            to: 0,
        };
    };

    const applyFilters = async (filters = {}) => {
        Object.assign(serverParams, {
            region: filters.region || null,
            department: filters.department || null,
            neighborhood: filters.neighborhood || null,
            status: filters.status || null,
            viewMode: filters.viewMode || null,
            pageIndex: 0,
        });

        await getAll();
    };

    return {
        reports,
        regions,
        departments,
        neighborhoods,
        statuses,
        viewModes,
        form,
        meta,
        serverParams,
        getAll,
        applyFilters,
        find,
        create,
        update,
        destroy,
        requirements,
        resetForm,
        resetServerParams,
    };
});
