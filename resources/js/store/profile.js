import { defineStore } from 'pinia';
import { ref } from 'vue';
import { endpoints } from '@/js/api/endpoints';
import api from '@/js/api/axios';
import Form from 'vform';

export const useProfileStore = defineStore('profile', () => {
  const form = ref(
    new Form({
      avatar: null,
      avatar_url: null,
      delete_avatar: null,
    })
  );

  const getProfile = async () => {
    try {
      const response = await api.get(endpoints.profile.getProfile);
      const user = response.data.user;
      Object.assign(form.value, user);
      return response.data;
    } catch (err) {
      throw err;
    }
  };

  const updateProfile = async () => {
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
      formData.append('_method', 'PUT');

      const response = await api.post(endpoints.profile.updateProfile, formData, {
        headers: {
          'Content-Type': 'multipart/form-data',
        },
      });

      resetForm();
      const user = response.data.user;
      Object.assign(form.value, user);
      return response.data;
    } catch (error) {
      form.value.errors.set(error.response?.data?.errors || {});
      if (error?.response?.data) throw error.response.data;
      throw { message: 'Failed to update profil.' };
    } finally {
      form.value.busy = false;
    }
  };

  const resetForm = () => {
    form.value.clear();
    form.value.errors.clear();
    form.value.reset();
    form.value.busy = false;
  };

  return {
    form,
    getProfile,
    updateProfile,
    resetForm,
  };
});
