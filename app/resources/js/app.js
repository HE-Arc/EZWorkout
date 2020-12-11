require('./bootstrap');

import Vue from 'vue';

import { InertiaApp } from '@inertiajs/inertia-vue';
import { InertiaForm } from 'laravel-jetstream';
import PortalVue from 'portal-vue';

//vue-select
import vSelect from 'vue-select'
import 'vue-select/dist/vue-select.css';


Vue.component('v-select', vSelect)

//font awesome
import { library } from '@fortawesome/fontawesome-svg-core'
import { faEdit, faTrashAlt, faRulerCombined, faChartLine, faBook, faDumbbell } from '@fortawesome/free-solid-svg-icons'
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'
library.add(faEdit)
library.add(faTrashAlt)
library.add(faRulerCombined)
library.add(faChartLine)
library.add(faBook)
library.add(faDumbbell)
Vue.component('font-awesome-icon', FontAwesomeIcon)

//vue-modal
import VModal from 'vue-js-modal'
Vue.use(VModal, { dialog: true })


Vue.use(InertiaApp);
Vue.use(InertiaForm);
//Vue.use(PortalVue);

const app = document.getElementById('app');

new Vue({
    render: (h) =>
        h(InertiaApp, {
            props: {
                initialPage: JSON.parse(app.dataset.page),
                resolveComponent: (name) => require(`./Pages/${name}`).default,
            },
        }),
}).$mount(app);
