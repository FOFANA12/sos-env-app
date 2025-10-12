import "./bootstrap";
import "./menu";
import "vue-loading-overlay/dist/css/index.css";
import "sweetalert2/dist/sweetalert2.min.css";

import { createApp } from "vue";
import { createPinia } from "pinia";
import { HasError } from "vform/src/components/tailwind";
import i18n from "@/js/i18n";
import VueGoogleMaps from "@fawmi/vue-google-maps";

// Composants UI globaux
import CustomModal from "@/js/components/ui/CustomModal.vue";
import SubmitButton from "@/js/components/ui/SubmitButton.vue";
import Alert from "@/js/components/ui/Alert.vue";
import BaseButton from "@/js/components/ui/BaseButton.vue";
import BaseLinkButton from "@/js/components/ui/BaseLinkButton.vue";
import GoogleButton from "@/js/components/ui/GoogleButton.vue";
import BaseInput from "@/js/components/ui/BaseInput.vue";
import BaseInputReadonly from "@/js/components/ui/BaseInputReadonly.vue";
import BaseTextarea from "@/js/components/ui/BaseTextarea.vue";
import BaseTextareaReadonly from "@/js/components/ui/BaseTextareaReadonly.vue";
import DataTable from "@/js/components/ui/DataTable.vue";
import DatatableSearchInput from "@/js/components/ui/DatatableSearchInput.vue";
import VSelectHeadless from "@/js/components/ui/VSelectHeadless.vue";
// Auth
import LoginForm from "@/js/components/auth/LoginForm.vue";
import RegisterForm from "@/js/components/auth/RegisterForm.vue";
import ForgotPasswordForm from "@/js/components/auth/ForgotPasswordForm.vue";
import ResetPasswordForm from "@/js/components/auth/ResetPasswordForm.vue";

// Profile
import ProfileForm from "@/js/components/ProfileForm.vue";

// User
import UserIndex from "@/js/components/user/UserIndex.vue";
import UserCreate from "@/js/components/user/UserCreate.vue";
import UserEdit from "@/js/components/user/UserEdit.vue";
import UserShow from "@/js/components/user/UserShow.vue";

// Region
import RegionIndex from "@/js/components/region/RegionIndex.vue";

// Department
import DepartmentIndex from "@/js/components/department/DepartmentIndex.vue";

// Neighborhood
import NeighborhoodIndex from "@/js/components/neighborhood/NeighborhoodIndex.vue";

// Report
import ReportIndex from "@/js/components/report/ReportIndex.vue";
import ReportCreate from "@/js/components/report/ReportCreate.vue";
import ReportShow from "@/js/components/report/ReportShow.vue";

// Loader global (avec teleport)
import GlobalLoader from "@/js/components/ui/GlobalLoader.vue";
import LogoutButton from "@/js/components/auth/LogoutButton.vue";

// ---------------------------
// Pinia et i18n (une seule fois)
// ---------------------------
const pinia = createPinia();

// ---------------------------
// App principale (monte sur #app)
// ---------------------------
const app = createApp({});
app.use(pinia);
app.use(i18n);

app.use(VueGoogleMaps, {
    load: {
        key: import.meta.env.VITE_GOOGLE_MAPS_API_KEY,
        libraries: "places",
    },
});

// Propriété globale de traduction
app.config.globalProperties.t = i18n.global.t;

// Enregistrement des composants globaux
app.component("CustomModal", CustomModal);
app.component("SubmitButton", SubmitButton);
app.component("Alert", Alert);
app.component("Button", BaseButton);
app.component("LinkButton", BaseLinkButton);
app.component("GoogleButton", GoogleButton);
app.component("Input", BaseInput);
app.component("InputReadonly", BaseInputReadonly);
app.component("Textarea", BaseTextarea);
app.component("TextareaReadonly", BaseTextareaReadonly);
app.component("DataTable", DataTable);
app.component("DatatableSearchInput", DatatableSearchInput);
app.component("VSelectHeadless", VSelectHeadless);
app.component(HasError.name, HasError);

// Auth components
app.component("login-form", LoginForm);
app.component("register-form", RegisterForm);
app.component("forgot-password-form", ForgotPasswordForm);
app.component("reset-password-form", ResetPasswordForm);

// Profile components
app.component("profile-form", ProfileForm);

// User components
app.component("user-index", UserIndex);
app.component("user-create", UserCreate);
app.component("user-edit", UserEdit);
app.component("user-show", UserShow);

// Region components
app.component("region-index", RegionIndex);

// Department components
app.component("department-index", DepartmentIndex);

// Neighborhood components
app.component("neighborhood-index", NeighborhoodIndex);

// Report components
app.component("report-index", ReportIndex);
app.component("report-create", ReportCreate);
app.component("report-show", ReportShow);

// Monter l'application principale
app.mount("#app");

const loaderEl = document.getElementById("global-loader");
if (loaderEl) {
    const loaderApp = createApp(GlobalLoader);
    loaderApp.use(pinia).use(i18n);
    loaderApp.mount(loaderEl);
}

const logoutEl = document.getElementById("vue-logout");
if (logoutEl) {
    const logoutApp = createApp(LogoutButton);
    logoutApp.use(pinia).use(i18n);
    logoutApp.config.globalProperties.t = i18n.global.t;
    logoutApp.mount(logoutEl);
}
