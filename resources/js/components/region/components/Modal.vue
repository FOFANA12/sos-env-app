<template>
  <CustomModal
    size="md"
    :isModalOpen="isModalOpen"
    @update:isModalOpen="closeModal"
  >
    <template #title>
      <h2 class="text-md font-semibold">{{ modalTitle }}</h2>
    </template>

    <template #body>
      <form
        @submit.prevent="onSubmit"
        @keyup.enter="onSubmit"
        @keydown="form.onKeydown($event)"
      >
        <div class="grid grid-cols-12 gap-6">
          <!-- Name -->
          <div class="col-span-12">
            <InputReadonly
              v-if="isReadOnly"
              id="name"
              name="name"
              :label="t('region.form.name')"
              :placeholder="t('region.form.namePlaceholder')"
              :modelValue="form.name"
              readonly
            />
            <Input
              v-else
              id="name"
              name="name"
              v-model="form.name"
              :label="t('region.form.name')"
              :placeholder="t('region.form.namePlaceholder')"
              :error="form.errors.get('name')"
              :form="form"
              required
            />
          </div>

          <!-- Status -->
          <div class="col-span-12 flex items-center">
            <input
              id="status"
              type="checkbox"
              v-model="form.status"
              :disabled="isReadOnly"
              class="checkbox-primary h-5 w-5 mr-2 disabled:checkbox-disabled disabled:!bg-gray-100"
            />
            <label for="status" class="text-gray-700">
              {{ t("common.form.status") }}
            </label>
          </div>
        </div>
      </form>
    </template>

    <template #buttons>
      <div class="flex gap-4 items-center">
        <Button
          v-if="!isReadOnly"
          variant="secondary"
          customClass="min-w-[130px] bg-gray-300 text-gray-700 px-3 rounded-lg hover:bg-gray-400 transition-all flex justify-center"
          @click="closeModal"
        >
          {{ t("common.buttons.cancel") }}
        </Button>

        <Button
          v-if="!isReadOnly"
          variant="primary"
          customClass="min-w-[130px] bg-primary-500 text-white px-3 rounded-lg hover:bg-primary-600 transition-all flex justify-center"
          @click="onSubmit"
          type="submit"
        >
          {{
            context === "create"
              ? t("common.buttons.create")
              : t("common.buttons.save")
          }}
        </Button>

        <Button
          v-else
          variant="secondary"
          customClass="min-w-[130px] bg-gray-300 text-gray-700 px-3 rounded hover:bg-gray-400 transition-all flex justify-center"
          @click="closeModal"
        >
          {{ t("common.buttons.close") }}
        </Button>
      </div>
    </template>
  </CustomModal>
</template>

<script setup>
import { useRegionStore } from "@/js/store";

const store = useRegionStore();
const { t } = useI18n();
const emit = defineEmits(["success"]);

const form = store.form;
const isModalOpen = ref(false);
const context = ref("create");

const isReadOnly = computed(() => context.value === "view");
const modalTitle = computed(() => {
  switch (context.value) {
    case "create":
      return t("region.modalTitleCreation");
    case "edit":
      return t("region.modalTitleModification");
    case "view":
    default:
      return t("region.modalTitleOverview");
  }
});

const closeModal = () => {
  isModalOpen.value = false;
};

const onSubmit = async () => {
  closeModal();
  try {
    const result =
      context.value === "create"
        ? await store.create()
        : await store.update(form.id);
    onSuccess(result);
  } catch (error) {
    onError(error);
  }
};

const onSuccess = (result) => {
  store.resetForm();
  closeModal();
  emit("success", result);
};

const onError = (error) => {
  console.error("Error submitting form:", error);
  isModalOpen.value = true;
};

const openCreateModal = async () => {
  context.value = "create";
  store.resetForm();
  isModalOpen.value = true;
};

const openEditModal = async (id) => {
  context.value = "edit";
  store.resetForm();

  try {
    await store.find(id);
    isModalOpen.value = true;
  } catch (err) {
    console.error("Failed to open edit modal:", err);
  }
};

const openViewModal = async (id) => {
  context.value = "view";
  store.resetForm();

  try {
    await store.find(id);
    isModalOpen.value = true;
  } catch (err) {
    console.error("Failed to open view modal:", err);
  }
};

defineExpose({ openCreateModal, openEditModal, openViewModal });
</script>
