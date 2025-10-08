<template>
  <div>
    <label v-if="label" class="mb-1 block text-sm font-medium text-gray-700 dark:text-gray-400">
      {{ label }} <span v-if="required" class="required-star">*</span>
    </label>

    <Combobox v-model="selectedObj" :by="byKey" nullable>
      <div class="relative">
        <!-- Input -->
        <div
          class="relative w-full cursor-default overflow-hidden rounded-lg border bg-white text-left sm:text-sm"
          :class="[
            error
              ? 'border-red-500 focus-within:border-red-500 focus-within:ring-red-500/10'
              : 'border-gray-300 focus-within:border-primary-300 focus-within:ring-primary-500/10',
          ]"
        >
          <ComboboxInput
            :placeholder="placeholder"
            class="w-full border-none py-2.5 px-3 text-sm leading-5 text-gray-800 placeholder-gray-400 focus:outline-none focus:ring-0 bg-white dark:bg-transparent"
            :displayValue="displayValue"
            @change="query = $event.target.value"
          />

          <ComboboxButton class="absolute inset-y-0 right-0 flex items-center pr-2">
            <svg
              class="h-5 w-5 text-gray-400"
              xmlns="http://www.w3.org/2000/svg"
              fill="none"
              viewBox="0 0 24 24"
              stroke="currentColor"
            >
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
            </svg>
          </ComboboxButton>
        </div>

        <TransitionRoot
          leave="transition ease-in duration-100"
          leave-from="opacity-100"
          leave-to="opacity-0"
          @after-leave="query = ''"
        >
          <ComboboxOptions
            class="absolute z-10 mt-1 max-h-60 w-full overflow-auto rounded-lg border border-gray-200 bg-white py-1 text-sm shadow-lg ring-1 ring-black/5 focus:outline-none"
          >
            <div
              v-if="filteredOptions.length === 0"
              class="relative cursor-default select-none px-4 py-2 text-gray-500"
            >
              {{ notFoundText }}
            </div>

            <ComboboxOption
              v-for="option in filteredOptions"
              :key="optionKey(option)"
              :value="option"
              v-slot="{ selected, active }"
            >
              <li
                class="relative cursor-default select-none py-2 pl-10 pr-4"
                :class="{ 'bg-primary-50 text-primary-900': active, 'text-gray-900': !active }"
              >
                <span class="block truncate" :class="{ 'font-medium': selected, 'font-normal': !selected }">
                  {{ optionLabel(option) }}
                </span>
                <span v-if="selected" class="absolute inset-y-0 left-0 flex items-center pl-3 text-primary-600">✔</span>
              </li>
            </ComboboxOption>
          </ComboboxOptions>
        </TransitionRoot>
      </div>
    </Combobox>

    <p v-if="error" class="text-red-500 text-xs mt-1">{{ error }}</p>
  </div>
</template>

<script setup>
import { ref, computed } from 'vue'
import {
  Combobox,
  ComboboxInput,
  ComboboxButton,
  ComboboxOptions,
  ComboboxOption,
  TransitionRoot
} from '@headlessui/vue'

const props = defineProps({
  modelValue: [String, Number, null],
  options: { type: Array, required: true }, // [{ code, name }]
  label: String,
  placeholder: String,
  error: String,
  required: Boolean,
  notFoundText: { type: String, default: 'No results found.' },
  valueKey: { type: String, default: 'code' },
  labelKey: { type: String, default: 'name' }
})

const emit = defineEmits(['update:modelValue'])

const query = ref('')

// Recherche de l’objet sélectionné en fonction du code externe
const selectedObj = computed({
  get() {
    return props.options.find(o => o[props.valueKey] === props.modelValue) || null
  },
  set(obj) {
    emit('update:modelValue', obj ? obj[props.valueKey] : null)
  }
})

// Comparaison d’objets par clé (évite les doubles clics)
const byKey = (a, b) => {
  if (!a && !b) return true
  if (!a || !b) return false
  return a[props.valueKey] === b[props.valueKey]
}

// Filtrage
const filteredOptions = computed(() => {
  const q = query.value.toLowerCase()
  return q === ''
    ? props.options
    : props.options.filter(o => o[props.labelKey].toLowerCase().includes(q))
})

// Comment afficher la valeur dans l’input
const displayValue = obj => obj?.[props.labelKey] ?? ''

// Helpers d’affichage
const optionLabel = opt => opt?.[props.labelKey] ?? ''
const optionKey = opt => opt?.[props.valueKey]
</script>

<style scoped>
:deep(input:focus) {
  outline: none !important;
  box-shadow: none !important;
}
</style>
