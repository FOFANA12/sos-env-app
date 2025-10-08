<template>
  <div class="w-full flex flex-col gap-3">
    <!-- === HEADER === -->
    <div class="flex justify-between items-center">
      <label class="font-medium text-gray-800">
        {{ label || t("report.form.location") }}
      </label>

      <div class="flex items-center gap-3">
        <!-- Reset -->
        <button
          v-if="marker"
          type="button"
          @click="resetLocation"
          class="text-sm text-red-600 hover:text-red-700 flex items-center gap-1"
          :disabled="loading"
        >
          <Trash class="w-4 h-4" />
          {{ t("report.labelResetMyLocation") }}
        </button>

        <!-- Use my location -->
        <button
          type="button"
          @click="useMyLocation"
          :disabled="loading"
          class="text-sm text-primary-600 hover:text-primary-700 flex items-center gap-1 disabled:opacity-60"
        >
          <MapPin class="w-4 h-4" />
          {{ t("report.labelUseMyLocation") }}
        </button>
      </div>
    </div>

    <!-- === GOOGLE MAP === -->
    <div class="relative rounded-xl overflow-hidden border border-gray-200">
      <GMapMap
        ref="mapRef"
        :center="center"
        :zoom="zoom"
        style="width: 100%; height: 480px"
        @click="handleMapClick"
        :options="{
          streetViewControl: false,
          mapTypeControl: true,
          fullscreenControl: true,
          zoomControl: true,
        }"
      >
        <GMapMarker v-if="marker" :position="marker" />
      </GMapMap>

      <!-- Loader overlay -->
      <div
        v-if="loading"
        class="absolute inset-0 flex items-center justify-center bg-white/70 z-10"
      >
        <div
          class="animate-spin rounded-full h-8 w-8 border-2 border-primary-600 border-t-transparent"
        ></div>
      </div>
    </div>

    <!-- === COORDINATES === -->
    <div class="grid grid-cols-2 gap-4 text-xs mt-1">
      <div>
        <span class="text-gray-500">{{ t("report.form.latitude") }}</span>
        <p class="text-gray-800 font-medium">
          {{ internalLat ? internalLat.toFixed(5) : "—" }}
        </p>
      </div>
      <div>
        <span class="text-gray-500">{{ t("report.form.longitude") }}</span>
        <p class="text-gray-800 font-medium">
          {{ internalLng ? internalLng.toFixed(5) : "—" }}
        </p>
      </div>
    </div>
  </div>
</template>

<script setup>
import { MapPin, Trash } from "lucide-vue-next";
import { ref, watch, nextTick, onMounted } from "vue";
import { useI18n } from "vue-i18n";

const props = defineProps({
  modelValue: {
    type: Object,
    default: () => ({ lat: null, lng: null }),
  },
  label: {
    type: String,
    default: null,
  },
});

const emit = defineEmits(["update:modelValue"]);
const { t } = useI18n();

const zoom = ref(15);
const center = ref({ lat: 18.0735, lng: -15.9582 });
const marker = ref(null);
const internalLat = ref(null);
const internalLng = ref(null);
const loading = ref(false);
const mapRef = ref(null);

// === Lifecycle ===
onMounted(() => {
  if (props.modelValue?.lat && props.modelValue?.lng) {
    updatePosition(props.modelValue.lat, props.modelValue.lng, true);
  } else {
    const consent = localStorage.getItem("allowGeolocation");
    if (consent === "true") useMyLocation();
  }
});

/**
 * Update marker position and optionally recenter map
 */
const updatePosition = (lat, lng, shouldCenter = false) => {
  marker.value = { lat, lng };
  internalLat.value = lat;
  internalLng.value = lng;
  emit("update:modelValue", { lat, lng });

  if (shouldCenter && mapRef.value?.$mapObject) {
    nextTick(() => {
      mapRef.value.$mapObject.panTo({ lat, lng });
    });
  }
};

/**
 * Handle map click → move marker without recentering
 */
const handleMapClick = (e) => {
  updatePosition(e.latLng.lat(), e.latLng.lng(), false);
};

/**
 * Get user's current location
 */
const useMyLocation = () => {
  if (!navigator.geolocation) {
    alert(t("report.form.geolocNotSupported"));
    return;
  }

  loading.value = true;
  navigator.geolocation.getCurrentPosition(
    (pos) => {
      const { latitude, longitude } = pos.coords;
      updatePosition(latitude, longitude, true);
      loading.value = false;
    },
    (err) => {
      console.warn(err);
      alert(t("report.form.geolocFailed"));
      loading.value = false;
    },
    { enableHighAccuracy: true, timeout: 10000 }
  );
};

/**
 * Reset marker position
 */
const resetLocation = () => {
  marker.value = null;
  internalLat.value = null;
  internalLng.value = null;
  emit("update:modelValue", { lat: null, lng: null });
};

/**
 * Sync external model changes
 */
watch(
  () => props.modelValue,
  (val) => {
    if (!val || (val.lat === internalLat.value && val.lng === internalLng.value)) return;
    updatePosition(val.lat, val.lng, true);
  },
  { deep: true }
);

</script>
