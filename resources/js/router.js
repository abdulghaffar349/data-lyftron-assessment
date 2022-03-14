import {createRouter, createWebHashHistory} from 'vue-router'

const routes = [
    {path: '/', redirect: '/users'},
    {path: '/users', name: "users.index", component: () => import("./components/Users/Index")},
    {path: '/users/:id/edit', name: "users.edit", component: () => import("./components/Users/Edit")},
]

export default createRouter({
    history: createWebHashHistory(),
    routes,
})
