<template>
  <div class="flex flex-col lg:flex-row gap-8">
    <!-- Avatar Section -->
    <div class="lg:w-1/4">
      <div class="sticky top-20">
        <div class="relative mx-auto w-64">
          <!-- Preview -->
          <div
            class="aspect-square rounded-full overflow-hidden bg-secondary-100 ring-3 ring-white shadow-lg"
          >
            <img
              v-if="avatarPreview"
              :src="avatarPreview"
              :alt="t('common.avatar.avatarPreviewAlt')"
              class="w-full h-full object-cover"
            />
            <div
              v-else
              class="w-full h-full flex items-center justify-center text-secondary-400"
            >
              <UserRound class="h-24 w-24" />
            </div>
          </div>

          <!-- File Input (hidden) -->
          <input
            type="file"
            ref="fileInput"
            accept="image/*"
            class="hidden"
            @change="handleAvatarUpload"
          />

          <!-- Action Buttons -->
          <div
            class="absolute -bottom-4 left-1/2 transform -translate-x-1/2 flex space-x-4"
          >
            <!-- Select -->
            <button
              type="button"
              v-if="!avatarPreview"
              @click="$refs.fileInput.click()"
              class="w-10 h-10 rounded-full bg-primary-500 text-white shadow-lg hover:bg-primary-600 transition-all duration-200 flex items-center justify-center"
              :title="t('common.avatar.selectAvatar')"
            >
              <Plus class="w-5 h-5" />
            </button>

            <!-- Delete -->
            <button
              type="button"
              v-if="avatarPreview"
              @click="deleteAvatar"
              class="w-10 h-10 rounded-full bg-red-500 text-white shadow-lg hover:bg-red-600 transition-all duration-200 flex items-center justify-center"
              :title="t('common.avatar.deleteAvatar')"
            >
              <Trash class="w-5 h-5" />
            </button>
          </div>
        </div>
        <HasError
          :form="form"
          field="avatar"
          class="text-error-500 text-xs py-6"
        />
      </div>
    </div>

    <!-- Right Column -->
    <div class="lg:w-3/4">
      <div class="w-full mx-auto bg-white rounded-lg">
        <div class="card-header">
          <h2 class="text-xl p-4 pt-2 pb-2">
            {{ t("user.sections.personal") }}
          </h2>
          <hr class="border-t border-gray-200 w-full mb-0" />
        </div>
        <div class="card-body p-4">
          <div class="grid grid-cols-12 gap-4">
            <!-- Name -->
            <div class="col-span-12 md:col-span-6">
              <Input
                id="name"
                name="name"
                :label="t('user.form.name')"
                v-model="form.name"
                :placeholder="t('user.form.namePlaceholder')"
                :error="form.errors.get('name')"
                :form="form"
                required
              />
            </div>

            <!-- Email -->
            <div class="col-span-12 md:col-span-6">
              <Input
                id="email"
                name="email"
                :label="t('user.form.email')"
                v-model="form.email"
                :placeholder="t('user.form.emailPlaceholder')"
                :error="form.errors.get('email')"
                :form="form"
                required
              />
            </div>

            <!-- Phone -->
            <div class="col-span-12 md:col-span-6">
              <Input
                id="phone"
                name="phone"
                :label="t('user.form.phone')"
                v-model="form.phone"
                :placeholder="t('user.form.phonePlaceholder')"
                :error="form.errors.get('phone')"
                :form="form"
              />
            </div>

            <div class="col-span-12 md:col-span-6">
              <VSelectHeadless
                v-model="form.role"
                :options="userStore.roles"
                :label="t('user.form.role')"
                :placeholder="t('user.form.rolePlaceholder')"
                option-label="name"
                option-key="code"
                value-key="code"
                :error="form.errors.get('role')"
                :not-found-text="t('common.notResultSelect')"
                required
              />
            </div>

            <!-- Status -->
            <div class="col-span-12 md:col-span-6 flex items-center">
              <input
                id="status"
                type="checkbox"
                v-model="form.status"
                class="checkbox-primary h-5 w-5 mr-2"
              />
              <label for="status" class="text-gray-700">
                {{ t("common.form.status") }}
              </label>
            </div>
          </div>
        </div>
      </div>

      <div class="w-full mx-auto bg-white rounded-lg my-6">
        <div class="card-header">
          <h2 class="text-xl p-4 pt-2 pb-2">
            {{ t("user.sections.security") }}
          </h2>
          <hr class="border-t border-gray-200 w-full mb-0" />
        </div>
        <div class="card-body p-4">
          <div class="grid grid-cols-12 gap-4">
            <!-- Password -->
            <div class="col-span-12 md:col-span-6">
              <Input
                v-model="form.password"
                id="password"
                name="password"
                :type="showPassword ? 'text' : 'password'"
                :label="t('user.form.password')"
                :placeholder="t('user.form.passwordPlaceholder')"
                :error="form.errors.get('password')"
                :required="props.context === 'create'"
              >
                <template #action>
                  <button
                    type="button"
                    @click="togglePasswordVisibility"
                    class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-500 hover:text-gray-700"
                  >
                    <Eye v-if="!showPassword" :size="18" />
                    <EyeOff v-else :size="18" />
                  </button>
                </template>
              </Input>
            </div>

            <!-- Password Confirmation -->
            <div class="col-span-12 md:col-span-6">
              <Input
                id="password_confirmation"
                name="password_confirmation"
                :label="t('user.form.passwordConfirm')"
                v-model="form.password_confirmation"
                :placeholder="t('user.form.passwordConfirmPlaceholder')"
                :type="showConfirmPassword ? 'text' : 'password'"
                :error="form.errors.get('password_confirmation')"
                :required="props.context === 'create'"
              >
                <template #action>
                  <button
                    type="button"
                    @click="toggleConfirmPasswordVisibility"
                    class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-500 hover:text-gray-700"
                    aria-label="Toggle Password Visibility"
                  >
                    <EyeOff v-if="showConfirmPassword" :size="18" />
                    <Eye v-else :size="18" />
                  </button>
                </template>
              </Input>
            </div>
          </div>
        </div>
      </div>

      <div
        class="w-full mx-auto bg-white rounded-lg my-6"
        v-if="context !== 'create'"
      >
        <div class="card-header">
          <h2 class="text-xl p-4 pt-2 pb-2">
            {{ t("user.sections.accountActivity") }}
          </h2>
          <hr class="border-t border-gray-200 w-full mb-0" />
        </div>
        <div class="card-body p-4">
          <div class="grid grid-cols-12 gap-4">
            <!-- Terms Accepted At -->
            <div class="col-span-12 md:col-span-6">
              <InputReadonly
                id="terms_accepted_at"
                name="terms_accepted_at"
                :label="t('user.form.termsAcceptedAt')"
                :placeholder="t('user.form.termsAcceptedAt')"
                :modelValue="form.terms_accepted_at"
                readonly
              />
            </div>

            <!-- Last Login At -->
            <div class="col-span-12 md:col-span-6">
              <InputReadonly
                id="last_login_at"
                name="last_login_at"
                :label="t('user.form.lastLoginAt')"
                :placeholder="t('user.form.lastLoginAt')"
                :modelValue="form.last_login_at || '-'"
                readonly
              />
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { Eye, EyeOff, Plus, Trash, UserRound } from "lucide-vue-next";
import { useUserStore } from "@/js/store";

const userStore = useUserStore();
const form = userStore.form;

const props = defineProps({
  context: {
    type: String,
    required: false,
    default: "create",
  },
});

// Avatar preview
const avatarPreview = computed(() => form.avatar_url);
const fileInput = ref(null);

const handleAvatarUpload = (event) => {
  const file = event.target.files[0];
  if (file) {
    form.avatar = file;
    form.delete_avatar = false;

    const reader = new FileReader();
    reader.onload = (e) => {
      form.avatar_url = e.target.result;
    };
    reader.readAsDataURL(file);
  }
};

const deleteAvatar = () => {
  form.avatar = null;
  form.avatar_url = null;
  form.delete_avatar = true;
};

const showPassword = ref(false);
const showConfirmPassword = ref(false);

const togglePasswordVisibility = () => {
  showPassword.value = !showPassword.value;
};
const toggleConfirmPasswordVisibility = () => {
  showConfirmPassword.value = !showConfirmPassword.value;
};
</script>
