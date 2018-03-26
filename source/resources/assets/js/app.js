require('./bootstrap');

window.Vue = require('vue');
import VueRouter from 'vue-router';

window.Vue.use(VueRouter);

import HotelsIndex from './components/hotels/HotelsIndex.vue';
import HotelsCreate from './components/hotels/HotelsCreate.vue';
import HotelsEdit from './components/hotels/HotelsEdit.vue';

const routes = [
    {
        path: '/',
        components: {
            hotelsIndex: HotelsIndex
        }
    },
    {path: '/admin/hotels/create', component: HotelsCreate, name: 'createHotel'},
    {path: '/admin/hotels/edit/:id', component: HotelsEdit, name: 'editHotel'},
]

const router = new VueRouter({ routes })

const app = new Vue({ router }).$mount('#app')
