import { useI18n } from 'vue-i18n';
export function usePageState(fetchFn) {
  const isLoading = ref(true);
  const hasError = ref(false);
  const errorMessage = ref('');

  const { t } = useI18n();
  
  const fetchData = async () => {
    isLoading.value = true;
    hasError.value = false;
    errorMessage.value = '';

    try {
      await fetchFn();
    } catch (error) {
      console.log(error)
      hasError.value = true;
      errorMessage.value = error?.message || t('common.errors.defaultErrorMessage');
    } finally {
      isLoading.value = false;
    }
  };

  return {
    isLoading,
    hasError,
    errorMessage,
    fetchData,
  };
}
