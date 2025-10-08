import { createI18n } from 'vue-i18n';
const messages = Object.fromEntries(
  Object.entries(import.meta.glob('./locales/*.json', { eager: true })).map(([key, value]) => [
    key.slice(10, -5),
    value.default,
  ])
);

const STORAGE_KEY = 'sosEnv';
const supportedLocales = ['fr', 'en', 'ar'];
const storedLocale = localStorage.getItem(STORAGE_KEY);
const defaultLocale = supportedLocales.includes(storedLocale) ? storedLocale : 'fr';

if (!supportedLocales.includes(storedLocale)) {
  localStorage.setItem(STORAGE_KEY, 'fr');
}

export default createI18n({
  defaultScope: 'global',
  legacy: false,

  locale: defaultLocale,
  fallbackLocale: defaultLocale,

  messages,

  //fallbackWarn: false,
  //missingWarn: false
});
