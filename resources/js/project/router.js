import { createWebHistory, createRouter } from "vue-router";
import Poll from './components/Poll.vue'

const routes = [
    {
        name:'poll',
        path:'/poll',
        component: Poll
    },
]

const router = createRouter({
    history: createWebHistory(),
    routes,
})

export default router