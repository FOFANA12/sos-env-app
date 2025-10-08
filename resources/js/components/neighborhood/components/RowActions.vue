<script setup>
import { Eye, Edit, Trash } from 'lucide-vue-next';

const props = defineProps({
  row: Object,
  onView: Function,
  onEdit: Function,
  onDelete: Function,
});
</script>

<template>
  <div class="flex justify-center gap-2">
    <button
      @click="onView?.(row.id)"
      class="text-gray-500 hover:text-gray-700"
    >
      <Eye class="h-4 w-4" />
    </button>

    <button
      @click="onEdit?.(row.id)"
      class="text-primary-500 hover:text-primary-800"
    >
      <Edit class="h-4 w-4" />
    </button>

    <button
      @click="onDelete?.([row.id])"
      class="text-red-600 hover:text-red-800"
    >
      <Trash class="h-4 w-4" />
    </button>
  </div>
</template>
