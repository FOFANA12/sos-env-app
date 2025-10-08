import { defineStore } from 'pinia';

export const useLoaderStore = defineStore('loader', () => {
  const isLoading = ref(false);
  const fullPage = ref(true);
  const canCancel = ref(false);
  const color = ref('#22c55e');
  const width = ref(100);
  const height = ref(100);

  function start(options = {}) {
    const { full = true, cancel = false } = options;

    isLoading.value = true;
    fullPage.value = full;
    canCancel.value = cancel;
  }

  function stop() {
    isLoading.value = false;
  }
  return {
    isLoading,
    fullPage,
    canCancel,
    color,
    width,
    height,
    start,
    stop,
  };
});
