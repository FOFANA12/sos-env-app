export function useDatatable(fetchFn, defaultSort = { id: 'id', desc: true }) {
  const searchTerm = ref('');
  const selectedRows = ref([]);
  const resetSelectionKey = ref(0);
  const sorting = ref([]);
  const pagination = ref({
    pageIndex: 0,
    pageSize: 10,
  });

  const fetchData = async () => {
    selectedRows.value = [];
    const sort = sorting.value[0] || defaultSort;

    await fetchFn({
      pageIndex: pagination.value.pageIndex,
      pageSize: pagination.value.pageSize,
      sortBy: sort.id,
      sortOrder: sort.desc ? 'desc' : 'asc',
      searchTerm: searchTerm.value,
    });
  };

  const onSearch = async () => {
    pagination.value.pageIndex = 0;
    resetSelectionKey.value++;
    await fetchData();
  };

  const onPageChange = async ({ pageIndex, pageSize }) => {
    pagination.value = { pageIndex, pageSize };
    await fetchData();
  };

  const onSortChange = async (newSorting) => {
    sorting.value = newSorting;
    pagination.value.pageIndex = 0;
    await fetchData();
  };

  const onRowSelectionChange = (ids) => {
    selectedRows.value = ids;
  };

  return {
    searchTerm,
    selectedRows,
    resetSelectionKey,
    sorting,
    pagination,
    fetchData,
    onSearch,
    onPageChange,
    onSortChange,
    onRowSelectionChange,
  };
}
