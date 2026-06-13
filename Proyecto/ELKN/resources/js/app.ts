import '../css/app.css';

import { createInertiaApp } from '@inertiajs/vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import type { DefineComponent } from 'vue';
import { createApp, h } from 'vue';
import { initializeTheme } from './composables/useAppearance';

// Vuetify
import 'vuetify/styles';
import { createVuetify } from 'vuetify';
import * as components from 'vuetify/components';
import * as directives from 'vuetify/directives';

// Iconos
import '@mdi/font/css/materialdesignicons.css';

const myCustomTheme = {
  dark: false, // modo claro por defecto
  colors: {
    primary: '#027368',   // verde azulado
    secondary: '#04BF9D', // verde oscuro
    success: '#4CAF50',   // verde
    info: '#5550F2',      // azul claro
    warning: '#FB8C00',   // naranja
    error: '#FF5252',     // rojo
    background: '#F2F2F2' // fondo
  },
};

const vuetify = createVuetify({
    components,
    directives,
    theme: {
        defaultTheme: 'myCustomTheme', // 🟢 cambia aquí
        themes: {
            myCustomTheme, // 🟢 agrega tu tema
        },
    },
});

const appName = import.meta.env.VITE_APP_NAME || 'Laravel';

createInertiaApp({
    title: (title) => (title ? `${title} - ${appName}` : appName),
    resolve: (name) =>
        resolvePageComponent(
            `./pages/${name}.vue`,
            import.meta.glob<DefineComponent>('./pages/**/*.vue'),
        ),
    setup({ el, App, props, plugin }) {
        createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(vuetify) // 👈 aquí integras Vuetify
            .mount(el);
    },
    progress: {
        color: '#4B5563',
    },
});

// Light/dark mode con tu composable
initializeTheme();
