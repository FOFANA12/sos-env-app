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
              {{ t("register.title") }}
            </h1>
            <p class="text-gray-600 text-sm">
              {{ t("register.subtitle") }}
            </p>
          </div>

          <form @submit.prevent="handleSubmit" class="space-y-6">
            <!-- Email -->
            <Input
              id="email"
              name="email"
              type="email"
              v-model="form.email"
              :label="t('register.form.email')"
              :placeholder="t('register.form.emailPlaceholder')"
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

            <!-- Password -->
            <Input
              id="password"
              name="password"
              :type="showPassword ? 'text' : 'password'"
              v-model="form.password"
              :label="t('register.form.password')"
              :placeholder="t('register.form.passwordPlaceholder')"
              :error="form.errors.get('password')"
              required
              autocomplete="new-password"
              inputClass="w-full pl-9 pr-4 py-2.5 rounded-lg text-sm text-gray-800 bg-transparent border focus:outline-none"
            >
              <template #icon>
                <Lock
                  class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-500"
                  :size="18"
                />
              </template>

              <template #action>
                <button
                  type="button"
                  @click="togglePasswordVisibility"
                  class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-500 hover:text-gray-700"
                >
                  <EyeOff v-if="showPassword" :size="18" />
                  <Eye v-else :size="18" />
                </button>
              </template>
            </Input>

            <!-- Password confirmation -->
            <Input
              id="password_confirmation"
              name="password_confirmation"
              :type="showPasswordConfirmation ? 'text' : 'password'"
              v-model="form.password_confirmation"
              :label="t('register.form.confirmPassword')"
              :placeholder="t('register.form.confirmPasswordPlaceholder')"
              :error="form.errors.get('password_confirmation')"
              required
              autocomplete="new-password"
              inputClass="w-full pl-9 pr-4 py-2.5 rounded-lg text-sm text-gray-800 bg-transparent border focus:outline-none"
            >
              <template #icon>
                <Lock
                  class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-500"
                  :size="18"
                />
              </template>
              <template #action>
                <button
                  type="button"
                  @click="togglePasswordConfirmationVisibility"
                  class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-500 hover:text-gray-700"
                >
                  <EyeOff v-if="showPasswordConfirmation" :size="18" />
                  <Eye v-else :size="18" />
                </button>
              </template>
            </Input>

            <div class="flex items-center">
              <input
                id="terms"
                v-model="form.accept_terms"
                type="checkbox"
                required
                class="checkbox checkbox-primary"
              />
              <label for="terms" class="ml-2 text-sm text-gray-700">
                {{ t("register.form.acceptTerms") }}
                <a
                  href="#"
                  class="text-primary-600 hover:text-primary-500 underline"
                >
                  {{ t("register.form.termsLink") }}
                </a>
                {{ t("register.form.and") }}
                <a
                  href="#"
                  class="text-primary-600 hover:text-primary-500 underline"
                >
                  {{ t("register.form.privacyLink") }} </a
                >.
              </label>
            </div>

            <!-- Submit Bouton -->
            <div class="flex justify-center">
              <SubmitButton
                :busy="form.busy"
                block
                :disabled="!form.accept_terms"
                customClass="w-full sm:w-8/12 bg-primary-500 py-2.5 text-white rounded-lg hover:bg-primary-600 transition duration-150 flex items-center justify-center disabled:opacity-50 disabled:cursor-not-allowed"
              >
                <template #default>
                  <Send class="w-5 h-5 mr-2" />
                  {{ t("register.form.btnSubmit") }}
                </template>
                <template #loading>
                  {{ t("common.buttons.processing") }}
                </template>
              </SubmitButton>
            </div>
          </form>

          <div class="mt-8">
            <div class="relative">
              <div class="absolute inset-0 flex items-center">
                <div class="w-full border-t border-gray-300" />
              </div>
              <div class="relative flex justify-center text-sm">
                <span class="px-4 bg-white text-gray-500 font-medium">{{
                  t("social.or")
                }}</span>
              </div>
            </div>

            <!-- Google -->
            <div class="mt-6 flex justify-center">
              <GoogleButton
                size="md"
                customClass="w-full sm:w-8/12"
                @click="handleGoogleRegister"
              >
                {{ t("social.googleRegister") }}
              </GoogleButton>
            </div>
          </div>

          <div class="mt-6 text-center">
            <p class="text-sm text-gray-600">
              {{ t("register.form.alreadyHaveAccount") }}
              <a
                :href="route('login')"
                class="font-semibold text-primary-600 hover:text-primary-500"
                >{{ t("register.form.loginLink") }}</a
              >
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
import {
  Send,
  ArrowLeft,
  Mail,
  Phone,
  User,
  EyeOff,
  Eye,
  Lock,
} from "lucide-vue-next";
import { route } from "ziggy-js";

let timeoutId = null;

const store = useAuthStore();
const form = store.form;
store.resetForm();

form.name = null;
form.email = null;
form.phone = null;
form.password = null;
form.password_confirmation = null;

const alert = ref({ type: null, message: null });
const showPassword = ref(false);
const showPasswordConfirmation = ref(false);

const handleCloseAlert = () => {
  alert.value = { type: null, message: null };
};

const togglePasswordVisibility = () => {
  showPassword.value = !showPassword.value;
};

const togglePasswordConfirmationVisibility = () => {
  showPasswordConfirmation.value = !showPasswordConfirmation.value;
};

const handleSubmit = async () => {
  alert.value = { type: null, message: null };
  try {
    const resp = await store.register();
    alert.value = { type: "success", message: resp.data.message };

    await nextTick();

    timeoutId = setTimeout(() => {
      window.location.href = route("login");
    }, 5000);
  } catch (error) {
    if (error?.response?.status !== 422 && error?.response?.data?.message) {
      alert.value = {
        type: "error",
        message:
          error?.response?.data?.message ||
          t("common.errors.registerFailedFailed"),
      };
    }
  }
};

onBeforeUnmount(() => {
  if (timeoutId) {
    clearTimeout(timeoutId);
  }
});
</script>
