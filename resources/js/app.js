import './bootstrap';
import Alpine from 'alpinejs';
import { registerOverlay, attachGlobalLoadingHandlers } from './loader';

window.Alpine = Alpine;

document.addEventListener('DOMContentLoaded', () => {
    const overlay = document.getElementById('global-loading');
    if (overlay) {
        registerOverlay(overlay);
    }
    attachGlobalLoadingHandlers();
});

Alpine.start();
