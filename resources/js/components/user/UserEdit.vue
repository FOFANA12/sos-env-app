<template>
  <PageStateWrapper
    :isLoading="isLoading"
    :hasError="hasError"
    :errorMessage="errorMessage"
    :onRetry="fetchWithState"
    class="py-6"
  >
    <form @submit.prevent="onSubmit" @keydown="form.onKeydown($event)">
      <div class="flex justify-end mb-6 gap-4">
        <LinkButton
          :to="{ name: 'users.show', params: { user: userId } }"
          variant="primary"
          customClass="min-w-[130px]"
        >
          <Eye class="w-5 h-5 mr-2" />
          {{ t("common.buttons.view") }}
        </LinkButton>
      </div>

      <Form :context="context" />

      <div class="flex justify-end gap-4">
        <LinkButton
          :to="{ name: 'users.index' }"
          variant="secondary"
          customClass="min-w-[130px] px-3 sm:px-4 text-gray-700 hover:bg-gray-400"
        >
          {{ t("user.btnList") }}
        </LinkButton>

        <SubmitButton
          :busy="form.busy"
          customClass="min-w-[130px] bg-primary-500 px-3 text-white rounded-lg hover:bg-primary-600 transition duration-150 flex items-center justify-center"
        >
          <template #default>
            <Save class="w-5 h-5 mr-2" />
            {{ t("common.buttons.save") }}
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
import { Eye, Save } from "lucide-vue-next";
import Form from "./components/form/Edit.vue";
import { route } from "ziggy-js";

import { useUserStore } from "@/js/store";
import { useSwalAlerte } from "@/js/composables/useSwalAlerte";
import { usePageState } from "@/js/composables/usePageState";
import PageStateWrapper from "@/js/components/ui/PageStateWrapper.vue";

const props = defineProps({
  context: {
    type: String,
    required: false,
    default: "edit",
  },
});

const store = useUserStore();
const { showSimpleAlerte } = useSwalAlerte();
const form = store.form;
store.resetForm();
const userId = route().params.user;

const {
  isLoading,
  hasError,
  errorMessage,
  fetchData: fetchWithState,
} = usePageState(async () => {
  await Promise.all([store.requirements(), store.find(userId, "edit")]);
});

const onSubmit = async () => {
  try {
    const result = await store.update(form.id);
    showSimpleAlerte({ icon: "success", text: result.message });
  } catch (_error) {}
};

onMounted(async () => {
  await fetchWithState();
});
</script>
  