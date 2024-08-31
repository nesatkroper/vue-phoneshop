import { createRouter, createWebHistory } from "vue-router";
import NotFound from "../views/404/NotFound.vue";
const routes = [
  {
    path: "/",
    component: () => import("../views/homepage/Home.vue"),
    name: "home",
  },
  {
    path: "/customer",
    component: () => import("../views/customer/Customer.vue"),
    name: "customer",
  },
  {
    path: "/profile",
    component: () => import("../views/portfolio/Portfolio.vue"),
    name: "profile",
  },
  {
    path: "/:pathMatch(.*)*",
    component: NotFound,
    name: "404",
  },
];

const router = createRouter({
  history: createWebHistory(),
  routes: routes,
});

export default router;
