require('./bootstrap');

import { createApp } from 'vue'
import App from './App.vue'
import VueAxios from 'vue-axios';
import axios from 'axios';
import { createRouter, createWebHistory } from "vue-router";

import IndexComponent from './components/posts/Index.vue';
import CreateComponent from './components/posts/Create.vue';
import EditComponent from './components/posts/Edit.vue';

const routes = [
    {
        name: 'posts',
        path: '/',
        component: IndexComponent
    },
    {
        name: 'create-post',
        path: '/create',
        component: CreateComponent
    },
    {
        name: 'edit-post',
        path: '/edit/:id',
        component: EditComponent
    }
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

createApp(App).use(VueAxios, axios).use(router).mount('#app')