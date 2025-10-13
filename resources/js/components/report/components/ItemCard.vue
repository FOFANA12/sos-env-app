<template>
  <div
    class="bg-white rounded-xl md:rounded-2xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-xl hover:-translate-y-1 transition-all duration-300 cursor-pointer group h-full flex flex-col"
  >
    <!-- Image Container -->
    <a
      :href="route('reports.show', { report: item.id })"
      class="relative h-40 md:h-48 overflow-hidden"
    >
      <img
        v-if="item.image_url"
        :src="item.image_url"
        :alt="t('report.imageAlt')"
        class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500"
        loading="lazy"
      />
      <div
        v-else
        class="flex flex-col items-center justify-center h-full text-gray-400 bg-gray-100"
      >
        <ImageIcon class="w-12 h-12 mb-2" />
        <span class="text-sm text-gray-500">{{ t("common.noImage") }}</span>
      </div>

      <!-- Status badge -->
      <div v-if="item.status" class="absolute top-4 left-4">
        <span
          class="px-3 py-1 rounded-full text-xs font-semibold text-white shadow-sm"
          :style="{ backgroundColor: item.status.color }"
        >
          {{ item.status.label }}
        </span>
      </div>
    </a>

    <!-- Content -->
    <div class="p-4 flex-1 flex flex-col justify-between">
      <div>
        <h3
          class="font-bold text-gray-900 mb-2 group-hover:text-primary-600 transition-colors line-clamp-2 text-base md:text-lg"
        >
          {{ item.title }}
        </h3>
        <p
          class="text-sm text-gray-600 mb-4 line-clamp-3 flex-1 leading-relaxed"
        >
          {{ item.description }}
        </p>

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
        </div>
      </div>

      <!-- Actions -->
      <div
        class="flex justify-end items-center gap-2 mt-4 pt-3 border-t border-gray-100"
      >
        <!-- View -->
        <a
          :href="route('reports.show', { report: item.id })"
          class="p-2 rounded-full hover:bg-gray-100 transition-colors"
        >
          <EyeIcon class="w-4 h-4 text-gray-600" />
        </a>

        <!-- Edit -->
        <!-- <a
          :href="route('reports.edit', { report: item.id })"
          class="p-2 rounded-full hover:bg-gray-100 transition-colors"
        >
          <Edit class="w-4 h-4 text-primary-600" />
        </a> -->

        <!-- Delete -->
        <button
          v-if="canDelete"
          @click.stop="handleDelete"
          class="p-2 rounded-full hover:bg-red-50 transition-colors"
        >
          <TrashIcon class="w-4 h-4 text-red-600" />
        </button>
      </div>
    </div>
  </div>
</template>

<script setup>
import {
  ClockIcon,
  Image as ImageIcon,
  MapPinIcon,
  Eye as EyeIcon,
  Trash2 as TrashIcon,
  Edit,
} from "lucide-vue-next";
import { route } from "ziggy-js";
import { useAuthStore } from "@/js/store";
import { inject } from 'vue';

const { t } = useI18n();

const authUser = inject('authUser');
const props = defineProps({
  item: { type: Object, required: true },
});

const emit = defineEmits(["view", "edit", "delete"]);

const handleDelete = (e) => {
  e.stopPropagation();
  emit("delete", [props.item.id]);
};

// // Droits
// const canEdit = computed(() => {
//   const user = authStore.user;
//   if (!user) return false;
//   return user.role === "admin" || props.item.created_by === user.uuid;
// });

const canDelete = computed(() => {
  const user = authUser;
  if (!user) return false;

  const isAdmin = user.role === "admin";
  const isAuthor = props.item.user?.uuid === user.uuid;
  const isPending = props.item.status?.code === "pending";

  return (isAdmin || isAuthor) && isPending;
});
</script>
