/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

import './bootstrap';
import { createApp } from 'vue';
import { ZiggyVue } from '/vendor/tightenco/ziggy/dist/vue.es.js';
import { Ziggy } from './ziggy';


// Pages
import StaffCarIndex from '@/pages/staffCar/index.vue';
import StaffCarCreate from '@/pages/staffCar/create.vue';
import StaffCarUpdate from '@/pages/staffCar/update.vue';
import StaffCarDetail from '@/pages/staffCar/detail.vue';

// Components
import { Bootstrap5Pagination } from 'laravel-vue-pagination';



const app = createApp({});



// Pages
app.component('StaffCarIndex',StaffCarIndex);
app.component('StaffCarCreate',StaffCarCreate);
app.component('StaffCarUpdate',StaffCarUpdate);
app.component('StaffCarDetail',StaffCarDetail);

// Components
app.component('Bootstrap5Pagination',Bootstrap5Pagination);

// Uses
app.use(ZiggyVue, Ziggy);


/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// Object.entries(import.meta.glob('./**/*.vue', { eager: true })).forEach(([path, definition]) => {
//     app.component(path.split('/').pop().replace(/\.\w+$/, ''), definition.default);
// });

/**
 * Finally, we will attach the application instance to a HTML element with
 * an "id" attribute of "app". This element is included with the "auth"
 * scaffolding. Otherwise, you will need to add an element yourself.
 */

app.mount('#app');
