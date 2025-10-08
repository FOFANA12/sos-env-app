<template>
  <div
    class="bg-white rounded-xl md:rounded-2xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-xl hover:-translate-y-1 transition-all duration-300 cursor-pointer group h-full flex flex-col"
    @click="$emit('click', item)"
  >
    <!-- Image Container -->
    <div class="relative h-40 md:h-48 overflow-hidden">
      <!-- Image -->
      <img
        v-if="item.image_url"
        :src="item.image_url"
        :alt="item.title || item.name"
        class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500"
        loading="lazy"
        decoding="async"
      />
      <div
        v-else
        class="flex flex-col items-center justify-center h-full text-gray-400 bg-gray-100"
      >
        <ImageIcon class="w-12 h-12 mb-2" />
        <span class="text-sm text-gray-500">{{ t("common.noImage") }}</span>
      </div>

      <!-- Status Badge intégré -->
      <div v-if="item.status" class="absolute top-4 left-4">
        <span
          class="px-3 py-1 rounded-full text-xs font-semibold text-white shadow-sm"
          :style="{ backgroundColor: item.status.color }"
        >
          {{ item.status.label }}
        </span>
      </div>

      <!-- Delete Button -->
      <div class="absolute top-4 right-4">
        <button
          @click.stop="handleDelete"
          class="w-8 h-8 bg-white/90 backdrop-blur-sm rounded-full flex items-center justify-center shadow-sm hover:bg-red-50 transition-colors"
        >
          <TrashIcon class="w-4 h-4 text-red-500" />
        </button>
      </div>
    </div>

    <!-- Content -->
    <div class="p-4 flex-1 flex flex-col">
      <h3
        class="font-bold text-gray-900 mb-2 group-hover:text-primary-600 transition-colors line-clamp-2 text-base md:text-lg"
      >
        {{ item.title }}
      </h3>
      <p class="text-sm text-gray-600 mb-4 line-clamp-3 flex-1 leading-relaxed">
        {{ item.description }}
      </p>

      <!-- Location and Date -->
      <div class="space-y-1 md:space-y-2">
        <div
          v-if="item.location"
          class="flex items-center text-sm text-gray-500"
        >
          <MapPinIcon class="w-3 h-3 md:w-4 md:h-4 mr-2 flex-shrink-0" />
          <span class="truncate">{{ item.location }}</span>
        </div>
        <div
          v-if="item.created_at"
          class="flex items-center text-sm text-gray-500"
        >
          <ClockIcon class="w-3 h-3 md:w-4 md:h-4 mr-2 flex-shrink-0" />
          <span>{{ item.created_at }}</span>
        </div>

        <div
          v-if="item.user"
          class="flex items-center pt-3 border-t border-gray-100"
          :title="item.user"
        >
          <div
            class="w-7 h-7 md:w-8 md:h-8 bg-gradient-to-br from-primary-500 to-accent-500 rounded-full flex items-center justify-center flex-shrink-0"
          >
            <span class="text-xs font-semibold text-white">
              {{ item.user.charAt(0).toUpperCase() }}
            </span>
          </div>
          <span
            class="ml-2 text-sm font-medium text-gray-700 truncate max-w-[120px] md:max-w-[150px]"
          >
            {{ item.user }}
          </span>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import {
  ClockIcon,
  Image as ImageIcon,
  MapPinIcon,
  Trash2 as TrashIcon,
} from "lucide-vue-next";

const props = defineProps({
  item: { type: Object, required: true },
  onDelete: { type: Function, default: null },
});

const emit = defineEmits(["click", "delete"]);

const handleDelete = (e) => {
  e.stopPropagation();
  props.onDelete?.([props.item.id]);
};
</script>

<style scoped>
.line-clamp-2 {
  display: -webkit-box;
  -webkit-line-clamp: 2;
  -webkit-box-orient: vertical;
  overflow: hidden;
}
.line-clamp-3 {
  display: -webkit-box;
  -webkit-line-clamp: 3;
  -webkit-box-orient: vertical;
  overflow: hidden;
}
</style>
