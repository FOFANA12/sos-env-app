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
        </div>
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
              <InputReadonly
                id="name"
                name="name"
                :label="t('user.form.name')"
                :placeholder="t('user.form.namePlaceholder')"
                :modelValue="form.name"
              />
            </div>

            <!-- Email -->
            <div class="col-span-12 md:col-span-6">
              <InputReadonly
                id="email"
                name="email"
                :label="t('user.form.email')"
                :modelValue="form.email"
                :placeholder="t('user.form.emailPlaceholder')"
              />
            </div>

            <!-- Phone -->
            <div class="col-span-12 md:col-span-6">
              <InputReadonly
                id="phone"
                name="phone"
                :label="t('user.form.phone')"
                :modelValue="form.phone"
                :placeholder="t('user.form.phonePlaceholder')"
              />
            </div>

            <!-- Role -->
            <div class="col-span-12 md:col-span-6">
              <InputReadonly
                id="role"
                name="role"
                :label="t('user.form.role')"
                :modelValue="form.role?.name"
                readonly
              />
            </div>

            <!-- Status -->
            <div class="col-span-12 md:col-span-6 flex items-center">
              <input
                id="status"
                type="checkbox"
                v-model="form.status"
                class="checkbox-primary h-5 w-5 mr-2"
                disabled
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
import { UserRound } from "lucide-vue-next";
import { useUserStore } from "@/js/store";

const userStore = useUserStore();
const form = userStore.form;

const avatarPreview = computed(() => form.avatar_url);
</script>
