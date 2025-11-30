let overlayEl = null;
let activeCount = 0;

const resolveOverlay = () => {
    if (overlayEl) return overlayEl;
    overlayEl = document.getElementById('global-loading');
    return overlayEl;
};

const setVisible = (visible) => {
    const target = resolveOverlay();
    if (!target) return;
    target.classList[visible ? 'remove' : 'add']('hidden');
};

export const registerOverlay = (el) => {
    overlayEl = el;
    if (activeCount > 0) setVisible(true);
};

export const showLoader = () => {
    activeCount += 1;
    setVisible(true);
    document.body?.classList.add('cursor-wait');
};

export const hideLoader = () => {
    activeCount = Math.max(0, activeCount - 1);
    if (activeCount === 0) {
        setVisible(false);
        document.body?.classList.remove('cursor-wait');
    }
};

export const attachGlobalLoadingHandlers = () => {
    document.addEventListener('submit', (event) => {
        const form = event.target;
        if (!(form instanceof HTMLFormElement)) return;
        if (form.dataset.noLoading === 'true' || form.hasAttribute('data-no-loading')) return;
        showLoader();
    });

    window.addEventListener('beforeunload', showLoader);
    window.addEventListener('loading:start', showLoader);
    window.addEventListener('loading:stop', hideLoader);
};
