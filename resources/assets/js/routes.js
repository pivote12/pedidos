import VueRouter from 'vue-router';
import Task from './components/App.vue';
import Profile from './components/ExampleComponent.vue';


let routes = [
    {
        path: '/',
        component: Task
    },
    {
        path: '/profile',
        component: Profile
    }
];


export default new VueRouter({
    routes
});
