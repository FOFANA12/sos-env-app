<template>
  <div>
    <!-- Table -->
    <div class="overflow-x-auto border border-gray-200 rounded-md">
      <table class="min-w-full divide-y divide-gray-200 text-sm">
        <thead class="bg-gray-50">
          <tr v-for="hg in table.getHeaderGroups()" :key="hg.id">
            <th
              v-for="header in hg.headers"
              :key="header.id"
              :class="[
                'px-3 py-2 text-left font-medium text-gray-700',
                header.column.getCanSort() ? 'cursor-pointer select-none' : '',
              ]"
              @click="(event) => handleHeaderClick(header, event)"
            >
              <div class="flex items-center justify-between w-full">
                <FlexRender :render="header.column.columnDef.header" :props="header.getContext()" />
                <span v-if="header.column.getCanSort()">
                  <component
                    :is="
                      {
                        asc: ChevronUp,
                        desc: ChevronDown,
                      }[header.column.getIsSorted()] || ChevronsUpDown
                    "
                    :class="[
                      'ml-2 h-4 w-4',
                      header.column.getIsSorted() ? 'text-primary-600' : 'text-gray-400',
                    ]"
                  />
                </span>
              </div>
            </th>
          </tr>
        </thead>
        <tbody class="divide-y divide-gray-200">
          <!-- no data -->
          <tr v-if="!table.getRowModel().rows.length">
            <td :colspan="columns.length" class="text-center text-gray-500 px-4 py-6 bg-white">
              {{ t('common.datatable.noDataAvailable') }}
            </td>
          </tr>
          <!-- data rows -->
          <tr
            v-for="row in table.getRowModel().rows"
            :key="row.id"
            class="bg-white hover:bg-gray-100"
            :class="rowClass ? rowClass(row.original) : ''"
          >
            <td
              v-for="cell in row.getVisibleCells()"
              :key="cell.id"
              class="whitespace-nowrap px-3 py-2"
            >
              <FlexRender :render="cell.column.columnDef.cell" :props="cell.getContext()" />
            </td>
          </tr>
        </tbody>
      </table>
    </div>

    <!-- Pagination footer -->
    <div class="mt-4 mb-2 flex items-center justify-between text-sm">
      <!-- Rows per page -->
      <div class="flex items-center">
        <label class="mr-2">{{ t('common.datatable.rowsPerPage') }}</label>
        <select
          v-model.number="pagination.pageSize"
          @change="onPageSizeChange"
          class="border border-gray-300 rounded-full px-3 py-1 text-sm focus:outline-none"
        >
          <option :value="10">10</option>
          <option :value="20">20</option>
          <option :value="50">50</option>
          <option :value="100">100</option>
          <option :value="200">200</option>
          <!-- <option :value="-1">{{ t('common.datatable.dropdownAll') }}</option> -->
        </select>
      </div>

      <!-- Page buttons + info -->
      <div class="flex items-center justify-end gap-2">
        <span v-if="showPaginationInfo">
          {{ t('common.datatable.paginationInfo', paginationArgs) }}
        </span>
        <button
          class="border border-gray-300 rounded-full h-7 w-7 flex items-center justify-center transition-colors duration-150 hover:bg-gray-100 hover:border-gray-300 disabled:opacity-50 disabled:cursor-not-allowed disabled:bg-gray-50 disabled:hover:bg-transparent disabled:hover:border-gray-300"
          @click="goToPage(props.meta.current_page - 1)"
          :disabled="props.meta.current_page <= 1"
        >
          <ChevronLeft class="h-4 w-4" />
        </button>
        <button
          class="border border-gray-300 rounded-full h-7 w-7 flex items-center justify-center transition-colors duration-150 hover:bg-gray-100 hover:border-gray-300 disabled:opacity-50 disabled:cursor-not-allowed disabled:bg-gray-50 disabled:hover:bg-transparent disabled:hover:border-gray-300"
          @click="goToPage(props.meta.current_page + 1)"
          :disabled="props.meta.current_page >= props.meta.last_page"
        >
          <ChevronRight class="h-4 w-4" />
        </button>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, computed, watch } from 'vue';
import { useI18n } from 'vue-i18n';
import {
  useVueTable,
  getCoreRowModel,
  getSortedRowModel,
  getPaginationRowModel,
  FlexRender,
} from '@tanstack/vue-table';
import { ChevronLeft, ChevronRight, ChevronUp, ChevronDown, ChevronsUpDown } from 'lucide-vue-next';

const props = defineProps({
  columns: { type: Array, required: true },
  data: { type: Array, required: true },
  meta: { type: Object, required: true },
  resetSelectionKey: { type: [Number, String], default: 0 },
  rowClass: {
    type: Function,
    default: null,
  },
});

const emit = defineEmits(['pagination-change', 'sorting-change', 'row-selection-change']);
const { t } = useI18n();

const sorting = ref([]);
const pagination = ref({
  pageIndex: props.meta.current_page - 1,
  pageSize: props.meta.per_page,
});
const rowSelection = ref({});

const paginationArgs = computed(() => ({
  from: props.meta.from ?? 0,
  to: props.meta.to ?? 0,
  total: props.meta.total,
}));

const showPaginationInfo = computed(() => props.meta.total > 0);

// Table instance (no manualPagination here: onFetch is called manually)
const table = useVueTable({
  sortDescFirst: false,
  getRowId: (row) => row.id,
  get data() {
    return props.data;
  },
  get columns() {
    return props.columns;
  },
  state: {
    get sorting() {
      return sorting.value;
    },
    get pagination() {
      return pagination.value;
    },
    get rowSelection() {
      return rowSelection.value;
    },
  },
  manualSorting: true,
  manualPagination: true,
  enableRowSelection: true,
  getCoreRowModel: getCoreRowModel(),
  getSortedRowModel: getSortedRowModel(),
  getPaginationRowModel: getPaginationRowModel(),
  onSortingChange: (updaterOrValue) => {
    sorting.value =
      typeof updaterOrValue === 'function' ? updaterOrValue(sorting.value) : updaterOrValue;
  },
  onRowSelectionChange: (updateOrValue) => {
    rowSelection.value =
      typeof updateOrValue === 'function' ? updateOrValue(rowSelection.value) : updateOrValue;

    const ids = table.getSelectedRowModel().rows.map((r) => r.original.id);
    emit('row-selection-change', ids);
  },
});

watch(
  () => pagination.value,
  (val) => {
    emit('pagination-change', val);
  },
  { deep: true }
);
watch(
  () => sorting.value,
  (val) => {
    emit('sorting-change', val);
  },
  { deep: true }
);

const goToPage = (pageNumber) => {
  const last = props.meta.last_page;
  if (pageNumber < 1 || pageNumber > last) return;
  pagination.value.pageIndex = pageNumber - 1;
};

const onPageSizeChange = (e) => {
  const pageSize = Number(e.target.value);
  pagination.value.pageIndex = 0;
  pagination.value.pageSize = pageSize;
};

const handleHeaderClick = (header, event) => {
  if (!header.column.getCanSort()) return;

  const toggleFn = header.column.getToggleSortingHandler();
  if (typeof toggleFn === 'function') {
    toggleFn(event);
  }
};

watch(
  [
    () => table.getState().pagination,
    () => table.getState().sorting,
    () => props.resetSelectionKey,
  ],
  () => {
    table.resetRowSelection();
  },
  { deep: true }
);

watch(
  () => props.meta,
  (meta) => {
    pagination.value.pageIndex = meta.current_page - 1;
    pagination.value.pageSize = meta.per_page;
  },
  { immediate: true, deep: true }
);
</script>
