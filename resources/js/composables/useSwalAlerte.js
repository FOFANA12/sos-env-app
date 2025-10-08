import Swal from "sweetalert2";
import i18n from "@/js/i18n";

export const useSwalAlerte = () => {
    const defaultTimer = import.meta.env.VITE_SWAL_DEFAULT_TIMER || 3000;

    const showSimpleAlerte = ({
        position = "top-end",
        icon = "info",
        text = "",
        timer = defaultTimer,
    } = {}) => {
        return Swal.fire({
            position,
            icon,
            text,
            showConfirmButton: false,
            timer,
            customClass: {
                popup: "swal-compact",
            },
        });
    };

    const showConfirm = ({
        title = i18n.global.t("common.sweetalert.showConfirm.title"),
        icon = "warning",
        message = i18n.global.t("common.sweetalert.showConfirm.message"),
        confirmButtonText = i18n.global.t(
            "common.sweetalert.showConfirm.confirmButtonText"
        ),
        cancelButtonText = i18n.global.t(
            "common.sweetalert.showConfirm.cancelButtonText"
        ),
    } = {}) => {
        return Swal.fire({
            title,
            icon,
            text: message,
            showCancelButton: true,
            allowOutsideClick: false,
            reverseButtons: true,
            confirmButtonText,
            cancelButtonText,
            buttonsStyling: false,
            customClass: {
                confirmButton: "swal-btn-confirm",
                cancelButton: "swal-btn-cancel",
                popup: "swal-compact",
            },
        });
    };

    const showErrorModal = ({
        title = i18n.global.t("common.sweetalert.showErrorModal.title"),
        message = i18n.global.t("common.sweetalert.showErrorModal.message"),
        confirmButtonText = i18n.global.t(
            "common.sweetalert.showErrorModal.confirmButtonText"
        ),
    } = {}) => {
        return Swal.fire({
            title,
            icon: "error",
            text: message,
            showConfirmButton: true,
            confirmButtonText,
            buttonsStyling: false,
            allowOutsideClick: false,
            customClass: {
                confirmButton: "swal-btn-confirm bg-red-500 hover:bg-red-600",
                popup: "swal-compact",
            },
        });
    };

    return {
        showSimpleAlerte,
        showConfirm,
        showErrorModal,
    };
};
