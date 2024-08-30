import { createRouter, createWebHistory } from "vue-router";

const routes = [
  {
    path: "/",
    component: () => import("./views/homepage/Home.vue"),
    name: "home",
  },
  {
    path: "/customer",
    component: () => import("./views/customer/Customer.vue"),
    name: "customer",
  },
  {
    path: "/:pathMatch(.*)*",
    component: () => import("./views/404/NotFound.vue"),
    name: "404",
  },
];

const router = createRouter({
  history: createWebHistory(),
  routes: routes,
});

export default router;
