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
      class="relative z-10 min-h-screen flex flex-col items-center justify-center px-4 sm:px-6 lg:px-8 py-6"
    >
      <div class="max-w-5xl mx-auto w-full">
        <!-- Header -->
        <div class="text-center mb-6">
          <img
            :src="logo"
            alt="Logo"
            class="mx-auto h-16 mb-4 w-auto opacity-90"
          />
          <h1 class="text-xl font-bold text-gray-900">
            {{ t("register.title") }}
          </h1>
          <p class="text-gray-600 text-sm">{{ t("register.subtitle") }}</p>
        </div>

        <div v-if="alert.type && alert.message" class="w-full text-sm">
          <Alert
            :type="alert.type"
            :message="alert.message"
            @close="handleCloseAlert"
          />
        </div>

        <form
          @submit.prevent="handleSubmit"
          @keydown="form.onKeydown($event)"
          class="space-y-6"
        >
          <!-- Personal Info -->
          <div class="bg-white rounded-lg mt-6">
            <div class="card-header">
              <h2 class="text-lg p-4 pt-2 pb-2">
                {{ t("register.sections.personalInfo") }}
              </h2>
              <hr class="border-t border-gray-200 w-full mb-0" />
            </div>
            <div class="card-body p-4">
              <div class="grid grid-cols-12 gap-4">
                <div class="col-span-12 md:col-span-6">
                  <Input
                    id="name"
                    name="name"
                    :label="t('register.form.name')"
                    v-model="form.name"
                    :placeholder="t('register.form.namePlaceholder')"
                    :error="form.errors.get('name')"
                    :form="form"
                    required
                  />
                </div>
                <div class="col-span-12 md:col-span-6">
                  <Input
                    id="phone"
                    name="phone"
                    :label="t('register.form.phone')"
                    v-model="form.phone"
                    :placeholder="t('register.form.phonePlaceholder')"
                    :error="form.errors.get('phone')"
                    :form="form"
                    required
                  />
                </div>
              </div>
            </div>
          </div>

          <!-- Login Info -->
          <div class="bg-white rounded-lg mt-6">
            <div class="card-header">
              <h2 class="text-lg p-4 pt-2 pb-2">
                {{ t("register.sections.loginInfo") }}
              </h2>
              <hr class="border-t border-gray-200 w-full mb-0" />
            </div>
            <div class="card-body p-4">
              <div class="grid grid-cols-12 gap-4">
                <div class="col-span-12 md:col-span-6">
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
                        ><Mail :size="18"
                      /></span>
                    </template>
                  </Input>
                </div>

                <div class="col-span-12 md:col-span-6">
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
                </div>

                <div class="col-span-12 md:col-span-6">
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
                </div>
              </div>
            </div>
          </div>

          <!-- Terms -->
          <div class="mt-6">
            <label
              class="flex items-start text-sm text-gray-700"
              for="terms_accepted"
            >
              <input
                id="terms_accepted"
                name="terms_accepted"
                v-model="form.terms_accepted"
                type="checkbox"
                class="checkbox checkbox-primary"
              />
              <span class="ml-2">
                {{ t("register.form.acceptTerms") }}
                <a
                  href="terms"
                  class="text-primary-600 hover:text-primary-500 underline"
                  >{{ t("register.form.termsLink") }}</a
                >
                {{ t("register.form.and") }}
                <a
                  href="privacy"
                  class="text-primary-600 hover:text-primary-500 underline"
                  >{{ t("register.form.privacyLink") }}</a
                >.
              </span>
            </label>
            <p
              v-if="form.errors.has('terms_accepted')"
              class="text-red-500 text-xs mt-1"
            >
              {{ form.errors.get("terms_accepted") }}
            </p>
          </div>

          <div class="mt-6">
            <div class="flex flex-col sm:flex-row justify-end gap-10 sm:gap-4">
              <a
                :href="route('home')"
                class="inline-flex items-center sm:justify-center text-sm font-medium text-primary-600 hover:text-primary-500 w-full sm:w-auto"
              >
                <ArrowLeft class="w-4 h-4 mr-1" />
                {{ t("common.links.backHome") }}
              </a>

              <SubmitButton
                :busy="form.busy"
                :disabled="!form.terms_accepted"
                customClass="w-full sm:w-auto min-w-[160px] bg-primary-500 px-3 text-white rounded-lg hover:bg-primary-600 transition duration-150 flex items-center justify-center disabled:opacity-50 disabled:cursor-not-allowed"
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
          </div>
        </form>

        <div class="mt-6 space-y-6">
          <div class="text-center">
            <p class="text-sm text-gray-600">
              {{ t("register.form.alreadyHaveAccount") }}
              <a
                :href="route('login')"
                class="font-medium text-primary-600 hover:text-primary-500"
              >
                {{ t("register.form.loginLink") }}
              </a>
            </p>
          </div>

          <!-- Divider -->
          <div class="relative flex items-center">
            <div class="flex-grow border-t border-gray-300"></div>
            <span class="flex-shrink mx-4 text-gray-500 text-sm">{{
              t("social.or")
            }}</span>
            <div class="flex-grow border-t border-gray-300"></div>
          </div>

          <!-- Google button -->
          <div class="flex justify-center">
            <GoogleButton
              size="md"
              customClass="w-full sm:w-3/12 min-w-[300px]"
              @click="handleGoogleRegister"
            >
              {{ t("social.googleRegister") }}
            </GoogleButton>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>


<script setup>
const logo = "/images/logo.png";
import { useAuthStore } from "@/js/store";
import { Send, ArrowLeft, Mail, EyeOff, Eye, Lock } from "lucide-vue-next";
import { route } from "ziggy-js";
import { useSwalAlerte } from "@/js/composables/useSwalAlerte";

const { showSimpleAlerte } = useSwalAlerte();

const store = useAuthStore();
const form = store.form;
store.resetForm();

form.name = null;
form.phone = null;
form.email = null;
form.password = null;
form.password_confirmation = null;
form.terms_accepted = false;

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
    showSimpleAlerte({ icon: "success", text: resp.data.message });
    store.resetForm();

    await nextTick();

    await showSimpleAlerte({
      icon: "success",
      text: resp.data.message,
      timer: 3000,
    });

    window.location.href = route("login");

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

</script>
