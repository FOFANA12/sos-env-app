import { defineStore } from 'pinia';

export const useAlertStore = defineStore('alert', () => {
  const message = ref({
    type: null,
    text: null,
  });

  const hasMessage = computed(() => !!message.value.text);

  const updateMessage = (type, text) => {
    if (!type || !text) return;
    message.value = { type, text };
  };

  const resetMessage = () => {
    message.value = { type: null, text: null };
  };

  return {
    message,
    hasMessage,
    updateMessage,
    resetMessage,
  };
});
