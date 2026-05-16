import { createRouter, createWebHistory } from "vue-router";

import AreasView from "../views/AreasView.vue";
import TemasView from "../views/TemasView.vue";
import SubtemasView from "../views/SubtemasView.vue";
import NiveisView from "../views/NiveisView.vue";
import AtividadesView from "../views/AtividadesView.vue";

const routes = [
  {
    path: "/",
    component: AreasView,
  },
  {
    path: "/temas/:areaId",
    component: TemasView,
  },
  {
    path: "/subtemas/:temaId",
    component: SubtemasView,
  },
  {
    path: "/niveis/:subtemaId",
    component: NiveisView,
  },
  {
    path: "/atividades/:nivelId",
    component: AtividadesView,
  },
];

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes,
});

export default router;