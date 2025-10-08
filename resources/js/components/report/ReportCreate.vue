<template>
  <PageStateWrapper
    :isLoading="isLoading"
    :hasError="hasError"
    :errorMessage="errorMessage"
    :onRetry="fetchWithState"
  >
    <form @submit.prevent="onSubmit" @keydown="form.onKeydown($event)">
      <Form :context="context" />

      <div class="flex justify-end gap-4 py-4">
        <LinkButton
          :to="{ name: 'reports.index' }"
          variant="secondary"
          customClass="min-w-[130px] px-3 sm:px-4 text-gray-700 hover:bg-gray-400"
        >
          {{ t("report.btnList") }}
        </LinkButton>

        <SubmitButton
          :busy="form.busy"
          customClass="min-w-[130px] bg-primary-500 px-3 text-white rounded-lg hover:bg-primary-600 transition duration-150 flex items-center justify-center"
        >
          <template #default>
            <Save class="w-5 h-5 mr-2" />
            {{ t("common.buttons.create") }}
          </template>

          <template #loading>
            {{ t("common.buttons.processing") }}
          </template>
        </SubmitButton>
      </div>
    </form>
  </PageStateWrapper>
</template>
  
<script setup>
import { Save } from "lucide-vue-next";
import Form from "./components/form/Edit.vue";

import { useReportStore } from "@/js/store";
import { useSwalAlerte } from "@/js/composables/useSwalAlerte";
import { usePageState } from "@/js/composables/usePageState";
import PageStateWrapper from "@/js/components/ui/PageStateWrapper.vue";

const props = defineProps({
  context: {
    type: String,
    required: false,
    default: "create",
  },
});

const store = useReportStore();
const { showSimpleAlerte } = useSwalAlerte();
const form = store.form;
store.resetForm();

const {
  isLoading,
  hasError,
  errorMessage,
  fetchData: fetchWithState,
} = usePageState(async () => await store.requirements());

const onSubmit = async () => {
  try {
    const result = await store.create();
    showSimpleAlerte({ icon: "success", text: result.message, timer: 6000 });
    window.location.href = route("users.index");
  } catch (_error) {}
};

onMounted(async () => {
  await fetchWithState();
});
</script>
  