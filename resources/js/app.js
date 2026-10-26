import './bootstrap';
import Swal from 'sweetalert2';
import 'sweetalert2/dist/sweetalert2.min.css';

window.Swal = Swal;

// Toast notification helper tailored for VINIX7
const VinixToast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3500,
    timerProgressBar: true,
    didOpen: (toast) => {
        toast.onmouseenter = Swal.stopTimer;
        toast.onmouseleave = Swal.resumeTimer;
    }
});
window.VinixToast = VinixToast;

// Global confirmation dialog helper with VINIX7 aesthetic
window.confirmDialog = function({
    title = 'Konfirmasi Tindakan',
    text = 'Apakah Anda yakin ingin melanjutkan proses ini?',
    icon = 'question',
    confirmText = 'Ya, Lanjutkan',
    cancelText = 'Batal',
    confirmColor = '#0F172A'
}) {
    return Swal.fire({
        title: title,
        text: text,
        icon: icon,
        showCancelButton: true,
        confirmButtonColor: confirmColor,
        cancelButtonColor: '#94A3B8',
        confirmButtonText: confirmText,
        cancelButtonText: cancelText,
        reverseButtons: true,
        customClass: {
            popup: 'rounded-3xl border border-slate-100 shadow-2xl font-sans',
            title: 'text-lg font-bold text-slate-900',
            htmlContainer: 'text-xs sm:text-sm text-slate-600',
            confirmButton: 'px-6 py-2.5 rounded-xl font-bold text-sm text-white shadow-md',
            cancelButton: 'px-5 py-2.5 rounded-xl font-semibold text-sm text-slate-700 bg-slate-100 hover:bg-slate-200 shadow-xs'
        }
    });
};

// Global event listeners for Livewire and Custom Events
window.addEventListener('swal:modal', event => {
    const data = Array.isArray(event.detail) ? event.detail[0] : (event.detail || {});
    Swal.fire({
        title: data.title || 'Pemberitahuan',
        text: data.text || '',
        icon: data.icon || 'info',
        confirmButtonColor: '#0F172A',
        confirmButtonText: data.confirmButtonText || 'OK',
        customClass: {
            popup: 'rounded-3xl border border-slate-100 shadow-2xl font-sans',
            title: 'text-xl font-bold text-slate-900',
            confirmButton: 'px-6 py-2.5 rounded-xl font-bold text-sm bg-slate-900 text-white shadow-md'
        }
    });
});

window.addEventListener('swal:toast', event => {
    const data = Array.isArray(event.detail) ? event.detail[0] : (event.detail || {});
    VinixToast.fire({
        icon: data.icon || 'success',
        title: data.title || data.text || 'Berhasil'
    });
});
