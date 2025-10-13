<template>
  <PageStateWrapper
    :isLoading="isLoading"
    :hasError="hasError"
    :errorMessage="errorMessage"
    :onRetry="fetchWithState"
     class="py-6"
  >
    <form @submit.prevent="onSubmit" @keydown="form.onKeydown($event)">
      <div class="flex justify-end gap-4 mb-6">
        <LinkButton
          :to="{ name: 'reports.create' }"
          variant="primary"
          class="min-w-[130px]"
        >
          <Plus class="w-5 h-5 mr-2" />
          {{ t("report.btnAdd") }}
        </LinkButton>
      </div>

      <Form />

      <div class="flex justify-end gap-4 py-4">
        <LinkButton
          :to="{ name: 'reports.index' }"
          variant="secondary"
          customClass="min-w-[130px] px-3 sm:px-4 text-gray-700 hover:bg-gray-400"
        >
          {{ t("report.btnList") }}
        </LinkButton>

        <!-- <LinkButton
          :to="{ name: 'reports.edit', params: { id: reportId } }"
          variant="primary"
          class="min-w-[130px]"
        >
          <Edit class="w-5 h-5 mr-2" />
          {{ t("common.buttons.edit") }}
        </LinkButton> -->
      </div>
    </form>
  </PageStateWrapper>
</template>
  
<script setup>
import Form from "./components/form/View.vue";
import { Edit, Plus } from "lucide-vue-next";
import { route } from "ziggy-js";

import { useReportStore } from "@/js/store";
import { usePageState } from "@/js/composables/usePageState";
import PageStateWrapper from "@/js/components/ui/PageStateWrapper.vue";

const store = useReportStore();
const form = store.form;
store.resetForm();
const reportId = route().params.report;

const {
  isLoading,
  hasError,
  errorMessage,
  fetchData: fetchWithState,
} = usePageState(async () => store.find(reportId, "view"));

onMounted(async () => {
  await fetchWithState();
});
</script>
  