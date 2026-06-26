import { Controller } from '@hotwired/stimulus';

/*
 * Optional Stimulus alternative to the inline color-mode script.
 *
 *   <a href="#" data-controller="adminlte--color-mode"
 *      data-action="adminlte--color-mode#toggle">Toggle theme</a>
 */
const STORAGE_KEY = 'lte-theme'; // shared with the Vue/React/Angular ports

export default class extends Controller {
    toggle(event) {
        event.preventDefault();

        const root = document.documentElement;
        const next = root.getAttribute('data-bs-theme') === 'dark' ? 'light' : 'dark';

        root.setAttribute('data-bs-theme', next);
        localStorage.setItem(STORAGE_KEY, next);
        document.dispatchEvent(new CustomEvent('adminlte:color-mode', { detail: next }));
    }
}
