import { createApp, h } from 'vue'
import { createInertiaApp } from '@inertiajs/vue3'

import { Quasar } from 'quasar'
import quasarLang from 'quasar/lang/es'
import quasarIconSet from 'quasar/icon-set/material-symbols-outlined'

// Import icon libraries
import '@quasar/extras/roboto-font/roboto-font.css'
import '@quasar/extras/material-symbols-outlined/material-symbols-outlined.css'

// Import Quasar css
import 'quasar/src/css/index.sass'

import Layout from './Pages/Layout.vue'

createInertiaApp({
  resolve: name => {
    const pages = import.meta.glob('./Pages/**/*.vue', { eager: true })
    const page = pages[`./Pages/${name}.vue`]
    page.default.layout = page.default.layout || Layout
    return page
  },
  setup({ el, App, props, plugin }) {
    createApp({ render: () => h(App, props) })
    .use(plugin)
    .use(Quasar, {
        plugins: {}, // import Quasar plugins and add here
        lang: quasarLang,
        iconSet: quasarIconSet,
        config: {
            dark: true
        }
    })
    .mount(el)
  },
})
