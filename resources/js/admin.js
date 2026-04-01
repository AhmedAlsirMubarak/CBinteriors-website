import Alpine from 'alpinejs';
import collapse from '@alpinejs/collapse';
import Sortable from 'sortablejs';

Alpine.plugin(collapse);
window.Alpine = Alpine;
Alpine.start();

// ── Drag-and-drop reorder ─────────────────────────────────
document.addEventListener('DOMContentLoaded', () => {
    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content;

    document.querySelectorAll('[data-sortable]').forEach((table) => {
        const endpoint = table.dataset.sortable;

        // SortableJS must target <tbody>, not <table>
        const tbody = table.tagName === 'TABLE'
            ? table.querySelector('tbody')
            : table;

        if (!tbody) return;

        Sortable.create(tbody, {
            handle:      '.drag-handle',
            animation:   150,
            ghostClass:  'sortable-ghost',
            chosenClass: 'sortable-chosen',
            forceFallback: false,

            onEnd: async () => {
                const ids = [...tbody.querySelectorAll('[data-id]')]
                    .map((el) => parseInt(el.dataset.id, 10));

                try {
                    const res = await fetch(endpoint, {
                        method:  'PATCH',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': csrfToken,
                            'Accept':       'application/json',
                        },
                        body: JSON.stringify({ ids }),
                    });

                    if (!res.ok) throw new Error('Reorder failed');
                    showToast('Order saved', 'success');
                } catch (err) {
                    showToast('Failed to save order — please refresh', 'error');
                    console.error(err);
                }
            },
        });
    });
});

// ── Toast notification ────────────────────────────────────
function showToast(message, type = 'success') {
    const existing = document.getElementById('admin-toast');
    if (existing) existing.remove();

    const colors = type === 'success'
        ? 'bg-cb-black text-white'
        : 'bg-red-600 text-white';

    const toast = document.createElement('div');
    toast.id = 'admin-toast';
    toast.className = `fixed bottom-6 right-6 z-50 px-5 py-3 rounded-lg shadow-lg text-sm font-medium transition-all duration-300 ${colors}`;
    toast.textContent = message;

    document.body.appendChild(toast);

    setTimeout(() => {
        toast.style.opacity = '0';
        setTimeout(() => toast.remove(), 300);
    }, 2800);
}

window.showToast = showToast;

// ── Image preview before upload ───────────────────────────
document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('[data-preview]').forEach((input) => {
        const targetId = input.dataset.preview;
        const preview  = document.getElementById(targetId);

        if (!preview) return;

        input.addEventListener('change', () => {
            const file = input.files?.[0];
            if (!file) return;

            const reader = new FileReader();
            reader.onload = (e) => {
                preview.src = e.target.result;
                preview.classList.remove('hidden');
            };
            reader.readAsDataURL(file);
        });
    });
});

// ── Confirm delete dialogs ────────────────────────────────
document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('[data-confirm]').forEach((btn) => {
        btn.addEventListener('click', (e) => {
            const message = btn.dataset.confirm || 'Are you sure you want to delete this?';
            if (!confirm(message)) {
                e.preventDefault();
                e.stopPropagation();
            }
        });
    });
});