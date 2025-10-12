<template>
  <div class="w-full mx-auto flex flex-col">
    <!-- === COVER IMAGE === -->
    <div class="relative mb-6">
      <div
        v-if="form.image_url"
        class="relative w-full aspect-[16/9] rounded-2xl overflow-hidden border border-gray-200"
      >
        <img
          :src="form.image_url"
          alt="Cover image"
          class="object-cover w-full h-full"
          @click="showPreview(form.image_url)"
        />
      </div>

      <div
        v-else
        class="w-full aspect-[16/9] border-2 border-dashed border-gray-200 rounded-2xl flex flex-col items-center justify-center text-gray-400 bg-white"
      >
        <ImageIcon class="w-14 h-14 mb-3" />
        <p class="font-medium">{{ t("common.noImage") }}</p>
      </div>
    </div>

    <!-- === GALLERY === -->
    <div class="bg-white rounded-lg mb-6 shadow-sm">
      <div class="card-header flex items-center justify-between p-4 pt-2 pb-2">
        <h3 class="text-lg">{{ t("report.sections.additionalPhotos") }}</h3>
      </div>
      <hr class="border-t border-gray-200 w-full mb-0" />
      <div class="card-body p-4">
        <div
          v-if="form.photos && form.photos.length"
          class="flex flex-wrap gap-4"
        >
          <div
            v-for="(photo, i) in form.photos"
            :key="i"
            class="relative w-36 h-36 md:w-40 md:h-40 rounded-xl overflow-hidden border border-gray-200 cursor-pointer group"
            @click="showPreview(photo.url)"
          >
            <img
              :src="photo.url"
              class="object-cover w-full h-full transition-transform duration-500 group-hover:scale-105"
              alt="Photo"
            />
          </div>
        </div>
        <div v-else class="text-gray-500 text-sm text-center py-6 italic">
          {{ t("report.noAdditionalPhotos") }}
        </div>
      </div>
    </div>

    <!-- === LOCALISATION === -->
    <div class="bg-white rounded-lg mb-6 p-4">
      <GeoLocationViewer
        ref="geoPickerRef"
        v-model="form.location"
        :label="t('report.sections.location')"
      />
    </div>

    <!-- === INFO === -->
    <div class="bg-white rounded-lg mb-4">
      <div class="card-body p-4">
        <div class="grid grid-cols-12 gap-4">
          <!-- Title -->
          <div class="col-span-12">
            <InputReadonly
              id="title"
              name="title"
              :label="t('report.form.title')"
              :modelValue="form.title"
            />
          </div>

          <!-- Region -->
          <div class="col-span-12 md:col-span-6">
            <InputReadonly
              id="region"
              name="region"
              :label="t('report.form.region')"
              :modelValue="form.region"
            />
          </div>

          <!-- Department -->
          <div class="col-span-12 md:col-span-6">
            <InputReadonly
              id="department"
              name="department"
              :label="t('report.form.department')"
              :modelValue="form.department"
            />
          </div>

          <!-- Neighborhood -->
          <div class="col-span-12 md:col-span-6">
            <InputReadonly
              id="neighborhood"
              name="neighborhood"
              :label="t('report.form.neighborhood')"
              :modelValue="form.neighborhood"
            />
          </div>

          <!-- Description -->
          <div class="col-span-12">
            <TextareaReadonly
              id="description"
              name="description"
              :label="t('report.form.description')"
              :modelValue="form.description"
              readonly
              :rows="8"
            />
          </div>
        </div>
      </div>
    </div>

    <!-- Lightbox -->
    <vue-easy-lightbox
      :visible="previewVisible"
      :imgs="previewImages"
      :index="previewIndex"
      @hide="previewVisible = false"
    />
  </div>
</template>

<script setup>
import { useReportStore } from "@/js/store";
import { ref } from "vue";
import { Image as ImageIcon } from "lucide-vue-next";
import { useI18n } from "vue-i18n";
import GeoLocationViewer from "../GeoLocationViewer.vue";
import VueEasyLightbox from "vue-easy-lightbox";

const reportStore = useReportStore();
const form = reportStore.form;

const { t } = useI18n();

const previewVisible = ref(false);
const previewImages = ref([]);
const previewIndex = ref(0);

const showPreview = (url, index = 0) => {
  previewImages.value = [url];
  previewIndex.value = index;
  previewVisible.value = true;
};
</script>

<style scoped>
:deep(.vel-modal) {
  background: rgba(0, 0, 0, 0.85);
}
</style>
