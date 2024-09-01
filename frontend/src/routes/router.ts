import { createRouter, createWebHistory } from "vue-router";
// @ts-ignore
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
    path: "/category",
    component: () => import("../views/category/Category.vue"),
    name: "category",
  },
  {
    path: "/brand",
    component: () => import("../views/brand/Brand.vue"),
    name: "brand",
  },
  {
    path: "/product",
    component: () => import("../views/product/Product.vue"),
    name: "product",
  },
  {
    path: "/pro.photo",
    component: () => import("../views/pro_photo/ProPhoto.vue"),
    name: "pro.photo",
  },
  {
    path: "/video",
    component: () => import("../views/videos/Video.vue"),
    name: "video",
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
