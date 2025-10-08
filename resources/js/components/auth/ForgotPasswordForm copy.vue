<template>
  <div class="min-h-screen relative overflow-hidden">
    <!-- Background Design -->
    <div
      class="absolute inset-0 bg-gradient-to-br from-green-50 via-blue-50 to-green-100"
    >
      <div class="absolute inset-0">
        <!-- Floating shapes -->
        <div
          class="absolute top-20 left-20 w-32 h-32 bg-green-200/20 rounded-full animate-pulse"
        ></div>
        <div
          class="absolute top-40 right-32 w-24 h-24 bg-blue-200/30 rounded-full animate-bounce"
          style="animation-delay: 1s"
        ></div>
        <div
          class="absolute bottom-32 left-32 w-40 h-40 bg-green-300/20 rounded-full animate-pulse"
          style="animation-delay: 2s"
        ></div>
        <div
          class="absolute bottom-20 right-20 w-28 h-28 bg-blue-300/30 rounded-full animate-bounce"
          style="animation-delay: 0.5s"
        ></div>
        <div
          class="absolute top-60 left-1/4 w-16 h-16 bg-green-200/25 rounded-full animate-pulse"
          style="animation-delay: 1.5s"
        ></div>
        <div
          class="absolute top-80 right-1/4 w-20 h-20 bg-blue-200/25 rounded-full animate-bounce"
          style="animation-delay: 2.5s"
        ></div>
        <div
          class="absolute top-32 left-1/2 w-8 h-8 bg-green-300/30 rounded-full animate-ping"
        ></div>
        <div
          class="absolute bottom-40 left-1/3 w-6 h-6 bg-blue-300/30 rounded-full animate-ping"
          style="animation-delay: 1s"
        ></div>
        <div
          class="absolute top-1/2 right-1/3 w-10 h-10 bg-green-200/25 rounded-full animate-ping"
          style="animation-delay: 2s"
        ></div>
      </div>
    </div>

    <div
      class="relative z-10 min-h-screen flex flex-col items-center justify-center px-4 sm:px-6 lg:px-8 py-6"
    >
      <div
        v-if="alert.type && alert.message"
        class="w-full max-w-screen-sm sm:max-w-screen-md md:max-w-screen-lg lg:max-w-screen-lg mb-6 sm:mb-20"
      >
        <Alert
          :type="alert.type"
          :message="alert.message"
          @close="handleCloseAlert"
        />
      </div>

      <div class="w-full max-w-md">
        <!-- Logo mobile -->
        <div class="flex justify-center mb-6 sm:hidden">
          <img :src="logo" alt="Logo" class="h-16 object-contain" />
        </div>

        <div
          class="relative bg-white rounded-3xl shadow-sm border border-gray-100 px-8 py-6 sm:mt-12"
        >
          <!-- Logo desktop -->
          <div
            class="absolute -top-12 left-1/2 transform -translate-x-1/2 hidden sm:flex h-24 w-24 bg-white rounded-2xl items-center justify-center shadow-sm border border-gray-100"
          >
            <img :src="logo" alt="Logo" class="w-16 h-16 object-contain" />
          </div>

          <div class="mb-6 sm:mt-8">
            <h1 class="text-2xl font-bold text-gray-900">
              {{ t("forgotPassword.title") }}
            </h1>
            <p class="text-gray-600 text-sm">
              {{ t("forgotPassword.subtitle") }}
            </p>
          </div>

          <form @submit.prevent="handleSubmit" class="space-y-6">
            <!-- Email -->
            <Input
              id="email"
              name="email"
              type="email"
              v-model="form.email"
              :label="t('forgotPassword.form.email')"
              :placeholder="t('forgotPassword.form.emailPlaceholder')"
              :error="form.errors.get('email')"
              required
              autocomplete="email"
              inputClass="w-full pl-9 pr-4 py-2.5 rounded-lg text-sm text-gray-800 bg-transparent border focus:outline-none"
            >
              <template #icon>
                <span
                  class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-500"
                >
                  <Mail :size="18" />
                </span>
              </template>
            </Input>

            <div class="flex justify-center">
              <SubmitButton
                :busy="form.busy"
                block
                customClass="w-full sm:w-8/12 bg-primary-500 py-2.5 text-white rounded-lg hover:bg-primary-600 transition duration-150 flex items-center justify-center"
              >
                <template #default>
                  <Send class="w-5 h-5 mr-2" />
                  {{ t("forgotPassword.form.btnSubmit") }}
                </template>

                <template #loading>
                  {{ t("common.buttons.processing") }}
                </template>
              </SubmitButton>
            </div>
          </form>

          <div class="mt-6 text-center">
            <p class="text-sm text-gray-600">
              {{ t("forgotPassword.form.alreadyHaveAccount") }}
              <a
                :href="route('login')"
                class="font-semibold text-primary-600 hover:text-primary-500"
              >
                {{ t("forgotPassword.form.loginLink") }}
              </a>
            </p>
          </div>
        </div>

        <div class="mt-6">
          <a
            :href="route('home')"
            class="inline-flex items-center gap-1 text-sm font-medium text-primary-600 hover:text-primary-500"
          >
            <ArrowLeft class="w-4 h-4" /> {{ t("common.links.backHome") }}
          </a>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
const logo = "/images/logo.png";
import { useAuthStore } from "@/js/store";
import { ArrowLeft, Mail, Send } from "lucide-vue-next";
import { route } from "ziggy-js";

const store = useAuthStore();
const form = store.form;
store.resetForm();
form.email = null;
form.clear();

const alert = ref({ type: null, message: null });

const handleCloseAlert = () => {
  alert.value = { type: null, message: null };
};

const handleSubmit = async () => {
  form.clear();
  alert.value = { type: null, message: null };

  try {
    const resp = await store.forgetPassword();
    alert.value = { type: "success", message: resp.data.message };
  } catch (error) {
    if (error?.response?.status !== 422 && error?.response?.data?.message) {
      alert.value = {
        type: "error",
        message:
          error?.response?.data?.message ||
          t("common.errors.forgotPasswordFailed"),
      };
    }
  }
};
</script>
