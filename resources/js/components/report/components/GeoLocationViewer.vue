<template>
  <div class="w-full flex flex-col gap-3">
    <!-- === HEADER === -->
    <div class="flex items-center">
      <label class="font-medium text-gray-800">
        {{ label }}
      </label>
    </div>

    <!-- === GOOGLE MAP === -->
    <div class="relative rounded-xl overflow-hidden border border-gray-200">
      <!-- Map Loading Placeholder -->
      <div
        v-if="!mapLoaded"
        class="w-full h-[480px] flex flex-col items-center justify-center bg-gray-50"
      >
        <div
          class="animate-spin rounded-full h-12 w-12 border-4 border-primary-600 border-t-transparent mb-4"
        ></div>
        <p class="text-gray-600 font-medium">
          {{ t("report.maps.loadingText") }}
        </p>
        <p class="text-sm text-gray-500 mt-2">
          {{ t("report.maps.loadingPleaseWait") }}
        </p>
      </div>

      <GMapMap
        v-show="mapLoaded"
        ref="mapRef"
        :center="center"
        :zoom="zoom"
        style="width: 100%; height: 480px"
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
        <span class="text-gray-500">{{ t('report.maps.latitude') }}</span>
        <p class="text-gray-800 font-medium">
          {{ internalLat ? internalLat.toFixed(5) : "—" }}
        </p>
      </div>
      <div>
        <span class="text-gray-500">{{ t('report.maps.longitude') }}</span>
        <p class="text-gray-800 font-medium">
          {{ internalLng ? internalLng.toFixed(5) : "—" }}
        </p>
      </div>
    </div>
  </div>
</template>

<script setup>
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


const zoom = ref(15);
const center = ref({ lat: 18.0735, lng: -15.9582 });
const marker = ref(null);
const internalLat = ref(null);
const internalLng = ref(null);
const loading = ref(false);
const mapLoaded = ref(false);
const mapRef = ref(null);

onMounted(() => {
  nextTick(() => {
    setTimeout(() => {
      mapLoaded.value = true;

      if (props.modelValue?.lat && props.modelValue?.lng) {
        updatePosition(props.modelValue.lat, props.modelValue.lng, true);
      }
    }, 500);
  });
});

/**
 * Update marker position and optionally recenter map
 */
const updatePosition = (lat, lng, shouldCenter = false) => {
  marker.value = { lat, lng };
  internalLat.value = lat;
  internalLng.value = lng;

  if (shouldCenter && mapRef.value?.$mapObject) {
    nextTick(() => {
      mapRef.value.$mapObject.panTo({ lat, lng });
    });
  }
};


/**
 * Sync external model changes
 */
watch(
  () => props.modelValue,
  (val) => {
    if (
      !val ||
      (val.lat === internalLat.value && val.lng === internalLng.value)
    )
      return;
    updatePosition(val.lat, val.lng, true);
  },
  { deep: true }
);

/**
 * Expose updatePosition for parent component
 */
defineExpose({
  updatePosition,
});
</script>
