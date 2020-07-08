import Vue from 'vue';
import Router from 'vue-router';
import Register from './components/Register.vue';
import Login from './components/Login.vue';
import ToDoLists from './components/ToDoLists.vue';

Vue.use(Router);

const routes = [
    {
        path: '/register',
        name: 'register',
        component: Register
    },
    {
        path: '/login',
        name: 'login',
        component: Login
    },
    {
        path: '/to-do-lists',
        name: 'to-do-lists',
        component: ToDoLists
    }
];

const router = new Router({
    routes: routes
});

export default router;