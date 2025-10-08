<template>
  <PageStateWrapper
    :isLoading="isLoading"
    :hasError="hasError"
    :errorMessage="errorMessage"
    :onRetry="fetchWithState"
    class="py-6"
  >
    <!-- Header zone -->
    <div
      class="w-full flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-2"
    >
      <!-- Search input -->
      <div class="flex-1">
        <DatatableSearchInput
          v-model="searchTerm"
          size="md"
          :placeholder="t('common.searchPlaceholder')"
          @search="onSearch"
        />
      </div>

      <!-- Actions -->
      <div class="flex items-center gap-3">
        <!-- Filter Button -->
        <button
          @click="showFilterPanel = !showFilterPanel"
          class="flex items-center justify-center px-4 py-2.5 border border-gray-300 rounded-lg bg-white hover:bg-gray-50 transition-colors"
        >
          <Filter class="w-5 h-5 mr-2" />
          <span class="text-sm font-medium">Filtres</span>
          <ChevronDown
            class="w-4 h-4 ml-2 transition-transform duration-200"
            :class="{ 'rotate-180': showFilterPanel }"
          />
        </button>

        <!-- Clear Filters Button (only if active filters) -->
        <button
          v-if="hasActiveFilters"
          @click="clearFilters"
          class="flex items-center justify-center px-3 py-2.5 border border-gray-300 rounded-lg bg-white hover:bg-gray-50 transition-colors text-sm text-gray-700"
        >
          <X class="w-4 h-4 mr-2" />
          Effacer
        </button>
      </div>
    </div>

    <!-- Filter Panel -->
    <div
      v-if="showFilterPanel"
      class="mb-6 bg-white border border-gray-200 rounded-xl"
    >
      <div class="card-header">
        <div class="card-header">
          <h3 class="text-xl p-4 pt-2 pb-2">
            {{ t("report.panel.title") }}
          </h3>
          <hr class="border-t border-gray-200 w-full mb-0" />
        </div>
      </div>
      <div class="card-body p-4">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
          <VSelectHeadless
            v-if="store.viewModes"
            id="viewMode"
            name="viewMode"
            v-model="selectedViewMode"
            :options="store.viewModes"
            :label="t('report.panel.viewMode')"
            :placeholder="t('report.panel.viewMode')"
            option-label="name"
            option-key="code"
            value-key="code"
          />

          <VSelectHeadless
            id="region"
            name="region"
            v-model="selectedRegion"
            @update:modelValue="onChangeRegion"
            :options="store.regions"
            :label="t('report.panel.region')"
            :placeholder="t('report.panel.region')"
            option-label="name"
            option-key="uuid"
            value-key="uuid"
            :not-found-text="t('common.notResultSelect')"
          />

          <VSelectHeadless
            id="department"
            name="department"
            v-model="selectedDepartment"
            @update:modelValue="onChangeDepartment"
            :options="filteredDepartments"
            :label="t('report.panel.department')"
            :placeholder="t('report.panel.department')"
            option-label="name"
            option-key="uuid"
            value-key="uuid"
            :not-found-text="t('common.notResultSelect')"
          />

          <VSelectHeadless
            id="neighborhood"
            name="neighborhood"
            v-model="selectedNeighborhood"
            @update:modelValue="onChangeNeighborhood"
            :options="filteredNeighborhoods"
            :label="t('report.panel.neighborhood')"
            :placeholder="t('report.panel.neighborhood')"
            option-label="name"
            option-key="uuid"
            value-key="uuid"
            :not-found-text="t('common.notResultSelect')"
          />

          <VSelectHeadless
            id="status"
            name="status"
            v-model="selectedStatus"
            :options="store.statuses"
            :label="t('report.panel.status')"
            :placeholder="t('report.panel.status')"
            option-label="name"
            option-key="code"
            value-key="code"
            :not-found-text="t('common.notResultSelect')"
          />
        </div>

        <!-- Buttons -->
        <div class="flex justify-end mt-4">
          <button
            @click="applyFilters"
            class="px-6 py-2.5 bg-primary-600 hover:bg-primary-700 text-white rounded-lg font-medium transition-colors"
          >
            Appliquer
          </button>
        </div>
      </div>
    </div>

    <!-- Grid -->
    <DataGrid
      :items="store.reports"
      :item-component="ItemCard"
      :meta="store.meta"
      @pagination-change="onPageChange"
      @delete="deleteReport"
      grid-class="grid grid-cols-1 md:grid-cols-3 xl:grid-cols-3 gap-4"
    />
  </PageStateWrapper>
</template>

<script setup>
import { Filter, ChevronDown, X } from "lucide-vue-next";
import { useReportStore } from "@/js/store";
import { usePageState } from "@/js/composables/usePageState";
import { useDatatable } from "@/js/composables/useDatatable";
import { useSwalAlerte } from "@/js/composables/useSwalAlerte";

import PageStateWrapper from "@/js/components/ui/PageStateWrapper.vue";
import DatatableSearchInput from "@/js/components/ui/DatatableSearchInput.vue";
import DataGrid from "@/js/components/ui/DataGrid.vue";
import ItemCard from "./components/ItemCard.vue";

const { t } = useI18n();

const store = useReportStore();
const { showConfirm, showSimpleAlerte, showErrorModal } = useSwalAlerte();

const { searchTerm, pagination, fetchData, onSearch, onPageChange } =
  useDatatable(store.getAll, { id: "id", desc: true }, store);

const {
  isLoading,
  hasError,
  errorMessage,
  fetchData: fetchWithState,
} = usePageState(async () => {
  await store.requirements();
  await fetchData();
});

const showFilterPanel = ref(false);

const selectedRegion = ref("");
const selectedDepartment = ref("");
const selectedNeighborhood = ref("");
const selectedStatus = ref("");
const selectedViewMode = ref("all");

const filteredDepartments = computed(() => {
  if (!selectedRegion.value) return store.departments;
  return store.departments.filter(
    (d) => d.region_uuid === selectedRegion.value
  );
});

const filteredNeighborhoods = computed(() => {
  if (selectedDepartment.value)
    return store.neighborhoods.filter(
      (n) => n.department_uuid === selectedDepartment.value
    );
  if (selectedRegion.value)
    return store.neighborhoods.filter(
      (n) => n.region_uuid === selectedRegion.value
    );
  return store.neighborhoods;
});

const hasActiveFilters = computed(() => {
  return (
    selectedRegion.value ||
    selectedDepartment.value ||
    selectedNeighborhood.value ||
    selectedStatus.value ||
    selectedViewMode.value !== "all"
  );
});

const clearFilters = async () => {
  selectedRegion.value = "";
  selectedDepartment.value = "";
  selectedNeighborhood.value = "";
  selectedStatus.value = "";
  selectedViewMode.value = "all";
  await store.applyFilters({});
};

const onChangeRegion = (uuid) => {
  selectedRegion.value = uuid;
  selectedDepartment.value = "";
  selectedNeighborhood.value = "";
};

const onChangeDepartment = (uuid) => {
  selectedDepartment.value = uuid;
  selectedNeighborhood.value = "";
};

const onChangeNeighborhood = (uuid) => {
  selectedNeighborhood.value = uuid;
};

const applyFilters = async () => {
  await store.applyFilters({
    region: selectedRegion.value,
    department: selectedDepartment.value,
    neighborhood: selectedNeighborhood.value,
    status: selectedStatus.value,
    viewMode: selectedViewMode.value,
  });
};

const resetPageAndRefresh = async (clearSearch = false) => {
  if (clearSearch) searchTerm.value = null;
  store.resetServerParams();
  pagination.value.pageIndex = store.meta.current_page - 1;
  pagination.value.pageSize = store.meta.per_page;
};

const deleteReport = async (id) => {
  const confirmationMessage = t("common.sweetalert.actions.confirmDelete");

  const confirm = await showConfirm({ message: confirmationMessage });

  if (confirm.isConfirmed) {
    try {
      const result = await store.destroy(id);
      showSimpleAlerte({ icon: "success", text: result.message });
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
