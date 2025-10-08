<template>
  <PageStateWrapper
    :isLoading="isLoading"
    :hasError="hasError"
    :errorMessage="errorMessage"
    :onRetry="fetchWithState"
    class="py-6"
  >
    <!-- Action buttons -->
    <div class="flex justify-end gap-4">
      <Button
        v-if="selectedRows.length > 0"
        :icon="Trash"
        variant="danger-outline"
        customClass="sm:px-4"
        @click="() => deleteRows(selectedRows)"
      >
        {{ t("common.buttons.delete") }} ({{ selectedRows.length }})
      </Button>

      <LinkButton
        :to="{ name: 'users.create' }"
        :icon="Plus"
        variant="primary"
        customClass="sm:px-4"
      >
        {{ t("user.btnAdd") }}
      </LinkButton>
    </div>

    <!-- Search -->
    <div class="w-full md:w-1/2 relative mb-6">
      <DatatableSearchInput
        v-model="searchTerm"
        size="md"
        :placeholder="t('common.searchPlaceholder')"
        @search="onSearch"
      />
    </div>

    <!-- DataTable -->
    <DataTable
      :columns="columns"
      :data="store.users"
      :meta="store.meta"
      @pagination-change="onPageChange"
      @sorting-change="onSortChange"
      @row-selection-change="onRowSelectionChange"
      :resetSelectionKey="resetSelectionKey"
    />
  </PageStateWrapper>
</template>
  
  <script setup>
import { Plus, Trash } from "lucide-vue-next";

import { useUserStore } from "@/js/store";
import { usePageState } from "@/js/composables/usePageState";
import { useDatatable } from "@/js/composables/useDatatable";
import { useSwalAlerte } from "@/js/composables/useSwalAlerte";

import PageStateWrapper from "@/js/components/ui/PageStateWrapper.vue";
import { getColumns } from "./components/DataTableColumns";

const { t } = useI18n();
const store = useUserStore();

const { showConfirm, showSimpleAlerte, showErrorModal } = useSwalAlerte();

const {
  searchTerm,
  selectedRows,
  resetSelectionKey,
  pagination,
  fetchData,
  onSearch,
  onPageChange,
  onSortChange,
  onRowSelectionChange,
} = useDatatable(store.getAll, { id: "id", desc: true }, store);

const {
  isLoading,
  hasError,
  errorMessage,
  fetchData: fetchWithState,
} = usePageState(fetchData);

const columns = getColumns({
  t,
  onView: (id) => {
    window.location.href = route("users.show", { user: id });
  },
  onEdit: (id) => {
    window.location.href = route("users.edit", { user: id });
  },
  onDelete: (ids) => deleteRows(ids),
});

const resetPageAndRefresh = async (clearSearch = false) => {
  if (clearSearch) searchTerm.value = null;
  store.resetServerParams();
  pagination.value.pageIndex = store.meta.current_page - 1;
  pagination.value.pageSize = store.meta.per_page;
};

const deleteRows = async (ids) => {
  const isMultiple = Array.isArray(ids) && ids.length > 1;
  const confirmationMessage = isMultiple
    ? t("common.sweetalert.actions.confirmDeleteSelected")
    : t("common.sweetalert.actions.confirmDelete");

  const confirm = await showConfirm({ message: confirmationMessage });

  if (confirm.isConfirmed) {
    try {
      const result = await store.destroy(ids);
      showSimpleAlerte({ icon: "success", text: result.message });
      resetSelectionKey.value++;
      selectedRows.value = [];
      await resetPageAndRefresh(true);
      await fetchData();
    } catch (error) {
      showErrorModal({
        title: t("common.errors.serverErrorTitle"),
        message:
          error.response?.data?.message ??
          t("common.errors.defaultErrorMessage"),
      });
    }
  }
};

onMounted(async () => {
  await resetPageAndRefresh(true);
  await fetchWithState();
});
</script>
  