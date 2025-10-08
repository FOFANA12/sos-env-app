<template>
  <div class="w-full mx-auto flex flex-col">
    <!-- === COVER IMAGE === -->
    <div class="relative group mb-6">
      <div
        v-if="imagePreview"
        class="relative w-full aspect-[16/9] rounded-2xl overflow-hidden border border-gray-200"
      >
        <img
          :src="imagePreview"
          alt="Cover preview"
          class="object-cover w-full h-full transition-transform duration-500 group-hover:scale-105 cursor-pointer"
          @click="showPreview(imagePreview)"
        />
        <div
          class="absolute inset-0 bg-black/0 group-hover:bg-black/30 transition-colors duration-300"
        ></div>

        <div
          class="absolute top-3 right-3 flex items-center gap-2 opacity-0 group-hover:opacity-100 transition-opacity duration-300"
        >
          <button
            @click="deleteImage"
            type="button"
            class="bg-red-600 hover:bg-red-700 text-white rounded-full p-2 shadow-md transition"
          >
            <Trash class="w-4 h-4" />
          </button>

          <button
            type="button"
            @click="fileInput.click()"
            class="bg-white/90 hover:bg-white text-gray-800 rounded-full p-2 shadow-md transition"
          >
            <ImageIcon class="w-4 h-4" />
          </button>

          <button
            type="button"
            @click="showPreview(imagePreview)"
            class="bg-primary-600 hover:bg-primary-700 text-white rounded-full p-2 shadow-md transition"
          >
            <Eye class="w-4 h-4" />
          </button>
        </div>
      </div>

      <!-- === Empty state === -->
      <div
        v-else
        class="w-full aspect-[16/9] border-2 border-dashed border-gray-300 rounded-2xl flex flex-col items-center justify-center text-center cursor-pointer bg-white hover:bg-gray-50 transition"
        @click="fileInput.click()"
      >
        <ImageIcon class="w-14 h-14 text-gray-400 mb-3" />
        <p class="text-gray-500 font-medium">
          {{ t("report.form.coverUploadText") }}
        </p>
        <p class="text-sm text-gray-400 mt-1">
          {{ t("report.form.coverUploadHint") }}
        </p>
      </div>

      <input
        ref="fileInput"
        type="file"
        accept="image/*"
        capture="environment"
        class="hidden"
        @change="handleImageUpload"
      />
      <p v-if="form.errors.get('image')" class="text-red-500 text-xs mt-1">
        {{ form.errors.get("image") }}
      </p>
    </div>

    <div v-if="uploadMessage" class="my-1 text-sm text-amber-600 font-medium">
      {{ uploadMessage }}
    </div>

    <!-- === DETAIL IMAGES === -->
    <div class="bg-white rounded-lg mb-6">
      <div class="card-header flex items-center justify-between p-4 pt-2 pb-2">
        <h3 class="text-lg">
          {{ t("report.sections.additionalPhotos") }}
        </h3>
        <span class="text-sm text-gray-400">
          ({{ form.photos.length }}/3)
        </span>
      </div>
      <hr class="border-t border-gray-200 w-full mb-0" />

      <div class="card-body p-4">
        <div class="flex flex-wrap gap-4">
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
            <button
              type="button"
              @click.stop="removePhoto(i)"
              class="absolute top-2 right-2 bg-red-600 text-white rounded-full p-1.5 shadow opacity-0 group-hover:opacity-100 transition"
            >
              <Trash class="w-4 h-4" />
            </button>
          </div>

          <button
            v-if="form.photos.length < 3"
            @click="galleryInput.click()"
            type="button"
            class="w-36 h-36 md:w-40 md:h-40 flex flex-col items-center justify-center border-2 border-dashed border-gray-300 rounded-xl text-gray-500 hover:bg-gray-50 transition"
          >
            <Plus class="w-6 h-6 mb-1" />
            <span class="text-xs font-medium">
              {{ t("report.form.addPhoto") }}
            </span>
          </button>
        </div>

        <input
          ref="galleryInput"
          type="file"
          accept="image/*"
          capture="environment"
          multiple
          class="hidden"
          @change="handleGalleryUpload"
        />

        <p class="text-xs text-gray-400 mt-3 text-center">
          {{ t("report.form.photoHint") }}
        </p>
      </div>
    </div>

    <!-- === LOCALISATION === -->
    <div class="bg-white rounded-lg mb-6 p-4 shadow-sm">
      <GeoLocationPicker
        ref="geoPicker"
        v-model="form.location"
        :label="t('report.form.locationLabel')"
      />
    </div>

    <!-- === FORM INFO === -->
    <div class="bg-white rounded-lg mb-4">
      <div class="card-body p-4">
        <div class="grid grid-cols-12 gap-4">
          <div class="col-span-12">
            <Input
              id="title"
              name="title"
              :label="t('report.form.title')"
              v-model="form.title"
              :placeholder="t('report.form.titlePlaceholder')"
              :error="form.errors.get('title')"
              :form="form"
              required
            />
          </div>

          <div class="col-span-12 md:col-span-6">
            <VSelectHeadless
              v-model="form.region"
              :options="reportStore.regions"
              :label="t('report.form.region')"
              :placeholder="t('report.form.regionPlaceholder')"
              option-label="name"
              option-key="uuid"
              value-key="uuid"
              :error="form.errors.get('region')"
              :not-found-text="t('common.notResultSelect')"
              required
            />
          </div>

          <div class="col-span-12 md:col-span-6">
            <VSelectHeadless
              v-model="form.department"
              :options="filteredDepartments"
              :label="t('report.form.department')"
              :placeholder="t('report.form.departmentPlaceholder')"
              option-label="name"
              option-key="uuid"
              value-key="uuid"
              :error="form.errors.get('department')"
              :not-found-text="t('common.notResultSelect')"
            />
          </div>

          <div class="col-span-12 md:col-span-6">
            <VSelectHeadless
              v-model="form.neighborhood"
              :options="filteredNeighborhoods"
              :label="t('report.form.neighborhood')"
              :placeholder="t('report.form.neighborhoodPlaceholder')"
              option-label="name"
              option-key="uuid"
              value-key="uuid"
              :error="form.errors.get('neighborhood')"
              :not-found-text="t('common.notResultSelect')"
            />
          </div>

          <div class="col-span-12">
            <Textarea
              id="description"
              name="description"
              v-model="form.description"
              :label="t('report.form.description')"
              :placeholder="t('report.form.descriptionPlaceholder')"
              :error="form.errors.get('description')"
              :form="form"
              :rows="10"
              required
            />
          </div>
        </div>
      </div>
    </div>

    <vue-easy-lightbox
      :visible="previewVisible"
      :imgs="previewImages"
      :index="previewIndex"
      @hide="previewVisible = false"
    />
  </div>
</template>

<script setup>
import { Trash, Image as ImageIcon, Plus, Eye } from "lucide-vue-next";
import { useReportStore } from "@/js/store";
import { ref, computed, onMounted } from "vue";
import VueEasyLightbox from "vue-easy-lightbox";
import GeoLocationPicker from "../GeoLocationPicker.vue";
import { useI18n } from "vue-i18n";

const { t } = useI18n();
const reportStore = useReportStore();
const form = reportStore.form;

const imagePreview = computed(() => form.image_url);
const fileInput = ref(null);
const galleryInput = ref(null);
const uploadMessage = ref("");
const previewVisible = ref(false);
const previewImages = ref([]);
const previewIndex = ref(0);
const geoPicker = ref(null);

const props = defineProps({
  context: {
    type: String,
    required: false,
    default: "create",
  },
});

onMounted(() => {
  if (props.context === "create" && navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(
      (pos) => {
        const { latitude, longitude } = pos.coords;
        form.location = { lat: latitude, lng: longitude };

        if (geoPicker.value?.updatePosition) {
          geoPicker.value.updatePosition(latitude, longitude);
        }
      },
      (err) => {
        console.warn("Géolocalisation refusée ou impossible :", err);
      },
      { enableHighAccuracy: true, timeout: 10000 }
    );
  }
});

const showPreview = (url, index = 0) => {
  previewImages.value = [url];
  previewIndex.value = index;
  previewVisible.value = true;
};

const handleImageUpload = (event) => {
  const file = event.target.files[0];
  if (!file) return;
  if (file.size > 10 * 1024 * 1024) {
    uploadMessage.value =
      "L'image dépasse 10 Mo. Merci de choisir un fichier plus léger.";
    return;
  }
  form.image = file;
  form.image_url = URL.createObjectURL(file);
  form.delete_image = false;
};

const deleteImage = () => {
  form.image = null;
  form.image_url = null;
  form.delete_image = true;
  uploadMessage.value = "";
};

const handleGalleryUpload = (event) => {
  const files = Array.from(event.target.files).slice(0, 3 - form.photos.length);
  files.forEach((file) => {
    const url = URL.createObjectURL(file);
    form.photos.push({ file, url });
  });
};

const removePhoto = (index) => {
  form.photos.splice(index, 1);
};

const filteredDepartments = computed(() => {
  if (!form.region) return reportStore.departments;
  return reportStore.departments.filter((d) => d.region_uuid === form.region);
});

const filteredNeighborhoods = computed(() => {
  if (form.department)
    return reportStore.neighborhoods.filter(
      (n) => n.department_uuid === form.department
    );
  if (form.region)
    return reportStore.neighborhoods.filter(
      (n) => n.region_uuid === form.region
    );
  return reportStore.neighborhoods;
});
</script>

<style scoped>
:deep(.vel-modal) {
  background: rgba(0, 0, 0, 0.85);
}
</style>
