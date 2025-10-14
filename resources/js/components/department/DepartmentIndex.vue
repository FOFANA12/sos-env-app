<template>
  <PageStateWrapper
    :isLoading="isLoading"
    :hasError="hasError"
    :errorMessage="errorMessage"
    :onRetry="fetchWithState"
    class="py-6"
  >
   
    <!-- Action buttons -->
    <div class="flex justify-end gap-4 mb-6 md:mb-0">
      <Button
        v-if="selectedRows.length > 0"
        :icon="Trash"
        variant="danger-outline"
        customClass="sm:px-4"
        @click="() => deleteRows(selectedRows)"
      >
        {{ t("common.buttons.delete") }} ({{ selectedRows.length }})
      </Button>

      <Button
        :icon="Plus"
        variant="primary"
        customClass="sm:px-4"
        @click="openCreateModal"
      >
        {{ t("department.btnAdd") }}
      </Button>
    </div>

    <!-- Search -->
    <div class="w-full md:w-1/2 relative mb-2">
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
      :data="store.departments"
      :meta="store.meta"
      @pagination-change="onPageChange"
      @sorting-change="onSortChange"
      @row-selection-change="onRowSelectionChange"
      :resetSelectionKey="resetSelectionKey"
    />

    <!-- Modal -->
    <Modal ref="modal" @success="handleSuccess" />
  </PageStateWrapper>
</template>


<script setup>
import { Plus, Trash } from "lucide-vue-next";

import { usePageState } from "@/js/composables/usePageState";
import { useDatatable } from "@/js/composables/useDatatable";
import { useSwalAlerte } from "@/js/composables/useSwalAlerte";

import PageStateWrapper from "@/js/components/ui/PageStateWrapper.vue";
import Modal from "./components/Modal.vue";
import { getColumns } from "./components/DataTableColumns";
import { useDepartmentStore } from "@/js/store";

const { t } = useI18n();
const store = useDepartmentStore();
const { showConfirm, showSimpleAlerte, showErrorModal } = useSwalAlerte();
const modal = ref(null);

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
  onView: (id) => openViewModal(id),
  onEdit: (id) => openEditModal(id),
  onDelete: (ids) => deleteRows(ids),
});

const resetPageAndRefresh = async (clearSearch = false) => {
  if (clearSearch) searchTerm.value = null;
  store.resetServerParams();
  pagination.value.pageIndex = store.meta.current_page - 1;
  pagination.value.pageSize = store.meta.per_page;
};

const handleSuccess = async (result) => {
  resetSelectionKey.value++;
  selectedRows.value = [];
  await resetPageAndRefresh(true);
  await fetchData();
  showSimpleAlerte({ icon: "success", text: result.message });
};

const openCreateModal = () => modal.value.openCreateModal();
const openEditModal = (id) => modal.value.openEditModal(id);
const openViewModal = (id) => modal.value.openViewModal(id);

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

