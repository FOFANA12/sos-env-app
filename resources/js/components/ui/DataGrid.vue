<template>
  <!-- No data state -->
  <div
    v-if="!items.length"
    class="flex items-center justify-center w-full min-h-[400px] animate-fade-in"
  >
    <div
      class="w-full max-w-lg p-8 rounded-xl border border-gray-200 bg-white/80 backdrop-blur-sm text-center"
    >
      <div class="space-y-6">
        <!-- Ghost Icon with blur background -->
        <div class="relative">
          <div
            class="absolute inset-0 flex items-center justify-center blur-lg opacity-50"
          >
            <Search class="h-24 w-24 text-gray-400" />
          </div>
          <div class="relative flex justify-center animate-fade-in">
            <Search class="h-24 w-24 text-gray-400" />
          </div>
        </div>

        <!-- Title -->
        <div class="space-y-2 animate-fade-in">
          <h2 class="text-xl font-semibold text-gray-800">
            {{ t("common.datatable.noDataAvailable") }}
          </h2>
        </div>
      </div>
    </div>
  </div>

  <!-- Grid -->
  <div v-else :class="gridClass">
    <component
      v-for="item in items"
      :key="item.uuid || item.id"
      :is="itemComponent"
      :item="item"
      @delete="handleDeleteItem"
    />
  </div>

  <!-- Pagination footer -->
  <div
    v-if="items.length"
    class="mt-4 mb-2 flex items-center justify-between text-sm border-t border-gray-100 pt-3"
  >
    <!-- Rows per page -->
    <div class="flex items-center">
      <label class="mr-2 text-gray-600">{{
        t("common.datatable.rowsPerPage")
      }}</label>
      <select
        v-model.number="pagination.pageSize"
        @change="onPageSizeChange"
        class="border border-gray-300 rounded-full px-3 py-1 text-sm focus:outline-none"
      >
        <option :value="25">25</option>
        <option :value="50">50</option>
        <option :value="100">100</option>
      </select>
    </div>

    <!-- Pagination info + buttons -->
    <div class="flex items-center justify-end gap-2 text-gray-600">
      <span v-if="showPaginationInfo">
        {{ meta.from }}–{{ meta.to }} / {{ meta.total }}
      </span>

      <button
        class="border border-gray-300 rounded-full h-7 w-7 flex items-center justify-center transition-colors duration-150 hover:bg-gray-100 disabled:opacity-50 disabled:cursor-not-allowed"
        @click="goToPage(meta.current_page - 1)"
        :disabled="meta.current_page <= 1"
      >
        <ChevronLeft class="h-4 w-4" />
      </button>

      <button
        class="border border-gray-300 rounded-full h-7 w-7 flex items-center justify-center transition-colors duration-150 hover:bg-gray-100 disabled:opacity-50 disabled:cursor-not-allowed"
        @click="goToPage(meta.current_page + 1)"
        :disabled="meta.current_page >= meta.last_page"
      >
        <ChevronRight class="h-4 w-4" />
      </button>
    </div>
  </div>
</template>

<script setup>
import { ref, computed, watch } from "vue";
import { useI18n } from "vue-i18n";
import { ChevronLeft, ChevronRight, Search } from "lucide-vue-next";

const props = defineProps({
  items: {
    type: Array,
    required: true,
  },
  itemComponent: {
    type: Object,
    required: true,
  },
  meta: {
    type: Object,
    required: true,
  },
  gridClass: {
    type: String,
    default: "grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6",
  },
});

const emit = defineEmits(["pagination-change", "delete"]);
const { t } = useI18n();

const pagination = ref({
  pageIndex: props.meta.current_page - 1,
  pageSize: props.meta.per_page,
});

watch(
  () => props.meta,
  (meta) => {
    pagination.value.pageIndex = meta.current_page - 1;
    pagination.value.pageSize = meta.per_page;
  },
  { immediate: true, deep: true }
);

const showPaginationInfo = computed(() => props.meta.total > 0);

const onPageSizeChange = (e) => {
  const pageSize = Number(e.target.value);
  pagination.value = {
    pageIndex: 0,
    pageSize,
  };
  emit("pagination-change", pagination.value);
};

const goToPage = (pageNumber) => {
  const last = props.meta.last_page;
  if (pageNumber < 1 || pageNumber > last) return;

  pagination.value = {
    ...pagination.value,
    pageIndex: pageNumber - 1,
  };
  emit("pagination-change", pagination.value);
};

const handleDeleteItem = (id) => {
  emit("delete", id);
};
</script>

<style scoped>
.animate-fade-in {
  animation: fadeIn 0.3s ease-in-out;
}

@keyframes fadeIn {
  from {
    opacity: 0;
  }
  to {
    opacity: 1;
  }
}
</style>
