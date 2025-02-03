import {createRouter, createWebHistory} from "vue-router";

const router = createRouter({
    routes: [

        {
            path: '/',
            component: () => import("@/view/Layout.vue"),
            children: [
                {
                    path: '/cards',
                    component: () => import("@/view/pages/Cards.vue"),
                },
                {
                    path: '/editor',
                    component: () => import("@/view/pages/Editor.vue"),
                },
                {
                    path: '/',
                    component: () => import("@/view/pages/Main.vue"),
                },
            ]
        },

    ],
    history: createWebHistory()
})

export default router;
