<template>
  <div class="min-h-screen relative overflow-hidden">
    <!-- Background Design -->
    <div class="absolute inset-0 bg-gray-100">
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
      class="relative z-10 min-h-screen flex flex-col items-center justify-center px-4 py-6"
    >
      <!-- Header -->
      <div class="w-full max-w-sm mx-auto mb-6">
        <div class="flex justify-center">
          <img :src="logo" alt="Logo" class="h-16 w-auto opacity-90" />
        </div>
      </div>

      <div
        v-if="alert.type && alert.message"
        class="w-full max-w-screen-sm sm:max-w-screen-md md:max-w-screen-lg lg:max-w-screen-lg mb-6 text-sm"
      >
        <Alert
          :type="alert.type"
          :message="alert.message"
          @close="handleCloseAlert"
        />
      </div>

      <div class="w-full max-w-sm">
        <div class="bg-white rounded-3xl border border-gray-100 p-6">
          <div class="mb-6">
            <h1 class="text-xl font-bold text-gray-900">
              {{ t("login.title") }}
            </h1>
            <p class="text-gray-600 text-sm">{{ t("login.subtitle") }}</p>
          </div>

          <form
            @submit.prevent="handleSubmit"
            @keydown="form.onKeydown($event)"
            class="space-y-6"
          >
            <!-- Email -->
            <Input
              id="email"
              name="email"
              type="email"
              v-model="form.email"
              :label="t('login.form.email')"
              :placeholder="t('login.form.emailPlaceholder')"
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
              :label="t('login.form.password')"
              :placeholder="t('login.form.passwordPlaceholder')"
              :error="form.errors.get('password')"
              required
              autocomplete="current-password"
              inputClass="w-full pl-9 pr-4 py-2.5 rounded-lg text-sm text-gray-800 bg-transparent border focus:outline-none"
            >
              <template #icon>
                <span
                  class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-500"
                >
                  <Lock :size="18" />
                </span>
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

            <div class="flex items-center justify-end">
              <a
                :href="route('password.request')"
                class="text-sm font-medium text-primary-600 hover:text-primary-500"
                >{{ t("login.form.forgotPasswordLink") }}</a
              >
            </div>

            <div class="flex justify-center">
              <SubmitButton
                :busy="form.busy"
                block
                customClass="w-full sm:w-8/12 bg-primary-500 py-2.5 text-white rounded-lg hover:bg-primary-600 transition duration-150 flex items-center justify-center"
              >
                <template #default>
                  <Send class="w-5 h-5 mr-2" />
                  {{ t("login.form.btnSubmit") }}
                </template>

                <template #loading>
                  {{ t("common.buttons.processing") }}
                </template>
              </SubmitButton>
            </div>
          </form>

          <div class="mt-6">
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
                @click="handleGoogleLogin"
              >
                {{ t("social.googleLogin") }}
              </GoogleButton>
            </div>
          </div>

          <div class="mt-6 text-center">
            <p class="text-sm text-gray-600">
              {{ t("login.noAccount") }}
              <a
                :href="route('register')"
                class="font-semibold text-primary-600 hover:text-primary-500"
                >{{ t("login.createAccount") }}</a
              >
            </p>
          </div>
        </div>
        
        <div class="mt-6 text-center text-xs text-gray-500 space-x-2">
          <span>{{ t("common.links.agreeNotice") }}</span>
          <a
            :href="route('terms')"
            class="font-medium text-primary-600 hover:text-primary-500"
          >
            {{ t("common.links.terms") }}
          </a>
          <span>&nbsp;{{ t("common.links.and") }}&nbsp;</span>
          <a
            :href="route('privacy')"
            class="font-medium text-primary-600 hover:text-primary-500"
          >
            {{ t("common.links.privacy") }}
          </a>
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
import { Mail, Lock, Eye, EyeOff, Send, ArrowLeft } from "lucide-vue-next";
import { route } from "ziggy-js";

const store = useAuthStore();
const showPassword = ref(false);

const form = store.form;
store.resetForm();
form.email = null;
form.password = null;
const alert = ref({ type: null, message: null });

const handleCloseAlert = () => {
  alert.value = { type: null, message: null };
};

const togglePasswordVisibility = () => {
  showPassword.value = !showPassword.value;
};

onMounted(() => {
  const params = new URLSearchParams(window.location.search);
  if (params.has("message")) {
    alert.value = {
      type: params.get("type") ?? "info",
      message: params.get("message"),
    };

    const url = new URL(window.location.href);
    url.searchParams.delete("message");
    url.searchParams.delete("type");
    window.history.replaceState({}, document.title, url.toString());
  }

  /**
   * import { route } from "ziggy-js";

const logout = async () => {
  try {
    const resp = await authStore.logout();

    // Construire proprement l’URL de redirection
    const redirectUrl = route("login", {
      type: "success",
      message: resp.data.message,
    });

    window.location.href = redirectUrl;
  } catch (error) {
    console.error(error);
  }
};
   * 
   */
});

const handleGoogleLogin = () => {
  window.location.href = "/auth/google";
};

const handleSubmit = async () => {
  alert.value = { type: null, message: null };

  try {
    await store.login();
    window.location.href = route("web.login.redirect");
  } catch (error) {
    if (error?.response?.status !== 422 && error?.response?.data?.message) {
      alert.value = {
        type: "error",
        message:
          error?.response?.data?.message || t("common.errors.loginFailed"),
      };
    }
  }
};
</script>
